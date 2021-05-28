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

/**
 * see https://wiki.gnome.org/action/show/Projects/GObjectIntrospection/Annotations?action=show&redirect=GObjectIntrospection%2FAnnotations
 */
class AnnotationGenerator extends AbstractGenerator
{
    const ANNOTATION_ARRAY = 0x01;
    const ANNOTATION_CLOSURE = 0x02;
    const ANNOTATION_DESTROY = 0x03;
    const ANNOTATION_ELEMENT_TYPE = 0x04;
    const ANNOTATION_INOUT = 0x05;
    const ANNOTATION_NOT = 0x06;
    const ANNOTATION_NOT_NULLABLE = 0x07;
    const ANNOTATION_NOT_OPTIONAL = 0x08;
    const ANNOTATION_NULLABLE = 0x09;
    const ANNOTATION_OPTIONAL = 0x0A;
    const ANNOTATION_OUT = 0x0B;
    const ANNOTATION_OUT_CALLEE_ALLOCATES = 0x0C;// Check this
    const ANNOTATION_OUT_CALLER_ALLOCATES = 0x0D;
    const ANNOTATION_RENAME_TO = 0x0E;
    const ANNOTATION_SCOPE = 0x0F;
    const ANNOTATION_SCOPE_CALL = 0x10;
    const ANNOTATION_SCOPE_NOTIFIED = 0x11;
    const ANNOTATION_SKIP = 0x12;
    const ANNOTATION_TRANSFER = 0x13;
    const ANNOTATION_TRANSFER_CONTAINER = 0x14;
    const ANNOTATION_TRANSFER_FLOATING = 0x15;
    const ANNOTATION_TRANSFER_FULL = 0x16;
    const ANNOTATION_TRANSFER_NONE = 0x17;
    const ANNOTATION_TYPE = 0x18;
    /**
     * One of constant ANNOTATION_XXX
     * @var int $type
     */
    protected $type=-1;
    protected $attributes=[];

    static public function Factory($acronym)
    {
        $type = -1;
        $annotation = null;
        switch ($acronym) {
            case 'array':                $type = self::ANNOTATION_ARRAY; break;
            case 'closure':              $type = self::ANNOTATION_CLOSURE; break;
            case 'destroy':              $type = self::ANNOTATION_DESTROY; break;
            case 'element-type':         $type = self::ANNOTATION_ELEMENT_TYPE; break;
            case 'inout':                $type = self::ANNOTATION_INOUT; break;
            case 'not':                  $type = self::ANNOTATION_NOT; break;
            //case 'not nullable':         $type = self::ANNOTATION_NOT_NULLABLE; break;
            //case 'not optional':         $type = self::ANNOTATION_NOT_OPTIONAL; break;
            case 'nullable':             $type = self::ANNOTATION_NULLABLE; break;
            case 'optional':             $type = self::ANNOTATION_OPTIONAL; break;
            case 'out':                  $type = self::ANNOTATION_OUT; break;
            //case 'out callee-allocates': $type = self::ANNOTATION_OUT_CALLEE_ALLOCATES; break;
            //case 'out caller-allocates': $type = self::ANNOTATION_OUT_CALLER_ALLOCATES; break;
            case 'rename-to':            $type = self::ANNOTATION_RENAME_TO; break;
            case 'scope':                $type = self::ANNOTATION_SCOPE; break;
            //case 'scope call':           $type = self::ANNOTATION_SCOPE_CALL; break;
            //case 'scope notified':       $type = self::ANNOTATION_SCOPE_NOTIFIED; break;
            case 'skip':                 $type = self::ANNOTATION_SKIP; break;
            case 'transfer':             $type = self::ANNOTATION_TRANSFER; break;
            //case 'transfer container':   $type = self::ANNOTATION_TRANSFER_CONTAINER; break;
            //case 'transfer floating':    $type = self::ANNOTATION_TRANSFER_FLOATING; break;
            //case 'transfer full':        $type = self::ANNOTATION_TRANSFER_FULL; break;
            //case 'transfer none':        $type = self::ANNOTATION_TRANSFER_NONE; break;
            case 'type':                 $type = self::ANNOTATION_TYPE; break;
            case '' :                    $type = 0; break;
            default:
                echo 'Unexpected annotion acronym "'.$acronym.'"'.PHP_EOL;
                break;
        }
        if ($type>0) {
            $annotation = new AnnotationGenerator($acronym);
            $annotation->setType($type);
        }
        return $annotation;
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

    public function setParam(string $param)
    {
        $parts = explode('=', $param);
        if (count($parts)==2) {
            $this->attributes[$parts[0]] = $parts[1];
        } else if(count($parts)==1) {
            $this->attributes[$parts[0]] = $parts[0];
        } else {
            echo "Unexpected annotation attribute format\n";
        }
    }
    public function hasAttribute(string $name):bool {
        return isset($this->attributes[$name]);
    }
    public function getAttribute(string $name):string {
        return $this->attributes[$name];
    }

}
