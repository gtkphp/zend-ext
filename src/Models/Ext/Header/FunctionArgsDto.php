<?php

namespace ZendExt\Dto\Ext\Header;


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


class FunctionArgsDto
{
    /** @var string */
    public $info;

    public $pad = 0;

    static public function create(MethodGenerator $methodGenerator)
    {
        $dto = new self();
        
        $parameters = $methodGenerator->getParameters();
        //$enums = $methodGenerator->getOwnPackage()->getPackage()->getListTypeEnum();

        $send_by = 'ZEND_SEND_BY_VAL';
        $is_deref = $methodGenerator->returnsReference();
        if ($is_deref) {
            // if return "void *"
            if (array_key_exists($methodGenerator->getReturnType()->__toString(), TypeGenerator\AtomicType::BUILT_IN_TYPES_PRECEDENCE)) {
                $send_by = 'ZEND_SEND_BY_REF';
            } else {
            }
        }

        // TODO: use ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX
        $optional=0;

        $output = '';
        foreach($parameters as $parameter) {

            $allow_null = '0';
            $send_by = 'ZEND_SEND_BY_VAL';
            $is_deref = $parameter->getPassedByReference();
            if ($is_deref) {
                $send_by = 'ZEND_SEND_BY_REF';
                $allow_null = $parameter->type()->nullable() ? '1' : '0';

                if ($parameter->isOut()) {
                    $allow_null = '1';// ZEND_SEND_NULLABLE
                }
                /*
                if ($parameter->isArray()) {
                    //$methodGenerator->getAr
                    $parameter->arrayLengthParameter();
                }
                */
                
                /*TODO: $is_in = $parameter->isIn();
                if (!$is_in) {
                    $allow_null = '1';
                }*/
            }

            // $parameter->type()->atomic()->type
            if ($parameter->getVariadic()) {
                $output .= '    ZEND_ARG_VARIADIC_INFO('.$send_by.', '.$parameter->getName().')'. PHP_EOL;
                continue;
            }
            switch ($parameter->getType()) {
                case 'bool':
                    $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', _IS_BOOL, '.$allow_null.')'. PHP_EOL;// 0 = allow_null
                case 'int':
                    $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', IS_LONG, '.$allow_null.')'. PHP_EOL;// 0 = allow_null
                    break;
                case 'float':
                    $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', IS_DOUBLE, '.$allow_null.')'. PHP_EOL;// 0 = allow_null
                    break;
                case 'string':
                    $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', IS_STRING, '.$allow_null.')'. PHP_EOL;// 0 = allow_null
                    break;
                case 'array':
                case 'callable':
                case 'iterable':
                /*case 'static':
                case 'mixed':
                case 'void':
                case 'false':
                case 'true':
                case 'null':
                case 'never':*/
                    break;
                case 'object':
                    if ('GError'==$parameter->type->internal_type) {
                        $optional++;
                    }
                    $output .= '    ZEND_ARG_OBJ_INFO('.$send_by.', '.$parameter->getName().', '.$parameter->type->internal_type.', '.$allow_null.')'. PHP_EOL;
                    break;
                default:
                    echo "Unexpected Error at ".__FILE__.":".__LINE__." \n";
                    break;
            }
    
            /*
            //$output .= $parameter->getType()->getName() . ', '. $parameter->getType()->getPrimitiveType().PHP_EOL;
            $is_array = $parameter->isArray();
            switch ($parameter->getType()->getPrimitiveType()) {
                case TypeGenerator::PRIMITIVE_DOUBLE:
                    if($is_array) {
                        $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', IS_ARRAY, '.$allow_null.')'. PHP_EOL;
                    } else {
                        $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', IS_DOUBLE, '.$allow_null.')'. PHP_EOL;// 0 = allow_null
                    }
                    break;
                case TypeGenerator::PRIMITIVE_INT:
                    $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', IS_LONG, '.$allow_null.')'. PHP_EOL;// 0 = allow_null
                    break;
                case TypeGenerator::PRIMITIVE_CHAR:
                    $output .= '    ZEND_ARG_TYPE_INFO('.$send_by.', '.$parameter->getName().', IS_STRING, '.$allow_null.')'. PHP_EOL;// 0 = allow_null
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
            */
        }

        $info = 'ZEND_BEGIN_ARG_INFO_EX(arginfo_'.$methodGenerator->getName().', 0, '.$send_by.', '.(count($parameters)-$optional).')'. PHP_EOL;
        $info .= $output;
        $info .= 'ZEND_END_ARG_INFO()'. PHP_EOL;

        $dto->info = $info;

        return $dto;
    }
}
