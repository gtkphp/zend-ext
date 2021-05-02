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
use PHPUnit\Runner\Exception;
use Zend\Ext\Models\AbstractGenerator;

use Zend\Ext\Models\TypeGenerator;

use function explode;
use function is_array;
use function sprintf;
use function str_replace;
use function strtolower;
use function trim;
use function wordwrap;

class TagGenerator extends AbstractGenerator
{
    const TAG_OWNER = 0x01;
    const TAG_FLAG = 0x02;
    const TAG_ALLOWED_VALUES = 0x03;
    const TAG_DEFAULT_VALUE = 0x04;
    const TAG_SINCE = 0x05;

    /**
     * One of constant TAG_X
     * @var int $type
     */
    protected $type=-1;

    /**
     * @var string
     */
    protected $value='';

    /**
     * @param string $name 'Owner', 'Flags', 'Allowed values', 'Default value', 'Since'
     * Owner: 'GtkWidget'
     * Flags: 'Read' | 'Read / Write'
     * Allowed values: '>= -1' | '[0,32767]' | [0,1] ...
     * Default values: 'GTK_ALIGN_FILL' | '0' | 'FALSE' | "\001\001" | ...
     * Since: '3.0' | '2.10' | ...
     */
    public function __construct($name)
    {
        parent::__construct($name);
        switch ($name) {
            case 'Owner':
                $this->setType(self::TAG_OWNER);
                break;
            case 'Flags':
                $this->setType(self::TAG_FLAG);
                break;
            case 'Allowed values':
                $this->setType(self::TAG_ALLOWED_VALUES);
                break;
            case 'Default value':
                $this->setType(self::TAG_DEFAULT_VALUE);
                break;
            case 'Since':
                $this->setType(self::TAG_SINCE);
                break;
            default:
                echo 'Unexcpected Tag "'.$name.'"'.PHP_EOL;
        }
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
     * @return bool
     */
    public function setValue($value)
    {
        switch ($this->type) {
            case self::TAG_OWNER:
            case self::TAG_FLAG:
            case self::TAG_ALLOWED_VALUES:
            case self::TAG_DEFAULT_VALUE:
            case self::TAG_SINCE:
            default:
                $this->value = $value;
                break;
        }

        return $this;
    }

    /**
     * @param bool $isConst
     */
    public function getValue()
    {
        $this->value;
    }

    /**
     * TODO: 
     */
    public function isWrite():bool
    {
        return true;
    }


}