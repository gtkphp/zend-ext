<?php

namespace Zend\Ext\Services\CodeGenerator\Xml;

use Zend\Ext\Services\CodeGenerator;

use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\View;
use Zend\Ext\Views\HelperPluginManager;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\FunctionGenerator;
use Zend\Ext\Models\EnumGenerator;

use Zend\Ext\Views\PackageDto;
use Zend\Ext\Views\GroupDto;
use Zend\Ext\Views\ClassDto;
use Zend\Ext\Views\StructDto;
use Zend\Ext\Views\MemberDto;
use Zend\Ext\Views\MethodDto;
use Zend\Ext\Views\ParameterDto;
use Zend\Ext\Views\EnumDto;
use Zend\Ext\Views\ConstantDto;
use Zend\Ext\Views\UnionDto;
use Zend\Ext\Views\VarDto;

use Zend\ExtGtk\Implementation;

class DocGenerator extends CodeGenerator
{

    function getViewModel($dto):ViewModel
    {
        if ($dto instanceof ClassDto) {

        } else if ($dto instanceof StructDto) {
            /*
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
            */
        } else if ($dto instanceof MethodDto) {
            $model = parent::getViewModel(array());
            $model->setVariable('object', $dto);
            $model->setTemplate('file.phtml');
            return $model;
        } else if ($dto instanceof UnionDto) {

        } else if ($dto instanceof PackageDto) {
            $model = parent::getViewModel($dto);
            $model->setTemplate('constants.phtml');
            return $model;
        } else if ($dto instanceof EnumDto) {
            //return $this->getViewModelEnum($dto);

        } else if ($dto instanceof GroupDto) {

        } else {
            echo 'Unknown '.get_class($dto).PHP_EOL;
        }
        return null;
    }

    function getViewModelEnum($dto):ViewModel
    {
        /*
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', date("m/d/y"));
        $licenseModel->setVariable('php_version', Implementation::$version);
        $licenseModel->setTemplate('license.phtml');
        */

        /*
        $marksModel = new ViewModel();
        $marksModel->setTemplate('vim-marks.phtml');
        */

        $model = parent::getViewModel(array());
        $model->setVariable('objects', array($dto));
        //$model->addChild($licenseModel, 'license');
        //$model->addChild($marksModel, 'vimMarks');
        $model->setTemplate('constants.phtml');
        return $model;
    }

    function getRenderer():RendererInterface
    {
        if ($this->renderer) {
            return $this->renderer;
        }
        
        $resolver = new TemplatePathStack();

        $resolver->addPath(__DIR__.'/../../../Views/DocBook');

        $renderer = new PhpRenderer();
        $renderer->setResolver($resolver);

        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        // Notice: order is correct
        $pluginManager->addPathHelper(__DIR__.'/../../../Views/DocBook/Helpers', 'Zend\\Ext\\Views\\DocBook\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../../../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');

        $renderer->setHelperPluginManager($pluginManager);

        $this->renderer = $renderer;

        return $this->renderer;
    }
    
    function getFilenameExtension() {
        return 'xml';
    }

    protected function saveConstants($dir) {
        $package = $this->getDocBook()->getPackage();//refactor getPackage

        $rootDto = $this->getPackageDto($package);

        foreach ($rootDto->subpackage as $packageDto) {
            //echo '=>' . $packageDto->name . PHP_EOL;
            $pkgDto = new PackageDto;
            $pkgDto->name = $packageDto->name;
            $pkgDto->description = $packageDto->description;
            $pkgDto->objects = [];
    
            foreach ($packageDto->subpackage as $subpackageDto) {
                foreach ($subpackageDto->objects as $objectDto) {
                    if ($objectDto instanceof EnumDto) {
                        //echo '   -->' . $objectDto->name . PHP_EOL;
                        $pkgDto->objects[] = $objectDto;
                    }
                }
            }
            $viewModel = $this->getViewModel($pkgDto);
            $package_dir = 'php_'.$packageDto->name;

            $output = $this->render($viewModel);
            $filename = 'constants'.'.'.$this->getFilenameExtension();
            $path = "$dir/$package_dir";

            `mkdir -p $path`;
            file_put_contents($path.'/'.$filename, $output);
        }

    }
    /**
     * @param string $dir
     */
    function save($dir):bool
    {
        //$this->saveConstants($dir);


        $package = $this->getDocBook()->getPackage();//refactor getPackage

        $rootDto = $this->getPackageDto($package);

        $first = true;

        foreach ($rootDto->subpackage as $packageDto) {

            //echo '=>' . $packageDto->name . PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;

            foreach ($packageDto->subpackage as $subpackageDto) {
                // Drawing
echo '  '.$subpackageDto->name . PHP_EOL;
echo '  ----------------------' . PHP_EOL;
                foreach ($subpackageDto->objects as $objectDto) {
                    if ($objectDto instanceof StructDto) {
                        //echo '   -->' . $objectDto->name . PHP_EOL;
                        foreach ($objectDto->methods as $methodDto) {
                            if ($first) {
                                $methodDto->package = $objectDto->package;
                                $viewModel = $this->getViewModel($methodDto);
                                //$package_dir = 'php_'.$packageDto->name;
                                $package_dir = $packageDto->name;
                                
                                $output = $this->render($viewModel);
                                $filename = str_replace('_', '-', $methodDto->name);
echo '  &reference.gtk.cairo.functions.'.$filename.';' . PHP_EOL;
                                $filename = $filename.'.'.$this->getFilenameExtension();
                                $path = "$dir/$package_dir/functions/";
                                `mkdir -p $path`;
                                file_put_contents($path.'/'.$filename, $output);

                                //$first = false;
                            }
                        }
                    }
                }
            }
            /*
            $viewModel = $this->getViewModel($pkgDto);
            $package_dir = 'php_'.$packageDto->name;

            $output = $this->render($viewModel);
            $filename = 'constants'.'.'.$this->getFilenameExtension();
            $path = "$dir/$package_dir";

            `mkdir -p $path`;
            file_put_contents($path.'/'.$filename, $output);
            */

            //$packageDto->objects;
            /*
            if(! ($objectDto instanceof EnumDto)
            ) {
                continue;
            }

            echo '=>' . $objectDto->name . PHP_EOL;
            
            $package_name = $objectDto->package->package->name;
            $package_dir = 'php_'.$package_name;

            $viewModel = $this->getViewModel($objectDto);
            if(empty($viewModel)){ echo "TODO: ".$objectDto->name."\n"; continue;}
            $output = $this->render($viewModel);
            $filename = str_replace('_', '-', $objectDto->shortName).'.'.$this->getFilenameExtension();
            $path = "$dir/$package_dir";

            `mkdir -p $path`;
            file_put_contents($path.'/'.$filename, $output);
            */
        }

        return True;
    }

}