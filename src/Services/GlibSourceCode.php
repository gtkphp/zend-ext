<?php

namespace Zend\Ext\Services;

use Zend\Ext\Services\SourceCode;
use Exception;


class GlibSourceCode extends SourceCode {

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
        $search = array('&(v)', ' << ', '/*< ', ' >*/', '&&', '&', '->', ' < ', ' > ', '_-|> <.');
        $replace = array('V_REF_PASS', 'SHIFT_LEFT', '/* ', ' */', 'DOUBLE_PASS_REF', 'PASS_REF', 'SPECIAL_ARROW', ' GREATER ', ' LESSER ', 'EXCEPTIONEL');
        $this->getDeclarations($this->build_dir.'/glib-decl.txt', $search, $replace);

        //$constants = $this->getConstants();

    }

    function getDeclarationsList(string $filename, array $search=array(), array $replace=array())
    {
        return parent::getDeclarationsList($filename, $search, $replace);

        $filename = realpath($filename);
        $xml = file_get_contents($filename);
        $str_xml = "<root>$xml</root>";

        //$search = array('/* <private> */', '/* <public> */', '/*< ', ' >*/', '/* < ', ' > */', '<<', '&&', '<Space>', '<Return>', '&(v)', '& ', ' < ', ' > ', '_-|> <.', '&G_LOCK_NAME', '(val) &', "!$&'()*+,;=");
        //$replace = array('/* private */', '/* public */', '/* ', ' */', '/* ', ' */', 'SHIFT_LEFT', 'AND', '{Space}', '{Return}', 'V_REF_PASS', 'REF_PASS', ' GREATER ', ' LESSER ', 'EXCEPTIONEL', 'REF_G_LOCK_NAME', 'VAL_REF_PASS', 'EXCEPTIONEL2');
        $search = array('<SUBSECTION Standard>');
        $replace = array('<SUBSECTION Standard="True"></SUBSECTION>');
        $str_xml = str_replace($search, $replace, $str_xml);

        $doc = new \DOMDocument();
        $doc->loadXML($str_xml);


    }

    /**
     * @return array Array('MyEnum'=>array('CONST_A', 'CONST_A'))
     */
    function getEnumsXXX(DOMNodeList  $list)
    {
        return parent::getEnums($list);

        //$this->trace(__FUNCTION__);
        $enums_data = array();


        $filename = realpath($this->build_dir.'/glib-decl.txt');
        $xml = file_get_contents($filename);

        // si on veux retrouver les valeur des enumeration il faudra faire attention au &
        $xml = str_replace(array('/* <private> */', '/* <public> */', '/*< ', ' >*/', '/* < ', ' > */', '<<', '&&', '<Space>', '<Return>', '&(v)', '& ', ' < ', ' > ', '_-|> <.', '&G_LOCK_NAME', '(val) &', "!$&'()*+,;="),
            array('/* private */', '/* public */', '/* ', ' */', '/* ', ' */', 'SHIFT_LEFT', 'AND', '{Space}', '{Return}', 'V_REF_PASS', 'REF_PASS', ' GREATER ', ' LESSER ', 'EXCEPTIONEL', 'REF_G_LOCK_NAME', 'VAL_REF_PASS', 'EXCEPTIONEL2')
            , $xml);
        $str_xml = "<root>$xml</root>";
        //file_put_contents("/home/dev/Projects/php-ubuntu-doc-dependency/zend-ext/data/types.xml", $str_xml);

        $doc = new \DOMDocument();
        $doc->loadXML($str_xml);



        $xpath = new \DOMXPath($doc);
        $expression = "/root/ENUM";
        $enums = $xpath->query($expression);
        //echo count($enums)." type of enum found".PHP_EOL;
        $enum_name = NULL;
        foreach($enums as $enum) {
            $describe = $this->getEnum($enum);
            $enums_data[$describe['name']]=$describe['constants'];
        }

        return $enums_data;
    }


    /*
    function getEnum($enum_node)
    {
        //$this->trace(__FUNCTION__);
        $describe = NULL;
        foreach($enum_node->childNodes as $node) {
            if ($node->nodeName == 'NAME') {
                $enum_name = trim($node->nodeValue);
            } else if ($node->nodeType == XML_TEXT_NODE) {
                $c_enum_string = trim($node->nodeValue);
                if (!empty($c_enum_string)) {
                    //echo "<<$c_enum_string>>" . PHP_EOL;
                    $describe = $this->getCDump()->describeEnum($c_enum_string);
                    //$enum_name == $data['name'] else Error in docBook
                }
            }
        }
        return $describe;
    }
    */

}
