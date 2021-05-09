<?php

namespace Zend\Ext\Services\DocBook;


namespace Zend\Ext\Services\DocBook;

use SimpleXMLElement;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\TypeGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\StructGenerator;
use Zend\Ext\Models\EnumGenerator;
use Zend\Ext\Models\UnionGenerator;
use Zend\Ext\Models\VarGenerator;
use Zend\Ext\Models\ConstantGenerator;

use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\PropertyGenerator;
use Zend\Ext\Models\TagGenerator;

use Zend\Ext\Services\DocBook;


class Gtk extends DocBook
{
    public $blacklist = array();
    public $remap = array();
    
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

    public function __construct(string $filename, string $tmp_dir) {
        $this->filename = $filename;
        $this->tmp_dir = realpath($tmp_dir);
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
            return $this->package;
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
                        case 'xi:include':
                            $href = $child->getAttribute('href');
                            if ('gtk'==$group_id) {
                                $filepath = $this->tmp_dir.DIRECTORY_SEPARATOR
                                . $group_id.'-build-doc'.DIRECTORY_SEPARATOR
                                . $href;
                            } else {
                                $filepath = $this->tmp_dir.DIRECTORY_SEPARATOR
                                . $group_id.DIRECTORY_SEPARATOR
                                . $href;
                            }
                            ///echo $filepath, PHP_EOL;
                            $files[] = $filepath;
                            break;
                    }
                }
                $package = $this->package->createPackage($group_id);
                $package->doc_files = $files;
                $package->setDescription($group_title);
                $this->setWhitelist($whitelist);
                $this->current_generator = $package;
                $this->loadPackage($package);
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

        //$group_package = $this->current_generator->createPackage($id);
        $group_package = $this->current_generator;

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
        $current_generator = $this->current_generator;

        $id = $this->current_generator->getName();// cairo-drawing

        $file = file_get_contents($filename);
        $temp = str_replace(array('&#160;', '&nbsp;', '&ast;'), '', $file);
        $xml = simplexml_load_string($temp) or die("xml not loading: '$filename'");

        $id_ref = (string)$xml['id'];

        if($this->isAllowed($id, $id_ref)) {

            echo 'Process::', $filename, PHP_EOL;
            $class = null;
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
            $class->addMethods($methods);
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

    protected function getFunctionsDetails(SimpleXMLElement $xml){
        $generator = $this->current_generator;
        $package = $generator->getPackage();
        $methods = [];

        $id = (string)$xml['id'];
        $nodes = $xml->xpath("refsect1[@id='$id.functions_details']/refsect2");
        foreach($nodes as $node) {
            $function_id = $node['id'];
            $function_name = (string)$node->indexterm[0]->primary;

            $signature = $this->sourceCode['Glib']->getFunction($function_name);
            if (empty($signature)) {
                $signature = $this->sourceCode['Glib']->getProto($function_name);
                if (!empty($signature)) {
                    echo 'continue: '.$function_id . ', ' . $function_name. PHP_EOL;
                    continue;
                }
                $signature = $this->sourceCode['Glib']->getMacro($function_name);
                if (!empty($signature)) {
                    echo 'continue: '.$function_id . ', ' . $function_name. PHP_EOL;
                    continue;
                }
    
            }

            
            $method = $package->createMethod($function_name);
            $method->setOwnPackage($generator->getOwnPackage());
            $parameters = [];
            
            // programlisting :
            

            // Description :
            $description = '';
            $short_description = '';
            foreach($node->children() as $child) {
                if ('para'==$child->getName()) {
                    $description .= $child->asXML();
                    if (null==$short_description)
                        $short_description .= $child->asXML();
                }
                if ('refsect3'==$child->getName())
                    break;
            }
            $method->setDescription($description);
            $method->setShortDescription($short_description);


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
                                $parameter_description = (string)$entry->asXml();
                                break;
                            case 'parameter_annotations':
                                $parameter_annotations = [];
                                break;
                        }
                    }

                    $parameter = $package->createParameter($parameter_name);
                    $parameter->setDescription($parameter_description);

                    $param_type = $package->createType($signature['signature']['parameters'][$parameter_name]['type']);
                    $parameter->setType($param_type);

                    $parameters[] = $parameter;
                }
            }
            $method->setParameters($parameters);
            
            // Returns :
            $parameter_return = $package->createParameter('Returns');
            $node_parameters = $node->xpath("refsect3[@id='$function_id.returns']");
            $description = '';
            foreach($node_parameters as $node_parameter) {
                foreach($node->children() as $node) {
                    if ('para'==$node->getName()) {
                        $description .= $node->asXML();
                    }
                }
            }

            $parameter_return->setDescription($description);
            $return_type = $package->createType($signature['signature']['return']['type']);
            $parameter_return->setType($return_type);

            $method->setParameterReturn($parameter_return);

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
        $package = $this->current_generator;

        $id = (string)$xml['id'];
        //cairo-Paths.other_details
        $refpurpose = (string)$xml->refnamediv[0]->refpurpose;

        // informaltable/tgroup/tbody/row
        $nodes = $xml->xpath("refsect1[@id='$id.other_details']/refsect2");
        
        $map = null;
        $package_name = $package->getName();
        if (isset($this->whitelist[$package_name])) {
            if (isset($this->whitelist[$package_name][$id])) {
                $map = $this->whitelist[$package_name][$id];
            }
        }
       

        $is_class = false;
        $struct_names = [];
        $class_name = null;
        foreach($nodes as $node) {
            $role = (string)$node['role'];
            switch($role) {
                case 'struct':
                    $struct_name = (string)$node->indexterm[0]->primary;
                    $struct_names[$struct_name] = $struct_name;
                    if ('Class'==substr($struct_name, -5)) {
                        $class_name = substr($struct_name, 0, -5);
                        $is_class = true;
                    }
                    $this->loadStruct($node);
                    break;
                case 'enum':
                    $struct_name = (string)$node->indexterm[0]->primary;
                    $struct_names[$struct_name] = $struct_name;
                    $this->loadEnum($node);
                    break;
                case 'union':
                    $struct_name = (string)$node->indexterm[0]->primary;
                    $struct_names[$struct_name] = $struct_name;
                    $this->loadUnion($node);
                    break;
                case 'typedef':
                default:
                    echo 'Unimplemented <refsect2 role="'.$role.'">'.PHP_EOL;
                    break;
            }
        }
        if ($is_class) {
            $classGenerator = $package->createClass($class_name);
            $classGenerator->setDescription($refpurpose);
            $instance = $package->getStruct($class_name);
            $vtable = $package->getStruct($class_name.'Class');
            $classGenerator->setInstance($instance);
            $classGenerator->setVTable($vtable);

            foreach($struct_names as $struct_name) {
                if (!in_array($struct_name, array($class_name, $class_name.'Class'))) {
                    $classGenerator->addRelatedObject($package->children[$struct_name]);
                }
                unset($package->children[$struct_name]);
            }
            // foreach enum, union

            $package->children[$class_name] = $classGenerator;
        } else {
            // check if file correspond to struct name
            // how to get the master object ?
            if (empty($map)) {
                $map = str_replace('-', '_', $id);
                $map = strtolower($map);
            }
            if (isset($this->remap[$map])) {
                $map = $this->remap[$map];
            }
            
            $classGenerator = $package->createClass($map);
            $classGenerator->setDescription($refpurpose);
            $classGenerator->setShortDescription($refpurpose);
            $instance = $package->getStruct($map);
            if (isset($instance)) {
                $classGenerator->setInstance($instance);
            } else {
                echo 'Unexpected Struct('.$map.')::instance null'.PHP_EOL;
            }

            foreach($struct_names as $struct_name) {
                if (!in_array($struct_name, array($map, $map.'Class'))) {
                    $classGenerator->addRelatedObject($package->children[$struct_name]);
                }
                unset($package->children[$struct_name]);
            }
            $package->children[$map] = $classGenerator;
        }

        $this->current_generator = $package;
        return $classGenerator;
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
        $generator = $this->current_generator;

        $name = (string)$refsect2->indexterm[0]->primary;
        $struct = $generator->createStruct($name);
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
                        $annotations = (string)$entry;
                        if (!empty($annotations)) {
                            //$property = $this->loadStructMemberAnnoations($row, $class);
                            //$properies[] = $property;
                            echo 'Unimplemented annotation'.PHP_EOL;
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
                $className = $this->current_generator->getName();
                $struct = $this->sourceCode['Glib']->getStruct($className);
                $member_type = TypeGenerator::CreateAnonymous();
                $member_type->setPackage($this->package);
                $member_type->setIsPrototype(true);
                $member_type->setPrototype($struct['members'][$name]);
                
                $var->setType($member_type);
            }
            $var->setShortDescription($description);
            $var->setDescription($description);
            $members[$name] = $var;
        }
        $this->current_generator->setMembers($members);

        /*
        $struct = $this->sourceCode['Glib']->getStruct($className);
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
        $generator = $this->current_generator;

        $name = (string)$refsect2->indexterm[0]->primary;
        $enum = $generator->createEnum($name);
        $this->current_generator = $enum;
        $generator->children[$name] = $enum;

        $id = (string)$refsect2['role'];
        $description = '';
        foreach($refsect2->children() as $node) {
            if ('para'==$node->nodeName)
                $description .= $node->asXML();
            if ('refsect3'==$node->nodeName)
                break;
        }
        $enum->setDescription($description);

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

            $data_union = $this->sourceCode['Glib']->getUnion($name);
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
        $generator = $this->current_generator;
        //echo get_class($this->current_generator), PHP_EOL;
        //echo '  '.$this->current_generator->getName(), PHP_EOL;
        //echo get_class($this->current_generator->getPackage()), PHP_EOL;
        //echo '  '.$this->current_generator->getPackage()->getName(), PHP_EOL;
        //echo get_class($this->current_generator->getPackage()), PHP_EOL;
        //echo '  '.get_class($this->current_generator->getOwnPackage()), PHP_EOL;
        

        $name = (string)$refsect2->indexterm[0]->primary;
        $union = $generator->createUnion($name);
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
        $members = array();
        $rows = $refsect3->informaltable->tgroup->tbody->row;
        foreach($rows as $row) {
            $name = '';
            $description = '';
            $annotations = [];
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
                        $annotations = (string)$entry;
                        if (!empty($annotations)) {
                            //$property = $this->loadEnumConstantAnnoations($row, $class);
                            echo 'Unimplemented enum annotation'.PHP_EOL;
                        }
                        break;
                    default:
                        if (!in_array($this->current_generator->getName(), array('cairo_svg_unit_t'))) {
                            echo 'Unexpected role "'.$role.'" for enum '. $this->current_generator->getName() . PHP_EOL;
                        }
                        break;
                }
            }

            $constant = $this->package->createConstant($name, $this->current_generator);
            $constant->setDescription($description);
            $constants[$name] = $constant;
        }
        if (in_array($this->current_generator->getName(), array('cairo_svg_unit_t'))) {
            echo 'Documentation of constant enum cairo_svg_unit_t is in description'. PHP_EOL;
        }

        $enum = $this->sourceCode['Glib']->getEnum($this->current_generator->getName());
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
            //$enum = $this->sourceCode['Glib']->getProto($this->current_generator->getName());
            //var_dump($enum);
            echo '    Enum "'.$this->current_generator->getName().'"not found in sourceCode'.PHP_EOL;
        }

        $this->current_generator->setConstants($constants);
    }
    
}
