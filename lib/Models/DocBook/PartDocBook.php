<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\ChapterDocBook;

class PartDocBook extends AbstractDocBook
{
    public $title;
    public $partInfo;
    
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
    
    /**
     * @var ChapterDocBook[] $chapters
     */
    public $chapters=array();

    /**
     * @param ChapterDocBook $chapter
     */
    public function addChapter($chapter) {
        $this->chapters[] = $chapter;
        return $this;
    }
    /**
     * @return ChapterDocBook[]
     */
    public function chapters() {
        return $this->chapters;
    }
    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'part ('.$this->title.') {'.PHP_EOL;
        foreach($this->chapters() as $chapter) {
            $output .= $chapter->__toString();
        }
        $output .= $tab . '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}