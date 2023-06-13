<?php

namespace ZendExt\Dto\Ext\Source;

use ZendExt\Dto\Ext\ClassDto as BaseClassDto;

use Zend\Ext\Models\Code\Generator\FileGenerator;
use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;


class ClassDto extends BaseClassDto
{
    const CLASS_TYPE = 'Class';
    const ENUM_TYPE = 'Enum';
    const UNION_TYPE = 'Union';
    const STRUCT_TYPE = 'Struct';

    /** @var string function name */
    public $destroy_function;

    /** @var string code of function */
    public $function_create;

    /** @var string */
    public $type;

    /** @var string */
    public $name_macro;

    /** @var string */
    public $name_function;

    /** @var string[] */
    public $requires = [];

    /** @var string[] */
    public $uses = [];

    static public function create($codeGenerator, $renderer)
    {
        $dto = new self();

        /** @var FileGenerator $fileGenerator */
        $fileGenerator = $codeGenerator;

        /** @var ClassGenerator $classGenerator */
        $classGenerator = $fileGenerator->getClass();

        $destroy_functions = $classGenerator->getDestroyFunctions();
        $dto->destroy_function = current($destroy_functions);//'cairo_destroy'

        $dto->function_create = $renderer->transfer('UserFunctionDto.php', $classGenerator);

        // remove type
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

        /** @var PropertyGenerator $propertyGenerator */
        foreach($classGenerator->getProperties() as $propertyGenerator) {
            $varDto = $renderer->transfer('VarDto.php', $propertyGenerator);
            $varDto->name = $propertyGenerator->getName();
            $varDto->type = $propertyGenerator->getType()->generate();
            
            $docBlockGenerator = $propertyGenerator->getDocBlock();
            if ($docBlockGenerator) {
                $docBlockGenerator->setIndentation("    ");
                self::formatDescription($docBlockGenerator);
                $varDto->dockBlock = $docBlockGenerator->generate();
            } else {
                $varDto->dockBlock = '';
            }
    
            $dto->fields[] = $varDto;
        }

        /** @var MethodGenerator $function */
        /*
        foreach($fileGenerator->getFunctions() as $function) {
            if ($function->isMethod()) {
                //$function->isStatic();
                $functionDto = $renderer->transfer('MethodDto.php', $function);
                $dto->methods[] = $functionDto;
            }
        }
        */

        $pad = 0;
        /** @var MethodGenerator $function */
        foreach($fileGenerator->getFunctions() as $function) {
            $function->instance_name = $dto->name_function;
            $functionDto = $renderer->transfer('FunctionDto.php', $function);
            $dto->functions[] = $functionDto;
            $pad = max($pad, strlen($functionDto->name));
        }
        foreach($dto->functions as $functionDto) {
            $functionDto->pad = $pad;
        }

        foreach($fileGenerator->uses as $use) {
            $dto->uses[] = $use;//[0];
        }
        $dto->requires = $fileGenerator->getRequiredFiles();
        
        return $dto;
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
        $tags[0]->setDescription(self::commentHelper($tags[0]->getDescription()));
    }
    static public function commentHelper(string $description=null) {
        if (! $description) {
            return '';
        }
        $description = str_replace(array('<para>', '</para>', '<parameter>', '</parameter>', '<literal>', '</literal>'), array('<p>', '</p>', '$', '', '<b>', '</b>'), $description);
        $description = strip_tags($description, '<p><b>');
        $description = preg_replace(array('/[\r\n ]+/i', '/[\r\n ]+\./i', '/[a-zA-Z]+[a-zA-Z_]*\(\)/i'), array(' ', '.', '<b>$0</b>'), $description);
        return $description;
    }

}
