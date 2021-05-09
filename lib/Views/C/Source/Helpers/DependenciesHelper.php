<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;


class DependenciesHelper extends AbstractHelper
{
    public function __invoke(ClassGenerator $class)
    {
        $output = '';

        return $output;
    }
}
