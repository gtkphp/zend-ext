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

class ConstantGenerator extends ObjectGenerator
{
    /**
     * @var string|int
     */
    public $value;
    /**
     * @var array of AnnotationGenerator
     */
    protected $annotations = [];

    public function setValue($value):ConstantGenerator {
        $this->value = $value;
        return $this;
    }

    public function getValue() {
        return $this->value;
    }

    public function setAnnotations(array $annotations) {
        $this->annotations = $annotations;
        return $this;
    }

    public function getAnnotations():array {
        return $this->annotations;
    }
    
    public function getSince():string {
        foreach($this->annotations as $annotation) {
            if ($annotation->getType() == AnnotationGenerator::ANNOTATION_SINCE) {
                return $annotation->getParam();
            }
        }
        return '';
    }
    
}
