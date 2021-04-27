<?php

namespace Zend\Ext\Services\DocBook;


namespace Zend\Ext\Services\DocBook;

use SimpleXMLElement;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\PropertyGenerator;
use Zend\Ext\Models\TypeGenerator;
use Zend\Ext\Services\DocBook;


class Gtk extends DocBook
{
    /**
     * @var Zend\Ext\Models\PackageGenerator $package
     */
    protected $package;
    /**
     * @var Zend\Ext\Models\AbstractGenerator $current_generator
     */
    protected $current_generator;

    function save($dirname): string
    {
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
    function load(): PackageGenerator
    {
        $this->package = new PackageGenerator(array(
            'name' => 'Gtk',
            'shortDescription' => 'Gtk 3.22.0'
        ));

        //foreach xi:include

        // TODO: $this->getSourceCodeStruct();
        //$glist = $this->getSourceCode('GLib')->getStruct('GList');
        //$glist = $this->sourceCode['Glib']->getStruct('GList');
        //$cmp = $this->sourceCode['Glib']->getProto('GHookCompareFunc');
        //$cmp = $this->sourceCode['Glib']->getProto('GCompareFunc');
        //print_r($cmp);
        //$this->getSourceCode('Glib')->getStruct('GList');
        
        $files = [
            '/home/dev/Projects/glib-build-doc/docs/reference/gobject/xml/objects.xml',
            '/home/dev/Projects/gtk-build-doc/docs/reference/gtk/xml/gtkwidget.xml',
            '/home/dev/Projects/gtk-build-doc/docs/reference/gtk/xml/gtkcontainer.xml',
        ];
        foreach($files as $filename) {
            $xml = simplexml_load_file($filename);
            $class = $this->loadClass($xml);
        }

/*
        $filename = '/home/dev/Projects/gtk-build-doc/docs/reference/gtk/xml/gtkwidget.xml';
        $xml = simplexml_load_file($filename);
        $class = $this->loadClass($xml);
*/
        // $package->addClass($class);
        // $package->addBoxed($class);
        // $package->addEnum($class);
        // $package->addFunction($class);
        return $this->package;
    }

    protected function loadClass(SimpleXMLElement $xml): ClassGenerator
    {
        $map = array(
        );// <------------------------------------------------------------------------
        $id = trim((string)$xml['id']);//glib-Hash-Tables

        $className = (string)$xml->refmeta->refentrytitle;
        $className = $map[$className] ?? $className;

        $class = $this->package->createClass($className);
        $this->current_generator = $class;

        $description = (string)$xml->refnamediv->refpurpose;
        $class->setDescription($description);

        $result = $xml->xpath("refsect1[@id='$id.functions_details']/refsect2");
        foreach ($result as $node) {
            $method = $this->loadMethod($node);
            if ($method) {
                $class->addMethodFromGenerator($method);

                $tmpa = strtolower($class->getName());
                $tmpb = str_replace('_', '', strtolower($method->getName()));
                if (False === strpos($tmpb, $tmpa)) {
                    $method->setIsStatic();
                    $method->setIsCallback();
                } else {
                    $parameters = $method->getParameters();
                    if (count($parameters) > 0) {
                        $parameter = current($parameters);
                        if ($className != $parameter->getType()->getName()) {
                            $method->setIsStatic();
                        }
                    }
                }
            }
        }

        $nodes = $xml->xpath("refsect1[@id='$id.other']/informaltable/tgroup/tbody/row/entry/link");
        $relatedObjects = $this->getRelatedObjects($nodes, $className);
        $relatedClasses = array();
        foreach($relatedObjects as $linked=>$relatedObject) {
            //echo "$linked=>$relatedObject\n";
            //if ($linked=='GtkRequisition-struct') {
                $nodes = $xml->xpath("refsect1/refsect2[@id='$linked']");
                if (!empty($nodes)) {
                    $related = $this->getRelatedObject($nodes[0], $className);
                    $relatedClasses[$relatedObject] = $related;
                }
            //}
        }
        $class->setRelatedObjects($relatedClasses);
        

        // load all class before render
        //var_dump($this->sourceCode['Glib']->data['STRUCT']['_GHashTableIter']);
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
        //var_dump($struct);


        return $class;
    }

    protected function loadMethod(SimpleXMLElement $xml): ?MethodGenerator
    {
        $methodName = (string)$xml->indexterm->primary;
        $id = trim((string)$xml['id']);

        $method = $this->package->createMethod($methodName);
        $blackList = array('g_hash_table_freeze', 'g_hash_table_thaw');// <---------------------------------------------------
        if (in_array($methodName, $blackList)) {
            echo 'Skip macro' . $methodName . PHP_EOL;
            return Null;
        }
        // <-- setType -->
        $data = Null;
        if (isset($this->sourceCode['Glib']->data['TYPEDEF'][$methodName])) {
            $data = array(
                'functions' => array(
                    $this->sourceCode['Glib']->data['TYPEDEF'][$methodName]
                )
            );
            //print_r($data);
            // $method->setIsCallback();
            return Null;
        } else if ($xml['role'] == 'macro') {
            echo 'TODO 555.666: ', $methodName, PHP_EOL;
            return NULL;
        } else if ($xml->programlisting) {
            $str = strip_tags($xml->programlisting->asXml());
            $str = str_replace(' ', ' ', $str);
            file_put_contents(__DIR__ . '/../../../tmp/declaration.h', $str);
            try {
                $data = $this->sourceCode['Glib']->parse($str);
            } catch (\Zend\C\Engine\Error $exc) {
                echo $methodName, PHP_EOL;
                echo $str, PHP_EOL;
                // #define             g_list_previous(list)
                echo $exc->getMessage() . PHP_EOL;
                return NULL;
            }
        } else {
            echo "Error 88 unexpected\n";
        }
        //var_dump($data);

        $keys = array_keys($data['functions']);
        $func = $data['functions'][$keys[count($keys) - 1]];

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
        if (True) {
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
        foreach ($parametersData as $options) {
            if (empty($options['name']) && empty($options['type'])) {
                echo 'TODO: Assume variadic parameter' . PHP_EOL;
                continue;
            }
            if (is_null($options['name']) && 'void' == $options['type']) {
                // GList *g_list_alloc (void);
                continue;
            }
            if (empty($options['type'])) {
                echo 'TODO: array parameter[]' . PHP_EOL;
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
                if ('function' == $typedefs[$options['type']]['type']) {
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
        if(empty($paragraphs)) {
            echo 'Notice : No documention found for function : '.$methodName , PHP_EOL;
        } else {
            $method->setShortDescription($paragraphs[0]->asXml());
            $description = '';
            foreach ($paragraphs as $paragraph) {
                $description .= $paragraph->asXml();
            }
            $method->setDescription($description);
        }

        // <-- parameter::setDescription -->
        $refsect3 = $xml->xpath("refsect3[@id='$id.parameters']");
        if (!empty($refsect3)) {
            $rows = $refsect3[0]->informaltable->tgroup->tbody->row;
            foreach ($rows as $row) {
                $parameterName = (string)$row->entry[0]->para[0];
                if ($parameterName == '...') {
                    echo 'FIX: Assume variadic parameter' . PHP_EOL;
                    continue;
                }
                $parameter = $method->getParameter($parameterName);

                $parameterDescription = $row->entry[1]->para->asXml();
                $parameter->setDescription($parameterDescription);

                $parameterAnnotations = $row->entry[2]->emphasis->acronym;
                if (isset($parameterAnnotations))
                    foreach ($parameterAnnotations as $annotation) {
                        $acronym = (string)$annotation;
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
        foreach ($paragraphs as $paragraph) {
            $description .= $paragraph->asXml();
        }
        $type->setDescription($description);

        // <-- setProperties -->
        // <-- setSignals -->
        // <-- setStyles -->
        // <-- setRelatedObjects -->

        return $method;
    }

    protected function getProperties()
    {

    }

    protected function getSignals()
    {

    }

    protected function getStyles()
    {

    }

    protected function getRelatedObjects($nodes, $className)
    {
        $array = [];
        foreach ($nodes as $node) {
            $linked = ((string)$node['linkend']);
            $objName = (string)$node;
            if ($objName != $className) {
                $array[$linked] = $objName;
            }
        }
        return $array;
    }

    protected function getRelatedObject($node, $className)
    {
        $struct_name = (string)$node->indexterm->primary;//'GtkRequisition'
        $role = (string)$node['role'];//'enum'|'struct'
        $map = array(
        );// <------------------------------------------------------------------------
        $id = trim($struct_name);//glib-Hash-Tables

        //$str = (string)$node->programlisting;
        switch($role) {
            case 'typedef':
                $struct = $this->sourceCode['Glib']->getProto($struct_name);
                $struct = $this->sourceCode['Glib']->getStruct($struct['type']);
                if (empty($struct)) {
                    echo '===================>', $role, ' / ', $struct_name, PHP_EOL;
                    return null;
                }
                var_dump($struct);
                $struct_name = str_replace('_', '', $struct['name']);
                var_dump($struct_name);
                $class = $this->package->createRelatedClass($struct_name, $this->current_generator);
                var_dump($class);
                break;
            case 'enum':
                //$struct = $this->sourceCode['Glib']->getEnum($struct_name);
                //var_dump($struct);
                //$class = $this->current_generator->createRelatedEnum($struct_name);
                echo '====>', $role, ' / ', $struct_name, PHP_EOL;
                return null;
                break;
            case 'struct':
                $struct = $this->sourceCode['Glib']->getStruct($struct_name);
                if ($struct_name==$className.'Class') {
                    //$class = $this->current_generator->createVTableClass($struct_name);
                    $class = $this->getVTable($node, $struct);
                    $this->current_generator->setVTable($class);
                } else {
                    $class = $this->package->createRelatedClass($struct_name, $this->current_generator);
                }
                break;
            case 'macro':
                return null;
                break;
            default:
                echo 'role: ', $role, PHP_EOL;
                break;
        }

        $description = $node->para->asXml();
        //var_dump($description);
        $class->setDescription($description);

        if (empty($struct))
            echo '"', $className, '" not found in source', PHP_EOL;
        else if (!empty($struct['members']))
            foreach ($struct['members'] as $member) {
                $property = new PropertyGenerator($member['name']);
                $type = new TypeGenerator($member['type']);
                $property->setType($type);
                //$property->setPass($member['pass']);
                $class->addPropertyFromGenerator($property);
            }
        else
            echo 'Member not found in '.$struct_name.PHP_EOL;

        return $class;
    }
    protected function getVTable($node, array $struct)
    {
        // TODO parse DocBook
        $name = trim ($struct['name'], "_" );

        $vtable = $this->package->createVTable($name);
        $vtable->setParentGenerator($this->current_generator);

        $i=0;
        foreach($struct['members'] as $member) {
            if ('parent_class'==$member['name']) {
                $vtable->setExtendedClass($member['type']);
            } else if ('function'==$member['type']) {
                $funcGenerator = $this->getFunction($member);
                //$this->current_generator->addVirtualFromGenerator($funcGenerator);
                $vtable->addMethodFromGenerator($funcGenerator);
                //$vtable->addPropertyFromGenerator($funcGenerator);
                if($i++>2)
                break;
            } else {
                //$vtable->addProperty($funcGenerator);// static memeber of $class
            }
        }

        return $vtable;
    }

    protected function getFunction($data)
    {
        $function = new MethodGenerator($data['name']); //VirtualGenerator();

        
        $this->setType($function, $data['signature']['return']);


        // TODO variadic parameter( PHP Warning:  Illegal string offset 'name')
        foreach ($data['signature']['parameters'] as $parameterData) {
            ///echo $parameterData['name'] , PHP_EOL;
            if (empty($parameterData['name']) && empty($parameterData['type'])) {
                echo 'TODO: Assume variadic parameter' . PHP_EOL;
                continue;
            }
            if (is_null($parameterData['name']) && 'void' == $parameterData['type']) {
                // GList *g_list_alloc (void);
                continue;
            }
            $parameter = $this->package->createParameter($parameterData['name']);
            $parameterType = $this->package->createType($parameterData['type']);
            //echo $parameterData['type'].', '.$parameterType->getName().PHP_EOL;
            $parameter->setType($parameterType);
            if (isset($parameterData['pass'])) {
                $parameter->setPass($parameterData['pass']);
            }
            $function->setParameter($parameter);

            if (isset($typedefs[$parameterData['type']])) {
                if ('function' == $typedefs[$parameterData['type']]['type']) {
                    $parameter->setIsCallback();
                    $parameterType->setIsPrototype(True);
                    $parameterType->setPrototype($typedefs[$parameterData['type']]['signature']);
                }
            }
        }

        return $function;
    }

    /**
     * @param ParameterGenerator|MethodGenerator $generator
     * @param array $data
     */
    protected function setType($generator, $data) {
        $typeName = $data['type'];
        
        $type = $this->package->createType($typeName);
        $generator->setType($type);
        if (isset($data['pass'])) {
            $pass = $data['pass'];
            $generator->setPass($pass);
        }

    }
}
