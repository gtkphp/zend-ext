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

class VarGenerator extends ObjectGenerator
{
    /**
     * @var TypeGenerator
     */
    public $type;

    public function setType(TypeGenerator $type):VarGenerator {
        $this->type = $type;
        $this->type->setParentGenerator($this);
        return $this;
    }

    public function getType():TypeGenerator {
        return $this->type;
    }

    static public function Create($data):VarGenerator {
        $var = new VarGenerator($data['name']);
        switch ($data['type']) {
            //case 'function': it's not a C-key word
            //    break;
            case 'union':
                //TypeGenerator;
                break;
            case 'struct':
                //TypeGenerator;
                break;
        }
        print_r($data);
        return $var;
    }

}
