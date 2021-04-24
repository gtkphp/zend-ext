<?php

namespace Zend\Ext\Views\C\Source;

use Zend\Ext\Views\C\MethodDto as Base;

class MethodDto extends Base {
    public $min_parameters;
    public $max_parameters;
    public $docblock;
}
