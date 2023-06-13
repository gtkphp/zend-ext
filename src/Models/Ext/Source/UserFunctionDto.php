<?php

namespace ZendExt\Dto\Ext\Source;


use Zend\Ext\Models\Code\Generator\AbstractGenerator;
use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;

use ZendExt\Dto\Ext\Source\ParameterDto;

class UserFunctionDto
{
    /** @var string */
    public $info;

    /** @var FunctionArgsDto */
    public $parameters = [];

    /** @var FunctionCallsDto */
    public $call;

    /** @var FunctionReturnsDto */
    public $zend_return;

    static public function create(AbstractGenerator $codeGenerator, $renderer)
    {
        $dto = new self();

        /** @var ClassGenerator $classGenerator */
        $classGenerator = $codeGenerator;
        $fileGenerator = $classGenerator->getContainingFileGenerator();

        $creatorFunctionName = null;
        $creatorFunctions = $classGenerator->getCreatorFunctions();
        if (!empty($creatorFunctions)) {
            $creatorFunctionName = current($creatorFunctions);
            $dto->call = $creatorFunctionName;
            $functionGenerator = $fileGenerator->getFunction($creatorFunctionName);
            $parameters = $functionGenerator->getParameters();
            foreach ($parameters as $parameter) {
                if ($parameter->getVariadic()) {
                    echo 'Unexpected function creator: ', $functionGenerator->getName(), PHP_EOL;
                    // select another function creator
                    // g_error_new_valist() insteadof g_error_new()
                } else{
                    $p = new ParameterDto();
                    $p->name = $parameter->getName();
                    $p->type = $parameter->type()->internal_type.$parameter->getPointer();
                    $dto->parameters[$p->name] = $p;
                }
            }

            $dto->info = $creatorFunctionName;
            return $dto;
        }
        
        return null;
    }
}
