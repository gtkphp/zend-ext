<?php

namespace Zend\Ext\Services\CodeGenerator\C\Header;

use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;


use Zend\ExtGtk\Implementation;

use Zend\Ext\Models\AbstractGenerator;
use Zend\Ext\Models\AnnotationGenerator;
use Zend\Ext\Models\ObjectGenerator;
use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\FileGenerator;
use Zend\Ext\Models\EnumGenerator;
use Zend\Ext\Models\UnionGenerator;
use Zend\Ext\Models\StructGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\FunctionGenerator;
use Zend\Ext\Models\ConstantGenerator;
use Zend\Ext\Models\VarGenerator;

use Zend\Ext\Views\PackageDto;
use Zend\Ext\Views\GroupDto;
use Zend\Ext\Views\ClassDto;
use Zend\Ext\Views\StructDto;
use Zend\Ext\Views\MemberDto;
use Zend\Ext\Views\ParameterDto;
use Zend\Ext\Views\EnumDto;
use Zend\Ext\Views\ConstantDto;
use Zend\Ext\Views\UnionDto;
use Zend\Ext\Views\VarDto;
use Zend\Ext\Views\MethodDto;
use Zend\Ext\Views\ObjectDto;


use Zend\Ext\Views\HelperPluginManager;
use Zend\Ext\Views\C\Header\Helpers\TypeHelper;

use Zend\Filter\FilterChain;
use Zend\Filter\StripTags;
use Zend\Filter\StringToLower;
use Zend\Filter\StringToUpper;
use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\Filter\Word\CamelCaseToDash;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\View;

use Zend\Ext\Services\CodeGenerator;


class GlibGenerator extends CodeGenerator
{
    function __construct($name)
    {
        parent::__construct($name);
    }

    function getViewModel($dto):ViewModel
    {
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', date("m/d/y"));
        $licenseModel->setVariable('php_version', Implementation::$version);
        $licenseModel->setTemplate('license.phtml');

        $marksModel = new ViewModel();
        $marksModel->setTemplate('vim-marks.phtml');

        $model = parent::getViewModel(array());
        $model->setVariable('objects', array($dto));
        $model->addChild($licenseModel, 'license');
        $model->addChild($marksModel, 'vimMarks');
        $model->setTemplate('file.phtml');
        return $model;
    }

    function getRenderer():RendererInterface
    {
        if ($this->renderer) {
            return $this->renderer;
        }
        $resolver = new TemplatePathStack();

        $resolver->addPath(__DIR__.'/../../../../Views');
        $resolver->addPath(__DIR__.'/../../../../Views/C');
        $resolver->addPath(__DIR__.'/../../../../Views/C/Header');

        $renderer = parent::getRenderer();
        $renderer->setResolver($resolver);

        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        $pluginManager->addPathHelper(__DIR__.'/../../../../Views/C/Header/Helpers', 'Zend\\Ext\\Views\\C\\Header\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../../../../Views/C/Helpers', 'Zend\\Ext\\Views\\C\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../../../../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');

        $renderer->setHelperPluginManager($pluginManager);

        $this->renderer = $renderer;
        return $this->renderer;
    }

    function getFilenameExtension() {
        return 'h';
    }

    // -------------------------------------------------------------------

    // put this in ClassGenerator::getAbbr
    protected function getShortName(ObjectGenerator $object, string $ns) {
        $name = $object->getName();

        if('_t'==substr($name, -2))
            $name = substr($name, 0, -2);
        if($name==$ns) {
            return $name;//special case for cairo_t
        }

        $pos = strlen($ns);
        $str = substr($name, 0, $pos);
        if($str==$ns) {
            $name = substr($name, $pos);
            if ('_'==$name[0]) {
                $name = substr($name, 1);
            }
        }
        
        return $name;//str_replace('_', '-', $name);
    }
    
    function createPackageDto(PackageGenerator $package):PackageDto {
        $packageDto = new PackageDto;
        $packageDto->name = $package->getName();
        $packageDto->description = $package->getDescription();
        return $packageDto;
    }
    
    function createClassDto(ClassGenerator $class):ClassDto {
        $classDto = new ClassDto;
        $classDto->name = $class->getName();
        $classDto->description = $class->getDescription();
        $classDto->shortDescription = $class->getShortDescription();
        $classDto->instance = $this->createStructDto($class->getInstance());
        $classDto->vtable = $this->createStructDto($class->getVTable());
        return $classDto;
    }
    
    function createMemberDto(VarGenerator $member):MemberDto {
        $memberDto = new MemberDto;
        $memberDto->name = $member->getName();
        $memberDto->description = $this->getRenderer()->commentHelper($member->getDescription(), '');
        //$memberDto->type = $member->getType()->getName();
        $memberDto->type = $this->getRenderer()->typeHelper($member->getType());
        $memberDto->is_array = $member->isArray();
        if ($member->getType()->isPrototype()) {
            $memberDto->is_prototype = true;
            $memberDto->prototype = $member->getType()->getPrototype();
        }
        /*if ('show'==$member->getName()) {
            var_dump($member);
        }*/
        return $memberDto;
    }
    
    function createConstantDto(ConstantGenerator $constant):ConstantDto {
        $constantDto = new ConstantDto;
        $constantDto->name = $constant->getName();
        $constantDto->description = $this->getRenderer()->commentHelper($constant->getDescription(), '');
        $constantDto->since = $this->encode_version($constant->getSince());
        $constantDto->parent_since = $this->encode_version($constant->getParentGenerator()->getTagSince());

        return $constantDto;
    }
    
    function createUnionDto(UnionGenerator $union):UnionDto {
        $unionDto = new UnionDto;
        $unionDto->name = $union->getName();
        $unionDto->description = $this->getRenderer()->commentHelper($union->getDescription(), '');
        $unionDto->shortDescription = $this->getRenderer()->commentHelper($union->getShortDescription(), '');

        foreach($union->members as $var) {
            $member = $this->createMemberDto($var);
            $unionDto->members[$member->name] = $member;
        }

        //$enumDto->constants[] = ;
        $unionDto->requires = $this->getRequires($union);
        $unionDto->dependencies[] = $this->getFilename($unionDto->name);

        return $unionDto;
    }
    
    function createGroupDto(FileGenerator $file):GroupDto {
        $groupDto = new GroupDto();
        $groupDto->name = $file->getName();
        $groupDto->description = $this->getRenderer()->commentHelper($file->getDescription(), '');
        $groupDto->shortDescription = $this->getRenderer()->commentHelper($file->getShortDescription(), '');

        return $groupDto;
    }

    function createEnumDto(EnumGenerator $enum):EnumDto {
        $enumDto = new EnumDto;
        $enumDto->name = $enum->getName();
        $enumDto->description = $this->getRenderer()->commentHelper($enum->getDescription(), '');
        $enumDto->shortDescription = $this->getRenderer()->commentHelper($enum->getShortDescription(), '');

        foreach($enum->getConstants() as $constant) {
            $constantDto = $this->createConstantDto($constant);
            $enumDto->constants[] = $constantDto;
        }

        $max_length = 0;
        /**
         * @var FileGenerator $fileGenerator
         */
        $fileGenerator = $enum->getParentGenerator();
        $master_name = '';
        $master = $fileGenerator->getMatserObject();
        if ($master) {
            $master_name = $master->getName();
        }
        if ($enum->getName()==$master_name) {
            foreach($fileGenerator->children as $related) {
                if ($related instanceof FunctionGenerator) {
                    $enumDto->methods[] = $this->createFunctionDto($related);
                    $max_length = max($max_length, strlen($related->getName()));
                }
            }
            foreach($enumDto->methods as $method) {
                $method->pad = str_repeat(' ', $max_length-strlen($method->name));
            }
        }

        if (null!=$enum->getTagSince()) {
            $enumDto->since = $this->encode_version($enum->getTagSince());
        }

        //$enumDto->constants[] = ;
        $enumDto->requires = $this->getRequires($enum);
        $enumDto->dependencies[] = $this->getFilename($enumDto->name);

        return $enumDto;
    }

    function createStructDto(StructGenerator $struct):StructDto {
        $structDto = new StructDto;
        $structDto->name = $struct->getName();
        $structDto->description = $this->getRenderer()->commentHelper($struct->getDescription(), '');
        $structDto->shortDescription = $this->getRenderer()->commentHelper($struct->getShortDescription(), '');

        foreach($struct->members as $var) {
            $member = $this->createMemberDto($var);
            $structDto->members[$member->name] = $member;
        }

        $max_length = 0;
        /**
         * @var FileGenerator $fileGenerator
         */
        $fileGenerator = $struct->getParentGenerator();
        $master_name = '';
        $master = $fileGenerator->getMatserObject();
        if ($master) {
            $master_name = $master->getName();
        }
        if ($struct->getName()==$master_name) {
            $fileGenerator = $struct->getParentGenerator();
            foreach($fileGenerator->children as $related) {
                if ($related instanceof FunctionGenerator) {
                    $structDto->methods[] = $this->createFunctionDto($related);
                    $max_length = max($max_length, strlen($related->getName()));
                }
            }
            foreach($structDto->methods as $method) {
                $method->pad = str_repeat(' ', $max_length-strlen($method->name));
            }
    
        }/* else {
            foreach($function->relateds as $related) {
                if ($related instanceof FunctionGenerator) {
                    $methodDto->methods[] = $this->createFunctionDto($related);
                    $max_length = max($max_length, strlen($related->getName()));
                }
            }
        }*/

        foreach($struct->dependencies as $dependecy=>$unused) {
            $structDto->dependencies[] = $this->getFilename($dependecy);
        }
        $structDto->dependencies[] = null;
        $structDto->dependencies[] = $this->getFilename($structDto->name);

        $structDto->requires = $this->getRequires($struct);


        return $structDto;
    }
    protected function getRequires($object) {
        $requires=array();
        $package_name = $object->getOwnPackage()->getOwnPackage()->getName();
        $requires[] = $package_name.'/'.$package_name.'.h';
        return $requires;
    }
    protected function getFilename($object_name) {
        $object = $this->getDocBook()->getPackage()->getSymbol($object_name);

        if ($object) {
            $package_name = $object->getOwnPackage()->getOwnPackage()->getName();
            $package_dir = 'php_'.$package_name;
            //$impl = Implementation::Factory($package_name)->get($objectDto->name);
    
            $short_name = $this->getShortName($object, $package_name);
    
            $filename = str_replace('_', '-', $short_name).'.h';
            
            return $package_dir.'/'.$filename;
        } else {
            echo 'Erreur sur : ' . $object_name . PHP_EOL;
        }
        return null;
    }

    protected function encode_version(string $str_since):int {
        if (empty($str_since)) {
            return 0;
        }
        $parts = explode('.', $str_since);
        $since = 0;
        $coef = [10000, 100, 1];
        foreach($parts as $i=>$part)
            $since += $parts[$i]*$coef[$i];
        return $since;
    }

    function createFunctionDto(FunctionGenerator $function):MethodDto {
        $methodDto = new MethodDto;
        $methodDto->name = $function->getName();
        $methodDto->description = $function->getDescription();
        $methodDto->shortDescription = $function->getShortDescription();
        $methodDto->docblock = $this->getRenderer()->docBlockHelper($function);
        $methodDto->args = $this->getRenderer()->argHelper($function);
        $methodDto->call = $this->getRenderer()->callHelper($function);
        $methodDto->return = $this->getRenderer()->returnHelper($function);
        if (null!=$function->getTagSince()) {
            $methodDto->since = $this->encode_version($function->getTagSince());
        }

        foreach($function->getParameters() as $parameter) {
            $param = new ParameterDto;
            $param->name = $parameter->getName();
            $param->type = $parameter->getType()->getName();
            $param->description = $parameter->getType()->getName();
            $methodDto->parameters[$param->name] = $param;
        }
        return $methodDto;
    }

    function createObjectDto(ObjectGenerator $object):?ObjectDto {
        $rootDto = $this->current_root_dto;
        $packageDto = $this->current_package_dto;
        $subpackageDto = $this->current_subpackage_dto;
        $objectDto = null;
        if ($object instanceof ClassGenerator) {
            $classDto = $this->createClassDto($object);
            $classDto->shortName = $this->getShortName($object, $packageDto->name);
            $rootDto->objects[$object->getName()] = $classDto;
            $objectDto = $classDto;
        } else if ($object instanceof StructGenerator) {
            $methodDto = $this->createStructDto($object);
            //$methodDto->package = $subpackageDto;
            $methodDto->shortName = $this->getShortName($object, $packageDto->name);
            //print_r($methodDto);
            $rootDto->objects[$object->getName()] = $methodDto;
            //$packageDto->objects[$object->getName()] = $methodDto;
            //$subpackageDto->objects[$object->getName()] = $methodDto;
            //$rootDto->master_objects[$object->getName()] = $methodDto;
            //$packageDto->master_objects[$object->getName()] = $methodDto;
            $objectDto = $methodDto;
        } else if ($object instanceof EnumGenerator) {
            $enumDto = $this->createEnumDto($object);
            $enumDto->shortName = $this->getShortName($object, $packageDto->name);
            $rootDto->objects[$object->getName()] = $enumDto;
            $objectDto = $enumDto;
        } else if ($object instanceof UnionGenerator) {
            $unionDto = $this->createUnionDto($object);
            $unionDto->shortName = $this->getShortName($object, $packageDto->name);
            $rootDto->objects[$object->getName()] = $unionDto;
            $objectDto = $unionDto;
        } else if ($object instanceof FunctionGenerator) {
            $functionDto = $this->createFunctionDto($object);
            $functionDto->shortName = $this->getShortName($object, $packageDto->name);
            $rootDto->objects[$object->getName()] = $functionDto;
            $objectDto = $functionDto;
        } else if ($object instanceof ConstantGenerator) {
        } else {
            echo '    Unexpected '.get_class($object). PHP_EOL;
        }
        return $objectDto;
    }

    function getDependencies(FunctionGenerator $root)
    {
    }

    // override: C/H/Php/Xml
    function getPackageDto(PackageGenerator $root)
    {
        $struct_used = array();

        $rootDto = $this->createPackageDto($root);
        $this->current_root_dto = $rootDto;
        foreach ($root->subpackage as $package) {
            $packageDto = $this->createPackageDto($package);
            $packageDto->package = $rootDto;
            $this->current_package_dto = $packageDto;
            foreach ($package->subpackage as $subpackage) {
                $subpackageDto = $this->createPackageDto($subpackage);
                $subpackageDto->package = $packageDto;
                $this->current_subpackage_dto = $subpackageDto;
                foreach ($subpackage->children as $file) {
                    $masterObject = $file->getMatserObject();
                    if (empty($masterObject)) {
                        $groupDto = $this->createGroupDto($file);
                        $groupDto->package = $subpackageDto;
                        $package_name = $groupDto->package->package->name;
                        $name = str_replace(array($package_name.'-', '.xml'), array('', ''), $groupDto->name);
                        $groupDto->name = $package_name.'_'.str_replace('-', '_', $name);
                        $groupDto->shortName = $name;

                        $max_length = 0;
                        foreach ($file->children as $object) {
                            //if ($object instanceof StructGenerator) continue;
                            //if ($object instanceof EnumGenerator) continue;
                            //if ($object instanceof UnionGenerator) continue;
                            if ($object instanceof FunctionGenerator) {
                                $groupDto->methods[] = $this->createFunctionDto($object);
                                $max_length = max($max_length, strlen($object->getName()));
                            }
                        }
                        foreach($groupDto->methods as $method) {
                            $method->pad = str_repeat(' ', $max_length-strlen($method->name));
                        }

                        //$enumDto->constants[] = ;
                        //$unionDto->requires = $this->getRequires($union);
                        //$unionDto->dependencies[] = $this->getFilename($unionDto->name);
                        $rootDto->objects[$file->getName()] = $groupDto;
                        $objectDto = $groupDto;
        
                        $groupDto->package = $subpackageDto;
                    } else {
                        foreach ($file->children as $object) {
                            //if ($object instanceof StructGenerator) continue;
                            //if ($object instanceof EnumGenerator) continue;
                            //if ($object instanceof UnionGenerator) continue;
                            if ($object instanceof FunctionGenerator) {
                                if ($object->isClassified) {
                                    //echo '+'.$object->getName().PHP_EOL;
                                } else {
                                    //echo '-'.$object->getName().PHP_EOL;
                                }
                                continue;
                            }
                            $objectDto = $this->createObjectDto($object);
                            $objectDto->package = $subpackageDto;
                        }
                    }
                }
            }
        }
        return $rootDto;
    }


    function saveXX($dir):bool
    {
        $package = $this->getDocBook()->getPackage();//refactor getPackage
        $rootDto = $this->getPackageDto($package);

        foreach ($rootDto->objects as $objectDto) {
            if(! ($objectDto instanceof GroupDto)
            ) {
                continue;
            }

            $package_name = $objectDto->package->package->name;
            $package_dir = 'php_'.$package_name;

            $viewModel = $this->getViewModel($objectDto);
            $output = $this->render($viewModel);
            $filename = str_replace('_', '-', $objectDto->shortName).'.'.$this->getFilenameExtension();
            $path = "$dir/$package_dir";

            `mkdir -p $path`;
            file_put_contents($path.'/'.$filename, $output);

        }

        return true;
    }

}
