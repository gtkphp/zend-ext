<?php

namespace Zend\Ext\Views\DocBook\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;

use Zend\ExtGtk\Implementation;

class CallHelper extends AbstractHelper
{
    // TODO: generalize
    protected function isObject($type, $package) {
        $name = $type->getName();
        $objects = $package->getPackage()->getListTypeStruct();
        return isset($objects[$name]);
    }
    protected function isEnum($type, $package) {
        $name = $type->getName();
        $objects = $package->getPackage()->getListTypeEnum();
        return isset($objects[$name]);
    }
    // TODO: end generalize

    public function __invoke(MethodGenerator $method)
    {
        //<modifier>public</modifier> <type>array</type><methodname>function_name</methodname>
        $output  = '';

        $output .= '      <modifier>public</modifier>'.PHP_EOL;
        if (TypeGenerator::PRIMITIVE_VOID==$method->getParameterReturn()->getType()->getPrimitiveType()) {
        } else {
            $methodType = $method->getParameterReturn()->getType();
            $pass = $method->getParameterReturn()->getPass();
            $qualifier = $method->getParameterReturn()->getQualifier();
            // TODO: modifier

            $t = $methodType->getName();
            $f = $method->getName();
            if ($this->isObject($methodType, $method->getOwnPackage())) {
                $output .= '      <type>'.$methodType->getName().'</type>'.PHP_EOL;
            } else {
            }
        }

        $output .= '      <methodname>'.$method->getName().'</methodname>'.PHP_EOL;
        

        return $output;
    }
}
