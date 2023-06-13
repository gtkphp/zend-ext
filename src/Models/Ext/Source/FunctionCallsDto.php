<?php

namespace ZendExt\Dto\Ext\Source;


use Zend\Ext\Models\Code\Generator\AbstractGenerator;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;

class FunctionCallsDto
{
    public $info='';

    static public function create(AbstractGenerator $codeGenerator, $renderer)
    {
        /** @var MethodGenerator $methodGenerator */
        $methodGenerator = $codeGenerator;

        /** @var ClassGenerator $classGenerator */
        $dto = new self();
        $name = $methodGenerator->getName();
        
        $dto->info= self::createCall($codeGenerator, $renderer);

        return $dto;
    }

    static public function createCall(MethodGenerator $methodGenerator, $renderer)
    {
        $output = '';
        $extra = '';

        $output .= '    ';

        //echo $methodGenerator->instance_name, PHP_EOL;

        $typeReturn = $methodGenerator->getReturnType();
        if ('void'==$typeReturn->__toString() ) {
            if ($methodGenerator->returnsReference()) {
                $output .= $typeReturn->internal_type .' *ret_value = ';
            }
        } else {
            $output .= $typeReturn->internal_type .' '.$methodGenerator->getReturnsPointer().'ret_value = ';
        }

        $output .= $methodGenerator->getName() .'(';

        $last_parameter = null;
        $break='';
        $glue='';
        /** @var ParameterGenerator $parameter */
        foreach ($methodGenerator->getParameters() as $parameter) {
            $last_parameter = $parameter;
            $is_deref = $parameter->getPassedByReference();
            $is_array = $parameter->isArray();
            $is_nullable = 0;
            $deref = $is_deref ? '&' : '';

            /** @var TypeGenerator $type */
            $type = $parameter->getType();
            $name = $parameter->getName();

            switch ($type) {
                case 'bool':
                    $output .= $glue . $deref . $name;
                    break;
                case 'int':
                    if ($is_array || $is_nullable) {
                        //$output .= '    zval *z_'.$parameter->getName().';';
                    } else {
                        $output .= $glue . $deref . $name;
                    }
                    break;
                case 'float':
                    if ($is_array) {
                        //$output .= '    zval *z_'.$parameter->getName().';';
                    } else {
                        $output .= $glue . $deref . $name;
                    }
                    break;
                case 'string':
                    if ($is_array) {
                        $output .= $glue . $deref . $name;
                        $extra .= '    free('.$name.');';
                    } else {
                        $output .= $glue . $deref . $name;
                    }
                    break;
                case 'array':
                    break;
                case 'callable':
                    break;
                case 'iterable':
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
                case 'object':
                    $output .= $glue . $deref . $name;
                    break;
                default:
                    echo "Unexpected '".$type."' for '".$name."' at ".$methodGenerator->getName()."() in ".__FILE__.":".__LINE__." \n";
                    break;
            }

            $glue=', ';
            $break=PHP_EOL;
        }

        $output .= ');'.$break;
        $output .= $extra;

        if ($methodGenerator->is_free) {
            $parametersGenerator = $methodGenerator->getParameters();
            if (count($parametersGenerator)) {
                $parameterGenerator = current($parametersGenerator);
                $output .= '    p_'.$parameterGenerator->getName().'->ptr = NULL;'.PHP_EOL;
            }
        }


        return $output;
    }

}

