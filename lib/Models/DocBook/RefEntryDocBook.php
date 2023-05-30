<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\TypedefDocBook;
use Zend\Ext\Models\DocBook\StructDocBook;
use Zend\Ext\Models\DocBook\EnumDocBook;
use Zend\Ext\Models\DocBook\UnionDocBook;
use Zend\Ext\Models\DocBook\MacroDocBook;

class RefEntryDocBook extends AbstractDocBook
{
    public $id;

    public $refMeta;
    public $refNameDiv;

    /**
     * <refsect1> content
     */
    //protected $variables = [];
    //protected $typedefs = [];
    protected $macros = [];
    protected $unions = [];
    protected $enums = [];
    protected $structs = [];
    protected $functions = [];
    protected $typedefs = [];
    

    /**
     * @param MacroDocBook $macro
     */
    public function addMacro($macro) {
        $this->macros[$macro->name] = $macro;
        return $this;
    }
    /**
     * @return MacroDocBook[]
     */
    public function macros() {
        return $this->macros;
    }

    /**
     * @param TypedefDocBook $typedef
     */
    public function addTypedef($typedef) {
        $this->typedefs[$typedef->name] = $typedef;
        return $this;
    }
    /**
     * @return TypedefDocBook[]
     */
    public function typedefs() {
        return $this->typedefs;
    }

    /**
     * @param UnionDocBook $union
     */
     public function addUnion($union) {
         $this->unions[$union->name] = $union;
         return $this;
        }
    /**
     * @return UnionDocBook[]
     */
     public function unions() {
         return $this->unions;
        }
    /**
     * @param EnumDocBook $enum
     */
     public function addEnum($enum) {
         $this->enums[$enum->name] = $enum;
         return $this;
        }
    /**
     * @return EnumDocBook[]
     */
     public function enums() {
         return $this->enums;
        }
    /**
     * @param StructDocBook $struct
     */
    public function addStruct($struct) {
        $this->structs[$struct->name] = $struct;
        return $this;
    }
    /**
     * @return StructDocBook[]
     */
    public function structs() {
        return $this->structs;
    }

    /**
     * @param FunctionDocBook $function
     */
    public function addFunction($function) {
        $this->functions[$function->name] = $function;
        return $this;
    }
    /**
     * @return FunctionDocBook[]
     */
    public function functions() {
        return $this->functions;
    }
    /**
     * @return FunctionDocBook
     */
    public function getFunction($name) {
        foreach($this->functions() as $function) {
            if ($name==$function->name) {
                return $function;
            }
        }
        return null;
    }

    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'refentry ('.$this->id.') {'.PHP_EOL;
        foreach($this->typedefs() as $typedef) {
            $output .= $typedef->__toString();
        }
        foreach($this->macros() as $macro) {
            $output .= $macro->__toString();
        }
        foreach($this->structs() as $struct) {
            $output .= $struct->__toString();
        }
        foreach($this->enums() as $enum) {
            $output .= $enum->__toString();
        }
        foreach($this->unions() as $union) {
            $output .= $union->__toString();
        }
        $output .= $tab . '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}
