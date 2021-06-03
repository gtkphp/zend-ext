<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\TypeGenerator;
use Zend\ExtGtk\Implementation;

class ZvaltypeHelper extends AbstractHelper
{
    public function __invoke($name)
    {
        $output  = '';
        switch (Implementation::$version) {
            case '7':
                $output .= 'zend_string *type = zend_zval_get_type('.$name.');';
                $output .= 'char *type_name = type->val;';
                break;
            case '8':
                $output .= 'const char *type_name = zend_zval_type_name('.$name.');';
                break;
        }
            
        return $output;
    }
}
