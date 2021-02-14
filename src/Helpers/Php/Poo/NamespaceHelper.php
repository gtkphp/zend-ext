<?php

namespace Zend\Ext\Helpers\Php\Poo;

use Zend\View\Helper\AbstractHelper;


class NamespaceHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($name)
    {
        $tmp = self::$filter->filter($name);
        $pos = strpos($tmp, '_');
        $name = substr($tmp, 0, $pos);
        return $name;
    }
}
