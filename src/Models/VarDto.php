<?php

namespace ZendExt\Dto;

class VarDto
{
    /** @var string */
    public $name;
    
    /** @var string */
    public $type;

    /** @var string */
    public $dockBlock;
    
    static public function create($codeGenerator, $renderer)
    {
        return new self();
    }

}
