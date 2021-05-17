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
use Zend\Ext\Models\ObjectGenerator;
use Zend\Ext\Models\FileGenerator;
use Zend\Ext\Models\EnumGenerator;
use Zend\Ext\Models\UnionGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\StructGenerator;
use Zend\Ext\Models\VarGenerator;
use Zend\Ext\Models\ConstantGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\ParameterGenerator;
use Zend\Ext\Models\TypeGenerator;

class PackageGenerator extends ObjectGenerator
{
    protected $isModule = false;

    /**
     * @var array $list_type_object array('GtkWidget', 'GtkBin', ...)
     */
    public $doc_files = array();
    public $subpackage = array();

    /**
     * Array of ClassGenerator
     * $list_type_object array('GtkWidget', 'GtkBin', ...)
     * @var array
     */
    protected $list_type_object = array();

    /**
     * @var array $list_type_enum array('GtkWindowType', ...)
     */
    protected $list_type_enum = array();
    protected $list_type_union = array();
    //protected $list_type_typedef = array();
    
    /**
     * @var array $list_type_struct array('GtkWindow', ...)
     */
    protected $list_type_struct = array();
    
    /**
     * @var array $list_type_vtable array('GtkWindowType', ...)
     */
    protected $list_type_vtable = array();

    /**
     * @var array $symbols array('GtkWidget', 'GtkWidgetClass', 'GObjectClass', ...)
     */
    protected $symbols = array();

    public function setIsModule($is=true) {
        $this->isModule = $is;
    }
    public function isModule() {
        return $this->isModule;
    }
    
    public function createPackage(string $name): PackageGenerator {
        $package = new PackageGenerator($name);
        $package->setParentGenerator($this);
        $package->setOwnPackage($this);

        $this->subpackage[] = $package;

        return $package;
    }
    
    public function createClass(string $name): ClassGenerator {
        $class = new ClassGenerator($name);
        $class->setParentGenerator($this);
        $class->setOwnPackage($this);//CHECK me is Package has parent package

        $module = $this->getModulePackage();
        $module->list_type_object[$name] = $class;
        $module->symbols[$name] = $class;

        $root = $this->getPackage();
        $root->list_type_object[$name] = $class;
        $root->symbols[$name] = $class;
        //$this->list_type_object[$name] = $class;
        //$this->symbols[$name] = $class;

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

    public function createRelatedEnum(string $name, AbstractGenerator $parent): EnumGenerator {
        $enum = new EnumGenerator($name);
        $enum->setParentGenerator($parent);
        $enum->setOwnPackage($this);

        $this->symbols[$name] = $enum;

        return $enum;
    }

    public function createStruct(string $name): StructGenerator {
        $struct = new StructGenerator($name);
        $struct->setOwnPackage($this);

        $module = $this->getModulePackage();
        //echo 'module : '.$module->getName().PHP_EOL;
        $module->list_type_struct[$name] = $struct;
        $module->symbols[$name] = $struct;

        $root = $this->getPackage();
        $root->list_type_struct[$name] = $struct;
        $root->symbols[$name] = $struct;

        return $struct;
    }

    public function createVar(string $name): VarGenerator {
        $var = new VarGenerator($name);
        $var->setOwnPackage($this);

        return $var;
    }

    public function createEnum(string $name): EnumGenerator {
        $enum = new EnumGenerator($name);
        $enum->setParentGenerator($this);
        $enum->setOwnPackage($this);//CHECK me is Package has parent package

        $module = $this->getModulePackage();
        $module->list_type_enum[$name] = $enum;
        $module->symbols[$name] = $enum;

        $root = $this->getPackage();
        $root->list_type_enum[$name] = $enum;
        $root->symbols[$name] = $enum;

        return $enum;
    }

    public function createUnion(string $name): UnionGenerator {
        $union = new UnionGenerator($name);
        $union->setParentGenerator($this);
        $union->setOwnPackage($this);//CHECK me is Package has parent package

        $module = $this->getModulePackage();
        $module->list_type_union[$name] = $union;
        $module->symbols[$name] = $union;

        $root = $this->getPackage();
        $root->list_type_union[$name] = $union;
        $root->symbols[$name] = $union;

        return $union;
    }
    
    public function createConstant(string $name, AbstractGenerator $parent): ConstantGenerator {
        $constant = new ConstantGenerator($name);
        $constant->setParentGenerator($this, $parent);
        $constant->setOwnPackage($this);

        //$this->list_type_enum[$name] = $enum;
        //$this->symbols[$name] = $enum;

        return $constant;
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

        //$this->symbols[$name] = $method;
        return $method;
    }

    public function createParameter($name) {
        $method = new ParameterGenerator($name);
        $method->setOwnPackage($this);
        return $method;
    }

    public function createProperty($name, $parent):PropertyGenerator {
        $property = new PropertyGenerator($name);
        $property->setParentGenerator($parent);
        $property->setOwnPackage($this);
        return $property;
    }

    public function createType($name) {
        $type = new TypeGenerator($name);
        $type->setOwnPackage($this);
        return $type;
    }

    public function createFile($name) {
        $file = new FileGenerator($name);
        $file->setParentGenerator($this);
        $file->setOwnPackage($this);
        return $file;
    }
    

    /**
     * @return array
     */
    public function getListTypeStruct(): array
    {
        $root = $this;//$this->getPackage();
        return $root->list_type_struct;
    }
    /**
     * @param string $name
     */
    public function getStruct($name)
    {
        $root = $this;//$this->getPackage();
        if (isset($root->list_type_struct[$name])) {
            return $root->list_type_struct[$name];
        }
        return Null;
    }

    /**
     * @return array
     */
    public function getListTypeObject(): array
    {
        $root = $this;//$this->getPackage();
        return $root->list_type_object;
    }
    /**
     * @param string $name
     */
    public function getObject($name)
    {
        $root = $this;//$this->getPackage();
        if (isset($root->list_type_object[$name])) {
            return $root->list_type_object[$name];
        }
        return Null;
    }
    /**
     * @return array
     */
    public function getListObject(): array
    {
        $root = $this;//$this->getPackage();
        return array_keys($root->list_type_object);
    }

    /**
     * @param array $list_type_object
     * @return PackageGenerator
     */
    public function setListTypeObject(array $list_type_object): PackageGenerator
    {
        $root = $this;//$this->getPackage();
        $root->list_type_object = $list_type_object;
        return $this;
    }

    /**
     * @return array
     */
    public function getListTypeUnion(): array
    {
        $root = $this;//$this->getPackage();
        return $root->list_type_union;
    }

    /**
     * @return array
     */
    public function getListTypeEnum(): array
    {
        $root = $this;//$this->getPackage();
        return $root->list_type_enum;
    }

    /**
     * @param array $list_type_enum
     * @return PackageGenerator
     */
    public function setListTypeEnum(array $list_type_enum): PackageGenerator
    {
        $root = $this;//$this->getPackage();
        $root->list_type_enum = $list_type_enum;
        return $this;
    }

    /**
     * @return array of AbstractGenerator
     */
    public function getSymbols(): array
    {
        $root = $this;//$this->getPackage();
        return $root->symbols;
    }

    /**
     * @param string $name
     * @return AbstractGenerator
     */
    public function getSymbol($name)
    {
        $root = $this;//$this->getPackage();
        return isset($root->symbols[$name]) ? $root->symbols[$name] : null;
    }
}
