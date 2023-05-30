<?php

namespace Zend\Ext\Models\Code\Generator\DocBlock;

use Zend\Ext\Models\Code\Generator\DocBlock\Tag\GenericTag;
use Zend\Ext\Models\Code\Reflection\DocBlock\Tag\TagInterface as ReflectionTagInterface;

/**
 * @deprecated Deprecated in 2.3. Use GenericTag instead
 */
class Tag extends GenericTag
{
    /**
     * @deprecated Deprecated in 2.3. Use TagManager::createTagFromReflection() instead
     *
     * @return Tag
     * @param ReflectionTagInterface $reflectionTag
     */
    public static function fromReflection($reflectionTag)
    {
        $tagManager = new TagManager();
        $tagManager->initializeDefaultTags();
        return $tagManager->createTagFromReflection($reflectionTag);
    }

    /**
     * @deprecated Deprecated in 2.3. Use GenericTag::setContent() instead
     *
     * @param  string $description
     * @return Tag
     */
    public function setDescription($description)
    {
        return $this->setContent($description);
    }

    /**
     * @deprecated Deprecated in 2.3. Use GenericTag::getContent() instead
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->getContent();
    }
}
