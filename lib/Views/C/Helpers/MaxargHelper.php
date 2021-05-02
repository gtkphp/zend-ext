<?php

namespace Zend\Ext\Views\C\Helpers;

use Zend\View\Helper\AbstractHelper;


class MaxargHelper extends AbstractHelper
{

    public function __invoke($method)
    {
        return count($method->getParameters());
    }
}
