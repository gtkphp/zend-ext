<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\TraitVersionDocBook;
use Zend\Ext\Models\DocBook\TraitDescriptionDocBook;
use Zend\Ext\Models\DocBook\ConstantDocBook;

/**
 */
class MacroDocBook extends AbstractDocBook
{
    /** @var string $name The public name of struct */
    public $name;
    
    use TraitDescriptionDocBook;


    
    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'macro ('.$this->name.') {';
        /*
        $output .= PHP_EOL;
        foreach($this->constants as $constant) {
            //$output .= $tab . '    "'.$constant->getDescription().'"'.PHP_EOL;
            $output .= $constant->__toString();
        }
        $output .= $tab;
        */
        $output .= '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}