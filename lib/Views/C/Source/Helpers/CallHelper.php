<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;


class CallHelper extends AbstractHelper
{
    public function __invoke(MethodGenerator $method)
    {
        $parameters = $method->getParameters();
        $extra = '';

        $output = '';

        $self = NULL;
        if (/*!$method->isStatic() && */count($parameters)) {
            $self =  current($parameters);
        }
        //$output .= '    ' . $parameterTypeName . ' *' . $parameter->getName().' = php_' . $parameter->getName().'==NULL ? NULL : php_' . $parameter->getName().'->ptr;'.PHP_EOL;
        if ($self) {
            $output .= '    if (NULL=='.$self->getName().') {'.PHP_EOL;
            $output .= '        g_print("Internal Error: '.$method->getName().'\n");'.PHP_EOL;
            $output .= '        return;'.PHP_EOL;
            $output .= '    }'.PHP_EOL;
        }

        if (TypeGenerator::PRIMITIVE_VOID==$method->getType()->getPrimitiveType()) {
            $output .= '    '.$method->getName() .'(';
            $glue='';
            foreach($method->getParameters() as $parameter) {
                switch ($parameter->getType()->getPrimitiveType()) {
                    case TypeGenerator::PRIMITIVE_FLOAT:
                    case TypeGenerator::PRIMITIVE_DOUBLE:
                    case TypeGenerator::PRIMITIVE_LONG:
                    case TypeGenerator::PRIMITIVE_INT:
                    case TypeGenerator::PRIMITIVE_CHAR:
                        $output .= $glue.$parameter->getName();
                        break;
                    default:
                        if ('...'==$parameter->getName()) {
                            $output .= '    int argc;'. PHP_EOL;
                            $output .= '    zval *args = NULL;'. PHP_EOL;
                        } else {
                            $output .= $glue.$parameter->getName();
                        }
                        break;
                }
                $glue=', ';
            }
            $output .= ');';

        } else {
            $t = $method->getType()->getName();
            $f = $method->getName();
            $output .= '    '.$method->getType()->getName().' *ret = '.$f .'(';
            $glue='';
            foreach($method->getParameters() as $parameter) {
                switch ($parameter->getType()->getPrimitiveType()) {
                    case TypeGenerator::PRIMITIVE_FLOAT:
                    case TypeGenerator::PRIMITIVE_DOUBLE:
                    case TypeGenerator::PRIMITIVE_LONG:
                    case TypeGenerator::PRIMITIVE_INT:
                    case TypeGenerator::PRIMITIVE_CHAR:
                        $output .= $glue.$parameter->getName();
                        break;
                    default:
                        if ('...'==$parameter->getName()) {
                            $output .= '    int argc;'. PHP_EOL;
                            $output .= '    zval *args = NULL;'. PHP_EOL;
                        } else {
                            $output .= $glue.$parameter->getName();
                        }
                        break;
                }
                $glue=', ';
            }
            $output .= ');'.PHP_EOL;

            $output .= '    cairo_status_t status = cairo_status (ret);'.PHP_EOL;
            $output .= '    if (CAIRO_STATUS_SUCCESS==status) {'.PHP_EOL;
            $output .= '        zend_object *z_ret = php_'.$t.'_create_object(php_'.$t.'_class_entry);'.PHP_EOL;
            $output .= '        php_'.$t.' *php_ret = ZOBJ_TO_PHP_'.strtoupper($t).'(z_ret);'.PHP_EOL;
            $output .= '        php_ret->ptr = ret;'.PHP_EOL;
            $output .= '        RETURN_OBJ(z_ret);'.PHP_EOL;
            $output .= '    } else {'.PHP_EOL;
            $output .= '        const char *msg = cairo_status_to_string (status);'.PHP_EOL;
            $output .= '        zend_error(E_USER_ERROR, "%s", msg);'.PHP_EOL;
            $output .= '        RETURN_NULL();'.PHP_EOL;
            $output .= '    }'.PHP_EOL;


        }


        return $output;
    }
}
