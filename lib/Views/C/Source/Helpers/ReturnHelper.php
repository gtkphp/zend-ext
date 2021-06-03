<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;


class ReturnHelper extends AbstractHelper
{
    protected function isObject($type, $package) {
        $name = $type->getName();
        $objects = $package->getPackage()->getListTypeStruct();
        return isset($objects[$name]);
    }
    protected function isEnum($type, $package) {
        $name = $type->getName();
        $objects = $package->getPackage()->getListTypeEnum();
        return isset($objects[$name]);
    }

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
                $output .= '    RETURN_DOUBLE(ret);';
                break;
            case TypeGenerator::PRIMITIVE_INT:
                $output .= '    RETURN_LONG(ret);';
                break;
            case TypeGenerator::PRIMITIVE_CHAR:
                $output .= '    RETURN_STRING(ret);';
                break;
            default:
                $type_name = $method->getParameterReturn()->getType()->getName();
                $package = $method->getParentGenerator()->getOwnPackage()->getPackage();
                $enums = $package->getListTypeEnum();

                //$output .= get_class($enums[$type_name]);
                if ('cairo_bool_t'==$type_name) {
                    $output .= '    if (ret) {'.PHP_EOL;
                    $output .= '        RETURN_TRUE;'.PHP_EOL;
                    $output .= '    } else {'.PHP_EOL;
                    $output .= '        RETURN_FALSE;'.PHP_EOL;
                    $output .= '    }';
                } else if (isset($enums[$type_name])) {
                    $output .= '    RETURN_LONG(ret);';
                } else {
                    $methodType = $method->getParameterReturn()->getType();
                    $t = $methodType->getName();
                    $f = $method->getName();

                    $output .= '    zend_object *z_ret = zend_objects_new(php_'.$t.'_class_entry);'.PHP_EOL;
                    $output .= '    php_'.$t.' *php_ret = ZOBJ_TO_PHP_'.strtoupper($t).'(z_ret);'.PHP_EOL;
                    $output .= '    php_ret->ptr = z_ret;'.PHP_EOL;

                    $output .= '    RETURN_OBJ(z_ret);';

                    /*
                    $is_transfer_full = $method->getParameterReturn()->isTransferFull();
                    if ($is_transfer_full) {
                    } else {
                        $output .= '    RETURN_OBJ(z_ret);';
                    }
                    */


                
                    /*
                    $output .= '    zend_object *z_ret = php_'.$t.'_create_object(php_'.$t.'_class_entry);'.PHP_EOL;
                    $output .= '    php_'.$t.' *php_ret = ZOBJ_TO_PHP_'.strtoupper($t).'(z_ret);'.PHP_EOL;
                    $output .= '    php_ret->ptr = ret;'.PHP_EOL;
                    $output .= PHP_EOL;
                    $output .= '    RETURN_OBJ(z_ret);';
                    */
                }
                break;
        }

        return $output;
    }
}
