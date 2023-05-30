<?php

namespace Zend\Ext\Models\DocBook;

/**
 */
trait TraitDescriptionDocBook
{
    /**
     * @var string 
     */
    protected $description = null;

    public function setDescription($description) {
        $this->description = $description;
    }
    public function getDescription() {
        return $this->description;
    }
}

