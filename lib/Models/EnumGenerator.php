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

class EnumGenerator extends AbstractGenerator
{

    /**
     * @var array $constants array('CONST_A'=>0x00, 'CONST_B'=>0x03, ...)
     */
    protected $constants=[];

    /**
     * @return array
     */
    public function getConstants(): array
    {
        return $this->constants;
    }

    /**
     * @param array $constants
     * @return EnumGenerator
     */
    public function setConstants(array $constants): EnumGenerator
    {
        $this->constants = $constants;
        return $this;
    }



}