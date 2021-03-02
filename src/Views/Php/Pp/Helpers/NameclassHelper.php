<?php

namespace Zend\Ext\Views\Php\Pp\Helpers;

use Zend\View\Helper\AbstractHelper;


class NameclassHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($name)
    {
        return $name;
    }
}
