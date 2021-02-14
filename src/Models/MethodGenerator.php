<?php
/**
 * Zend Extension (https://github.com/Glash-Gnome)
 *
 * @link      https://github.com/Glash-Gnome/zend-ext for the canonical source repository
 * @copyright Copyright (c) 2021-2021 Glash. <5312910@php.net>
 * @license   GPL 3.0
 */

namespace Zend\Ext\Models;

//use Zend\Code\Generator\DocBlock\Tag;
//use Zend\Code\Generator\DocBlock\Tag\TagInterface;
//use Zend\Code\Generator\DocBlock\TagManager;
//use Zend\Code\Reflection\DocBlockReflection;
use Zend\Ext\Models\AbstractGenerator;
use Zend\Ext\Models\ParameterGenerator;


use function explode;
use function is_array;
use function sprintf;
use function str_replace;
use function strtolower;
use function trim;
use function wordwrap;

// my_object_class_init(const GObject &object)
class MethodGenerator extends AbstractGenerator
{

    /**
     * @var string
     */
    protected $name;
    /**
     * @var TypeGenerator
     */
    protected $type;
    protected $qualifier;
    protected $modifier;
    protected $pass='';// | '&' | '*'

    protected $isStatic = FALSE;
    protected $isVirtual = FALSE;
    protected $isOverride = FALSE;
    /**
     * @var Array of ParameterGenerator
     */
    protected $parameters = [];
    protected $objectName;// TODO remove, use parentGenerator




    /**
     * @var AbstractDocBlock
     */
    protected $docBlock;

    /**
     *
     */
    public function __construct($name=null)
    {
        if (isset($name)) {
            $this->setName($name);
        }
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setObjectName($objectName)
    {
        $this->objectName = $objectName;
        return $this;
    }

    public function getObjectName()
    {
        if ($this->objectName==NULL) {
            $this->objectName = $this->getParentGenerator()->getNamespaceName();
            $this->objectName .= $this->getParentGenerator()->getName();
        }
        return $this->objectName;
    }


    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * signed
     * unsigned
     * short
     * long
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;
        return $this;
    }

    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * const
     */
    public function setQualifier($qualifier)
    {
        $this->qualifier = $qualifier;
        return $this;
    }

    public function getQualifier()
    {
        return $this->qualifier;
    }

    /**
     * *
     * &
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }


    public function getParameters() {
        return $this->parameters;
    }

    /**
     * @param  array $parameters
     * @throws Exception\InvalidArgumentException
     * @return Zend\Ext\MethodGenerator
     */
    public function setParameters($parameters) {
        $len = count($parameters);
        for($i = 0; $i<$len; $i++) {
            $this->setParameter($parameters[$i]);
        }

        return $this;
    }


    /**
     * @param  ParameterGenerator|array|string $parameter
     * @throws Exception\InvalidArgumentException
     * @return Zend\Ext\MethodGenerator
     */
    public function setParameter($parameter)
    {
        if (is_string($parameter) || is_array($parameter)) {
            $parameter = new ParameterGenerator($parameter);
        }

        if (! $parameter instanceof ParameterGenerator) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s is expecting either a string, array or an instance of %s\ParameterGenerator',
                __METHOD__,
                __NAMESPACE__
            ));
        }

        $parameter->setParentGenerator($this);
        $this->parameters[$parameter->getName()] = $parameter;

        return $this;
    }

    /**
     * viewer-file.h
     * ViewerFile *viewer_file_new (void);
     *
     * @return string
     */
    public function generate_arginfo()
    {
        /*
ZEND_BEGIN_ARG_INFO(name, _unused)
ZEND_BEGIN_ARG_INFO_EX(name, _unused, return_reference, required_num_args=-1)

ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO(name, type, allow_null)
ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX(name, return_reference=0, required_num_args=-1, type, allow_null)

ZEND_BEGIN_ARG_WITH_RETURN_OBJ_INFO(name, class_name, allow_null)
ZEND_BEGIN_ARG_WITH_RETURN_OBJ_INFO_EX(name, return_reference=0, required_num_args=-1, class_name, allow_null)

-----------------------------
ZEND_ARG_INFO(pass_by_ref, name)
ZEND_ARG_PASS_INFO(pass_by_ref)
ZEND_ARG_OBJ_INFO(pass_by_ref, name, classname, allow_null) <- argument de type zend_object/GObject
ZEND_ARG_ARRAY_INFO(pass_by_ref, name, allow_null)
ZEND_ARG_CALLABLE_INFO(pass_by_ref, name, allow_null)

ZEND_ARG_TYPE_INFO(pass_by_ref, name, type_hint, allow_null)
ZEND_ARG_VARIADIC_INFO(pass_by_ref, name)
ZEND_ARG_VARIADIC_TYPE_INFO(pass_by_ref, name, type_hint, allow_null)
ZEND_ARG_VARIADIC_OBJ_INFO(pass_by_ref, name, classname, allow_null)

------------------------

ZEND_BEGIN_ARG_INFO(arginfo_gtk_window___construct, 0)
    //ZEND_ARG_INFO(0, factor)
    ZEND_ARG_TYPE_INFO_WITH_DEFAULT_VALUE(0, type, IS_LONG, 0, 0)
ZEND_END_ARG_INFO()

         */
        $output = '';

        $camelCaseToUnderscore = new \Zend\Filter\Word\CamelCaseToUnderscore();
        $stringToLower = new \Zend\Filter\StringToLower();

        $object = $this->getParentGenerator();
        $object_ns = str_replace('\\', '_', $object->getNamespaceName());
        $object_name = str_replace('\\', '_', $object->getName());
        $name = $object_name;
        if (!empty($object_ns)) {
            $name = $object_ns.'_'.$object_name;
        }
        $method_name = $stringToLower->filter($camelCaseToUnderscore->filter($this->getName()));
        $object_name = $stringToLower->filter($camelCaseToUnderscore->filter($name));

        $unused = 'NULL';//count($this->parameters);
        $output .= "ZEND_BEGIN_ARG_INFO(arginfo_{$object_name}_{$method_name}, $unused)" . self::LINE_FEED;

        foreach($this->getParameters() as $parameter) {
            $output .= $this->getIndentation()
                    . 'ZEND_ARG_INFO(' . $parameter->generate('arginfo') . ')' . self::LINE_FEED;
        }
        $output .= "ZEND_END_ARG_INFO()" . self::LINE_FEED;

        return $output;

    }


    public function generate_PHP_METHOD()
    {
        // TIME TO USE Naming\PHPStrategy();
        $camelCaseToUnderscore = new \Zend\Filter\Word\CamelCaseToUnderscore();
        $stringToLower = new \Zend\Filter\StringToLower();

        $tab = $this->getIndentation();
        $output = '';

        $obj = $this->getParentGenerator();
        $object_ns = $camelCaseToUnderscore->filter($obj->getNamespaceName());
        $object_name = $camelCaseToUnderscore->filter($obj->getName());
        $name = $object_name;
        if (!empty($object_ns)) {
            $name = $object_ns.'_'.$object_name;
        }

        $method_name = $stringToLower->filter($camelCaseToUnderscore->filter($this->getName()));
        $parameters = $this->getParameters();

        $output = '';
        $output .= '/*{{{ */' . self::LINE_FEED;

        $output .= "PHP_METHOD($name, $method_name)" . self::LINE_FEED;
        $output .= "{" . self::LINE_FEED;

        // TODO: hook PHP_METHOD declaration

        $num = count($parameters);
        if ($num) {
            $min_num_args=$num;
            $max_num_args=$num;
            foreach($parameters as $parameter) {
                if ($parameter->isOptional())
                    $min_num_args--;
            }
            $output .= $tab. "ZEND_PARSE_PARAMETERS_START($min_num_args, $max_num_args)" . self::LINE_FEED;
            foreach($parameters as $parameter) {
                if ($parameter->isOptional()) {
                    $output .= $tab. $tab . 'Z_PARAM_OPTIONAL' . self::LINE_FEED;
                }
                $output .= $tab. $tab;
                $name = $parameter->getName();
                $type = strtoupper($parameter->getType()->getName());
                $output .= "Z_PARAM_$type($name)";
                $output .= self::LINE_FEED;
            }
            $output .= $tab. "ZEND_PARSE_PARAMETERS_END();" . self::LINE_FEED;
            $output .= self::LINE_FEED;


            $output .= $tab. "if (ZEND_NUM_ARGS() > 0) {" . self::LINE_FEED;
            foreach($parameters as $parameter) {
                $output .= $tab. $tab;
                $name = $parameter->getName();
                $type = $parameter->getType()->getName();
                //TODO converte it to zend_property_type
                $output .= "zend_update_property_$type(";
                $output .= 'Z_OBJCE_P(ZEND_THIS), Z_OBJ_P(ZEND_THIS),'. self::LINE_FEED;
                $output .= $tab. $tab. $tab;
                $output .= "\"$name\", sizeof(\"$name\")-1, $name";
                $output .= ');' . self::LINE_FEED;

                $output .= self::LINE_FEED;
            }
            $output .= $tab. "}" . self::LINE_FEED;
        }

        // TODO: hook PHP_METHOD implementation

        $output .= "} ";
        $output .= '/*}}} */' . self::LINE_FEED;

        $output .= self::LINE_FEED;
        return $output;
    }
    /**
     * viewer-file.h
     * ViewerFile *viewer_file_new (void);
     *
     * @return string
     */
    public function generate_me()
    {
        /*
    PHP_ME(Gtk_Window,
        __construct,
        arginfo_gtk_window___construct,
        ZEND_ACC_PUBLIC)
         */
        $camelCaseToUnderscore = new \Zend\Filter\Word\CamelCaseToUnderscore();
        $stringToLower = new \Zend\Filter\StringToLower();

        $object = $this->getParentGenerator();
        $object_ns = str_replace('\\', '_', $object->getNamespaceName());
        $object_name = str_replace('\\', '_', $object->getName());
        $name = $object_name;
        if (!empty($object_ns)) {
            $name = $object_ns.'_'.$object_name;
        }

        $method_name = $stringToLower->filter($camelCaseToUnderscore->filter($this->getName()));
        $object_name = $stringToLower->filter($camelCaseToUnderscore->filter($name));

        $visibility = array(
            AbstractGenerator::VISIBILITY_PUBLIC=>"ZEND_ACC_PUBLIC",
            AbstractGenerator::VISIBILITY_PROTECTED=>"ZEND_ACC_PROTECTED",
            AbstractGenerator::VISIBILITY_PRIVATE=>"ZEND_ACC_PRIVATE",
        );
        $access = $visibility[$this->getVisibility()];

        return "PHP_ME($name, $method_name, arginfo_{$object_name}_{$method_name}, $access)";
    }
        /**
     * viewer-file.h
     * ViewerFile *viewer_file_new (void);
     *
     * @return string
     */
    public function generateHeader()
    {
        $output = '';// const unsigned char *argv[]
        $tab = str_repeat($this->getIndentation(), 1);

        $naming = new Naming\GnomeStrategy();
        $function_name = $naming->generateFunctionName($this);
        $type_name = $naming->generateTypeName($this->getParentGenerator());

        $output .= $this->getType() . self::LINE_FEED;
        $output .= $function_name . '(';
        $output .= $type_name . '* self';
        $glue = ', ';
        foreach ($this->parameters as $parameter) {
            $output .= $glue . $parameter->generate('header');
        }
        $output .= ', GError **error';
        $output .= ');' . self::LINE_FEED;

        return $output;
    }

    /**
     * void (*open) (ViewerFile  *self, GError **error);
     * @return string
     */
    public function generateHeaderBoiler()
    {
        $output = '';// const unsigned char *argv[]

        $camelCaseToUnderscore = new \Zend\Filter\Word\CamelCaseToUnderscore();
        $stringToLower = new \Zend\Filter\StringToLower();
        $object_name = $stringToLower->filter($camelCaseToUnderscore->filter($this->getName()));

        $output .= $this->getType() . ' ';
        $output .= '(*' . $object_name . ') (';
        $output .= $this->getObjectName() . '* self';
        $glue = ', ';
        for ($i=0; $i<count($this->parameters); $i++) {
            $parameter = $this->parameters[$i];
            $output .= $glue . $parameter->generate();
        }
        $output .= ');' . self::LINE_FEED;

        return $output;
    }

    /**
     * @return string
     */
    public function generateSourceBoiler()
    {
        $output = '';// const unsigned char *argv[]
        $tab = $this->getIndentation();
        /*
        $camelCaseToUnderscore = new \Zend\Filter\Word\CamelCaseToUnderscore();
        $stringToLower = new \Zend\Filter\StringToLower();
        $stringToUpper = new \Zend\Filter\StringToUpper();

        $objectClass;// DomNodeClass
        $objectCheck;// DOM_IS_NODE
        $objectCast;//DOM_NODE
        */

        $output .= $this->getType() . self::LINE_FEED;
        $namespaceName = $this->getParentGenerator()->getNamespaceName();
        $objectSimpleName = $this->getParentGenerator()->getName();
        $objectName = $this->getObjectName();
        $camelCaseToUnderscore = new \Zend\Filter\Word\CamelCaseToUnderscore();
        $stringToLower = new \Zend\Filter\StringToLower();
        $stringToUpper = new \Zend\Filter\StringToUpper();
        $object_name = $stringToLower->filter($camelCaseToUnderscore->filter($objectName));
        $OBJECT_NAME = $stringToUpper->filter($camelCaseToUnderscore->filter($objectName));
        $objectIsName = $stringToUpper->filter($camelCaseToUnderscore->filter($namespaceName));
        $objectIsName .= '_SI_' . $stringToUpper->filter($camelCaseToUnderscore->filter($objectSimpleName));
        $method_name = $stringToLower->filter($camelCaseToUnderscore->filter($this->getName()));

        $output .= $object_name . '_';
        $output .= $stringToLower->filter($camelCaseToUnderscore->filter($this->getName())) . '(';
        $output .= $this->getObjectName() . '* self';
        $glue = ', ';
        for ($i=0; $i<count($this->parameters); $i++) {
            $parameter = $this->parameters[$i];
            $output .= $glue . $parameter->generate('source');
        }
        $output .= ', GError **error';
        $output .= ') {' . self::LINE_FEED;
        $output .= $tab . $this->getObjectName() . 'Class *klass;' . self::LINE_FEED;
        $output .= $tab . self::LINE_FEED;
        $output .= $tab . 'g_return_if_fail(' . $objectIsName . '(self));' . self::LINE_FEED;
        $output .= $tab . 'g_return_if_fail (error == NULL || *error == NULL);' . self::LINE_FEED;
        $output .= $tab . self::LINE_FEED;
        $output .= $tab . 'klass = ' . $OBJECT_NAME . '_GET_CLASS (self);' . self::LINE_FEED;
        $output .= $tab . self::LINE_FEED;
        $output .= $tab . 'g_return_if_fail (klass->' . $method_name . ' != NULL);' . self::LINE_FEED;
        $output .= $tab . 'return klass->' . $method_name . ' (self, error);' . self::LINE_FEED;
        $output .= '}' . self::LINE_FEED;

        return $output;
    }

    /**
     * @return string
     */
    public function generateSource()
    {
        $output = '';// const unsigned char *argv[]
        $tab = str_repeat($this->getIndentation(), 1);

        $naming = new Naming\GnomeStrategy();
        $function_name = $naming->generateFunctionName($this);
        $type_name = $naming->generateTypeName($this->getParentGenerator());

        $output .= 'static ';
        $output .= $this->getType() . self::LINE_FEED;
        $output .= $function_name . '(';
        $output .= $type_name . '* self';
        $glue = ', ';
        foreach ($this->parameters as $parameter) {
            $output .= $glue . $parameter->generate('source');
        }
        $output .= ', GError **error';
        $output .= ') {' . self::LINE_FEED;
        $output .= '}' . self::LINE_FEED;

        return $output;
    }

    /**
     * @return string
     */
    public function generate($scope)
    {
        return parent::generate($scope);

        switch ($scope) {
            case 'header':
                return $this->generateHeader();
                break;
            case 'source':
                return $this->generateSource();
            default:
                break;
        }
        //echo $this->generateHeaderBoiler() . PHP_EOL;
        //echo $this->generateSourceBoiler() . PHP_EOL;

/*
        if ($this->getQualifier()!=null) {
            $output .= $this->getQualifier() . ' ';
        }
        if ($this->getModifier()!=null) {
            $output .= $this->getModifier() . ' ';
        }
        if ($this->getPass()!=null) {
            $output .= $this->getPass();
        }
*/
        return '';
    }
}
