<?php

namespace Zend\Ext\Views\C;

class ClassDto {
    public $fileName;
    public $nameMacro;
    public $nameFunction;
    public $properties;// array(name=>declaration)
    public $methods;// array(name=>MethodDto)
}
