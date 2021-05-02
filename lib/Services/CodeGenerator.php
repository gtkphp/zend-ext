<?php

namespace Zend\Ext\Services;

use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\EnumGenerator;

use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;
use Zend\Ext\Views\C\Header\Helpers\TypeHelper;// <------- TODO: move file
use Zend\Ext\Views\C\Source\Helpers\DocBlockHelper;
use Zend\Ext\Views\C\Source\ClassDto;
use Zend\Ext\Views\C\Source\MethodDto;
use Zend\Ext\Views\C\EnumDto;
use Zend\Ext\Views\C\ParameterDto;
use Zend\Ext\Views\C\PropertyDto;


/*
use Zend\Ext\Helpers\Php\Pp\NamemethodHelper as NamemethodHelperPhpPp;
use Zend\Ext\Helpers\Php\Pp\TypeHelper as TypeHelperPhpPp;
use Zend\Ext\Helpers\Php\Pp\NameclassHelper as NameclassHelperPhpPp;

use Zend\Ext\Helpers\C\NameclassHelper as NameclassHelperC;
use Zend\Ext\Helpers\C\ReturntypeHelper as ReturntypeHelperC;
use Zend\Ext\Helpers\C\MaxargHelper as MaxargHelperC;
use Zend\Ext\Helpers\C\RequiredargHelper as RequiredargHelperC;
*/

use Zend\Ext\Services\DocBook;

use Zend\Filter\FilterChain;
use Zend\Filter\StripTags;
use Zend\Filter\StringToLower;
use Zend\Filter\StringToUpper;
use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\Filter\Word\CamelCaseToDash;

use Zend\ServiceManager\ServiceManager;

use Zend\Ext\Views\HelperPluginManager;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\View;

class CodeGenerator
{
    /**
     * @var string $name
     */
    protected $name;
    /**
     * @var DocBook $docBook
     */
    protected $docBook;
    /**
     * @var  PhpRenderer $renderer
     */
    protected $renderer;

    function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CodeGenerator
     */
    public function setName(string $name): CodeGenerator
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return DocBook
     */
    public function getDocBook(): DocBook
    {
        return $this->docBook;
    }

    /**
     * @param DocBook $docBook
     * @return CodeGenerator
     */
    public function setDocBook(DocBook $docBook): CodeGenerator
    {
        $this->docBook = $docBook;
        return $this;
    }

    function render($model)
    {
        $view = $this->getView();

        $view->render($model);
        return $view->getResponse()->getContent();
    }

    function getView():View
    {
        $view = new View();
        $view->setResponse(new Response());


        $rendererStrategy = new PhpRendererStrategy($this->getRenderer());
        $rendererStrategy->attach($view->getEventManager());

        return $view;
    }

    function getRenderer():RendererInterface
    {
        $this->renderer = new PhpRenderer();

        return $this->renderer;
    }

    function getViewModel($dto):ViewModel
    {
        $model = new ViewModel();
        $model->setVariables((array)$dto);

        return $model;
    }

    function namespaceHelper($filename) {
        $filename = str_replace('_', '-', $filename);
        $ln = strlen($filename);
        $suffix = substr($filename, $ln-2);
        if ('-t'==$suffix) {
            $filename = substr($filename, 0, $ln-2);
        }
        
        $pos = strpos($filename, '-');
        if (false===$pos) {
            $namespace = $filename;
        } else {
            $namespace = substr($filename, 0, $pos);
        }

        return $namespace;
    }
    
    function filenameHelper($filename) {
        $filename = str_replace('_', '-', $filename);
        $ln = strlen($filename);
        $suffix = substr($filename, $ln-2);
        if ('-t'==$suffix) {
            $filename = substr($filename, 0, $ln-2);
        }
        
        $pos = strpos($filename, '-');
        if (false===$pos) {
            $namespace = $filename;
            $filename = $filename;
        } else {
            $namespace = substr($filename, 0, $pos);
            $filename = substr($filename, $pos+1);
        }

        return $filename;
    }

    function getFilenameExtension() {
        return 'c';
    }

    function getEnumDto(EnumGenerator $generator)
    {
        $dto = new EnumDto();
        $dto->constants = $generator->getConstants();

        return $dto;
    }

    function getClassDto(ClassGenerator $generator)
    {
        /*
        $helper = new TypeHelper();
        $helper->setView($this->getRenderer());
        $protoHelper = new DocBlockHelper();
        $protoHelper->setView($this->getRenderer());
        */
        

        

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
        $cc_name = $filter->filter($name);

        $filename = $this->filenameHelper($cc_name);
        $namespace = $this->namespaceHelper($cc_name);

        $dir = '';
        $includes = [];
        if ('g'==$namespace) {
            $includes[] = "<glib.h>";
            $dir = 'php_glib';
        } else {
            $includes[] = "<".$namespace."/".$namespace.".h>";
            $dir = 'php_'.$namespace;
        }
        $includes[] = '"php_gtk.h"';

        $dto = new ClassDto();
        $dto->namespace = $namespace;// tag @package
        $dto->name = $generator->getName();
        $dto->abbr = $generator->getAbbr();
        $dto->description = $generator->getDescription();
        $dto->extend = $generator->getExtendedClass();
        $dto->dir = $dir;
        $dto->fileName = $filename . '.' . $this->getFilenameExtension();
        $dto->nameMacro = $filter3->filter($name);
        $dto->nameFunction = $filter2->filter($name);
        $dto->nameType = $name;
        $dto->headerFile = $filename . '.h';
        $dto->includeFiles = $includes;
        $dto->properties = array();
        $properties = array();
        foreach($generator->getProperties() as $property) {
            $propertyDto = new PropertyDto();
            $propertyDto->name = $property->getName();
            $propertyDto->type = $property->getType()->getName();//$this->getRenderer()->typeHelper($property->getType(), '');
            $propertyDto->short_description = $property->getShortDescription();
            //$propertyDto->tags = $property->getTags();
            $properties[] = $propertyDto;
        }
        $dto->properties = $properties;

        $dto->methods = array();
        $max_length=0;
        $methods = $generator->getMethods();
        foreach($methods as $method) {
            // Fix if we can use $this->getMethodDto()
            $methodDto = new MethodDto();
            $methodDto->generator = $method;
            $methodDto->name = $method->getName();
            $methodDto->short_description = $method->getDescription();
            $methodDto->type = $this->getRenderer()->typeHelper($method->getType(), '*');
            $methodDto->max_parameters = count($method->getParameters());
            $methodDto->min_parameters = count($method->getParameters());//TODO
            $methodDto->parameters = array();
            foreach($method->getParameters() as $parameter) {
                $parameterDto = new ParameterDto();
                $parameterDto->name = $parameter->getName();
                $parameterDto->type = $this->getRenderer()->typeHelper($parameter->getType(), '*');
                $parameterDto->short_description = $this->getRenderer()->commentHelper($parameter->getShortDescription(), '');

                $methodDto->parameters[] = $parameterDto;
            }
            $methodDto->docblock = $this->getRenderer()->docBlockHelper($method);
            $this->placeholderArgs($methodDto, $method);
        
            $max_length = max($max_length, strlen($methodDto->name));
            $dto->methods[$method->getName()] = $methodDto;
        }
        foreach($dto->methods as $method) {
            $method->pad = str_repeat(' ', $max_length-strlen($method->name));
        }

        $dto->vtable = $this->getVtableDto($generator);
        $dto->parent = $this->getParentClassDto($generator);

        $dto->relationships = $this->getRelationshipsDto($generator);

        // gperf -CGD -N php_cairo_matrix_lookup -W php_cairo_matrix_properties -H php_cairo_matrix_properties_hash -K name --language=ANSI-C -t data.gperf > perfecthash.h
        // min is 5

        $dto->getter_setter = $this->make_lookup($dto);

        return $dto;
    }

    protected function placeholderArgs(MethodDto $methodDto, MethodGenerator $method) {
    }

    /** refactor : placeholderLookup() */
    function make_lookup(ClassDto $dto):string {
        return '';
    }

    function getSimpleClassDto(ClassGenerator $generator)
    {
        //TODO:  without Relationships
    }

    function getRelationshipsDto(ClassGenerator $class)
    {
        $elationships = [];

        $class_name = $class->getName();

        //echo 'Relation => ', $class_name, PHP_EOL;
        $objects = $class->getRelatedObjects();
        foreach($objects as $object) {
            if ($object) {
                $name = $object->getName();
                if ($class_name.'Class'==$name) {
                    //echo '    - ', $name, PHP_EOL;
                } else {
                    //echo '    + ', $name, PHP_EOL;
                    if ($object instanceof EnumGenerator) {
                        $elationships[$name] = $this->getEnumDto($object);
                    } else if ($object instanceof ClassGenerator) {
                        $elationships[$name] = $this->getClassDto($object);
                    }
                }
            } else {
                echo '    - TODO enum/typedef', PHP_EOL;
            }

        }
        return $elationships;
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

    /**
     * @param string $dir
     */
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
            `mkdir -p $dir/$dto->dir`;
            file_put_contents($dir.'/'.$dto->dir.'/'.$dto->fileName, $output);
        }
        return True;
    }

    /**
     * @param string $id 'C/Glib'
     *                   | 'Php/Api/Glib'
     *                   | 'Php/Wrapper/Glib'
     *                   | 'Xml/Glib' 
     */
    static public function Factory($id, $options)
    {
        $path = __DIR__.'/'.$id.'Generator.php';
        $class = 'Zend\\Ext\\Services\\CodeGenerator\\' . str_replace('/', '\\', $id) . 'Generator';
        $generator = new $class($options);
        return $generator;
    }

}


