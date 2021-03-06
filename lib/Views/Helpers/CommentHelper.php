<?php

namespace Zend\Ext\Views\Helpers;

use Zend\Filter\FilterChain;
use Zend\Filter\StripTags;
use Zend\View\Helper\AbstractHelper;


class CommentHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($comment, $tab='')
    {
        if (empty(self::$filter)) {
            $filter = new FilterChain();
            $filter->attach(new StripTags());
            //       ->attach(new StripNewlines());
            self::$filter = $filter;
        }

        $comment = self::$filter->filter($comment);
        //$comment = str_replace(["\r\n", "\r", "\n"], ' ', $comment);
        $comment = preg_replace('/[\r\n ]+/i', ' ', $comment);

        $len = strlen($comment);
        if ($len<75) {
            return /*$tab.' * ' . */ $comment;
        }
        // get the first phrase
        $pos = strpos($comment, '.');
        if (False!=$pos && $pos<72) {
            return /*$tab.' * ' . */substr($comment, 0, $pos+1);
        }
        return /*$tab.' * ' . */substr($comment, 0, 69) . '...';
    }
}
