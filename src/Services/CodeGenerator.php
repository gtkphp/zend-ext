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


use Zend\Filter\FilterChain;
use Zend\Filter\StripTags;
use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\ServiceManager\ServiceManager;
//use Zend\View\HelperPluginManager;
use Zend\Ext\Views\HelperPluginManager;

class CodeGenerator
{
    const NO_CODE = 0x00;
    const PHP_CODE = 0x01;
    const C_CODE = 0x02;


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
        $pluginManager = new HelperPluginManager(new ServiceManager());

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
            return new NameclassHelperPhpPp;
        });
        $pluginManager->setFactory('methodHelper', function ($pluginManager) {
            return new MethodHelper;
        });
        $pluginManager->setFactory('namemethodHelper', function ($pluginManager) {
            return new NamemethodHelperPhpPp;
        });
        $pluginManager->setFactory('typeHelper', function ($pluginManager) {
            return new TypeHelperPhpPp;
        });
        $pluginManager->setFactory('parameterHelper', function ($pluginManager) {
            return new ParameterHelper;
        });
        $pluginManager->setFactory('namepropertyHelper', function ($pluginManager) {
            return new NamepropertyHelper;
        });

        return $pluginManager;
    }
    public function PhpPooStyleManager() {
        $pluginManager = new HelperPluginManager(new ServiceManager());

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

        return $pluginManager;
    }

    public function CStyleManager() {
        //https://www.nikolaposa.in.rs/blog/2018/07/14/lazy-loading-services-using-zf-service-manager/
        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        $pluginManager->addPathHelper(__DIR__.'/../Views/C/Helpers', 'Zend\\Ext\\Views\\C\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');

        /*$pluginManager->setFactory('namespaceHelper', function ($pluginManager) {
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
            NameclassHelperC::$filter = new CamelCaseToUnderscore;
            return new NameclassHelperC;
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
        $pluginManager->setFactory('returntypeHelper', function ($pluginManager) {
            return new ReturntypeHelperC;
        });
        $pluginManager->setFactory('parameterHelper', function ($pluginManager) {
            return new ParameterHelper;
        });
        $pluginManager->setFactory('namepropertyHelper', function ($pluginManager) {
            return new NamepropertyHelper;
        });
        $pluginManager->setFactory('maxargHelper', function ($pluginManager) {
            return new MaxargHelperC;
        });
        $pluginManager->setFactory('requiredargHelper', function ($pluginManager) {
            return new RequiredargHelperC;
        });*/



        return $pluginManager;
    }

}
