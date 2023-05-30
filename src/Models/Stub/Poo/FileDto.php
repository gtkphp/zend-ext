<?php

namespace ZendExt\Dto\Stub\Poo;

use ZendExt\Dto\FileDto as BaseFileDto;
use ZendExt\Dto\Stub\ClassDto;

use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\FileGenerator;


class FileDto extends BaseFileDto
{
    static public function create($codeGenerator, $renderer)
    {
        $dto = new self();

        // @var ClassGenerator $classGenerator
        $fileGenerator = $codeGenerator;
        $classGenerator = $fileGenerator->getClass();
        
        $namespace = $fileGenerator->getNamespace();// namespace Vendor/Cairo;

        //$dto->pathname = ucfirst($namespace)  . '/';
        $dto->pathname = 'php_' . $namespace . '/';

        //Zend\Ext\Services\Classifier\Cairo::DasheToPascale
        $dto->filename = self::DasheToPascale($fileGenerator->getFilename()) . '.php';

        $namespace = ucwords($namespace, '/');
        $dto->namespace = str_replace('/', '\\', $namespace);

        $dto->class = $renderer->transfer('ClassDto.php', $fileGenerator);

        return $dto;
    }

    /**
     * use Classifier|Naming
     * dashe-case to PascaleCase
     */
    public static function DasheToPascale(string $name):string {
        return ucfirst(str_replace('-', '', ucwords($name, '-')));
    }

}
