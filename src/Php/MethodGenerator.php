<?php
namespace Zend\Ext\Php;

use Zend\Ext\GeneratorInterface     as ExtGeneratorInterface;
use Zend\Ext\AbstractGenerator      as ExtAbstractGenerator;
use Zend\Ext\ClassGenerator         as ExtClassGenerator;
use Zend\Ext\MethodGenerator        as ExtMethodGenerator;
use Zend\Ext\ParameterGenerator     as ExtParameterGenerator;
use Zend\Ext\TypeGenerator          as ExtTypeGenerator;

use Zend\Ext\Php\TypeGenerator      as PhpTypeGenerator;

class MethodGenerator implements ExtGeneratorInterface {
    protected $source_dir;

    function __construct($source_dir){
        $this->source_dir = $source_dir;
    }

    /**
     * @param Zend\Ext\AbstractGenerator $generator
     */
    function generate($generator){
        $t = "\t";
        $output = '';
        if ('gtk_window_get_type'==$generator->getName()) {
            $output .= $t.'public function '."\e[1;31m".$generator->getName() . "\e[m".'() {}' . PHP_EOL;
        } else if('gtk_window_new'==$generator->getName()) {
            $output .= $t.'public function '."\e[1;34m".$generator->getName() . "\e[m".'() {}' . PHP_EOL;
        } else {
            $output .= $t.'public function '.$generator->getName() . '() {}' . PHP_EOL;
        }
        //$output .= $t.'{' . PHP_EOL;
        //$output .= $t.$t.'//...' . PHP_EOL;
        //$output .= $t.'/*{{{ Internal implementation }}}*/ }' . PHP_EOL;
        return $output;
    }

}