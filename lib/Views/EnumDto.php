<?php

namespace Zend\Ext\Views;

use Zend\Ext\Views\ConstantDto;
use Zend\Ext\Views\StructDto;

class EnumDto extends StructDto {
    
    /**
     * @var array of ConstantDto
     */
    public $constants=[];
}
