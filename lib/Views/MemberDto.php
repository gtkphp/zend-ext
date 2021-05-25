<?php

namespace Zend\Ext\Views;

use Zend\Ext\Views\ObjectDto;

class MemberDto extends ObjectDto {
    public $type='';
    public $is_prototype=false;// is a function pointer ?
    /**
     * @var array(
     *   'name'=> string,
     *   'type'=>string('function')
     *   'signature'=>array()
     * )
     */
    public $prototype = null;
    //public $pass='';
    //public $modifier='';
    //public $qualifier='';
}
