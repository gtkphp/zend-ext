<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\BookInfoDocBook;
use Zend\Ext\Models\DocBook\ChapterDocBook;
use Zend\Ext\Models\DocBook\ReferenceDocBook;
use Zend\Ext\Models\DocBook\ReleaseInfo;
use Zend\Ext\Models\DocBook\Indexterm;

/**
 * Parents: set.
 * Childrens: article, bookinfo, chapter, part, preface, ...
 * 
 */
class BookDocBook extends AbstractDocBook
{
    public $id;
    public $title;
    public $bookInfo;
    public $preface;
    //public $indexterm;// of Indexterm
    
    protected $parts=array();
    protected $chapters=array();
    protected $articles=array();
    protected $references=array();
    
    /**
     * @param ReferenceDocBook $part
     */
    public function addReference($part) {
        $this->references[] = $part;
        return $this;
    }
    /**
     * @return ReferenceDocBook[]
     */
    public function references() {
        return $this->references;
    }

    /**
     * @param PartDocBook $part
     */
    public function addPart($part) {
        $this->parts[] = $part;
        return $this;
    }
    /**
     * @return PartDocBook[]
     */
    public function parts() {
        return $this->parts;
    }

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

    public function getTitle() {
        if (isset($this->title)) {
            return $this->title;
        }
        if (isset($this->bookInfo)) {
            return $this->bookInfo->title;
        }
        return '';
    }

    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'book ('.$this->getTitle().') {'.PHP_EOL;
        foreach($this->parts() as $part) {
            $output .= $part->__toString();
        }
        foreach($this->chapters() as $chapter) {
            $output .= $chapter->__toString();
        }
        foreach($this->references() as $reference) {
            $output .= $reference->__toString();
        }
        $output .= $tab . '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}