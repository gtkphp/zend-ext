<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\TypeGenerator;
use Zend\ExtGtk\Implementation;

class EndHelper extends AbstractHelper
{
    public function __invoke()
    {
        $output  = '';
        switch (Implementation::$version) {
            case '7':
                break;
            case '8':
                $output .= 'return value;'.PHP_EOL;
                break;
        }
            
        return $output;
    }
}


