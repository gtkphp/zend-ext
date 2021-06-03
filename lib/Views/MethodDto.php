<?php

namespace Zend\Ext\Views;

use Zend\Ext\Views\ObjectDto;

class MethodDto extends ObjectDto  {
    //public $name;
    //public $description;
    public $short_description;
    public $type;
    public $pad;
    public $parameters=[];

    public $since;

}
