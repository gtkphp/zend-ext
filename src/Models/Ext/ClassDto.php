<?php

namespace ZendExt\Dto\Ext;

use ZendExt\Dto\ClassDto as BaseDto;
use ZendExt\Dto\MethodDto;
use ZendExt\Dto\FunctionDto;
use ZendExt\Dto\VarDto;


class ClassDto extends BaseDto
{
    /** @var string */
    public $name;
    
    /** @var string */
    public $dockBlock;
    
    /** @var VarDto[] */
    public $fields=[];
    
    /** @var MethodDto[] */
    public $methods=[];

    public $interfaces=[];
    public $traits=[];

    /** @var FunctionDto[] */
    public $functions=[];

}
