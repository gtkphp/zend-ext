<?php

namespace Zend\Ext\Services\CodeGenerator\Xml;

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


class DocGenerator extends GlibGenerator
{

    function getViewModel($dto):ViewModel
    {
        $model = new ViewModel();
        $model->setVariables((array)$dto);
        $model->setVariable("vendor", 'Gnome\\\\');
        $model->setTemplate('class.phtml');

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
        $pluginManager->addPathHelper(__DIR__.'/../../../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');

        $renderer->setHelperPluginManager($pluginManager);

        $this->renderer = $renderer;

        return $this->renderer;
    }
    
    function getFilenameExtension() {
        return 'xml';
    }

    // getExtension();
    // getHeaderExtension();
    function make_lookup(ClassDto $dto) {
        return '';
    }

}