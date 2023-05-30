<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\TypeDocBook;

trait TraitDeclarationDocBook
{
    /**
     * @var TypeDocBook $type
     */
    protected $type;
    /**
     * const, volatile
     * @var string $qualifier
     */
    protected $qualifier;
    /**
     * unsigned, short,..
     * @var string $modifier
     */
    protected $modifier;
    /**
     * &, *, **, ...
     * @var string $modifier
     */
    protected $pass='';


    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * *
     * &
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setQualifier($qualifier)
    {
        $this->qualifier = $qualifier;
        return $this;
    }

    public function getQualifier()
    {
        return $this->qualifier;
    }

    public function setModifier($modifier)
    {
        $this->modifier = $modifier;
        return $this;
    }

    public function getModifier()
    {
        return $this->modifier;
    }

}

