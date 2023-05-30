<?php

namespace ZendExt\Dto\Ext\Header;


use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\GenericTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\ParamTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\ReturnTag;
use Zend\Ext\Models\Code\Generator\MethodGenerator;

use ZendExt\Dto\Stub\FunctionDto as BaseFunctionDto;
use ZendExt\Dto\Stub\ArgumentsDto;


class MethodDto extends BaseFunctionDto
{
    static public function create($codeGenerator, $renderer)
    {
        /** @var MethodGenerator $methodGenerator */
        $methodGenerator = $codeGenerator;

        /** @var ClassGenerator $classGenerator */
        $dto = new self();
        $dto->name = $methodGenerator->getNickName();

        $dto->arguments = $renderer->transfer('ArgumentsDto.php', $methodGenerator);

        $returnsGenerator = $methodGenerator->getReturnType();
        if (!$returnsGenerator || 'void'==$returnsGenerator) {
            $dto->returns = '';
        } else {
            $dto->returns = ':'.$returnsGenerator->generate();
        }
        
        $docBlockGenerator = $methodGenerator->getDocBlock();
        if ($docBlockGenerator) {
            $docBlockGenerator->setIndentation('    ');
            BaseFunctionDto::formatDescription($docBlockGenerator);
    
            $dto->dockBlock = $docBlockGenerator?$docBlockGenerator->generate():'';
        } else {
            $dto->dockBlock = '';
        }

        return $dto;
    }
}
