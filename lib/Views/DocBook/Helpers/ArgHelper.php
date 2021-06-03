<?php

namespace Zend\Ext\Views\DocBook\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;

//<methodparam><type>string</type><parameter>path</parameter></methodparam>
class ArgHelper extends AbstractHelper
{
    public function __invoke(MethodGenerator $method)
    {
        $parameters = $method->getParameters();
        $enums = $method->getOwnPackage()->getPackage()->getListTypeEnum();

        /*$send_by = '';
        $is_deref = $method->getParameterReturn()->isDeref();
        if ($is_deref)
            $send_by = '&';*/
        $clear = false;

        $output = '';
        foreach($parameters as $parameter) {

            $allow_null = '0';
            $send_by = '';
            $is_deref = $parameter->isDeref();
            if ($is_deref) {
                $send_by = ' role="reference"';
                $is_in = $parameter->isIn();
                if (!$is_in) {
                    $allow_null = '1';
                }
            }
    
            $output .= '      <methodparam>';

            //$output .= $parameter->getType()->getName() . ', '. $parameter->getType()->getPrimitiveType().PHP_EOL;
            $is_array = $parameter->isArray();
            switch ($parameter->getType()->getPrimitiveType()) {
                case TypeGenerator::PRIMITIVE_VOID:
                    $pass = $parameter->getPass();
                    if (empty($pass)) {
                        $clear = true;
                    } else {
                        $output .= '<type>mixed</type><parameter'.$send_by.'>'.$parameter->getName().'</parameter>';
                    }

                    break;
                case TypeGenerator::PRIMITIVE_DOUBLE:
                    if($is_array) {
                        $output .= '<type>array</type><parameter'.$send_by.'>'.$parameter->getName().'</parameter>';
                    } else {
                        $output .= '<type>float</type><parameter'.$send_by.'>'.$parameter->getName().'</parameter>';
                    }
                    break;
                case TypeGenerator::PRIMITIVE_INT:
                    $output .= '<type>int</type><parameter'.$send_by.'>'.$parameter->getName().'</parameter>';
                    break;
                case TypeGenerator::PRIMITIVE_CHAR:
                    $output .= '<type>string</type><parameter'.$send_by.'>'.$parameter->getName().'</parameter>';
                    break;
                default:
                    if (isset($enums[$parameter->getType()->getName()])) {
                        $output .= '<type>int</type><parameter>'.$parameter->getName().'</parameter>';
                    } else {
                        $output .= '<type>'.$parameter->getType()->getName().'</type><parameter'.$send_by.'>'.$parameter->getName().'</parameter>';
                    }
                    break;
            }
            $output .= '</methodparam>'. PHP_EOL;
        }
        if (empty($parameters)) {
            $output .= '<void />'. PHP_EOL;
        }
        if ($clear && 1==count($parameters)) {
            return '<void />'. PHP_EOL;
        }

        return $output;
    }
}
