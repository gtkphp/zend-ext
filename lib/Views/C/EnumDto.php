<?php

namespace Zend\Ext\Views\C;

class EnumDto {
    public $name;
    public $constants=[];// array(name=>ConstantDto?)
    public $relationships=[];// array(name=>ClassDto)

    public $methods=[];// FIX: use functions

    public $dir;
    public $fileName;

    public $since;

}
