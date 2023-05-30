<?php

namespace ZendExt\Dto;

use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\FileGenerator;
use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\LicenseTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\AuthorTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\GenericTag;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;

use ZendExt\Dto\ClassDto;


class FileDto
{
    public $pathname;
    public $filename;
    public $namespace;

    /** @var ClassDto */
    public $class;
    
    static public function create($codeGenerator, $renderer)
    {
        return new self();
    }

}
