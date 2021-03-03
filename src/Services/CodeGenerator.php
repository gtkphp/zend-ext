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

}
