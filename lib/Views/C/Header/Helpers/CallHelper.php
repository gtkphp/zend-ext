<?php

namespace Zend\Ext\Views\C\Header\Helpers;

use Zend\View\Helper\AbstractHelper;
use Zend\Ext\Models\MethodGenerator;

class CallHelper extends AbstractHelper
{
    public function __invoke(MethodGenerator $method)
    {
        return '';
    }
}
