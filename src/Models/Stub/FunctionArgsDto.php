<?php

namespace ZendExt\Dto\Stub;

use Zend\Ext\Models\Code\Generator\MethodGenerator;


class FunctionArgsDto
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
                $output .= $parameter->generate();
            }
            //$output .= $parameter->type->generate().' '.$send_by.'$'.$parameter->getName();

        }

        $dto->info = $output;

        return $dto;
    }
}
