<?php

namespace ZendExt\Dto\Ext\Source;

use ZendExt\Dto\FileDto as BaseFileDto;
use ZendExt\Dto\Ext\Header\ClassDto;

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


class FileDto extends BaseFileDto
{
    static public function create($codeGenerator, $renderer)
    {
        /** @var FileGenerator $fileGenerator */
        $fileGenerator = $codeGenerator;

        $dto = new FileDto();
        
        $namespace = $fileGenerator->getNamespace();// namespace Vendor/Cairo;

        $dto->pathname = 'php_' . $namespace . '/';

        $dto->filename = $fileGenerator->getFilename() . '.c';

        $namespace = ucwords($namespace, '/');
        $dto->namespace = str_replace('/', '\\', $namespace);

        if ($fileGenerator->hasClass()) {
            $dto->class = $renderer->transfer('ClassDto.php', $fileGenerator);
        } else if ($fileGenerator->hasEnum()) {
            $dto->class = $renderer->transfer('EnumDto.php', $fileGenerator);
        } else {
            $dto->class = $renderer->transfer('AliasClassDto.php', $fileGenerator);
        }


        return $dto;
    }
}
