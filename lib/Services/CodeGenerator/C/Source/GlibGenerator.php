<?php

namespace Zend\Ext\Services\CodeGenerator\C\Source;

use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\EnumGenerator;
use Zend\Ext\Services\CodeGenerator;

use Zend\ServiceManager\ServiceManager;
use Zend\Ext\Views\HelperPluginManager;

use Zend\Ext\Views\C\Source\ClassDto;
use Zend\Ext\Views\C\Source\MethodDto;
use Zend\Ext\Views\StructDto;
use Zend\Ext\Views\EnumDto;
use Zend\Ext\Views\UnionDto;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\View;

use Zend\ExtGtk\Implementation;

class GlibGenerator extends CodeGenerator
{
    protected $renderer;

    function __construct($name)
    {
        parent::__construct($name);
    }

    function getViewModel($dto):ViewModel
    {
        if ($dto instanceof StructDto) {
            return $this->getViewModelStruct($dto);
        }
        if ($dto instanceof EnumDto) {
            return $this->getViewModelEnum($dto);
        }
        if ($dto instanceof UnionDto) {
            return $this->getViewModelUnion($dto);
        }
        /*
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', '31/12/1999');
        $licenseModel->setTemplate('license.phtml');

        $model = parent::getViewModel((array)$dto);
        $model->addChild($licenseModel, 'license');
        $model->setTemplate('class.phtml');

        return $model;
        */
    }
    
    function getViewModelUnion($dto):ViewModel
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

    function getViewModelEnum($dto):ViewModel
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

    function getViewModelStruct($dto):ViewModel
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
        $resolver->addPath(__DIR__.'/../../../../Views/C/Source');

        $renderer = new PhpRenderer();
        $renderer->setResolver($resolver);

        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        $pluginManager->addPathHelper(__DIR__.'/../../../../Views/C/Source/Helpers', 'Zend\\Ext\\Views\\C\\Source\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../../../../Views/C/Helpers', 'Zend\\Ext\\Views\\C\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../../../../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');

        $renderer->setHelperPluginManager($pluginManager);

        $this->renderer = $renderer;

        return $this->renderer;
    }

    protected function placeholderArgs(MethodDto $methodDto, MethodGenerator $method) {
        $methodDto->args = $this->getRenderer()->argHelper($method);
        $methodDto->call = $this->getRenderer()->callHelper($method);
        $methodDto->return = '';//$this->getRenderer()->returnHelper($method);
    }

    function make_lookup(ClassDto $dto):string {
        $output = '';
        $num = count($dto->properties);
        if (False && $num>5) {
            $gperfModel = new ViewModel((array)$dto);
            $gperfModel->setTemplate('gperf.phtml');
        
            $output = $this->render($gperfModel);
        } else {
            $binaryModel = new ViewModel((array)$dto);
            $binaryModel->setTemplate('binarysearch.phtml');
        
            $output = $this->render($binaryModel);
        }

        //file_put_contents(__DIR__.'/../../../../tmp/properties.gperf', $output);
        return $output;
    }
    
    function getFilenameExtension() {
        return 'c';
    }
}