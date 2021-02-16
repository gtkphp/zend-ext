<?php

namespace Zend\Ext\Services;

use Zend\Ext\Services\DocBook;

use Zend\Ext\Models\TypeGenerator;
use Zend\Ext\Models\ParameterGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\PackageGenerator;

use SimpleXMLElement;

class GlibDocBook extends DocBook
{
    /**
     * @var Zend\Ext\Models\PackageGenerator $package
     */
    protected $package;
    /**
     * @var Zend\Ext\Models\AbstractGenerator $current_generator
     */
    protected $current_generator;

    /**
     * load glib-docs.xml to get xi:include in each chapter
     * <book id="index">
     *   <chapter id="glib-data-types">
     *     <xi:include href="xml/hash_tables.xml" />
     *   </chapter>
     * </book>
     */
    function load() {


        $this->package = new PackageGenerator(array(
            'name'=>'G',
            'shortDescription'=>'Glib 2.64.22'
        ));

        //foreach xi:include

        $filename = '/home/dev/Projects/glib-build-doc/docs/reference/glib/xml/hash_tables.xml';
        $xml = simplexml_load_file($filename);
        $class = $this->loadClass($xml);
        // $package->addClass($class);
        // $package->addBoxed($class);
        // $package->addEnum($class);
        // $package->addFunction($class);
    }

    protected function loadClass(SimpleXMLElement $xml): ClassGenerator {
        $map=array('Hash Tables'=>'GHashTable');// <------------------------------------------------------------------------
        $id = trim((string) $xml['id']);

        $className = (string) $xml->refmeta->refentrytitle;
        $className = $map[$className]?? $className;

        $class = $this->package->createClass($className);
        $this->current_generator = $class;

        $result = $xml->xpath("refsect1[@id='$id.functions_details']/refsect2");
        foreach($result as $node) {
            $method = $this->loadMethod($node);
            if ($method) $class->addMethodFromGenerator($method);
        }
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
        } else if ($xml->programlisting) {
            $str = strip_tags($xml->programlisting->asXml());
            $str = str_replace(' ', ' ', $str);
            file_put_contents(__DIR__.'/../../tmp/declaration.h', $str);
            $data = $this->sourceCode['Glib']->parse($str);
        } else {
            echo "Error 88 unexpected\n";
        }
        //var_dump($data);

        $keys = array_keys($data['functions']);
        $func = $data['functions'][$keys[count($keys)-1]];

        $typeName = $func['signature']['return']['type'];

        $type = $this->package->createType($typeName);
        $method->setType($type);
        if (isset($func['signature']['return']['modifier'])) {
            $modifier = $func['signature']['return']['modifier'];
            $method->setPass($modifier);
        }

        // <-- setParameter -->
        $parametersData = $func['signature']['parameters'];
        foreach($parametersData as $options) {
            $parameter = $this->package->createParameter($options['name']);
            $parameterType = $this->package->createType($options['type']);
            $parameter->setType($parameterType);
            if (isset($options['modifier'])) {
                $parameter->setPass($options['modifier']);
            }
            $method->setParameter($parameter);
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
        $rows = $refsect3[0]->informaltable->tgroup->tbody->row;
        foreach($rows as $row) {
            $parameterName = (string)$row->entry[0]->para[0];
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
    protected function getRelatedObjects() {

    }
}
