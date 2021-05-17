<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;
use Zend\Ext\Models\AnnotationGenerator;

class ArgHelper extends AbstractHelper
{
    public function __invoke(MethodGenerator $method)
    {

        $parameters = $method->getParameters();
        $extra = '';
        $enums = $method->getOwnPackage()->getListTypeEnum();


        $output = '';
        foreach($parameters as $parameter) {
            $is_deref = $parameter->isDeref();
            switch ($parameter->getType()->getPrimitiveType()) {
                case TypeGenerator::PRIMITIVE_DOUBLE:
                    if ($is_deref) {
                        $output .= '    zval *z'.$parameter->getName().';'. PHP_EOL;// 0 = allow_null
                    } else {
                        $output .= '    double '.$parameter->getName().';'. PHP_EOL;// 0 = allow_null
                    }
                    break;
                case TypeGenerator::PRIMITIVE_INT:
                    if ($is_deref) {
                        $output .= '    zval *z'.$parameter->getName().';'. PHP_EOL;// 0 = allow_null
                    } else {
                        $output .= '    zend_long '.$parameter->getName().';'.PHP_EOL;
                    }
                    break;
                case TypeGenerator::PRIMITIVE_CHAR:
                    if ($is_deref) {
                        $output .= '    zval *z'.$parameter->getName().';'. PHP_EOL;// 0 = allow_null
                    } else {
                        $output .= '    char *'.$parameter->getName().';'. PHP_EOL;
                        $output .= '    int '.$parameter->getName().'_len;'. PHP_EOL;
                    }
                    break;
                default:
                    if ('...'==$parameter->getName()) {
                        $output .= '    int argc;'. PHP_EOL;
                        $output .= '    zval *args = NULL;'. PHP_EOL;
                    } else {
                        if (isset($enums[$parameter->getType()->getName()])) {
                            if ($is_deref) {
                                $output .= '    zval *z'.$parameter->getName().';'. PHP_EOL;// 0 = allow_null
                            } else {
                                $output .= '    zend_long z'.$parameter->getName().';'. PHP_EOL;
                            }
                        } else {
                            //$output .= '    php_'.$parameter->getType()->getName().' *'.$parameter->getName().';'. PHP_EOL;
                            $output .= '    zval *z'.$parameter->getName().';'. PHP_EOL;
                        }
                    }
                    break;
            }
        }

        $output .= PHP_EOL;
        
        if(count($parameters))
            $output .= '    ZEND_PARSE_PARAMETERS_START('. count($parameters) .', '. count($parameters).')'. PHP_EOL;
        foreach($parameters as $parameter) {
            $is_deref = $parameter->isDeref();

            //$output .= $parameter->getType()->getName() . ', '. $parameter->getType()->getPrimitiveType().PHP_EOL;
            switch ($parameter->getType()->getPrimitiveType()) {
                case TypeGenerator::PRIMITIVE_DOUBLE:
                    if ($is_deref) {
                        $output .= '        Z_PARAM_ZVAL_DEREF(z'.$parameter->getName().')'. PHP_EOL;// 0 = allow_null
                        $extra .= '    double ' . $parameter->getName();
                        $extra .= ' = ';
                        $extra .= 'z'.$parameter->getName().'->value.dval;'.PHP_EOL;
                    } else {
                        $output .= '        Z_PARAM_DOUBLE('.$parameter->getName().')'. PHP_EOL;// 0 = allow_null
                    }
                    break;
                case TypeGenerator::PRIMITIVE_INT:
                    if ($is_deref) {
                        $output .= '        Z_PARAM_ZVAL_DEREF(z'.$parameter->getName().')'. PHP_EOL;// 0 = allow_null
                        $extra .= '    zend_long ' . $parameter->getName();
                        $extra .= ' = ';
                        $extra .= 'z'.$parameter->getName().'->value.lval;'.PHP_EOL;
                    } else {
                        $output .= '        Z_PARAM_LONG(ZEND_SEND_BY_VAL, '.$parameter->getName().')'. PHP_EOL;
                    }
                    break;
                case TypeGenerator::PRIMITIVE_CHAR:
                    if ($is_deref) {
                        $output .= '        Z_PARAM_ZVAL_DEREF(z'.$parameter->getName().')'. PHP_EOL;// 0 = allow_null
                        $extra .= '    char *' . $parameter->getName();
                        $extra .= ' = ';
                        $extra .= 'z'.$parameter->getName().'->value.str.val;'.PHP_EOL;
                    } else {
                        $output .= '        Z_PARAM_STRING(ZEND_SEND_BY_VAL, '.$parameter->getName().', '.$parameter->getName().'_len)'. PHP_EOL;
                    }
                    break;
                default:
                    if ('...'==$parameter->getName()) {
                        $output .= '        Z_PARAM_VARIADIC(\'+\', args, argc);'. PHP_EOL;
                    } else {
                        $parameterTypeName = $parameter->getType()->getName();
                        $nameFunction = $this->getView()->nameclassHelper($parameterTypeName, -1);
                        if (isset($enums[$parameterTypeName])) {
                            $output .= '        Z_PARAM_LONG(z'.$parameter->getName().')'. PHP_EOL;

                            $extra .= '    '.$parameterTypeName . ' '.$parameter->getName() . ' = z' . $parameter->getName() . ';'. PHP_EOL;
                        } else {
                            $is_deref = $parameter->isDeref();
                            $lazy = 'NULL';
                            if ($is_deref) {
                                $output .= '        Z_PARAM_ZVAL_DEREF_EX(z'.$parameter->getName().', 0, 0)'. PHP_EOL;
                                $lazy = 'php_'.$parameterTypeName.'_new()';
                            } else {
                                $output .= '        Z_PARAM_OBJECT_OF_CLASS_EX(z'.$parameter->getName().', php_'.$nameFunction.'_class_entry, 1, 0)'. PHP_EOL;
                            }
                            $extra .= '    php_' . $parameterTypeName . ' *php_' . $parameter->getName();
                            $extra .= ' = ';
                            $extra .= 'ZVAL_IS_PHP_'. strtoupper($parameterTypeName);
                            $extra .= '(z'. $parameter->getName() . ')? ';
                            $extra .= 'ZVAL_GET_PHP_'. strtoupper($parameterTypeName);
                            $extra .= '(z'. $parameter->getName() .'): '.$lazy.';'.PHP_EOL;
    
                            $extra .= '    ' . $parameterTypeName . ' *' . $parameter->getName();
                            $extra .= ' = ';
                            $extra .= ' php_'. $parameter->getName() .' ? php_'.$parameter->getName().'->ptr : NULL;'.PHP_EOL;

                        }
                    }
                    break;
            }
        }
        if(count($parameters))
            $output .= '    ZEND_PARSE_PARAMETERS_END();'. PHP_EOL;

        if (!empty($extra)) {
            $output .= PHP_EOL.$extra;
        }

        return $output;
    }
}
