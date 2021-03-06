<?php
/**
 * Zend Extension (https://github.com/Glash-Gnome)
 *
 * @link      https://github.com/Glash-Gnome/zend-ext for the canonical source repository
 * @copyright Copyright (c) 2021-2021 Glash. <5312910@php.net>
 * @license   GPL 3.0
 */

namespace Zend\Ext\Models;

use Zend\Ext\Models\AbstractGenerator;

class ObjectGenerator extends AbstractGenerator
{
    public $isClassified = FALSE;// is put in related ?

    public $children=[];
    public $relateds=[];
    public $dependencies=[];

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
