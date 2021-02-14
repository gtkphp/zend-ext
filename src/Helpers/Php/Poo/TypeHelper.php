<?php

namespace Zend\Ext\Helpers\Php\Poo;

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
    ];

    public function __invoke(TypeGenerator $type)
    {
        $output = '';
        $name = $type->getName();
        // check if void,
        // check if internal php type primitive

        if ($type->isPrimitive()) {
            $output = ': ' . "\e[3;34m".self::$internalPhpTypes[$type->getPrimitiveType()]."\e[m";
            return $output;
        } else {
            // check if is an known type
            $package = $type->getOwnPackage();
            $list_objects = $package->getListTypeObject();
            if (in_array($name, $list_objects)) {
                $ns = $package->getName();
                $type_ns = $this->getView()->namespaceHelper($name);
                $name = $this->getView()->nameclassHelper($name);
                if ($ns!=$type_ns) {
                    $name = $type_ns . '\\' . "\e[2;32m".$name."\e[m";// green
                } else {
                    // TODO remove
                    $name = "\e[2;33m".$name."\e[m";// yellow
                }
                $output = ': ' . $name;
                return $output;
            }
            $list_enums = $package->getListTypeEnum();
            if (in_array($name, $list_enums)) {
                //$name = "\e[2;34m".'int'."\e[m";// yellow
                return 'int';
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

                $output = ': ' . "\e[1;31m".$name."\e[m#TODO";// red
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
