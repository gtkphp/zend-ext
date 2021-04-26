<?php

namespace Zend\Ext\Views\C\Source\Helpers;

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
        TypeGenerator::PRIMITIVE_BOOL   =>'bool',
        TypeGenerator::PRIMITIVE_CHAR   =>'string',
        TypeGenerator::PRIMITIVE_SHORT  =>'int',
        TypeGenerator::PRIMITIVE_INT    =>'int',
        TypeGenerator::PRIMITIVE_FLOAT  =>'int',
        TypeGenerator::PRIMITIVE_LONG   =>'int',
        TypeGenerator::PRIMITIVE_DOUBLE =>'int',
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

    public function __invoke(TypeGenerator $type, $pass='')
    {
        $output = '';
        $name = $type->getName();

        if ($type->isPrimitive()) {
            $prime = $type->getPrimitiveType();
            $output = self::$internalPhpTypes[$prime];
        } else {
            $package = $type->getOwnPackage();
            $list_objects = $package->getListTypeObject();
            if (isset($list_objects[$name])) {
                return $name;
            }

            $output = 'mixed';
        }
        return $output;
    }
}