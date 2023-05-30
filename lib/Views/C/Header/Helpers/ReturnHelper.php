<?php

namespace Zend\Ext\Views\C\Header\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\MethodGenerator;


class ReturnHelper extends AbstractHelper
{
    public function __invoke(MethodGenerator $method=null)
    {
        return __FILE__;
    }
}
