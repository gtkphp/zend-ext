<?php

namespace Zend\Ext\Services\CodeGenerator\C\Header;

use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;

use Zend\Ext\Views\HelperPluginManager;
use Zend\Ext\Views\C\Header\Helpers\TypeHelper;
use Zend\Ext\Views\C\ClassDto;
use Zend\Ext\Views\C\VTableDto;
use Zend\Ext\Views\C\MethodDto;
use Zend\Ext\Views\C\ParameterDto;
use Zend\Ext\Views\EnumDto;
use Zend\Ext\Views\UnionDto;
use Zend\Ext\Views\StructDto;

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

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\EnumGenerator;

use Zend\Ext\Services\CodeGenerator;

use Zend\ExtGtk\Implementation;


class GlibGenerator extends CodeGenerator
{
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
        return null;
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

    function getViewModelUnion($dto):ViewModel
    {
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', '31/12/1999');
        $licenseModel->setTemplate('license.phtml');

        $classModel = new ViewModel((array)$dto);
        $classModel->setTemplate('union.phtml');

        $model = parent::getViewModel(array());
        $model->setVariable('objects', array($dto));
        $model->addChild($licenseModel, 'license');
        $model->addChild($classModel, 'class');
        $model->setTemplate('file.phtml');

        return $model;
    }

    function getViewModelEnum($dto):ViewModel
    {
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', '31/12/1999');
        $licenseModel->setTemplate('license.phtml');

        $classModel = new ViewModel((array)$dto);
        $classModel->setTemplate('enum.phtml');

        $model = parent::getViewModel(array());
        $model->setVariable('objects', array($dto));
        $model->addChild($licenseModel, 'license');
        $model->addChild($classModel, 'class');
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

}
