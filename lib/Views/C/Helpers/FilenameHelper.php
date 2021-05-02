<?php

namespace Zend\Ext\Views\C\Helpers;

use Zend\Filter\Word\CamelCaseToDash;
use Zend\View\Helper\AbstractHelper;


class FilenameHelper extends AbstractHelper
{

    public function __invoke($class)
    {
        $filter = new CamelCaseToDash;
        return strtolower($filter->filter($class));
    }
}
