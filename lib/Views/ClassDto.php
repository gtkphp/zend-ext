<?php

namespace Zend\Ext\Views;

use Zend\Ext\Views\StructDto;

class ClassDto extends StructDto {

    //use DocumentableDto;
    //use DepencendyDto;

    public $parent=null;// extends

    public $instance=null;
    public $virtualTable=null;

    public $methods=[];
    public $interfaces=[];
    public $traits=[];
    public $functions=[];

}
