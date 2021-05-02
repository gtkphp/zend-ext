<?php
/**
 * Zend Extension (https://github.com/Glash-Gnome)
 *
 * @link      https://github.com/Glash-Gnome/zend-ext for the canonical source repository
 * @copyright Copyright (c) 2021-2021 Glash. <5312910@php.net>
 * @license   GPL 3.0
 */

namespace Zend\Ext\Models;

use Zend\Stdlib\Exception\InvalidArgumentException;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\GeneratorInterface;

/*
use Traversable;
use function get_class;
use function gettype;
use function is_array;
use function is_object;
use function method_exists;
use function sprintf;
*/

abstract class AbstractGenerator implements GeneratorInterface
{
    const VISIBILITY_PRIVATE = 0;
    const VISIBILITY_PROTECTED = 1;
    const VISIBILITY_PUBLIC = 2;

    protected $author = 'Glash';
    protected $email = '5312910@php.net';

    protected $description = '';
    protected $short_description = '';

    /**
     * The root of the generator, usually PackageGenerator
     * @var Zend\Ext\Models\PackageGenerator $ownPackage
     */
    protected $ownPackage = NULL;

    /**
     * @var Zend\Ext\Models\AbstractGenerator $parentGenerator
     */
    protected $parentGenerator = NULL;

    /**
     * @var int $visibility
     */
    protected $visibility=self::VISIBILITY_PUBLIC;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @param  string|array $options
     */
    public function __construct($options = NULL)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        } else if (is_string($options)) {
            $this->setName($options);
        } else {
            throw new InvalidArgumentException(sprintf(
                '%s expects a string or an array or Traversable object; received "%s"',
                __METHOD__,
                is_object($options) ? get_class($options) : gettype($options)
            ));
        }
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
     * @return AbstractGenerator
     */
    public function setName(string $name): AbstractGenerator
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param  AbstractGenerator $parentGenerator
     * @return AbstractGenerator
     */
    public function setParentGenerator($parentGenerator)
    {
        $this->parentGenerator = $parentGenerator;
        return $this;
    }

    /**
     * @return AbstractGenerator
     */
    public function getParentGenerator()
    {
        return $this->parentGenerator;
    }

    /**
     * @param  array|Traversable $options
     * @throws Exception\InvalidArgumentException
     * @return AbstractGenerator
     */
    public function setOptions($options)
    {
        if (! is_array($options) && ! $options instanceof Traversable) {
            throw new InvalidArgumentException(sprintf(
                '%s expects an array or Traversable object; received "%s"',
                __METHOD__,
                is_object($options) ? get_class($options) : gettype($options)
            ));
        }

        foreach ($options as $optionName => $optionValue) {
            $methodName = 'set' . $optionName;
            if (method_exists($this, $methodName)) {
                $this->{$methodName}($optionValue);
            }
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param int $visibility
     */
    public function setVisibility($visibility): void
    {
        $this->visibility = $visibility;
    }
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return AbstractGenerator
     */
    public function setDescription(string $description): AbstractGenerator
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->short_description;
    }

    /**
     * @param string $short_description
     * @return AbstractGenerator
     */
    public function setShortDescription(string $short_description): AbstractGenerator
    {
        $this->short_description = $short_description;
        return $this;
    }

    /**
     * @return Zend\Ext\Models\PackageGenerator
     */
    public function getOwnPackage():? PackageGenerator
    {
        if (isset($this->ownPackage)) {
            return $this->ownPackage;
        }
        if ($this instanceof PackageGenerator) {
            return $this;
        }
        $parent = $this->getParentGenerator();
        if ($parent) {
            $this->ownPackage = $parent->getOwnPackage();
        } else {
            throw new \Exception("Your Generator is not a part of a PackageGenerator");
        }
        return $this->ownPackage;
    }

    /**
     * @param Zend\Ext\Models\PackageGenerator $ownPackage
     * @return AbstractGenerator
     */
    public function setOwnPackage(PackageGenerator $ownPackage): AbstractGenerator
    {
        $this->ownPackage = $ownPackage;
        return $this;
    }
}
