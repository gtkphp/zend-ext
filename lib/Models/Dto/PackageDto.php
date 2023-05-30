<?php

namespace Zend\Ext\Models\Dto;

use Zend\Ext\Models\Dto\ObjectDto;

class PackageDto extends ObjectDto {

    /**
     * List of object( Class, Enum, Union, Function, Constant)
     * @var array of ObjectDto
     */
    public $objects=[];

    public $subpackage=[];

}
