<?php

namespace ZendExt\Dto\Ext\Source;


use Zend\Ext\Models\Code\Generator\AbstractGenerator;
use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;


class UserFunctionDto
{
    /** @var string */
    public $info;

    /** @var ArgumentsDto TODO: rename by FunctionArgumentsDto */
    public $zend_parameters;

    /** @var FunctionCallsDto */
    public $zend_call;

    /** @var FunctionReturnsDto */
    public $zend_return;

    static public function create(AbstractGenerator $codeGenerator, $renderer)
    {
        /** @var ClassGenerator $classGenerator */
        $classGenerator = $codeGenerator;

        $creatorFunctions = $classGenerator->getCreatorFunctions();
        if (!empty($creatorFunctions)) {
            $creatorFunctionName = current($creatorFunctions);
            
            $dto = new self();
            $dto->info = $creatorFunctionName;
            return $dto;
        }

        return null;
    }
}
