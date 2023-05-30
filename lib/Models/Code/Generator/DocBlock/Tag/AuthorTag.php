<?php

namespace Zend\Ext\Models\Code\Generator\DocBlock\Tag;

use Zend\Ext\Models\Code\Generator\AbstractGenerator;
use Zend\Ext\Models\Code\Generator\DocBlock\TagManager;
use Zend\Ext\Models\Code\Reflection\DocBlock\Tag\TagInterface as ReflectionTagInterface;

class AuthorTag extends AbstractGenerator implements TagInterface
{
    /** @var string|null */
    protected $authorName;

    /** @var string|null */
    protected $authorEmail;

    /**
     * @param string|null $authorName
     * @param string|null $authorEmail
     */
    public function __construct($authorName = null, $authorEmail = null)
    {
        if (! empty($authorName)) {
            $this->setAuthorName($authorName);
        }

        if (! empty($authorEmail)) {
            $this->setAuthorEmail($authorEmail);
        }
    }

    /**
     * @deprecated Deprecated in 2.3. Use TagManager::createTagFromReflection() instead
     *
     * @return AuthorTag
     * @param ReflectionTagInterface $reflectionTag
     */
    public static function fromReflection($reflectionTag)
    {
        $tagManager = new TagManager();
        $tagManager->initializeDefaultTags();
        return $tagManager->createTagFromReflection($reflectionTag);
    }

    /** @return 'author' */
    public function getName()
    {
        return 'author';
    }

    /**
     * @param string $authorEmail
     * @return AuthorTag
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;
        return $this;
    }

    /** @return string|null */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * @param string $authorName
     * @return AuthorTag
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
        return $this;
    }

    /** @return string|null */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /** @return non-empty-string */
    public function generate()
    {
        return '@author'
            . (! empty($this->authorName) ? ' ' . $this->authorName : '')
            . (! empty($this->authorEmail) ? ' <' . $this->authorEmail . '>' : '');
    }
}
