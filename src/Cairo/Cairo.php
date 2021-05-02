<?php

use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;

class Cairo extends Implementation {

    public $require = [
        'php_g_list_insert_sorted_real',
    ];

    function cairo_destroy() {
        return 'php_cr->ptr = NULL;';
    }

    function call_destroy(MethodGenerator $method) {
        return 'php_cr->ptr = NULL;';
    }

    function call_return_enum(MethodGenerator $method) {
    }

    function call_return_struct(MethodGenerator $method) {
        $output = '';

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
        $output .= '        //zend_internal_type_error(1, "%s", msg);'.PHP_EOL;
        $output .= '        RETURN_NULL();'.PHP_EOL;
        $output .= '    }'.PHP_EOL;

        return $output;
    }

    function php_g_list_first($list='php_g_list*') {
        return <<<EOC
    if (list) {
        while(list->prev) {
            list = list->prev;
        }
    }

    return list;
EOC;
    }
    
}
