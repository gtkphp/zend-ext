<?php

namespace ZendExt\Dto\Ext\Header;

use ZendExt\Dto\Ext\ClassDto as BaseClassDto;;
use \ZendExt\Dto\Ext\Header\FunctionDto;

use Zend\Ext\Models\Code\Generator\FileGenerator;
use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\LicenseTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\AuthorTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\GenericTag;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;


class ClassDto extends BaseClassDto
{
    const CLASS_TYPE = 'Class';
    const ENUM_TYPE = 'Enum';
    const UNION_TYPE = 'Union';
    const STRUCT_TYPE = 'Struct';

    /** @var string */
    public $type;

    /** @var string */
    public $name_macro;

    /** @var string */
    public $name_function;

    /** @var string code of function */
    public $function_create;

    static public function create($codeGenerator, $renderer)
    {
        $dto = new self();

        /** @var FileGenerator $fileGenerator */
        $fileGenerator = $codeGenerator;

        /** @var ClassGenerator $classGenerator */
        if ($fileGenerator->hasClass()) {
            $classGenerator = $fileGenerator->getClass();

            $dto->function_create = $renderer->transfer('UserFunctionDto.php', $classGenerator);

            /** @var PropertyGenerator $propertyGenerator */
            foreach($classGenerator->getProperties() as $propertyGenerator) {
                $varDto = $renderer->transfer('VarDto.php', $propertyGenerator);
                $varDto->name = $propertyGenerator->getName();
                $varDto->type = $propertyGenerator->getType()->generate();
                
                $docBlockGenerator = $propertyGenerator->getDocBlock();
                $docBlockGenerator->setIndentation("    ");
                self::formatDescription($docBlockGenerator);
                $varDto->dockBlock = $docBlockGenerator?$docBlockGenerator->generate():'';
        
                $dto->fields[] = $varDto;
            }

        } else {
            $classGenerator = $fileGenerator->getEnum();
        }

        $dto->type = get_class($classGenerator);
        $dto->type = substr($dto->type, strrpos($dto->type, '\\')+1, -strlen('Generator'));

        $dto->name = $classGenerator->getName();
        
        $dockBlockGenerator = $classGenerator->getDocBlock();
        if ($dockBlockGenerator) {
            $dto->dockBlock = $dockBlockGenerator->generate();
        } else {
            $dto->dockBlock = '';
        }
        
        $dto->name_function = strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', lcfirst($dto->name)));
        $dto->name_macro = strtoupper($dto->name_function);

        /** @var MethodGenerator $function */
        foreach($fileGenerator->getFunctions() as $function) {
            if ($function->isMethod()) {
                //$function->isStatic();
                $functionDto = $renderer->transfer('MethodDto.php', $function);
                $dto->methods[] = $functionDto;
            }
        }

        $pad = 0;
        /** @var MethodGenerator $function */
        foreach($fileGenerator->getFunctions() as $function) {
            //if (! $function->isMethod()) {}
            $functionDto = $renderer->transfer('FunctionDto.php', $function);
            $dto->functions[] = $functionDto;
            $pad = max($pad, strlen($functionDto->name));
        }
        foreach($dto->functions as $functionDto) {
            $functionDto->pad = $pad;
        }

        return $dto;





        /*$dataModel = new \Zend\Ext\View\Model\CodeGeneratorModel();
        $dataModel->setTemplate('ClassDto.php');
        $dataModel->setCodeGenerator($fileGenerator);

        $dto->class = $renderer->transfer($dataModel);

        return $dto;*/
    }

    static public function formatDescription(DocBlockGenerator $docBlockGenerator) {
        /*
        $description = $docBlockGenerator->getShortDescription();
        $docBlockGenerator->setShortDescription(self::commentHelper($description));

        $description = $docBlockGenerator->getLongDescription();
        $docBlockGenerator->setLongDescription(self::commentHelper($description));
        */
        
        /** @var VarTag[] $tags */
        $tags = $docBlockGenerator->getTags();
        $description = $tags[0]->getDescription();
        if ($description) {
            $tags[0]->setDescription(self::commentHelper($description));
        }
    }
    static public function commentHelper(string $description) {
        $description = str_replace(array('<para>', '</para>', '<parameter>', '</parameter>', '<literal>', '</literal>'), array('<p>', '</p>', '$', '', '<b>', '</b>'), $description);
        $description = strip_tags($description, '<p><b>');
        $description = preg_replace(array('/[\r\n ]+/i', '/[\r\n ]+\./i', '/[a-zA-Z]+[a-zA-Z_]*\(\)/i'), array(' ', '.', '<b>$0</b>'), $description);
        return $description;
    }

}
