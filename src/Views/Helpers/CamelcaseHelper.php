<?php

namespace Zend\Ext\Views\Helpers;

use Zend\Filter\Word\UnderscoreToCamelCase;

use Zend\View\Helper\AbstractHelper;


class CamelcaseHelper extends AbstractHelper
{
    public function __invoke($name)
    {
        $filter = new UnderscoreToCamelCase();
        return $filter->filter($name);
    }
}
