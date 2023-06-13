<?php

namespace ZendExt\Dto\Ext\Header;
use ZendExt\Dto\Ext\Source\UserFunctionDto as BaseDto;


use Zend\Ext\Models\Code\Generator\AbstractGenerator;
use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;

use ZendExt\Dto\Ext\Source\ParameterDto;

class UserFunctionDto
{
    static public function create(AbstractGenerator $codeGenerator, $renderer)
    {
        return BaseDto::create($codeGenerator, $renderer);
    }
}
