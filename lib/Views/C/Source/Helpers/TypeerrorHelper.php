<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\TypeGenerator;
use Zend\ExtGtk\Implementation;

class TypeerrorHelper extends AbstractHelper
{
    public function __invoke($code, $message, $val, $name)
    {
        $output  = '';
        switch (Implementation::$version) {
            case '7':
                $output .= 'zend_internal_type_error('.$code.', '.$message.', '.$val.', '.$name.');';
                break;
            case '8':
                $output .= 'zend_type_error('.$message.', '.$val.', '.$name.');';
                break;
        }
            
        return $output;
    }
}


