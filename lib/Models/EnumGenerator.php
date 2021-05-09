<?php
/**
 * Zend Extension (https://github.com/Glash-Gnome)
 *
 * @link      https://github.com/Glash-Gnome/zend-ext for the canonical source repository
 * @copyright Copyright (c) 2021-2021 Glash. <5312910@php.net>
 * @license   GPL 3.0
 */

namespace Zend\Ext\Models;

use Zend\Ext\Models\ObjectGenerator;

class EnumGenerator extends ObjectGenerator
{

    /**
     * @var array $constants array('CONST_A'=>0x00, 'CONST_B'=>0x03, ...)
     */
    protected $constants=[];

    /**
     * @var MethodGenerator[] Array of methods
     */
    public $methods = [];

    /**
     * @var array Objects related to this object
     */
    protected $relatedObjects;

    /**
     * @return array
     */
    public function getConstants(): array
    {
        return $this->constants;
    }

    /**
     * @param array $constants
     * @return EnumGenerator
     */
    public function setConstants(array $constants): EnumGenerator
    {
        $this->constants = $constants;
        return $this;
    }


    /**
     * @return array
     */
    public function getRelatedObjects(): array
    {
        return empty($this->relatedObjects) ? array() : $this->relatedObjects;
    }

    /**
     * @param array $relatedObjects
     * @return EnumGenerator
     */
    public function setRelatedObjects(array $relatedObjects): EnumGenerator
    {
        $this->relatedObjects = $relatedObjects;
        return $this;
    }


}