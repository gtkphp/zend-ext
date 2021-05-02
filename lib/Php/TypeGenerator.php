<?php
namespace Zend\Ext\Php;

use Zend\Ext\GeneratorInterface     as ExtGeneratorInterface;
use Zend\Ext\AbstractGenerator      as ExtAbstractGenerator;
use Zend\Ext\ClassGenerator         as ExtClassGenerator;
use Zend\Ext\MethodGenerator        as ExtMethodGenerator;
use Zend\Ext\ParameterGenerator     as ExtParameterGenerator;
use Zend\Ext\TypeGenerator          as ExtTypeGenerator;

class TypeGenerator implements ExtGeneratorInterface {
    protected $source_dir;

    function __construct($source_dir){
        $this->source_dir = $source_dir;
    }

    /**
     * @param Zend\Ext\AbstractGenerator $generator
     */
    function generate($generator){

    }

}