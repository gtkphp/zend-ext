<?php

namespace Zend\Ext\Services\DocBook;

use Exception;

use Zend\Ext\Services\SourceCode;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\SetDocBook;
use Zend\Ext\Models\DocBook\SetInfoDocBook;
use Zend\Ext\Models\DocBook\BookDocBook;
use Zend\Ext\Models\DocBook\BookInfoDocBook;
use Zend\Ext\Models\DocBook\PartDocBook;
use Zend\Ext\Models\DocBook\PartInfoDocBook;
use Zend\Ext\Models\DocBook\PartintroDocBook;
use Zend\Ext\Models\DocBook\ChapterDocBook;
use Zend\Ext\Models\DocBook\ReferenceDocBook;
use Zend\Ext\Models\DocBook\RefEntryDocBook;
use Zend\Ext\Models\DocBook\FunctionDocBook;
use Zend\Ext\Models\DocBook\ParameterDocBook;
use Zend\Ext\Models\DocBook\TypeDocBook;
use Zend\Ext\Models\DocBook\AnnotationDocBook;
use Zend\Ext\Models\DocBook\StructDocBook;
use Zend\Ext\Models\DocBook\EnumDocBook;
use Zend\Ext\Models\DocBook\ConstantDocBook;
use Zend\Ext\Models\DocBook\VarDocBook;
use Zend\Ext\Models\DocBook\UnionDocBook;
use Zend\Ext\Models\DocBook\TypedefDocBook;
use Zend\Ext\Models\DocBook\MacroDocBook;


/*
use Zend\Ext\Models\DocBook\Indexterm;
use Zend\Ext\Models\DocBook\Primary;
use Zend\Ext\Models\DocBook\ReleaseInfo;
use Zend\Ext\Models\DocBook\Domain;
*/

use DomDocument;
use DOMElement;
use DOMXpath;
use DOMNode;
use Zend\Ext\Models\Code\Generator\TypeGenerator;

class Gnome
{
    /**
     * @var int $trace 0 disable, 1 trace struct|enum, 2 trace function|macro
     */
    protected $trace = 0;

    /** @var DOMDocument $doc */
    protected $doc;

    /**
     * @var SourceCode
     */
    protected $sourceCode = null;

    public function setSourceCode(SourceCode $service)
    {
        $this->sourceCode = $service;
    }

    public function getSourceCode($name=null):SourceCode
    {
        return $this->sourceCode;
    }

    public function setTrace(int $level) : self
    {
        $this->trace = $level;
        return $this;
    }

    public function __construct()
    {
        
    }

    /**
     * @param string|DomDocument $filename
     * @return AbstractDocBook
     */
    public function load($filename, AbstractDocBook $parent=null):AbstractDocBook
    {
        if ($filename instanceof DOMDocument) {
            $doc = $filename;
        } else {
            $doc = new DomDocument();
            $doc->load($filename, LIBXML_NOENT);
        }
        //$id = $this->doc->documentElement->getAttribute('id');//id="cairo"

        $model = null;

        $node = $doc->documentElement;
        switch ($node->nodeName) {
            case 'set':
                $model = $this->parseSet($node, $parent);
                break;
            case 'book':
                $model = $this->parseBook($node, $parent);
                break;
            case 'part':
                $model = $this->parsePart($node, $parent);
                break;
            case 'chapter':
                $model = $this->parseChapter($node, $parent);
                break;
            case 'refentry':
                $model = $this->parseRefEntry($node, $parent);
                break;
            case 'para':
            case 'screen':
            case 'partintro':
                $model = new PartintroDocBook();
                break;
            default:
                $file = $filename instanceof DomDocument ? $filename->documentURI : $filename;
                throw new Exception('Unexpected DOMElement "'.$node->nodeName.'" for "'.$file.'"');
                break;
        }

        return $model;
    }

    public function parseSet(\DOMElement $element, AbstractDocBook $parent=null) : SetDocBook
    {
        $set = new SetDocBook($parent);
        //$set->ref = $element->getAttribute('lang');
        $set->id = $element->getAttribute('id');
        //$set->ref = $element->getAttribute('remap');
        //$set->constraint = $this->parseConstraint($element, $parent);

        //$this->indexterm->addTerm($set);


        $xpath = new DOMXpath($element->ownerDocument);
        $xpath->registerNamespace('xi', "http://www.w3.org/2003/XInclude");
        
        $setTitles = $xpath->query('title', $element);
        if (count($setTitles)) {
            $set->title = $setTitles[0]->nodeValue;
        }
        
        $setInfos = $xpath->query("setinfo", $element);
        if (count($setInfos)) {
            $set->setinfo = $this->parseSetInfo($setInfos[0], $set);
        }

        /*
        $chapters = $xpath->query("chapter", $element);
        foreach ($chapters as $child) {
            $set->chapters[] = $this->loadChapter($child, $set);
            //$set->addChapter($this->loadChapter($child, $set));
        }*/

        $books = $xpath->query("book", $element);
        foreach ($books as $child) {
            //$set->books[] = $this->loadBook($child, $set);
            $set->addBook($this->parseBook($child, $set));
        }

        $sets = $xpath->query("set", $element);
        foreach ($sets as $child) {
            $set->addSet($this->parseSet($child, $set));
        }


        $setIncludes = $xpath->query('xi:include', $element);
        foreach ($setIncludes as $child) {
            if ($child->hasAttribute('href')) {
                $docBook = $this->loadInclude($child, $set);
                if ($docBook instanceof BookDocBook) {
                    $set->addBook($docBook);
                }
            }
        }

        return $set;
    }

    public function loadInclude(DOMElement $element, $parent)
    {
        
        $filename = realpath(dirname($element->ownerDocument->baseURI).'/'.$element->getAttribute('href'));
        $dom = new DOMDocument();
        $dom->load($filename, LIBXML_NOENT);

        $docBook = $this->load($dom, $parent);

        return $docBook;
    }



    public function parseSetInfo(DOMElement $element, $parent)
    {
        $info = new SetInfoDocBook($parent);

        $xpath = new DOMXpath($element->ownerDocument);
        
        $setTitles = $xpath->query('title', $element);
        if (count($setTitles)) {
            $info->title = $setTitles[0]->nodeValue;
        }

        return $info;
    }
    public function parseBook(DOMElement $element, $parent)
    {
        $book = new BookDocBook($parent);
        $book->id = $element->getAttribute('id');

        $xpath = new DOMXpath($element->ownerDocument);
        
        $setTitles = $xpath->query('title', $element);
        if (count($setTitles)) {
            $book->title = $setTitles[0]->nodeValue;
        }

        $bookinfos = $xpath->query('bookinfo', $element);
        if (count($bookinfos)) {
            $book->bookInfo = $this->parseBookInfo($bookinfos[0], $book);
        }
        
        $parts = $xpath->query("part", $element);
        foreach ($parts as $child) {
            $book->addPart($this->parsePart($child, $book));
        }

        $chapters = $xpath->query("chapter", $element);
        foreach ($chapters as $chapter) {
            $book->addChapter($this->parseChapter($chapter, $book));
        }

        $parts = $xpath->query("reference", $element);
        foreach ($parts as $child) {
            $book->addReference($this->parseReference($child, $book));
        }
        
        //$articles = $xpath->query("article", $element);


        return $book;
    }
    public function parseBookInfo(DOMElement $element, $parent)
    {
        $bookInfo = new BookInfoDocBook($parent);

        $xpath = new DOMXpath($element->ownerDocument);
        
        $setTitles = $xpath->query('title', $element);
        if (count($setTitles)) {
            $bookInfo->title = $setTitles[0]->nodeValue;
        }

        return $bookInfo;
    }


    public function parseReference(DOMElement $element, $parent) : ReferenceDocBook
    {
        $reference = new ReferenceDocBook($parent);
        
        $xpath = new DOMXpath($element->ownerDocument);
        $xpath->registerNamespace('xi', "http://www.w3.org/2003/XInclude");//+

        $setTitles = $xpath->query('title', $element);
        if (count($setTitles)) {
            $reference->title = $setTitles[0]->nodeValue;
        }

        $setIncludes = $xpath->query('xi:include', $element);
        foreach ($setIncludes as $child) {
            if ($child->hasAttribute('href')) {
                $docBook = $this->loadInclude($child, $reference);
                if ($docBook instanceof RefEntryDocBook) {
                    $reference->addRefEntry($docBook);
                }
            }
        }

        return $reference;
    }

    public function parsePart(DOMElement $element, $parent)
    {
        $part = new PartDocBook($parent);

        $xpath = new DOMXpath($element->ownerDocument);
        $xpath->registerNamespace('xi', "http://www.w3.org/2003/XInclude");//+

        $setTitles = $xpath->query('title', $element);
        if (count($setTitles)) {
            $part->title = $setTitles[0]->nodeValue;
        }
        
        $partInfos = $xpath->query("partinfo", $element);
        if (count($partInfos)) {
            $part->partInfo = $this->parsePartInfo($partInfos[0], $part);
        }
        
        $chapters = $xpath->query("chapter", $element);
        foreach ($chapters as $child) {
            $part->addChapter($this->parseChapter($child, $part));
        }
        if (count($chapters)) {
            $part->partInfo = $this->parsePartInfo($chapters[0], $part);
        }
        
        $setIncludes = $xpath->query('xi:include', $element);
        foreach ($setIncludes as $child) {
            if ($child->hasAttribute('href')) {
                $docBook = $this->loadInclude($child, $part);
                if ($docBook instanceof RefEntryDocBook) {
                    $part->addRefEntry($docBook);
                }
                if ($docBook instanceof ChapterDocBook) {
                    $part->addChapter($docBook);
                }

            }
        }

        return $part;
    }

    public function parsePartInfo(DOMElement $node, $parent)
    {
        $partInfo = new PartInfoDocBook($parent);
        return $partInfo;
    }

    public function parseChapter(DOMElement $element, $parent)
    {
        $chapter = new ChapterDocBook($parent);

        $xpath = new DOMXpath($element->ownerDocument);
        $xpath->registerNamespace('xi', "http://www.w3.org/2003/XInclude");//+

        $setTitles = $xpath->query('title', $element);
        if (count($setTitles)) {
            $chapter->title = $setTitles[0]->nodeValue;
        }

        $setIncludes = $xpath->query('xi:include', $element);
        foreach ($setIncludes as $child) {
            if ($child->hasAttribute('href')) {
                $docBook = $this->loadInclude($child, $chapter);
                if ($docBook instanceof RefEntryDocBook) {
                    $chapter->addRefEntry($docBook);
                }
            }
        }

        return $chapter;
    }

    public function parseRefEntry(DOMElement $element, $parent) : RefEntryDocBook
    {
        $refEntry = new RefEntryDocBook($parent);
        $refEntry->id = $element->getAttribute('id');

        $xpath = new DOMXpath($element->ownerDocument);

        $refsect1s = $xpath->query('refsect1', $element);

        foreach($refsect1s as $refsect1) {
            $refsect1_id = $refsect1->getAttribute('id');//"GtkWidget.functions"
            $refsect1_name = substr($refsect1_id, strlen($refEntry->id)+1);
            $name = $refsect1_name;//str_replace('_', '-', $refsect1_name);
            switch($name) {
                case 'functions':
                    //$array = $this->parseRefSect1_functions($refsect1, $refEntry);//getFunctions
                    break;
                case 'properties':
                    break;
                case 'style-properties':
                    break;
                case 'signals':
                    //$this->parseRefSect1_signals($refsect1, $refEntry);
                    break;
                case 'other':
                    //$this->parseRefSect1_other($refsect1, $refEntry);
                    break;
                case 'object-hierarchy':
                    //$this->parseRefSect1_object_hierarchy($refsect1, $refEntry);
                    break;
                case 'derived-interfaces':
                    break;
                case 'implemented-interfaces':
                    break;
                case 'includes':
                    //$this->parseRefSect1_includes($refsect1, $refEntry);
                    break;
                case 'description':
                    //$this->parseRefSect1_description($refsect1, $refEntry);
                    break;
                case 'functions_details':
                    $this->parseRefSect1_functions_details($refsect1, $refEntry);
                    break;
                case 'property-details':
                    break;
                case 'style-property-details':
                    break;
                case 'signal-details':
                    break;
                case 'other_details':
                    $this->parseRefSect1_other_details($refsect1, $refEntry);
                    break;
                case 'see-also':
                    break;
                default:
                    echo 'Unimplemented <refsect1 id="'.$refEntry->id.'.'.$refsect1_name.'">'.PHP_EOL;
                    break;
            }
        }

        return $refEntry;
    }
    public function parseRefSect1_functions(DOMElement $element, $parent)
    {
        //$function = new FunctionGenerator($parent);

        $id = $element->getAttribute('id');
        
        $xpath = new DOMXpath($element->ownerDocument);
        $array = [];

        // "refsect1[@id='$id.functions']/informaltable/tgroup/tbody/row/entry[@role='function_name']/link"
        $nodes = $xpath->query("informaltable/tgroup/tbody/row/entry[@role='function_name']/link", $element);
        foreach($nodes as $node) {
            $linkend = (string) $node->getAttribute('linkend');
            $function = (string) $node->nodeValue;
            $array[$function] = $linkend;
        }

        return $array;
    }
   
    public function parseRefSect1_signals(DOMElement $element, $parent)
    {
    }
    public function parseRefSect1_other(DOMElement $element, $parent)
    {
    }
    public function parseRefSect1_object_hierarchy(DOMElement $element, $parent)
    {
    }
    public function parseRefSect1_includes(DOMElement $element, $parent)
    {
    }
    public function parseRefSect1_description(DOMElement $element, $parent)
    {
    }

    //$class = $this->getOtherDetails($xml);
    public function parseRefSect1_other_details(DOMElement $element, $parent)
    {
        $id = $element->getAttribute('id');

        $xpath = new DOMXpath($element->ownerDocument);
        $nodes = $xpath->query("refsect2", $element);

        foreach($nodes as $node) {
            $role = $node->getAttribute('role');
            switch($role) {
                case 'macro':
                    $this->parseMacro($node, $parent);
                    break;
                case 'union':
                    $this->parseUnion($node, $parent);
                    break;
                case 'enum':
                    $this->parseEnum($node, $parent);// Done
                    break;
                case 'typedef':
                    $this->parseTypedef($node, $parent);
                    break;
                case 'struct':
                    $this->parseStruct($node, $parent);// Done
                    break;
                default:
                    echo "Unexpected '$role' for $id.other-details", PHP_EOL;
                break;
            }
        }
    }

    public function parseRefSect1_signal_details(DOMElement $element, $parent)
    {
    }
    public function parseRefSect1_functions_details(DOMElement $element, $parent)
    {
        $id = $element->getAttribute('id');
        
        $xpath = new DOMXpath($element->ownerDocument);

        // "refsect1[@id='$id.functions_details']/refsect2"
        $nodes = $xpath->query("refsect2", $element);
        foreach($nodes as $node) {

            $function_id = $node->getAttribute('id');
            $function_role = $node->getAttribute('role');
            $primaries = $xpath->query("indexterm/primary", $node);
            if ($primaries->count()) {
                $function_name = $primaries[0]->nodeValue;
            }

            $signature = $this->sourceCode->getFunction($function_name);
            $function_kind = 'function';// in_array('function', 'prototype', 'macro');
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
             * @var FunctionDockBook|PrototypeDockBook|MethodDockBook
             */
            $method = null;
            switch ($function_kind) {
                case 'function':
                    $method = new FunctionDocBook($parent);
                    $method->name = $function_name;
                    break;
                case 'prototype':
                    $method = new FunctionDocBook($parent);
                    $method->name = $function_name;
                    $method->setIsCallback();
                    break;
                case 'macro':
                    $method = new FunctionDocBook($parent);
                    $method->name = $function_name;
                    $method->setIsMacro();
                    break;
                default  :
                    echo "Unexpected kind of function\n";
            }

            if ('macro'==$function_role) {
                //if ($this->trace) 
                echo "   Macro \e[3;35m".$function_name."\e[0m ()".PHP_EOL;
            }

            // Parameters :

            if ($signature) {
                foreach($signature['signature']['parameters'] as $param) {
                    if ($param['type']=='...') {
                        $parameter = new ParameterDocBook($method);
                        $parameter->setName($param['type']);
                        $method->addParameter($parameter);
                        continue;
                    }
                    if (empty($param['name']) && $param['type']=='void') {
                        // my_function(void);
                        continue;
                    }

                    $parameter = new ParameterDocBook($method);
                    if (empty($param['name'])) {
                        //echo "Error : no parameter name for '$function_name' ".$param['type']."\n";
                    } else {
                        $parameter->setName($param['name']);
                    }

                    $type = $this->parseType($param, $parameter);
                    $parameter->setType($type);

                    if (isset($param['pass'])) {
                        $parameter->setPass($param['pass']);
                    }
                    // modfier ?
                    $method->addParameter($parameter);
                }
            }

            // Returns :
            if ($signature && isset($signature['signature']['return'])) {
                $param = $signature['signature']['return'];
                $parameter = new ParameterDocBook($method);
                $type = $this->parseType($param, $parameter);
                $parameter->setType($type);
                if (isset($param['pass'])) {
                    $parameter->setPass($param['pass']);
                }
                $method->setParameterReturn($parameter);
            }

            // Descriptions :
            $this->parseFunctionDescription($node, $method);
            $this->parseParametersDescription($node, $method);

            /** @var RefEntryDocBook $refentry */
            $refentry = $parent;
            $refentry->addFunction($method);
        }
    }

    // ------------------------
    // Subroutine
    // ------------------------
    public function parseMacro(DOMElement $element, $parent)
    {
        $macro = new MacroDocBook($parent);

        $xpath = new DOMXpath($element->ownerDocument);
        $nodes = $xpath->query('indexterm/primary', $element);
        if ($nodes->count()) {
            $macro->name = $nodes[0]->nodeValue;
        }
        //echo 'Macro ', $macro->name, PHP_EOL;

        /** @var RefEntryDocBook $refentry */
        $refentry = $parent;
        $refentry->addMacro($macro);
    }

    public function buildStruct($definition, $name, $parent)
    {
        $struct = new StructDocBook($parent);
        $struct->name = $name;

        foreach($definition['members'] as $name=>$member) {
            $field = new VarDocBook($struct);
            $field->name = $name;
            $type = $this->parseType($member, $field);
            $field->setType($type);
            if (isset($member['pass'])) {
                $field->setPass($member['pass']);
            }
            // modfier ?

            $struct->addField($field);

        }

        return $struct;
    }

    public function parseUnion(DOMElement $element, $parent)
    {
        $union = new UnionDocBook($parent);

        $xpath = new DOMXpath($element->ownerDocument);
        $nodes = $xpath->query('indexterm/primary', $element);
        if ($nodes->count()) {
            $union->name = $nodes[0]->nodeValue;
        }

        $definition = $this->sourceCode->getUnion($union->name);
        
        if ($definition) {
            foreach($definition['members'] as $name=>$member) {
                $field = new VarDocBook($union);
                $field->name = $name;
                if ('struct'==$member['type']) {
                    $union_name = \Zend\Ext\Services\Classifier\Cairo::Suffix($union->name, '_t');
                    if ($union_name==$union->name) {
                        $field_type_name = $union->name . ucfirst($name);
                    } else {
                        $field_type_name = $union_name . '_' . $name . '_t';
                    }
                    //$typeField->name: cairo_path_data_header_t | cairo_path_data_point_t 
                    $typeField = $this->buildStruct($member, $field_type_name, $union);
                    $type = new TypeDocBook();
                    $type->setName($typeField->name);
                    $type->isAnonymous(true);
                    $type->anony_definition = $typeField;
                    $type->php_type = $typeField->name;
                    $field->setType($type);
                } else {
                    $type = new TypeDocBook();
                    $type->setName($member['type']);
                    $field->setType($type);
                } // else field is typed with a name of object
                // who union of union ? union of enum ? union of typedef ?

                //$field->setType() = $member['name'];
                $union->addField($field);
            }
        }

        $this->parseStructOrEnumOrUnionDescription($element, $union);

        $parent->addUnion($union);
    }
    public function parseEnum(DOMElement $element, $parent)
    {
        $xpath = new DOMXpath($element->ownerDocument);
        
        $enum = new EnumDocBook($parent);
        
        $nodes = $xpath->query('indexterm/primary', $element);
        if ($nodes->count()) {
            $enum->name = $nodes[0]->nodeValue;
        }


        $definition = $this->sourceCode->getEnum($enum->name);

        if ($definition) {
            foreach($definition['constants'] as $name=>$constant) {
                $const = new ConstantDocBook($enum);
                $const->name = $constant['name'];
                $const->value = $constant['value'];
                $const->value_type = gettype($constant['value']);
                $const->expression = $constant['expression'];
                $enum->addConstant($const);
            }
        }

        $this->parseStructOrEnumOrUnionDescription($element, $enum);
        $this->parseEnumMembersDescription($element, $enum);

        /** @var RefEntryDocBook $refentry */
        $refentry = $parent;
        $refentry->addEnum($enum);
    }
    /**
     * @var DOMElement $element
     * @var AbstractDocBook $parent
     */
    public function parseTypedef(DOMElement $element, $parent)
    {
        $typedef = new TypedefDocBook($parent);

        $xpath = new DOMXpath($element->ownerDocument);
        $nodes = $xpath->query('indexterm/primary', $element);
        if ($nodes->count()) {
            $typedef->name = $nodes[0]->nodeValue;
        }

        $this->parseStructOrEnumOrUnionDescription($element, $typedef);

        /** @var RefEntryDocBook $refentry */
        $refentry = $parent;
        $refentry->addTypedef($typedef);
    }

    // Remove this function ! and do the job in Extension::loadTypeGenerator()
    public function parseTypePhp(string $name, TypeDocBook $type)
    {
        if ($this->sourceCode->hasTypedef($name)) {
            $data = $this->sourceCode->getTypedef($name);
            if ('struct'==$data['type']) {
                $type->php_type = 'object';
            } else if ('enum'==$data['type']) {
                $type->php_type = 'enum';
            } else if ('union'==$data['type']) {
                $type->php_type = 'union';
            } else {
                $this->parseTypePhp($data['type'], $type);
            }
        } else if ($this->sourceCode->hasProto($name)) {
            $data = $this->sourceCode->getProto($name);
            $type->php_type = 'callable';
        } else if ('function'==$name) {
            $type->php_type = 'callable';
        } else if ('union'==$name) {
            $type->php_type = 'mixed';
        } else if ('struct'==$name) {
            $type->php_type = 'object';
        } else if ('array'==$name) {
            $type->php_type = 'array';
        } else {
            //VOID | CHAR| SHORT| INT| LONG| FLOAT| DOUBLE| SIGNED| UNSIGNED| struct_or_union_specifier| enum_specifier| TYPE_NAME;
            
            if ('void'==$name || ''==$name) {
                //throw new \Exception("Unexpected type '$name'");
                $type->php_type = 'void';
                //$type->php_type = 'mixed';// void*
            } else if (0===strpos($name, 'struct ')) {
                //throw new \Exception("Unexpected type '$name'");
                $type->php_type = 'object';
            } else if (0===strpos($name, 'union ')) {
                throw new \Exception("Unexpected type '$name'");
                //$type->php_type = 'object';use intersecr ?
            } else if (0===strpos($name, 'enum ')) {
                //throw new \Exception("Unexpected type '$name'");
                $type->php_type = 'enum';
            } else if ('__gnuc_va_list'==$name) { 
                $type->php_type = 'mixed';
                $type->php_type = null;
                $type->php_type = $name;
                //$type->setVariable(true);
            } else {
                $keywords = preg_split("/\s+/", $name);
                if (in_array('char', $keywords)) {
                    $type->php_type = 'string';
                } else if (in_array('float', $keywords)
                        || in_array('double', $keywords) ) {
                    $type->php_type = 'float';
                } else if (in_array('short', $keywords)
                        || in_array('int', $keywords)
                        || in_array('long', $keywords)
                        || in_array('signed', $keywords)
                        || in_array('unsigned', $keywords)
                ) {
                    $type->php_type = 'int';
                } else {
                    throw new \Exception("Unexpected type '$name'");
                }
            }

        }
        
    }

    public function parseType(array $param, AbstractDocBook $parent)
    {
        /** @var ParameterDocBook|VarDocBook $parameter */
        $parameter = $parent;
        
        $name = $param['type'];

        $name = trim($name);
        $type = new TypeDocBook($parent);
        $type->setName($name);

        /*
        $this->parseTypePhp($name, $type);

        if ('void'==$name && !empty($param['pass'])) {
            $type->php_type = 'mixed';
        }

        if ('va_list'==$name || '__gnuc_va_list'==$type->php_type) {
            $parameter->setVariadic(true);
        }
        */


        return $type;
    }

    public function parseStruct(DOMElement $element, $parent)
    {
        $xpath = new DOMXpath($element->ownerDocument);
        
        $struct = new StructDocBook($parent);
        
        $nodes = $xpath->query('indexterm/primary', $element);
        if ($nodes->count()) {
            $struct->name = $nodes[0]->nodeValue;
        }

        $definition = $this->sourceCode->getStruct($struct->name);
        //print_r($definition);
        if ($definition && !empty($definition['members'])) {
            foreach($definition['members'] as $name=>$member) {
                $field = new VarDocBook($struct);
                $field->name = $member['name'];
                $type = $this->parseType($member, $field);
                $field->setType($type);
                if (isset($member['pass'])) {
                    $field->setPass($member['pass']);
                }
                // modfier ?

                $struct->addField($field);
            }
        } else {
            echo 'Members of ', $struct->name, " not found\n";
        }

        
        $this->parseStructOrEnumOrUnionDescription($element, $struct);

        $this->parseStructMembersDescription($element, $struct);


        /** @var RefEntryDocBook $refentry */
        $refentry = $parent;
        $refentry->addStruct($struct);

        return $struct;
    }

    // ---------------------------
    // function
    // ---------------------------

    /**
     * Description of parameters function
     * @var StructDocBook $parent
     */
    public function parseStructOrEnumOrUnionDescription(DOMElement $element, $parent)
    {
        /** @var StructDocBook $struct */
        $struct = $parent;

        $description = '';
        $short_description = null;
        $warning_description = null;
        foreach($element->childNodes as $node) {
            // @see parseFunctionDescription() to assume Since tag
            if ('para'==$node->nodeName || 'informalexample'==$node->nodeName) {
                $description .= $element->ownerDocument->saveXML($node);
                if (null==$short_description)
                    $short_description = $description;
            }
            if ('warning'==$node->nodeName) 
                $warning_description = $element->ownerDocument->saveXML($node);
        }

        $struct->setDescription($description);
    }
    /**
     * Description of parameters function
     * @var StructDocBook $parent
     */
    public function parseStructMembersDescription(DOMElement $element, $parent)
    {
        /** @var StructDocBook $struct */
        $struct = $parent;

        $xpath = new DOMXpath($element->ownerDocument);

        $field = null;
        $field_name = '';
        $rows = $xpath->query("refsect3[@role='struct_members']/informaltable/tgroup/tbody/row", $element);
        foreach($rows as $row) {
            $entries = $xpath->query("entry", $row);
            foreach($entries as $entry) {
                $role = $entry->getAttribute('role');
                switch ($role) {
                    case 'struct_member_name':
                        $fields = $xpath->query("para/structfield", $entry);
                        $field_name = $fields[0]->nodeValue;
                        $field = $struct->getField($field_name);
                        if (empty($field)) {
                            echo "Can't recovery field name for struct '", $element->getAttribute('id'), "'", PHP_EOL;
                        }
                        break;
                    case 'struct_member_description':
                        if (isset($field)) {
                            $field->setDescription($this->parseEntryDescription($entry));
                        } else {
                            echo "Can't set description member for '", $element->getAttribute('id'), "'::", $field_name, PHP_EOL;
                        }
                        break;
                    case 'struct_member_annotations':
                        if(count($entry->childNodes)) {
                            $this->parseAnnotations($entry, $field);
                        }
                        break;
                    default:
                        echo "Unexpected role : $role in struct_members", PHP_EOL;
                        break;
                }
            }
        }

    }

    /**
     * Description of parameters function
     * @var EnumDocBook $parent
     */
    public function parseEnumMembersDescription(DOMElement $element, $parent)
    {
        $id = $element->getAttribute('id');
        /** @var EnumDocBook $enum */
        $enum = $parent;

        $xpath = new DOMXpath($element->ownerDocument);

        $const = null;
        $const_name = '';
        $rows = $xpath->query("refsect3[@role='enum_members']/informaltable/tgroup/tbody/row", $element);
        foreach($rows as $row) {
            $entries = $xpath->query("entry", $row);
            foreach($entries as $entry) {
                $role = $entry->getAttribute('role');
                switch ($role) {
                    case 'enum_member_name':
                        $const_name = $entry->nodeValue;
                        $const = $enum->getConstant($const_name);
                        if (empty($const)) {
                            echo "Can't recovery constant name for enum '", $element->getAttribute('id'), "'", PHP_EOL;
                        }
                        break;
                    case 'enum_member_description':
                        if (isset($const)) {
                            $const->setDescription($this->parseEntryDescription($entry));
                        } else {
                            echo "Can't set description member for '", $element->getAttribute('id'), "'::", $const_name, PHP_EOL;
                        }
                        break;
                    case 'enum_member_annotations':
                        if(count($entry->childNodes)) {
                            $this->parseAnnotations($entry, $const);
                        }
                        break;
                    default:
                        echo "Unexpected role '$role' in enum_members for '$id'; ", PHP_EOL;
                        //echo "   $const_name not documented in "., $element->ownerDocument->baseURI."\n";
                        break;
                }
            }
        }
    }

    public function parseEntryDescription(DOMElement $entry):string
    {
        $description = '';
        foreach($entry->childNodes as $para) {
            $description .= $entry->ownerDocument->saveXML($para);
        }
        return $description;
    }

    /**
     * Description of parameters function
     * @var FunctionDocBook $parent
     */
    public function parseParametersDescription(DOMElement $element, $parent)
    {
        $refsect2 = $element;
        //$parameter = $parent;
        //$function = $parameter->parent;
        $function = $parent;

        

        $xpath = new DOMXpath($element->ownerDocument);
        $nodes = $xpath->query("refsect3", $refsect2);
        /*
        Check structure
        foreach($nodes as $node) {
            $role = $node->getAttribute('role');
            if($role=="parameters") {

            } else if ($role=='returns') {
                
            } else {
                echo "Unexpected DocBook role = '$role'\n";
            }
        }
        */

        $parameter = null;
        $parameter_at = 0;
        $parameter_name = '';
        $nodes = $xpath->query("refsect3[@role='parameters']/informaltable/tgroup/tbody/row/entry", $refsect2);
        foreach($nodes as $node) {
            $role = $node->getAttribute('role');
            switch ($role) {
                case 'parameter_name':
                    $parameter_name = $node->nodeValue;
                    $parameter = $function->getParameter($parameter_name);
                    if (empty($parameter)) {
                        $parameter = $function->getParameterAt($parameter_at);
                        if (empty($parameter)) {
                            echo "Can recovery parameter name for '", $refsect2->getAttribute('id'), "'", PHP_EOL;
                            echo "   ", $parameter_name , ' !=  $parameter->getName()', " @ $parameter_at" , PHP_EOL;
                        }
                    }
                    break;
                case 'parameter_description':
                    if (isset($parameter)) {
                        $parameter->setDescription($this->parseEntryDescription($node));
                    } else {
                        echo "Can't set description parameter for '", $refsect2->getAttribute('id'), "'::", $parameter_name, PHP_EOL;
                    }
                    break;
                case 'parameter_annotations':
                    if(count($node->childNodes)) {
                        $this->parseAnnotations($node, $parameter);
                    }
                    break;
                default:
                    echo "Unexpected role : $role", PHP_EOL;
                    break;
            }
            $parameter_at++;
        }


        $description = '';
        $warning_description = '';
        $parameter = $function->getParameterReturn();
        $nodes = $xpath->query("refsect3[@role='returns']/*", $refsect2);
        foreach($nodes as $node) {
            if ('para'==$node->nodeName) {
                $is_annotation = false;

                foreach($node->childNodes as $child) {
                    if ('emphasis'==$child->nodeName
                     && $child->hasAttribute('role')
                     && 'annotation'==$child->getAttribute('role')) {
                        $this->parseAnnotations($node, $parameter);
                        $is_annotation = true;
                        break;
                    }
                }
                if (!$is_annotation) {
                    $description .= $node->ownerDocument->saveXML($node);
                }

            }
            if ('warning'==$node->nodeName) 
                $warning_description = $element->ownerDocument->saveXML($node);
        }
        $parameter->setDescription($description);
    }

    protected function parseAnnotations(DOMElement $entry, $parent) {
        $parameter = $parent;
        $str = $entry->nodeValue;
        $parts = explode ('][', $str);
        $parts = str_replace (array(']', '['), '', $parts);
        foreach($parts as $part) {
            $elements = explode (' ', $part);
            $acronym = $elements[0];
            $annotation = AnnotationDocBook::Factory($acronym, $parameter);// array && element-type && ...
            if ($annotation) {
                if (isset($elements[1])) {
                    $annotation->setParam($elements[1]);
                }
                $parameter->addAnnotation($annotation);
            }
        }
        
    }


    /**
     * Description of function
     */
    public function parseFunctionDescription(DOMElement $element, $parent)
    {
        $method = $parent;

        $description = '';
        $short_description = '';
        $warning_description = '';

        /** @var DOMElement $child */
        foreach($element->childNodes as $child) {
            if ('para'==$child->nodeName) {
                if ($child->hasAttribute('role')) {
                    $role = $child->getAttribute('role');
                    switch ($role) {
                        case 'since':
                            $xpath = new DOMXpath($element->ownerDocument);
                            $nodes = $xpath->query("link", $child);
                            if ($nodes->count())
                                $method->setTagSince($nodes[0]->nodeValue);
                            break;
                    }
                } else {

                    if (null==$short_description)
                        $short_description = $element->ownerDocument->saveXML($child);
                    else
                        $description .= $element->ownerDocument->saveXML($child);
                }
            }
            if ('warning'==$child->nodeName) 
                $warning_description = $element->ownerDocument->saveXML($child);
        }

        $method->setDescription($description);
        $method->setShortDescription($short_description);

    }


}
