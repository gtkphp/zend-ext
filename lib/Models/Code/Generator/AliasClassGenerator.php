<?php

namespace Zend\Ext\Models\Code\Generator;

use Zend\Ext\Models\Code\Generator\AbstractGenerator;
use Zend\Ext\Models\Code\Reflection\ClassReflection;

class AliasClassGenerator extends AbstractGenerator
{
    /** @var FileGenerator|null */
    protected $containingFileGenerator = null;

    /** @var string|null */
    protected $namespaceName = null;

    /** @var DocBlockGenerator|null */
    protected $docBlock = null;

    /** @var string */
    protected $name = '';

    /** @var string */
    protected $class_name = '';
    

    /**
     * Build a Code Generation Php Object from a Class Reflection
     *
     * @return static
     */
    public static function fromReflection(ClassReflection $classReflection)
    {
        $cg = null;
        return $cg;
    }

    /**
     * Generate from array
     *
     * @deprecated this API is deprecated, and will be removed in the next major release. Please
     *             use the other constructors of this class instead.
     *
     * @configkey name           string        [required] Class Name
     * @configkey filegenerator  FileGenerator File generator that holds this class
     * @configkey namespacename  string        The namespace for this class
     * @configkey docblock       string        The docblock information
     * @throws Exception\InvalidArgumentException
     * @param  array $array
     * @return static
     */
    public static function fromArray(array $array)
    {
        if (! isset($array['name'])) {
            throw new Exception\InvalidArgumentException(
                'Class generator requires that a name is provided for this object'
            );
        }

        $cg = new static($array['name']);
        foreach ($array as $name => $value) {
            // normalize key
            switch (strtolower(str_replace(['.', '-', '_'], '', $name))) {
                case 'containingfile':
                    $cg->setContainingFileGenerator($value);
                    break;
                case 'namespacename':
                    $cg->setNamespaceName($value);
                    break;
                case 'docblock':
                    $docBlock = $value instanceof DocBlockGenerator ? $value : DocBlockGenerator::fromArray($value);
                    $cg->setDocBlock($docBlock);
                    break;
            }
        }

        return $cg;
    }

    /**
     * @param string                               $name
     * @param string                               $namespaceName
     * @param DocBlockGenerator                    $docBlock
     */
    public function __construct(
        $name = null,
        $namespaceName = null,
        $docBlock = null
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        if ($namespaceName !== null) {
            $this->setNamespaceName($namespaceName);
        }
        if ($docBlock !== null) {
            $this->setDocBlock($docBlock);
        }
    }

    /**
     * @param  string $name
     * @return static
     */
    public function setName($name)
    {
        if (false!==strstr($name, '\\')) {
            $namespace = substr($name, 0, strrpos($name, '\\'));
            $name      = substr($name, strrpos($name, '\\') + 1);
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
     * @param  string $name
     * @return static
     */
    public function setClassName($name)
    {
        if (false!==strstr($name, '\\')) {
            $namespace = substr($name, 0, strrpos($name, '\\'));
            $name      = substr($name, strrpos($name, '\\') + 1);
            $this->setNamespaceName($namespace);
        }

        $this->class_name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->class_name;
    }
    
    /**
     * @param  ?string $namespaceName
     * @return static
     */
    public function setNamespaceName($namespaceName)
    {
        $this->namespaceName = $namespaceName;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getNamespaceName()
    {
        return $this->namespaceName;
    }

    /**
     * @return static
     */
    public function setContainingFileGenerator(FileGenerator $fileGenerator)
    {
        $this->containingFileGenerator = $fileGenerator;
        return $this;
    }

    /**
     * @return ?FileGenerator
     */
    public function getContainingFileGenerator()
    {
        return $this->containingFileGenerator;
    }

    /**
     * @return static
     */
    public function setDocBlock(DocBlockGenerator $docBlock)
    {
        $this->docBlock = $docBlock;
        return $this;
    }

    /**
     * @return ?DocBlockGenerator
     */
    public function getDocBlock()
    {
        return $this->docBlock;
    }

    /**
     * @inheritDoc
     */
    public function generate()
    {
        return '';
    }

}
