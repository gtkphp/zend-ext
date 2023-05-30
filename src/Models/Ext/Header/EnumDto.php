<?php

namespace ZendExt\Dto\Ext\Header;

use ZendExt\Dto\Ext\EnumDto as BaseDto;

use Zend\Ext\Models\Code\Generator\FileGenerator;
use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\LicenseTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\AuthorTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\GenericTag;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;


class EnumDto extends BaseDto
{
    /** @var string */
    public $name;

    /** @var string */
    public $name_macro;

    /** @var string */
    public $name_function;

    static public function create($codeGenerator, $renderer)
    {
        $dto = new self();

        /** @var FileGenerator $fileGenerator */
        $fileGenerator = $codeGenerator;

        /** @var EnumGenerator $enumGenerator */
        $enumGenerator = $fileGenerator->getEnum();

        $dto->name = $enumGenerator->getName();
        
        /*$dockBlockGenerator = $enumGenerator->getDocBlock();
        if ($dockBlockGenerator) {
            $dto->dockBlock = $dockBlockGenerator->generate();
        } else {
            $dto->dockBlock = '';
        }*/
        
        $dto->name_function = strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', lcfirst($dto->name)));
        $dto->name_macro = strtoupper($dto->name_function);

        return $dto;
    }
}
