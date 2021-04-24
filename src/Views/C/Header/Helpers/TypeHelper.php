<?php

namespace Zend\Ext\Views\C\Header\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\TypeGenerator;


class TypeHelper extends AbstractHelper
{
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
    protected static $internalPhpTypes = [
        TypeGenerator::PRIMITIVE_VOID   =>'void',
        TypeGenerator::PRIMITIVE_BOOL   =>'zend_bool',
        TypeGenerator::PRIMITIVE_CHAR   =>'zend_string',
        TypeGenerator::PRIMITIVE_SHORT  =>'zend_long',
        TypeGenerator::PRIMITIVE_INT    =>'zend_long',
        TypeGenerator::PRIMITIVE_FLOAT  =>'zend_double',
        TypeGenerator::PRIMITIVE_LONG   =>'zend_long',
        TypeGenerator::PRIMITIVE_DOUBLE =>'double',
        TypeGenerator::PRIMITIVE_UCHAR  =>'zend_string',
        TypeGenerator::PRIMITIVE_USHORT =>'zend_long',
        TypeGenerator::PRIMITIVE_ULONG  =>'zend_long',
        TypeGenerator::PRIMITIVE_UINT   =>'zend_long',

        TypeGenerator::PRIMITIVE_STRING =>'zend_string',

        TypeGenerator::PRIMITIVE_INT8   =>'zend_long',
        TypeGenerator::PRIMITIVE_INT16  =>'zend_long',
        TypeGenerator::PRIMITIVE_INT32  =>'zend_long',
        TypeGenerator::PRIMITIVE_INT64  =>'zend_long',
        TypeGenerator::PRIMITIVE_UINT8  =>'zend_long',
        TypeGenerator::PRIMITIVE_UINT16 =>'zend_long',
        TypeGenerator::PRIMITIVE_UINT32 =>'zend_long',
        TypeGenerator::PRIMITIVE_UINT64 =>'zend_long',

        TypeGenerator::PRIMITIVE_POINTER=>'zval',// StdClass
    ];

    public function __invoke(TypeGenerator $type, $pass='*')
    {
        $output = '';
        $name = $type->getName();
        //echo 'type.name: ', $name, PHP_EOL;
        //echo '     type: ', $type->getPrimitiveType(), PHP_EOL;
        // check if void,
        // check if internal php type primitive

        if ($type->isPrimitive()) {
            //$output = ': ' . "\e[3;34m".self::$internalPhpTypes[$type->getPrimitiveType()]."\e[m";
            $prime = $type->getPrimitiveType();
            $output = self::$internalPhpTypes[$prime];
            return $prime==TypeGenerator::PRIMITIVE_POINTER ? $output.' '.$pass : $output.' ';
            //return 'zval '.$pass;
        } else {
            // check if is an known type
            $package = $type->getOwnPackage();
            $list_objects = $package->getListTypeObject();
            if (isset($list_objects[$name])) {
                $ns = $package->getName();
                $type_ns = $this->getView()->namespaceHelper($name);
                $name = $this->getView()->nameclassHelper($name);
                if ($ns!=$type_ns) {
                    $name = 'php_'.$name .' *';// green
                    //$name = $type_ns . '\\' . $name;// green
                    //$name = $type_ns . '\\' . "\e[2;32m".$name."\e[m";// green
                } else {
                    $name = "php_".strtolower($name).' *';
                }
                $output = $name;
                return $output;
            }
            $list_enums = $package->getListTypeEnum();
            if (in_array($name, $list_enums)) {
                //$name = "\e[2;34m".'int'."\e[m";// yellow
                return 'int';
            }

            if ($name=='gconstpointer' || $name=='gpointer') {
                return 'zval '.$pass;
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

                $output = "\e[1;31m".$name."\e[m";// red
                $output = "callback ";// red
                $output = "zval *";// red
            }

            //$list_boxeds = $package->getListTypeBoxed();
            //$list_interfaces = $package->getListTypeInterface();
            /*
            $list_enums = $package->getListTypeEnum();
            if (in_array($name, $list_enums)) {
                $output = ': ' . "\e[1;31m".$name."\e[m#TODO";// red
            }
            */

        }
        return $output;
    }
}
