<?php

namespace ZendExt\Dto\Stub;

use ZendExt\Dto\VarDto as BaseVarDto;

use Zend\Ext\Models\Code\Generator\PropertyGenerator;


class VarDto extends BaseVarDto
{

    static public function create($codeGenerator, $renderer)
    {
        return new VarDto();
    }
}
