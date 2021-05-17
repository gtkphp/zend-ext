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
use Zend\Ext\Models\PackageGenerator;

class FileGenerator extends ObjectGenerator
{
    /**
     * @var string
     */
    public $filename;
    /**
     * @var string
     */
    public $path;

    /**
     * @var ObjectGenerator
     */
    public $master_object;
    
    /*public $functions;
    public $object;
    public $structs;
    public $enums;
    public $unions;*/

    public function setMasterObject(ObjectGenerator $object):FileGenerator {
        $this->master_object = $object;
        return $this;
    }
    public function getMatserObject() {
        return $this->master_object;
    }

    public function setPath(string $path):FileGenerator {
        $this->path = $path;
        return $this;
    }
    public function getPath():string {
        return $this->path;
    }

    public function getFilename():string {
        return $this->getName();
    }

    public function getPackage():PackageGenerator {
        $package = $this->getOwnPackage()->getPackage();
        return $package;
    }
    

}
