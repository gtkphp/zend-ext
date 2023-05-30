<?php

namespace Zend\Ext\Models\DocBook;

use \DOMElement;
use Iterator;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\BookDocBook;

/**
 * @var string $title
 * @var SetInfoDocBook $info
 */
class SetDocBook extends AbstractDocBook {
    public $id;
    public $title;
    public $setinfo;

    protected $sets = [];
    protected $books = [];

    function addBook(BookDocBook $book):self { 
        $this->books[] = $book;
        return $this;
    }
    function books():array { 
        return $this->books;
    }

    function addSet(SetDocBook $set):self { 
        $this->sets[] = $set;
        return $this;
    }
    function sets():array { 
        return $this->sets;
    }

    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'set ('.$this->title.') {'.PHP_EOL;
        foreach($this->sets() as $set) {
            $output .= $set->__toString();
        }
        foreach($this->books() as $book) {
            $output .= $book->__toString();
        }
        $output .= $tab . '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}
