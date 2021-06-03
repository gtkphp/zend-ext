<?php

namespace Zend\Ext\Views;

use Zend\Ext\Views\VarDto;
use Zend\Ext\Views\ObjectDto;

class EnumDto extends ObjectDto {
    public $since;
    public $requires=array();
    public $dependencies=array();
    public $package=null;
    public $shortName='';
    public $shortDescription='';
    public $members = [];
    public $methods = [];
}
