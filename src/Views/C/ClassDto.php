<?php

namespace Zend\Ext\Views\C;
use Zend\Ext\Views\C\VTableDto;

class ClassDto {
    public $name;
    public $abbr;
    public $extend="";
    public $parent=null;
    public $fileName;
    public $nameMacro;
    public $nameFunction;
    public $properties=[];// array(name=>declaration)
    public $methods=[];// array(name=>MethodDto)

    public $vtable;// ClassDto
    public $relationships=[];// array(name=>ClassDto)
}
