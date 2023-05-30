<?php

namespace ZendExt\Dto\Stub\Poo;

use Zend\Ext\Models\Code\Generator\MethodGenerator;

use Zend\Ext\Services\Classifier\Cairo as GnomeClassifier;




class ArgumentsDto
{
    /** @var string */
    public $info;

    public $pad = 0;

    static public function create($codeGenerator, $renderer)
    {
        /** @var MethodGenerator $methodGenerator */    
        $methodGenerator = $codeGenerator;

        $dto = new self();
        
        $parameters = $methodGenerator->getParameters();
        //$enums = $methodGenerator->getOwnPackage()->getPackage()->getListTypeEnum();

        $send_by = '';
        $is_deref = $methodGenerator->returnsReference();
        if ($is_deref)
            $send_by = '&';

        $comma = '';
        $output = '';
        foreach($parameters as $parameter) {

            $output .= $comma;
            $comma = ', ';
            
            $allow_null = '';
            $send_by = '';
            $is_deref = $parameter->getPassedByReference();
            if ($is_deref) {
                $send_by = '&';
                $allow_null = $parameter->type()->nullable() ? '?' : '';
                /*TODO: $is_in = $parameter->isIn();
                if (!$is_in) {
                    $allow_null = '1';
                }*/
            }

            if ('void'==$parameter->getType()) {
                $output .= $allow_null.'mixed '.$send_by.'$'.$parameter->getName();
            } else {
                //$output .= $parameter->generate();

                $type_name = $parameter->getType();
                if (in_array($type_name, ['int', 'float', 'string', 'array', 'object', 'callable'/* ... */])) {
                    $output .= $parameter->generate();
                } else {
                    $output .= $allow_null . $renderer->transfer('TypeDto.php', $parameter->type)->name . ' ' . $send_by.'$'.$parameter->getName();
                }

            }
            //$output .= $parameter->type->generate().' '.$send_by.'$'.$parameter->getName();

        }

        $dto->info = $output;

        return $dto;
    }
}
