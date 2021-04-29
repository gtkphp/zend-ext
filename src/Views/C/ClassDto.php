<?php

namespace Zend\Ext\Views\C;
use Zend\Ext\Views\C\VTableDto;

class ClassDto {
    public $namespace;
    public $name;
    public $abbr;
    public $extend="";
    public $parent=null;
    public $fileName;
    public $nameMacro;
    public $nameFunction;
    public $properties=[];// array(name=>declaration)
    public $methods=[];// array(name=>MethodDto)

    public $getter_setter;
    public $vtable;// ClassDto
    public $relationships=[];// array(name=>ClassDto)

    public $g_config = array(
        "has_dimension"=>false,
        "is_countable"=>false,
        "has_property"=>false,
        "has_signal"=>false,
        "has_style"=>false,
    );
}
