<?php

namespace Zend\Ext\Services\CodeGenerator;

use Zend\Filter\FilterChain;
use Zend\Filter\StripTags;
use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\View;
/*
use Zend\Ext\Helpers\Php\Poo\CommentHelper;
use Zend\Ext\Helpers\Php\Poo\MethodHelper;
use Zend\Ext\Helpers\Php\Poo\NameclassHelper;
use Zend\Ext\Helpers\Php\Poo\NamemethodHelper;
use Zend\Ext\Helpers\Php\Poo\NamepropertyHelper;
use Zend\Ext\Helpers\Php\Poo\NamespaceHelper;
use Zend\Ext\Helpers\Php\Poo\ParameterHelper;
use Zend\Ext\Helpers\Php\Poo\TypeHelper;
*/

use Zend\Ext\Models\PackageGenerator;

use Zend\Ext\Services\CodeGenerator;

class Php8 extends CodeGenerator
{

    function __construct($style=CodeGenerator::PP_STYLE)
    {
        parent::__construct("php8");
        $this->setStyle($style);
    }

    // Controller::Action
    function render($package)
    {
        $view = $this->getView();
        $model = $this->getViewModel($package);

        $view->render($model);
        //$this->getCode();
        //$this->getStyle();
        return $view->getResponse()->getContent();
    }

    function getViewModel(PackageGenerator $package):ViewModel
    {
        $objects = $package->getListTypeObject();
        $class = array_pop($objects);

        // <?php echo $this->author
        // <?php echo $this->date
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', '31/12/1999');
        $licenseModel->setTemplate('license.phtml');

        // <?php echo $this->license
        // <?php echo $this->message
        $model = new ViewModel();
        $model->setVariable('class', $class);
        $model->setVariable('name', $class->getName());
        $model->setVariable('description', $class->getDescription());
        $model->setVariable('methods', $class->getMethods());
        $model->setVariable("vendor", 'Gnome\\\\');
        //$model->setVariable("vendor", '');
        $model->addChild($licenseModel, 'license');
        $model->setTemplate('class.phtml');

        return $model;
    }
    function getView():View
    {
        $map = array(0=>'Unknown', 1=>'Pp', 2=>'Poo');
        $map_style = array(3=>'Header', 4=>'Source');

        $view = new View();
        $view->setResponse(new Response());

        $resolver = new TemplatePathStack();

        if (self::C_CODE==$this->code) {
            $resolver->addPath(__DIR__.'/../../Views/C/Header');
            $resolver->addPath(__DIR__.'/../../Views/C/'.$map_style[$this->style]);
        } else if (self::XML_CODE==$this->code) {
            $resolver->addPath(__DIR__.'/../../Views/DocBook');
        } else {
            $resolver->addPath(__DIR__.'/../../Views/Php/'.$map[$this->style]);
        }

        $renderer = new PhpRenderer();
        $renderer->setResolver($resolver);

        $rendererStrategy = new PhpRendererStrategy($renderer);
        $rendererStrategy->attach($view->getEventManager());

        /*$view->addResponseStrategy(function ($event) {
            $event->getResponse()->setContent($event->getResult());
        });
        $view->addRenderingStrategy(function ($event) {
            echo "Here we are\n";
            $view = $event->getView();
            $pluginManager = $view->getHelperPluginManager();
            var_dump($event);
            return $renderer;
        });*/
        if (self::C_CODE==$this->code) {
            $renderer->setHelperPluginManager($this->cStyleManager());
        } else if (self::XML_CODE==$this->code) {
            $renderer->setHelperPluginManager($this->xmlStyleManager());
        } else if ($this->style==self::PP_STYLE) {
            // PHP_CODE / PP_STYLE
            $renderer->setHelperPluginManager($this->phpPpStyleManager());
        } else {
            // PHP_CODE / POO_STYLE
            $renderer->setHelperPluginManager($this->phpPooStyleManager());
        }

        return $view;
    }

}
