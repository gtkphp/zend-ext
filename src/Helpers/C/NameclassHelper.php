<?php

namespace Zend\Ext\Helpers\C;

use Zend\View\Helper\AbstractHelper;


class NameclassHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($name)
    {
        $tmp = self::$filter->filter($name);
        $tmp = strtolower($tmp);
        return $tmp;
    }
}
