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
use Zend\Ext\Models\AbstractGenerator;
use Zend\Ext\Models\ParameterGenerator;
use Zend\Ext\Exceptions\InvalidArgumentException;


use function explode;
use function is_array;
use function sprintf;
use function str_replace;
use function strtolower;
use function trim;
use function wordwrap;

// my_object_class_init(const GObject &object)
class FunctionGenerator extends ObjectGenerator
{

    protected $isStatic = FALSE;
    protected $isVirtual = FALSE;
    protected $isOverride = FALSE;
    protected $isCallback = FALSE;
    /**
     * @var Array of ParameterGenerator
     */
    protected $parameters = [];

    protected $parameter_return = null;

    public function setIsStatic(bool $isStatic=True)
    {
        $this->isStatic = $isStatic;
        return $this;
    }
    public function isStatic()
    {
        return $this->isStatic;
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
     * @var AbstractDocBlock
     */
    protected $docBlock;


    /*
    public function setType(TypeGenerator $type)
    {
        $this->type = $type;
        $this->type->setParentGenerator($this);
        return $this;
    }

    public function getType(): TypeGenerator
    {
        return $this->type;
    }
    */

    /**
     *
     * signed
     * unsigned
     * short
     * long
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;
        return $this;
    }

    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * const
     */
    public function setQualifier($qualifier)
    {
        $this->qualifier = $qualifier;
        return $this;
    }

    public function getQualifier()
    {
        return $this->qualifier;
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


    public function getParameter(string $name):?ParameterGenerator {
        if (isset($this->parameters[$name])) {
            return $this->parameters[$name];
        }
        return null;
    }

    public function getParameters() {
        return $this->parameters;
    }

    /**
     * @param  array $parameters
     * @throws InvalidArgumentException
     * @return MethodGenerator
     */
    public function setParameters($parameters) {
        $len = count($parameters);
        foreach($parameters as $parameter) {
            $this->setParameter($parameter);
        }

        return $this;
    }


    /**
     * @param  ParameterGenerator|array|string $parameter
     * @throws InvalidArgumentException
     * @return MethodGenerator
     */
    public function setParameter($parameter)
    {
        if (is_string($parameter) || is_array($parameter)) {
            $parameter = new ParameterGenerator($parameter);
        }

        if (! $parameter instanceof ParameterGenerator) {
            throw new InvalidArgumentException(sprintf(
                '%s is expecting either a string, array or an instance of %s\ParameterGenerator, %d given for %s',
                __METHOD__,
                __NAMESPACE__,
                $parameter,
                $this->getName()
            ));
        }

        $parameter->setParentGenerator($this);
        $this->parameters[$parameter->getName()] = $parameter;

        return $this;
    }

    public function getParameterReturn()
    {
        return $this->parameter_return;
    }
    
    public function setParameterReturn($parameter)
    {
        $this->parameter_return = $parameter;
        return $this;
    }
    

}
