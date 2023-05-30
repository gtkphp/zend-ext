<?php

namespace ZendExt\Dto\Ext\Source;

use ZendExt\Dto\Ext\EnumDto as BaseDto;

use Zend\Ext\Models\Code\Generator\FileGenerator;
use Zend\Ext\Models\Code\Generator\EnumGenerator\EnumGenerator;
use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;


class EnumDto extends BaseDto
{
    /** @var string */
    public $name;

    /** @var string */
    public $name_macro;

    /** @var string */
    public $name_function;

    /** @var string[] */
    public $requires = [];

    /** @var array<string, string|int> */
    public $cases = [];

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


        $backedCases = $enumGenerator->getCases();
        foreach ($backedCases->cases as $case) {
            $dto->cases[$case['name']] = $case['value'];
        }

        $dto->requires = $fileGenerator->getRequiredFiles();

        return $dto;
    }

}
