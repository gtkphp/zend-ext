<?php

namespace Zend\Ext\Services\CodeGenerator\Php;

use Zend\Ext\Services\CodeGenerator\C\Source\GlibGenerator;


use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\View;
use Zend\Ext\Views\HelperPluginManager;

use Zend\Ext\Views\C\Source\ClassDto;
use Zend\Ext\Views\C\Source\MethodDto;
use Zend\Ext\Views\C\EnumDto;
use Zend\Ext\Views\C\ParameterDto;


class PpGenerator extends GlibGenerator
{
    function getViewModel($dto):ViewModel
    {
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', '31/12/1999');
        $licenseModel->setTemplate('license.phtml');

        $model = parent::getViewModel((array)$dto);
        $model->addChild($licenseModel, 'license');
        $model->setTemplate('class.phtml');

        return $model;
    }


    function getRenderer():RendererInterface
    {
        if ($this->renderer) {
            return $this->renderer;
        }
        
        $resolver = new TemplatePathStack();

        $resolver->addPath(__DIR__.'/../../../Views/Php/Pp');
        $resolver->addPath(__DIR__.'/../../../Views/Php');
        $resolver->addPath(__DIR__.'/../../../Views');

        $renderer = new PhpRenderer();
        $renderer->setResolver($resolver);

        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        $pluginManager->addPathHelper(__DIR__.'/../../../Views/Php/Pp/Helpers', 'Zend\\Ext\\Views\\Php\\Pp\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../../../Views/Php/Helpers', 'Zend\\Ext\\Views\\Php\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../../../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');

        $renderer->setHelperPluginManager($pluginManager);

        $this->renderer = $renderer;

        return $this->renderer;
    }

    function getFilenameExtension() {
        return 'php';
    }

    // getExtension();
    // getHeaderExtension();
    function make_lookup(ClassDto $dto) {
        return '';
    }

}