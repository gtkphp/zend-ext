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

class PropertyGenerator extends AbstractGenerator
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
     * @var bool
     */
    protected $isConst=False;

    /**
     * @var array of TagGenerator
     */
    protected $tags=[];


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

    /**
     * @return bool
     */
    public function isConst(): bool
    {
        return $this->isConst;
    }

    /**
     * @param bool $isConst
     */
    public function setIsConst(bool $isConst): void
    {
        $this->isConst = $isConst;
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

    /**
     */
    public function addTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    public function getTags():array
    {
        return $this->tags;
    }

}