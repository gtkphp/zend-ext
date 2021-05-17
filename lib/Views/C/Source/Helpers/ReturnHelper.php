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

        foreach ($method->getParameters() as $parameter) {
            $type = $parameter->getType();
            if ($parameter->isDeref()) {
                switch ($type->getPrimitiveType()) {
                    case TypeGenerator::PRIMITIVE_VOID:
                        $output .= '    RETURN_NULL();';
                        break;
                    case TypeGenerator::PRIMITIVE_DOUBLE:
                    case TypeGenerator::PRIMITIVE_FLOAT:
                        $output .= '    ZVAL_DOUBLE(z'.$parameter->getName().', '.$parameter->getName().');'.PHP_EOL;
                        break;
                    case TypeGenerator::PRIMITIVE_INT:
                        $output .= '    ZVAL_LONG(z'.$parameter->getName().', '.$parameter->getName().');'.PHP_EOL;
                        break;
                    case TypeGenerator::PRIMITIVE_CHAR:
                        $output .= '    ZVAL_STRING(z'.$parameter->getName().', '.$parameter->getName().', strlen('.$parameter->getName().'));'.PHP_EOL;
                        break;
                    default:
                        $output .= '    ZVAL_OBJ(z'.$parameter->getName().', &php_'.$parameter->getName().'->std);'.PHP_EOL;
                        break;
                }
            }
        }

        $type = $method->getParameterReturn()->getType();
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
                $type_name = $method->getParameterReturn()->getType()->getName();
                $package = $method->getParentGenerator()->getOwnPackage()->getPackage();
                $enums = $package->getListTypeEnum();

                //$output .= get_class($enums[$type_name]);
                if (isset($enums[$type_name])) {
                    $output .= '    RETURN_LONG(ret);';
                } else {
                    $output .= '    RETURN_OBJ(z_ret);';
                    //$output .= '//    RETURN_VAL(ret);'.$type->getName();
                }
                break;
        }

        return $output;
    }
}
