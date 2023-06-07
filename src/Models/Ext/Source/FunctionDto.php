<?php

namespace ZendExt\Dto\Ext\Source;


use Zend\Ext\Models\Code\Generator\AbstractGenerator;
use Zend\Ext\Models\Code\Generator\FileGenerator;
use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\LicenseTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\AuthorTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\GenericTag;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;


/**
 * FIXME: generate the output in zend_call|zend_return->info is complex and not flexible
 */
class FunctionDto //extends BaseFileDto
{
    /** @var string */
    public $name;

    /** @var FunctionArgsDto */
    public $zend_parameters;

    /** @var FunctionCallsDto */
    public $zend_call;

    /** @var FunctionReturnsDto */
    public $zend_return;

    static public function create(AbstractGenerator $codeGenerator, $renderer)
    {
        /** @var MethodGenerator $methodGenerator */
        $methodGenerator = $codeGenerator;

        /** @var ClassGenerator $classGenerator */
        $dto = new self();
        $dto->name = $methodGenerator->getName();
        
        // in gtk.c add function like zval_get_array_[float|int|array|object]
        $dto->zend_parameters = $renderer->transfer('FunctionArgsDto.php', $methodGenerator);
        $dto->zend_call = $renderer->transfer('FunctionCallsDto.php', $methodGenerator);
        $dto->zend_return = $renderer->transfer('FunctionReturnsDto.php', $methodGenerator);

        /** @var ParameterGenerator $parameter */
        /*foreach($methodGenerator->getParameters() as $parameter) {
            
        }*/

        return $dto;
    }
}
