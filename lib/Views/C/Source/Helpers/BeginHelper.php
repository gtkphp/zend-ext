<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\TypeGenerator;
use Zend\ExtGtk\Implementation;

class BeginHelper extends AbstractHelper
{
    public function __invoke($name_function, $function, string $params)
    {
        $macro = $this->getView()->nameclassHelper($name_function, 1);

        $output  = '';
        switch (Implementation::$version) {
            case '7':
                $output .= 'void'.PHP_EOL;
                $output .= 'php_'. $name_function .'_'.$function.'(zval *object, zval *member, '.$params.')'.PHP_EOL;
                $output .= '{'.PHP_EOL;
                $output .= '    php_'. $name_function .' *intern = ZVAL_GET_PHP_'.$macro.'(object);'.PHP_EOL;
                $output .= '    zend_string *member_str = member->value.str;'.PHP_EOL;
                break;
            case '8':
                $output .= 'zval*'.PHP_EOL;
                $output .= 'php_'. $name_function .'_'.$function.'(zend_object *object, zend_string *member_str, '.$params.')'.PHP_EOL;
                $output .= '{'.PHP_EOL;
                $output .= '    php_'. $name_function .' *intern = ZOBJ_TO_PHP_'.$macro.'(object);'.PHP_EOL;
                break;
        }
            
        return $output;
    }
}


