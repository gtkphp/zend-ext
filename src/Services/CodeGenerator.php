<?php

namespace Zend\Ext\Services;

//use Zend\Ext\Services\CodeGenerator;

class CodeGenerator
{
    /**
     * @var string $name
     */
    protected $name;

    function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CodeGenerator
     */
    public function setName(string $name): CodeGenerator
    {
        $this->name = $name;
        return $this;
    }

}
