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
     * @var string
     */
    protected $name;
    /**
     * @var TypeGenerator
     */
    protected $type;
    /**
     * @var boolean
     */
    protected $isVariadic=False;
    /**
     * @var bool
     */
    protected $isOptional=False;


    /**
     * @var bool
     */
    //protected $defaultValue='NULL';

    /**
     * @param $option Array|String
     */
    public function __construct($options)
    {
        if (is_string($options)) {
            $this->setName($options);
        }
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

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

    /**
     * @return string
     */
    public function generate_arginfo()
    {
        $pass_by_ref = $this->getParentGenerator()->getPass() == '' ? 'FALSE': 'TRUE';
        return $pass_by_ref . ', ' . $this->getName();
    }

    /*
    public function generate($scope)
    {
        $output = '';// const unsigned char *argv[]
        $naming = new Naming\GnomeStrategy();
        $function_name = $naming->generateFunctionName($this);

        if ($this->isVariadic()) {
            return '...';
        }

        $output .= $this->getType()->generate($scope);

        $output .= ' ' . $function_name;

        if ($this->getType()->isArray()) {
            $output .= '[';
            $expression = $this->getType()->getExpressionArray();
            if ($expression!=NULL) {
                $output .= $expression;
            }
            $output .= ']';
        }

        return $output;
    }
    */

}