<?php

namespace Zend\Ext\Views;

use Zend\Ext\Views\ObjectDto;

class UnionDto extends ObjectDto {
    public $requires=array();
    public $dependencies=array();
    public $package=null;
    public $shortName='';
    public $shortDescription='';
    public $members = [];
    public $methods = [];
}
