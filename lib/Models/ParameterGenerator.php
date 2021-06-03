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
use Zend\Ext\Models\AnnotationGenerator;

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
    /**
     * @var array of AnnotationGenerator
     */
    protected $annotations = [];
    

    public function __construct($name) {
        if ('...'==$name) {
            $this->setVariadic();
        }
        parent::__construct($name);
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

    /**
     * @param array of AnnotationGenerator
     */
    public function setAnnotations(array $annotations):ParameterGenerator
    {
        $this->annotations = $annotations;
        return $this;
    }

    public function getAnnotations():array
    {
        return $this->annotations;
    }

    public function hasAnnotation(int $type):bool
    {
        foreach($this->annotations as $annotation) {
            if ($annotation->getType()==$type) {
                return true;
            }
        }
        return false;
    }

    public function isDeref():bool
    {
        $is_redef = $this->hasAnnotation(AnnotationGenerator::ANNOTATION_OUT)
                  | $this->hasAnnotation(AnnotationGenerator::ANNOTATION_INOUT);
        return $is_redef;
    }

    public function isIn():bool
    {
        $is_in = ! $this->hasAnnotation(AnnotationGenerator::ANNOTATION_OUT);
        return $is_in;
    }
    
    public function isTransferFull():bool {
        foreach($this->annotations as $annotation) {
            if ($annotation->getType() == AnnotationGenerator::ANNOTATION_TRANSFER) {
                $param = $annotation->getParam();
                if ('full'==$param) {
                    return true;
                }
            }
        }
        return false;
    }

    public function isArray():bool {
        foreach($this->annotations as $annotation) {
            if ($annotation->getType() == AnnotationGenerator::ANNOTATION_ARRAY) {
                return true;
            }
        }
        return false;
    }

}