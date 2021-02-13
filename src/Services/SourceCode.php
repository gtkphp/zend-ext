<?php

namespace Zend\Ext\Services;

use DOMXPath;
use DOMDocument;
use DOMElement;
use DOMNodeList;

use Zend\C\Engine\Lexer;
use Zend\C\Engine\Context;
use Zend\C\Engine\PreProcessor;
use Zend\C\ExpressionParser;
use Zend\C\PhpPrinter;
use Zend\Ext\Exceptions\BadDeclarationException;
use Zend\Ext\Exceptions\LogicFileException;
use Zend\Ext\Exceptions\NoSuchFileException;
use Zend\Ext\Models\AbstractGenerator;
use Zend\Ext\Models\EnumGenerator;

class CDump {
    /**
     * @param string $c_enum_string
     * @return array array( 'name'=>'TheType', 'constants'=>array( 0=>'GTK_TYPE_A', 1=>'GTK_TYPE_B', ...))
     */
    function describeEnum(string $c_enum_string): array {
        $enum_data = array('name'=>NULL, 'constants'=>array());

        $c_enum_string = self::flushComment($c_enum_string);

        $start = strpos($c_enum_string, '{');
        $end = strrpos($c_enum_string, '}');
        $finish = strpos ( $c_enum_string, ';', $end+1);
        $name_decl = substr($c_enum_string, $end+1, $finish-$end-1);
        $constants_list = substr($c_enum_string, $start+1, $end-$start-1);

        $name_decl = trim($name_decl);
        $constants_array = explode (",", $constants_list);
        $constants_array = array_map('trim', $constants_array);


        $enum_data['name']=$name_decl;

        $count = 0;
        foreach($constants_array as $constant) {
            preg_match("/(\w+)\s*=?\s*/", $constant, $matches);
            if (isset($matches[1])) {
                $enum_data['constants'][$matches[1]]=$count;
                $count++;
            }
        }

        return $enum_data;
    }

    //private $_defined_list = array();
    //private $_remain_interpret = array();
    //private $_remain_preprocessor = array();
    private $_structs = array();
    private $_enums = array();
    private $_current_struct = array();
    private $_current_declaration = array(/*'name'=>'', 'type'=>'', 'comment'=>''*/);
    private $_current_type_specifier = array();
    private $_current_type_qualifier = array();
    private $_current_type_modifier = array();
    private $_current_identifier = array();
    private $_debug_indent = 0;

    private function trace($function) {
        echo str_pad(' ', $this->_debug_indent) . "=>".$function."()\n";
    }

    const NONE           = 0x00;
    const TYPE_VOID      = 0x01;
    const TYPE_CHAR      = 0x02;
    const TYPE_SHORT     = 0x03;
    const TYPE_INT       = 0x04;
    const TYPE_LONG      = 0x05;
    const TYPE_FLOAT     = 0x06;
    const TYPE_DOUBLE    = 0x07;
    const TYPE_SIGNED    = 0x08;
    const TYPE_UNSIGNED  = 0x09;
    const TYPE_NAME      = 0x10;
    const TYPE_STRUCT    = 0x11;
    const TYPE_UNION     = 0x12;
    const TYPE_CONST     = 0x13;
    const TYPE_VOLATILE  = 0x14;
    const TYPE_COMMENT   = 0x15;
    const TYPE_POINTER   = 0x16;
    const SUCCESS        = 0x100;

    /**
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanComment($str, $i, &$ptr):int
    {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while ($str{$i} == ' ' || $str{$i} == "\n" || $str{$i} == "\t") $i++;// skeep withespace

        if ('/'!=$str{$i}) {
            $this->_debug_indent--;
            return self::NONE;
        }
        $i++;
        if ('/'==$str{$i}) {
            $i++;
            while ($str{$i} != "\n") $i++;// or EOF
            $ptr = $i;
            $this->_debug_indent--;
            return self::TYPE_COMMENT;
        }
        if ('*'==$str{$i}) {
            $i++;
            while ($str{$i} != '*') $i++;
            $i++;
            if ($str{$i}=='/') {
                $i++;
                $ptr = $i;
                $this->_debug_indent--;
                return self::TYPE_COMMENT;
            }
        }

        $this->_debug_indent--;
        return self::NONE;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#type-specifier
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanTypeSpecifier($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        if (   $str{$i+0}=='v'
            && $str{$i+1}=='o'
            && $str{$i+2}=='i'
            && $str{$i+3}=='d'
            && ($str{$i+4}==' ' || $str{$i+4}=="\n" || $str{$i+4}=="\t")
        ) {
            $ptr = $i+4;
            $this->_current_type_specifier[] = 'void';
            $this->_debug_indent--;
            return self::TYPE_VOID;
        }
        if (   $str{$i+0}=='c'
            && $str{$i+1}=='h'
            && $str{$i+2}=='a'
            && $str{$i+3}=='r'
            && ($str{$i+4}==' ' || $str{$i+4}=="\n" || $str{$i+4}=="\t")
        ) {
            $ptr = $i+4;
            $this->_current_type_specifier[] = 'char';
            $this->_debug_indent--;
            return self::TYPE_CHAR;
        }
        if (   $str{$i+0}=='s'
            && $str{$i+1}=='h'
            && $str{$i+2}=='o'
            && $str{$i+3}=='r'
            && $str{$i+4}=='t'
            && ($str{$i+5}==' ' || $str{$i+5}=="\n" || $str{$i+5}=="\t")
        ) {
            $ptr = $i+5;
            $this->_current_type_specifier[] = 'short';
            $this->_debug_indent--;
            return self::TYPE_SHORT;
        }
        if (   $str{$i+0}=='i'
            && $str{$i+1}=='n'
            && $str{$i+2}=='t'
            && ($str{$i+3}==' ' || $str{$i+3}=="\n" || $str{$i+3}=="\t")
        ) {
            $ptr = $i+3;
            $this->_current_type_specifier[] = 'int';
            $this->_debug_indent--;
            return self::TYPE_INT;
        }
        if (   $str{$i+0}=='l'
            && $str{$i+1}=='o'
            && $str{$i+2}=='n'
            && $str{$i+3}=='g'
            && ($str{$i+4}==' ' || $str{$i+4}=="\n" || $str{$i+4}=="\t")
        ) {
            $ptr = $i+4;
            $this->_current_type_specifier[] = 'long';
            $this->_debug_indent--;
            return self::TYPE_LONG;
        }
        if (   $str{$i+0}=='f'
            && $str{$i+1}=='l'
            && $str{$i+2}=='o'
            && $str{$i+3}=='a'
            && $str{$i+4}=='t'
            && ($str{$i+5}==' ' || $str{$i+5}=="\n" || $str{$i+5}=="\t")
        ) {
            $ptr = $i+5;
            $this->_current_type_specifier[] = 'float';
            $this->_debug_indent--;
            return self::TYPE_FLOAT;
        }
        if (   $str{$i+0}=='d'
            && $str{$i+1}=='o'
            && $str{$i+2}=='u'
            && $str{$i+3}=='b'
            && $str{$i+4}=='l'
            && $str{$i+5}=='e'
            && ($str{$i+6}==' ' || $str{$i+6}=="\n" || $str{$i+6}=="\t")
        ) {
            $ptr = $i+6;
            $this->_current_type_specifier[] = 'double';
            $this->_debug_indent--;
            return self::TYPE_DOUBLE;
        }
        if (   $str{$i+0}=='s'
            && $str{$i+1}=='i'
            && $str{$i+2}=='g'
            && $str{$i+3}=='n'
            && $str{$i+4}=='e'
            && $str{$i+5}=='d'
            && ($str{$i+6}==' ' || $str{$i+6}=="\n" || $str{$i+6}=="\t")
        ) {
            $ptr = $i+6;
            $this->_current_type_specifier[] = 'signed';
            $this->_debug_indent--;
            return self::TYPE_SIGNED;
        }
        if (   $str{$i+0}=='u'
            && $str{$i+1}=='n'
            && $str{$i+2}=='s'
            && $str{$i+3}=='i'
            && $str{$i+4}=='g'
            && $str{$i+5}=='n'
            && $str{$i+6}=='e'
            && $str{$i+7}=='d'
            && ($str{$i+8}==' ' || $str{$i+8}=="\n" || $str{$i+8}=="\t")
        ) {
            $ptr = $i+8;
            $this->_current_type_specifier[] = 'unsigned';
            $this->_debug_indent--;
            return self::TYPE_UNSIGNED;
        }

        $ret = $this->scanStructOrUnionSpecifier($str, $i, $ptr);
        if (self::TYPE_STRUCT==$ret || self::TYPE_UNION==$ret) {
            echo "FIXME scanIdentifier est il fait dans scanStructOrUnionSpecifier ?\n";

            $this->_debug_indent--;
            return $ret;
        }

        //TODO: $ret = $this->enumSpecifier($str, $i, $ptr);

        $ret = $this->scanIdentifier($str, $i, $ptr);
        if (self::TYPE_NAME==$ret) {
            //$i=$ptr;
            $this->_current_type_specifier[] = array_pop($this->_current_identifier);

            $this->_debug_indent--;
            return self::TYPE_NAME;
        }

        $this->_debug_indent--;
        return self::NONE;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#type-qualifier
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanTypeQualifier($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while ($str{$i} == ' ' || $str{$i} == "\n" || $str{$i} == "\t") $i++;// skeep withespace
        //CONST | VOLATILE

        if (   $str{$i+0}=='c'
            && $str{$i+1}=='o'
            && $str{$i+2}=='n'
            && $str{$i+3}=='s'
            && $str{$i+4}=='t'
            && ($str{$i+5}==' ' || $str{$i+5}=="\n" || $str{$i+5}=="\t")
        ) {
            $ptr = $i+5;
            $this->_current_type_qualifier[] = 'const';
            $this->_debug_indent--;
            return self::TYPE_CONST;
        }
        if (   $str{$i+0}=='v'
            && $str{$i+1}=='o'
            && $str{$i+2}=='l'
            && $str{$i+3}=='a'
            && $str{$i+4}=='t'
            && $str{$i+5}=='i'
            && $str{$i+6}=='l'
            && $str{$i+7}=='e'
            && ($str{$i+8}==' ' || $str{$i+8}=="\n" || $str{$i+8}=="\t")
        ) {
            $ptr = $i+8;
            $this->_current_type_qualifier[] = 'volatile';
            $this->_debug_indent--;
            return self::TYPE_VOLATILE;
        }

        $this->_debug_indent--;
        return self::NONE;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#type-qualifier-list
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanTypeQualifierList($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while ($str{$i} == ' ' || $str{$i} == "\n" || $str{$i} == "\t") $i++;// skeep withespace

        $ret = $this->scanTypeQualifier($str, $i, $ptr);
        if (self::NONE!=$ret) {
            $this->_debug_indent--;
            return $ret;
        }

        $this->_debug_indent--;
        return self::NONE;
    }

    // TODO remove this
    function scanStructMembers($str) {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        $len = strlen($str);
        $ptr = 0;
        for($i=0; $i<$len; $i++) {
            while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t")$i++;// skeep withespace
            /*
            if (     $str{$i}=='u'
                && $str{$i+1}=='n'
                && $str{$i+2}=='i'
                && $str{$i+3}=='o'
                && $str{$i+4}=='n'
                && $str{$i+5}==' '
            ) {
                // $ptr = scanUnion($str, $i);
                if($ptr==0) {
                    // OK
                }// else pas ok
            } if ($str{$i}=='s') {

            }
            */
            $ret = $this->scanTypeSpecifier($str, $i, $ptr);
            if ($ret!=0) {
                $type_name = substr($str, $i, $ptr-$i);

            }
            break;

            echo '???'.$str{$i} . PHP_EOL;
        }
        $this->_debug_indent--;
        return self::NONE;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#specifier-qualifier-list
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanSpecifierQualifierList($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        $ret = $this->scanTypeSpecifier($str, $i, $ptr);
        if (self::NONE!=$ret) {
            $this->_debug_indent--;
            return $ret;
        }

        $ret = $this->scanTypeQualifier($str, $i, $ptr);
        if (self::NONE!=$ret) {
            $this->_debug_indent--;
            return $ret;
        }
        //$type_qualifier = '*';

        $this->_debug_indent--;
        return self::NONE;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#pointer
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanPointer($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        if('*'!=$str{$i}) {
            $this->_debug_indent--;
            return self::NONE;
        }
        $i++;
        $ptr=$i;
        $this->_current_type_modifier[]='*';

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        $ret = $this->scanTypeQualifierList($str, $i, $ptr);
        if (self::NONE!=$ret) {
            // const
            $this->_debug_indent--;
            return $ret;
        }

        $ret = $this->scanPointer($str, $i, $ptr);
        if (self::TYPE_POINTER==$ret) {
            $last = count($this->_current_type_modifier)-1;
            $this->_current_type_modifier[$last] .= '*';

            $this->_debug_indent--;
            return $ret;
        }

        $this->_debug_indent--;
        return self::TYPE_POINTER;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#direct-declarator
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanDirectDeclarator($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        $ret = $this->scanIdentifier($str, $i, $ptr);
        if (self::TYPE_NAME==$ret) {
            $this->_debug_indent--;
            return $ret;
        }
        var_dump($this->_current_identifier);

        /*
         * TODO: (void*) (*callback)(int arg)
        if (self::TYPE_NAME==$ret) {
            $i = $ptr;
            while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace
            if ('('==$str{$i}) {

            }
        }
        */

        $this->_debug_indent--;
        return self::NONE;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#declarator
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanDeclarator($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        $ret = $this->scanPointer($str, $i, $ptr);
        if ($ret==self::TYPE_POINTER) {
            $i = $ptr;
            // TODO
        }

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace
        $ret = $this->scanDirectDeclarator($str, $i, $ptr);
        if ($ret!=self::NONE) {
            $this->_debug_indent--;
            return $ret;
        }

        $this->_debug_indent--;
        return self::NONE;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#struct-declarator
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanStructDeclarator($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        $ret = $this->scanDeclarator($str, $i, $ptr);
        if (self::NONE!=$ret) {
            $this->_debug_indent--;
            return $ret;
        }

        $this->_debug_indent--;
        return self::NONE;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#struct-declarator-list
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanStructDeclaratorList($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        $ret = $this->scanStructDeclarator($str, $i, $ptr);
        echo "$ret(scanStructDeclarator)\n";
        if (self::NONE==$ret) {
            $this->_debug_indent--;
            return $ret;
        }

        print_r($this->_current_identifier);

        // check if $str{$i}==','


        $this->_debug_indent--;
        return self::SUCCESS;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#struct-declaration
     * struct_declaration : specifier_qualifier_list struct_declarator_list ';'
     *                      unsigned int
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanStructDeclaration($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace("\e[1;31m".__FUNCTION__."\e[0m");

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        $ret = $this->scanSpecifierQualifierList($str, $i, $ptr);
        if (self::NONE==$ret) {
            $this->_debug_indent--;
            return self::NONE;
        }
        $i=$ptr;
        //$type_name = array_pop($this->_current_identifier);
        $type_name = array_pop($this->_current_type_specifier);
        $type_qualifier = array_pop($this->_current_type_qualifier);

        // find variable_name
        echo "----------------------------------\n";
        if (self::NONE==$this->scanStructDeclaratorList($str, $i, $ptr)) {
            $this->_debug_indent--;
            return self::NONE;
        }
        echo "==================================\n";


        $i=$ptr;
        $var_name = array_pop($this->_current_identifier);
        $type_modifier = array_pop($this->_current_type_modifier);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace
        if (';'==$str{$i}) {
            $ptr = $i;
            $last = count($this->_current_declaration)-1;
            //$key = array_key_last($this->_current_declaration);
            $this->_current_declaration[$last]['members'][$var_name]=array(
                'name'=>$var_name,
                'type'=>$type_name,
                'qualifier'=>$type_qualifier,
                'modifier'=>$type_modifier,
            );

            $this->_debug_indent--;
            return self::SUCCESS;
        }

        $this->_debug_indent--;
        return self::NONE;
    }

    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#struct-declaration-list
     * @param $str
     * @param $i
     * @param $ptr
     * @return int
     */
    function scanStructDeclarationList($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace("\e[1;34m".__FUNCTION__."\e[0m");

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        $ret = $this->scanComment($str, $i, $ptr);
        if (self::TYPE_COMMENT==$ret) {
            echo "<".substr($str, $i, $ptr-$i).">\n";
            $i = $ptr;
            // TODO check if "/*< private >*/" then member private
        }

        //$this->_current_declaration = array('name'=>'', 'type'=>'', 'comment'=>'');
        $ret = $this->scanStructDeclaration($str, $i, $ptr);
        if (self::NONE==$ret) {
            $this->_debug_indent--;
            return self::NONE;
        }
        $i = $ptr;

        // TODO comment possible...
        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace
        if (';'==$str{$i}) {
            $i++;
            $ptr = $i;
        }
        // TODO comment possible...

        $ret = $this->scanStructDeclarationList($str, $i, $ptr);

        $this->_debug_indent--;
        return self::SUCCESS;
    }



    function scanIdentifier($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace
        $x = $i;
        while(  '_'==$str{$x}
            || ('a'<=$str{$x} && $str{$x}<='z')
            || ('A'<=$str{$x} && $str{$x}<='Z')
            || ('0'<=$str{$x} && $str{$x}<='9')
        ) {
            $x++;
        }
//echo substr($str, $i, 10)."????\n";
        if ($x>$i && ($str{$x}==';' || $str{$x}==' ' || $str{$x}=="\n" || $str{$x}=="\t") ) {
            $ptr = $x;
            $identifier = trim(substr($str, $i, $ptr-$i));
            $this->_current_identifier[] = $identifier;
            echo "<".$identifier.">\n";
            $this->_debug_indent--;
            return self::TYPE_NAME;
        }

        $this->_debug_indent--;
        return self::NONE;
    }
    function scanStructOrUnion($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        if (     $str{$i}=='s'
            && $str{$i+1}=='t'
            && $str{$i+2}=='r'
            && $str{$i+3}=='u'
            && $str{$i+4}=='c'
            && $str{$i+5}=='t'
            && ($str{$i+6}==' ' || $str{$i+6}=="\n" || $str{$i+6}=="\t")
        ) {
            $ptr = $i+6;
            $this->_debug_indent--;
            return self::TYPE_STRUCT;
        }
        if (     $str{$i}=='u'
            && $str{$i+1}=='n'
            && $str{$i+2}=='i'
            && $str{$i+3}=='o'
            && $str{$i+4}=='n'
            && ($str{$i+5}==' ' || $str{$i+5}=="\n" || $str{$i+5}=="\t")
        ) {
            $ptr = $i+5;
            $this->_debug_indent--;
            return self::TYPE_UNION;
        }
        $this->_debug_indent--;
        return self::NONE;
    }
    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#struct-or-union-specifier
     */
    function scanStructOrUnionSpecifier($str, $i, &$ptr):int {
        $this->_debug_indent++;
        $this->trace(__FUNCTION__);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t") $i++;// skeep withespace

        $ret = $this->scanStructOrUnion($str, $i, $ptr);
        if (self::TYPE_STRUCT != $ret && self::TYPE_UNION  != $ret) {
            $this->_debug_indent--;
            return self::NONE;
        }
        $struct_or_union = substr($str, $i, $ptr-$i);
        $i = $ptr;
        echo "<$struct_or_union>" . PHP_EOL;
        //$this->_current_type_specifier[] = array_pop($this->_current_type_declaration);

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t")$i++;// skeep withespace

        $identifier = NULL;
        $ret = $this->scanIdentifier($str, $i, $ptr);
        if (self::TYPE_NAME == $ret) {
            $i = $ptr;
            $identifier = array_pop($this->_current_identifier);
        } else if ($str{$i}!='{') {
            $this->_debug_indent--;
            return self::NONE;
        }

        echo "#$identifier" . PHP_EOL;

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t")$i++;// skeep withespace
        if ('{' != $str{$i}) {
            $this->_debug_indent--;
            return self::SUCCESS;
        }
        $i++;
        echo "<{>" . PHP_EOL;

        $this->_current_declaration[] = array(
            'type'=>$struct_or_union,
            'name'=>$identifier,
            'members'=>array(),// struct
            //'constants'=>array(),// enum
        );

        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t")$i++;// skeep withespace
        $ret = $this->scanStructDeclarationList($str, $i, $ptr);
        if (self::NONE == $ret) {
            $this->_debug_indent--;
            return self::NONE;
        }
        echo "i=$i vs ptr=$ptr\n";
        $i=$ptr;
        while($str{$i}==' ' || $str{$i}=="\n" || $str{$i}=="\t")$i++;// skeep withespace
        echo substr($str, $i, 20)."***\n";
        if ('}' != $str{$i}) {
            $this->_debug_indent--;
            return self::NONE;
        }
        $i++;
        $ptr = $i;
        echo "<}>" . PHP_EOL;

        // parse dummy, list_decl ;

        $this->_debug_indent--;
        return self::SUCCESS;
    }
    /**
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#declaration
     * @see https://www.lysator.liu.se/c/ANSI-C-grammar-y.html#struct-declaration
     * @param string $c_struct_string
     * @return array array( 'name'=>'TheType', 'constants'=>array( 0=>'GTK_TYPE_A', 1=>'GTK_TYPE_B', ...))
     */
    function describeStruct(string $c_struct_string): array {
        $struct_data = array('name'=>NULL, 'members'=>array());
        echo "\n".$c_struct_string . "\n";

        $ptr=NULL;
        if (self::NONE!=$this->scanStructDeclaration($c_struct_string, 0, $ptr)) {
        }
        print_r($this->_current_declaration);

        /*
        $c_struct_string = self::flushComment($c_struct_string);

        $start = strpos($c_struct_string, '{');
        $end = strrpos($c_struct_string, '}');
        //$finish = strpos ( $c_enum_string, ';', $end+1);
        //$name_decl = substr($c_enum_string, $end+1, $finish-$end-1);
        $members_list = substr($c_struct_string, $start+1, $end-$start-1);// 1348

        // type_specifier
        $this->scanStructMembers($members_list);
        */

        /*
        //$name_decl = trim($name_decl);
        $members_array = explode (";", $members_list);
        $members_array = array_map('trim', $members_array);


        //$struct_data['name']=$name_decl;

        foreach($members_array as $member) {
            //echo '>>'.$member . "\n";
            // TODO union, sub struct
            preg_match("/(\w+)\s*([*]*)\s*(\w+)/", $member, $matches);
            //print_r($matches);
            if (isset($matches[1]) && isset($matches[3])) {
                $struct_data['members'][$matches[3]]=array('type'=>'anonymous/dummy|primitive|object|string|...', 'name'=>$matches[1], 'modifier'=>$matches[2], 'qualifier'=>'');
            }
        }*/

        return $struct_data;
    }

    static function flushComment($c_str) {
        $end_reached = FALSE;
        do {
            $start = strpos($c_str, '/*');
            if ($start!==FALSE) {
                $end = strpos($c_str, '*/', $start);
                $c_str = substr_replace($c_str, '', $start, $end-$start+2);
            } else {
                $end_reached=TRUE;
            }
        } while($end_reached!=TRUE);

        $end_reached=FALSE;
        do {
            $start = strpos($c_str, "//");
            if ($start!==FALSE) {
                $end = strpos($c_str, "\n", $start);
                $c_str = substr_replace($c_str, '', $start, $end-$start);
            } else {
                $end_reached=TRUE;
            }
        } while($end_reached!=TRUE);

        return $c_str;
    }
}

class SourceCode {
    const GIT_COMMAND = 'git';

    /**
     * @var DOMXPath $xpath
     */
    protected $xpath = NULL;

    /**
     * @var DOMDocument $doc
     */
    protected $doc = NULL;

    /**
     * @var AbstractGenerator $currentGenerator
     */
    protected $currentGenerator = NULL;

    /**
     * @var ExpressionParser $parser
     */
    private $parser = NULL;
    /**
     * @var Context $context
     */
    private $context = NULL;
    /**
     * @var PreProcessor $preprocessor
     */
    private $preprocessor = NULL;
    /**
     * @var PhpPrinter $printer
     */
    private $printer = NULL;
    private $array = NULL;

    private $search = array();
    private $replace = array();


    public function parseStruct() {

    }
    function getDeclarations(string $filepath, array $search=array(), array $replace=array())
    {
        $filename = realpath($filepath);
        if (empty($filename)) {
            throw new NoSuchFileException("'$filepath' not found");
        }
        $str = file_get_contents($filename);
        $str_xml = "<root>$str</root>";
        $str_xml = str_replace($search, $replace, $str_xml);
        $this->search = $search;
        $this->replace = $replace;

        $this->printer = new PhpPrinter;
        $this->context = new Context;
        $lexer = new Lexer;
        $this->parser = new ExpressionParser($lexer);
        $this->preprocessor = new PreProcessor($this->context);
        $tokens = $this->preprocessor->process(__DIR__ . '/../../data/config-glib.h');
        $this->parser->parse($tokens, $this->context);

        $this->doc = new DOMDocument();
        $this->doc->loadXML($str_xml);

        $this->xpath = new DOMXPath($this->doc);

        if (True) {
            $expression = "/root/TYPEDEF";
            $nodes = $this->xpath->query($expression);
            echo "typedefs : ".count($nodes).PHP_EOL;
            $typedefs = $this->getTypedefs($nodes);
        }
        /*$types = $this->parser->getTypes();
        $keys = array_keys($types);
        print_r($keys);*/

        unset($this->array);

        if (True) {
            $expression = "/root/ENUM";
            $nodes = $this->xpath->query($expression);

            $enums = $this->getEnums($nodes);
            //TODO $this->getOwnPackage()->addEnums($enums);
            //print_r($enums);
            $this->printer->evaluate($this->array);
            //echo $this->printer->toString($this->array);
            //print_r($this->array);
        }

        unset($this->array);

        if (True) {
            $expression = "/root/STRUCT";
            $nodes = $this->xpath->query($expression);
            $structs = $this->getStructs($nodes);
            //TODO $this->getOwnPackage()->addStructs($structs);
            //print_r($structs);
        }

        //$enums = $this->getMacros($nodes);
        //$enums = $this->getFunctions($nodes);

        unset($this->parser);
        unset($this->xpath);
        unset($this->doc);

        // TODO parse the file and create FunctionGenerator
        // TODO parse the file and create StructGenerator
        // TODO parse the file and create EnumGenerator
    }

    /* ----------------------------------------------------------------
     * <TYPEDEF>
     * ---------------------------------------------------------------- */
    function getTypedefs(DOMNodeList  $list) {
        $typedefs = array();
        foreach($list as $node) {
            try {
                $typedefs[] = $this->getTypedef($node);
            } catch (BadDeclarationException $exc) {
                //TODO: push error reporting
                echo "TODO:".$exc->getMessage()."\n";
            }
        }
        return $typedefs;
    }

    function getTypedef(DOMElement  $enum) {
        $name = '';
        $c_str = '';
        foreach($enum->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
            } else {
                throw new BadDeclarationException("TYPEDEF '$name' : Unexpected xml structre.");
            }
        }
        // if $c_str is empty it is an anonymous typedef struct

        $c_str = str_replace($this->replace, $this->search, $c_str);
        $c_str = trim($c_str);
        if (empty($c_str)) {
            echo "Empty typedef for $name".PHP_EOL;
            return NULL;
        }/* else {
            echo PHP_EOL."Typedef for $name:".PHP_EOL;
            echo '<<<'.$c_str.'>>>'.PHP_EOL;
        }*/

        // TODO accepte string for $parser->parse()
        $data_filename = realpath(__DIR__.'/../../tmp/typedef.h');
        file_put_contents($data_filename, $c_str);
        $tokens = $this->preprocessor->process($data_filename);
        $this->parser->parse($tokens, $this->context);

        return Null;
    }

    /* ----------------------------------------------------------------
     * <STRUCT>
     * ---------------------------------------------------------------- */
    function getStructs(DOMNodeList  $list) {
        $structs = array();
        foreach($list as $node) {
            try {
                $structs[] = $this->getStruct($node);
            } catch (BadDeclarationException $exc) {
                //TODO: push error reporting
                echo "TODO:".$exc->getMessage()."\n";
            }
        }
        return $structs;
    }

    function getStruct(DOMElement  $enum) {
        $name = '';
        $c_str = '';
        foreach($enum->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
            } else {
                throw new BadDeclarationException("STRUC '$name' : Unexpected xml structre.");
            }
        }
        // if $c_str is empty it is an anonymous typedef struct

        $c_str = str_replace($this->replace, $this->search, $c_str);
        $c_str = trim($c_str);
        if (empty($c_str)) {
            echo "Empty structure for $name".PHP_EOL;
            return NULL;
        } else {
            echo PHP_EOL."Structure for $name:".PHP_EOL;
            echo '<<<'.$c_str.'>>>'.PHP_EOL;
        }

        // TODO accepte string for $parser->parse()
        $data_filename = realpath(__DIR__.'/../../tmp/struct.h');
        file_put_contents($data_filename, $c_str);
        $tokens = $this->preprocessor->process($data_filename);
        $ast = $this->parser->parse($tokens, $this->context);

        $this->printer->print($ast, $this->array);

        // consistency check, get typedef before
        //if ($name!=$data['name']) {
        //    throw new LogicFileException("STRUCT {$data['name']} missmatch, expected '$name'");
        //}

        //TODO: $model = $this->getPackage()->createStruct($name, $data);
        $model = NULL;//new StructGenerator($data);

        return $model;
    }

    /* ----------------------------------------------------------------
     * <ENUM>
     * ---------------------------------------------------------------- */
    function getEnums(DOMNodeList  $list) {
        $enums = array();
        foreach($list as $node) {
            try {
                $enums[] = $this->getEnum($node);
            } catch (BadDeclarationException $exc) {
                //TODO: push error reporting
                echo "TODO: \n";
            }
        }
        return $enums;
    }

    function getEnum(DOMElement  $enum) {
        $name = '';
        $c_str = '';
        foreach($enum->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
            } else {
                throw new BadDeclarationException("ENUM '$name' : Unexpected xml structre.");
            }
        }

        $c_str = str_replace($this->replace, $this->search, $c_str);

        // TODO accepte string for $parser->parse()
        $data_filename = realpath(__DIR__.'/../../tmp/enum.h');
        file_put_contents($data_filename, $c_str);
        $tokens = $this->preprocessor->process($data_filename);
        $ast = $this->parser->parse($tokens, $this->context);

        $this->printer->print($ast, $this->array);


        // consistency check
        if (False/*$name!=$data['name']*/) {
            throw new LogicFileException('ENUM name missmatch');
        }

        //TODO: $model = $this->getPackage()->createEnum($name, $data);
        //TODO: $model = $this->getModule()->createEnum($name, $data);
        $model = new EnumGenerator(/*$data*/);

        return $model;
    }

    function getCDump()  {
        return new CDump();
    }
}
