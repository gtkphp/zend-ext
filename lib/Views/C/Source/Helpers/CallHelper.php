<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;

use Zend\ExtGtk\Implementation;

class CallHelper extends AbstractHelper
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
        $parameters = $method->getParameters();
        $extra = '';

        $output = '';

        $self = NULL;
        if (/*!$method->isStatic() && */count($parameters)) {
            $self =  current($parameters);
        }
        //$output .= '    ' . $parameterTypeName . ' *' . $parameter->getName().' = php_' . $parameter->getName().'==NULL ? NULL : php_' . $parameter->getName().'->ptr;'.PHP_EOL;
        /*
        if ($self && $this->isObject($self->getType(), $method->getOwnPackage())) {
            // TODO use PHP_GTK_ASSERT($self->getName(), $method->getName());
            $output .= '    if (NULL=='.$self->getName().') {'.PHP_EOL;
            $output .= '        g_print("Internal Error: '.$method->getName().'\n");'.PHP_EOL;
            $output .= '        return;'.PHP_EOL;
            $output .= '    }'.PHP_EOL;
        }
        */

        //$impl = new Implementation::Factory($method->getOwnPackage()->getName());
        $impl = Implementation::Factory($method->getOwnPackage()->getOwnPackage()->getName());

        $class = $method->getParentGenerator();
        if ($class) {
            $class_name = $class->getName();
            if (isset($impl->$class_name)) {
                if (method_exists ($impl->$class_name, $method->getName())) {
                    $output .= call_user_func([$impl->$class_name, $method->getName()]); 
                    return $output;
                }
            }
        } else {
            echo $method->getName().' do not have parentGenerator'.PHP_EOL;
            if ($method->getOwnPackage()) {
                echo '  '.$method->getOwnPackage()->getName().PHP_EOL;
            } else {
                echo '         do not have Package'.PHP_EOL;
            }
        }

        if (TypeGenerator::PRIMITIVE_VOID==$method->getParameterReturn()->getType()->getPrimitiveType()) {
            $output .= '    '.$method->getName() .'(';
            $glue='';
            foreach($method->getParameters() as $parameter) {
                $is_deref = $parameter->isDeref();
                switch ($parameter->getType()->getPrimitiveType()) {
                    case TypeGenerator::PRIMITIVE_FLOAT:
                    case TypeGenerator::PRIMITIVE_DOUBLE:
                    case TypeGenerator::PRIMITIVE_LONG:
                    case TypeGenerator::PRIMITIVE_INT:
                    case TypeGenerator::PRIMITIVE_CHAR:
                        if ($is_deref) {
                            $output .= $glue.'&'.$parameter->getName();
                        } else {
                            $output .= $glue.$parameter->getName();
                        }
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
            $methodType = $method->getParameterReturn()->getType();
            $pass = $method->getParameterReturn()->getPass();
            $qualifier = $method->getParameterReturn()->getQualifier();
            // TODO: modifier

            $t = $methodType->getName();
            $f = $method->getName();
            if ($this->isObject($methodType, $method->getOwnPackage())) {
                $output .= '    '.$methodType->getName().' *ret = '.$f .'(';
            } else {
                $decl = (empty($qualifier)?'':$qualifier.' ')
                      . $this->getView()->typeHelper($methodType)
                      . (empty($pass)?' ':' '.$pass)
                      ;
                $output .= '    '.$decl.'ret = '.$f .'(';
            }
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

            /*
            if ($this->isEnum($methodType, $method->getOwnPackage())) {
                $output .= '    RETURN_LONG(ret);'.PHP_EOL;
            } elseif ($methodType->isPrimitive()) {
                switch ($methodType->getPrimitiveType()) {
                    case TypeGenerator::PRIMITIVE_FLOAT:
                    case TypeGenerator::PRIMITIVE_DOUBLE:
                        $output .= '    RETURN_DOUBLE(ret);'.PHP_EOL;
                        break;
                    case TypeGenerator::PRIMITIVE_LONG:
                    case TypeGenerator::PRIMITIVE_INT:
                        $output .= '    RETURN_LONG(ret);'.PHP_EOL;
                        break;
                    case TypeGenerator::PRIMITIVE_CHAR:
                        $output .= '    RETURN_STRING(ret);'.PHP_EOL;
                        break;
                    default:
                        if ('...'==$methodType->getName()) {
                            $output .= '    int argc;'. PHP_EOL;
                            $output .= '    zval *args = NULL;'. PHP_EOL;
                        } else {
                            $output .= '    #error Not checked: '.__FILE__.PHP_EOL;
                            //$output .= '    RETURN_ZVAL(ret);'.PHP_EOL;
                            //$output .= $glue.$self->getName();
                        }
                        break;
                }
            } else {
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
            */
        }
        return $output;
    }
}
