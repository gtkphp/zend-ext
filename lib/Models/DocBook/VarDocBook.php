<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\TypeDocBook;
use Zend\Ext\Models\DocBook\TraitDescriptionDocBook;
use Zend\Ext\Models\DocBook\TraitAnnotationDocBook;
use Zend\Ext\Models\DocBook\TraitDeclarationDocBook;


/**
 */
class VarDocBook extends AbstractDocBook
{
    /** @var string $name The public name of field */
    public $name;
    
    use TraitDescriptionDocBook;
    use TraitAnnotationDocBook;
    use TraitDeclarationDocBook;

    public function getName() {
        return $this->name;
    }

    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'var ('.$this->name.') {'.$this->type->__toString().'}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}