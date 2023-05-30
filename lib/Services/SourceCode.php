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
use Exception;
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

    public $data = array('TYPEDEF'=>[], 'UNION'=>[], 'MACRO'=>[], 'ENUM'=>[], 'STRUCT'=>[], 'FUNCTION'=>[]);

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
    protected $_item_fixed;// some struct declaration are empty, let count
    protected $_item_processed;// array of typedef processed successfully
    protected $_item_remaining;// array of failed items
    protected $_current_item;// string of current typedef
    protected $_passed_item;// number of typedef processed successfully
    protected $_total_item;// number of typedef successfully processed

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

        $this->printer = new PhpPrinter;
        $this->context = new Context;
        $lexer = new Lexer;
        $this->parser = new ExpressionParser($lexer);
        $this->preprocessor = new PreProcessor($this->context);

    }

    /**
     * Check & Initialize directory
     */
    function sanityCheck() {
        /*if (empty($this->name)){
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
        $this->source_dir = $source_dir;
        $this->build_dir = $build_dir;
        */

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
    
    function getFunction($name) {
        //TYPEDEF, MACRO, ENUM, STRUCT
        $functions = $this->data['FUNCTION'];
        $struct = Null;
        if (isset($functions[$name])) {
            return $functions[$name];
        } else if (isset($functions['_'.$name])) {
            return $functions['_'.$name];
        }
        return Null;
    }

    function getStruct($name) {
        //TYPEDEF, MACRO, ENUM, STRUCT
        $structs = $this->data['STRUCT'];
        $struct = Null;
        if (isset($structs[$name])) {
            return $structs[$name];
        } else if (isset($structs['_'.$name])) {
            return $structs['_'.$name];
        }
        return Null;
    }

    function hasProto($name) {
        $prototypes = $this->data['TYPEDEF'];
        if (isset($prototypes[$name])) {
            return true;
        } else if (isset($prototypes['_'.$name])) {
            return true;
        }
        return false;
    }

    function getProto($name)
    {
        $prototypes = $this->data['TYPEDEF'];
        $proto = Null;
        if (isset($prototypes[$name])) {
            return $prototypes[$name];
        } else if (isset($prototypes['_'.$name])) {
            return $prototypes['_'.$name];
        }
        return Null;
    }

    function hasTypedef($name) {
        $typedefs = $this->array['typedefs'];
        if (isset($typedefs[$name])) {
            return true;
        }
        return false;
    }
    
    function getTypedef($name) {
        $typedefs = $this->array['typedefs'];
        
        if (isset($typedefs[$name])) {
            return $typedefs[$name];
        } else {
            echo "Typedef '$name' Not found\n";
        }
    }

    function getMacro($name)
    {
        $prototypes = $this->data['MACRO'];
        $proto = Null;
        if (isset($prototypes[$name])) {
            return $prototypes[$name];
        } else if (isset($prototypes['_'.$name])) {
            return $prototypes['_'.$name];
        }
        return Null;
    }

    function getEnum($name) {
        //print_r($this->sourceCode['Glib']->data['STRUCT']['_GList']);
        $structs = $this->data['ENUM'];
        $struct = Null;
        if (isset($structs[$name])) {
            return $structs[$name];
        } else if (isset($structs['_'.$name])) {
            return $structs['_'.$name];
        }
        return Null;
    }

    function getUnion($name) {
        //print_r($this->sourceCode['Glib']->data['STRUCT']['_GList']);
        $structs = $this->data['UNION'];
        $struct = Null;
        if (isset($structs[$name])) {
            return $structs[$name];
        } else if (isset($structs['_'.$name])) {
            return $structs['_'.$name];
        }
        return Null;
    }

    function loadTypes($decl) {
        // near "struct _GMarkupParser" In glib-decl.txt : /* Called for open tags <foo bar="baz"> */
        // in gdk3-decl.txt '/* Can be cast to window system specific'
        $search = array('&(v)', ' << ', '/*< ', '/* <', ' >*/', '&&', '&', ' <= ', '->', ' < ', ' > ', '_-|> <.', '<foo bar="baz">', '</foo>', '<Space> does', '<Return> does', '> */', '(1L<<0)', '(1L<<1)', '/*<private>*/');
        $replace = array('V_REF_PASS', 'SHIFT_LEFT', '/*_ ', '/* _', ' _*/', 'DOUBLE_PASS_REF', 'PASS_REF', 'GREATER_OR_EQUAL', 'SPECIAL_ARROW', ' GREATER ', ' LESSER ', 'EXCEPTIONEL', 'OPEN_TAG_FOO', 'CLOSE_TAG_FOO', '_SPACE_DOES', '_RETURN_DOES', '_ */', '_JOKE_1', '_JOKE_2', '/*_private_*/');
        $this->getDeclarations($decl, $search, $replace);
        //$constants = $this->getConstants();

        //$this->load_MACRO();
        //$this->load_STRUCT();
        //$this->load_FUNCTION();
        //$this->load_ENUM();
        //$this->load_TYPEDEF();
        //$this->load_USER_FUNCTION();
        //$this->load_VARIABLE();
        //$this->load_UNION();

    }

    function taskResume(&$collections) {
        $this->doc;
        $xpath = new DOMXPath($this->doc);

        $tags = array();
        $nodes = $xpath->query('/root/*');
        foreach($nodes as $child) {
            if (isset($tags[$child->nodeName])) {
                $tags[$child->nodeName] += 1;
            } else {
                $tags[$child->nodeName] = 1;
                $collections[$child->nodeName] = array();
            }
            $n = $xpath->query('NAME', $child);
            $collections[$child->nodeName][$n[0]->nodeValue] = 1;
        }
        return $tags;
    }

    function getDeclarations(string $filepath, array $search=array(), array $replace=array())
    {
        $filename = realpath($filepath);
        if (empty($filename)) {
            throw new NoSuchFileException("'$filepath' not found");
        }
        $str = file_get_contents($filename);
        $str = str_replace('struct utimbuf when just', 'struct utimbuf when just*/', $str);

        $str_xml = "<root>$str</root>";
        $str_xml = str_replace($search, $replace, $str_xml);
        $this->search = $search;
        $this->replace = $replace;

        $this->doc = new DOMDocument();
        $this->doc->loadXML($str_xml);

        $collections = array();
        $kinds = $this->taskResume($collections);
        print_r($kinds);
        /*
        print_r($collections['UNION']);
        */

        $this->xpath = new DOMXPath($this->doc);

        /**
         * Because certain type are used before being declared,
         * we have to repeat the operation
         */
        /*$types = $this->parser->getTypes();
        $keys = array_keys($types);
        print_r($keys);*/

        for ($i=0; $i<1; $i++) {
            $enable = True;
            if ($enable) {
                $this->getItems('TYPEDEF', 2);
                //$this->data['TYPEDEF']=$this->array['typedefs'];
                $this->data['TYPEDEF'] = array_merge($this->data['TYPEDEF'], $this->array['typedefs']);
                unset($this->array);
            }

            if ($enable) {
                $this->getItems('MACRO');
                //TODO: $model = $this->getPackage()->createEnum($name, $data);
                //$model = new EnumGenerator(/*$data*/);
                //TODO: $model = $this->getPackage()->createStruct($name, $data);
                //$model = new StructGenerator($data);
                //$this->data['MACRO']=$this->array;
                $this->data['MACRO'] = array_merge($this->data['MACRO'], $this->array);
                //$macros = $this->preprocessor->getDefinitions();
                //print_r($macros['g_list_previous']);
                unset($this->array);
            }

            // Additional typedef
            if ($i==0) {
                $tokens = $this->preprocessor->process($this->data_file);
                $this->parser->parse($tokens, $this->context);
            }

            if ($enable) {
                $this->getItems('ENUM', 3);
                //$this->data['ENUM']=$this->array['enums'];
                $this->data['ENUM'] = array_merge($this->data['ENUM'], $this->array['enums']);
                unset($this->array);
            }

            if ($enable) {
                $this->getItems('UNION', 3);
                //$this->data['ENUM']=$this->array['enums'];
                $this->data['UNION'] = array_merge($this->data['UNION'], $this->array['unions']);
                unset($this->array);
            }
            

            /**
             * @see glib-decl.txt for <STRUC>GThread</STRUC> (is duplicated ?)
             */
            if ($enable) {
                $this->getItems('STRUCT', 2, 3);
                //$this->data['STRUCT']=$this->array['structs'];
                $this->data['STRUCT'] = array_merge($this->data['STRUCT'], $this->array['structs']);
                // concat $this->data['TYPEDEF'] + $this->array['typedefs']
                unset($this->array);
            }

            //$enums = $this->getUserFunctions($nodes);
            if ($enable) {
                $this->getItems('USER_FUNCTION', 2, 1);
                //$this->data['TYPEDEF'] += $this->array['typedefs'];
                $this->data['TYPEDEF'] = array_merge($this->data['TYPEDEF'], $this->array['typedefs']);
                unset($this->array);
            }

            if ($enable) {
                $this->getItems('STRUCT', 2, 3);
                //$this->data['STRUCT']=$this->array['structs'];
                $this->data['STRUCT'] = array_merge($this->data['STRUCT'], $this->array['structs']);
                // concat $this->data['TYPEDEF'] + $this->array['typedefs']
                unset($this->array);
            }

            if ($enable) {
                $this->getItems('FUNCTION', 2, 1);
                $this->data['FUNCTION'] = array_merge($this->data['FUNCTION'], $this->array['functions']);
                unset($this->array);
            }

        }

        // TODO parse the file and create FunctionGenerator
        // TODO parse the file and create StructGenerator
        // TODO parse the file and create EnumGenerator

        echo "\n";
        echo '.../'.basename($filename)." parsed...\n";
        echo "----------------------------------\n";
        echo $this->reporting['TYPEDEF']['passed'].PHP_EOL;
        echo $this->reporting['ENUM']['passed'].PHP_EOL;
        echo $this->reporting['STRUCT']['passed'].PHP_EOL;
            echo "\tGWin32PrivateStat Doublon\n";
            echo "\tGThread Doublon\n";
            echo "\tTotal: 82/82\n";
        echo $this->reporting['MACRO']['passed'].PHP_EOL;
        echo $this->reporting['USER_FUNCTION']['passed'].PHP_EOL;

        print_r($this->reporting['ENUM']['remaining']);
        print_r($this->reporting['USER_FUNCTION']['remaining']);
        print_r($this->reporting['STRUCT']['remaining']);

        // Syntax error, unexpected IDENTIFIER(AtkObject)
        /*foreach($this->reporting['STRUCT']['remaining'] as $struct) {
            if (strstr($struct, 'Syntax error, unexpected IDENTIFIER')) {
                $name = substr($struct, 36);
                $pos = strpos($name, ')');
                $name = substr($name, 0, $pos);
                echo 'typedef struct _',$name,' ',$name,';', PHP_EOL;
            }
        }*/
        /*foreach($this->reporting['STRUCT']['remaining'] as $name => $struct) {
            if (strstr($name, 'Class')) {
                $pos = strpos($name, 'Class');
                $name = substr($name, 0, $pos);
                echo 'typedef struct _',$name,' ',$name,';', PHP_EOL;
            }
        }*/

        //print_r($this->reporting['USER_FUNCTION']['remaining']);
        //echo count($this->reporting['STRUCT']['processed']).PHP_EOL;
        //print_r($this->reporting['STRUCT']);
        /*
        $expression = "/root/STRUCT/NAME";
        $nodes = $this->xpath->query($expression);
        echo "Check ".count($nodes)." structs".PHP_EOL;
        echo "Done ".count($this->reporting['STRUCT']['processed'])." structs".PHP_EOL;
        $i=0;
        $doublon = array();
        foreach($nodes as $node) {
            $name = trim($node->nodeValue);
            if(isset($doublon[$name])) {
                echo '>>'.$name ."\n";
            }
            $doublon[$name] = 1;
            if (empty($name)) {
                echo "One empty name \n";
            }
            if (!isset($this->reporting['STRUCT']['processed'][$name])) {
                echo 'blacklist '.$name . PHP_EOL;
            }
            $i++;
        }
        echo $i."\n";
        */


        //echo $this->reporting['USER_FUNCTION']['passed'].PHP_EOL;
        //print_r($this->reporting);
        //echo $this->reporting['USER_FUNCTION']['passed'].PHP_EOL;
        //print_r($this->reporting['USER_FUNCTION']['remaining']);

        $this->parser;
        //unset($this->parser);
        unset($this->xpath);
        unset($this->doc);
    }

    /* ----------------------------------------------------------------
     * <ITEM>
     * ---------------------------------------------------------------- */
    function getItems(string $item, int $parse=0, int $max_try=3) {
        $this->array = array('typedefs'=>array(), 'enums'=>array(), 'structs'=> array(), 'unions'=> array());

        $this->_item = $item;
        $this->_parse = $parse;
        $expression = "/root/".$item;
        $nodes = $this->xpath->query($expression);

        $this->_total_item = count($nodes);
        $this->_passed_item = 0;
        $this->_item_remaining = array();
        $this->_item_processed = array();
        $this->_item_fixed = array();
        $max_pass = $max_try;
        $pass = 0;
        while($pass<$max_pass) {
            $pass++;
            $items = $this->tryGetItems($nodes);
            //$this->printer->evaluate($this->array);
            if (0==count($this->_item_remaining)) {
                break;
            }
        }
        $this->reporting[$item]=array(
            'passed'=>$this->_passed_item.' of '. $this->_total_item
                ." $item processed in $pass pass( $max_pass max).",
            'processed'=>$this->_item_processed,
            'fixed'=>$this->_item_fixed,
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
                //echo $msg.PHP_EOL;
            } catch (\LogicException $exc) {
                $msg = $exc->getMessage();
                $this->_item_remaining[$this->_current_item] = $msg;
                //echo $msg.PHP_EOL;
            } catch (\Zend\C\Engine\Error $exc) {
                //$msg = substr($exc->getMessage(), 0, 32);
                $msg = $exc->getMessage();
                $this->_item_remaining[$this->_current_item] = $msg;
                //echo $msg.PHP_EOL;
            }/* catch (\Exception $exc) {
                throw new \Exception($exc->getMessage().' # for '.$this->_current_item);
            }*/
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
        if(isset($this->_item_processed[$name])) {
            return;
        }

        $c_str = str_replace($this->replace, $this->search, $c_str);
        $c_str = trim($c_str);

        if ('USER_FUNCTION'==$this->_item) {
            if (empty($c_str)) echo "$name is empty\n";
            $c_str = "typedef $return (*$name) ($c_str);";
        } elseif ('FUNCTION'==$this->_item) {
            $c_str = $return.' '.$name.' ('.$c_str.');'."\n";
            //$this->_item_fixed[$name]="typedef struct";
        } elseif ('STRUCT'==$this->_item && empty($c_str)) {
            $c_str = 'typedef struct _'.$name.' '.$name.';'."\n";
            //$this->_item_fixed[$name]="typedef struct";
        }

        /*
        if (in_array($name, array('GDestroyNotify', 'GHookFinalizeFunc', 'GSourceFunc', 'GSourceDummyMarshal'))) {
            echo $c_str . PHP_EOL;
        }
        */

        // TODO accepte string for $parser->parse()
        //$this->tmp_file = dirname($this->tmp_file).'/'.$name.'.h';
        file_put_contents($this->tmp_file, $c_str);
        try {
            $tokens = $this->preprocessor->process($this->tmp_file);
        } catch (\Exception $error) {
            throw new \Zend\C\Engine\Error($error->getMessage());
        }

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
        $this->_item_processed[$name]=1;
        $this->_passed_item++;
    }
}
