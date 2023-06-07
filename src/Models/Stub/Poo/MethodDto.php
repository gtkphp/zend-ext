<?php

namespace ZendExt\Dto\Stub\Poo;

use Zend\Ext\Services\Classifier\Cairo as GnomeClassifier;

use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\GenericTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\ParamTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\ReturnTag;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use ZendExt\Dto\Stub\FunctionDto as BaseFunctionDto;
use ZendExt\Dto\Stub\FunctionArgsDto;


class MethodDto extends BaseFunctionDto
{
    static public function create($codeGenerator, $renderer)
    {
        /** @var MethodGenerator $methodGenerator */
        $methodGenerator = $codeGenerator;

        /** @var ClassGenerator $classGenerator */
        $dto = new self();
        $dto->name = GnomeClassifier::SnakeToCamel($methodGenerator->getNickName());

        $dto->arguments = $renderer->transfer('FunctionArgsDto.php', $methodGenerator);

        
        $returnsGenerator = $methodGenerator->getReturnType();
        if (!$returnsGenerator || 'void'==$returnsGenerator) {
            $dto->returns = '';
        } else {
            //$dto->returns = ':'.$returnsGenerator->generate();
            $nullable = $returnsGenerator->nullable() ? '?' : '';
            $dto->returns = ':' . $nullable . $renderer->transfer('TypeDto.php', $returnsGenerator)->name;
        }
        
        $docBlockGenerator = $methodGenerator->getDocBlock();
        $docBlockGenerator->setIndentation('    ');
        self::formatDescription2($docBlockGenerator, $renderer);

        $dto->dockBlock = $docBlockGenerator?$docBlockGenerator->generate():'';

        return $dto;
    }

    static public function formatDescription2(DocBlockGenerator $docBlockGenerator, $renderer) {
        $description = $docBlockGenerator->getShortDescription();
        $docBlockGenerator->setShortDescription(BaseFunctionDto::commentHelper($description));

        $description = $docBlockGenerator->getLongDescription();
        $docBlockGenerator->setLongDescription(BaseFunctionDto::commentHelper($description));
        
        $tags = $docBlockGenerator->getTags();
        /** @var GenericTag $tag */
        foreach ($tags as $tag) {
            switch($tag->getName()) {
                case 'param':
                    /** @var ParamTag $tag */
                    $types = $tag->getTypesAsString();
                    $typeGenerator = TypeGenerator::fromTypeString($types);
                    $tag->setTypes($renderer->transfer('TypeDto.php', $typeGenerator)->name);
                    $tag->setDescription(BaseFunctionDto::commentHelper($tag->getDescription()));
                    break;
                case 'return':
                    /** @var ReturnTag $tag */
                    $tag->setDescription(BaseFunctionDto::commentHelper($tag->getDescription()));
                    break;
            }
        }
    }
}
