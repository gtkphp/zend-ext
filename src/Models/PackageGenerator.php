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

class PackageGenerator extends AbstractGenerator
{

    /**
     * @var string
     */
    protected $name;
    /**
     * @var array $list_type_object array('GtkWidget', 'GtkBin', ...)
     */
    protected $list_type_object;
    /**
     * @var array $list_type_enum array('GtkWindowType', ...)
     */
    protected $list_type_enum;

    /**
     *
     */
    public function __construct($name)
    {
        parent::__construct(NULL);
        $this->setName($name);
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

    /**
     * @return array
     */
    public function getListTypeObject(): array
    {
        return $this->list_type_object;
    }

    /**
     * @param array $list_type_object
     * @return PackageGenerator
     */
    public function setListTypeObject(array $list_type_object): PackageGenerator
    {
        $this->list_type_object = $list_type_object;
        return $this;
    }


    /**
     * @return array
     */
    public function getListTypeEnum(): array
    {
        return $this->list_type_enum;
    }

    /**
     * @param array $list_type_enum
     * @return PackageGenerator
     */
    public function setListTypeEnum(array $list_type_enum): PackageGenerator
    {
        $this->list_type_enum = $list_type_enum;
        return $this;
    }

}