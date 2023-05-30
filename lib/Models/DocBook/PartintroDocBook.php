<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\ChapterDocBook;

class PartintroDocBook extends AbstractDocBook
{
    public $title;
    public $partInfo;

    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'partintro ('.$this->title.') {}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}