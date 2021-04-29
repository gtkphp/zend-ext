<?php

namespace Zend\Ext\Services;

//use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Helpers\Php\Poo\CommentHelper;
use Zend\Ext\Helpers\Php\Poo\MethodHelper;
use Zend\Ext\Helpers\Php\Poo\NameclassHelper;
use Zend\Ext\Helpers\Php\Poo\NamemethodHelper;
use Zend\Ext\Helpers\Php\Poo\NamepropertyHelper;
use Zend\Ext\Helpers\Php\Poo\NamespaceHelper;
use Zend\Ext\Helpers\Php\Poo\ParameterHelper;
use Zend\Ext\Helpers\Php\Poo\TypeHelper;

use Zend\Ext\Helpers\Php\Pp\NamemethodHelper as NamemethodHelperPhpPp;
use Zend\Ext\Helpers\Php\Pp\TypeHelper as TypeHelperPhpPp;
use Zend\Ext\Helpers\Php\Pp\NameclassHelper as NameclassHelperPhpPp;

use Zend\Ext\Helpers\C\NameclassHelper as NameclassHelperC;
use Zend\Ext\Helpers\C\ReturntypeHelper as ReturntypeHelperC;
use Zend\Ext\Helpers\C\MaxargHelper as MaxargHelperC;
use Zend\Ext\Helpers\C\RequiredargHelper as RequiredargHelperC;

use Zend\Ext\Services\DocBook;

use Zend\Filter\FilterChain;
use Zend\Filter\StripTags;
use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\ServiceManager\ServiceManager;
//use Zend\View\HelperPluginManager;

use Zend\Ext\Views\HelperPluginManager;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\View;

class CodeGenerator
{
    const NO_CODE = 0x00;
    const PHP_CODE = 0x01;
    const C_CODE = 0x02;
    const XML_CODE = 0x03;


    const NO_STYLE = 0x00;
    // For PHP_CODE
    const PP_STYLE = 0x01;// Procedural Programming
    const POO_STYLE = 0x02;// Programming Oriented Object

    // For C_CODE
    const C_HEADER_STYLE = 0x03;// PHP Ext class header file
    const C_SOURCE_STYLE = 0x04;// PHP Ext class source file

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

    /**
     * @var int $style
     */
    protected $style = self::PP_STYLE;
    protected $code = self::PHP_CODE;

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

    function setStyle($style):CodeGenerator
    {
        $this->style = $style;
        return $this;
    }

    function getStyle():int
    {
        return $this->style;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return CodeGenerator
     */
    public function setCode(int $code): CodeGenerator
    {
        $this->code = $code;
        return $this;
    }

    public function phpPpStyleManager() {
        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        $pluginManager->addPathHelper(__DIR__.'/../Views/Php/Pp/Helpers', 'Zend\\Ext\\Views\\Php\\Pp\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../Views/Php/Helpers', 'Zend\\Ext\\Views\\Php\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');

        return $pluginManager;
    }

    public function phpPooStyleManager() {
        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        $pluginManager->addPathHelper(__DIR__.'/../Views/Php/Poo/Helpers', 'Zend\\Ext\\Views\\Php\\Poo\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../Views/Php/Helpers', 'Zend\\Ext\\Views\\Php\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');

        return $pluginManager;
    }

    public function cStyleManager() {
        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        $pluginManager->addPathHelper(__DIR__.'/../Views/C/Header/Helpers', 'Zend\\Ext\\Views\\C\\Header\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../Views/C/Helpers', 'Zend\\Ext\\Views\\C\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');

        return $pluginManager;
    }

    public function xmlStyleManager() {
        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        $pluginManager->addPathHelper(__DIR__.'/../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');

        return $pluginManager;
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

    /**
     * @param string $dir
     */
    public function save($dir):bool
    {
        echo "Unimplemented CodeGenerator::save()", PHP_EOL;
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


