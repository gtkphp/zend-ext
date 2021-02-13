<?php

namespace Zend\Ext\Helpers\Php\Poo;

use Zend\Filter\Word\UnderscoreToDash;
use Zend\View\Helper\AbstractHelper;

use Zend\Filter\Word\UnderscoreToCamelCase;

use Zend\Ext\Models\AbstractGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\MethodGenerator;


class NamemethodHelper extends AbstractHelper
{
    static public $filter = NULL;

    protected function getObjectName($method) {
        $object = $method->getParentGenerator();
        return $object->getName();
    }

    public function __invoke($method)
    {
        $object_name = $this->getObjectName($method);

        $tmp = self::$filter->filter($object_name);
        $tmp = strtolower($tmp);
        $pos = strlen($tmp);

        $tmp = substr($method->getName(), $pos+1);
        $filter = new UnderscoreToCamelCase();
        $tmp = $filter->filter($tmp);
        $tmp = lcfirst($tmp);

        if ($tmp=='new') {
            $tmp = '__construct';
        }

        /*
        $pos = strpos($tmp, '_');
        $tmp = substr($tmp, $pos+1);
        $name = str_replace('_', '', $tmp);
        return $name;
        */

        return $tmp;
    }
}
