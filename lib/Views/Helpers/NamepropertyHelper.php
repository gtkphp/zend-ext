<?php

namespace Zend\Ext\Views\Helpers;

use Zend\View\Helper\AbstractHelper;
use Zend\Filter\Word\UnderscoreToCamelCase;

class NamepropertyHelper extends AbstractHelper
{
    public function __invoke($property)
    {
        $filter = new UnderscoreToCamelCase();
        $tmp = $filter->filter($property);
        $tmp = lcfirst($tmp);

        return $tmp;
    }

}
