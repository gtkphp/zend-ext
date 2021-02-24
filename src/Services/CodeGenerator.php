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

use Zend\Ext\Helpers\Php\C\NamemethodHelper as CNamemethodHelper;
use Zend\Ext\Helpers\Php\C\TypeHelper as CTypeHelper;


use Zend\Filter\FilterChain;
use Zend\Filter\StripTags;
use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;

class CodeGenerator
{
    const NO_STYLE = 0x00;
    const C_STYLE = 0x01;// proCedural
    const POO_STYLE = 0x02;// Programming Oriented Object

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var int $style
     */
    protected $style = self::NO_STYLE;

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

    public function cStyleManager() {
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
            return new CNamemethodHelper;
        });
        $pluginManager->setFactory('typeHelper', function ($pluginManager) {
            return new CTypeHelper;
        });
        $pluginManager->setFactory('parameterHelper', function ($pluginManager) {
            return new ParameterHelper;
        });
        $pluginManager->setFactory('namepropertyHelper', function ($pluginManager) {
            return new NamepropertyHelper;
        });

        return $pluginManager;
    }
    public function pooStyleManager() {
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

}
