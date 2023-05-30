<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\RefEntryDocBook;

/**
 * Parents: book
 * Childrens: 
 * 
 */
class ChapterDocBook extends AbstractDocBook
{
    public $title;
    protected $refentries=array();

    /**
     * @param RefEntryDocBook
     */
    public function addRefEntry($refentry) {
        $this->refentries[] = $refentry;
        return $this;
    }
    /**
     * @return RefEntryDocBook[]
     */
    public function refentries() {
        return $this->refentries;
    }
    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'chapter ('.$this->title.') {'.PHP_EOL;
        foreach($this->refentries() as $refentry) {
            $output .= $refentry->__toString();
        }
        $output .= $tab . '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}
