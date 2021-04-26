<?php

namespace Zend\Ext\Services\CodeGenerator\C\Source;

use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;
use Zend\Ext\Views\C\Header\Helpers\TypeHelper;// <------- TODO: move file
use Zend\Ext\Views\C\Source\Helpers\DocBlockHelper;
use Zend\Ext\Views\C\Source\ClassDto;
use Zend\Ext\Views\C\Source\MethodDto;
use Zend\Ext\Views\C\ParameterDto;
use Zend\Ext\Views\HelperPluginManager;
use Zend\Filter\FilterChain;
use Zend\Filter\StringToLower;
use Zend\Filter\StringToUpper;
use Zend\Filter\Word\CamelCaseToDash;
use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\View;

class GlibGenerator extends CodeGenerator
{
    protected $renderer;

    function __construct($name)
    {
        parent::__construct($name);
        /*
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
        */
        //print_r(array_keys($sourceCode->data['STRUCT']));
        //print_r($sourceCode->getStruct('GArray'));
    }

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

        $resolver->addPath(__DIR__.'/../../../../Views/C/Source');
        $resolver->addPath(__DIR__.'/../../../../Views/C');
        $resolver->addPath(__DIR__.'/../../../../Views');

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

    function getClassDto(ClassGenerator $generator)
    {
        $helper = new TypeHelper();
        $helper->setView($this->getRenderer());
        $protoHelper = new DocBlockHelper();
        $protoHelper->setView($this->getRenderer());

        // TODO: use Helper
        $filter = new FilterChain();
        $filter->attach(new CamelCaseToDash());
        $filter->attach(new StringToLower());

        $filter2 = new FilterChain();
        $filter2->attach(new CamelCaseToUnderscore());
        $filter2->attach(new StringToLower());

        $filter3 = new FilterChain();
        $filter3->attach(new CamelCaseToUnderscore());
        $filter3->attach(new StringToUpper());

        $name = $generator->getName();


        $dto = new ClassDto();
        $dto->name = $generator->getName();
        $dto->abbr = $generator->getAbbr();
        $dto->extend = $generator->getExtendedClass();
        $dto->fileName = $filter->filter($name) . '.c';
        $dto->nameMacro = $filter3->filter($name);
        $dto->nameFunction = $filter2->filter($name);
        $dto->nameType = $name;
        $dto->headerFile = $filter->filter($name) . '.h';
        $dto->properties = array();
        $properties = $generator->getProperties();
        foreach($properties as $property) {
            $dto->properties[$property->getName()] = $helper($property->getType(), '');
        }
        $dto->methods = array();
        $max_length=0;
        $methods = $generator->getMethods();
        foreach($methods as $method) {
            $methodDto = new MethodDto();
            $methodDto->generator = $method;
            $methodDto->name = $method->getName();
            $methodDto->type = $helper($method->getType(), '*');
            $methodDto->max_parameters = count($method->getParameters());
            $methodDto->min_parameters = count($method->getParameters());//TODO
            $methodDto->parameters = array();
            foreach($method->getParameters() as $parameter) {
                $parameterDto = new ParameterDto();
                $parameterDto->name = $parameter->getName();
                $parameterDto->type = $helper($parameter->getType(), '*');

                $methodDto->parameters[] = $parameterDto;
            }
            $methodDto->docblock = $protoHelper($method);

            $max_length = max($max_length, strlen($methodDto->name));
            $dto->methods[$method->getName()] = $methodDto;
        }
        foreach($dto->methods as $method) {
            $method->pad = str_repeat(' ', $max_length-strlen($method->name));
        }

        $dto->vtable = $this->getVtableDto($generator);
        $dto->parent = $this->getParentClassDto($generator);

        return $dto;
    }

    function getVtableDto(ClassGenerator $generator)
    {
        $vtableDto = null;

        $methods = [];
        $vtable = $generator->getVTable();
        if ($vtable) {
            $vtableDto = new ClassDto();
            $vtableDto->name = $vtable->getName();
            $vtableDto->abbr = $vtable->getAbbr();
            $vtableDto->extend = $vtable->getExtendedClass();
            //$vtableDto->parent = $this->getParentClassDto($generator);

            $methods = $vtable->getMethods();
        }
        foreach($methods as $method) {
            $methodDto = $this->getMethodDto($method);
            $vtableDto->methods[$method->getName()] = $methodDto;
        }

        return $vtableDto;
    }
    // getParentVtableDto(ClassGenerator $generator)
    function getParentClassDto(ClassGenerator $generator)
    {
        //TODO rebuild eachtime the chain of parent :'(

        $extend = $generator->getExtendedClass();
        if ('GInitiallyUnowned'==$extend) {
            $extend = 'GObject';
        }
        if(empty($extend))
            return null;

        $parentGenerator = $generator->getOwnPackage()->getSymbol($extend);
        if(empty($parentGenerator))
            return null;

        $dto = $this->getClassDto($parentGenerator);

        return $dto;
    }

    function getMethodDto(MethodGenerator $method)
    {
        $helper = new TypeHelper();
        $helper->setView($this->getRenderer());
        $protoHelper = new DocBlockHelper();
        $protoHelper->setView($this->getRenderer());

        $methodDto = new MethodDto();
        $methodDto->generator = $method;
        $methodDto->name = $method->getName();
        $methodDto->type = $method->getType()->getName().$method->getPass();//$helper($method->getType(), '*');
        $methodDto->max_parameters = count($method->getParameters());
        $methodDto->min_parameters = count($method->getParameters());//TODO
        $methodDto->parameters = array();
        foreach($method->getParameters() as $parameter) {
            $parameterDto = new ParameterDto();
            $parameterDto->name = $parameter->getName();
            $parameterDto->type = $parameter->getType()->getName().$parameter->getPass();//$helper($parameter->getType(), '*');

            $methodDto->parameters[] = $parameterDto;
        }
        $methodDto->docblock = $protoHelper($method);

        return $methodDto;
    }

    // Controller::Action
    function render($model)
    {
        $view = $this->getView();

        $view->render($model);
        return $view->getResponse()->getContent();
    }

    // Controller::Action
    function save($dir):bool
    {
        $package = $this->getDocBook()->load();
        $objects = $package->getListObject();
        foreach ($objects as $objectName) {
            $generatorModel = $package->getObject($objectName);//'GList'
            $dto = $this->getClassDto($generatorModel);
            $viewModel = $this->getViewModel($dto);
            $output = $this->render($viewModel);
            //echo $output.PHP_EOL;
            file_put_contents($dir.'/'.$dto->fileName, $output);
        }
        return True;
    }

}