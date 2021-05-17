<?php

namespace Zend\Ext\Views\C\Header\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;


class ArgHelper extends AbstractHelper
{
    public function __invoke(MethodGenerator $method)
    {
        $parameters = $method->getParameters();
        $enums = $method->getOwnPackage()->getListTypeEnum();

        $send_by = 'ZEND_SEND_BY_VAL';
        $is_deref = $method->getParameterReturn()->isDeref();
        if ($is_deref)
            $send_by = 'ZEND_SEND_BY_REF';

        $output = '';
        $output .= 'ZEND_BEGIN_ARG_INFO_EX(arginfo_'.$method->getName().', 0, '.$send_by.', '.count($parameters).')'. PHP_EOL;
        foreach($parameters as $parameter) {

            $send_by = 'ZEND_SEND_BY_VAL';
            $is_deref = $parameter->isDeref();
            if ($is_deref)
                $send_by = 'ZEND_SEND_BY_REF';
    
            //$output .= $parameter->getType()->getName() . ', '. $parameter->getType()->getPrimitiveType().PHP_EOL;
            switch ($parameter->getType()->getPrimitiveType()) {
                case TypeGenerator::PRIMITIVE_DOUBLE:
                    $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', IS_DOUBLE, 0)'. PHP_EOL;// 0 = allow_null
                    break;
                case TypeGenerator::PRIMITIVE_INT:
                    $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', IS_LONG, 0)'. PHP_EOL;// 0 = allow_null
                    break;
                case TypeGenerator::PRIMITIVE_CHAR:
                    $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', IS_STRING, 0)'. PHP_EOL;// 0 = allow_null
                    break;
                default:
                    if (isset($enums[$parameter->getType()->getName()])) {
                        $output .= '    ZEND_ARG_INFO('.$send_by.', '.$parameter->getName().')'. PHP_EOL;
                    } else {
                        if ($is_deref)
                            $output .= '    ZEND_ARG_INFO('.$send_by.', '.$parameter->getName().')'. PHP_EOL;// 0 = allow_null
                        else
                            $output .= '    ZEND_ARG_OBJ_INFO('.$send_by.', '.$parameter->getName().', '.$parameter->getType()->getName().', 0)'. PHP_EOL;
                    }
                    break;
            }
        }
        $output .= 'ZEND_END_ARG_INFO()'. PHP_EOL;

        return $output;
    }
}
