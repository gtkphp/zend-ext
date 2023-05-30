<?php

namespace ZendExt\Dto\Stub;

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

        $dto->filename = $fileGenerator->getFilename() . '.php';

        $namespace = ucwords($namespace, '/');
        $dto->namespace = str_replace('/', '\\', $namespace);

        $dataModel = new \Zend\Ext\View\Model\CodeGeneratorModel();
        $dataModel->setTemplate('ClassDto.php');
        $dataModel->setCodeGenerator($fileGenerator);

        $dto->class = $renderer->transfer($dataModel);

        return $dto;
    }

}
