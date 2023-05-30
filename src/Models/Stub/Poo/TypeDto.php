<?php

namespace ZendExt\Dto\Stub\Poo;

use Zend\Ext\Models\Code\Generator\MethodGenerator;

use Zend\Ext\Services\Classifier\Cairo as GnomeClassifier;




class TypeDto
{
    /** @var string */
    public $name;

    static public function create($codeGenerator, $renderer)
    {
        /** @var TypeGenerator $typeGenerator */    
        $typeGenerator = $codeGenerator;

        $dto = new self();
        
        $type_name = $typeGenerator->__toString();
        if (in_array($type_name, ['void', 'mixed', 'int', 'float', 'string', 'array', 'object', 'callable'/* ... */])) {
            $dto->name = $type_name;
        } else {
            $type_name = $typeGenerator->atomic()->type;
            if ('cairo_t'==$type_name) {
                $dto->name = '\\Context';
            } else {
                $type_name = GnomeClassifier::Prefix($type_name, 'cairo');// remove 'cairo_'
                $type_name = GnomeClassifier::Suffix($type_name);// remove '_t'
                $type_name = GnomeClassifier::SnakeToPascal($type_name);
                $dto->name = '\\'.$type_name;
            }
        }

        return $dto;
    }
}
