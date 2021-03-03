<?php

namespace Zend\Ext\Views\Helpers;

use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\View\Helper\AbstractHelper;


class NameclassHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($name, $case=0)
    {
        if (empty(self::$filter)) {
            self::$filter = new CamelCaseToUnderscore;
        }

        $tmp = self::$filter->filter($name);
        $pos = strpos($tmp, '_');
        $tmp = substr($tmp, $pos+1);
        $name = str_replace('_', '', $tmp);
        return $name;
    }
}
