<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\BookDocBook;

use \DOMElement;
use Iterator;

class AbstractDocBook {
    static public $tab = '    ';
    static public $indent = 0;

    /** @var AbstractDocBook $parent */
    public $parent;

    function __construct(AbstractDocBook $parent=null) {
        $this->parent = $parent;
    }

    /**@return SetDocBook|BookDocBook|PartDocBook */
    function getRoot():AbstractDocBook {
        $parent = $this;
        while ($parent->parent) {
            $parent = $parent->parent;
        }
        return $parent;
    }
    /** @return BookDocBook */
    function getBook():BookDocBook {
        $parent = $this;
        while ($parent && ! $parent instanceof BookDocBook) {
            $parent = $parent->parent;
        }
        return $parent;
    }

    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
        
        $output = $tab . get_class($this) .' {}'.PHP_EOL;
            
        AbstractDocBook::$indent--;
        return $output;
    }

}
