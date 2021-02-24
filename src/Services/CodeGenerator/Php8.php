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
use Zend\Ext\Helpers\Php\Poo\CommentHelper;
use Zend\Ext\Helpers\Php\Poo\MethodHelper;
use Zend\Ext\Helpers\Php\Poo\NameclassHelper;
use Zend\Ext\Helpers\Php\Poo\NamemethodHelper;
use Zend\Ext\Helpers\Php\Poo\NamepropertyHelper;
use Zend\Ext\Helpers\Php\Poo\NamespaceHelper;
use Zend\Ext\Helpers\Php\Poo\ParameterHelper;
use Zend\Ext\Helpers\Php\Poo\TypeHelper;

use Zend\Ext\Models\PackageGenerator;

use Zend\Ext\Services\CodeGenerator;

class Php8 extends CodeGenerator
{
    function __construct()
    {
        parent::__construct("php8");
    }

    function render($package)
    {
        $view = $this->getView();
        $model = $this->getViewModel($package);

        $view->render($model);
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
        $licenseModel->setTemplate('method.phtml');

        // <?php echo $this->license
        // <?php echo $this->message
        $model = new ViewModel();
        $model->setVariable('name', $class->getName());
        $model->setVariable('description', $class->getDescription());
        $model->setVariable('methods', $class->getMethods());
        //$model->addChild($licenseModel, 'licenseHeader');
        $model->setTemplate('class.phtml');

        return $model;
    }
    function getView():View
    {
        $view = new View();
        $view->setResponse(new Response());

        $resolver = new TemplatePathStack();
        $resolver->addPath(__DIR__.'/../../Views/Php/Poo');

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
        $pluginManager = $renderer->getHelperPluginManager();

        $pluginManager->setFactory('namespaceHelper', function ($pluginManager) {
            $filter = new CamelCaseToUnderscore;
            NamespaceHelper::$filter = $filter;
            $namespaceHelper = new NamespaceHelper;
            return $namespaceHelper;
        });
        $pluginManager->setFactory('commentHelper', function ($pluginManager) {
            //$filter = new StripTags;
            $filter = new FilterChain();
            $filter->attach(new StripTags());
            //       ->attach(new StripNewlines());
            CommentHelper::$filter = $filter;
            return new CommentHelper;
        });
        $pluginManager->setFactory('nameclassHelper', function ($pluginManager) {
            NameclassHelper::$filter = new CamelCaseToUnderscore;
            return new NameclassHelper;
        });
        $pluginManager->setFactory('methodHelper', function ($pluginManager) {
            return new MethodHelper;
        });
        $pluginManager->setFactory('namemethodHelper', function ($pluginManager) {
            NamemethodHelper::$filter = new CamelCaseToUnderscore;
            return new NamemethodHelper;
        });
        $pluginManager->setFactory('typeHelper', function ($pluginManager) {
            return new TypeHelper;
        });
        $pluginManager->setFactory('parameterHelper', function ($pluginManager) {
            return new ParameterHelper;
        });
        $pluginManager->setFactory('namepropertyHelper', function ($pluginManager) {
            return new NamepropertyHelper;
        });

        return $view;
    }

}
