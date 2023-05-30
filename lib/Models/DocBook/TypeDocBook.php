<?php
/**
 * Zend Extension (https://github.com/Glash-Gnome)
 *
 * @link      https://github.com/Glash-Gnome/zend-ext for the canonical source repository
 * @copyright Copyright (c) 2021-2021 Glash. <5312910@php.net>
 * @license   GPL 3.0
 */


namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;


class TypeDocBook extends AbstractDocBook
{
    /** @var string $php_type Type of php */
    public $php_type;

    // TODO grouper en fonction du type zend resultant( INT8, INT16,..)
    // C types
    const PRIMITIVE_VOID   = 0;
    const PRIMITIVE_BOOL   = 1;
    const PRIMITIVE_CHAR   = 2;
    const PRIMITIVE_SHORT  = 3;
    const PRIMITIVE_INT    = 4;
    const PRIMITIVE_FLOAT  = 5;
    const PRIMITIVE_LONG   = 6;
    const PRIMITIVE_DOUBLE = 7;
    const PRIMITIVE_UCHAR  = 8;
    const PRIMITIVE_USHORT = 9;
    const PRIMITIVE_ULONG  = 10;
    const PRIMITIVE_UINT   = 11;

    const PRIMITIVE_STRING = 12;

    const PRIMITIVE_INT8   = 13;
    const PRIMITIVE_INT16  = 14;
    const PRIMITIVE_INT32  = 15;
    const PRIMITIVE_INT64  = 16;
    const PRIMITIVE_UINT8  = 17;
    const PRIMITIVE_UINT16 = 18;
    const PRIMITIVE_UINT32 = 19;
    const PRIMITIVE_UINT64 = 20;

    const PRIMITIVE_POINTER = 21;

    // correspondance entre C->Model

    /** @var string $name */
    protected $name;

    public static $primitiveTypes = [
        'void',
        'bool',
        'string',
        'int',
        'int',
        'float',
        'int',
        'float',
        'string',
        'string',
        'int',
        'int',
    
        'string',
    
        'int',
        'int',
        'int',
        'int',
        'int',
        'int',
        'int',
        'int',
    
        'object',
    ];

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
        'guint64'             => self::PRIMITIVE_UINT64,

        'gpointer'            => self::PRIMITIVE_POINTER,

        'int'                 => self::PRIMITIVE_INT,
        'double'              => self::PRIMITIVE_DOUBLE,
        'char'                => self::PRIMITIVE_CHAR,
        'unsigned int'        => self::PRIMITIVE_INT,
        'unsigned long'       => self::PRIMITIVE_INT,
        'long'                => self::PRIMITIVE_INT,
        
    ];

    /**
     * @var bool
     */
    //protected $isUnion=False;
    //protected $isStruct=False;
    protected $isAnonymous=false;
    protected $isArray=False;
    protected $isPrimitive=False;
    protected $isPrototype=False;
    protected $prototype=array();
    protected $primitiveType=NULL;
    protected $expressionArray;

    static public $anonymous = 0; 
    public $anony_definition = null;

    public function isAnonymous(bool $isAnonymous=null)
    {
        if (is_null($isAnonymous)) {
            return $this->isAnonymous;
        }
        $this->isAnonymous = $isAnonymous;
        return $this;
    }

    static public function Create(string $name, $parent=null)
    {
        $type = new TypeDocBook($parent);
        $type->setName($name);
        return $type;
    }

    // not more used
    static public function CreateAnonymous($parent=null)
    {
        $name = '@anonymous#'.(self::$anonymous++);
        $type = new TypeDocBook($parent);
        $type->setName($name);
        $type->isAnonymous = true;
        return $type;
    }

    /**
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string $name
     */
    public function setName($name)
    {
        /*
        if (empty($name)) {
            $this->primitiveType = self::PRIMITIVE_VOID;
            $this->isPrimitive = True;
        } else if (isset(self::$internalCTypes[$name])) {
            $this->primitiveType = self::$internalCTypes[$name];
            $this->isPrimitive = True;
        } else {
            // TODO parse
            $this->primitiveType = self::PRIMITIVE_POINTER;
            $this->isPrimitive = False;
        }*/

        $this->name = $name;
    }
    
    public function getTypePhp($isArray=True)
    {
        if ('object'==$this->php_type) {
            return $this->name;
        } else if ('enum'==$this->php_type) {
            return $this->name;
        } else if ('union'==$this->php_type) {
            return $this->name;
        }

        return $this->php_type;
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
     * @return TypeDocBook
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
     * @return bool
     public function isPrototype(): bool
     {
         return $this->isPrototype;
        }
        */

    /**
     * @param bool $isPrototype
     * @return TypeDocBook
     public function setIsPrototype(bool $isPrototype): TypeDocBook
     {
         $this->isPrototype = $isPrototype;
         return $this;
        }
        */

    /**
     * @return array
     public function getPrototype(): array
     {
         return $this->prototype;
        }
        */

    /**
     * @param array $prototype
     * @return TypeDocBook
     public function setPrototype(array $prototype): TypeDocBook
     {
         $this->prototype = $prototype;
         return $this;
        }
        */

    function __toString():string { 
        $output = '';
        if (isset(self::$primitiveTypes[$this->primitiveType])) {
            $output .= $this->name . ' : ' . self::$primitiveTypes[$this->primitiveType];
        } else {
            $output .= $this->name;
        }
        return $output;
    }
}
