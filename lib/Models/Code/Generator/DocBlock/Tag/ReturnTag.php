<?php

namespace Zend\Ext\Models\Code\Generator\DocBlock\Tag;

use Zend\Ext\Models\Code\Generator\DocBlock\TagManager;
use Zend\Ext\Models\Code\Reflection\DocBlock\Tag\TagInterface as ReflectionTagInterface;

class ReturnTag extends AbstractTypeableTag implements TagInterface
{
    /**
     * @deprecated Deprecated in 2.3. Use TagManager::createTagFromReflection() instead
     *
     * @return ReturnTag
     * @param ReflectionTagInterface $reflectionTag
     */
    public static function fromReflection($reflectionTag)
    {
        $tagManager = new TagManager();
        $tagManager->initializeDefaultTags();
        return $tagManager->createTagFromReflection($reflectionTag);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'return';
    }

    /**
     * @deprecated Deprecated in 2.3. Use setTypes() instead
     *
     * @param string $datatype
     * @return ReturnTag
     */
    public function setDatatype($datatype)
    {
        return $this->setTypes($datatype);
    }

    /**
     * @deprecated Deprecated in 2.3. Use getTypes() or getTypesAsString() instead
     *
     * @return string
     */
    public function getDatatype()
    {
        return $this->getTypesAsString();
    }

    /**
     * @return string
     */
    public function generate()
    {
        return '@return '
        . $this->getTypesAsString()
        . (! empty($this->description) ? ' ' . $this->description : '');
    }
}
