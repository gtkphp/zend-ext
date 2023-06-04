<?php

namespace Zend\Ext\Services\SourceCode;

use Zend\Ext\Services\SourceCode;
use Exception;

use Zend\C\Engine\Lexer;
use Zend\C\Engine\Context;
use Zend\C\Engine\PreProcessor;
use Zend\C\ExpressionParser;
use Zend\C\PhpPrinter;

class Glib extends SourceCode {


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

    public $defines = array();

    function __construct(){
        $this->name = 'Glib';// Unusefull
        $this->printer = new PhpPrinter;
        $this->context = new Context;
        $lexer = new Lexer;
        $this->parser = new ExpressionParser($lexer);
        $this->preprocessor = new PreProcessor($this->context);

    }

    function loadStubs($filename) {
        $functions = include($filename);
        $functions = array_diff($functions['user'], ['composer\autoload\includefile', 'deepcopy\deep_copy', 'gint']);
        $functions = array_filter($functions, function ($v) {
            // "composerrequireb77025529192e879922af895bdc5f677"
            if (0===strpos($v, 'composerrequire')) return false; return true;
        });
        $functions = array_values($functions);// remake index
        

        $this->array['stub'] = [];

        foreach ($functions as $function) {
            $functionReflection = new \ReflectionFunction($function);
            $function_name = $functionReflection->getName();
            $stub = ['type'=>'macro', 'role'=>'function', 'signature'=>['return'=>['type'=>'void'], 'parameters'=>[]]];
            //TODO: isVariadic, reference
            $parameters = $functionReflection->getParameters();
            foreach ($parameters as $parameter) {
                if ($parameter->getType()) {
                    $parameter_type = $parameter->getType()->__toString();
                } else {
                    $parameter_type = "mixed";
                }
                $stub['signature']['parameters'][$parameter->getName()] = ['name'=>$parameter->getName(), 'type'=>$parameter_type];
            }
            $returns = $functionReflection->getReturnType();
            if ($returns) {
                $stub['signature']['return'] = ['type'=>$returns->getName()];
            }
            $this->array['stub'][$function_name] = $stub;
        }

    }

    function loadTypes($filename) {
        try {
            $tokens = $this->preprocessor->process($filename);
            $ast = $this->parser->parse($tokens, $this->context);
            $this->printer->print($ast, $this->array);

            $this->defines = $this->preprocessor->getDefinitions();
        } catch (\Exception $error) {
            throw new \Zend\C\Engine\Error($error->getMessage());
        }
    }
    function evaluate() {
        try {
            $this->printer->evaluate($this->array);
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500, $error);// \Zend\C\Engine\Error
        }
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

    function getFunction($name) {
        $functions = $this->array['functions'];
        if (isset($functions[$name])) {
            return $functions[$name];
        } else {
            //echo "Function '$name' Not found\n";
        }
        return null;
    }

    function getStruct($name) {
        $typedefs = $this->array['typedefs'];
        $structs = $this->array['structs'];

        if (isset($typedefs[$name])) {
            $typedef_name = $typedefs[$name]['name'];
            if (isset($structs[$typedef_name])) {
                return $structs[$typedef_name];
            } else {
                echo "Struct '$name' Not found\n";
            }
        } else {
            if (isset($structs[$name])) {
                return $structs[$name];
            } else {
                echo "Struct '$name' Not found\n";
            }
        }
        return Null;
    }

    function hasProto($name)
    {
        $functions = $this->array['user_function'];
        if (isset($functions[$name])) {
            return true;
        }
        return false;
    }

    function getProto($name)
    {

        $typedefs = $this->array['typedefs'];
        $functions = $this->array['user_function'];

        if (isset($functions[$name])) {
            return $functions[$name];
        } else {
            //echo "Prototype '$name' Not found\n";
        }

        return Null;
    }

    function getMacro($name)
    {
        $defines = $this->defines;//$this->preprocessor->getDefinitions();
        //print_r($defines);

        // How to parse : G_WIN32_DLLMAIN_FOR_DLL_NAME
        $stubs = $this->array['stub'];

        if (array_key_exists($name, $stubs)) {
            return $stubs[$name];
        }

        if (isset($defines[$name])) {
            //echo $name, PHP_EOL;
            $ast = $defines[$name];
            $parser = new \Zend\C\MacroParser();
            $m = $parser->parse($ast);
            //print_r($m);
            return $m;
        }

        return Null;
    }

    function getEnum($name) {
        $typedefs = $this->array['typedefs'];
        $enums = $this->array['enums'];

        if (isset($typedefs[$name])) {
            $typedef_name = $typedefs[$name]['name'];
            if (isset($enums[$typedef_name])) {
                return $enums[$typedef_name];
            } else {
                echo "Enum '$name' Not found\n";
            }
        } else {
            if (isset($enums[$name])) {
                return $enums[$name];
            } else {
                echo "Enum '$name' Not found\n";
            }
        }

        return Null;
    }

    function getUnion($name) {
        $typedefs = $this->array['typedefs'];
        $unions = $this->array['unions'];

        if (isset($typedefs[$name])) {
            $typedef_name = $typedefs[$name]['name'];
            if (isset($unions[$typedef_name])) {
                return $unions[$typedef_name];
            } else {
                echo "Union '$name' Not found\n";
            }
        } else {
            if (isset($unions[$name])) {
                return $unions[$name];
            } else {
                echo "Union '$name' Not found\n";
            }
        }
        return Null;
    }

}
