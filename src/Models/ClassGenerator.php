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
     * @var string
     */
    protected $namespaceName;

    /**
     * @var DocBlockGenerator
     */
    protected $docBlock;

    /**
     * @var string
     */
    protected $name;

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
     * @var TraitUsageGenerator Object to encapsulate trait usage logic
     */
    protected $traitUsageGenerator;

    /**
     * @param  string $name
     * @param  string $namespaceName
     * @param  array|string $flags
     * @param  string $extends
     * @param  array $interfaces
     * @param  array $properties
     * @param  array $methods
     * @param  DocBlockGenerator $docBlock
     */
    public function __construct(
        $name = null,
        $namespaceName = null,
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
        if ($namespaceName !== null) {
            $this->setNamespaceName($namespaceName);
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

    /**
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        if (strstr($name, '\\')) {
            $pos = strrpos($name, '\\');
            $namespace = substr($name, 0, $pos);
            $name      = substr($name, $pos + 1);
            $this->setNamespaceName($namespace);
        }

        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string $namespaceName
     * @return self
     */
    public function setNamespaceName($namespaceName)
    {
        $this->namespaceName = str_replace('\\', '_', $namespaceName);
        return $this;
    }

    /**
     * @return string
     */
    public function getNamespaceName()
    {
        return $this->namespaceName;
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
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function addConstantFromGenerator(PropertyGenerator $constant)
    {
        $constantName = $constant->getName();

        if (isset($this->constants[$constantName])) {
            throw new Exception\InvalidArgumentException(sprintf(
                'A constant by name %s already exists in this class.',
                $constantName
            ));
        }

        if (! $constant->isConst()) {
            throw new Exception\InvalidArgumentException(sprintf(
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
            throw new Exception\InvalidArgumentException(sprintf(
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
            throw new Exception\InvalidArgumentException(sprintf(
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
            throw new Exception\InvalidArgumentException(sprintf(
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
            throw new Exception\InvalidArgumentException(sprintf(
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
            throw new Exception\InvalidArgumentException(sprintf(
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


    public function generate_me()
    {
        $output = '';
        $methods = $this->getMethods();

        foreach ($methods as $method) {
            $output .= $method->generate_PHP_METHOD() . self::LINE_FEED;
        }

        return $output;
    }
    public function generateSource()
    {
        // generate docBlockLicence
        $naming = new Naming\GnomeStrategy();

        $output = '';
        $tab = str_repeat($this->getIndentation(), 1);

        $function_name = $naming->generateFunctionName($this);
        $type_name = $naming->generateTypeName($this);
        $type_macro = $naming->generateMacroType($this);

        // add member struct

        $output .= 'G_DEFINE_TYPE ('.$type_name.', '.$function_name.', /G_TYPE_OBJECT/);'.PHP_EOL;
        $output .= PHP_EOL;

        $output .= 'static void' . PHP_EOL;
        $output .= $function_name.'_init ('.$type_name.' *object)' . PHP_EOL;
        $output .= '{' . PHP_EOL;
        $output .= '}' . PHP_EOL;
        $output .= PHP_EOL;

        $output .= 'static void' . PHP_EOL;
        $output .= $function_name.'_class_init ('.$type_name.'Class *klass)' . PHP_EOL;
        $output .= '{' . PHP_EOL;
        $output .= '}' . PHP_EOL;
        $output .= PHP_EOL;

        $output .= $type_name.'*' . PHP_EOL;
        $output .= $function_name.'_new ()' . PHP_EOL;
        $output .= '{' . PHP_EOL;
        $output .= $tab . $type_name . ' *object = g_object_new('.$type_macro.', NULL);' . PHP_EOL;
        $output .= $tab . 'return object;' . PHP_EOL;
        $output .= '}' . PHP_EOL;
        $output .= PHP_EOL;

        // add virtual methods
        // add override methods
        // add methods
        $methods = $this->getMethods();

        foreach ($methods as $method) {
            $output .= $method->generate('source') . self::LINE_FEED;
        }



        return $output;
    }

    public function generateHeader()
    {
        $output  = '';

        $camelCaseToUnderscore = new \Zend\Filter\Word\CamelCaseToUnderscore();
        $camelCaseToDash = new \Zend\Filter\Word\CamelCaseToDash();
        $stringToLower = new \Zend\Filter\StringToLower();
        $stringToUpper = new \Zend\Filter\StringToUpper();


        $OBJECT_NS = $stringToUpper->filter($camelCaseToUnderscore->filter($this->getNamespaceName()));
        $OBJECT_NAME = $stringToUpper->filter($camelCaseToUnderscore->filter($this->getName()));

        $object_ns = $stringToLower->filter($camelCaseToUnderscore->filter($this->getNamespaceName()));
        $object_name = $stringToLower->filter($camelCaseToUnderscore->filter($this->getName()));

        $objectNs = $this->getNamespaceName();
        $objectName = $this->getName();

        $NS_OBJECT_TYPE = '';
        if ( !empty($OBJECT_NS) ) {
            $NS_OBJECT_TYPE = $OBJECT_NS . '_';
        }
        $NS_OBJECT_TYPE .= 'TYPE_' . $OBJECT_NAME;
        // $naming->generateMacroType($this);
        // $naming->generate($this, 'MacroType');
        // $this->naming('MacroType');

        $ns_object = '';
        if ( !empty($object_ns) ) {
            $ns_object = $object_ns . '_';
        }
        $ns_object .= $object_name;
        //$ns_object = $this->namingClassType();

        $nsObject = '';
        if ( !empty($objectNs) ) {
            $nsObject = $objectNs . '_';
        }
        $nsObject .= $objectName;

        // Naming(GnomeStrategy())->macroName();
        // Naming(GnomeStrategy())->className();
        // Naming(GnomeStrategy())->callName();
        // Naming(GnomeStrategy())->propertyName();
        $output .= '#define ' . $NS_OBJECT_TYPE . ' ' . $ns_object . '_get_type ()' . self::LINE_FEED;
        $output .= 'G_DECLARE_FINAL_TYPE (' . $objectNs.$objectName . ', ' . $ns_object . ', ' . $OBJECT_NS . ', ' . $OBJECT_NAME . ', ' . 'GObject' . ')' . self::LINE_FEED;

        return $output;
    }


    /**
     * @inheritDoc
     */
    public function generate_arginfo()
    {
        $camelCaseToUnderscore = new \Zend\Filter\Word\CamelCaseToUnderscore();
        $stringToLower = new \Zend\Filter\StringToLower();

        $tab = $this->getIndentation();
        $output = '';

        $object_ns = $stringToLower->filter($camelCaseToUnderscore->filter($this->getNamespaceName()));
        $object_name = $stringToLower->filter($camelCaseToUnderscore->filter($this->getName()));
        $name = $object_name;
        if (!empty($object_ns)) {
            $name = $object_ns.'_'.$object_name;
        }

        foreach ($this->getMethods() as $method) {
            $output .= $method->generate_arginfo() . self::LINE_FEED;
        }


        $output .= 'static const zend_function_entry '.$name.'_functions[] = {' . self::LINE_FEED;
        foreach ($this->getMethods() as $method) {
            $output .= $tab . $method->generate_me() . self::LINE_FEED;
        }
        $output .= $tab . 'PHP_FE_END' . self::LINE_FEED;
        $output .= '};' . self::LINE_FEED;

        return $output;
    }

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

        throw new Exception\InvalidArgumentException(sprintf(
            'Expected value for constant, value must be a "scalar" or "null", "%s" found',
            gettype($value)
        ));
    }

    /**
     * @param string $fqnClassName
     *
     * @return string
     */
    private function generateShortOrCompleteClassname($fqnClassName)
    {
        $fqnClassName = ltrim($fqnClassName, '\\');
        $parts = explode('\\', $fqnClassName);
        $className = array_pop($parts);
        $classNamespace = implode('\\', $parts);
        $currentNamespace = (string) $this->getNamespaceName();

        if ($classNamespace === $currentNamespace || in_array($fqnClassName, $this->getUses())) {
            return $className;
        }

        return '\\' . $fqnClassName;
    }
}
