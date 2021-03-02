<?php

namespace Zend\Ext\Views\C\Helpers;

use Zend\View\Helper\AbstractHelper;
use Zend\Filter\Word\CamelCaseToUnderscore;


class NameclassHelper extends AbstractHelper
{
    static public $filter = Null;

    public function __invoke($name, int $case=0)
    {
        if (empty(self::$filter)) {
            self::$filter = new CamelCaseToUnderscore;
        }

        $tmp = self::$filter->filter($name);
        if ($case==1) {
            $tmp = strtoupper($tmp);
        } else if ($case==-1) {
            $tmp = strtolower($tmp);
        }
        return $tmp;
    }
}
