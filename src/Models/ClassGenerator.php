<?php
/**
 * Zend Extension (https://github.com/Glash-Gnome)
 *
 * @link      https://github.com/Glash-Gnome/zend-ext for the canonical source repository
 * @copyright Copyright (c) 2021-2021 Glash. <5312910@php.net>
 * @license   GPL 3.0
 */

namespace Zend\Ext\Models;

//use Zend\Code\Reflection\ClassReflection;
use Zend\Ext\Models\AbstractGenerator;
use Zend\Ext\Exceptions\InvalidArgumentException;

use function array_diff;
use function array_map;
use function array_pop;
use function array_search;
use function array_walk;
use function call_user_func_array;
use function explode;
use function get_class;
use function gettype;
use function implode;
use function in_array;
use function is_array;
use function is_scalar;
use function is_string;
use function ltrim;
use function sprintf;
use function str_replace;
use function strrpos;
use function strstr;
use function strtolower;
use function substr;

class ClassGenerator extends AbstractGenerator //implements TraitUsageInterface
{
    const FLAG_ABSTRACT = 0x01;
    const FLAG_FINAL    = 0x02;

    /**
     * @var FileGenerator
     */
    protected $containingFileGenerator;

    /**
     * @var DocBlockGenerator
     */
    protected $docBlock;

    /**
     * @var bool
     */
    protected $flags = 0x00;

    /**
     * @var string
     */
    protected $extendedClass;

    /**
     * @var array Array of string names
     */
    protected $implementedInterfaces = [];

    /**
     * @var PropertyGenerator[] Array of properties
     */
    protected $properties = [];

    /**
     * @var PropertyGenerator[] Array of constants
     */
    protected $constants = [];

    /**
     * @var MethodGenerator[] Array of methods
     */
    protected $methods = [];

    /**
     * The vtable
     * @var ClassGenerator virtual table
     */
    protected $virtual;

    /**
     * @var TraitUsageGenerator Object to encapsulate trait usage logic
     */
    protected $traitUsageGenerator;

    /**
     * @var array Objects related to this object
     */
    protected $relatedObjects;

    /**
     * @param  string $name
     * @param  array|string $flags
     * @param  string $extends
     * @param  array $interfaces
     * @param  array $properties
     * @param  array $methods
     * @param  DocBlockGenerator $docBlock
     */
    public function __construct(
        $name = null,
        $flags = null,
        $extends = null,
        $interfaces = [],
        $properties = [],
        $methods = [],
        $docBlock = null
    ) {
        //$this->traitUsageGenerator = new TraitUsageGenerator($this);

        if ($name !== null) {
            $this->setName($name);
        }
        if ($flags !== null) {
            $this->setFlags($flags);
        }
        if ($properties !== []) {
            $this->addProperties($properties);
        }
        if ($extends !== null) {
            $this->setExtendedClass($extends);
        }
        if (is_array($interfaces)) {
            $this->setImplementedInterfaces($interfaces);
        }
        if ($methods !== []) {
            $this->addMethods($methods);
        }
        if ($docBlock !== null) {
            $this->setDocBlock($docBlock);
        }
    }
    public function getAbbr() {
        $abbr = str_replace(['Gtk', 'G'], '', $this->name);
        return strtolower($abbr);
    }

    /**
     * @param  FileGenerator $fileGenerator
     * @return self
     */
    public function setContainingFileGenerator(FileGenerator $fileGenerator)
    {
        $this->containingFileGenerator = $fileGenerator;
        return $this;
    }

    /**
     * @return FileGenerator
     */
    public function getContainingFileGenerator()
    {
        return $this->containingFileGenerator;
    }

    /**
     * @param  DocBlockGenerator $docBlock
     * @return self
     */
    public function setDocBlock(AbstractDocBlock $docBlock)
    {
        $this->docBlock = $docBlock;
        return $this;
    }

    /**
     * @return DocBlockGenerator
     */
    public function getDocBlock()
    {
        return $this->docBlock;
    }

    /**
     * @param  array|string $flags
     * @return self
     */
    public function setFlags($flags)
    {
        if (is_array($flags)) {
            $flagsArray = $flags;
            $flags      = 0x00;
            foreach ($flagsArray as $flag) {
                $flags |= $flag;
            }
        }
        // check that visibility is one of three
        $this->flags = $flags;

        return $this;
    }

    /**
     * @param  string $flag
     * @return self
     */
    public function addFlag($flag)
    {
        $this->setFlags($this->flags | $flag);
        return $this;
    }

    /**
     * @param  string $flag
     * @return self
     */
    public function removeFlag($flag)
    {
        $this->setFlags($this->flags & ~$flag);
        return $this;
    }

    /**
     * @param  bool $isAbstract
     * @return self
     */
    public function setAbstract($isAbstract)
    {
        return $isAbstract ? $this->addFlag(self::FLAG_ABSTRACT) : $this->removeFlag(self::FLAG_ABSTRACT);
    }

    /**
     * @return bool
     */
    public function isAbstract()
    {
        return (bool) ($this->flags & self::FLAG_ABSTRACT);
    }

    /**
     * @param  bool $isFinal
     * @return self
     */
    public function setFinal($isFinal)
    {
        return $isFinal ? $this->addFlag(self::FLAG_FINAL) : $this->removeFlag(self::FLAG_FINAL);
    }

    /**
     * @return bool
     */
    public function isFinal()
    {
        return $this->flags & self::FLAG_FINAL;
    }

    /**
     * @param  string $extendedClass
     * @return self
     */
    public function setExtendedClass($extendedClass)
    {
        $this->extendedClass = $extendedClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtendedClass()
    {
        return $this->extendedClass;
    }

    /**
     * @return bool
     */
    public function hasExtentedClass()
    {
        return ! empty($this->extendedClass);
    }

    /**
     * @return self
     */
    public function removeExtentedClass()
    {
        $this->setExtendedClass(null);
        return $this;
    }

    /**
     * @param  array $implementedInterfaces
     * @return self
     */
    public function setImplementedInterfaces(array $implementedInterfaces)
    {
        array_map(function ($implementedInterface) {
            return (string) TypeGenerator::fromTypeString($implementedInterface);
        }, $implementedInterfaces);

        $this->implementedInterfaces = $implementedInterfaces;
        return $this;
    }

    /**
     * @return array
     */
    public function getImplementedInterfaces()
    {
        return $this->implementedInterfaces;
    }

    /**
     * @param string $implementedInterface
     * @return bool
     */
    public function hasImplementedInterface($implementedInterface)
    {
        $implementedInterface = (string) TypeGenerator::fromTypeString($implementedInterface);
        return in_array($implementedInterface, $this->implementedInterfaces);
    }

    /**
     * @param string $implementedInterface
     * @return self
     */
    public function removeImplementedInterface($implementedInterface)
    {
        $implementedInterface = (string) TypeGenerator::fromTypeString($implementedInterface);
        unset($this->implementedInterfaces[array_search($implementedInterface, $this->implementedInterfaces)]);
        return $this;
    }

    /**
     * @param  string $constantName
     * @return PropertyGenerator|false
     */
    public function getConstant($constantName)
    {
        if (isset($this->constants[$constantName])) {
            return $this->constants[$constantName];
        }

        return false;
    }

    /**
     * @return PropertyGenerator[] indexed by constant name
     */
    public function getConstants()
    {
        return $this->constants;
    }

    /**
     * @param  string $constantName
     * @return self
     */
    public function removeConstant($constantName)
    {
        unset($this->constants[$constantName]);

        return $this;
    }

    /**
     * @param  string $constantName
     * @return bool
     */
    public function hasConstant($constantName)
    {
        return isset($this->constants[$constantName]);
    }

    /**
     * Add constant from PropertyGenerator
     *
     * @param  PropertyGenerator           $constant
     * @throws InvalidArgumentException
     * @return self
     */
    public function addConstantFromGenerator(PropertyGenerator $constant)
    {
        $constantName = $constant->getName();

        if (isset($this->constants[$constantName])) {
            throw new InvalidArgumentException(sprintf(
                'A constant by name %s already exists in this class.',
                $constantName
            ));
        }

        if (! $constant->isConst()) {
            throw new InvalidArgumentException(sprintf(
                'The value %s is not defined as a constant.',
                $constantName
            ));
        }

        $this->constants[$constantName] = $constant;

        return $this;
    }

    /**
     * Add Constant
     *
     * @param  string                      $name Non-empty string
     * @param  string|int|null|float|array $value Scalar
     *
     * @throws Exception\InvalidArgumentException
     *
     * @return self
     */
    public function addConstant($name, $value)
    {
        if (empty($name) || ! is_string($name)) {
            throw new InvalidArgumentException(sprintf(
                '%s expects string for name',
                __METHOD__
            ));
        }

        $this->validateConstantValue($value);

        return $this->addConstantFromGenerator(
            new PropertyGenerator($name, new PropertyValueGenerator($value), PropertyGenerator::FLAG_CONSTANT)
        );
    }

    /**
     * @param  PropertyGenerator[]|array[] $constants
     *
     * @return self
     */
    public function addConstants(array $constants)
    {
        foreach ($constants as $constant) {
            if ($constant instanceof PropertyGenerator) {
                $this->addPropertyFromGenerator($constant);
            } else {
                if (is_array($constant)) {
                    call_user_func_array([$this, 'addConstant'], $constant);
                }
            }
        }

        return $this;
    }

    /**
     * @param  array $properties
     * @return self
     */
    public function addProperties(array $properties)
    {
        foreach ($properties as $property) {
            if ($property instanceof PropertyGenerator) {
                $this->addPropertyFromGenerator($property);
            } else {
                if (is_string($property)) {
                    $this->addProperty($property);
                } elseif (is_array($property)) {
                    call_user_func_array([$this, 'addProperty'], $property);
                }
            }
        }

        return $this;
    }

    /**
     * Add Property from scalars
     *
     * @param  string $name
     * @param  string|array $defaultValue
     * @param  int $flags
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function addProperty($name, $defaultValue = null, $flags = PropertyGenerator::FLAG_PUBLIC)
    {
        if (! is_string($name)) {
            throw new InvalidArgumentException(sprintf(
                '%s::%s expects string for name',
                get_class($this),
                __FUNCTION__
            ));
        }

        // backwards compatibility
        // @todo remove this on next major version
        if ($flags === PropertyGenerator::FLAG_CONSTANT) {
            return $this->addConstant($name, $defaultValue);
        }

        return $this->addPropertyFromGenerator(new PropertyGenerator($name, $defaultValue, $flags));
    }

    /**
     * Add property from PropertyGenerator
     *
     * @param  PropertyGenerator           $property
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function addPropertyFromGenerator(PropertyGenerator $property)
    {
        $propertyName = $property->getName();

        if (isset($this->properties[$propertyName])) {
            throw new InvalidArgumentException(sprintf(
                'A property by name %s already exists in this class.',
                $propertyName
            ));
        }

        // backwards compatibility
        // @todo remove this on next major version
        if ($property->isConst()) {
            return $this->addConstantFromGenerator($property);
        }

        $this->properties[$propertyName] = $property;
        $property->setParentGenerator($this);
        return $this;
    }

    /**
     * @return PropertyGenerator[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param  string $propertyName
     * @return PropertyGenerator|false
     */
    public function getProperty($propertyName)
    {
        foreach ($this->getProperties() as $property) {
            if ($property->getName() == $propertyName) {
                return $property;
            }
        }

        return false;
    }

    /**
     * Add a class to "use" classes
     *
     * @param  string $use
     * @param  string|null $useAlias
     * @return self
     */
    public function addUse($use, $useAlias = null)
    {
        //$this->traitUsageGenerator->addUse($use, $useAlias);
        return $this;
    }

    /**
     * @param string $use
     * @return self
     */
    public function hasUse($use)
    {
        return false;//$this->traitUsageGenerator->hasUse($use);
    }

    /**
     * @param  string $use
     * @return self
     */
    public function removeUse($use)
    {
        //$this->traitUsageGenerator->removeUse($use);
        return $this;
    }

    /**
     * @param string $use
     * @return bool
     */
    public function hasUseAlias($use)
    {
        return false;//$this->traitUsageGenerator->hasUseAlias($use);
    }

    /**
     * @param string $use
     * @return self
     */
    public function removeUseAlias($use)
    {
        //$this->traitUsageGenerator->removeUseAlias($use);
        return $this;
    }

    /**
     * Returns the "use" classes
     *
     * @return array
     */
    public function getUses()
    {
        return null;//$this->traitUsageGenerator->getUses();
    }

    /**
     * @param  string $propertyName
     * @return self
     */
    public function removeProperty($propertyName)
    {
        unset($this->properties[$propertyName]);

        return $this;
    }

    /**
     * @param  string $propertyName
     * @return bool
     */
    public function hasProperty($propertyName)
    {
        return isset($this->properties[$propertyName]);
    }

    /**
     * @param  array $methods
     * @return self
     */
    public function addMethods(array $methods)
    {
        foreach ($methods as $method) {
            if ($method instanceof MethodGenerator) {
                $this->addMethodFromGenerator($method);
            } else {
                if (is_string($method)) {
                    $this->addMethod($method);
                } elseif (is_array($method)) {
                    call_user_func_array([$this, 'addMethod'], $method);
                }
            }
        }

        return $this;
    }

    /**
     * Add Method from scalars
     *
     * @param  string $name
     * @param  array $parameters
     * @param  int $flags
     * @param  string $body
     * @param  string $docBlock
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function addMethod(
        $name,
        array $parameters = [],
        $flags = MethodGenerator::FLAG_PUBLIC,
        $body = null,
        $docBlock = null
    ) {
        if (! is_string($name)) {
            throw new InvalidArgumentException(sprintf(
                '%s::%s expects string for name',
                get_class($this),
                __FUNCTION__
            ));
        }

        return $this->addMethodFromGenerator(new MethodGenerator($name, $parameters, $flags, $body, $docBlock));
    }

    /**
     * Add Method from MethodGenerator
     *
     * @param  MethodGenerator                    $method
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function addMethodFromGenerator(MethodGenerator $method)
    {
        $methodName = $method->getName();

        if ($this->hasMethod($methodName)) {
            throw new InvalidArgumentException(sprintf(
                'A method by name %s already exists in this class.',
                $methodName
            ));
        }

        $method->setParentGenerator($this);
        $this->methods[strtolower($methodName)] = $method;
        return $this;
    }

    /**
     * @return MethodGenerator[]
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param  string $methodName
     * @return MethodGenerator|false
     */
    public function getMethod($methodName)
    {
        return $this->hasMethod($methodName) ? $this->methods[strtolower($methodName)] : false;
    }

    /**
     * @param  string $methodName
     * @return self
     */
    public function removeMethod($methodName)
    {
        unset($this->methods[strtolower($methodName)]);

        return $this;
    }

    /**
     * @param  string $methodName
     * @return bool
     */
    public function hasMethod($methodName)
    {
        return isset($this->methods[strtolower($methodName)]);
    }

    /**
     * @return ClassGenerator|null
     */
    public function getVTable()
    {
        return $this->virtual;
    }

    /**
     * @param ClassGenerator $vtable
     */
    public function setVTable($vtable)
    {
        $this->virtual = $vtable;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addTrait($trait)
    {
        //$this->traitUsageGenerator->addTrait($trait);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addTraits(array $traits)
    {
        //$this->traitUsageGenerator->addTraits($traits);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hasTrait($traitName)
    {
        return false;//$this->traitUsageGenerator->hasTrait($traitName);
    }

    /**
     * @inheritDoc
     */
    public function getTraits()
    {
        return null;//$this->traitUsageGenerator->getTraits();
    }

    /**
     * @inheritDoc
     */
    public function removeTrait($traitName)
    {
        return null;//$this->traitUsageGenerator->removeTrait($traitName);
    }

    /**
     * @inheritDoc
     */
    public function addTraitAlias($method, $alias, $visibility = null)
    {
        //$this->traitUsageGenerator->addTraitAlias($method, $alias, $visibility);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTraitAliases()
    {
        return nul;//$this->traitUsageGenerator->getTraitAliases();
    }

    /**
     * @inheritDoc
     */
    public function addTraitOverride($method, $traitsToReplace)
    {
        //$this->traitUsageGenerator->addTraitOverride($method, $traitsToReplace);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeTraitOverride($method, $overridesToRemove = null)
    {
        //$this->traitUsageGenerator->removeTraitOverride($method, $overridesToRemove);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTraitOverrides()
    {
        return null;//$this->traitUsageGenerator->getTraitOverrides();
    }


    /**
     * @return array
     */
    public function getRelatedObjects(): array
    {
        return empty($this->relatedObjects) ? array() : $this->relatedObjects;
    }

    /**
     * @param array $relatedObjects
     * @return ClassGenerator
     */
    public function setRelatedObjects(array $relatedObjects): ClassGenerator
    {
        $this->relatedObjects = $relatedObjects;
        return $this;
    }

    /**
     * @param string $name
     * @return ClassGenerator
     */
    /*public function createVTableClass(string $name): ClassGenerator {
        $class = $this->getOwnPackage()->createClass($name);
        $class->setParentGenerator($this);

        $this->objectClasses[$name] = $class;

        return $class;
    }*/
    

    /**
     * @param mixed $value
     *
     * @return void
     *
     * @throws Exception\InvalidArgumentException
     */
    private function validateConstantValue($value)
    {
        if (null === $value || is_scalar($value)) {
            return;
        }

        if (is_array($value)) {
            array_walk($value, [$this, 'validateConstantValue']);

            return;
        }

        throw new InvalidArgumentException(sprintf(
            'Expected value for constant, value must be a "scalar" or "null", "%s" found',
            gettype($value)
        ));
    }

}
