<?php
/**
 * Zend Extension (https://github.com/Glash-Gnome)
 *
 * @link      https://github.com/Glash-Gnome/zend-ext for the canonical source repository
 * @copyright Copyright (c) 2021-2021 Glash. <5312910@php.net>
 * @license   GPL 3.0
 */


namespace Zend\Ext\Models;

use Zend\Ext\Models\AbstractGenerator;


class TypeGenerator extends AbstractGenerator
{
    // C types
    const PRIMITIVE_VOID   = 0x00;
    const PRIMITIVE_BOOL   = 0x01;
    const PRIMITIVE_CHAR   = 0x02;
    const PRIMITIVE_SHORT  = 0x03;
    const PRIMITIVE_INT    = 0x04;
    const PRIMITIVE_FLOAT  = 0x05;
    const PRIMITIVE_LONG   = 0x06;
    const PRIMITIVE_DOUBLE = 0x07;
    const PRIMITIVE_UCHAR  = 0x08;
    const PRIMITIVE_USHORT = 0x09;
    const PRIMITIVE_ULONG  = 0x10;
    const PRIMITIVE_UINT   = 0x11;

    const PRIMITIVE_STRING = 0x12;

    const PRIMITIVE_INT8   = 0x13;
    const PRIMITIVE_INT16  = 0x14;
    const PRIMITIVE_INT32  = 0x15;
    const PRIMITIVE_INT64  = 0x16;
    const PRIMITIVE_UINT8  = 0x17;
    const PRIMITIVE_UINT16 = 0x18;
    const PRIMITIVE_UINT32 = 0x19;
    const PRIMITIVE_UINT64 = 0x20;


    // correspondance entre C->Model

    private static $internalCTypes = [
        'void'                => self::PRIMITIVE_VOID,

        //'gpointer'            => self::PRIMITIVE_OBJECT?,

        /*
        typedef char   gchar;
        typedef short  gshort;
        typedef long   glong;
        typedef int    gint;
        typedef gint   gboolean;

        typedef unsigned char   guchar;
        typedef unsigned short  gushort;
        typedef unsigned long   gulong;
        typedef unsigned int    guint;

        typedef float   gfloat;
        typedef double  gdouble;
        */
        'gboolean'            => self::PRIMITIVE_BOOL,
        'gchar'               => self::PRIMITIVE_CHAR,
        'gshort'              => self::PRIMITIVE_SHORT,
        'gint'                => self::PRIMITIVE_INT,
        'gfloat'              => self::PRIMITIVE_FLOAT,
        'glong'               => self::PRIMITIVE_LONG,
        'gdouble'             => self::PRIMITIVE_DOUBLE,

        'guchar'              => self::PRIMITIVE_UCHAR,
        'gushort'             => self::PRIMITIVE_USHORT,
        'gulong'              => self::PRIMITIVE_ULONG,
        'guint'               => self::PRIMITIVE_UINT,

        /*
         * GString
         * char*
         * char[]
         */
        'GString' => self::PRIMITIVE_STRING,
        'char*' => self::PRIMITIVE_STRING,

        /*
        typedef signed char gint8;
        typedef unsigned char guint8;
        typedef signed short gint16;
        typedef unsigned short guint16;

        typedef signed int gint32;
        typedef unsigned int guint32;

        typedef signed long gint64;
        typedef unsigned long guint64;
        */

        'gint8'               => self::PRIMITIVE_INT8,
        'gint16'              => self::PRIMITIVE_INT16,
        'gint32'              => self::PRIMITIVE_INT32,
        'gint64'              => self::PRIMITIVE_INT64,

        'guint8'              => self::PRIMITIVE_UINT8,
        'guint16'             => self::PRIMITIVE_UINT16,
        'guint32'             => self::PRIMITIVE_UINT32,
        'guint64'             => self::PRIMITIVE_UINT64
    ];

    /**
     * @var bool
     */
    protected $name;
    protected $isArray=False;
    protected $isPrimitive=False;
    protected $primitiveType=NULL;
    protected $expressionArray;

    /**
     *
     */
    public function __construct($name)
    {
        //parent::__construct($name);
        $this->setName($name);
    }

    public function setName($name)
    {
        $this->name = $name;
        $types = array_keys(self::$internalCTypes);
        if (in_array($name, $types)) {
            $this->isPrimitive = TRUE;
            $this->primitiveType = self::$internalCTypes[$name];
        }

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setArray($isArray=True)
    {
        $this->isArray = $isArray;
        return $this;
    }

    public function isArray()
    {
        return $this->isArray;
    }
    /**
     * @return int
     */
    public function getPrimitiveType()
    {
        return $this->primitiveType;
    }

    /**
     * @param null $primitiveType
     * @return TypeGenerator
     */
    public function setPrimitiveType($primitiveType)
    {
        $this->primitiveType = $primitiveType;
        return $this;
    }

    public function setExpressionArray($expressionArray)
    {
        $this->expressionArray = $expressionArray;
        return $this;
    }

    public function getExpressionArray()
    {
        return $this->expressionArray;
    }

    public function isPrimitive()
    {
        return $this->isPrimitive;
    }


    /**
     * @return string
     */
    public function generate_arginfo()
    {
        return $this->getParentGenerator()->getName();
    }
    /**
     * @return string
     */
    public function generate($scope)
    {
        $output = '';// const unsigned char *argv[3]

        $output .= $this->getName();

        /*
        if ($this->isArray()) {
            $output .= '[';
            if ($this->expressionArray!=NULL) {
                $output .= $this->expressionArray;
            }
            $output .= ']';
        }
        */

        return $output;
    }

}