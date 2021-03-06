<?php

namespace Zend\Ext\Services\DocBook;

use SimpleXMLElement;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\PropertyGenerator;
use Zend\Ext\Models\TypeGenerator;
use Zend\Ext\Services\DocBook;


class Glib extends DocBook
{
    /**
     * @var Zend\Ext\Models\PackageGenerator $package
     */
    protected $package;
    /**
     * @var Zend\Ext\Models\AbstractGenerator $current_generator
     */
    protected $current_generator;

    function save($dirname):string {
        $service = current($this->codeGenerator);
        return $service->render($this->package);
    }

    /**
     * load glib-docs.xml to get xi:include in each chapter
     * <book id="index">
     *   <chapter id="glib-data-types">
     *     <xi:include href="xml/hash_tables.xml" />
     *   </chapter>
     * </book>
     */
    function load():PackageGenerator {
        $this->package = new PackageGenerator(array(
            'name'=>'G',
            'shortDescription'=>'Glib 2.64.22'
        ));

        //foreach xi:include

        // TODO: $this->getSourceCodeStruct();
        //$glist = $this->getSourceCode('GLib')->getStruct('GList');
        //$glist = $this->sourceCode['Glib']->getStruct('GList');
        //$cmp = $this->sourceCode['Glib']->getProto('GHookCompareFunc');
        //$cmp = $this->sourceCode['Glib']->getProto('GCompareFunc');
        //print_r($cmp);
        //$this->getSourceCode('Glib')->getStruct('GList');

        $filename = '/home/dev/Projects/glib-build-doc/docs/reference/glib/xml/hash_tables.xml';
        $filename = '/home/dev/Projects/glib-build-doc/docs/reference/glib/xml/linked_lists_double.xml';
        //$filename = '/home/dev/Projects/glib-build-doc/docs/reference/glib/xml/arrays.xml';
        $filename = '/home/dev/Projects/glib-build-doc/docs/reference/glib/xml/error_reporting.xml';
        $xml = simplexml_load_file($filename);
        $class = $this->loadClass($xml);
        // $package->addClass($class);
        // $package->addBoxed($class);
        // $package->addEnum($class);
        // $package->addFunction($class);
        return $this->package;
    }

    protected function loadClass(SimpleXMLElement $xml): ClassGenerator {
        $map=array(
            'Hash Tables'=>'GHashTable',
            'Doubly-Linked Lists'=>'GList',
            'Error Reporting'=>'GError',
            'Arrays'=>'GArray',
        );// <------------------------------------------------------------------------
        $id = trim((string) $xml['id']);//glib-Hash-Tables

        $className = (string) $xml->refmeta->refentrytitle;
        $className = $map[$className]?? $className;

        $class = $this->package->createClass($className);
        $this->current_generator = $class;

        $description = (string) $xml->refnamediv->refpurpose;
        $class->setDescription($description);

        $result = $xml->xpath("refsect1[@id='$id.functions_details']/refsect2");
        foreach($result as $node) {
            $method = $this->loadMethod($node);
            if ($method) {
                $class->addMethodFromGenerator($method);

                $tmpa = strtolower($class->getName());
                $tmpb = str_replace('_', '', strtolower($method->getName()));
                if(False===strpos($tmpb, $tmpa)) {
                    $method->setIsStatic();
                    $method->setIsCallback();
                } else {
                    $parameters = $method->getParameters();
                    if (count($parameters)>0) {
                        $parameter = current($parameters);
                        if ($className!=$parameter->getType()->getName()) {
                            $method->setIsStatic();
                        }
                    }
                }
            }
        }

        $nodes = $xml->xpath("refsect1[@id='$id.other']/informaltable/tgroup/tbody/row/entry/link");
        $relatedObjects = $this->getRelatedObjects($nodes, $className);
        $class->setRelatedObjects($relatedObjects);

        // load all class before render
        //var_dump($this->sourceCode['Glib']->data['STRUCT']['_GHashTableIter']);
        $struct = $this->sourceCode['Glib']->getStruct($className);
        if(empty($struct))
        echo '"', $className, '" not found in source', PHP_EOL;
        else
        foreach($struct['members'] as $member) {
            $property = new PropertyGenerator($member['name']);
            $type = new TypeGenerator($member['type']);
            $property->setType($type);
            //$property->setPass($member['pass']);
            $class->addPropertyFromGenerator($property);
        }
        //var_dump($struct);


        return $class;
    }

    protected function loadMethod(SimpleXMLElement $xml):? MethodGenerator {
        $methodName = (string) $xml->indexterm->primary;
        $id = trim((string) $xml['id']);

        $method = $this->package->createMethod($methodName);
        $blackList = array('g_hash_table_freeze', 'g_hash_table_thaw');// <---------------------------------------------------
        if (in_array($methodName, $blackList)) {
            echo 'Skip macro'.$methodName.PHP_EOL;
            return Null;
        }
        // <-- setType -->
        $data = Null;
        if (isset($this->sourceCode['Glib']->data['TYPEDEF'][$methodName])) {
            $data = array(
                'functions'=>array(
                    $this->sourceCode['Glib']->data['TYPEDEF'][$methodName]
                )
            );
            //print_r($data);
            // $method->setIsCallback();
            return Null;
        } else if ($xml['role']=='macro') {
            echo 'TODO 555.666: ', $methodName, PHP_EOL;
            return NULL;
        } else if ($xml->programlisting) {
            $str = strip_tags($xml->programlisting->asXml());
            $str = str_replace(' ', ' ', $str);
            file_put_contents(__DIR__.'/../../../tmp/declaration.h', $str);
            try {
                $data = $this->sourceCode['Glib']->parse($str);
            } catch(\Zend\C\Engine\Error $exc) {
                echo $methodName, PHP_EOL;
                echo $str, PHP_EOL;
                // #define             g_list_previous(list)
                echo $exc->getMessage().PHP_EOL;
                return NULL;
            }
        } else {
            echo "Error 88 unexpected\n";
        }
        //var_dump($data);

        $keys = array_keys($data['functions']);
        $func = $data['functions'][$keys[count($keys)-1]];

        $typeName = $func['signature']['return']['type'];

        if (False) {
            /*
            $typedefs = $this->sourceCode['Glib']->data['TYPEDEF'];
            $type_pass='';
            if (isset($typedefs[$typeName])) {
                $type = $this->package->createType($typedefs[$typeName]['type']);
                if (isset($typedefs[$typeName]['pass'])) {
                    $type_pass = $typedefs[$typeName]['pass'];
                }
            } else {
                $type = $this->package->createType($typeName);
            }
            $method->setType($type);
            if (isset($func['signature']['return']['pass'])) {
                $pass = $func['signature']['return']['pass'];
                $type_pass = $pass.$type_pass;
            }
            if (!empty($type_pass)) {
                $method->setPass($type_pass);
            }
            */

        }
        if(True) {
            $type = $this->package->createType($typeName);
            $method->setType($type);
            if (isset($func['signature']['return']['pass'])) {
                $pass = $func['signature']['return']['pass'];
                $method->setPass($pass);
            }
        }

        $typedefs = $this->sourceCode['Glib']->data['TYPEDEF'];

        // <-- setParameter -->
        $parametersData = $func['signature']['parameters'];

        // TODO variadic parameter( PHP Warning:  Illegal string offset 'name')
        foreach($parametersData as $options) {
            if (empty($options['name']) && empty($options['type'])) {
                echo 'TODO: Assume variadic parameter' . PHP_EOL;
                continue;
            }
            if (is_null($options['name']) && 'void'==$options['type']) {
                // GList *g_list_alloc (void);
                continue;
            }
            $parameter = $this->package->createParameter($options['name']);
            $parameterType = $this->package->createType($options['type']);
            $parameter->setType($parameterType);
            if (isset($options['pass'])) {
                $parameter->setPass($options['pass']);
            }
            $method->setParameter($parameter);

            if (isset($typedefs[$options['type']])) {
                if ('function'==$typedefs[$options['type']]['type']) {
                    $parameter->setIsCallback();
                    $parameterType->setIsPrototype(True);
                    $parameterType->setPrototype($typedefs[$options['type']]['signature']);
                }
            }
        }

        // <-- setDescription -->
        /* use the constants &true; or
         * &false;. Both are case-insensitive.
         */
        $paragraphs = $xml->para;
        $method->setShortDescription($paragraphs[0]->asXml());
        $description = '';
        foreach($paragraphs as $paragraph) {
            $description .= $paragraph->asXml();
        }
        $method->setDescription($description);

        // <-- parameter::setDescription -->
        $refsect3 = $xml->xpath("refsect3[@id='$id.parameters']");
        if(!empty($refsect3)) {
            $rows = $refsect3[0]->informaltable->tgroup->tbody->row;
            foreach($rows as $row) {
                $parameterName = (string)$row->entry[0]->para[0];
                if ($parameterName=='...') {
                    echo 'FIX: Assume variadic parameter' . PHP_EOL;
                    continue;
                }
                $parameter = $method->getParameter($parameterName);

                $parameterDescription = $row->entry[1]->para->asXml();
                $parameter->setDescription($parameterDescription);

                $parameterAnnotations = $row->entry[2]->emphasis->acronym;
                if(isset($parameterAnnotations))
                foreach($parameterAnnotations as $annotation) {
                    $acronym =(string)$annotation;
                    switch ($acronym) {
                        case 'optional':
                            $parameter->setIsOptional(True);
                            break;
                        case 'out':// Php as pass reference
                        case 'nullable':
                        case 'not nullable':
                        default:
                            //echo "Unimplemented annotation: '$acronym'\n";
                            break;
                    }
                }
            }
        }

        // <-- methodType::setDescription -->
        $type = $method->getType();
        $paragraphs = $xml->xpath("refsect3[@id='$id.returns']/para");
        $description = '';
        foreach($paragraphs as $paragraph) {
            $description .= $paragraph->asXml();
        }
        $type->setDescription($description);

        // <-- setProperties -->
        // <-- setSignals -->
        // <-- setStyles -->
        // <-- setRelatedObjects -->

        return $method;
    }

    protected function getProperties() {

    }
    protected function getSignals() {

    }
    protected function getStyles() {

    }
    protected function getRelatedObjects($nodes, $className) {
        $array = [];
        foreach($nodes as $node) {
            $objName = (string)$node;
            if ($objName!=$className) {
                $array[] = $objName;
            }
        }
        return $array;
    }
}
