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
use Zend\Ext\Exceptions\DeprecatedException;
use Zend\Ext\Models\AbstractGenerator;
use Zend\Ext\Models\EnumGenerator;

class SourceCode {
    const GIT_COMMAND = 'git';
    protected $tmp_file = __DIR__.'/../../tmp/declaration.h';
    protected $data_file = __DIR__.'/../../data/config-glib.h';

    protected $doc_dir = '';

    public $data = array();

    /**
     * @var string $name
     */
    protected $name;


    /**
     * @var Array $reporting
     */
    protected $reporting = array();



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
    public $array = NULL;

    private $search = array();
    private $replace = array();

    protected $blacklist = array();// array('STRUCT'=>array('mystruct'))

    protected $_parse;// int : 0=> nop; 1=> parse(); 2=> parse() and evaluate()
    protected $_item;// string of item to process( Typedef | Macro | Enum | Struct)
    protected $_item_processed;// array of typedef processed successfully
    protected $_item_remaining;// array of failed items
    protected $_current_item;// string of current typedef
    protected $_passed_item;// number of typedef processed successfully
    protected $_total_item;// number of typedef successfully processed
    protected $_skipable;

    /**
     * DocReference constructor.
     * @param null $source_dir
     * @param null $build_dir
     * @throws Exception
     */
    function __construct($source_dir=NULL, $build_dir=NULL){
        $this->source_dir = $source_dir;
        $this->build_dir = $build_dir;
        $this->sanityCheck();
    }

    /**
     * Check & Initialize directory
     */
    function sanityCheck() {
        if (empty($this->name)){
            throw new Exception("Zend\Ext\Service\SourceCode::\$name can not be empty");
        }

        if (empty($this->doc_dir)){
            throw new Exception("Zend\Ext\Service\SourceCode::\$doc_dir can not be empty");
        }

        $source_dir = realpath($this->source_dir.'/'.$this->doc_dir);
        $build_dir = realpath($this->build_dir.'/'.$this->doc_dir);
        if (empty($source_dir)){
            throw new Exception("No such file or directory : '$this->source_dir'");
        }
        if (empty($build_dir)){
            throw new Exception("No such file or directory : '$this->build_dir'");
        }

        // <root>/tmp/declaration.h
        $tmp_dir = dirname($this->tmp_file);
        if (!file_exists($tmp_dir)) {
            `mkdir -p $tmp_dir`;
        }
        if (!file_exists($this->tmp_file)) {
            `touch $this->tmp_file`;
        }
        $this->tmp_file = realpath($this->tmp_file);

        // <root>/data/config-glib.h
        $data_dir = dirname($this->data_file);
        if (!file_exists($data_dir)) {
            `mkdir -p $data_dir`;
        }
        if (!file_exists($this->data_file)) {
            `touch $this->data_file`;
        }
        $this->data_file = realpath($this->data_file);


        // check directory
        //home/dev/Projects/glib-build-doc/config.h
        // #define PACKAGE_VERSION "2.56.4"
        // #define PACKAGE_NAME "glib"
        // have the documentation ?
        // /home/dev/Projects/glib-build-doc/docs/reference/glib/html/index.html
        // No ? have build ?
        // check /home/dev/Projects/glib-build-doc/glib/.libs/libglib-2.0.so
        // check
        /*
        $ret = preg_match("#/docs/reference/gobject$#", $source_dir, $match);
        if (!$ret){
            throw new Exception("Argument \$source_dir( \"$this->source_dir\") need to point to <glib-source>/docs/reference/gobject");
        }
        $ret = preg_match("#/docs/reference/gobject$#", $build_dir, $match);
        if (!$ret){
            throw new Exception("Argument \$build_dir( \"$this->build_dir\") need to point to <glib-source>/docs/reference/gobject");
        }
        */

        $this->source_dir = $source_dir;
        $this->build_dir = $build_dir;
    }

    function addBlackList(array $data) {
        $this->blacklist = $data;
    }

    function getName():string {
        return $this->name;
    }

    function parse(string $code):array {
        file_put_contents($this->tmp_file, $code);
        $tokens = $this->preprocessor->process($this->tmp_file);
        $ast = $this->parser->parse($tokens, $this->context);
        $this->printer->print($ast, $array);
        return $array;
    }

    function isAllowed() {
        if (isset($this->blacklist[$this->_item])) {
            $blacklist = $this->blacklist[$this->_item];
            if (in_array($this->_current_item, $blacklist)) {
                return False;
            }
        }
        return True;
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

        $this->doc = new DOMDocument();
        $this->doc->loadXML($str_xml);

        $this->xpath = new DOMXPath($this->doc);

        /**
         * Because certain type are used before being declared,
         * we have to repeat the operation
         */
        /*$types = $this->parser->getTypes();
        $keys = array_keys($types);
        print_r($keys);*/
        $enable = True;

        if ($enable) {
            $this->getItems('TYPEDEF', 2);
            $this->data['TYPEDEF']=$this->array['typedefs'];
            unset($this->array);
        }

        if ($enable) {
            $this->getItems('MACRO');
            //TODO: $model = $this->getPackage()->createEnum($name, $data);
            //$model = new EnumGenerator(/*$data*/);
            //TODO: $model = $this->getPackage()->createStruct($name, $data);
            //$model = new StructGenerator($data);
            $this->data['MACRO']=$this->array;
            unset($this->array);
        }

        if ($enable) {
            $this->getItems('ENUM', 3);
            $this->data['ENUM']=$this->array['enums'];
            unset($this->array);
        }

        // Additional typedef
        $tokens = $this->preprocessor->process($this->data_file);
        $this->parser->parse($tokens, $this->context);

        /**
         * @see glib-decl.txt for <STRUC>GThread</STRUC> (is duplicated ?)
         */
        if ($enable) {
            $this->getItems('STRUCT', 2, 3);
            $this->data['STRUCT']=$this->array['structs'];
            // concat $this->data['TYPEDEF'] + $this->array['typedefs']
            unset($this->array);
        }

        //$enums = $this->getUserFunctions($nodes);
        if ($enable) {
            $this->getItems('USER_FUNCTION', 2, 3);
            $this->data['TYPEDEF'] += $this->array['typedefs'];
            unset($this->array);
        }

        $this->parser;
        //unset($this->parser);
        unset($this->xpath);
        unset($this->doc);

        // TODO parse the file and create FunctionGenerator
        // TODO parse the file and create StructGenerator
        // TODO parse the file and create EnumGenerator
    }

    /* ----------------------------------------------------------------
     * <ITEM>
     * ---------------------------------------------------------------- */
    function getItems(string $item, int $parse=0, int $max_try=3) {
        $this->array = array();

        $this->_item = $item;
        $this->_parse = $parse;
        $expression = "/root/".$item;
        $nodes = $this->xpath->query($expression);

        $this->_total_item = count($nodes);
        $this->_passed_item = 0;
        $this->_item_remaining = array();
        $this->_item_processed = array();
        $this->_skipable = False;
        $max_pass = $max_try;
        $pass = 0;
        while($pass<$max_pass) {
            $pass++;
            $items = $this->tryGetItems($nodes);
            //$this->printer->evaluate($this->array);
            if (0==count($this->_item_remaining)) {
                break;
            } else {
                $this->_skipable = True;
            }
        }
        $this->reporting[$item]=array(
            'passed'=>$this->_passed_item.' of '. $this->_total_item
                ." $item processed in ${pass} pass( $max_pass max).",
            'processed'=>$this->_item_processed,
            'remaining'=>$this->_item_remaining,
        );
    }

    function tryGetItems(DOMNodeList  $list) {
        foreach($list as $node) {
            try {
                $this->getItem($node);
            } catch (BadDeclarationException $exc) {
                //TODO: push error reporting
                echo $this->_item.'::'.$this->_current_item.': '.$exc->getMessage()."\n";
            } catch (DeprecatedException $exc) {
                $msg = $exc->getMessage();
                $this->_item_remaining[$this->_current_item] = $msg;
            } catch (\LogicException $exc) {
                $msg = $exc->getMessage();
                $this->_item_remaining[$this->_current_item] = $msg;
            } catch (\Zend\C\Engine\Error $exc) {
                //$msg = substr($exc->getMessage(), 0, 32);
                $msg = $exc->getMessage();
                $this->_item_remaining[$this->_current_item] = $msg;
            }
        }

    }

    function getItem(DOMElement  $node) {
        $name = '';
        $c_str = '';
        $return = '';
        // $val = `echo $TERM`
        // $val == "xterm-256color"
        // "\e[1;31m red \e[0m "
        foreach($node->childNodes as $child) {
            if ($child->nodeType==XML_TEXT_NODE) {
                $c_str .= $child->nodeValue;
            } else if ($child->nodeName=='NAME') {
                $name = trim($child->nodeValue);
                $this->_current_item = $name;
            } else if ($child->nodeName=='RETURNS') {
                $return = trim($child->nodeValue);
            } else if ($child->nodeName=='DEPRECATED') {
                //throw new DeprecatedException("$this->_item '$name' : is deprecated.");
            } else {
                throw new BadDeclarationException("$this->_item '$name' : Unexpected xml structre.");
            }
        }
        //$this->_current_item = $name;
        if (! $this->isAllowed())
            return;
        if(isset($this->_item_processed[$name]))
            return;

        $c_str = str_replace($this->replace, $this->search, $c_str);
        $c_str = trim($c_str);

        if ('USER_FUNCTION'==$this->_item) {
            if (empty($c_str)) echo "$name\n";
            $c_str = "typedef $return (*$name) ($c_str);";
        } elseif ('STRUCT'==$this->_item && empty($c_str)) {
            $c_str = 'typedef struct _'.$name.' '.$name.';'."\n";
        }

        // TODO accepte string for $parser->parse()
        //$this->tmp_file = dirname($this->tmp_file).'/'.$name.'.h';
        file_put_contents($this->tmp_file, $c_str);
        $tokens = $this->preprocessor->process($this->tmp_file);

        if ($this->_parse>0) {
            /*
            if ($this->_item=="STRUCT") {
                echo $this->_item.'::'.$this->_current_item."\n";
            }
            if ('USER_FUNCTION'==$this->_item) {
                echo $this->_current_item . PHP_EOL;
            }
            */
            $ast = $this->parser->parse($tokens, $this->context);

            if ($this->_parse>1) {
                $this->printer->print($ast, $this->array);
                //print_r(array_keys($this->array));
                //if (count($this->array) && $this->_item='STRUCT' && isset($this->array['name']) && $this->array['name']='_GArray')
                //    print_r($this->array);
                    //echo $this->array['name'], ' ', $this->array['type'], PHP_EOL;
            }

            /*
            if (is_null($ast)) {
                echo __FUNCTION__.":at $name \$ast is null\n";
            } else {
                $this->printer->print($ast, $this->array);
            }
            */
        }


        // consistency check
        if (False/*$name!=$data['name']*/) {
            throw new LogicFileException('ENUM name missmatch');
        }

        //echo "$this->_item \e[1;32m $this->_current_item \e[0m Done\n";
        unset($this->_item_remaining[$this->_current_item]);
        $this->_item_processed[$name]=True;
        $this->_passed_item++;
    }
}
