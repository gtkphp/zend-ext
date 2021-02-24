<?php
/**
 * Zend Extension (https://github.com/Glash-Gnome)
 *
 * @link      https://github.com/Glash-Gnome/zend-ext for the canonical source repository
 * @copyright Copyright (c) 2021-2021 Glash. <5312910@php.net>
 * @license   GPL 3.0
 */


namespace Zend\Ext\Models;

//use Zend\Code\Generator\DocBlock\Tag;
//use Zend\Code\Generator\DocBlock\Tag\TagInterface;
//use Zend\Code\Generator\DocBlock\TagManager;
//use Zend\Code\Reflection\DocBlockReflection;
use PHPUnit\Runner\Exception;
use Zend\Ext\Models\AbstractGenerator;

use Zend\Ext\Models\TypeGenerator;

use function explode;
use function is_array;
use function sprintf;
use function str_replace;
use function strtolower;
use function trim;
use function wordwrap;

class ParameterGenerator extends AbstractGenerator
{
    /**
     * @var TypeGenerator $type
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

    /**
     * @var boolean
     */
    protected $isVariadic=False;
    /**
     * @var bool
     */
    protected $isOptional=False;
    /**
     * @var bool $isCallback
     */
    protected $isCallback = FALSE;


    public function setType($type)
    {
        if ($type instanceof TypeGenerator) {
            $this->type = $type;
        } else if (is_string($type)) {
            $this->type = new TypeGenerator($type);
        } else {
            throw new Exception("Invalid type parameter");
        }
        $type->setParentGenerator($this);
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setVariadic($isVariadic=true)
    {
        $this->isVariadic = $isVariadic;
        return $this;
    }

    public function isVariadic()
    {
        return $this->isVariadic;
    }
    /**
     * @return bool
     */
    public function isOptional(): bool
    {
        return $this->isOptional;
    }

    /**
     * @param bool $isOptional
     */
    public function setIsOptional(bool $isOptional): void
    {
        $this->isOptional = $isOptional;
    }

    public function setIsCallback(bool $isCallback=True)
    {
        $this->isCallback = $isCallback;
        return $this;
    }
    public function isCallback()
    {
        return $this->isCallback;
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

}