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
            $is_array = $parameter->isArray();
            $is_nullable = 0;
            /** @var TypeGenerator $type */
            $type = $parameter->getType();
            $name = $parameter->getName();
            if ($is_deref) {
                switch ($type) {
                    case 'bool':
                        if ($is_array) {
                            //$output .= '    ZVAL_LONG(&Z_REF_P(z_ref_'.$name.')->val, '.$name.');'.PHP_EOL;
                            throw new \Exception("Unexpected");
                        } else {
                            $output .= '    if (IS_REFERENCE==Z_TYPE_P(z_ref_'.$name.')) {'.PHP_EOL;
                            $output .= '        if ('.$name.') {'.PHP_EOL;
                            $output .= '            ZVAL_TRUE(&(z_ref_'.$name.')->value.ref->val);'.PHP_EOL;
                            $output .= '        } else {'.PHP_EOL;
                            $output .= '            ZVAL_FALSE(&(z_ref_'.$name.')->value.ref->val);'.PHP_EOL;
                            $output .= '        }'.PHP_EOL;
                            $output .= '    } else {'.PHP_EOL;
                            $output .= '        if ('.$name.') {'.PHP_EOL;
                            $output .= '            ZVAL_TRUE(z_ref_'.$name.');'.PHP_EOL;
                            $output .= '        } else {'.PHP_EOL;
                            $output .= '            ZVAL_FALSE(z_ref_'.$name.');'.PHP_EOL;
                            $output .= '        }'.PHP_EOL;
                            $output .= '    }'.PHP_EOL;
                        }
                        break;
                    case 'int':
                        if ($is_array) {
                            //$output .= '    ZVAL_LONG(&Z_REF_P(z_ref_'.$name.')->val, '.$name.');'.PHP_EOL;
                            throw new \Exception("Unexpected");
                        } else {
                            $output .= '    if (IS_REFERENCE==Z_TYPE_P(z_ref_'.$name.')) {'.PHP_EOL;
                            $output .= '        ZVAL_LONG(&(z_ref_'.$name.')->value.ref->val, '.$name.');'.PHP_EOL;
                            $output .= '    } else {'.PHP_EOL;
                            $output .= '        ZVAL_LONG((z_ref_'.$name.'), '.$name.');'.PHP_EOL;
                            $output .= '    }'.PHP_EOL;
                        }
                        break;
                    case 'float':
                        if ($is_array) {
                            //$output .= '    zval *z_'.$parameter->getName().';';
                            throw new \Exception("Unexpected");
                        } else {
                            $output .= '    if (IS_REFERENCE==Z_TYPE_P(z_ref_'.$name.')) {'.PHP_EOL;
                            $output .= '        ZVAL_DOUBLE(&(z_ref_'.$name.')->value.ref->val, '.$name.');'.PHP_EOL;
                            $output .= '    } else {'.PHP_EOL;
                            $output .= '        ZVAL_DOUBLE((z_ref_'.$name.'), '.$name.');'.PHP_EOL;
                            $output .= '    }'.PHP_EOL;
                        }
                        break;
                    case 'string':
                        if ($is_array) {
                            //$output .= '    zval *z_'.$parameter->getName().';';
                            throw new \Exception("Unexpected");
                        } else {
                            $output .= '    if (IS_REFERENCE==Z_TYPE_P(z_ref_'.$name.')) {'.PHP_EOL;
                            $output .= '        ZVAL_STRING(&(z_ref_'.$name.')->value.ref->val, '.$name.');'.PHP_EOL;
                            $output .= '    } else {'.PHP_EOL;
                            $output .= '        ZVAL_STRING((z_ref_'.$name.'), '.$name.');'.PHP_EOL;
                            $output .= '    }'.PHP_EOL;
    
                            //$output .= '    ZVAL_STRINGL(&Z_REF_P(z_ref_'.$name.')->val, '.$name.', strlen('.$name.'));'.PHP_EOL;
                            //$output .= '    ZVAL_STRING(z_'.$name.', '.$name.');'.PHP_EOL;
                        }
                        break;
                    case 'array':
                        echo "Unexpected " . $methodGenerator->getName() . '('.$name.')' . ' at ' . __FILE__.':'.__LINE__ . PHP_EOL;
                        //throw new \Exception("Unexpected");
                        break;
                    case 'callable':
                        echo "Unexpected " . $methodGenerator->getName() . '('.$name.')' . ' at ' . __FILE__.':'.__LINE__ . PHP_EOL;
                        //throw new \Exception("Unexpected");
                        break;
                    case 'iterable':
                        echo "Unexpected " . $methodGenerator->getName() . '('.$name.')' . ' at ' . __FILE__.':'.__LINE__ . PHP_EOL;
                        //throw new \Exception("Unexpected");
                        break;
                    case 'static':
                        echo "Unexpected " . $methodGenerator->getName() . '('.$name.')' . ' at ' . __FILE__.':'.__LINE__ . PHP_EOL;
                        //throw new \Exception("Unexpected");
                        break;
                    case 'mixed':
                        echo "Unexpected " . $methodGenerator->getName() . '('.$name.')' . ' at ' . __FILE__.':'.__LINE__ . PHP_EOL;
                        /*
                        throw new \Exception("Unexpected " . $methodGenerator->getName() . '('.$name.')');
                        if ($is_array) {
                            throw new \Exception("Unexpected");
                        } else {
                            $output .= '    if (IS_REFERENCE==Z_TYPE_P(z_ref_'.$name.')) {'.PHP_EOL;
                            $output .= '        ZVAL_STRING(&(z_ref_'.$name.')->value.ref->val, '.$name.');'.PHP_EOL;
                            $output .= '    } else {'.PHP_EOL;
                            $output .= '        ZVAL_STRING((z_ref_'.$name.'), '.$name.');'.PHP_EOL;
                            $output .= '    }'.PHP_EOL;
                        }*/
                        break;
                    case 'void':
                        echo "Unexpected " . $methodGenerator->getName() . '('.$name.')' . ' at ' . __FILE__.':'.__LINE__ . PHP_EOL;
                        //throw new \Exception("Unexpected");
                        break;
                    case 'object':
                        if ($parameter && 'GError'==$parameter->type->internal_type) {
                            $error_name = $parameter->getName();
                            $output .= '    if ('.$error_name.') {'.PHP_EOL;
                            $output .= '        if (z_'.$error_name.') {'.PHP_EOL;
                            $output .= '            php_g_error *ret_p_'.$error_name.' = php_g_error_new('.$error_name.');'.PHP_EOL;
                            $output .= '            zend_object *ret_z_'.$error_name.' = &ret_p_'.$error_name.'->std;'.PHP_EOL;
                            $output .= '            ZVAL_OBJ(z_'.$error_name.', ret_z_'.$error_name.');'.PHP_EOL;
                            $output .= '        } else {'.PHP_EOL;
                            $output .= '            zend_error(E_USER_ERROR, "%s#%d: %s", g_quark_to_string(error->domain), error->code, error->message);'.PHP_EOL;
                            $output .= '        }'.PHP_EOL;
                            $output .= '    }'.PHP_EOL;
                        } else {
                            $output .= '    ZVAL_OBJ(z_'.$name.', &php_'.$name.'->std);'.PHP_EOL;
                        }
                        break;
                    case 'false':
                    case 'true':
                    case 'null':
                    case 'never':
                    default:
                        echo "Error: Unexpected '$type' at ".__FILE__.":".__LINE__." \n";
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
            $is_array = $methodGenerator->getReturnsArray();

            switch ($returnType->__toString()) {
                case 'bool':
                    $output .= '    if (ret_value) {'.PHP_EOL;
                    $output .= '        RETURN_TRUE;'.PHP_EOL;
                    $output .= '    } else {'.PHP_EOL;
                    $output .= '        RETURN_FALSE;'.PHP_EOL;
                    $output .= '    }';
                    break;
                case 'int':
                    if ($is_array) {
                        //$output .= '    zval *z_'.$parameter->getName().';';
                        $output .= '    zend_array *ret_z_arr = convert_intv_to_array(ret_value);'.PHP_EOL;
                        $output .= '    g_free(ret_value);'.PHP_EOL;
                        $output .= '    RETURN_ARR(ret_z_arr);';
                    } else {
                        $output .= '    RETURN_LONG(ret_value);';
                    }
                    break;
                case 'float':
                    if ($is_array) {
                        //$output .= '    zval *z_'.$parameter->getName().';';
                        $output .= '    zend_array *ret_z_arr = convert_floatv_to_array(ret_value);'.PHP_EOL;
                        $output .= '    g_free(ret_value);'.PHP_EOL;
                        $output .= '    RETURN_ARR(ret_z_arr);';
                    } else if ($is_deref) {
                        throw new \Exception("Unexpected " . $methodGenerator->getName());
                    } else {
                        $output .= '    RETURN_DOUBLE(ret_value);';
                    }
                    break;
                case 'string':
                    if ($is_array) {//$is_deref || $is_nullable || 
                        $output .= '    zend_array *ret_z_arr = convert_strv_to_array(ret_value);'.PHP_EOL;
                        $output .= '    g_strfreev(ret_value);'.PHP_EOL;
                        $output .= '    RETURN_ARR(ret_z_arr);';
                    } else {
                        $output .= '    RETURN_STRING(ret_value);';
                        //$output .= '    char *php_'.$parameter->getName().';';
                        //$output .= '    int php_'.$parameter->getName().'_len;';
                    }
                    break;
                case 'array':
                    throw new \Exception("Unexpected " . $methodGenerator->getName());
                    break;
                case 'callable':
                    $output .= '    ZVAL_FUNC(return_value, ret_value);';
                    $output .= PHP_EOL . "//Unexpected " .$returnType->internal_type .' for '. $methodGenerator->getName();
                    break;
                case 'iterable':
                    throw new \Exception("Unexpected " . $methodGenerator->getName());
                    break;
                case 'static':
                    throw new \Exception("Unexpected " . $methodGenerator->getName());
                    break;
                case 'mixed':
                    $output .= '    RETURN_ZVAL(ret_value);';
                    break;
                case 'void':
                    $output .= '    RETURN_NULL();';// what about deref ? (void*)
                    break;
                case 'false':
                    throw new \Exception("Unexpected " . $methodGenerator->getName());
                    break;
                case 'true':
                    throw new \Exception("Unexpected " . $methodGenerator->getName());
                    break;
                case 'null':
                    throw new \Exception("Unexpected " . $methodGenerator->getName());
                    break;
                case 'never':
                    throw new \Exception("Unexpected " . $methodGenerator->getName());
                    break;
                case 'object':
                    $this_name = strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', lcfirst($returnType->internal_type)));

                    $output .= '    zend_object *ret_z_value = php_'.$this_name.'_create_object(php_'.$this_name.'_class_entry);'.PHP_EOL;
                    $output .= '    php_'.$this_name.' *ret_p_value = ZOBJ_TO_PHP_'.strtoupper($this_name).'(ret_z_value);'.PHP_EOL;
                    $output .= '    ret_p_value->ptr = ret_value;'.PHP_EOL;
                    $output .= '    RETURN_OBJ(ret_z_value);';
                    break;
                default:
                    echo "Error: Unexpected '$returnType' at ".__FILE__.":".__LINE__." \n";
                    break;
            }
            $output .= PHP_EOL;
        }

        return $output;
    }

}

