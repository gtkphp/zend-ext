<?php

namespace Zend\Ext\Services\SourceCode;

use Zend\Ext\Services\SourceCode;
use Exception;


class Glib extends SourceCode {

    function __construct($source_dir=NULL, $build_dir=NULL){
        $this->doc_dir = 'docs/reference/glib';
        $this->name = 'Glib';
        parent::__construct($source_dir, $build_dir);
    }

    // Load the file Enum, Object, Boxed, Interface, Data structure( HashTable, GList,...)
    // 1) make reference for it and other ...
    // 2) make ZendCode
    // 3) make documentation
    function loadTypes() {
        // whitelist / blacklist
        // Order deni all, Allow item1 item 2 ...
        //$enums = $this->getEnums();
        //$list_enums = array_keys($enums);
        //print_r($list_enums);

        // glib-decl-list.txt
        // GList, GValue, g_print(), ..., GEqualFunc, GApplication, gmodule, gmessages, gmain,
        // <SECTION>
        //<FILE>glist</FILE>
        //$this->getDeclarationsList($this->build_dir.'/glib-decl-list.txt');
        $search = array('&(v)', ' << ', '/*< ', ' >*/', '&&', '&', '->', ' < ', ' > ', '_-|> <.', '<foo bar="baz">', '</foo>');
        $replace = array('V_REF_PASS', 'SHIFT_LEFT', '/* ', ' */', 'DOUBLE_PASS_REF', 'PASS_REF', 'SPECIAL_ARROW', ' GREATER ', ' LESSER ', 'EXCEPTIONEL', 'OPEN_TAG_FOO', 'CLOSE_TAG_FOO');
        $this->getDeclarations($this->build_dir.'/glib-decl.txt', $search, $replace);

        //$constants = $this->getConstants();

    }
}
