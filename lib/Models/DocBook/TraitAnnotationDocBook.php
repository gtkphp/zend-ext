<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AnnotationDocBook;

trait TraitAnnotationDocBook
{
    protected $annotations = [];

    /**
     * @param AnnotationDocBook $annotation
     */
    public function addAnnotation(AnnotationDocBook $annotation)
    {
        $this->annotations[] = $annotation;
        return $this;
    }

    /**
     * @param AnnotationDocBook[] $annotations
     */
    public function setAnnotations(array $annotations)
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

    public function getAnnotation(int $type):? AnnotationDocBook
    {
        foreach($this->annotations as $annotation) {
            if ($annotation->getType()==$type) {
                return $annotation;
            }
        }
        return null;
    }
}


