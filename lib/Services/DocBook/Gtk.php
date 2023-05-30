<?php

namespace Zend\Ext\Services\DocBook;


use Exception;
use SimpleXMLElement;

use Zend\Ext\Models\AbstractGenerator;
use Zend\Ext\Models\FileGenerator;
use Zend\Ext\Models\GroupGenerator;
use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\TypeGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\StructGenerator;
use Zend\Ext\Models\EnumGenerator;
use Zend\Ext\Models\UnionGenerator;
use Zend\Ext\Models\VarGenerator;
use Zend\Ext\Models\ConstantGenerator;

use Zend\Ext\Models\FunctionGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\PropertyGenerator;
use Zend\Ext\Models\TagGenerator;
use Zend\Ext\Models\AnnotationGenerator;

use Zend\Ext\Services\DocBook;
use Zend\Ext\Services\DocBook\Classifier\Cairo as CairoClassifier;


class Gtk extends DocBook
{
    const ENABLE_CLASSIFICATION = false;

    public $blacklist = array();
    public $remap = array();
    public $remap_function=array();

    public $checkout_dir=null;

    /**
     * @var PackageGenerator
     */
    protected $package;

    /**
     * @var String
     */
    protected $filename=null;
    // $codeGenerator//sub package

    protected $includesDir = [];
    
    /**
     * @var AbstractGenerator
     */
    protected $current_generator;

    /*function save($dirname): string
    {
        $service = current($this->codeGenerator);
        return $service->render($this->package);
    }*/

    public function __construct(string $filename, string $checkout_dir) {
        $this->filename = $filename;
        $this->checkout_dir = realpath($checkout_dir);
    }
    public function addIncludeDir(string $path) {
        $this->includesDir[] = $path;
    }

    public function getPackage(string $name=null) {
        if (empty($name)) {
            if ($this->package) {
                return $this->package;
            }
            $this->package = $this->loadParts($this->filename);

            //$this->classify();

            return $this->package;
        } else {
            echo 'Unssopported filter', PHP_EOL;
        }
        // TODO
    }

    /**
     * TODO rename by 'load'
     * class-level DocBlock example.
     * @package applies_to_bluh
     * @subpackage bluh
     */
    protected function loadParts(string $filename): PackageGenerator
    {
        $doc = new \DomDocument();
        $doc->load($filename);

        $id = $doc->documentElement->getAttribute('id');//id="cairo"

        $this->package = new PackageGenerator($id);
        $xpath = new \DOMXpath($doc);
        $elements = $xpath->query("/book/title");
        $title = $elements[0]->nodeValue;
        $this->package->setDescription($title);


        /**
         * @var PackageGenerator
         */
        $package = null;
        $whitelist = [];

        foreach($doc->documentElement->childNodes as $node) {
            if ($node->nodeType == XML_ELEMENT_NODE
            && 'part'==$node->nodeName) {
                //echo $doc->saveXML($node);
                $group_id = $node->getAttribute('id');//id="cairo-drawing"
                $whitelist = null;
                $files = [];
                foreach($node->childNodes as $child) {
                    switch ($child->nodeName) {
                        case 'title':
                            $group_title = $child->nodeValue;
                            break;
                        case 'partinfo':
                            $whitelist = $this->loadPartinfo($child);
                            break;
                        //case 'book':
                        //    $whitelist = $this->loadBook($child);
                        //    break;
                        case 'xi:include':
                            $href = $child->getAttribute('href');
                            if ('cairo'==$group_id) {
                                $filepath = $this->checkout_dir.DIRECTORY_SEPARATOR
                                . $group_id.DIRECTORY_SEPARATOR
                                . $href;
                            } else {
                                $filepath = $this->checkout_dir.DIRECTORY_SEPARATOR
                                . $group_id.'-build-doc'.DIRECTORY_SEPARATOR
                                . $href;
                            }
                            ///echo $filepath, PHP_EOL;
                            $files[] = $filepath;
                            break;
                    }
                }
                $package = $this->package->createPackage($group_id);
                $package->setIsModule();
                $package->doc_files = $files;
                $package->setDescription($group_title);
                $this->setWhitelist($whitelist);
                $this->current_generator = $package;
                $this->loadPackage($package);// TODO: refactor : pass $files
                $this->current_generator = $this->package;

            }
        }

        return $this->package;
    }
    
    /**
     * class bluh
     * class-level DocBlock example.
     * @package applies_to_bluh
     * @subpackage bluh
     */
    protected function loadPartinfo(\DOMElement $node)
    {
        $whitelist = [];
        $primary = '';
        foreach($node->childNodes as $child) {
            switch ($child->nodeName) {
                case 'indexterm':
                    foreach($child->childNodes as $item) {
                        switch ($item->nodeName) {
                            case 'primary':
                                $primary = trim($item->nodeValue);
                                $whitelist[$primary] = array();
                                //$this->useWhitelist = true;
                                break;
                            case 'secondary':
                                $whitelist[$primary][trim($item->nodeValue)] = $item->getAttribute('id');
                                break;
                        }
                    }
                    break;
            }
        }
        if (empty($whitelist)) {
            return null;
        }
        return $whitelist;
    }

    /**
     * class bluh
     * class-level DocBlock example.
     * @package applies_to_bluh
     * @subpackage bluh
     */
    protected function loadPackage($package)
    {
        foreach($package->doc_files as $filename) {
            $doc = new \DomDocument();
            $doc->load($filename);
            $this->loadChapter($doc->documentElement);
        }

        // TODO foreach package as recursive; get functions and put it in Class
        // cairo_create(Surface); => $cr = $surface->cairoCreate();
    }

    /**
     * class bluh
     * class-level DocBlock example.
     * @package applies_to_bluh
     * @subpackage bluh
     */
    protected function loadChapter(\DOMElement $element)
    {
        $id = $element->getAttribute('id');//id="cairo"
        $doc = $element->ownerDocument;
        $filename = $doc->documentURI;
        //var_dump($id);

        /** @var PackageGenerator $group_package */
        $group_package = $this->current_generator;
        //$group_package = $this->current_generator->createPackage($id);

        $xpath = new \DOMXpath($doc);
        $elements = $xpath->query("/book/title");
        if (count($elements)) {
            $title = $elements[0]->nodeValue;
            $group_package->setDescription($title);
        }

        /**
         * @var PackageGenerator
         */
        $package = null;

        foreach($element->childNodes as $node) {
            // cairo
            if ($node->nodeType == XML_ELEMENT_NODE
            && 'chapter'==$node->nodeName) {
                $group_id = $node->getAttribute('id');//id="cairo-drawing"
                //echo "     $id=>$group_id\n";
                if(!$this->isAllowed($id, $group_id)) {
                    continue;
                }
                $title = '';
                $files = array();
                foreach($node->childNodes as $child) {
                    switch ($child->nodeName) {
                        case 'title':
                            $title = $child->nodeValue;
                            break;
                        case 'xi:include':
                            $href = $child->getAttribute('href');
                            $path = dirname($filename);

                            if (in_array(basename($href), $this->blacklist)) {
                                echo 'Skeep: ' . $path.DIRECTORY_SEPARATOR.$href . PHP_EOL;
                                break;
                            }

                            $files[] = $path.DIRECTORY_SEPARATOR.$href;
                            break;
                    }
                }
                $package = $group_package->createPackage($group_id);
                $package->setDescription($title);
                $package->doc_files = $files;// TODO: remove doc_files
                foreach($package->doc_files as $filepath) {
                    $this->current_generator = $package;
                    $this->loadRefentry($filepath);
                }
            }
            // gtk
            if ($node->nodeType == XML_ELEMENT_NODE
            && 'part'==$node->nodeName) {
                $id_ref = $node->getAttribute('id');// gtkobjects
                //echo "$id=>$id_ref\n";
                if($this->isAllowed($id, $id_ref)) {
                    $this->loadChapter($node);
                }
            }
        }


        // TODO: mettre aussi les function dans $root->children
        //echo $this->package->getName().PHP_EOL;
        /** */
        foreach($this->package->subpackage as $subpackage) {
            //echo $subpackage->getName().PHP_EOL;
            foreach($subpackage->subpackage as $package) {
                //echo '  '.$package->getName().PHP_EOL;
                foreach($package->children as $fileGenerator) {
                    //echo '    '.$fileGenerator->getName().PHP_EOL;
                    foreach($fileGenerator->children as $child) {
if (self::ENABLE_CLASSIFICATION) {
                        if ($child instanceof FunctionGenerator) {
                            if (isset($this->remap_function[$child->getName()])) {
                                $link_name = $this->remap_function[$child->getName()];
                                $link_object = $fileGenerator->getPackage()->getSymbol($link_name);
                                $link_object->relateds[$child->getName()] = $child;
                                $child->setParentGenerator($link_object);
                                $child->isClassified = true;
                                continue;
                            }

//echo "\033[101m", $child->getName(), "\033[0m\n";


                            $parameters = $child->getParameters();
                            if (count($parameters)) {
                                $first = current($parameters);
                                $type_name = $first->getType()->getName();
                                $link_object = $fileGenerator->getPackage()->getSymbol($type_name);
                                if ($link_object) {
                                    $child->isClassified = true;
                                    $link_object->relateds[$child->getName()] = $child;
                                    $child->setParentGenerator($link_object);
                                    continue;
                                }
                            }
                        }
}

                    }
                }
            }
        }
        /**/

        $this->current_generator = $group_package;
    }

    /**
     * load glib-docs.xml to get xi:include in each chapter
     * <book id="index">
     *   <chapter id="glib-data-types">
     *     <xi:include href="xml/hash_tables.xml" />
     *   </chapter>
     * </book>
     */
    protected function loadRefentry($filename)
    {
        /** @var PackageGenerator $current_generator */
        $current_generator = $this->current_generator;

        $id = $this->current_generator->getName();// cairo-drawing

        $file = file_get_contents($filename);
        $temp = str_replace(array('&#160;', '&nbsp;', '&ast;'), '', $file);
        $xml = simplexml_load_string($temp) or die("xml not loading: '$filename'");

        $id_ref = (string)$xml['id'];

        if($this->isAllowed($id, $id_ref)) {

            if ($this->trace) 
            echo "\e[1;32m".'Process'."\e[0m : ".$filename . PHP_EOL;
            /**
             * @var FileGenerator $fileGenerator
             */
            $fileGenerator = $current_generator->createGroup(basename($filename));
            $fileGenerator->refentry_id = $id_ref;
            $current_generator->children[]=$fileGenerator;
            $this->current_generator = $fileGenerator;

            //$id = (string)$xml['id'];
            //$refpurpose = (string)$xml->refnamediv[0]->refpurpose;
            $refname = (string)$xml->refnamediv[0]->refname;
            //$refentrytitle = (string)$xml->refmeta[0]->refentrytitle;
            $name = $refname;
            if (isset($this->remap[$id_ref])) {
                $name = $this->remap[$id_ref];
            }
            $this->major_name = $name;

            $class = [];
            $methods = [];

            foreach($xml->refsect1 as $refsect1) {
                $refsect1_id=$refsect1['id'];//"GtkWidget.functions"
                $refsect1_name = substr($refsect1_id, strlen($id_ref)+1);
                $name = $refsect1_name;//str_replace('_', '-', $refsect1_name);
                switch($name) {
                    case 'functions':
                        $array = $this->getFunctions($xml);
                        foreach($array as $name=>$linkend) {
                            //echo $name, PHP_EOL;
                        }
                        break;
                    case 'properties':
                        break;
                    case 'style-properties':
                        break;
                    case 'signals':
                        break;
                    case 'other':
                        break;
                    case 'object-hierarchy':
                        break;
                    case 'derived-interfaces':
                        break;
                    case 'implemented-interfaces':
                        break;
                    case 'includes':
                        break;
                    case 'description':
                        break;
                    case 'functions_details':
                        $methods = $this->getFunctionsDetails($xml);
                        break;
                    case 'property-details':
                        break;
                    case 'style-property-details':
                        break;
                    case 'signal-details':
                        break;
                    case 'other_details':
                        $class = $this->getOtherDetails($xml);
                        break;
                    case 'see-also':
                        break;
                    default:
                        echo 'Unimplemented <refsect1 id="'.$id_ref.'.'.$refsect1_name.'">'.PHP_EOL;
                        break;
                }
            }
            // FileGenerator->addFunctions($methods);
            // FileGenerator->addClass($methods);
            //  class->addMethods($methods);
            //if ($class)
            //    $class->addMethods($methods);// Transformations ?
            // cairo_translate(cr);
            // 
            // we can create the Class because all reference are not defined yet.

        }
        // $package->addBoxed($class);
        // $package->addFunction($class);

        $this->current_generator = $current_generator;
    }
    
    protected function getFunctions(SimpleXMLElement $xml):array
    {
        $id = (string)$xml['id'];

        $array = array();

        $nodes = $xml->xpath("refsect1[@id='$id.functions']/informaltable/tgroup/tbody/row/entry[@role='function_name']/link");
        foreach($nodes as $node) {
            $linkend = (string) $node['linkend'];
            $function = (string) $node;
            $array[$function] = $linkend;
        }
        return $array;
    }
    protected function getProperties(SimpleXMLElement $xml){

    }
    protected function getStyleProperties(SimpleXMLElement $xml){

    }
    protected function getSignals(SimpleXMLElement $xml){

    }
    protected function getOther(SimpleXMLElement $xml){
        // loadOthers
    }
    protected function getObjectHierarchy(SimpleXMLElement $xml){
    }

    protected function getDerivedInterfaces(SimpleXMLElement $xml){
    }

    protected function getImplementedInterfaces(SimpleXMLElement $xml){
    }

    protected function getIncludes(SimpleXMLElement $xml){
    }

    protected function getDescription(SimpleXMLElement $xml){
    }

    protected function getAnnotations(SimpleXMLElement $entry) {
        $annotations=[];
        $str = strip_tags($entry->asXml());
        $parts = explode ('][', $str);
        $parts = str_replace (array(']', '['), '', $parts);
        foreach($parts as $part) {
            $elements = explode (' ', $part);
            $acronym = $elements[0];
            $annotation = AnnotationGenerator::Factory($acronym);// array && element-type && ...
            if ($annotation) {
                if (isset($elements[1])) {
                    $annotation->setParam($elements[1]);
                }
                $annotations[] = $annotation;
            }
        }
        return $annotations;
    }
    
    protected function getFunctionsDetails(SimpleXMLElement $xml){
        /** @var FileGenerator $generator */
        $generator = $this->current_generator;
        /** @var PackageGenerator */
        $package = $generator->getPackage();
        /** @var PackageGenerator */
        $module = $generator->getModulePackage();
        $methods = [];

        $id = (string)$xml['id'];
        $nodes = $xml->xpath("refsect1[@id='$id.functions_details']/refsect2");
        foreach($nodes as $node) {
            $function_id = $node['id'];
            $role = $node['role'];// 'function'
            if ('macro'==$role) {
                if ($this->trace) 
                echo "   Macro \e[3;35m".$node->indexterm[0]->primary."\e[0m ()".PHP_EOL;
                //echo "Skip $id.functions_details( $function_id)\n";
                //continue;
            }

            $function_name = (string)$node->indexterm[0]->primary;
            $function_kind = 'function';// in_array('function', 'prototype', 'macro');

            $signature = $this->sourceCode->getFunction($function_name);
            if (empty($signature)) {
                $signature = $this->sourceCode->getProto($function_name);
                $function_kind = 'prototype';
                if (empty($signature)) {
                    $signature = $this->sourceCode->getMacro($function_name);
                    $function_kind = 'macro';
                    if (empty($signature) || $signature['role']!='function') {
                        $function_kind = 'unknown';
                        echo 'continue: '.$function_id . ', ' . $function_name. ', role="'.$signature['role'].'" Not supported <----------------------------------'.PHP_EOL;
                        //echo 'continue: '.$function_id . ', ' . $function_name. PHP_EOL;
                        continue;
                    }
                }
            }
            
            /**
             * @var FunctionGenerator
             * @var PrototypeGenerator
             * @var MethodGenerator
             */
            $method = null;
            switch ($function_kind) {
                case 'function':
                    $method = $package->createMethod($function_name);// Redo : use createMethod
                    break;
                case 'prototype':
                    $method = $package->createPrototype($function_name);
                    break;
                case 'macro':
                    $method = $package->createFunction($function_name);
                    $method->setIsMacro();
                    break;
                // default  : How it's possible ?
            }
            $method->setOwnPackage($generator->getOwnPackage());
            $method->setParentGenerator($generator);

            // Hack : bad documentation, use source code to set right ordered/named parameters
            if ($signature) {
                foreach($signature['signature']['parameters'] as $param) {
                    if ($param['type']=='...') {
                        $parameter = $package->createParameter($param['type']);
                        $method->setParameter($parameter);
                        continue;
                    }
                    if (empty($param['name']) && $param['type']=='void') {
                        // my_function(void);
                        continue;
                    }
                    if (empty($param['name'])) {
                        echo "Error : no parameter name for '$function_name' ".$param['type']."\n";
                        continue;
                    }
                    $parameter = $package->createParameter($param['name']);
                    $parameter->setType($package->createType($param['type']));
                    //TODO: set pass, qualifier, modifier
                    if (isset($param['pass'])) {
                        $parameter->setPass($param['pass']);
                    }
                    $method->setParameter($parameter);
                }
            }
            /* Trace Debug
            if ($function_name=='cairo_read_func_t' || $function_name=='cairo_write_func_t') {
                print_r($signature);
            } */

            /*
            $signature_function = $this->sourceCode->getFunction($function_name);
            if ($signature_function) {
                foreach($signature_function['signature']['parameters'] as $param) {
                    if (empty($param['name'])) {
                        continue;
                    }
                    $parameter = $package->createParameter($param['name']);
                    $parameter->setType($package->createType($param['type']));
                    //TODO: set pass, qualifier, modifier
                    if (isset($param['pass'])) {
                        $parameter->setPass($param['pass']);
                    }
        
                    $method->setParameter($parameter);
                }
            }*/

            // Description :
            $description = '';
            $short_description = '';
            $warning_description = '';
            $tags = [];
            /** @var SimpleXMLElement $child */
            foreach($node->children() as $child) {
                if ('para'==$child->getName()) {
                    if (isset($child['role'])) {
                        switch ((string)$child['role']) {
                            case 'since':
                                $tags['since'] = (string)$child->link;
                                break;
                        }
                    } else {
                        $description .= $child->asXML();
                        if (null==$short_description)
                            $short_description .= $child->asXML();
                    }
                }
                if ('warning'==$child->getName()) 
                    $warning_description = $child->asXML();
            }
            $method->setDescription($description);
            $method->setShortDescription($short_description);
            if (isset($tags['since']))
                $method->setTagSince($tags['since']);
            /*
            if (isset($tags['deprecated']))
                $method->setTagDeprecated($tags['deprecated']);
            if (isset($tags['stability']))
                $method->setTagStability($tags['stability']);
            */

            // Parameters :
            $node_parameters = $node->xpath("refsect3[@id='$function_id.parameters']");

            foreach ($node_parameters as $node_parameter) {
                $rows = $node_parameter->xpath("informaltable/tgroup/tbody/row");
                foreach($rows as $row) {
                    $parameter_name = '';
                    $parameter_description = null;
                    $parameter_annotations = [];
                    foreach($row->entry as $entry) {
                        $role = $entry['role'];
                        switch ($role) {
                            case 'parameter_name':
                                $parameter_name = (string)$entry->para;
                                break;
                            case 'parameter_description':
                                $parameter_description = (string)$entry->para->asXml();
                                break;
                            case 'parameter_annotations':
                                $parameter_annotations = $this->getAnnotations($entry);
                                break;
                        }
                    }

                    $parameter = $method->getParameter($parameter_name);
                    //$parameter = $package->createParameter($parameter_name);
                    if(empty($parameter)) {
                        echo "Unexpected error parameter '$function_name' $parameter_name\n";
                    } else {
                        $parameter->setDescription($parameter_description);
                        $parameter->setAnnotations($parameter_annotations);
                    }

                    //$param_type = $package->createType($signature['signature']['parameters'][$parameter_name]['type']);
                    //$parameter->setType($param_type);

                }
            }

            
            // Returns :
            $annotations_return = [];
            /**
             * @var ParameterGenerator $parameter_return
             */
            $parameter_return = $package->createParameter('Returns');
            $node_parameters = $node->xpath("refsect3[@id='$function_id.returns']");
            $description = '';
            foreach($node_parameters as $node_parameter) {
                foreach($node_parameter->children() as $node) {
                    if ('para'==$node->getName()) {
                        if (isset($node->emphasis)) {
                            $annotations_return = $this->getAnnotations($node);
                        } else {
                            $description .= $node->asXML();
                        }
                    }
                }
            }

            $parameter_return->setDescription($description);
            $parameter_return->setAnnotations($annotations_return);
            $return_type = $package->createType($signature['signature']['return']['type']);
            $parameter_return->setType($return_type);
            if (isset($signature['signature']['return']['pass'])) {
                $parameter_return->setPass($signature['signature']['return']['pass']);
            }
            if (isset($signature['signature']['return']['qualifier'])) {
                $parameter_return->setQualifier($signature['signature']['return']['qualifier']);
            }
            // TODO: modifier( unsigned)

            $method->setParameterReturn($parameter_return);

            $generator->children[$function_name] = $method;
            $methods[] = $method;
        }

        $this->current_generator = $generator;
        return $methods;
    }

    protected function getPropertyDetails(SimpleXMLElement $xml){

    }
    protected function getStylePropertyDetails(SimpleXMLElement $xml){

    }
    protected function getSignalDetails(SimpleXMLElement $xml){

    }

    protected function getOtherDetails(SimpleXMLElement $xml){
        /** @var FileGenerator $generator */
        $generator = $this->current_generator;
        /** @var PackageGenerator $package */
        $package = $generator->getOwnPackage();

        $id = (string)$xml['id'];
        //cairo-Paths.other_details
        /*
        $refpurpose = (string)$xml->refnamediv[0]->refpurpose;
        $refname = (string)$xml->refnamediv[0]->refname;
        $refentrytitle = (string)$xml->refmeta[0]->refentrytitle;

        $name = $refname;
        if (isset($this->remap[$id])) {
            $name = $this->remap[$id];
        }
        $this->major_name = $name;
        */
        

        ///echo "\e[1;31m".$package->getOwnPackage()->getName()."\e[0m";
        //echo " \e[1;32m".$refpurpose."\e[0m";
        //echo " \e[1;33m".$name."\e[0m" . PHP_EOL;
        ///echo "::\e[1;34m".$name."\e[0m" . PHP_EOL;

        // $name = 'cairo_path_t' <= id="cairo-Paths"/cairo-paths.xml
        // namespace == cairo
        //$fileGenerator = $package->loadFileGenerator('php_cairo', $name);
        //$fileGenerator->addObject();

        // informaltable/tgroup/tbody/row
        $nodes = $xml->xpath("refsect1[@id='$id.other_details']/refsect2");
        
        $map = null;
        $package_name = $package->getName();
        if (isset($this->whitelist[$package_name])) {
            if (isset($this->whitelist[$package_name][$id])) {
                $map = $this->whitelist[$package_name][$id];
            }
        }
        
        $struct_names = [];
        $class_names = [];
        foreach($nodes as $node) {
            $role = (string)$node['role'];
            $struct_name = (string)$node->indexterm[0]->primary;
            switch($role) {
                case 'struct':
                    $struct_names[$struct_name] = $struct_name;
                    if ('Class'==substr($struct_name, -5)) {
                        $class_names[] = substr($struct_name, 0, -5);
                    }
                    $this->loadStruct($node);
                    break;
                case 'enum':
                    $struct_names[$struct_name] = $struct_name;
                    $this->loadEnum($node);
                    break;
                case 'union':
                    $struct_names[$struct_name] = $struct_name;
                    $this->loadUnion($node);
                    break;
                case 'typedef':
                    $typedef = $this->sourceCode->getTypedef($struct_name);
                    if ($typedef) {
                        // dummy struct
                        if ('struct'==$typedef['type']) {
                            $struct_names[$struct_name] = $struct_name;
                            $this->loadStruct($node);
                        } /*else if ('int'==$typedef['type']) {
                            $this->loadTypedef($node);
                        }*/ else {
                            $alias = $this->sourceCode->getTypedef($typedef['type']);
                            if ('struct'==$alias['type']) {
                                echo $struct_name.' is an Alias'.PHP_EOL;
                            } else {
                                echo 'Unimplemented <refsect2 role="'.$role.'" '.$struct_name.'=='.$typedef['type'].'>'.PHP_EOL;
                            }
                        }
                    }
                    /*
                    $struct = $this->sourceCode->getProto($struct_name);
                    $proto = $this->sourceCode->getProto($struct['name']);
                    $substruct = $this->sourceCode->getStruct($struct['name']);
                    if (null==$proto && null==$substruct) {
                        // dummy structure
                        if ('struct'==$struct['type']) {
                            $struct_names[$struct_name] = $struct_name;
                            $this->loadStruct($node);
                        } else {
                            echo 'Unimplemented <refsect2 role="'.$role.'" '.$struct_name.'>'.PHP_EOL;
                        }
                    }
                    */
                    break;
                case 'macro':
                    $macro = $this->sourceCode->getMacro($struct_name);
                    if ($macro) {
                        $this->loadMacro($node, $macro['role']);
                    } else {
                        echo 'Unimplemented <refsect2 role="'.$role.'">'.$struct_name.'</>'.PHP_EOL;
                        //throw new Exception("stop");
                    }
                    break;

                default:
                    echo 'Unimplemented* <refsect2 role="'.$role.'">'.$struct_name.'</>'.PHP_EOL;
                    break;
            }
        }
        
if (self::ENABLE_CLASSIFICATION) {
        if (isset($generator->children[$this->major_name])) {
            $master = $generator->children[$this->major_name];
            $generator->setMasterObject($master);// $generator == FileGenerator
            $master->isClassified = true;
            foreach($generator->children as $child) {
                // promot to class if vtable exist
                if (/*($child instanceof StructGenerator || $child instanceof UnionGenerator || $child instanceof EnumGenerator)*/ 
                    ! $child instanceof FunctionGenerator
                    &&  $this->major_name!=$child->getName()) {
                        $master->relateds[$child->getName()] = $child;// this add Class as related
                    $child->isClassified = true;
                }
            }
        }
}

        foreach ($class_names as $class_name) {
            $this->createClass($class_name);
            // unsete $struct['Class']
            // set $class
        }

        $this->current_generator = $package;
        return $class_names;
    }


    protected function createClass(string $name) {
        /** @var FileGenerator $generator */
        $generator = $this->current_generator;
        /** @var PackageGenerator $package */
        $package = $generator->getOwnPackage();
        
        /**
         * @var StructGenerator
         */
        $struct = $generator->children[$name];
        //$struct = $package->createStruct($name);

        /**
         * @var StructGenerator $vtable
         */
        $vtable = $generator->children[$name.'Class'];
        unset($generator->children[$name]);
        unset($generator->children[$name.'Class']);
        
        /**
         * @var ClassGenerator
         */
        $class = $package->createClass($name);
        $class->setDescription('TODO');
        $class->setShortDescription('TODO 2');
        $class->setInstance($struct);
        $class->setVTable($vtable);
        $generator->children[$name] = $class;
    }

    protected function getSeeAlso(SimpleXMLElement $xml){
        
    }

    protected function loadOthers(SimpleXMLElement $xml, $id):array
    {
        $array = array();

        $nodes = $xml->xpath("refsect1[@id='$id.other']/informaltable/tgroup/tbody/row");
        foreach($nodes as $node) {
            $entry_type=null;
            $entry_value=null;
            $entry_linkend=null;
            foreach($node->children() as $entry) {
                $role = (string)$entry['role'];
                switch($role) {
                    case 'typedef_keyword':
                        $entry_type = (string)$entry;// "typedef"
                        break;
                    case 'datatype_keyword':
                        $entry_type = (string)$entry;// "struct", 'enum', 'union', ''
                        break;
                    case 'function_name':
                        if (isset($entry->link)) {
                            $entry_linkend = (string)$entry->link['linkend'];// "GtkWidget-struct"
                            $entry_value = (string)$entry->link;// "GtkWidget"
                        } else {
                            echo 'Unexpected null <link>'.PHP_EOL;
                        }
                        break;
                    default:
                        echo 'Unexpected role: "' . $role . '"' . PHP_EOL;
                        break;
                }
            }
            $array[] = $entry_linkend;
        }

        return $array;
    }

    protected function loadStruct(SimpleXMLElement $refsect2):StructGenerator
    {
        /** @var FileGenerator $generator */
        $generator = $this->current_generator;
        /** @var PackageGenerator $package */
        $package = $generator->getOwnPackage();
        //$package = $generator->getModulePackage();

        $name = (string)$refsect2->indexterm[0]->primary;

        if ($name==$this->major_name) {
            if ($this->trace) 
            echo "  Struct \e[1;35m".$name."\e[0m".PHP_EOL;
        } else {
            if ($this->trace) 
            echo "  Struct \e[4;35m".$name."\e[0m".PHP_EOL;
        }

        $struct = $package->createStruct($name);
        $struct->setParentGenerator($generator);
        $this->current_generator = $struct;
        $generator->children[$name] = $struct;

        $description = '';
        $short_description = null;
        foreach($refsect2->children() as $node) {
            if ('para'==$node->getName()) {
                $description .= $node->asXML();
                if (null==$short_description)
                    $short_description .= $node->asXML();
            }
            if ('refsect3'==$node->getName())
                break;
        }

        $struct->setDescription($description);
        if(empty($short_description)) {
            echo 'No description found for : '.$name.PHP_EOL;
            $short_description='';
        }
        $struct->setShortDescription($short_description);

        //echo '      '.$id.':'.PHP_EOL;// "struct_members"
        foreach($refsect2->refsect3 as $refsect3) {
            $this->loadStructMembers($refsect3);
        }

        $this->current_generator = $generator;
        return $struct;
    }
    
    protected function loadStructMembers(SimpleXMLElement $refsect3)
    {
        /** @var StructGenerator $generator */
        $generator = $this->current_generator;
        /** @var PackageGenerator $package */
        //$package = $generator->getOwnPackage();

        $members = array();
        $rows = $refsect3->informaltable->tgroup->tbody->row;
        foreach($rows as $row) {
            $name = '';
            $type = null;
            $type_linkend = '';
            $description = '';
            $annotations = [];
            //echo "process structure : ".$refsect3['id']."\n";
            foreach($row->entry as $entry) {
                $role = (string)$entry['role'];
                switch ($role) {
                    case 'struct_member_name':
                        $name = (string)$entry->para[0]->structfield;
                        $type_linkend = (string)$entry->para[0]->link[0]['linkend'];
                        if (!empty($entry->para[0]->link)) {
                            $type = (string)$entry->para[0]->link[0]->type;
                        }
                        break;
                    case 'struct_member_description':
                        $description = $entry->para->asXml();
                        break;
                    case 'struct_member_annotations':
                        $emphasis = $entry->emphasis;
                        if (!empty($emphasis)) {
                            $annotations = $this->getAnnotations($entry);
                        }
                        break;
                    default:
                        break;
                }
            }

            $var = $this->package->createVar($name);
            if (!empty($type)) {
                $member_type = $this->package->createType($type);// maybe use name instead
                $var->setType($member_type);
            } else {
                // TODO
                $className = $generator->getName();
                $struct = $this->sourceCode->getStruct($className);
                $member_type = TypeGenerator::CreateAnonymous();
                $member_type->setPackage($this->package);
                $member_type->setIsPrototype(true);
                $member_type->setPrototype($struct['members'][$name]);
                
                $var->setType($member_type);
            }
            $var->setShortDescription($description);
            $var->setDescription($description);
            $var->setAnnotations($annotations);
            $members[$name] = $var;
        }
        $generator->setMembers($members);

        /*
        $struct = $this->sourceCode->getStruct($className);
        if (empty($struct))
            echo '"', $className, '" not found in source', PHP_EOL;
        else if (!empty($struct['members'])) {
            $count = 0;
            foreach ($struct['members'] as $member) {
                $property = new PropertyGenerator($member['name']);
                $type = new TypeGenerator($member['type']);
                $property->setType($type);
                //$property->setPass($member['pass']);
                $class->addPropertyFromGenerator($property);
                if($count==0){
                    $class->setExtendedClass($member['type']);
                }
                $count++;
            }
        }
        */
    }
    
    protected function loadEnum($refsect2) {
        /** @var FileGenerator $generator */
        $generator = $this->current_generator;
        /** @var PackageGenerator $package */
        $package = $generator->getOwnPackage();
        //$package = $generator->getPackage();

        $name = (string)$refsect2->indexterm[0]->primary;
        if ($this->trace) 
        echo "    Enum \e[2;35m".$name."\e[0m".PHP_EOL;
        $enum = $package->createEnum($name);
        $enum->setParentGenerator($generator);
        $this->current_generator = $enum;
        $generator->children[$name] = $enum;

        $id = (string)$refsect2['role'];
        
        // Description :
        $description = '';
        $short_description = '';
        $warning_description = '';
        $parse_tags = false;
        $tags = [];
        foreach($refsect2->children() as $child) {
            if ('para'==$child->getName()) {
                if (isset($child['role']) && $parse_tags) {
                    switch ((string)$child['role']) {
                        case 'since':
                            $tags['since'] = (string)$child->link;
                            break;
                    }
                } else {
                    $description .= $child->asXML();
                    if (null==$short_description)
                        $short_description .= $child->asXML();
                }
            }
            if ('refsect3'==$child->getName())
                $parse_tags = true;
            if ('warning'==$child->getName()) 
                $warning_description = $child->asXML();
        }
        $enum->setDescription($description);
        $enum->setShortDescription($short_description);
        if (isset($tags['since']))
            $enum->setTagSince($tags['since']);
        /*
        if (isset($tags['deprecated']))
            $method->setTagDeprecated($tags['deprecated']);
        if (isset($tags['stability']))
            $method->setTagStability($tags['stability']);
        */

        //echo '      '.$id.':'.PHP_EOL;// "struct_members"
        foreach($refsect2->refsect3 as $refsect3) {
            $this->loadEnumConstants($refsect3);
        }

        $this->current_generator = $generator;
        return $enum;
    }

    public function loadUnionMembers(SimpleXMLElement $refsect3) {
        /**
         * @var UnionGenerator
         */
        $union = $this->current_generator;
        $package = $this->current_generator->getOwnPackage();

        $union_members = [];
        if (empty($refsect3)) {

            $name = $this->current_generator->getName();

            $data_union = $this->sourceCode->getUnion($name);
            foreach($data_union['members'] as $member_name=>$member_data) {
                $member_type = $member_data['type'];
                switch ($member_type) {
                    case 'struct':
                        $member = $package->createVar($member_name);

                        $member_type = TypeGenerator::CreateAnonymous();
                        $member_struct = $package->createStruct($member_type->getName());
                        unset($member_data['name']);
                        $member_struct->setOptions($member_data);
                        $member->setType($member_type);
                        $union->children[] = $member_struct;

                        $union_members[$member_name] = $member;
                        break;
                    case 'union':
                        //$struct_member = UnionGenerator::Create($name);
                        break;
                    default:
                        $union_members[$member_name] = VarGenerator::Create($member_data);
                        break;
                }
                //$this->package->createVar();
            }
            $union->setMembers($union_members);
            //print_r($data_union);
            //print_r($data_union);

        } else {

        }
        $this->current_generator = $union;
    }

    protected function loadUnion($refsect2) {
        
        /** @var FileGenerator $generator */
        $generator = $this->current_generator;
        /** @var PackageGenerator $package */
        $package = $generator->getOwnPackage();
        //$package = $generator->getModulePackage();

        //echo get_class($this->current_generator), PHP_EOL;
        //echo '  '.$this->current_generator->getName(), PHP_EOL;
        //echo get_class($this->current_generator->getPackage()), PHP_EOL;
        //echo '  '.$this->current_generator->getPackage()->getName(), PHP_EOL;
        //echo get_class($this->current_generator->getPackage()), PHP_EOL;
        //echo '  '.get_class($this->current_generator->getOwnPackage()), PHP_EOL;
        

        $name = (string)$refsect2->indexterm[0]->primary;
        if ($this->trace) 
        echo "   Union \e[3;35m".$name."\e[0m".PHP_EOL;
        $union = $package->createUnion($name);
        $this->current_generator = $union;
        $generator->children[$name] = $union;//-------------------------------

        $description = '';
        foreach($refsect2->children() as $node) {
            if ('para'==$node->getName())
                $description .= $node->asXML();
            if ('refsect3'==$node->getName())
                break;
        }
        $union->setDescription($description);

        $this->loadUnionMembers($refsect2->refsect3);

        $this->current_generator = $generator;
    }

    protected function loadEnumConstants(SimpleXMLElement $refsect3)
    {
        /** @var EnumGenerator $generator */
        $generator = $this->current_generator;
        /** @var PackageGenerator $package */

        $members = array();
        $member_annotations = [];
        $rows = $refsect3->informaltable->tgroup->tbody->row;
        foreach($rows as $row) {
            $name = '';
            $description = '';
            foreach($row->entry as $entry) {
                $role = (string)$entry['role'];
                switch ($role) {
                    case 'enum_member_name':
                        $name = (string)$entry->para;
                        break;
                    case 'enum_member_description':
                        $description = $entry->children()->asXml();
                        break;
                    case 'enum_member_annotations':
                        //$member_annotations = $this->getAnnotations($entry);
                        {
                        
                        }
                        break;
                    default:
                        //if (!in_array($generator->getName(), array('cairo_svg_unit_t'))) {
                            // Undocumented
                            echo 'Undocumented role "'.$role.'" for enum '. $generator->getName() . PHP_EOL;
                            //echo $entry->asXml(), PHP_EOL;// <entry /><entry />
                            //echo 'ID = ', $refsect3['id'], PHP_EOL;
                        //}
                        break;
                }
            }

            /** @var ConstantGenerator */
            $constant = $this->package->createConstant($name, $generator);
            $constant->setDescription($description);
            if (preg_match('#\(Since\s+(\d+\.\d+)\)#', $description, $matches)) {
                $annotation_since = AnnotationGenerator::Factory('since');
                $annotation_since->setParam($matches[1]);
                $member_annotations = array($annotation_since);
                $constant->setAnnotations($member_annotations);
            }
            $constants[$name] = $constant;
        }
        if (in_array($generator->getName(), array('cairo_svg_unit_t'))) {
            echo 'Documentation of constant enum cairo_svg_unit_t is in description'. PHP_EOL;
        }

        $enum = $this->sourceCode->getEnum($generator->getName());
        if ($enum['constants']) {
            $i = 0;
            foreach($enum['constants'] as $constant) {
                if (isset($constant['value'])) {
                    $i = intval($constant['value']);
                    $constants[$constant['name']]->setValue($i);
                } else {
                    $constants[$constant['name']]->setValue($i);
                }
                $i++;
            }
        } else {
            $enum = $this->sourceCode->getProto($generator->getName());
            //print_r($this->sourceCode->data['TYPEDEF']);
            //print_r($this->sourceCode);
            //print_r($enum);
            echo '    Enum "'.$generator->getName().'"not found in sourceCode'.PHP_EOL;
        }

        $generator->setConstants($constants);
    }

    protected function loadTypedef($refsect2) {
        $generator = $this->current_generator;
        $package = $generator->getOwnPackage();
        
        $name = (string)$refsect2->indexterm[0]->primary;

        /*
        $typdef = $package->createType($name);
        */
        $annotations = array();
        $tags = array();
        $description = $this->loadDescription($refsect2, $tags);

        /*
        $typdef->setDescription($description);
        foreach ($tags as $tag=>$value) {
            $annotation = AnnotationGenerator::Factory($tag);
            $annotation->setParam($value);
            $annotations[] = $annotation;
        }
        $typdef->setAnnotations($annotations);
        */


    }

    protected function loadMacro($refsect2, $kind) {
        
        /** @var FileGenerator $generator */
        $generator = $this->current_generator;
        /** @var PackageGenerator $package */
        $package = $generator->getOwnPackage();
        //$package = $generator->getModulePackage();

        //echo get_class($this->current_generator), PHP_EOL;
        //echo '  '.$this->current_generator->getName(), PHP_EOL;
        //echo get_class($this->current_generator->getPackage()), PHP_EOL;
        //echo '  '.$this->current_generator->getPackage()->getName(), PHP_EOL;
        //echo get_class($this->current_generator->getPackage()), PHP_EOL;
        //echo '  '.get_class($this->current_generator->getOwnPackage()), PHP_EOL;
        

        $name = (string)$refsect2->indexterm[0]->primary;
        if ($this->trace) 
        echo "   Macro \e[3;35m".$name."\e[0m $kind".PHP_EOL;
        switch ($kind) {
            case 'function':
                $macro = $package->createMethod($name);// TODO: createFunction
                break;
            case 'constant':
                $macro = $package->createConstant($name, $generator);// FileGenerator; $generator->getPackage()
            break;
        }
        $this->current_generator = $macro;
        $generator->children[$name] = $macro;

        $annotations = array();
        $tags = array();
        $description = $this->loadDescription($refsect2, $tags);
        $macro->setDescription($description);
        foreach ($tags as $tag=>$value) {
            $annotation = AnnotationGenerator::Factory($tag);
            $annotation->setParam($value);
            $annotations[] = $annotation;
        }
        $macro->setAnnotations($annotations);

        $this->current_generator = $generator;
    }

    protected function loadDescription($refsect2, &$tags) {
        $description = '';
        $short_description = '';
        $warning_description = '';

        foreach($refsect2->children() as $child) {
            if ('para'==$child->getName()) {
                if (isset($child['role'])) {
                    switch ((string)$child['role']) {
                        case 'since':
                            $tags['since'] = (string)$child->link;
                            break;
                    }
                } else {
                    $description .= $child->asXML();
                    if (null==$short_description)
                        $short_description .= $child->asXML();
                }
            }
            //if ('refsect3'==$child->getName())
            //    $parse_tags = true;
            if ('warning'==$child->getName()) 
                $warning_description = $child->asXML();
        }
        return $description;
    }

}
