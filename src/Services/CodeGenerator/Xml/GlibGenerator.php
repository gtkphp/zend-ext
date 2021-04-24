<?php

namespace Zend\Ext\Services\CodeGenerator\Xml;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;
use Zend\Ext\Services\DocBook;
use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Views\HelperPluginManager;
use Zend\Ext\Views\DocBook\ClassDto;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\View;
use Zend\Ext\Views\Helpers\NamespaceHelper;
use Zend\C\Parser;

class GlibGenerator extends CodeGenerator
{

    function __construct($name)
    {
        parent::__construct($name);

        $src_dir = '/home/dev/Projects/glib';
        $build_dir = '/home/dev/Projects/glib-build-doc';
        $sourceCode = new GlibSourceCode($src_dir, $build_dir);
        // TODO: Injection dependency
        //$parser = new Parser();
        //$sourceCode->setParser($parser);

        $docBook = new GlibDocBook();
        $docBook->addSourceCode($sourceCode);

        $this->setDocBook($docBook);

        $sourceCode->addBlackList(array('STRUCT'=>array('utimbuf')));
        $sourceCode->loadTypes();
        //$docBook->load(/*doc.sgml*/);
        //echo $docBook->save('/home/dev/Projects/gtkphp/output');
    }

    // Controller::Action
    function save($dir):bool
    {
        $package = $this->getDocBook()->load();
        $objects = $package->getListObject();
        foreach ($objects as $objectName) {
            $generatorModel = $package->getObject($objectName);//'GList'
            $dto = $this->getClassDto($generatorModel, 'GList');
            $viewModel = $this->getViewModel($dto);
            echo $this->render($viewModel);
        }
        return True;
    }

    function getClassDto(ClassGenerator $generator, $name)
    {
        $extractNamespace = new NamespaceHelper();

        $dto = new ClassDto();
        $dto->name = 'Doubly-Linked Lists';
        $dto->class_name = $generator->getName();
        $dto->id = strtolower($dto->class_name);
        $dto->ns_id = $extractNamespace($dto->class_name, -1);
        $dto->description = $generator->getDescription();
        $dto->interfaces[] = 'GtkBuildable';
        return $dto;
    }
    function render($model)
    {
        $view = $this->getView();

        $view->render($model);
        return $view->getResponse()->getContent();
    }

    function getViewModel($dto):ViewModel
    {
        $model = new ViewModel();
        $model->setVariables((array)$dto);
        $model->setVariable("vendor", 'Gnome\\\\');
        $model->setTemplate('class.phtml');

        return $model;
    }
    function getView():View
    {
        $view = new View();
        $view->setResponse(new Response());

        $resolver = new TemplatePathStack();
        $resolver->addPath(__DIR__.'/../../../Views/DocBook');

        $renderer = new PhpRenderer();
        $renderer->setResolver($resolver);

        $rendererStrategy = new PhpRendererStrategy($renderer);
        $rendererStrategy->attach($view->getEventManager());

        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        $pluginManager->addPathHelper(__DIR__.'/../../../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');
        $renderer->setHelperPluginManager($pluginManager);

        return $view;
    }

}