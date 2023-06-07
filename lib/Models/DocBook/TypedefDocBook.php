<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\TraitDescriptionDocBook;
use Zend\Ext\Models\DocBook\TraitAnnotationDocBook;


/**
 */
class TypedefDocBook extends AbstractDocBook
{
    /** @var string $name The public name of field */
    public $name;
    public function getName() {
        return $this->name;
    }

    use TraitDescriptionDocBook;
    use TraitAnnotationDocBook;

    /**
     * For compatibility raisons with StructDocBook
     * @return array
     */
    public function getFields(): array
    {
        return [];
    }

    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'typedef ('.$this->name.') {}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}