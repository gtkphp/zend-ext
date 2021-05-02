<?php

namespace Zend\Ext\Views\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;


class DocBlockHelper extends AbstractHelper
{

    public function __invoke(MethodGenerator $method)
    {
        $str_type = $this->getView()->typeHelper($method->getType());
        $glue = '';
        $param_type = '';
        foreach($method->getParameters() as $parameter) {
            $param_type .= $glue . $this->getView()->typeHelper($parameter->getType());
            $param_type .= ' '.$parameter->getName();
            $glue = ', ';
        }
        $output = "proto $str_type ".$method->getName()."($param_type)";
        //$output .= "\n * ".strip_tags($method->getShortDescription());



        return $output;
    }
}
