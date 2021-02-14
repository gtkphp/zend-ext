<?php

namespace Zend\Ext\Helpers\Php\Poo;

use Zend\View\Helper\AbstractHelper;


class CommentHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($comment)
    {
        //new \Send\Filter\StripTag()
        $len = strlen($comment);
        if ($len<75) {
            return ' * ' . $comment . PHP_EOL;
        }
        // get the first phrase
        $pos = strpos($comment, '.');
        if ($pos<72) {
            return ' * ' . substr($comment, 0, $pos+1) . PHP_EOL;
        }
        return ' * ' . substr($comment, 0, 69) . '...' . PHP_EOL;
    }
}
