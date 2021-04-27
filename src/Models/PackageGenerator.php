<?php
/**
 * Zend Extension (https://github.com/Glash-Gnome)
 *
 * @link      https://github.com/Glash-Gnome/zend-ext for the canonical source repository
 * @copyright Copyright (c) 2021-2021 Glash. <5312910@php.net>
 * @license   GPL 3.0
 */

namespace Zend\Ext\Models;

use Zend\Ext\Models\AbstractGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\EnumGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\ParameterGenerator;
use Zend\Ext\Models\TypeGenerator;

class PackageGenerator extends AbstractGenerator
{
    /**
     * @var array $list_type_object array('GtkWidget', 'GtkBin', ...)
     */
    protected $list_type_object = array();

    /**
     * @var array $list_type_enum array('GtkWindowType', ...)
     */
    protected $list_type_enum = array();

    /**
     * @var array $list_type_vtable array('GtkWindowType', ...)
     */
    protected $list_type_vtable = array();

    /**
     * @var array $symbols array('GtkWidget', 'GtkWidgetClass', 'GObjectClass', ...)
     */
    protected $symbols = array();
    
    public function createClass(string $name): ClassGenerator {
        $class = new ClassGenerator($name);
        $class->setParentGenerator($this);
        $class->setOwnPackage($this);//CHECK me is Package has parent package

        $this->list_type_object[$name] = $class;
        $this->symbols[$name] = $class;

        return $class;
    }
    
    public function createRelatedClass(string $name, ClassGenerator $parent): ClassGenerator {
        $class = new ClassGenerator($name);
        $class->setParentGenerator($parent);
        $class->setOwnPackage($this);//CHECK me is Package has parent package

        $this->list_type_object[$name] = $class;
        $this->symbols[$name] = $class;

        return $class;
    }

    public function createRelatedEnum(string $name, ClassGenerator $parent): EnumGenerator {
        $class = $this->createEnum($name);
        $class->setParentGenerator($parent);
        
        //$this->list_type_object[$name] = $class;// for PHP 8 enum {}
        
        return $class;
    }

    public function createEnum(string $name): EnumGenerator {
        $enum = new EnumGenerator($name);
        $enum->setParentGenerator($this);
        $enum->setOwnPackage($this);//CHECK me is Package has parent package

        $this->list_type_enum[$name] = $enum;
        $this->symbols[$name] = $enum;

        return $enum;
    }

    public function createVTable(string $name): ClassGenerator {
        $class = new ClassGenerator($name);
        $class->setParentGenerator($this);
        $class->setOwnPackage($this);//CHECK me is Package has parent package

        $this->list_type_vtable[$name] = $class;
        $this->symbols[$name] = $class;

        return $class;
    }

    public function createMethod($name) {
        $method = new MethodGenerator($name);
        $method->setOwnPackage($this);
        return $method;
    }

    public function createParameter($name) {
        $method = new ParameterGenerator($name);
        $method->setOwnPackage($this);
        return $method;
    }

    public function createType($name) {
        $type = new TypeGenerator($name);
        $type->setOwnPackage($this);
        return $type;
    }

    /**
     * @return array
     */
    public function getListTypeObject(): array
    {
        return $this->list_type_object;
    }
    /**
     * @param string $name
     */
    public function getObject($name)
    {
        if (isset($this->list_type_object[$name])) {
            return $this->list_type_object[$name];
        }
        return Null;
    }
    /**
     * @return array
     */
    public function getListObject(): array
    {
        return array_keys($this->list_type_object);
    }

    /**
     * @param array $list_type_object
     * @return PackageGenerator
     */
    public function setListTypeObject(array $list_type_object): PackageGenerator
    {
        $this->list_type_object = $list_type_object;
        return $this;
    }


    /**
     * @return array
     */
    public function getListTypeEnum(): array
    {
        return $this->list_type_enum;
    }

    /**
     * @param array $list_type_enum
     * @return PackageGenerator
     */
    public function setListTypeEnum(array $list_type_enum): PackageGenerator
    {
        $this->list_type_enum = $list_type_enum;
        return $this;
    }

    /**
     * @return array of AbstractGenerator
     */
    public function getSymbols(): array
    {
        return $this->symbols;
    }

    /**
     * @param string $name
     * @return AbstractGenerator
     */
    public function getSymbol($name)
    {
        return isset($this->symbols[$name]) ? $this->symbols[$name] : null;
    }
    
}