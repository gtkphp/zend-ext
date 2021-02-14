<?php

namespace Zend\Ext\Helpers\Php\Poo;

use Zend\View\Helper\AbstractHelper;


class NameclassHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($name)
    {
        $tmp = self::$filter->filter($name);
        $pos = strpos($tmp, '_');
        $tmp = substr($tmp, $pos+1);
        $name = str_replace('_', '', $tmp);
        return $name;
    }
}
