<?php

namespace Zend\Ext\Views;

use Zend\Ext\Views\ObjectDto;

class PackageDto extends ObjectDto {

    public $name='';

    /**
     * List of object( Class, Enum, Union, Function, Constant)
     * @var array of ObjectDto
     */
    public $objects=[];

}
