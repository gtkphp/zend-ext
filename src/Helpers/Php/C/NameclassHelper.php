<?php

namespace Zend\Ext\Helpers\Php\C;

use Zend\View\Helper\AbstractHelper;


class NameclassHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($name)
    {
        return $name;
    }
}
