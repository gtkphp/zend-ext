<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\TraitDescriptionDocBook;
use Zend\Ext\Models\DocBook\TraitAnnotationDocBook;


/**
 */
class ConstantDocBook extends AbstractDocBook
{
    /** @var string $name The public name of field */
    public $name;
    
    /** @var string $value The value of constant */
    public $value;

    /** @var string $value_type The type int|string of constant */
    public $value_type;

    /** @var string $expression The expresion used in source code */
    public $expression;
    
    use TraitDescriptionDocBook;
    use TraitAnnotationDocBook;

    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'enum ('.$this->name.') {}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}