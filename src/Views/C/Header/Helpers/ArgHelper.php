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

        $output = '';
        $output .= 'ZEND_BEGIN_ARG_INFO_EX(arginfo_'.$method->getName().', 0, ZEND_SEND_BY_VAL, '.count($parameters).')'. PHP_EOL;
        foreach($parameters as $parameter) {
            //$output .= $parameter->getType()->getName() . ', '. $parameter->getType()->getPrimitiveType().PHP_EOL;
            switch ($parameter->getType()->getPrimitiveType()) {
                case TypeGenerator::PRIMITIVE_DOUBLE:
                    $output .= '    ZEND_ARG_TYPE_INFO(ZEND_SEND_BY_VAL, '.$parameter->getName().', IS_DOUBLE, 0)'. PHP_EOL;// 0 = allow_null
                    break;
                case TypeGenerator::PRIMITIVE_INT:
                    $output .= '    ZEND_ARG_TYPE_INFO(ZEND_SEND_BY_VAL, '.$parameter->getName().', IS_LONG, 0)'. PHP_EOL;// 0 = allow_null
                    break;
                case TypeGenerator::PRIMITIVE_CHAR:
                    $output .= '    ZEND_ARG_TYPE_INFO(ZEND_SEND_BY_VAL, '.$parameter->getName().', IS_STRING, 0)'. PHP_EOL;// 0 = allow_null
                    break;
                default:
                    $output .= '    ZEND_ARG_OBJ_INFO(ZEND_SEND_BY_VAL, '.$parameter->getName().', php_'.$parameter->getType()->getName().', 0)'. PHP_EOL;// 0 = allow_null
                    break;
            }
        }
        $output .= 'ZEND_END_ARG_INFO()'. PHP_EOL;

        return $output;
    }
}

/*

ZEND_ARG_OBJ_INFO(ZEND_SEND_BY_VAL, cr, cairo_matrix_t, 0)
    ZEND_ARG_TYPE_INFO(ZEND_SEND_BY_VAL, x, IS_DOUBLE, 0)
*/
