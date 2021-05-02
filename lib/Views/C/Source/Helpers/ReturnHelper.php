<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;


class ReturnHelper extends AbstractHelper
{
    public function __invoke(MethodGenerator $method)
    {
        $output = '';
        $type = $method->getType();

        switch ($type->getPrimitiveType()) {
            case TypeGenerator::PRIMITIVE_VOID:
                $output .= '    RETURN_NULL();';
                break;
            case TypeGenerator::PRIMITIVE_DOUBLE:
            case TypeGenerator::PRIMITIVE_FLOAT:
                $output .= '    RETURN_DOUBLE(z_ret);';
                break;
            case TypeGenerator::PRIMITIVE_INT:
                $output .= '    RETURN_LONG(z_ret);';
                break;
            case TypeGenerator::PRIMITIVE_CHAR:
                $output .= '    RETURN_STRING(z_ret);';
                break;
            default:
                $output .= '    RETURN_OBJ(z_ret);';
                $output .= '//    RETURN_VAL(ret);';
                break;
        }

        return $output;
    }
}
