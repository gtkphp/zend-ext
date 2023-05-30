<?php

namespace ZendExt\Dto\Ext\Source;


use Zend\Ext\Models\Code\Generator\AbstractGenerator;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;

class FunctionReturnsDto
{
    public $info;

    static public function create(AbstractGenerator $codeGenerator, $renderer)
    {
        /** @var MethodGenerator $methodGenerator */
        $methodGenerator = $codeGenerator;

        $dto = new self();
        $name = $methodGenerator->getName();
        
        $output = '';
        $output .= self::createReference($methodGenerator, $renderer);
        $output .= PHP_EOL;
        $output .= self::createReturn($methodGenerator, $renderer);

        $dto->info = $output;

        return $dto;
    }

    static public function createReference(MethodGenerator $methodGenerator, $renderer)
    {
        $output = '';

        $break = "";

        /** @var ParameterGenerator $parameter */
        foreach ($methodGenerator->getParameters() as $parameter) {
            $is_deref = $parameter->getPassedByReference();
            $is_array = 0;
            $is_nullable = 0;
            /** @var TypeGenerator $type */
            $type = $parameter->getType();
            $name = $parameter->getName();
            if ($is_deref) {
                switch ($type) {
                    case 'bool':
                        $output .= '    if ('.$name.') {'.PHP_EOL;
                        $output .= '        ZVAL_TRUE(z_'.$name.');'.PHP_EOL;
                        $output .= '    } else {'.PHP_EOL;
                        $output .= '        ZVAL_FALSE(z_'.$name.');'.PHP_EOL;
                        $output .= '    }'.PHP_EOL;
                        break;
                    case 'int':
                        if ($is_array || $is_nullable) {
                            //$output .= '    zval *z_'.$parameter->getName().';';
                        } else {
                            $output .= '    ZVAL_LONG(z_'.$name.', '.$name.');'.PHP_EOL;
                        }
                        break;
                    case 'float':
                        if ($is_array) {
                            //$output .= '    zval *z_'.$parameter->getName().';';
                        } else {
                            $output .= '    ZVAL_DOUBLE(z_'.$name.', '.$name.');'.PHP_EOL;
                        }
                        break;
                    case 'string':
                        if ($is_array || $is_nullable) {
                            //$output .= '    zval *z_'.$parameter->getName().';';
                        } else {
                            $output .= '    ZVAL_STRING(z_'.$name.', '.$name.', strlen('.$name.'));'.PHP_EOL;
                        }
                        break;
                    case 'array':
                        break;
                    case 'callable':
                        break;
                    case 'iterable':
                        break;
                    case 'object':
                        break;
                    case 'static':
                        break;
                    case 'mixed':
                        break;
                    case 'void':
                        break;
                    case 'false':
                        break;
                    case 'true':
                        break;
                    case 'null':
                        break;
                    case 'never':
                        break;
                    default:
                        $output .= '    ZVAL_OBJ(z_'.$name.', &php_'.$name.'->std);'.PHP_EOL;
                        break;
                }
                //$break = PHP_EOL;
            }
        }
        $output .= $break;
    
        return $output;
    }

    static public function createReturn(MethodGenerator $methodGenerator, $renderer)
    {
        /** @var TypeGenerator $returnType */
        $returnType = $methodGenerator->getReturnType();

        $output = '';
        if ($returnType) {
            $is_nullable = $returnType->nullable();
            $is_deref = $methodGenerator->returnsReference();
            $is_array = 0;

            switch ($returnType->__toString()) {
                case 'bool':
                    $output .= '    if (ret_value) {'.PHP_EOL;
                    $output .= '        RETURN_TRUE;'.PHP_EOL;
                    $output .= '    } else {'.PHP_EOL;
                    $output .= '        RETURN_FALSE;'.PHP_EOL;
                    $output .= '    }';
                    break;
                case 'int':
                    if ($is_deref || $is_array || $is_nullable) {
                        //$output .= '    zval *z_'.$parameter->getName().';';
                    } else {
                        $output .= '    RETURN_LONG(ret_value);';
                    }
                    break;
                case 'float':
                    if ($is_deref || $is_array) {
                        //$output .= '    zval *z_'.$parameter->getName().';';
                    } else {
                        $output .= '    RETURN_DOUBLE(ret_value);';
                    }
                    break;
                case 'string':
                    if ($is_deref || $is_array || $is_nullable) {
                        //$output .= '    zval *z_'.$parameter->getName().';';
                    } else {
                        //$output .= '    char *php_'.$parameter->getName().';';
                        //$output .= '    int php_'.$parameter->getName().'_len;';
                    }
                    break;
                case 'array':
                    break;
                case 'callable':
                    break;
                case 'iterable':
                    break;
                case 'object':
                    break;
                case 'static':
                    break;
                case 'mixed':
                    break;
                case 'void':
                    $output .= '    RETURN_NULL();';
                    break;
                case 'false':
                    break;
                case 'true':
                    break;
                case 'null':
                    break;
                case 'never':
                    break;
                default:
                    $this_name = strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', lcfirst($returnType->internal_type)));

                    $output .= '    zend_object *ret_z_value = zend_objects_new(php_'.$this_name.'_class_entry);'.PHP_EOL;
                    $output .= '    php_'.$this_name.' *ret_php_value = ZOBJ_TO_PHP_'.strtoupper($this_name).'(ret_z_value);'.PHP_EOL;
                    $output .= '    ret_php_value->ptr = ret_value;'.PHP_EOL;
                    $output .= '    RETURN_OBJ(ret_z_value);';
                    break;
            }
            $output .= PHP_EOL;
        }

        return $output;
    }

}

