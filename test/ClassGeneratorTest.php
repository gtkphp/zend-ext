<?php

namespace ZendTest\Ext;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\Error\Error;

use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;// rename by GlibParser

use Zend\C\Engine\Lexer;
use Zend\C\Engine\Context;
use Zend\C\Engine\PreProcessor;
use Zend\C\ExpressionParser;
use Zend\C\PhpPrinter;

/**
 * @var \DOMDocument $doc
 * 
 * @var PhpPrinter $printer
 * @var Context $context
 * @var ExpressionParser $parser
 * @var PreProcessor $preprocessor
 */
class ClassGeneratorTest extends TestCase
{
    public $collection = array();
    public $exposed = array();

    /*<protected >*/
    public $search = array('&(v)', '<<', '/*<', '/* <', ' >*/', '&&', '&', ' <= ', '->', ' < ', ' > ', '_-|> <.', '<foo bar="baz">', '</foo>', '<Space> does', '<Return> does', '> */', '(1L<<0)', '(1L<<1)', '/*<private>*/');
    public $replace = array('V_REF_PASS', 'SHIFT_LEFT', '/*_', '/* _', ' _*/', 'DOUBLE_PASS_REF', 'PASS_REF', 'GREATER_OR_EQUAL', 'SPECIAL_ARROW', ' GREATER ', ' LESSER ', 'EXCEPTIONEL', 'OPEN_TAG_FOO', 'CLOSE_TAG_FOO', '_SPACE_DOES', '_RETURN_DOES', '_ */', '_JOKE_1', '_JOKE_2', '/*_private_*/');
    public $tmp_dir = '/home/dev/Projects/gtkphp/generated/zend-ext/tmp';
    public $fp;
    public $fp2;

    public $doc;

    public $printer;
    public $context;
    public $parser;
    public $preprocessor;

    public function __construct()
    {
        $this->printer = new PhpPrinter;
        $this->context = new Context;
        $lexer = new Lexer;
        $this->parser = new ExpressionParser($lexer);
        $this->preprocessor = new PreProcessor($this->context);

        parent::__construct();
    }

    function taskResume($xpath, &$collections) {
        $tags = array();
        $kinds = array('STRUCT', 'ENUM', 'UNION');
        $this->exposed = array();

        $nodes = $xpath->query('/root/*');
        foreach($nodes as $child) {
            if (isset($tags[$child->nodeName])) {
                $tags[$child->nodeName] += 1;
            } else {
                $tags[$child->nodeName] = 1;
            }

            //-----------------------
            if (!isset($collections[$child->nodeName])) {
                $collections[$child->nodeName] = array();
            }

            $n = $xpath->query('NAME', $child);
            $name = $n[0]->nodeValue;
            if (isset($collections[$child->nodeName][$name])) {
                $collections[$child->nodeName][$name] += 1;
            } else {
                $collections[$child->nodeName][$name] = 1;
            }
            //-----------------------

            if (in_array($child->nodeName, $kinds)) {
                $c_str = '';
                $name = '';
    
                foreach($child->childNodes as $node) {
                    if ($node->nodeType==XML_TEXT_NODE) {
                        $c_str .= trim($node->nodeValue);
                    } else if ($node->nodeName=='NAME') {
                        $name = trim($node->nodeValue);
                    } else if ($node->nodeName=='DEPRECATED') {
                        $deprecated = true;
                    } else {
                        echo "'$name' : Unexpected xml structre.\n";
                    }
                }
                if (!empty($c_str)) {
                    $this->exposed[$name] = 1;
                }
            }

        }
        return $tags;
    }

    function doublonResume($collections) {
        $doublon = array('MACRO'=>[], 'ENUM'=>[], 'UNION'=>[], 'STRUCT'=>[], 'TYPEDEF'=>[], 'FUNCTION'=>[], 'USER_FUNCTION'=>[], 'VARIABLE'=>[]);
        foreach($collections as $kind=>$collection) {
            foreach($collection as $name=>$item) {
                if ($item>1) {
                    $doublon[$kind][$name] = $item;
                }
            }
        }
        foreach($doublon as $key=>$array) {
            if (empty($array)) {
                unset($doublon[$key]);
            }
        }

        return $doublon;
    }

    function opaqueStruct($xpath) {
        $opaque = array();
        $exposed = array();
        $kinds = array('STRUCT', 'ENUM', 'UNION');

        $nodes = $xpath->query('/root/*');
        foreach($nodes as $node) {

            if (!in_array($node->nodeName, $kinds)) {
                continue;
            }


            $c_str = '';
            $name = '';

            foreach($node->childNodes as $child) {
                if ($child->nodeType==XML_TEXT_NODE) {
                    $c_str .= trim($child->nodeValue);
                } else if ($child->nodeName=='NAME') {
                    $name = trim($child->nodeValue);
                } else if ($child->nodeName=='DEPRECATED') {
                    $deprecated = true;
                } else {
                    echo "'$name' : Unexpected xml structre.\n";
                }
            }
            if (empty($c_str)) {
                $opaque[$name] = 0;
            } else {
                $exposed[$name] = 1;
            }

        }

        $this->exposed = $exposed;
        return array('opaque'=>$opaque, 'exposed'=>$exposed);
    }

    public function testResume() {
        $filename = '/home/dev/Projects/glib-build-doc/docs/reference/glib/glib-decl.txt';
        $filename = '/home/dev/Projects/glib-build-doc/docs/reference/gobject/gobject-decl.txt';
        $str = file_get_contents($filename);
        $str = str_replace('struct utimbuf when just', 'struct utimbuf when just*/', $str);
        $str = str_replace($this->search, $this->replace, $str);
        $str_xml = "<root>$str</root>";

        $this->doc = new \DOMDocument();
        $this->doc->loadXML($str_xml);
        
        $xpath = new \DOMXPath($this->doc);
        
        $opaques = $this->opaqueStruct($xpath);
        print_r($opaques);
        $opaques = array_intersect_key($opaques['opaque'], $opaques['exposed']);
        print_r($opaques);

        $kinds = $this->taskResume($xpath, $this->collection);
        foreach ($kinds as $kind=>$v) {
            //$nodes = $xpath->query('/root/'.$kind);
            //echo "$kind = " . $nodes->length . "\n";
            echo "$kind = " . count($this->collection[$kind]) . "\n";
        }
        //print_r($this->collection['STRUCT']);
        //echo count($this->collection['STRUCT']), PHP_EOL;
        print_r($this->doublonResume($this->collection));
        //print_r($this->collection['STRUCT']);
        

        $this->assertTrue(true);
    }

    public function testSource() {
        $array = [];
        try {
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/glib-2.56.4.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $this->printer->print($ast, $array);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/gobject-2.56.4.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $this->printer->print($ast, $array);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/gio-2.56.4.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $this->printer->print($ast, $array);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/cairo-1.15.10.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $this->printer->print($ast, $array);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/pango-1.40.14.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $this->printer->print($ast, $array);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/gdk_pixbuf-2.36.11.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $this->printer->print($ast, $array);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/gdk-3.22.30.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $this->printer->print($ast, $array);
        } catch (\Exception $error) {
            throw new \Zend\C\Engine\Error($error->getMessage());
        }

        print_r($array['typedefs']['GDBusMessage']);
        print_r(array_keys($array['structs']['__GDBusMessage']));
        /*
        print_r($array['typedefs']['GdkAtom']);
        print_r(array_keys($array['structs']['_GdkAtom']));
        */

        /*

        print_r(array_keys($array['enums']));
        print_r(array_keys($array['typedefs']));
        */

        $this->assertTrue(true);
    }
    public function testDecl() {
        /*
        $filename = '/home/dev/Projects/glib-build-doc/docs/reference/glib/glib-decl.txt';
        $filename = '/home/dev/Projects/glib-build-doc/docs/reference/gobject/gobject-decl.txt';
        $filename = '/home/dev/Projects/glib-build-doc/docs/reference/gio/gio-decl.txt';
        */
        $filename = '/home/dev/Projects/cairo/doc/public/cairo-decl.txt';
        /*
        $filename = '/home/dev/Projects/pango-build-doc/docs/pango-decl.txt';
        $filename = '/home/dev/Projects/gdk-pixbuf-build-doc/docs/reference/gdk-pixbuf/gdk-pixbuf-decl.txt';
        $filename = '/home/dev/Projects/gtk-build-doc/docs/reference/gdk/gdk3-decl.txt';
        $filename = '/home/dev/Projects/atk-build-doc/docs/atk-decl.txt';
        $filename = '/home/dev/Projects/gtk-build-doc/docs/reference/gtk/gtk3-decl.txt';
        */

        
        $str = file_get_contents($filename);
        $str = str_replace('struct utimbuf when just', 'struct utimbuf when just*/', $str);
        $str = str_replace($this->search, $this->replace, $str);
        $str_xml = "<root>$str</root>";

        $this->doc = new \DOMDocument();
        $this->doc->loadXML($str_xml);
        $xpath = new \DOMXPath($this->doc);
        
        $kinds = $this->taskResume($xpath, $this->collection);
        /*
        print_r($kinds);
        print_r($this->collection);
        $doublons = $this->doublonResume($this->collection);
        print_r($doublons);
        */

        $this->purgeDeclaration();
        foreach ($kinds as $kind=>$v) {
            $this->parseDoc($kind);
        }
        $this->mergeDeclaration();

        $this->assertTrue(true);
    }
    public function testInc() {
        if(True) {
            /*
            */
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/glib-2.56.4.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/gobject-2.56.4.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/gio-2.56.4.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/cairo-1.15.10.h');
            $ast = $this->parser->parse($tokens, $this->context);
            /*
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/pango-1.40.14.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/gdk_pixbuf-2.36.11.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/gdk-3.22.30.h');
            $ast = $this->parser->parse($tokens, $this->context);
            $tokens = $this->preprocessor->process($this->tmp_dir.'/../data/gnome-3.28.2/atk-2.28.1.h');
            $ast = $this->parser->parse($tokens, $this->context);
            */
        }

        try {
            $tokens = $this->preprocessor->process($this->tmp_dir.'/declaration.h');
        } catch (\Exception $error) {
            throw new \Zend\C\Engine\Error($error->getMessage());
        }
        $ast = $this->parser->parse($tokens, $this->context);
        $this->printer->print($ast, $array);
        
        $this->assertTrue(true);
    }

    function purgeDeclaration() {
        file_put_contents($this->tmp_dir.'/declaration.h', "");

        $kinds = array('MACRO', 'ENUM', 'UNION', 'STRUCT', 'TYPEDEF', 'FUNCTION', 'USER_FUNCTION', 'VARIABLE');
        foreach($kinds as $kind) {
            $n = strtolower($kind);
            $declaration = $this->tmp_dir.'/declaration-'.$n.'.h';
            $declaration_typedef = $this->tmp_dir.'/declaration-'.$n.'-typedef.h';
            file_put_contents($declaration, "");
            file_put_contents($declaration_typedef, "");
        }
    }
    function mergeDeclaration() {
        $decl = $this->tmp_dir.'/declaration.h';
        file_put_contents($decl, file_get_contents($this->tmp_dir.'/declaration-macro.h'), FILE_APPEND | LOCK_EX);
        file_put_contents($decl, file_get_contents($this->tmp_dir.'/declaration-typedef.h'), FILE_APPEND | LOCK_EX);

        $kinds = array('ENUM', 'UNION', 'STRUCT', 'FUNCTION', 'USER_FUNCTION', 'VARIABLE');
        foreach($kinds as $kind) {
            $n = strtolower($kind);
            //$declaration = $this->tmp_dir . 'declaration-'.$n.'.h';
            $declaration_typedef = $this->tmp_dir.'/declaration-'.$n.'-typedef.h';

            //file_put_contents($decl, file_get_contents($declaration), FILE_APPEND | LOCK_EX);
            file_put_contents($decl, file_get_contents($declaration_typedef), FILE_APPEND | LOCK_EX);
        }
        foreach($kinds as $kind) {
            $n = strtolower($kind);
            $declaration = $this->tmp_dir.'/declaration-'.$n.'.h';
            //$declaration_typedef = $this->tmp_dir . 'declaration-'.$n.'-typedef.h';

            file_put_contents($decl, file_get_contents($declaration), FILE_APPEND | LOCK_EX);
            //file_put_contents($decl, file_get_contents($declaration_typedef), FILE_APPEND | LOCK_EX);
        }
    }




    function parseDoc($name) {
        $xpath = new \DOMXPath($this->doc);
        $nodes = $xpath->query('/root/'.$name);
        $n = strtolower($name);
        
        
        if (!method_exists($this, 'parse'.$name)) {
            echo "\n".'parse'.$name . '() not implemented' . PHP_EOL;
            return;
        }
        
        $declaration = $this->tmp_dir.'/declaration-'.$n.'.h';
        $declaration_typedef = $this->tmp_dir.'/declaration-'.$n.'-typedef.h';

        if (!$this->fp = fopen($declaration, 'w')) {
            echo "Cannot open file ($declaration)";
            exit;
        }
        if (!$this->fp2 = fopen($declaration_typedef, 'w')) {
            echo "Cannot open file ($declaration_typedef)";
            exit;
        }

        for($i=$nodes->length; $i>0; $i--) {
            $child = $nodes[$i-1];
            $this->{'parse'.$name}($child);
        }
        fclose($this->fp);
        fclose($this->fp2);
    }

    function parseTYPEDEF($node) {
        $xpath = new \DOMXPath($this->doc);
        $n = $xpath->query('NAME', $node);
        $c_str = '';
        $name = "???";
        $deprecated = false;

        foreach($node->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
            } else if ($child->nodeName=='DEPRECATED') {
                $deprecated = true;
            } else {
                echo "'$name' : Unexpected xml structre.\n";
            }
        }
        $c_str = str_replace($this->replace, $this->search, $c_str);

        $c_str = trim($c_str).PHP_EOL;
        
        if (fwrite($this->fp, $c_str) === FALSE) {
            echo "Cannot write to file (declaration-typedef.h)";
            exit;
        }


    }

    function parseSTRUCT($node) {
        $xpath = new \DOMXPath($this->doc);
        $c_str = '';
        $deprecated = false;
        $name = "???";

        foreach($node->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
            } else if ($child->nodeName=='DEPRECATED') {
                $deprecated = true;
            } else {
                echo "'$name' : Unexpected xml structre.\n";
            }
        }

        $c_str = str_replace($this->replace, $this->search, $c_str);

        $c_str = trim($c_str);
        if (0===strpos($c_str, 'typedef')) {
        } else {
            if (empty($c_str)) {
                if (isset($this->exposed[$name])) {
                    return;
                }
                $struct_name = '__'.$name;
            } else {
                
                $begin = strpos($c_str, 'struct');
                $end = strpos($c_str, '{');
                    if (false===$end) {
                        $end = strpos($c_str, ';');
                    }
                $struct_name = substr($c_str, $begin+6, $end-$begin-6);
                $struct_name = trim($struct_name);
            }

            $c_str_def = 'typedef struct '.$struct_name.' '.$name.';'.PHP_EOL;
            if (fwrite($this->fp2, $c_str_def) === FALSE) {
                echo "Cannot write to file (declaration-struct-typedef.h)";
                exit;
            }
        }

        $c_str = $c_str.PHP_EOL;

        if (fwrite($this->fp, $c_str) === FALSE) {
            echo "Cannot write to file (declaration-struct.h)";
            exit;
        }

    }

    function parseMACRO($node) {
        $xpath = new \DOMXPath($this->doc);
        $c_str = '';
        $deprecated = false;
        $name = "???";

        foreach($node->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
            } else if ($child->nodeName=='DEPRECATED') {
                $deprecated = true;
            } else {
                echo "'$name' : Unexpected xml structre.\n";
            }
        }

        $c_str = str_replace($this->replace, $this->search, $c_str);

        $c_str = trim($c_str).PHP_EOL;
        //echo $c_str;
        if (fwrite($this->fp, $c_str) === FALSE) {
            echo "Cannot write to file (declaration-macro.h)";
            exit;
        }

    }


    function parseENUM($node) {
        $xpath = new \DOMXPath($this->doc);
        $c_str = '';
        $deprecated = false;
        $name = "???";

        foreach($node->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
            } else if ($child->nodeName=='DEPRECATED') {
                $deprecated = true;
            } else {
                echo "'$name' : Unexpected xml structre.\n";
            }
        }

        $c_str = str_replace($this->replace, $this->search, $c_str);

        $c_str = trim($c_str);
        if (0===strpos($c_str, 'typedef')) {

        } else {
            if (empty($c_str)) {
                if (isset($this->exposed[$name])) {
                    return;
                }
                $enum_name = '__'.$name;
            } else {
                
                $begin = strpos($c_str, 'enum');
                $end = strpos($c_str, '{');
                    if (false===$end) {
                        $end = strpos($c_str, ';');
                    }
                $enum_name = substr($c_str, $begin+4, $end-$begin-4);
                $enum_name = trim($enum_name);
    
            }

            $c_str_def = 'typedef enum '.$enum_name.' '.$name.';'.PHP_EOL;
            if (fwrite($this->fp2, $c_str_def) === FALSE) {
                echo "Cannot write to file (declaration-enum-typedef.h)";
                exit;
            }
        }

        $c_str = $c_str.PHP_EOL;

        if (fwrite($this->fp, $c_str) === FALSE) {
            echo "Cannot write to file (declaration-enum.h)";
            exit;
        }

    }

    function parseUNION($node) {
        $xpath = new \DOMXPath($this->doc);
        $c_str = '';
        $deprecated = false;
        $name = "???";

        foreach($node->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
            } else if ($child->nodeName=='DEPRECATED') {
                $deprecated = true;
            } else {
                echo "'$name' : Unexpected xml structre.\n";
            }
        }

        $c_str = str_replace($this->replace, $this->search, $c_str);

        $c_str = trim($c_str);
        if (0===strpos($c_str, 'typedef')) {
        } else {
            if (empty($c_str)) {
                if (isset($this->exposed[$name])) {
                    return;
                }
                $union_name = '__'.$name;
            } else {
                
                $begin = strpos($c_str, 'union');
                $end = strpos($c_str, '{');
                    if (false===$end) {
                        $end = strpos($c_str, ';');
                    }
                $union_name = substr($c_str, $begin+5, $end-$begin-5);
                $union_name = trim($union_name);
        
            }

            $c_str_def = 'typedef union '.$union_name.' '.$name.';'.PHP_EOL;
            if (fwrite($this->fp2, $c_str_def) === FALSE) {
                echo "Cannot write to file (declaration-union-typedef.h)";
                exit;
            }
        }

        $c_str = $c_str.PHP_EOL;

        if (fwrite($this->fp, $c_str) === FALSE) {
            echo "Cannot write to file (declaration-union.h)";
            exit;
        }

    }

    function parseUSER_FUNCTION($node) {
        $xpath = new \DOMXPath($this->doc);
        $c_str = '';
        $deprecated = false;
        $name = "???";
        $return = '';

        foreach($node->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
            } else if ($child->nodeName=='RETURNS') {
                $return = trim($child->nodeValue);
            } else if ($child->nodeName=='DEPRECATED') {
                $deprecated = true;
            } else {
                echo "'$name' : Unexpected xml structre.\n";
            }
        }

        $c_str = str_replace($this->replace, $this->search, $c_str);
        
        $c_str = trim($c_str);
        if (0===strpos($c_str, 'typedef')) {
        } else {
            $c_str_def = "typedef $return (*$name) ($c_str);".PHP_EOL;
            if (fwrite($this->fp2, $c_str_def) === FALSE) {
                echo "Cannot write to file (declaration-user_function-typedef.h)";
                exit;
            }
        }

        /*$c_str = $c_str.PHP_EOL;

        if (fwrite($this->fp, $c_str) === FALSE) {
            echo "Cannot write to file (declaration-user_function.h)";
            exit;
        }*/
    }

    function parseFUNCTION($node) {
        $xpath = new \DOMXPath($this->doc);
        $c_str = '';
        $deprecated = false;
        $name = "???";
        $return = '';

        foreach($node->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
            } else if ($child->nodeName=='RETURNS') {
                $return = trim($child->nodeValue);
            } else if ($child->nodeName=='DEPRECATED') {
                $deprecated = true;
            } else {
                echo "'$name' : Unexpected xml structre.\n";
            }
        }

        $c_str = str_replace($this->replace, $this->search, $c_str);
        $c_str = trim($c_str);
        
        /*if (0===strpos($c_str, 'typedef')) {
        } else {
            $c_str_def = "typedef $return (*$name) ($c_str);".PHP_EOL;
            if (fwrite($this->fp2, $c_str_def) === FALSE) {
                echo "Cannot write to file (declaration-function-typedef.h)";
                exit;
            }
        }*/

        $c_str = "$return $name($c_str);".PHP_EOL;

        if (fwrite($this->fp, $c_str) === FALSE) {
            echo "Cannot write to file (declaration-function.h)";
            exit;
        }

    }

}
