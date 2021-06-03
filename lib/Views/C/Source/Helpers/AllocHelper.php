<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\TypeGenerator;
use Zend\ExtGtk\Implementation;

class AllocHelper extends AbstractHelper
{
    public function __invoke($class_type)
    {
        $output  = '';
        switch (Implementation::$version) {
            case '7':
                $output .= 'ecalloc(1, sizeof('.$class_type.') + zend_object_properties_size(class_type));';
                break;
            case '8':
                $output .= 'zend_object_alloc(sizeof('.$class_type.'), class_type);';
                break;
        }
        
        return $output;
    }
}
