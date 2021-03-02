<?php

namespace Zend\Ext\Views\Helpers;

use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\View\Helper\AbstractHelper;


class NamespaceHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($name, $case=0)
    {
        if (empty(self::$filter)) {
            self::$filter = new CamelCaseToUnderscore;
        }
        $tmp = self::$filter->filter($name);
        $pos = strpos($tmp, '_');
        $name = substr($tmp, 0, $pos);
        if ($case==-1) {
            return strtolower($name);
        } else if ($case==1) {
            return strtoupper($name);
        }
        return $name;
    }
}
