<?php

namespace Zend\Ext\Helpers\C;

use Zend\View\Helper\AbstractHelper;


class NameclassHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($name, int $case=0)
    {
        $tmp = self::$filter->filter($name);
        if ($case==1) {
            $tmp = strtoupper($tmp);
        } else if ($case==-1) {
            $tmp = strtolower($tmp);
        }
        return $tmp;
    }
}
