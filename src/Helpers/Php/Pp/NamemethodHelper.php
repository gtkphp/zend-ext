<?php

namespace Zend\Ext\Helpers\Php\Pp;

use Zend\Filter\Word\UnderscoreToDash;
use Zend\View\Helper\AbstractHelper;

use Zend\Filter\Word\UnderscoreToCamelCase;

use Zend\Ext\Models\AbstractGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\MethodGenerator;


class NamemethodHelper extends AbstractHelper
{
    static public $filter = NULL;

    protected function getPackageName($method) {
        $package = $method->getOwnPackage();
        return $package->getName();
    }

    protected function getObjectName($method) {
        $object = $method->getParentGenerator();
        return $object->getName();
    }

    public function __invoke($method)
    {
        return $method->getName();

        $object_name = $this->getObjectName($method);

        $tmp = self::$filter->filter($object_name);
        $tmp = strtolower($tmp);
        $pos = strpos($method->getName(), $tmp);

        if (False!==$pos) {
            $tmp = substr($method->getName(), $pos + strlen($tmp));
            $filter = new UnderscoreToCamelCase();
            $tmp = $filter->filter($tmp);
            $tmp = lcfirst($tmp);

            if ($tmp == 'new') {
                $tmp = '__construct';
            }
            if ($tmp == 'destroy') {
                $tmp = '__destruct';
            }
        } else {
            $filter = new UnderscoreToCamelCase;
            $tmp = $filter->filter($method->getName());
            $ns = $this->getPackageName($method);
            $pos = strpos($tmp, $ns);
            $tmp = substr($tmp, $pos+strlen($ns));
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
