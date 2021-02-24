<?php

namespace Zend\Ext\Services;

use Zend\View\View;
use Zend\View\Model\ViewModel;
use Zend\View\Resolver\TemplatePathStack;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Strategy\PhpRendererStrategy;

use Zend\Stdlib\Response;

use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\Filter\StripTags;
use Zend\Filter\StripNewlines;
use Zend\Filter\FilterChain;


use Zend\Ext\Helpers\Php\Poo\NamespaceHelper;
use Zend\Ext\Helpers\Php\Poo\CommentHelper;
use Zend\Ext\Helpers\Php\Poo\NameclassHelper;
use Zend\Ext\Helpers\Php\Poo\MethodHelper;
use Zend\Ext\Helpers\Php\Poo\NamemethodHelper;
use Zend\Ext\Helpers\Php\Poo\TypeHelper;
use Zend\Ext\Helpers\Php\Poo\ParameterHelper;
use Zend\Ext\Helpers\Php\Poo\NamepropertyHelper;

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

    function save(string $dir)
    {
        $view = $this->getView();
        $model = $this->getViewModel();

        $view->render($model);
        echo $view->getResponse()->getContent();
    }

    function getViewModel():ViewModel
    {
        $objects = $this->package->getListTypeObject();
        $class = array_pop($objects);

        // <?php echo $this->author
        // <?php echo $this->date
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', '31/12/1999');
        $licenseModel->setTemplate('method.phtml');

        // <?php echo $this->license
        // <?php echo $this->message
        $model = new ViewModel();
        $model->setVariable('name', $class->getName());
        $model->setVariable('description', $class->getDescription());
        $model->setVariable('methods', $class->getMethods());
        //$model->addChild($licenseModel, 'licenseHeader');
        $model->setTemplate('class.phtml');

        return $model;
    }
    function getView():View
    {
        $view = new View();
        $view->setResponse(new Response());

        $resolver = new TemplatePathStack();
        $resolver->addPath(__DIR__.'/../Views/Php/Poo');

        $renderer = new PhpRenderer();
        $renderer->setResolver($resolver);

        $rendererStrategy = new PhpRendererStrategy($renderer);
        $rendererStrategy->attach($view->getEventManager());

        /*$view->addResponseStrategy(function ($event) {
            $event->getResponse()->setContent($event->getResult());
        });
        $view->addRenderingStrategy(function ($event) {
            echo "Here we are\n";
            $view = $event->getView();
            $pluginManager = $view->getHelperPluginManager();
            var_dump($event);
            return $renderer;
        });*/
        $pluginManager = $renderer->getHelperPluginManager();

        $pluginManager->setFactory('namespaceHelper', function ($pluginManager) {
            $filter = new CamelCaseToUnderscore;
            NamespaceHelper::$filter = $filter;
            $namespaceHelper = new NamespaceHelper;
            return $namespaceHelper;
        });
        $pluginManager->setFactory('commentHelper', function ($pluginManager) {
            //$filter = new StripTags;
            $filter = new FilterChain();
            $filter->attach(new StripTags());
            //       ->attach(new StripNewlines());
            CommentHelper::$filter = $filter;
            return new CommentHelper;
        });
        $pluginManager->setFactory('nameclassHelper', function ($pluginManager) {
            NameclassHelper::$filter = new CamelCaseToUnderscore;
            return new NameclassHelper;
        });
        $pluginManager->setFactory('methodHelper', function ($pluginManager) {
            return new MethodHelper;
        });
        $pluginManager->setFactory('namemethodHelper', function ($pluginManager) {
            NamemethodHelper::$filter = new CamelCaseToUnderscore;
            return new NamemethodHelper;
        });
        $pluginManager->setFactory('typeHelper', function ($pluginManager) {
            return new TypeHelper;
        });
        $pluginManager->setFactory('parameterHelper', function ($pluginManager) {
            return new ParameterHelper;
        });
        $pluginManager->setFactory('namepropertyHelper', function ($pluginManager) {
            return new NamepropertyHelper;
        });

        return $view;
    }

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
        foreach($parametersData as $options) {
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
