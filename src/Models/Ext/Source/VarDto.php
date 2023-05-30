<?php

namespace ZendExt\Dto\Ext\Source;

use ZendExt\Dto\VarDto as BaseVarDto;

use Zend\Ext\Models\Code\Generator\PropertyGenerator;


class VarDto extends BaseVarDto
{

    static public function create($codeGenerator, $renderer)
    {
        /** @var PropertyGenerator $propertyGenerator */
        $propertyGenerator = $codeGenerator;

        $var = new VarDto();

        /*$var->name = $propertyGenerator->getName();
        $var->type = $propertyGenerator->getType()->__toString();*/

        return $var;
    }
}
