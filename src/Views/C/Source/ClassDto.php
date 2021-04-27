<?php

namespace Zend\Ext\Views\C\Source;

use Zend\Ext\Views\C\ClassDto as Base;
//use Zend\Ext\Views\C\Source\Implementations\Glib\GList as GListImplementation;
use Zend\Ext\Views\C\Source\Implementations\Blank as BlankImplementation;

class ClassDto extends Base {
    public $nameType;
    public $headerFile;

    public $implementations;
    function __construct() {
        $this->implementations = new BlankImplementation();
    }
}
