<?php

namespace Zend\Ext\Services\CodeGenerator\C\Header;

use Zend\Ext\Services\DocBook\Gtk as GtkDocBook;
use Zend\Ext\Services\SourceCode\Gtk as GtkSourceCode;
use Zend\Ext\Views\HelperPluginManager;
use Zend\Ext\Views\C\Header\Helpers\TypeHelper;
use Zend\Ext\Views\C\ClassDto;
use Zend\Ext\Views\C\MethodDto;
use Zend\Ext\Views\C\ParameterDto;
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

use Zend\Ext\Services\CodeGenerator;
use function Webmozart\Assert\Tests\StaticAnalysis\maxLength;

class GtkGenerator extends CodeGenerator
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

    function getClassDto(ClassGenerator $generator)
    {
        $helper = new TypeHelper();
        $helper->setView($this->getRenderer());

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
        $dto->fileName = $filter->filter($name) . '.h';
        $dto->nameMacro = $filter3->filter($name);
        $dto->nameFunction = $filter2->filter($name);
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
            $methodDto->name = $method->getName();
            $methodDto->type = $helper($method->getType(), '*');
            $methodDto->parameters = array();
            foreach($method->getParameters() as $parameter) {
                $parameterDto = new ParameterDto();
                $parameterDto->name = $parameter->getName();
                $parameterDto->type = $helper($parameter->getType(), '*');

                $methodDto->parameters[] = $parameterDto;
            }


            $max_length = max($max_length, strlen($methodDto->name));
            $dto->methods[$method->getName()] = $methodDto;
        }
        foreach($dto->methods as $method) {
            $method->pad = str_repeat(' ', $max_length-strlen($method->name));
        }

        return $dto;
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
