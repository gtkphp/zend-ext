<?php

namespace Zend\Ext\Views\DocBook\Helpers;

use Zend\View\Helper\AbstractHelper;
use Zend\Ext\Models\MethodGenerator;

class ReturnHelper extends AbstractHelper
{
    public function __invoke(MethodGenerator $method)
    {
        /*
        <para>
        Returns an <type>array</type> of GtkWindow objects or &false; in
        case of an error.
        </para>
        */

        $description = $method->getParameterReturn()->getDescription();

        $output = $this->getView()->commentHelper($description);

        return $output;
    }
}
