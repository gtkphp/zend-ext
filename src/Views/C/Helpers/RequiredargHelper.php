<?php

namespace Zend\Ext\Views\C\Helpers;

use Zend\View\Helper\AbstractHelper;


class RequiredargHelper extends AbstractHelper
{
    public function __invoke($method)
    {
        return count($method->getParameters());
    }
}
