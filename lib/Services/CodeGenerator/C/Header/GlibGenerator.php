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
use Zend\Ext\Views\C\EnumDto;

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
use function Webmozart\Assert\Tests\StaticAnalysis\maxLength;

class GlibGenerator extends CodeGenerator
{
    function __construct($name)
    {
        parent::__construct($name);
    }

    function getViewModel($dto):ViewModel
    {
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', '31/12/1999');
        $licenseModel->setTemplate('license.phtml');

        $classModel = new ViewModel((array)$dto);
        $classModel->setTemplate('class.phtml');

        $model = parent::getViewModel((array)$dto);
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

        $model = parent::getViewModel((array)$dto);
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

        $resolver->addPath(__DIR__.'/../../../../Views/C/Header');
        $resolver->addPath(__DIR__.'/../../../../Views/C');
        $resolver->addPath(__DIR__.'/../../../../Views');

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
