<?php

namespace Zend\Ext\Views\DocBook\Helpers;

use DOMDocument;
use DOMXPath;
use Zend\Filter\FilterChain;
use Zend\Filter\StripTags;
use Zend\View\Helper\AbstractHelper;


class CommentHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($comment, $tab='')
    {
        $comment = str_replace(array('<emphasis>', '</emphasis>'), array('', ''), $comment);

        $doc = new DOMDocument();
        $doc->loadXML('<root>'.$comment.'</root>');
        $xpath = new DOMXPath($doc);

        // <link linkend="cairo-image-surface-create">
        $linkends = array();
        $links = $xpath->query('//link');
        foreach ($links as $link) {
            $linkend = $link->getAttribute('linkend');
            $linkends['<link linkend="'.$linkend.'">'] = '<link linkend="function.'.str_replace('-', '_', $linkend).'">';
        }
        $functions = array();
        $funcs = $xpath->query('//function');
        foreach ($funcs as $func) {
            $value = $func->nodeValue;
            $tmp = str_replace(array('(', ')', '<!--', '-->'), '', $value);

            $functions['<function>'.$value.'</function>'] = '<function>'.$tmp.'</function>';
        }

        $search = array_keys($functions);
        $replace = array_values($functions);
        $comment = str_replace($search, $replace, $comment);

        if (true) {
            // strategy 1 : remove links
            foreach ($linkends as $linkend=>$unused) {
                $comment = str_replace($linkend, '', $comment);
            }
            $comment = str_replace('</link>', '', $comment);
        } else {
            // strategy 2 : remap links
            foreach ($linkends as $linkend=>$unused) {
                $comment = str_replace($linkend, $unused, $comment);
            }

        }

        $output = $comment;

        return $output;
    }
}
