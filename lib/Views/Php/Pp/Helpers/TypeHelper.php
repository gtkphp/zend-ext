<?php

namespace Zend\Ext\Views\Php\Pp\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\TypeGenerator;


class TypeHelper extends AbstractHelper
{
    static public $filter = NULL;

    // correspondance entre Model->PHP
    /* php have ten primitive type
     *  'void',
     *  'int',
     *  'float',
     *  'string',
     *  'bool',
     *  'array',      <= int var[], GArray, etc...
     *  'callable',   <= void (*call)(void);GCallback, ...
     *  'iterable',   <= int var[]...
     *  'object'      <= (void*), GObject, ...
    */
    private static $internalPhpTypes = [
        TypeGenerator::PRIMITIVE_VOID   =>'void',
        TypeGenerator::PRIMITIVE_BOOL   =>'bool',
        TypeGenerator::PRIMITIVE_CHAR   =>'string',
        TypeGenerator::PRIMITIVE_SHORT  =>'int',
        TypeGenerator::PRIMITIVE_INT    =>'int',
        TypeGenerator::PRIMITIVE_FLOAT  =>'float',
        TypeGenerator::PRIMITIVE_LONG   =>'int',
        TypeGenerator::PRIMITIVE_DOUBLE =>'float',
        TypeGenerator::PRIMITIVE_UCHAR  =>'string',
        TypeGenerator::PRIMITIVE_USHORT =>'int',
        TypeGenerator::PRIMITIVE_ULONG  =>'int',
        TypeGenerator::PRIMITIVE_UINT   =>'int',

        TypeGenerator::PRIMITIVE_STRING =>'string',

        TypeGenerator::PRIMITIVE_INT8   =>'int',
        TypeGenerator::PRIMITIVE_INT16  =>'int',
        TypeGenerator::PRIMITIVE_INT32  =>'int',
        TypeGenerator::PRIMITIVE_INT64  =>'int',
        TypeGenerator::PRIMITIVE_UINT8  =>'int',
        TypeGenerator::PRIMITIVE_UINT16 =>'int',
        TypeGenerator::PRIMITIVE_UINT32 =>'int',
        TypeGenerator::PRIMITIVE_UINT64 =>'int',

        TypeGenerator::PRIMITIVE_POINTER=>'mixed',// StdClass
    ];

    public function __invoke(TypeGenerator $type, $doc=False)
    {
        $output = '';
        $name = $type->getName();
        // if isPrototype()
        // check if void,
        // check if internal php type primitive
        if ('cairo_bool_t'==$name) {
            return 'bool';
        }

        if ($type->isPrimitive()) {
            //$output = ': ' . "\e[3;34m".self::$internalPhpTypes[$type->getPrimitiveType()]."\e[m";
            $output = self::$internalPhpTypes[$type->getPrimitiveType()];
            return $output;
        } else {
            // check if is an known type
            $package = $type->getOwnPackage();
            $list_objects = $package->getListTypeObject();
            if (isset($list_objects[$name])) {
                /*
                $ns = $package->getName();
                $type_ns = $this->getView()->namespaceHelper($name);
                $name = $this->getView()->nameclassHelper($name);
                if ($ns!=$type_ns) {
                    $name = $type_ns . '\\' . "\e[2;32m".$name."\e[m";// green
                } else {
                    // TODO remove
                    $name = "\e[2;33m".$name."\e[m";// yellow
                }
                $output = $name;
                return $output;
                */
                return $name;
            }
            $list_enums = $package->getListTypeEnum();
            if (array_key_exists($name, $list_enums)) {
                return 'int';
            }
            if ($type->isPrototype() && $doc) {
                $data = $type->getPrototype();
                //print_r($data);
                $param = '';
                $glue = '';
                $returnType = new TypeGenerator($data['return']['type']);
                $return = $this->getView()->typeHelper($returnType);
                foreach($data['parameters'] as $parameter) {
                    $paramType = new TypeGenerator($parameter['type']);
                    $paramType->setParentGenerator($type->getParentGenerator());
                    $param .= $glue . $this->getView()->typeHelper($paramType, True);
                    $glue = ', ';
                }
                return "callback($param): $return";
            }

            {
                // GdkWindowTypeHint
                // GdkModifierType
                // GList
                // GdkGravity

                // gtk_window_get_icon_list (): GList => array(0=>GIvonList)
                // GList( extern) => G\List => array
                // GdkScreen( extern)
                // GdkGravity
                // GdkModifierType
                // GtkWidget (prerequist)
                // GtkApplication(prerequist) add use ...
                // GtkWindowType (enum)

                $output = $name;
            }

            //$list_boxeds = $package->getListTypeBoxed();
            //$list_interfaces = $package->getListTypeInterface();
            /*
            $list_enums = $package->getListTypeEnum();
            if (in_array($name, $list_enums)) {
                $output = ': ' . "\e[1;31m".$name."\e[m#TODO";// red
            }
            */
            if ($name=='gconstpointer' || $name=='gpointer') {
                if ($doc==False) {
                    return '';
                } else {
                    return 'mixed';
                }
            }

        }
        return $output;
    }
}
