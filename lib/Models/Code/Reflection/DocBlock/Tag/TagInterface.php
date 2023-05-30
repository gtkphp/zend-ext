<?php

namespace Zend\Ext\Models\Code\Reflection\DocBlock\Tag;

use Zend\Ext\Models\Code\Generic\Prototype\PrototypeInterface;

interface TagInterface extends PrototypeInterface
{
    /**
     * @param  string $content
     * @return void
     */
    public function initialize($content);
}
