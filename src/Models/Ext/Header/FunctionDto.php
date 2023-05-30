<?php

namespace ZendExt\Dto\Ext\Header;


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

use ZendExt\Dto\Ext\Header\ArgumentsDto;


class FunctionDto //extends BaseFileDto
{
    /** @var string */
    public $name;

    /** @var ParameterDto[] */
    public $parameters;

    /** @var ArgumentsDto */
    public $arguments;

    public $pad = 0;

    static public function create(MethodGenerator $methodGenerator)
    {
        /** @var ClassGenerator $classGenerator */
        $dto = new FunctionDto();
        $dto->name = $methodGenerator->getName();

        $dto->arguments = ArgumentsDto::create($methodGenerator);

        /** @var ParameterGenerator $parameter */
        /*foreach($methodGenerator->getParameters() as $parameter) {
            
        }*/

        return $dto;
    }
}
