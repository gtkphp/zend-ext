<?php

namespace Zend\Ext\Services;


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

use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;
use Zend\Ext\Views\C\Header\Helpers\TypeHelper;// <------- TODO: move file
use Zend\Ext\Views\C\Source\Helpers\DocBlockHelper;
//use Zend\Ext\Views\C\Source\ClassDto;

use Zend\Ext\Views\C\Source\MethodDto;
//use Zend\Ext\Views\C\ParameterDto;
use Zend\Ext\Views\C\PropertyDto;
use Zend\Ext\Views\ObjectDto;

use Zend\Ext\Views\PackageDto;
use Zend\Ext\Views\ClassDto;
use Zend\Ext\Views\StructDto;
use Zend\Ext\Views\MemberDto;
use Zend\Ext\Views\ParameterDto;
use Zend\Ext\Views\EnumDto;
use Zend\Ext\Views\ConstantDto;
use Zend\Ext\Views\UnionDto;
use Zend\Ext\Views\VarDto;

use Zend\ExtGtk\Implementation;

/*
use Zend\Ext\Helpers\Php\Pp\NamemethodHelper as NamemethodHelperPhpPp;
use Zend\Ext\Helpers\Php\Pp\TypeHelper as TypeHelperPhpPp;
use Zend\Ext\Helpers\Php\Pp\NameclassHelper as NameclassHelperPhpPp;

use Zend\Ext\Helpers\C\NameclassHelper as NameclassHelperC;
use Zend\Ext\Helpers\C\ReturntypeHelper as ReturntypeHelperC;
use Zend\Ext\Helpers\C\MaxargHelper as MaxargHelperC;
use Zend\Ext\Helpers\C\RequiredargHelper as RequiredargHelperC;
*/

use Zend\Ext\Services\DocBook;

use Zend\Filter\FilterChain;
use Zend\Filter\StripTags;
use Zend\Filter\StringToLower;
use Zend\Filter\StringToUpper;
use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\Filter\Word\CamelCaseToDash;

use Zend\ServiceManager\ServiceManager;

use Zend\Ext\Views\HelperPluginManager;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\View;

class CodeGenerator
{
    /**
     * @var string $name
     */
    protected $name;
    /**
     * @var DocBook $docBook
     */
    protected $docBook;
    /**
     * @var  PhpRenderer $renderer
     */
    protected $renderer;

    function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CodeGenerator
     */
    public function setName(string $name): CodeGenerator
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return DocBook
     */
    public function getDocBook(): DocBook
    {
        return $this->docBook;
    }

    /**
     * @param DocBook $docBook
     * @return CodeGenerator
     */
    public function setDocBook(DocBook $docBook): CodeGenerator
    {
        $this->docBook = $docBook;
        return $this;
    }

    function render($model)
    {
        $view = $this->getView();

        $view->render($model);
        return $view->getResponse()->getContent();
    }

    function getView():View
    {
        $view = new View();
        $view->setResponse(new Response());


        $rendererStrategy = new PhpRendererStrategy($this->getRenderer());
        $rendererStrategy->attach($view->getEventManager());

        return $view;
    }

    function getRenderer():RendererInterface
    {
        $this->renderer = new PhpRenderer();

        return $this->renderer;
    }

    function getViewModel($dto):ViewModel
    {
        $model = new ViewModel();
        $model->setVariables((array)$dto);

        return $model;
    }


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

    function createStructDto(StructGenerator $function):StructDto {
        $methodDto = new StructDto;
        $methodDto->name = $function->getName();
        $methodDto->description = $this->getRenderer()->commentHelper($function->getDescription(), '');
        $methodDto->shortDescription = $this->getRenderer()->commentHelper($function->getShortDescription(), '');

        foreach($function->members as $var) {
            $member = $this->createMemberDto($var);
            $methodDto->members[$member->name] = $member;
        }

        $max_length = 0;
        $fileGenerator = $function->getParentGenerator();
        $master_name = '';
        $master = $fileGenerator->getMatserObject();
        if ($master) {
            $master_name = $master->getName();
        }
        if ($function->getName()==$master_name) {
            $fileGenerator = $function->getParentGenerator();
            foreach($fileGenerator->children as $related) {
                if ($related instanceof FunctionGenerator) {
                    $methodDto->methods[] = $this->createFunctionDto($related);
                    $max_length = max($max_length, strlen($related->getName()));
                }
            }
            foreach($methodDto->methods as $method) {
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

        foreach($function->dependencies as $dependecy=>$unused) {
            $methodDto->dependencies[] = $this->getFilename($dependecy);
        }
        $methodDto->dependencies[] = null;
        $methodDto->dependencies[] = $this->getFilename($methodDto->name);

        $methodDto->requires = $this->getRequires($function);


        return $methodDto;
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
                    foreach ($file->children as $object) {
                        //if ($object instanceof StructGenerator) continue;
                        //if ($object instanceof EnumGenerator) continue;
                        //if ($object instanceof UnionGenerator) continue;
                        if ($object instanceof FunctionGenerator) continue;
                        $objectDto = $this->createObjectDto($object);
                        $objectDto->package = $subpackageDto;
                    }
                }
            }
        }
        return $rootDto;
    }

    // -------------------------------------------------------------------

    function getFilenameExtension() {
        return 'c';
    }


    protected function isDependency($type, $package) {
        $name = $type->getName();
        $object = $package->getSymbol($name);
        if (isset($object)) {
            return true;
        }
        return false;
    }

    protected function placeholderDependencies(ObjectGenerator $object) {
        $types = [];// array(''=>'php_cairo/path.h')

        

        return $types;
    }

    // -------------------------------------------------------------------

    /**
     * @param string $dir
     */
    function save($dir):bool
    {
        $package = $this->getDocBook()->getPackage();//refactor getPackage

        $rootDto = $this->getPackageDto($package);

        foreach ($rootDto->objects as $objectDto) {
            if(! $objectDto instanceof EnumDto) {
                continue;
            }

            if (
                  'cairo_status_t'!=$objectDto->name
            //&&  'cairo_rectangle_t'!=$objectDto->name
            //&&  'cairo_status_t'!=$objectDto->name
            //&&  'cairo_glyph_t'!=$objectDto->name
            //&&  'cairo_path_data_type_t'!=$objectDto->name
            //&&  'cairo_path_data_t'!=$objectDto->name
            //&&  'cairo_path_t'!=$objectDto->name
            //&& 'cairo_matrix_t'!=$objectDto->name
            //&& 'cairo_t'!=$objectDto->name
            ) {
                continue;
            }

            echo '=>' . $objectDto->name . PHP_EOL;
            
        /*
        if (
                'GtkWidget'!=$objectDto->name
          ) {
              continue;
        }*/


// TODO les fonction related a cairo_status_t
// TODO /home/dev/Projets/zend-ext/lib/Services/CodeGenerator.php:368

            $package_name = $objectDto->package->package->name;
            $package_dir = 'php_'.$package_name;

            $viewModel = $this->getViewModel($objectDto);
            $output = $this->render($viewModel);
            $filename = str_replace('_', '-', $objectDto->shortName).'.'.$this->getFilenameExtension();
            $path = "$dir/$package_dir";

            `mkdir -p $path`;
            file_put_contents($path.'/'.$filename, $output);
        }

        return True;
    }


    /**
     * @param string $id 'C/Glib'
     *                   | 'Php/Api/Glib'
     *                   | 'Php/Wrapper/Glib'
     *                   | 'Xml/Glib' 
     */
    static public function Factory($id, $options)
    {
        $path = __DIR__.'/'.$id.'Generator.php';
        $class = 'Zend\\Ext\\Services\\CodeGenerator\\' . str_replace('/', '\\', $id) . 'Generator';
        $generator = new $class($options);
        return $generator;
    }

}


