<?php

namespace ZendExt\Dto\Ext\Source;

use Zend\Ext\Models\Code\Generator\AbstractGenerator;
use Zend\Ext\Models\Code\Generator\FileGenerator;
use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\LicenseTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\AuthorTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\GenericTag;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;


class ArgumentsDto
{
    /** @var string */
    public $info;

    public $pad = 0;

    static public function create(AbstractGenerator $codeGenerator, $renderer)
    {
        /** @var MethodGenerator $methodGenerator */
        $methodGenerator = $codeGenerator;

        $dto = new ArgumentsDto();

        $output = '';
        $output .= self::createDeclaration($methodGenerator, $renderer);
        $output .= PHP_EOL;
        $output .= self::createParseParameters($methodGenerator, $renderer);
        $output .= PHP_EOL;
        //$output .= self::createExtraParameters($methodGenerator, $renderer);
        //$output .= PHP_EOL;

        $dto->info = $output;

        return $dto;
    }
    static public function createDeclaration(MethodGenerator $methodGenerator, $renderer)
    {
        $parameters = $methodGenerator->getParameters();
        //$enums = $methodGenerator->getOwnPackage()->getPackage()->getListTypeEnum();

        $output = '';
        /** @var ParameterGenerator $parameter */
        foreach($parameters as $parameter) {
            $is_nullable = $parameter->type ? $parameter->type->nullable() : false;
            $is_deref = $parameter->getPassedByReference();
            $is_array = $parameter->isArray();

            if ($parameter->getVariadic()) {
                $output .= '    int z_argc;'. PHP_EOL;
                $output .= '    zval *z_args = NULL;'. PHP_EOL;
            } else
            switch ($parameter->getType()) {
                case 'bool':
                    if ($is_deref || $is_array || $is_nullable) {
                        $output .= '    zval *z_'.$parameter->getName().';';
                    } else {
                        $output .= '    zend_bool z_'.$parameter->getName().';';
                    }
                    break;
                case 'int':
                    if ($is_deref || $is_array || $is_nullable) {
                        $output .= '    zval *z_'.$parameter->getName().';';
                    } else {
                        $output .= '    zend_long z_'.$parameter->getName().';';
                    }
                    break;
                case 'float':
                    if ($is_deref || $is_array || $is_nullable) {
                        $output .= '    zval *z_'.$parameter->getName().';';
                    } else {
                        $output .= '    double z_'.$parameter->getName().';';
                    }
                    break;
                case 'string':
                    if ($is_deref || $is_array || $is_nullable) {
                        $output .= '    zval *z_'.$parameter->getName().';';
                    } else {
                        $output .= '    char *z_'.$parameter->getName().';'.PHP_EOL;
                        $output .= '    int z_'.$parameter->getName().'_len;';
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
                    // is custom object
                    $output .= '    zval *z_'.$parameter->getName().';';// // zend_object for ' . $parameter->type->internal_type;
                    break;
            }
            $output .= PHP_EOL;
        }
    
        return $output;
    }

    static public function createParseParameters(MethodGenerator $methodGenerator, $renderer)
    {
        $parameters = $methodGenerator->getParameters();
        $output = '';
        $extra = '';

        if(count($parameters))
            $output .= '    ZEND_PARSE_PARAMETERS_START('. count($parameters) .', '. count($parameters).')'. PHP_EOL;
        /** @var ParameterGenerator $parameter */
        foreach($parameters as $parameter) {
            
            $allow_null = 'ZEND_SEND_NOTNULL';
            $send_by = 'ZEND_SEND_BY_VAL';
            $is_deref = $parameter->getPassedByReference();
            $is_array = $parameter->isArray();
            $is_nullable = $parameter->type ? $parameter->type->nullable() : false;
            $allow_null = $is_nullable ? 'ZEND_SEND_NULLABLE' : 'ZEND_SEND_NOTNULL';

            if ($is_deref) {
                $send_by = 'ZEND_SEND_BY_REF';
                $allow_null = 'ZEND_SEND_NULLABLE';// CHECKME
                /*TODO: $is_in = $parameter->isIn();
                if (!$is_in) {
                    $allow_null = '1';
                }*/
            }

            $allow_null = 'ZEND_SEND_NULLABLE';
            
            $check_null = $allow_null;
            //@see TypeGenerator\AtomicType::BUILT_IN_TYPES_PRECEDENCE
            // $parameter->type->internal_type
            if ($parameter->getVariadic()) {
                $output .= '        Z_PARAM_VARIADIC(\'+\', z_args, z_argc);'. PHP_EOL;
                continue;
            }

            // $parameter->type()->atomic()->type
            switch ($parameter->getType()) {
                case 'bool':
                    $output .= '        Z_PARAM_BOOL(z_'.$parameter->getName().');'. PHP_EOL;// 0 = allow_null
                    break;
                case 'int':
                    $output .= '        Z_PARAM_LONG(z_'.$parameter->getName().');'. PHP_EOL;// 0 = allow_null
                    $extra  .= '    ';
                    $extra  .= ''.$parameter->type->internal_type.' ' . $parameter->getName();
                    $extra  .= ' = z_'.$parameter->getName().';'.PHP_EOL;
                    
                    //$extra  .= ' = Z_DVAL_P(z_'.$parameter->getName().');'.PHP_EOL;
                break;
                case 'float':
                    if ($is_deref) {
                        // is_deref && is_array ?
                        $output .= '        ';
                        $output .= 'Z_PARAM_ZVAL_EX2(z_'.$parameter->getName().', '.$check_null.', ZEND_SEND_BY_REF, 0);'.PHP_EOL;
                        if ($is_array) {
                            $extra  .= '    ';
                            $extra  .= $parameter->type->internal_type.' ' . $parameter->getName() . '[1024]';
                            $extra  .= ' = {NULL};'.PHP_EOL;
                            //Z_DVAL_P(z_'.$parameter->getName().');'.$is_array.PHP_EOL;
                        } else {
                            $extra  .= '    ';
                            $extra  .= $parameter->type->internal_type.' ' . $parameter->getName();
                            $extra  .= ';'.PHP_EOL;
                            //Z_DVAL_P(z_'.$parameter->getName().');'.$is_array.PHP_EOL;
                        }
                    } else if ($is_array) {
                        $output .= '        Z_PARAM_ARRAY_EX2(z_'.$parameter->getName().', '.$check_null.', '.$send_by.', 0);'.PHP_EOL;
                        
                        //const double *dashes = zval_get_array_double(zdashes, &num_dashes);
                        $extra  .= '    ';
                        $extra  .= ''.$parameter->type->internal_type.' *' . $parameter->getName();
                        //$extra  .= ' = Z_DVAL_P(z_'.$parameter->getName().');'.PHP_EOL;
                        $extra  .= ' = zval_get_array_'.$parameter->getType().'(z_'.$parameter->getName().', &z_' . $parameter->arrayLengthParameter() . ');'.PHP_EOL;
                        //$extra  .= ' = array_double_free(z_'.$parameter->getName().';'.PHP_EOL;

                    } else if ($is_nullable) {
                        $output .= '        Z_PARAM_ARRAY_EX2(z_'.$parameter->getName().', '.$check_null.', '.$send_by.', 0);'.PHP_EOL;
                        $extra  .= '    ';
                        $extra  .= PHP_EOL;
                    } else {
                        $output .= '        Z_PARAM_DOUBLE(z_'.$parameter->getName().');'.PHP_EOL;
                        //$output .= '        Z_PARAM_ZVAL_EX2(z'.$parameter->getName().', '.$check_null.', '.$send_by.', 0);';// Z_PARAM_DOUBLE|Z_PARAM_DOUBLE_OR_NULL(ZEND_SEND_BY_VAL)
                        $extra  .= '    ';
                        $extra  .= ''.$parameter->type->internal_type.' ' . $parameter->getName();
                        //$extra  .= ' = Z_DVAL_P(z_'.$parameter->getName().');'.PHP_EOL;
                        $extra  .= ' = php_'.$parameter->getName().';'.PHP_EOL;
                    }
                    break;
                case 'string':
                    $output .= '        ';
                    //$output .= 'ZEND_ARG_TYPE_INFO(z_'.$send_by.', '.$parameter->getName().', IS_STRING, '.$allow_null.')'. PHP_EOL;// 0 = allow_null
                    $output .= 'Z_PARAM_STRING(z_'.$send_by.', z_'.$parameter->getName().', z_'.$parameter->getName().'_len);'.PHP_EOL;
                    $extra  .= '    ';
                    $extra  .= ''.$parameter->type->internal_type.' *' . $parameter->getName();
                    $extra  .= ' = z_'.$parameter->getName().';'.PHP_EOL;
                break;
                case 'array':
                case 'callable':
                case 'iterable':
                case 'object':
                /*case 'static':
                case 'mixed':
                case 'void':
                case 'false':
                case 'true':
                case 'null':
                case 'never':*/
                    break;
                default:
                    $name_function = strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', lcfirst($parameter->type->internal_type)));
        
                    $output .= '        Z_PARAM_OBJECT_OF_CLASS_EX(z_'.$parameter->getName().', php_'.$name_function.'_class_entry, 1, 0);'. PHP_EOL;

                    $extra .= '    php_' . $name_function . ' *php_' . $parameter->getName();
                    $extra .= ' = ';
                    $extra .= 'ZVAL_IS_PHP_'. strtoupper($name_function);
                    $extra .= '(z_'. $parameter->getName() . ')? ';
                    $extra .= 'ZVAL_GET_PHP_'. strtoupper($name_function);
                    $extra .= '(z_'. $parameter->getName() .'): ';// $is_deref
                    if ($is_deref) {
                        // create php_[object_type_name]_new();
                        $extra .= 'php_'.$name_function.'_new()';
                    } else {
                        $extra .= 'NULL';
                    }
                    $extra .= ';' . PHP_EOL;

                    $extra .= '    ' . $parameter->type->internal_type . ' *' . $parameter->getName() . ' = php_'.$parameter->getName();
                    $extra .= ' ? php_'.$parameter->getName().'->ptr : NULL;'.PHP_EOL;

                    break;
            }

        }
        if(count($parameters)) {
            $output .= '    ZEND_PARSE_PARAMETERS_END();'. PHP_EOL;
            $output .= PHP_EOL . $extra;
        }

        return $output;
    }

}
