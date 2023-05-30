<?php

namespace ZendExt\Dto\Ext\Header;

use ZendExt\Dto\AliasClassDto as BaseDto;

class AliasClassDto extends BaseDto
{
    /** @var string */
    public $name;

    /** @var string */
    public $name_macro;

    /** @var string */
    public $name_function;

    /** @var string[] */
    public $uses;

    static public function create($codeGenerator, $renderer)
    {
        $dto = new self();

        /** @var AliasClassGenerator $aliasGenerator */
        $aliasGenerator = $codeGenerator->getAliasClass();
        // zend_register_class_alias("_ZendTestClassAlias", zend_test_class);

        $dto->name = $aliasGenerator->getName();

        $dto->name_function = strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', lcfirst($dto->name)));
        $dto->name_macro = strtoupper($dto->name_function);


        return $dto;
    }
}
