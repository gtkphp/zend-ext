<?php

namespace Zend\Ext\Models\DocBook;

/**
 */
trait TraitVersionDocBook
{
    /**
     * @var string e.g. 1.0
     */
    protected $tag_since = null;

    public function setTagSince($since) {
        $this->tag_since = $since;
    }
    public function getTagSince() {
        return $this->tag_since;
    }
}
