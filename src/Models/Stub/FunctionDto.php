<?php

namespace ZendExt\Dto\Stub;


use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\GenericTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\ParamTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\ReturnTag;
use Zend\Ext\Models\Code\Generator\MethodGenerator;

use ZendExt\Dto\Stub\ArgumentsDto;


class FunctionDto //extends BaseFileDto
{
    /** @var string */
    public $name;

    /** @var string */
    public $dockBlock='';

    /** @var ArgumentsDto */
    public $arguments;

    /** @var string */
    public $returns;

    public $pad = 0;

    static public function create(MethodGenerator $methodGenerator, $renderer)
    {
        /** @var ClassGenerator $classGenerator */
        $dto = new self();
        $dto->name = $methodGenerator->getName();

        $dto->arguments = $renderer->transfer('ArgumentsDto.php', $methodGenerator);

        $returnsGenerator = $methodGenerator->getReturnType();
        if (!$returnsGenerator || 'void'==$returnsGenerator) {
            $dto->returns = '';
        } else {
            $dto->returns = ':'.$returnsGenerator->generate();
        }
        
        $docBlockGenerator = $methodGenerator->getDocBlock();
        //$docBlockGenerator->setIndentation('    ');
        self::formatDescription($docBlockGenerator);

        $dto->dockBlock = $docBlockGenerator?$docBlockGenerator->generate():'';

        return $dto;
    }

    static public function formatDescription(DocBlockGenerator $docBlockGenerator) {
        $description = $docBlockGenerator->getShortDescription();
        $docBlockGenerator->setShortDescription(self::commentHelper($description));

        $description = $docBlockGenerator->getLongDescription();
        $docBlockGenerator->setLongDescription(self::commentHelper($description));
        
        $tags = $docBlockGenerator->getTags();
        /** @var GenericTag $tag */
        foreach ($tags as $tag) {
            switch($tag->getName()) {
                case 'param':
                    /** @var ParamTag $tag */
                    $tag->setDescription(self::commentHelper($tag->getDescription()));
                    break;
                case 'return':
                    /** @var ReturnTag $tag */
                    $tag->setDescription(self::commentHelper($tag->getDescription()));
                    break;
            }
        }
    }
    static public function commentHelper(string $description) {
        $description = str_replace(array('<para>', '</para>', '<parameter>', '</parameter>', '<literal>', '</literal>'), array('<p>', '</p>', '$', '', '<b>', '</b>'), $description);
        $description = strip_tags($description, '<p><b>');
        $description = preg_replace(array('/[\r\n ]+/i', '/[\r\n ]+\./i', '/[a-zA-Z]+[a-zA-Z_]*\(\)/i'), array(' ', '.', '<b>$0</b>'), $description);
        return $description;
    }

}
