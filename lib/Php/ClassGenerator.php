<?php
namespace Zend\Ext\Php;

use Zend\Ext\GeneratorInterface     as ExtGeneratorInterface;
use Zend\Ext\AbstractGenerator      as ExtAbstractGenerator;
use Zend\Ext\ClassGenerator         as ExtClassGenerator;
use Zend\Ext\MethodGenerator        as ExtMethodGenerator;
use Zend\Ext\ParameterGenerator     as ExtParameterGenerator;
use Zend\Ext\TypeGenerator          as ExtTypeGenerator;

use Zend\Ext\Php\MethodGenerator    as PhpMethodGenerator;
use Zend\Ext\Php\TypeGenerator      as PhpTypeGenerator;

class ClassGenerator implements ExtGeneratorInterface {
    protected $source_dir;

    function __construct($source_dir){
        $this->source_dir = $source_dir;
    }

    /**
     * @param Zend\Ext\AbstractGenerator $generator
     */
    function generate($generator){
        $methodAdapter = new PhpMethodGenerator(NULL);
        //$propertyAdapter = new PhpPropertyGenerator(NULL);
        $t = "\t";
        $output = '';
        $output .= '<?php' . PHP_EOL;
        $output .= 'namespace Gtk;' . PHP_EOL;
        $output .= 'class ' . $generator->getName() . PHP_EOL;
        $output .= '{' . PHP_EOL;
        $count=0;
        /*foreach($generator->getProperties() as $property) {
            $output .= $propertyAdapter->generate($property);
            if($count>10) break; else  $count++;
        }*/
        $output .= $t.'public function __construct()' . PHP_EOL;
        $output .= $t.'{' . PHP_EOL;
        $output .= $t.$t.'//...' . PHP_EOL;
        $output .= $t.'}' . PHP_EOL;
        $count=0;
        foreach($generator->getMethods() as $method) {
            $output .= $methodAdapter->generate($method);
            if($count>10) break; else  $count++;
        }
        $output .= '}' . PHP_EOL;
        $output .= PHP_EOL;
        return $output;
    }

}