<?php
namespace Zend\Ext\Php;

use Zend\Ext\GeneratorInterface;
use Zend\Ext\AbstractGenerator;
use Zend\Ext\ClassGenerator;
use Zend\Ext\MethodGenerator;
use Zend\Ext\ParameterGenerator;
use Zend\Ext\TypeGenerator;

use Zend\Ext\Php\ClassGenerator     as PhpClassGenerator;
use Zend\Ext\Php\MethodGenerator    as PhpMethodGenerator;
use Zend\Ext\Php\ParameterGenerator as PhpParameterGenerator;
use Zend\Ext\Php\TypeGenerator      as PhpTypeGenerator;

class Adapter implements GeneratorInterface {
    protected $source_dir;

    function __construct($source_dir){
        $this->source_dir = $source_dir;
    }

    /**
     * @param Zend\Ext\AbstractGenerator $generator
     */
    function generate($generator){
        $output = '';
        if($generator instanceof ClassGenerator) {
            //$adapter = new PhpClassGenerator();
        } else if($generator instanceof MethodGenerator) {

        } else if($generator instanceof ParameterGenerator) {

        } else if($generator instanceof TypeGenerator) {

        } else {
            echo "Unknown ". get_class ($generator) ." as Generator".PHP_EOL;
        }
        return $output;
    }

}