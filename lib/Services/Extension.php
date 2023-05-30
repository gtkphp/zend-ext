<?php

namespace Zend\Ext\Services;

use Exception;
use Zend\Ext\Services\DocBook\Gnome as DocBook;
use Zend\Ext\Services\Classifier\Cairo as CairoClassifier;

use Zend\Ext\Models\Dto\ObjectDto;
use Zend\Ext\Models\Dto\ExtensionDto;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\SetDocBook;
use Zend\Ext\Models\DocBook\BookDocBook;
use Zend\Ext\Models\DocBook\PartDocBook;
use Zend\Ext\Models\DocBook\ReferenceDocBook;
use Zend\Ext\Models\DocBook\ChapterDocBook;
use Zend\Ext\Models\DocBook\RefEntryDocBook;
use Zend\Ext\Models\DocBook\VarDocBook;
use Zend\Ext\Models\DocBook\StructDocBook;
use Zend\Ext\Models\DocBook\TypedefDocBook;
use Zend\Ext\Models\DocBook\FunctionDocBook;
use Zend\Ext\Models\DocBook\ParameterDocBook;
use Zend\Ext\Models\DocBook\TypeDocBook;
use Zend\Ext\Models\DocBook\AnnotationDocBook;

use Zend\Ext\Models\Code\Package;
use Zend\Ext\Models\Code\Generator\AbstractGenerator;
use Zend\Ext\Models\Code\Generator\FileGenerator;
use Zend\Ext\Models\Code\Generator\ClassGenerator;
use Zend\Ext\Models\Code\Generator\AliasClassGenerator;
use Zend\Ext\Models\Code\Generator\EnumGenerator\EnumGenerator;
use Zend\Ext\Models\Code\Generator\EnumGenerator\Name;
use Zend\Ext\Models\Code\Generator\EnumGenerator\Cases\BackedCases;
use Zend\Ext\Models\Code\Generator\EnumGenerator\Cases\CaseFactory;
use Zend\Ext\Models\Code\Generator\EnumGenerator\Cases\PureCases;

use Zend\Ext\Models\Code\Generator\DocBlockGenerator;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\LicenseTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\AuthorTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\GenericTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\ParamTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\ReturnTag;
use Zend\Ext\Models\Code\Generator\DocBlock\Tag\VarTag;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Generator\ParameterGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator;
use Zend\Ext\Models\Code\Generator\PropertyGenerator;
use Zend\Ext\Models\Code\Generator\TypeGenerator\AtomicType;

// CodeGeneratorProvider
class Extension
{
    const ENABLE_TRACE = 0;
    const ENABLE_BREAK = 0;
    
    /**
     * @var DocBook $docBook
     */
    protected $docBook;

    /** @var Package[] $packages */
    private $packages;

    /** @var StructDocBook[] $structsDocBook */
    private $structsDocBook;

    /** @var TypedefDocBook[] $typedefsDocBook */
    private $typedefsDocBook;

    /** @var EnumDocBook[] $enumsDocBook */
    private $enumsDocBook;

    /** @var UnionDocBook[] $unionsDocBook */
    private $unionsDocBook;

    /** @var TypeGenerator[] $typesGenerator */
    private $typesGenerator=[];
    
    /** @var string[] $requiredFiles */
    protected $requiredFiles = [];

    /** @var string[] $useFiles */
    protected $useFiles = [];

    /** @var array[string=>string[]] $whitelist */
    private $whitelist;

    protected $php_version;

    public function setVersion($php_version) {
        $this->php_version = $php_version;
    }

    /**
     * @param array[string=>string[]] $whitelist object_name=>[function_name,]
     */
    public function setWhitelist($whitelist): Extension
    {
        $this->whitelist = $whitelist;
        return $this;
    }

    /**
     * @return DocBook
     */
    public function getDocBook(): DocBook
    {
        return $this->docBook;
    }

    /**
     * @param DocBook $docBook
     * @return Extension
     */
    public function setDocBook(DocBook $docBook): Extension
    {
        $this->docBook = $docBook;
        return $this;
    }
    
    protected function getFunctions(AbstractDocBook $docBook) {
        //echo 'docBook('.get_class($docBook).')', PHP_EOL;
        $functions = [];
        if ($docBook instanceof SetDocBook) {
            //echo '  getFunctions(Set)', PHP_EOL;
            /** @var SetDocBook $docBook */
            foreach ($docBook->sets() as $set) {
                $fns = $this->getFunctions($set);
                $functions = array_merge($functions, $fns);
            }
            foreach ($docBook->books() as $book) {
                $fns = $this->getFunctions($book);
                $functions = array_merge($functions, $fns);
            }
        } else if ($docBook instanceof BookDocBook) {
            //echo '    getFunctions(Book)', PHP_EOL;
            /** @var BookDocBook $docBook */
            foreach ($docBook->parts() as $part) {
                $fns = $this->getFunctions($part);
                $functions = array_merge($functions, $fns);
            }
            foreach ($docBook->references() as $reference) {
                $sts = $this->getFunctions($reference);
                $functions = array_merge($functions, $sts);
            }
            foreach ($docBook->chapters() as $chapter) {
                $fns = $this->getFunctions($chapter);
                $functions = array_merge($functions, $fns);
            }
        } else if ($docBook instanceof PartDocBook) {
            //echo '      getFunctions(Part)', PHP_EOL;
            /** @var PartDocBook $docBook */
            foreach ($docBook->chapters() as $chapter) {
                $fns = $this->getFunctions($chapter);
                $functions = array_merge($functions, $fns);
            }
            foreach ($docBook->refentries() as $refentry) {
                $fns = $this->getFunctions($refentry);
                $functions = array_merge($functions, $fns);
            }
        } else if ($docBook instanceof ChapterDocBook) {
            //echo '      getFunctions(Chapter)', PHP_EOL;
            /** @var ChapterDocBook $docBook */
            foreach ($docBook->refentries() as $refentry) {
                $fns = $this->getFunctions($refentry);
                $functions = array_merge($functions, $fns);
            }
        } else if ($docBook instanceof RefEntryDocBook) {
            //echo '        getFunctions(Ref)', PHP_EOL;
            /** @var RefEntryDocBook $docBook */
            $functions = array_merge($functions, $docBook->functions());
            /* foreach ($docBook->functions() as $function) {
                $functions[] = $function;
            } */
        } else {
            throw new Exception("Unexpected");
        }
        return $functions;
    }

    protected function getBooks(AbstractDocBook $docBook) {
        $books = [];
        if ($docBook instanceof SetDocBook) {
            /** @var SetDocBook $docBook */
            foreach ($docBook->sets() as $set) {
                $bks = $this->getBooks($set);
                $books = array_merge($books, $bks);
            }
            $books = array_merge($books, $docBook->books());
        } else if ($docBook instanceof BookDocBook) {
            /** @var BookDocBook $docBook */
            $books[] = $docBook;
        } else {
            throw new Exception("Unexpected");
        }
        return $books;
    }

    protected function getRefEntries(AbstractDocBook $docBook) {
        $refentries = [];
        if ($docBook instanceof SetDocBook) {
            /** @var SetDocBook $docBook */
            foreach ($docBook->sets() as $set) {
                $sts = $this->getRefEntries($set);
                $refentries = array_merge($refentries, $sts);
            }
            foreach ($docBook->books() as $book) {
                $sts = $this->getRefEntries($book);
                $refentries = array_merge($refentries, $sts);
            }
        } else if ($docBook instanceof BookDocBook) {
            /** @var BookDocBook $docBook */
            foreach ($docBook->parts() as $part) {
                $sts = $this->getRefEntries($part);
                $refentries = array_merge($refentries, $sts);
            }
            foreach ($docBook->references() as $reference) {
                $sts = $this->getRefEntries($reference);
                $refentries = array_merge($refentries, $sts);
            }
            foreach ($docBook->chapters() as $chapter) {
                $sts = $this->getRefEntries($chapter);
                $refentries = array_merge($refentries, $sts);
            }
        } else if ($docBook instanceof PartDocBook) {
            /** @var PartDocBook $docBook */
            foreach ($docBook->chapters() as $chapter) {
                $sts = $this->getRefEntries($chapter);
                $refentries = array_merge($refentries, $sts);
            }
            $refentries = array_merge($refentries, $docBook->refentries());
        } else if ($docBook instanceof ReferenceDocBook) {
            $refentries = array_merge($refentries, $docBook->refentries());
        } else if ($docBook instanceof ChapterDocBook) {
            $refentries = array_merge($refentries, $docBook->refentries());
        } else if ($docBook instanceof RefEntryDocBook) {
            $refentries[] = $docBook;
        } else {
            throw new Exception("Unexpected");
        }
        return $refentries;
    }
    protected function getStructs(AbstractDocBook $docBook) {
        $structs = [];
        if ($docBook instanceof SetDocBook) {
            /** @var SetDocBook $docBook */
            foreach ($docBook->sets() as $set) {
                $sts = $this->getStructs($set);
                $structs = array_merge($structs, $sts);
            }
            foreach ($docBook->books() as $book) {
                $sts = $this->getStructs($book);
                $structs = array_merge($structs, $sts);
            }
        } else if ($docBook instanceof BookDocBook) {
            /** @var BookDocBook $docBook */
            foreach ($docBook->parts() as $part) {
                $sts = $this->getStructs($part);
                $structs = array_merge($structs, $sts);
            }
            foreach ($docBook->references() as $reference) {
                $sts = $this->getStructs($reference);
                $structs = array_merge($structs, $sts);
            }
            foreach ($docBook->chapters() as $chapter) {
                $sts = $this->getStructs($chapter);
                $structs = array_merge($structs, $sts);
            }
        } else if ($docBook instanceof PartDocBook) {
            /** @var PartDocBook $docBook */
            foreach ($docBook->chapters() as $chapter) {
                $sts = $this->getStructs($chapter);
                $structs = array_merge($structs, $sts);
            }
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getStructs($refentry);
                $structs = array_merge($structs, $sts);
            }
        } else if ($docBook instanceof ReferenceDocBook) {
            /** @var ReferenceDocBook $docBook */
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getStructs($refentry);
                $structs = array_merge($structs, $sts);
            }
        } else if ($docBook instanceof ChapterDocBook) {
            /** @var ChapterDocBook $docBook */
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getStructs($refentry);
                $structs = array_merge($structs, $sts);
            }
        } else if ($docBook instanceof RefEntryDocBook) {
            /** @var RefEntryDocBook $docBook */
            $structs = array_merge($structs, $docBook->structs());
            /* foreach ($docBook->functions() as $function) {
                $functions[] = $function;
            } */
        } else {
            throw new Exception("Unexpected");
        }
        return $structs;
    }
    protected function getEnums(AbstractDocBook $docBook) {
        $enums = [];
        if ($docBook instanceof SetDocBook) {
            /** @var SetDocBook $docBook */
            foreach ($docBook->sets() as $set) {
                $sts = $this->getEnums($set);
                $enums = array_merge($enums, $sts);
            }
            foreach ($docBook->books() as $book) {
                $sts = $this->getEnums($book);
                $enums = array_merge($enums, $sts);
            }
        } else if ($docBook instanceof BookDocBook) {
            /** @var BookDocBook $docBook */
            foreach ($docBook->parts() as $part) {
                $sts = $this->getEnums($part);
                $enums = array_merge($enums, $sts);
            }
            foreach ($docBook->references() as $reference) {
                $sts = $this->getEnums($reference);
                $enums = array_merge($enums, $sts);
            }
            foreach ($docBook->chapters() as $chapter) {
                $sts = $this->getEnums($chapter);
                $enums = array_merge($enums, $sts);
            }
        } else if ($docBook instanceof PartDocBook) {
            /** @var PartDocBook $docBook */
            foreach ($docBook->chapters() as $chapter) {
                $sts = $this->getEnums($chapter);
                $enums = array_merge($enums, $sts);
            }
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getEnums($refentry);
                $enums = array_merge($enums, $sts);
            }
        } else if ($docBook instanceof ReferenceDocBook) {
            /** @var ReferenceDocBook $docBook */
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getEnums($refentry);
                $enums = array_merge($enums, $sts);
            }
        } else if ($docBook instanceof ChapterDocBook) {
            /** @var ChapterDocBook $docBook */
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getEnums($refentry);
                $enums = array_merge($enums, $sts);
            }
        } else if ($docBook instanceof RefEntryDocBook) {
            /** @var RefEntryDocBook $docBook */
            $enums = array_merge($enums, $docBook->enums());
            /* foreach ($docBook->functions() as $function) {
                $functions[] = $function;
            } */
        } else {
            throw new Exception("Unexpected");
        }
        return $enums;
    }
    protected function getUnions(AbstractDocBook $docBook) {
        $unions = [];
        if ($docBook instanceof SetDocBook) {
            /** @var SetDocBook $docBook */
            foreach ($docBook->sets() as $set) {
                $sts = $this->getUnions($set);
                $unions = array_merge($unions, $sts);
            }
            foreach ($docBook->books() as $book) {
                $sts = $this->getUnions($book);
                $unions = array_merge($unions, $sts);
            }
        } else if ($docBook instanceof BookDocBook) {
            /** @var BookDocBook $docBook */
            foreach ($docBook->parts() as $part) {
                $sts = $this->getUnions($part);
                $unions = array_merge($unions, $sts);
            }
            foreach ($docBook->references() as $reference) {
                $sts = $this->getUnions($reference);
                $unions = array_merge($unions, $sts);
            }
            foreach ($docBook->chapters() as $chapter) {
                $sts = $this->getUnions($chapter);
                $unions = array_merge($unions, $sts);
            }
        } else if ($docBook instanceof PartDocBook) {
            /** @var PartDocBook $docBook */
            foreach ($docBook->chapters() as $chapter) {
                $sts = $this->getUnions($chapter);
                $unions = array_merge($unions, $sts);
            }
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getUnions($refentry);
                $unions = array_merge($unions, $sts);
            }
        } else if ($docBook instanceof ReferenceDocBook) {
            /** @var ReferenceDocBook $docBook */
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getUnions($refentry);
                $unions = array_merge($unions, $sts);
            }
        } else if ($docBook instanceof ChapterDocBook) {
            /** @var ChapterDocBook $docBook */
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getUnions($refentry);
                $unions = array_merge($unions, $sts);
            }
        } else if ($docBook instanceof RefEntryDocBook) {
            /** @var RefEntryDocBook $docBook */
            $unions = array_merge($unions, $docBook->unions());
            /* foreach ($docBook->functions() as $function) {
                $functions[] = $function;
            } */
        } else {
            throw new Exception("Unexpected");
        }
        return $unions;
    }
    protected function getTypedefs(AbstractDocBook $docBook) {
        /** @var TypedefDocBook[] $typedefs */
        $typedefs = [];
        if ($docBook instanceof SetDocBook) {
            /** @var SetDocBook $docBook */
            foreach ($docBook->sets() as $set) {
                $sts = $this->getTypedefs($set);
                $typedefs = array_merge($typedefs, $sts);
            }
            foreach ($docBook->books() as $book) {
                $sts = $this->getTypedefs($book);
                $typedefs = array_merge($typedefs, $sts);
            }
        } else if ($docBook instanceof BookDocBook) {
            /** @var BookDocBook $docBook */
            foreach ($docBook->parts() as $part) {
                $sts = $this->getTypedefs($part);
                $typedefs = array_merge($typedefs, $sts);
            }
            foreach ($docBook->references() as $reference) {
                $sts = $this->getTypedefs($reference);
                $typedefs = array_merge($typedefs, $sts);
            }
            foreach ($docBook->chapters() as $chapter) {
                $sts = $this->getTypedefs($chapter);
                $typedefs = array_merge($typedefs, $sts);
            }
        } else if ($docBook instanceof PartDocBook) {
            /** @var PartDocBook $docBook */
            foreach ($docBook->chapters() as $chapter) {
                $sts = $this->getTypedefs($chapter);
                $typedefs = array_merge($typedefs, $sts);
            }
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getTypedefs($refentry);
                $typedefs = array_merge($typedefs, $sts);
            }
        } else if ($docBook instanceof ReferenceDocBook) {
            /** @var ReferenceDocBook $docBook */
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getTypedefs($refentry);
                $typedefs = array_merge($typedefs, $sts);
            }
        } else if ($docBook instanceof ChapterDocBook) {
            /** @var ChapterDocBook $docBook */
            foreach ($docBook->refentries() as $refentry) {
                $sts = $this->getTypedefs($refentry);
                $typedefs = array_merge($typedefs, $sts);
            }
        } else if ($docBook instanceof RefEntryDocBook) {
            /** @var RefEntryDocBook $docBook */
            $typedefs = array_merge($typedefs, $docBook->typedefs());
            /* foreach ($docBook->functions() as $function) {
                $functions[] = $function;
            } */
        } else {
            throw new Exception("Unexpected");
        }
        return $typedefs;
    }

    /**
     * @param StructDocBook|TypedefDocBook $structDocBook
     */
    protected function loadPropertiesGenerator($structDocBook, ClassGenerator $classGenerator) {
        /** @var PropertyGenerator[] $propertiesGenerator */
        $propertiesGenerator = [];

        $fields = $structDocBook->getFields();
        /** @var VarDocBook $field */
        foreach ($fields as $field) {
            
            /** @var PropertyGenerator $propertyGenerator */
            $propertyGenerator = new PropertyGenerator($field->name);
            
            /** @var TypeDocBook $type */
            $type = $field->getType();
            if (array_key_exists($type->getName(), $this->typesGenerator)) {
                $typeGenerator = $this->typesGenerator[$type->getName()];
            } else {
                throw new Exception("stop here");
                /*
                $typeGenerator = TypeGenerator::fromTypeString($type->getTypePhp());
                $typeGenerator->internal_type = $type->getName();
                */
            }

            $propertyGenerator->setType($typeGenerator);

            /** @var DocBlockGenerator $docBlockGenerator */
            $docBlockGenerator = new docBlockGenerator();
            //$docBlockGenerator->setLongDescription($field->getDescription());

            $varTag = new VarTag();
            $varTag->setTypes($typeGenerator->generate());
            $varTag->setVariableName($propertyGenerator->getName());
            $varTag->setDescription($field->getDescription());
            $docBlockGenerator->setTag($varTag);

            $propertyGenerator->setDocBlock($docBlockGenerator);

            $propertiesGenerator[] = $propertyGenerator;
        }

        $classGenerator->addProperties($propertiesGenerator);
    }

    /**
     * @var StructDocBook|TypedefDocBook $structDocBook
     * @return MethodGenerator[]
     */
    protected function loadMethodsGenerator($structDocBook, ClassGenerator $classGenerator) {
        /** @var MethodGenerator $functionsGenerator */
        $functionsGenerator = [];

        $do_begin = 3;// show() / check if is virtual
        $do_begin = 7;//11 draw() / is virtual
        $do_end = $do_begin + 1;
        $do_i = 0;
        
        /** @var RefEntryDocBook */
        $refEntryDocBook = $structDocBook->parent;

        $classifier = new CairoClassifier();
        $functions = $refEntryDocBook->functions();

        /** @var FunctionDocBook $functionDocBook */
        foreach($functions as $name=>$functionDocBook) {

            /** @var RefEntryDocBook $ref */
            $ref = $functionDocBook->parent;

            if ($ref->id == $refEntryDocBook->id) {

                if ($functionDocBook->isCallback()) {
                    if (self::ENABLE_TRACE) echo $refEntryDocBook->id, '::', $functionDocBook->name, '( prototype)', PHP_EOL;
                    continue;
                }

                if ($functionDocBook->isMacro()) {
                    if (self::ENABLE_TRACE) echo $refEntryDocBook->id, '::', $functionDocBook->name, '( macro)', PHP_EOL;
                    continue;
                }

                //echo "    - ".$functionDocBook->name."\n";
                /** @var StructDocBook $structDocBook */
                $objectDocBook = $classifier->getObjectOfFunction($functionDocBook);

                if ($objectDocBook && $this->skip($objectDocBook->name, $functionDocBook->name)) continue;

                //CairoClassifier::$map
                if (null==$objectDocBook) {
                    if (self::ENABLE_TRACE) echo $refEntryDocBook->id, '::', $functionDocBook->name, '( class '.$ref->id.' not found)', PHP_EOL;
                    /**
                     * Créer toutes les class, puis refaire une boucle pour attacher les method/property
                     */
                    continue;
                }
                if ($objectDocBook->name !== $structDocBook->name) {
                    if (self::ENABLE_TRACE) echo $refEntryDocBook->id, '::', $functionDocBook->name, '( not in same class)', PHP_EOL;
                    continue;
                }

                // TODO subdivid by (new, free), (ref, unref, adopt, get_reference_count), (get_user_data, set_user_data)
                /*
                if ($classifier->isMemoryManagement($functionDocBook)) {
                    echo $refEntryDocBook->id, '::', $functionDocBook->name, '( memory)', PHP_EOL;
                    continue;
                }
                if ($classifier->isErrorManagement($functionDocBook)) {
                    echo $refEntryDocBook->id, '::', $functionDocBook->name, '( Status|Error|Exception)', PHP_EOL;
                    continue;
                }
                if ($classifier->isUserData($functionDocBook)) {
                    echo $refEntryDocBook->id, '::', $functionDocBook->name, '( UserData)', PHP_EOL;
                    continue;
                }
                if ($classifier->isGetterSetter($functionDocBook)) {
                    echo $refEntryDocBook->id, '::', $functionDocBook->name, '( Getter|Setter)', PHP_EOL;
                    continue;
                }
                */
                
                
                //isInternal() ? isEndUser() ? isUserData ?
                //if ($functionDocBook->isStatic()) {}
                //if ($functionDocBook->isVirtual()) {}



                //TODO function can throw Exception func( GError **error);
                $method_name = $classifier->getMethodName($functionDocBook, $structDocBook);
                
                /** @var StructDocBook $classDocBook */
                $classDocBook = null;
                if (array_key_exists($objectDocBook->name.'Class', $this->structsDocBook)) {
                    $classDocBook = $this->structsDocBook[$objectDocBook->name.'Class'];
                }

                //echo count($classDocBook->getFields()), ' fields', PHP_EOL; 
                if (/*$method_name &&*/ $classDocBook) {
                    // Append Virtual method
                    // 1 bold; 3 italic; 4 underline
                    $color = "\033[34;";// blue
                    $decor = "5m";// normal
                    if ($classifier->isStatic($functionDocBook)) {
                        $color = "\033[0;";// black
                        $decor = "1m";// bold
                    }
                    if ($classifier->isMemoryManagement($functionDocBook)) {
                        $color = "\033[31;";// red
                    }

                    //echo 'TODO: ', $classDocBook->name, ':: ... ', $functionDocBook->name;
                    /*var_dump($method_name);
                    echo $classDocBook->getField($method_name)->name, PHP_EOL;*/ 
    
                    //$this->structsDocBook[$objectDocBook->name];
                    //$this->typedefsDocBook = $this->getTypedefs($docBook);
                    $methodGenerator = new MethodGenerator($functionDocBook->name);
                    $methodGenerator->setNickName($method_name);
                    $this->loadMethodParametersGenerator($functionDocBook, $methodGenerator);
                    $this->loadMethodReturnGenerator($functionDocBook, $methodGenerator);
        
                    $methodGenerator->setMethod(true);
                    if ($classDocBook->getField($method_name)) {
                        $methodGenerator->setVirtual(true);
                        $decor = "4m";// underline
                    }
                    //echo "    - ".$color.$decor.$functionDocBook->name."\033[0m\n";
                    //CHECK TODO: $this->loadFunctionDockBlockGenerator($functionDocBook, $functionGenerator);
                    $classGenerator->addMethodFromGenerator($methodGenerator);
                    $functionGenerator = $methodGenerator;
                } else {
                    echo "      ::function()\n";
                    $functionGenerator = new MethodGenerator($functionDocBook->name);
                    $this->loadFunctionParametersGenerator($functionDocBook, $functionGenerator);
                    $this->loadFunctionReturnGenerator($functionDocBook, $functionGenerator);
                    $this->loadFunctionDockBlockGenerator($functionDocBook, $functionGenerator);
                    if ($method_name) {
                        $functionGenerator->setMethod(true);
                        $functionGenerator->setNickName($method_name);
                        //echo 'TODO: ', $objectDocBook->name, '::', $functionDocBook->name, ';', $method_name, PHP_EOL;
                        //echo '    ', $objectDocBook->name, '!==', $structDocBook->name, PHP_EOL;
                    }
                    // + isMemoryManagement
                    //    + isConstructor
                    //    + isReferror
                    //    + isDestructor
                    if ($classifier->isMemoryManagement($functionDocBook)) {
                        $functionGenerator->setMemoryManagement();
                        if ($classifier->isMMFree($functionDocBook)) {
                            $classGenerator->setDestroyFunction($functionDocBook->name);
                        }
                        if ($classifier->isMMNew($functionDocBook)) {
                            $classGenerator->setCreatorFunction($functionDocBook->name);
                        }
                    }
                    if ($classifier->isErrorManagement($functionDocBook)) {
                        $functionGenerator->setErrorManagement();
                    }
                    if ($classifier->isUserData($functionDocBook)) {
                        $functionGenerator->setUserData();
                    }
                    if ($classifier->isStatic($functionDocBook)) {
                        echo "$functionDocBook->name is Static \n";
                        $functionGenerator->setStatic(true);
                    }
                    if ($classifier->isGetterSetter($functionDocBook)) {
                        $functionGenerator->setGetterSetter(true);
                    }
                }
                $functionsGenerator[] = $functionGenerator;

            } else {
                echo "Never append\n";
    
            }
   
        }
        return $functionsGenerator;
    }

    protected function loadFunctionParametersGenerator(FunctionDocBook $functionDocBook, MethodGenerator $methodGenerator) {
        // In a method, first parameter is the $this context
        /** @var ParameterDocBook[] $parameters */
        $parameters = $functionDocBook->getParameters();

        /** @var ParameterGenerator[] $parametersGenerator */
        $parametersGenerator = [];

        /** @var ParameterDocBook $parameterDocBook */
        foreach($parameters as $parameterDocBook) {
            $parameterGenerator = $this->loadParameterGenerator($parameterDocBook);
            if ($parameterGenerator) {
                $parametersGenerator[] = $parameterGenerator;
            }
            
        }
        $methodGenerator->setParameters($parametersGenerator);

    }
    protected function loadFunctionReturnGenerator(FunctionDocBook $functionDocBook, MethodGenerator $methodGenerator) {
        $this->loadMethodReturnGenerator($functionDocBook, $methodGenerator);
    }
    
    protected function loadMethodParametersGenerator(FunctionDocBook $functionDocBook, MethodGenerator $methodGenerator) {
        // In a method, first parameter is the $this context
        /** @var ParameterDocBook[] $parameters */
        $parameters = $functionDocBook->getParameters();

        /** @var ParameterGenerator[] $parametersGenerator */
        $parametersGenerator = [];

        //$skip_this = true;
        /** @var ParameterDocBook $parameterDocBook */
        foreach($parameters as $parameterDocBook) {
            /*if ($skip_this) {
                $skip_this = false;
                continue;
            }*/

            
            $parameterGenerator = $this->loadParameterGenerator($parameterDocBook);
            if ($parameterGenerator) {
                $parametersGenerator[] = $parameterGenerator;
            }
            
        }
        $methodGenerator->setParameters($parametersGenerator);
    }

    protected function loadMethodReturnGenerator(FunctionDocBook $functionDocBook, MethodGenerator $methodGenerator) {

        /** @var ParameterDocBook $parameterDocBook */
        $parameterDocBook = $functionDocBook->getParameterReturn();

        if ($parameterDocBook) {
            $type = $parameterDocBook->getType();
            
            if ('void'==$type && $parameterDocBook->getPass()) {
                $typeGenerator = TypeGenerator::fromTypeString('mixed');
            } else {
                if (array_key_exists($type->getName(), $this->typesGenerator)) {
                    $typeGenerator = $this->typesGenerator[$type->getName()];
                } else {
                    throw new Exception("stop here");
                }
    
                if ($parameterDocBook->getPass())
                    $methodGenerator->setReturnsReference(true);
            }
            
            $methodGenerator->setReturnType($typeGenerator);
            $methodGenerator->getReturnType($typeGenerator);

            $this->useFiles[$type->getName()] = $typeGenerator->__toString();
        }
    }

    /**
     * @return ParameterGenerator
     */
    protected function loadParameterGenerator(ParameterDocBook $parameterDocBook) {
        /** @var ParameterGenerator $parameterGenerator */
        $parameterGenerator = new ParameterGenerator();

        $name = $parameterDocBook->getName();
        if ('...'==$name) {
            $parameterGenerator->setVariadic(true);
        } else {
            $parameterGenerator->setName($name);
        }
        
        /** @var FunctionDocBook $functionDocBook */
        $functionDocBook = $parameterDocBook->parent;

        /** @var TypeDocBook $typeDocBook */
        $typeDocBook = $parameterDocBook->getType();
        if ($typeDocBook) {
            $type = $parameterDocBook->getType();
            if (array_key_exists($type->getName(), $this->typesGenerator)) {
                $typeGenerator = $this->typesGenerator[$type->getName()];
            } else {
                throw new Exception("stop here");
            }
            $parameterGenerator->setType($typeGenerator);
            
            $this->useFiles[$type->getName()] = $typeGenerator->__toString();
        } else {
            echo "Skip $functionDocBook->name(", $parameterDocBook->getName(), ')', PHP_EOL;
            //return null;
        }

        if ($parameterDocBook->hasAnnotation(AnnotationDocBook::ANNOTATION_OUT)) {
            $parameterGenerator->setPassedByReference(true);
            $parameterGenerator->isOut(true);
        }
        if ($parameterDocBook->hasAnnotation(AnnotationDocBook::ANNOTATION_ARRAY)) {
            $parameterGenerator->isArray(true);
            $annotation = $parameterDocBook->getAnnotation(AnnotationDocBook::ANNOTATION_ARRAY);
            if ($annotation->hasAttribute('length')) {
                $length_param_name = $annotation->getAttribute('length');
                $parameterGenerator->setArrayLengthParameter($length_param_name);
            }
            //$parameterGenerator->setArrayDimensions(true);
            
        }

        /** @var AnnotationDocBook $annotation
         echo $parameterDocBook->getName(), PHP_EOL;
         $annotations = $parameterDocBook->getAnnotations();// [out] default is transfer-full
         if ($annotations) {
             foreach ($annotations as $annotation) {
                 echo '  '.$annotation->getName(), PHP_EOL;
                 if ('transfer'==$annotation->getName()) {
                     if (in_array('none', $annotation->getAttributes())) {
                         echo '        ' . 'none', PHP_EOL;
                        } else {
                            echo '        ' . 'full', PHP_EOL;
                        }
                    }
                    
                }
            }
            */

        return $parameterGenerator;
    }

    public function loadFunctionDockBlockGenerator(FunctionDocBook $functionDocBook, MethodGenerator $methodGenerator) {
        $docBlockGenerator = new DocBlockGenerator();
        
        $docBlockGenerator->setShortDescription($functionDocBook->getShortDescription());
        $docBlockGenerator->setLongDescription($functionDocBook->getDescription());

        $parameters = $functionDocBook->getParameters();
        /** @var ParameterDocBook $parameterDocBlock */
        foreach($parameters as $parameterDocBlock) {
            $paramTag = new ParamTag($parameterDocBlock->getName());
            $paramTag->setDescription($parameterDocBlock->getDescription());
            $typeDocBook = $parameterDocBlock->getType();
            
            if (array_key_exists($typeDocBook->getName(), $this->typesGenerator)) {
                $typeGenerator = $this->typesGenerator[$typeDocBook->getName()];
            } else {
                throw new Exception("stop here");
            }

            $paramTag->setTypes($typeGenerator->generate());

            //$parameterDocBlock->isDeref();
            //$paramTag->setDeref(true);

            
            $docBlockGenerator->setTag($paramTag);
        }

        /** @var ParameterDocBook|null $returnsDocBook */
        $returnsDocBook = $functionDocBook->getParameterReturn();
        if ($returnsDocBook ) {
            $typeDocBook = $returnsDocBook->getType();
            if (array_key_exists($typeDocBook->getName(), $this->typesGenerator)) {
                $typeGenerator = $this->typesGenerator[$typeDocBook->getName()];
            } else {
                throw new Exception("stop here");
            }

            if ('void'==$typeDocBook && !$returnsDocBook->getPass()) {
            } else {
                $returnTag = new ReturnTag();
                $returnTag->setTypes($typeGenerator->generate());
                $returnTag->setDescription($returnsDocBook->getDescription());
                $docBlockGenerator->setTag($returnTag);
            }
        }

        $methodGenerator->setDocBlock($docBlockGenerator);

    }

    /**
     * @param ClassGenerator|EnumGenerator $classGenerator
     */
    public function fixeUse(FileGenerator $fileGenerator, $codeGenerator) {

        /** @var ClassGenerator $classGenerator */
        $classGenerator = $codeGenerator;

        /** @var EnumGenerator $enumGenerator */
        $enumGenerator = $codeGenerator;

        // foreach class ClassGenerator $classGenerator
        // foreach property
        // foreach trait ?
        // foreach method parameter

        //$classGenerator->addUse();

        /*
        $classifier = new CairoClassifier();
        */
        $fileGenerator->setRequiredFiles([$fileGenerator->getNamespace() .'/'. $fileGenerator->getNamespace() . '.h']);

        $includeFiles = [];
        $useFiles = array_filter($this->useFiles, function($v){ return !array_key_exists($v, TypeGenerator\AtomicType::BUILT_IN_TYPES_PRECEDENCE);});
        foreach ($useFiles as $useFile) {
            if ('cairo_t'==$useFile) {
                if ('cairo'==$fileGenerator->getNamespace()) {
                    $useFile = 'cairo.h';
                } else {
                    $useFile = 'php_cairo/cairo.h';
                }
            } else {
                $object = null;
                if (array_key_exists($useFile, $this->typedefsDocBook)) {
                    $object = $this->typedefsDocBook[$useFile];
                } else if (array_key_exists($useFile, $this->structsDocBook)) {
                    $object = $this->structsDocBook[$useFile];
                } else if (array_key_exists($useFile, $this->enumsDocBook)) {
                    $object = $this->enumsDocBook[$useFile];
                }
                if ($object) {
                    $namespace = $object->getBook()->id;
                    $useFile = CairoClassifier::Suffix($useFile);
                    $useFile = CairoClassifier::PascalToSnake($useFile);
                    $useFile = CairoClassifier::SnakeToDashe($useFile);// SnakeToDashe for cairo; or PascalToDashe for Gtk
                    $useFile = CairoClassifier::Prefix($useFile, $namespace.'-');

                    if ($namespace==$fileGenerator->getNamespace()) {
                        $useFile = $useFile.'.h';
                    } else {
                        $useFile = 'php_'.$namespace.'/'.$useFile.'.h';
                    }
                    $includeFiles[] = $useFile;// TODO fixe priority
                    $fileGenerator->setUse($useFile);
                } else {
                    echo '"'.$useFile . '" Unexpected ' . __FILE__ . PHP_EOL;
                }
            }
            
            //$fileGenerator->setUse('vendor/gtk/gdk/GdkWindow');
        }

        /*
        print_r($this->requiredFiles);
        print_r($requiredFiles);
        echo count($requiredFiles) . ' / ' . count($this->requiredFiles) . PHP_EOL;
        */


        /*
        //$fileGenerator->setNamespace('vendor/gtk/gtk');// Set, [Set, Book], refEntry
        $fileGenerator->setNamespace('vendor/gtk/gtk');// Set, [Set, Book], refEntry

        //$fileGenerator->setRequiredFiles(['<glib-object.h>', '<cairo/cairo.h>', '<gtk/gtk.h>']);
        $fileGenerator->setRequiredFiles(['<gtk/gtk.h>']);//#include <gtk/gtk.h>

        $fileGenerator->setUse('vendor/cairo/cairo_t');// #include "ext/php_cairo/cairo.h"
        $fileGenerator->setUse('vendor/gtk/gdk/GdkWindow');
        $fileGenerator->setUse('vendor/glib/glib/GList');
        */
        
        
    }
    public function loadFilename(FileGenerator $fileGenerator, AbstractDocBook $objectDocBook) {
        $namespaces=[];

        if ($fileGenerator->hasClass()) {
            $classGenerator = $fileGenerator->getClass();
            
            $filename = $classGenerator->getName();// cairo_t, GtkWidget
        } else if ($fileGenerator->hasEnum()) {
            $classGenerator = $fileGenerator->getEnum();
            
            $filename = $classGenerator->getName();// cairo_device_type_t, GtkPosWindow
        } else {
            $aliasGenerator = $fileGenerator->getAliasClass();
            
            $filename = $aliasGenerator->getName();// GtkAllocation/GdkRectangle
        }

        /** @var BookDocBook $bookDocBook */
        $bookDocBook = $objectDocBook->getBook();
        $prefix = $bookDocBook->id;

        if (array_key_exists($prefix, CairoClassifier::$map_namespace)) {
            // glib to g
            // gobject to g
            // gio to g
            $prefix = CairoClassifier::$map_namespace[$prefix];
        }
        
        if (substr($filename, -2)=='_t') {
            $filename = substr($filename, 0, -2);// remove suffix _t
        }

        if (strlen($filename) == strlen($prefix)) {

        } else if (0===strpos(strtolower($filename), $prefix)) {
            $filename = substr($filename, strlen($prefix));
        }

        if ('_'==$filename[0]) {
            $filename = substr($filename, 1);
        }
        $filename = CairoClassifier::PascalToSnake($filename);
        $filename = CairoClassifier::SnakeToDashe($filename);
    
        $fileGenerator->setFilename($filename);
    }

    public function loadNamespace(FileGenerator $fileGenerator, AbstractDocBook $objectDocBook) {
        $namespaces=[];

        $root = $objectDocBook->getRoot();
        $parent = $objectDocBook;
        while ($parent!=$root) {
            if ($parent instanceof BookDocBook
             || $parent instanceof SetDocBook) {
                if (empty($parent->id)) {
                    //$namespaces[] = '?';
                } else {
                    $namespaces[] = $parent->id;
                }
            } else {

            }
            $parent = $parent->parent;
        }

        $namespaces = array_reverse($namespaces);
        $namespace = implode('/', $namespaces);// 'vendor/gtk/gtk'
        $fileGenerator->setNamespace($namespace);// Set, [Set, Book], refEntry
    }

    /**
     * @return Package[] 
     */
    public function loadPackages(SetDocBook $docBook) {
        $packages = [];

        foreach ($this->getBooks($docBook) as $docBook) {
            $package = new Package();
            $package->name = $docBook->id;
            //$package->top = $docBook->parent->id;
            $packages[$package->name] = $package;
        }

        $this->packages = $packages;
        return $packages;
    }

    protected function loadClassGenerator(AbstractDocBook $docBook) {
        
        $classes = $this->kinds['class'];

        $structs = $this->structsDocBook;
        $typedefs = $this->typedefsDocBook;

        //$packageGenerator = new PackageGenerator($name);
        foreach($classes as $name=>$class_name) {
            /** @var StructDocBook */
            if (array_key_exists($name, $structs)) {
                $struct = $structs[$name];
            } else if (array_key_exists($name, $typedefs)) {
                $struct = $typedefs[$name];
            } else {
                // Some time ther are not instance struct
                if (array_key_exists($class_name, $structs)) {
                    $struct = $structs[$class_name];
                } else {
                    // GEnum do not exist
                    // but GEnumClass exist
                    // This is a static class
                    throw new Exception("Why ? $name");
                    continue;
                }
            }

            if ($this->skip($name)) continue;
            //if ($this->skip($struct->parent->id)) continue;

            $docFileGenerator = new DocBlockGenerator();
            $docFileGenerator->setTags([
                new LicenseTag(null, 'GPL 3.0'),
                new AuthorTag("mail", 'mail@gmail.com')
            ]);
            $docFileGenerator->setLongDescription("Zeng Extension (https://github.com/)");
            $fileGenerator = new FileGenerator();
            $fileGenerator->setDocBlock($docFileGenerator);

            $docClassGenerator = new DocBlockGenerator();
            $docClassGenerator->setLongDescription("Class $name");
            

            $classGenerator = new ClassGenerator($name);
            $classGenerator->setDocBlock($docClassGenerator);


            if ($struct instanceof StructDocBook
             || $struct instanceof TypedefDocBook) {
                $this->loadPropertiesGenerator($struct, $classGenerator);
            }

            
            
            $fileGenerator->setClass($classGenerator);

            $this->loadNamespace($fileGenerator, $struct);
            $this->loadFilename($fileGenerator, $struct);
            
            $docBook = $struct->getBook();
            $this->packages[$docBook->id]->files[$name] = $fileGenerator;
        }

    }
    
    protected function loadClassFunctions(AbstractDocBook $docBook) {
        $classes = $this->kinds['class'];

        $structs = $this->structsDocBook;
        $typedefs = $this->typedefsDocBook;

        //$packageGenerator = new PackageGenerator($name);
        foreach($classes as $name=>$class_name) {
            /** @var StructDocBook */
            if (array_key_exists($name, $structs)) {
                $struct = $structs[$name];
            } else if (array_key_exists($name, $typedefs)) {
                $struct = $typedefs[$name];
            } else {
                throw new Exception("Why ?");
            }
            $docBook = $struct->getBook();
            $files = $this->packages[$docBook->id]->files;

            $fileGenerator = $files[$name];
            $classGenerator = $fileGenerator->getClass();

            if ($this->skip($name)) continue;

            $this->requiredFiles = [];
            $this->useFiles = [];

            echo "TODO: load method of $name and set Uses/Requireds ".$classGenerator->getName()."\n";
            
            $functionsGenerator = $this->loadMethodsGenerator($struct, $classGenerator);
            $fileGenerator->setFunctions($functionsGenerator);
    
            ///$this->fixeUse($fileGenerator, $classGenerator);// Dependencies & Includes
    
        }
    }

    protected function loadObjectGenerator(AbstractDocBook $docBook) {
        $objects = $this->kinds['object'];

        $structs = $this->structsDocBook;
        $typedefs = $this->typedefsDocBook;

        foreach($objects as $name=>$object_name) {

            if (array_key_exists($name, CairoClassifier::$map_type)) {
                // Do not export gint, gboolean etc...
                continue;
            }

            if (array_key_exists($name, $structs)) {
                $object = $structs[$name];
            } else if (array_key_exists($name, $typedefs)) {
                $object = $typedefs[$name];
            } else {
                throw new Exception("Why ? $name");
                continue;
            }
                
            $this->requiredFiles = [];
            $this->useFiles = [];

            if ($this->skip($name)) continue;

            $docFileGenerator = new DocBlockGenerator();
            $docFileGenerator->setTags([
                new LicenseTag(null, 'GPL 3.0'),
                new AuthorTag("mail", 'mail@gmail.com')
            ]);
            $docFileGenerator->setLongDescription("Zeng Extension (https://github.com/)");
            $fileGenerator = new FileGenerator();
            $fileGenerator->setDocBlock($docFileGenerator);

            $docClassGenerator = new DocBlockGenerator();
            $docClassGenerator->setLongDescription("Class $name");
            

            $classGenerator = new ClassGenerator($name);
            $classGenerator->setDocBlock($docClassGenerator);


            /*
            $functionsGenerator = $this->loadMethodsGenerator($struct, $classGenerator);
            */
            if ($object instanceof StructDocBook) {
                $this->loadPropertiesGenerator($object, $classGenerator);
            }
            
            
            $fileGenerator->setClass($classGenerator);
            
            //$fileGenerator->setFunctions($functionsGenerator);

            $this->loadNamespace($fileGenerator, $object);
            $this->loadFilename($fileGenerator, $object);
            //$this->fixeUse($fileGenerator, $classGenerator);// Dependencies & Includes

            $docBook = $object->getBook();
            $this->packages[$docBook->id]->files[$name] = $fileGenerator;

        }
    }

    protected function loadEnumGenerator(AbstractDocBook $docBook) {
        $enums = $this->kinds['enum'];

        /** @var EnumDocBook $enum */
        foreach($this->enumsDocBook as $name=>$enum) {
            if (! array_key_exists($enum->name, $enums)) {
                continue;
            }
            //echo $name, PHP_EOL;

            $this->requiredFiles = [];
            $this->useFiles = [];

            //echo "* RUNNING : $name\n";
            if ($this->skip($name)) continue;


            $docFileGenerator = new DocBlockGenerator();
            $docFileGenerator->setTags([
                new LicenseTag(null, 'GPL 3.0'),
                new AuthorTag("mail", 'mail@gmail.com')
            ]);
            $docFileGenerator->setLongDescription("Zeng Extension (https://github.com/)");
            $fileGenerator = new FileGenerator();
            $fileGenerator->setDocBlock($docFileGenerator);

            $docClassGenerator = new DocBlockGenerator();
            $docClassGenerator->setLongDescription("Class $name");
            $docClassGenerator->setTags([
                new GenericTag('package', 'Cairo'),
                new GenericTag("internal", 'stub')
            ]);
            
            $cases = [];
            foreach ($enum->constants as $constant_name=>$constant) {
                $cases[] = ['name'=>$constant->name, 'value'=>$constant->value];
            }
            //$enum_cases = PureCases::fromCases($cases);
            //$enum_cases = BackedCases::fromCasesWithType($cases, 'int');

            $enumGenerator = EnumGenerator::withConfig(array('name'=>$enum->name, 'backedCases'=>['cases'=>$cases, 'type'=>'int']));
            //$classGenerator->setDocBlock($docClassGenerator);

            
            $fileGenerator->setEnum($enumGenerator);
            
            $this->loadNamespace($fileGenerator, $enum);
            $this->loadFilename($fileGenerator, $enum);
            $this->fixeUse($fileGenerator, $enumGenerator);// Dependencies & Includes

            $docBook = $enum->getBook();
            $this->packages[$docBook->id]->files[$name] = $fileGenerator;
        }
    }

    protected function loadUnionGenerator(AbstractDocBook $docBook) {
        $unions = $this->getUnions($docBook);

        //$packageGenerator = new PackageGenerator($name);
        foreach($unions as $name=>$union) {
            /** @var StructDocBook */
            $union = $unions[$name];

            $this->requiredFiles = [];
            $this->useFiles = [];
            
            if ($this->skip($name)) continue;

            $docFileGenerator = new DocBlockGenerator();
            $docFileGenerator->setTags([
                new LicenseTag(null, 'GPL 3.0'),
                new AuthorTag("mail", 'mail@gmail.com')
            ]);
            $docFileGenerator->setLongDescription("Zeng Extension (https://github.com/)");
            /*$fileGenerator = new FileGenerator();
            $fileGenerator->setDocBlock($docFileGenerator);

            $docClassGenerator = new DocBlockGenerator();
            $docClassGenerator->setLongDescription("Class $name");*/
            

            // create 2 ClassGenerator if anonymous structure + 1 TypeGenerator (union)
            //echo $union->getDescription(), PHP_EOL;
            //$fileGenerator = new FileGenerator();
            //new TypeGenerator\UnionType();// cairo_path_data_t == Cairo\PathDataHeader | Cairo\PathDataPoint 
            //$fileGenerator->setClass($unionGenerator);
            //$this->packages[$docBook->id]->files[] = $fileGenerator;

            $fields = $union->getFields();
            /** @var VarDocBook $field */
            foreach ($fields as $field) {
                if ($field->getType()->isAnonymous()) {
                    $fileStructGenerator = new FileGenerator();

                    $type_union_name = $field->getType()->getName();
                    $classGenerator = new ClassGenerator($type_union_name);// UnionGenerator|EnumGenerator|AliasGenerator|ClassGenerator
                    //$propertiesGenerator = $this->loadPropertiesGenerator($struct, $classGenerator);

                    /** @var StructDocBook $structDocBook */
                    $structDocBook = $field->getType()->anony_definition;
                    $union_fields = $structDocBook->getFields();
                    $propertiesGenerator = [];

                    /** @var VarDocBook $field */
                    foreach ($union_fields as $union_field) {
                        
                        /** @var PropertyGenerator $propertyGenerator */
                        $propertyGenerator = new PropertyGenerator($union_field->name);
                        
                        /** @var TypeDocBook $type */
                        $type = $union_field->getType();
            
                        $php_type = $this->loadTypePhp($type->getName());
                        $typeGenerator = TypeGenerator::fromTypeString($php_type['generic']);
                        $typeGenerator->internal_type = $type->getName();
                        $typeGenerator->explicite_type = $php_type['specific'];
            
                        $propertyGenerator->setType($typeGenerator);
            
                        /** @var DocBlockGenerator $docBlockGenerator */
                        $docBlockGenerator = new docBlockGenerator();
                        //$docBlockGenerator->setLongDescription($union_field->getDescription());
            
                        $varTag = new VarTag();
                        $varTag->setTypes($typeGenerator->generate());
                        $varTag->setVariableName($propertyGenerator->getName());
                        $varTag->setDescription($union_field->getDescription());
                        $docBlockGenerator->setTag($varTag);
            
                        $propertyGenerator->setDocBlock($docBlockGenerator);
            
                        $propertiesGenerator[] = $propertyGenerator;
                    }
            
                    $classGenerator->addProperties($propertiesGenerator);

                    $fileStructGenerator->setClass($classGenerator);
                    //$fileGenerator->setFunctions($functionsGenerator);

                    $this->loadNamespace($fileStructGenerator, $union);
                    $this->loadFilename($fileStructGenerator, $union);
                    $this->fixeUse($fileStructGenerator, $classGenerator);// Dependencies & Includes
                    
                    $docBook = $union->getBook();
                    $this->packages[$docBook->id]->files[$type_union_name] = $fileStructGenerator;
        
                }

            }

            //echo $type_name, PHP_EOL;
            /*
            $typeGenerator = TypeGenerator::fromTypeString($type_name);
            $typeGenerator->internal_type = $name;
            $this->typesGenerator[$name] = $typeGenerator;
            */

            /*
            $typeGenerator = new TypeGenerator();
            */


            /*
            $classGenerator = new ClassGenerator($name);// UnionGenerator|EnumGenerator|AliasGenerator|ClassGenerator
            $classGenerator->setDocBlock($docClassGenerator);


            $functionsGenerator = $this->loadMethodsGenerator($union, $classGenerator);

            
            
            $fileGenerator->setClass($classGenerator);
            $fileGenerator->setFunctions($functionsGenerator);

            $this->loadNamespace($fileGenerator, $union);
            $this->loadFilename($fileGenerator, $union);
            $this->fixeUse($fileGenerator, $classGenerator);// Dependencies & Includes
            
            $docBook = $union->getBook();
            $this->packages[$docBook->id]->files[] = $fileGenerator;
            */

        }
    }

    protected function loadAliasGenerator(AbstractDocBook $docBook) :? ClassGenerator {
        $alias = $this->kinds['alias'];

        foreach ($this->typedefsDocBook as $typedef) {

            if (array_key_exists($typedef->name, CairoClassifier::$map_type)) {
                // Do not export gint, gboolean etc...
                continue;
            }

            if (array_key_exists($typedef->name, $alias)) {
                $class_name = $alias[$typedef->name]['type'];
                // echo "Alias found : $typedef->name => $class_name\n";

                $fileGenerator = new FileGenerator();

                $aliasGenerator = new AliasClassGenerator($typedef->name);
                $aliasGenerator->setClassName($class_name);

                $fileGenerator->setAliasClass($aliasGenerator);
                //$fileGenerator->setAliasFunctions($functionsGenerator);


                $this->loadNamespace($fileGenerator, $typedef);
                $this->loadFilename($fileGenerator, $typedef);
                $this->fixeUse($fileGenerator, $aliasGenerator);// Dependencies & Includes
                // print_r($fileGenerator->getRequiredFiles());
                // echo $fileGenerator->getNamespace(), PHP_EOL;
                // echo $fileGenerator->getFilename(), PHP_EOL;

                $docBook = $typedef->getBook();
                $this->packages[$docBook->id]->files[$typedef->name] = $fileGenerator;
            }
        }


        return null;
    }


    /**
     * cairo_bool_t => int
     * cairo_path_data_t => cairo_path_data_header_t|cairo_path_data_point_t
     * cairo_t => cairo_t
     */
    protected function loadTypeGenerator(AbstractDocBook $docBook) {
        foreach (CairoClassifier::$map_type as $type=>$php_type) {
            $typeGenerator = TypeGenerator::fromTypeString($php_type);
            $typeGenerator->internal_type = $type;
            $typeGenerator->explicite_type = $php_type;
            $this->typesGenerator[$type] = $typeGenerator;
        }

        $typesdefs = $this->getTypedefs($docBook);
        foreach ($typesdefs as $type_name=>$typedef) {
        
            $typdef = $this->getDocBook()->getSourceCode()->getTypedef($type_name);
            //print_r($typdef);
            //echo $type_name, ', ', $typedef->name, ', ', $typdef['name'], ', ', $typdef['type'], PHP_EOL;
            if (array_key_exists($type_name, $this->typesGenerator)) {
                continue;
            }

            if ('struct'==$typdef['type']) {
                $typeGenerator = TypeGenerator::fromTypeString('object');
                $typeGenerator->internal_type = $typedef->name;
                $typeGenerator->explicite_type = $type_name;
            } else {
                if (array_key_exists($typdef['type'], TypeGenerator\AtomicType::BUILT_IN_TYPES_PRECEDENCE)) {
                    $typeGenerator = TypeGenerator::fromTypeString($typdef['type']);
                    $typeGenerator->internal_type = $typedef->name;
                    $typeGenerator->explicite_type = $typdef['type'];
                    //var_dump($typdef);
                } else {
                    $typeGenerator = TypeGenerator::fromTypeString($typedef->name);// object ?
                    $typeGenerator->internal_type = $typedef->name;
                    $typeGenerator->explicite_type = $typedef->name;
                }
            }

            $this->typesGenerator[$typedef->name] = $typeGenerator;
        }

        /*
        echo "\033[34;1mStructs: \033[0m", PHP_EOL;
        */
        $structs = $this->getStructs($docBook);
        foreach ($structs as $struct_name=>$struct) {
            if (array_key_exists($struct_name, $this->typesGenerator)) {
                continue;
            }

            if (in_array($struct_name, $this->kinds['class'])) {
                // Notice: GtkWidgetClass as string  use : GtkWidget::class
                $typeGenerator = TypeGenerator::fromTypeString('string');
                $typeGenerator->internal_type = $struct->name;//.'Class';
                $typeGenerator->explicite_type = 'string';
                $this->typesGenerator[$struct->name] = $typeGenerator;
            } else {
                $typeGenerator = TypeGenerator::fromTypeString($struct_name);
                $typeGenerator->internal_type = $struct->name;
                $typeGenerator->explicite_type = $struct->name;
                $this->typesGenerator[$struct->name] = $typeGenerator;
            }
        }

        $enums = $this->getEnums($docBook);
        foreach ($enums as $enum_name=>$enum) {
            if (array_key_exists($enum_name, $this->typesGenerator)) {
                continue;
            }

            $typdef = $this->getDocBook()->getSourceCode()->getTypedef($enum_name);

            if ($this->enumIsSupported()) {
                $typeGenerator = TypeGenerator::fromTypeString('enum');
                $typeGenerator->explicite_type = $enum->name;
            } else {
                $typeGenerator = TypeGenerator::fromTypeString('int');
                $typeGenerator->explicite_type = 'int';
            }
            $typeGenerator->internal_type = $enum->name;
            $this->typesGenerator[$enum->name] = $typeGenerator;
        }

        $unions = $this->getUnions($docBook);
        foreach ($unions as $union_name=>$union) {
            if (array_key_exists($union_name, $this->typesGenerator)) {
                continue;
            }

            $type_name = [];
            $fields = $union->getFields();
            /** @var VarDocBook $field */
            foreach ($fields as $field) {
                if (!$field->getType()) {
                    echo 'No type for ', $field->getName(), ' in union ', $union_name, "\n";
                    continue;
                }

                if ($field->getType()->isAnonymous()) {
                    $type_union_name = $field->getType()->getName();
                    // Register type of Fields ?
                } else {
                    if (array_key_exists($field->getType()->getName(), CairoClassifier::$map_type)) {
                        $type_union_name = CairoClassifier::$map_type[$field->getType()->getName()];
                    } else {
                        $type_union_name = $field->getType()->getName();
                    }
                    // Register type of Fields ?
                }
                $type_name[$type_union_name] = 'key unique';
            }
            // Register Union type
            /*
            if ('GMutex'==$union_name) continue;
            if ('GTokenValue'==$union_name) continue;
            if ('GTypeCValue'==$union_name) continue;
            */
            //echo $union_name, ':', PHP_EOL;
            //echo implode('|', array_keys($type_name)), PHP_EOL;
            
            $typeGenerator = TypeGenerator::fromTypeString('union');
            $typeGenerator->internal_type = $union->name;
            $typeGenerator->explicite_type = implode('|', array_keys($type_name));
            $this->typesGenerator[$union->name] = $typeGenerator;
        }
        
        // foreach RefEntry
        $refEntries = $this->getRefEntries($docBook);
        foreach ($refEntries as $refEntry) {
            $this->loadTypeCallbacksGenerator($refEntry);
        }
        foreach ($refEntries as $refEntry) {
            $this->loadTypeFieldsGenerator($refEntry);
        }
        
        foreach ($refEntries as $refEntry) {
            $this->loadTypeMethodsGenerator($refEntry);
        }
        // foreach struct/object/class
        //TODO: register member type of structs
        // register type Classifier::$map_type

    }
    
    protected function enumIsSupported():bool {
        static $local_version = null;
        static $local_result = null;
        
        if ($local_version==$this->php_version && isset($local_result)) {
            return $local_result;
        }
        
        $local_version = $this->php_version;
        $zero = [0, 0, 0];
        $versions = explode('.', $this->php_version);
        $versions = array_replace($zero, $versions);
        
        $local_result = false;
        if ($versions[0]>8) {
            $local_result = true;
        } else if ($versions[0]==8 && $versions[1]>=1 ) {
            $local_result = true;
        }
        return $local_result;
    }

    public function loadTypePhp(string $name, TypeDocBook $type=null)
    {
        $php_type = array(
            'generic'=>'$',
            'specific'=>'$',
        );
        
        $sourceCode = $this->getDocBook()->getSourceCode();

        if ($sourceCode->hasTypedef($name)) {
            $data = $sourceCode->getTypedef($name);
            if ('struct'==$data['type']) {
                $php_type['generic'] = 'object';
                $php_type['specific'] = $name;
            } else if ('enum'==$data['type']) {
                $php_type['generic'] = 'enum';
                if ($this->enumIsSupported()) {
                    $php_type['specific'] = $name;
                } else {
                    $php_type['specific'] = 'int';
                }
            } else if ('union'==$data['type']) {
                $php_type['generic'] = 'union';
                //$php_type['specific'] = $name;
            } else if ('va_list'==$name) { 
                $php_type['generic'] = 'array';
                $php_type['specific'] = $name;
                //throw new \Exception("Unexpected type '$name'");
                //$type->setVariadic(true);
            } else {
                return $this->loadTypePhp($data['type'], $type);
            }
        } else if ($sourceCode->hasProto($name)) {
            $data = $sourceCode->getProto($name);
            $php_type['generic'] = 'callable';
            //$php_type['specific'] = '';
        } else if ('function'==$name) {
            $php_type['generic'] = 'callable';
            //$php_type['specific'] = '';
        } else if ('union'==$name) {
            $php_type['generic'] = 'union';
            //$php_type['specific'] = '';
        } else if ('struct'==$name) {
            $php_type['generic'] = 'object';
            //$php_type['specific'] = '';
        } else if ('array'==$name) {
            $php_type['generic'] = 'array';
            //$php_type['specific'] = '';
        } else if ('mixed'==$name) {
            $php_type['generic'] = 'mixed';
            $php_type['specific'] = 'mixed';
        } else if ('bool'==$name) {
            $php_type['generic'] = 'bool';
            $php_type['specific'] = 'bool';
        } else if ('string'==$name) {
            $php_type['generic'] = 'string';
            $php_type['specific'] = 'string';
        } else {
            //VOID | CHAR| SHORT| INT| LONG| FLOAT| DOUBLE| SIGNED| UNSIGNED| struct_or_union_specifier| enum_specifier| TYPE_NAME;
            
            if ('void'==$name || ''==$name) {
                //throw new \Exception("Unexpected type '$name'");
                $php_type['generic'] = 'void';
                $php_type['specific'] = '';
            } else if (0===strpos($name, 'struct ')) {
                //throw new \Exception("Unexpected type '$name'");
                $php_type['generic'] = 'object';
                //$php_type['specific'] = 'void';
            } else if (0===strpos($name, 'union ')) {
                throw new \Exception("Unexpected type '$name'");
                //$type->php_type = 'object';use intersecr ?
            } else if (0===strpos($name, 'enum ')) {
                //throw new \Exception("Unexpected type '$name'");
                $php_type['generic'] = 'enum';
                if ($this->enumIsSupported()) {
                    $php_type['specific'] = $name;
                } else {
                    $php_type['specific'] = 'int';
                }
            } else {
                $keywords = preg_split("/\s+/", $name);
                if (in_array('char', $keywords)) {
                    $php_type['generic'] = 'string';
                    $php_type['specific'] = 'string';
                } else if (in_array('float', $keywords)
                        || in_array('double', $keywords) ) {
                    $php_type['generic'] = 'float';
                    $php_type['specific'] = 'float';
                } else if (in_array('short', $keywords)
                        || in_array('int', $keywords)
                        || in_array('long', $keywords)
                        || in_array('signed', $keywords)
                        || in_array('unsigned', $keywords)
                ) {
                    $php_type['generic'] = 'int';
                    $php_type['specific'] = 'int';
                } else {
                    throw new \Exception("Unexpected type '$name'");
                }
            }
        }
        
        return $php_type;
    }
    protected function loadExpliciteTypeCallbacksParameterGenerator(ParameterDocBook $parameterDocBook):string {
        $param = '';
        /** @var FunctionDocBook $functionDocBook */
        $functionDocBook = $parameterDocBook->parent;

        /** @var TypeDocBook $typeDocBook */
        $typeDocBook = $parameterDocBook->getType();
        if ($typeDocBook) {
            $type = $parameterDocBook->getType();
            if (array_key_exists($type->getName(), $this->typesGenerator)) {
                $typeGenerator = $this->typesGenerator[$type->getName()];
                $php_type = [
                    'specific'=> $typeGenerator->explicite_type,
                ];
                //$this->loadTypePhp($typeGenerator->explicite_type, null);
            } else {
                $php_type = $this->loadTypePhp($type, null);
                // TODO: generic loadTypePhp(string, ParameterDocBook|VarDocBook)
                if ('void'==$type && $parameterDocBook->getPass()) {
                    $php_type['specific'] = 'mixed';//------------------------------------------------------- FIX put it in loadTypePhp()
                }
                // if type specific is recorded : use it else use generic
                //$php_type['generic'];
            }
            if (empty($parameterDocBook->getName())) {
                $param = $php_type['specific'];
            } else {
                $param = $php_type['specific'].' $'.$parameterDocBook->getName();
            }
        }
        if (is_null($param)) {
            throw new Exception($functionDocBook->name.' :: '.$parameterDocBook->getName().':'.$php_type['specific']);
        }
        /*if ('GDBusMessageFilterFunction'==$functionDocBook->name) {
            throw new Exception('stop la');
        }*/

        return $param;
    }

    protected function loadTypeCallbacksGenerator($refEntryDocBook) {
        $functions = $refEntryDocBook->functions();

        /** @var FunctionDocBook $functionDocBook */
        foreach($functions as $name=>$functionDocBook) {
            if ($functionDocBook->isCallback()) {
        
                // typedef gint    (*GPollFunc)    (GPollFD *ufds, guint    nfsd, gint     timeout_);
                $typeGenerator = TypeGenerator::fromTypeString('callable');

                $params = [];
                /** @var ParameterDocBook $parameterDocBook */
                foreach($functionDocBook->getParameters() as $parameterDocBook) {
                    $param = $this->loadExpliciteTypeCallbacksParameterGenerator($parameterDocBook);
                    if (!empty($param))
                        $params[] = $param;
                }

                /** @var ParameterDocBook $returnDocBook */
                $returnDocBook = $functionDocBook->getParameterReturn();
                $param = $this->loadExpliciteTypeCallbacksParameterGenerator($returnDocBook);
                if (!empty($param))
                    $explicite_type = $param . ' ';
                else
                    $explicite_type = '';

                $explicite_type .= $name.'(';
                $explicite_type .= implode(', ', $params);
                $explicite_type .= ')';

                $typeGenerator->internal_type = $name;// GPollFunc
                $typeGenerator->explicite_type = $explicite_type;// int GPollFunc(GPollFD $ufds, int $nfsd, int $timeout_)
                $this->typesGenerator[$name] = $typeGenerator;// 'GPollFunc' => 'callable'
            }
        }
    }

    /**
     * Recover all type from Struct/StructClass
     */
    protected function loadTypeFieldsGenerator($refEntryDocBook) {
        $structs = $refEntryDocBook->structs();
        /** @var StructDocBook $structDocBook */
        foreach($structs as $struct_name=>$structDocBook) {
            /** @var VarDocBook $fieldDocBook */
            foreach($structDocBook->getFields() as $field_name=>$fieldDocBook) {
                $typeDocBook = $fieldDocBook->getType();
                if (array_key_exists($typeDocBook->getName(), $this->typesGenerator)) {
                    continue;
                }
                $php_type = $this->loadTypePhp($typeDocBook->getName());

                $typeGenerator = TypeGenerator::fromTypeString($php_type['generic']);
                $typeGenerator->internal_type = $typeDocBook->getName();
                $typeGenerator->explicite_type = $php_type['specific'];
                $this->typesGenerator[$typeDocBook->getName()] = $typeGenerator;
            }
        }

    }
    
    /** @param RefEntryDocBook $refEntryDocBook */
    protected function loadTypeMethodsGenerator($refEntryDocBook) {
        $classifier = new CairoClassifier();
        $functions = $refEntryDocBook->functions();

        /** @var FunctionDocBook $functionDocBook */
        foreach($functions as $name=>$functionDocBook) {
            
            if ($functionDocBook->isCallback()) {
                if (self::ENABLE_TRACE) echo $refEntryDocBook->id, '::', $functionDocBook->name, '( prototype)', PHP_EOL;
                continue;
            }
            
            if ($functionDocBook->isMacro()) {
                if (self::ENABLE_TRACE) echo $refEntryDocBook->id, '::', $functionDocBook->name, '( macro)', PHP_EOL;
                continue;
            }
            //echo "\033[34;1m",$name,": \033[0m", PHP_EOL;

            /** @var ParameterDocBook $parameterDocBook */
            $parameterDocBook =$functionDocBook->getParameterReturn();
            $typeDocBook = $parameterDocBook->getType();
            if ($typeDocBook) {
                $type = $parameterDocBook->getType();
                if (array_key_exists($type->getName(), $this->typesGenerator)) {
                    continue;
                }
                $php_type = $this->loadTypePhp($type->getName());

                $typeGenerator = TypeGenerator::fromTypeString($php_type['generic']);
                $typeGenerator->internal_type = $type->getName();
                $typeGenerator->explicite_type = $php_type['specific'];
                $this->typesGenerator[$typeDocBook->getName()] = $typeGenerator;
            }

            /** @var ParameterDocBook $parameterDocBook */
            foreach($functionDocBook->getParameters() as $parameterDocBook) {
                /** @var TypeDocBook $typeDocBook */
                $typeDocBook = $parameterDocBook->getType();
                if ($typeDocBook) {
                    $type = $parameterDocBook->getType();
                    if (array_key_exists($type->getName(), $this->typesGenerator)) {
                        continue;
                    }

                    $php_type = $this->loadTypePhp($type->getName());

                    $typeGenerator = TypeGenerator::fromTypeString($php_type['generic']);
                    $typeGenerator->internal_type = $type->getName();
                    $typeGenerator->explicite_type = $php_type['specific'];
                    $this->typesGenerator[$typeDocBook->getName()] = $typeGenerator;
                } else {
                    echo "Skip $functionDocBook->name(", $parameterDocBook->getName(), ')', PHP_EOL;
                    //return null;
                }
/*
                if ($parameterDocBook->hasAnnotation(AnnotationDocBook::ANNOTATION_OUT)) {
                    $parameterGenerator->setPassedByReference(true);
                    $parameterGenerator->isOut(true);
                }
                if ($parameterDocBook->hasAnnotation(AnnotationDocBook::ANNOTATION_ARRAY)) {
                    $parameterGenerator->isArray(true);
                    $annotation = $parameterDocBook->getAnnotation(AnnotationDocBook::ANNOTATION_ARRAY);
                    if ($annotation->hasAttribute('length')) {
                        $length_param_name = $annotation->getAttribute('length');
                        $parameterGenerator->setArrayLengthParameter($length_param_name);
                    }
                    //$parameterGenerator->setArrayDimensions(true);
                    
                }
*/
                /** @var AnnotationDocBook $annotation
                 echo $parameterDocBook->getName(), PHP_EOL;
                $annotations = $parameterDocBook->getAnnotations();// [out] default is transfer-full
                if ($annotations) {
                    foreach ($annotations as $annotation) {
                        echo '  '.$annotation->getName(), PHP_EOL;
                        if ('transfer'==$annotation->getName()) {
                            if (in_array('none', $annotation->getAttributes())) {
                                echo '        ' . 'none', PHP_EOL;
                                } else {
                                    echo '        ' . 'full', PHP_EOL;
                                }
                            }
                            
                        }
                    }
                    */


            }

                // $this->loadMethodParametersGenerator($functionDocBook, $methodGenerator);
                // $this->loadMethodReturnGenerator($functionDocBook, $methodGenerator);
   
                //$this->typesGenerator[$union->name] = $typeGenerator;
        }
    }

    protected function skip(string $object, string $name=null): bool {
        if (isset($this->whitelist)) {
            if (array_key_exists($object, $this->whitelist)) {
                if ($name) {
                    if (in_array($name, $this->whitelist[$object])) {
                        return false;// object + function in whitelist
                    }
                } else {
                    return false;// object in whitelist
                }
            }
            return true;// not in whitelist
        }
        return false;// whitelist not used
    }

    /**
     * @var array[
     *   'class'=> ['name'=>string],// eg: GtkWidget
     *   'object'=> ['name'=>string],// eg: cairo_t
     *   'enum'=> ['name'=>string],// 
     *   'union'=> ['name'=>string],// cairo_path_data_header_t
     *   'alias'=> ['name'=>string, 'type'=>string],// only for object, or enum
     *   'builtin'=> string[],
     * ]
     */
    protected $kinds;

    protected function loadExtKinds(AbstractDocBook $docBook) {
        if (isset($this->kinds)) {
            return $this->kinds;
        }
        $this->kinds = array(
            'class'=>[],
            'object'=>[],
            'enum'=>[],
            'union'=>[],
            'alias'=>[],
            'builtin'=>[],// cairo_bool_t => int
        );

        $this->structsDocBook = $this->getStructs($docBook);
        $classes = [];
        $structs = [];
        foreach ($this->structsDocBook as $struct) {//'struct'==$t['type'] || 'enum'==$t['type'] || 'union'==$t['type']
            $suffix = substr($struct->name, -5);
            if ('Class'==$suffix) {
                $prefix = substr($struct->name, 0, -5);
                $classes[$prefix] = $struct->name;// GtkWidget=>GtkWidgetClass
            } else {
                $structs[$struct->name] = $struct->name;// GtkWidget=>GtkWidget
            }
        }

        $this->typedefsDocBook = $this->getTypedefs($docBook);
        $structs = [];
        $alias = [];
        $typedefs = [];
        foreach ($this->typedefsDocBook as $typedef) {//'struct'==$t['type'] || 'enum'==$t['type'] || 'union'==$t['type']
            $t = $this->getDocBook()->getSourceCode()->getTypedef($typedef->name);

            if ('struct'==$t['type']) {
                if (in_array($typedef->name, CairoClassifier::$map_class)) {
                    $prefix = substr($typedef->name, 0, -5);
                    $classes[$prefix] = $typedef->name;
                    continue;
                }
                $structs[$typedef->name] = $typedef->name;
            } else if ('enum'==$t['type']) {
                $enums[$typedef->name] = $typedef->name;
            } else if ('union'==$t['type']) {
                $unions[$typedef->name] = $typedef->name;
            } else {
                if (array_key_exists($t['type'], TypeGenerator\AtomicType::BUILT_IN_TYPES_PRECEDENCE)) {
                    $typedefs[$typedef->name] = $typedef->name;
                    continue;
                }
                if (in_array($typedef->name, CairoClassifier::$map_class)) {
                    $prefix = substr($struct->name, 0, -5);
                    $classes[$prefix] = $struct->name;
                    continue;
                }
                if (in_array($typedef->name, CairoClassifier::$map_object)) {
                    $structs[$typedef->name] = $typedef->name;
                    continue;
                }
                $alias[$typedef->name] = array('name'=>$typedef->name, 'type'=>$t['type']);
                //echo $t['name'], ' alias ', $t['type'], PHP_EOL;
            }
        }

        $structs = array_diff_key($structs, $classes);

        $this->kinds['class'] = $classes;
        $this->kinds['object'] = $structs;
        $this->kinds['alias'] = $alias;
        $this->kinds['builtin'] = $typedefs;


        $this->enumsDocBook = $this->getEnums($docBook);
        $enums = [];
        foreach ($this->enumsDocBook as $enum) {//'struct'==$t['type'] || 'enum'==$t['type'] || 'union'==$t['type']
            $enums[$enum->name] = $enum->name;

        }
        $this->kinds['enum'] = $enums;

        $this->unionsDocBook = $this->getUnions($docBook);
        $unions = [];
        foreach ($this->unionsDocBook as $union) {//'struct'==$t['type'] || 'enum'==$t['type'] || 'union'==$t['type']
            $unions[$union->name] = $union->name;
        }
        $this->kinds['union'] = $unions;
        /*
        echo "Class objects : \n";
        print_r(array_keys($this->kinds['class']));
        echo "Opaque objects : \n";
        print_r(array_keys($this->kinds['object']));
        echo "Enum objects : \n";
        print_r(array_keys($this->kinds['enum']));
        echo "Union types : \n";
        print_r(array_keys($this->kinds['union']));
        echo "Alias objects : \n";
        print_r(array_keys($this->kinds['alias']));
        echo "Alias types : \n";
        print_r(array_keys($this->kinds['typedef']));
        */
        /*
        echo "Class objects : ", implode(', ', array_keys($this->kinds['class'])), PHP_EOL;
        echo "Opaqu objects : ", implode(', ', array_keys($this->kinds['object'])), PHP_EOL;
        echo "Enum objects : ", implode(', ', array_keys($this->kinds['enum'])), PHP_EOL;
        echo "Union types : ", implode(', ', array_keys($this->kinds['union'])), PHP_EOL;
        echo "Alias objects : ", implode(', ', array_keys($this->kinds['alias'])), PHP_EOL;
        echo "Alias types : ", implode(', ', array_keys($this->kinds['typedef'])), PHP_EOL;
        */
        
    }

    /**
     * @return Package[] 
     */
    public function getCodeGenerator(AbstractDocBook $docBook) {
        $this->loadPackages($docBook);
        $this->loadExtKinds($docBook);
        /**
         echo "Class defined:", PHP_EOL;
         foreach ($this->kinds['class'] as $name=>$klass) {
             echo "\t+ ", $klass, PHP_EOL;
            }
            echo "Struct defined:", PHP_EOL;
            foreach ($this->kinds['object'] as $name=>$klass) {
                echo "\t+ ", $klass, PHP_EOL;
            }
            */
            /*
            print_r($this->kinds['class']['GType']);
            print_r($this->kinds['alias']['GType']);
            print_r(array_keys($this->kinds['alias']));
            //print_r($this->kinds);
            print_r(array_keys($this->structsDocBook));
            */
            /*
            print_r(array_keys($this->kinds['class']));
            print_r(array_values($this->kinds['class']));
   
            $this->structsDocBook['GTypeClass'];
            */

        // step 1] register type (1.600ms)
        // ====================================================================
        $this->loadTypeGenerator($docBook);
        /**
        echo "Type defined:", PHP_EOL;
        foreach ($this->typesGenerator as $name=>$typeGenerator) {
            echo "\t+ ", $name, ': ', $typeGenerator->generate(), ' => ', $typeGenerator->internal_type, " : \033[32;1m", $typeGenerator->explicite_type, "\033[0m", PHP_EOL;
        }
         * gintptr => int  utilise la reference
         * GMutexLocker void ???
         * GStrv peut-etre en array
         * 
         * GTestCase: object Why ?
         * GQuark: \GQuark
         * GTimeSpan: \GTimeSpan => GTimeSpan
         * 
         * cairo_t: object => cairo_t
         * cairo_pattern_t: object => cairo_pattern_t
         *  time_t: int 
         * GThreadError: int is enum ?
         * 
         * FILE: int as resource ?
         */


        // step 2] creat each object (200ms)
        // ====================================================================
        $this->loadClassGenerator($docBook);// GtkWidget[Class]
        $this->loadObjectGenerator($docBook);// cairo_t; GtkRequisition
        $this->loadEnumGenerator($docBook);// cairo_path_data_type_t; GtkPosWindow
        $this->loadAliasGenerator($docBook);// GtlAllocation => GdkRectangle
        $this->loadUnionGenerator($docBook);
        /*
        */

        // TODO when creat property use TypeGenerated

        // use TypeGenerator : eg: cairo_bool_t => int
        // step 3] creat function for each class (after each object exist)
        // ====================================================================
        /*
        $this->loadClassFunctions($docBook);// GtkWidget[Class]
        */
        // $this->loadObjectFunctions($docBook);// GtkWidget[Class]
        //unused $this->loadEnumFunctions($docBook);// GtkWidget[Class]
        //unused $this->loadAliasFunctions($docBook);// GtkWidget[Class]
        //unused $this->loadUnionFunctions($docBook);// GtkWidget[Class]

        return $this->packages;
    }

    /**
     * @return Package[] 
     */
    public function getCodeGenerator__(AbstractDocBook $docBook) {
        $packages = $this->loadPackages($docBook);

        $classes = [];
        $instances = [];
        $this->structsDocBook = $this->getStructs($docBook);
        $this->typedefsDocBook = $this->getTypedefs($docBook);
        $this->enumsDocBook = $this->getEnums($docBook);
        // enum, union, etc
        $structs = $this->structsDocBook;
        foreach ($structs as $struct) {
            $suffix = substr($struct->name, -5);
            if ('Class'==$suffix) {
                $prefix = substr($struct->name, 0, -5);
                $classes[$prefix] = $struct->name;
            } else {
                $instances[$struct->name] = $struct->name;
            }
        }
        //print_r(array_keys($structs));
        //print_r($classes);
        //print_r($instances);
        $instances = array_diff_key($instances, $classes);
        echo count($structs), ' struct found. ', count($instances), ' + ', count($classes), '*2', PHP_EOL;
        
        $refEntry = null;
        $classGenerator = null;

        //$packageGenerator = new PackageGenerator($name);
        foreach($classes as $name=>$class_name) {
            /** @var StructDocBook */
            $struct = $structs[$name];

            $this->requiredFiles = [];
            $this->useFiles = [];
            
            if ($this->skip($name)) continue;
            //if ($this->skip($struct->parent->id)) continue;

            $docFileGenerator = new DocBlockGenerator();
            $docFileGenerator->setTags([
                new LicenseTag(null, 'GPL 3.0'),
                new AuthorTag("mail", 'mail@gmail.com')
            ]);
            $docFileGenerator->setLongDescription("Zeng Extension (https://github.com/)");
            $fileGenerator = new FileGenerator();
            $fileGenerator->setDocBlock($docFileGenerator);

            $docClassGenerator = new DocBlockGenerator();
            $docClassGenerator->setLongDescription("Class $name");
            

            $classGenerator = new ClassGenerator($name);
            $classGenerator->setDocBlock($docClassGenerator);


            $functionsGenerator = $this->loadMethodsGenerator($struct, $classGenerator);

            
            
            $fileGenerator->setClass($classGenerator);
            $fileGenerator->setFunctions($functionsGenerator);

            $this->loadNamespace($fileGenerator, $struct);
            $this->loadFilename($fileGenerator, $struct);
            $this->fixeUse($fileGenerator, $classGenerator);// Dependencies & Includes
            
            $docBook = $struct->getBook();
            $packages[$docBook->id]->files[] = $fileGenerator;

            if (self::ENABLE_BREAK) 
            break;
        }

        $begin = 1;// 7=>cairo_matrix_t
        $end = $begin +1;
        $do_it = 0;
        foreach($instances as $name=>$struct_name) {

            if (self::ENABLE_BREAK) 
            if ($do_it++<$begin) continue;
            
            $this->requiredFiles = [];
            $this->useFiles = [];

            if ($this->skip($name)) continue;

            /** @var StructDocBook */
            $struct = $structs[$name];

            $docFileGenerator = new DocBlockGenerator();
            $docFileGenerator->setTags([
                new LicenseTag(null, 'GPL 3.0'),
                new AuthorTag("mail", 'mail@gmail.com')
            ]);
            $docFileGenerator->setLongDescription("Zeng Extension (https://github.com/)");
            $fileGenerator = new FileGenerator();
            $fileGenerator->setDocBlock($docFileGenerator);

            $docClassGenerator = new DocBlockGenerator();
            $docClassGenerator->setLongDescription("Class $name");
            

            $classGenerator = new ClassGenerator($name);
            $classGenerator->setDocBlock($docClassGenerator);


            $functionsGenerator = $this->loadMethodsGenerator($struct, $classGenerator);
            $propertiesGenerator = $this->loadPropertiesGenerator($struct, $classGenerator);
            
            
            $fileGenerator->setClass($classGenerator);
            $fileGenerator->setFunctions($functionsGenerator);

            $this->loadNamespace($fileGenerator, $struct);
            $this->loadFilename($fileGenerator, $struct);
            $this->fixeUse($fileGenerator, $classGenerator);// Dependencies & Includes

            $docBook = $struct->getBook();
            $packages[$docBook->id]->files[] = $fileGenerator;

            if (self::ENABLE_BREAK) 
            if ($do_it>=$end) break;
        }

        $begin = 0;// 0=>cairo_t
        $end = $begin +1;
        $do_it = 0;
        /** @var TypedefDocBook $typedef */
        foreach($this->typedefsDocBook as $name=>$typedef) {

            if (self::ENABLE_BREAK) 
            if ($do_it++<$begin) continue;

            $this->requiredFiles = [];
            $this->useFiles = [];

            //echo "* RUNNING : $name\n";
            if ($this->skip($name)) continue;


            $docFileGenerator = new DocBlockGenerator();
            $docFileGenerator->setTags([
                new LicenseTag(null, 'GPL 3.0'),
                new AuthorTag("mail", 'mail@gmail.com')
            ]);
            $docFileGenerator->setLongDescription("Zeng Extension (https://github.com/)");
            $fileGenerator = new FileGenerator();
            $fileGenerator->setDocBlock($docFileGenerator);

            $docClassGenerator = new DocBlockGenerator();
            $docClassGenerator->setLongDescription("Class $name");
            $docClassGenerator->setTags([
                new GenericTag('package', 'Cairo'),
                new GenericTag("internal", 'stub')
            ]);
            
            $classGenerator = new ClassGenerator($name);
            $classGenerator->setDocBlock($docClassGenerator);

            $functionsGenerator = $this->loadMethodsGenerator($typedef, $classGenerator);
            //$propertiesGenerator = $this->loadPropertiesGenerator($struct, $classGenerator);

            
            $fileGenerator->setClass($classGenerator);
            $fileGenerator->setFunctions($functionsGenerator);
            
            $this->loadNamespace($fileGenerator, $typedef);
            $this->loadFilename($fileGenerator, $typedef);
            $this->fixeUse($fileGenerator, $classGenerator);// Dependencies & Includes

            $docBook = $typedef->getBook();
            $packages[$docBook->id]->files[] = $fileGenerator;


            if (self::ENABLE_BREAK) 
            if ($do_it>=$end) break;
        }

        //debug:
        //echo $fileGenerator->generate();
        
        echo "\n", PHP_EOL;
        echo "next create dto(xml, php, Ext)\n";
        echo 'ClassGenerator represente a generic(C/Php) code model', PHP_EOL;
        echo "TODO : returnType dereference see : [out][transfer full];\n";
        echo "TODO: GProperty, GProperty-child, GSignal, Style;\n";
        echo "FIX: qualifier is method: cairo_surface_hello(cairo_t *cr) can be catched by cairo_t instead of sttatic cairo_surface()\n";
        echo "TODO: fixeUse\n";
        echo "Use ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX to specify return type \n";
        echo "in PHP_FUNCTION CHECK_CAIRO_VERSION if is avalable \n";// check lib installed | systeme dependence

        echo "ArgumentDto implement all the type\n";
        echo "rename ArgumentsDto to FunctionArgsDto";

        echo "TODO: search comment at : 'not found)'";// cairo_copy_path n'est pas crée car elle est défini dans un autre fichier
        echo "Cairo-Paths : cairo_copy_path(cairo_t *cr) do not found class; it's an error ? \n";

        echo "zend_object_handlers\n";
        echo "zend_class_entry_handlers\n";
        echo "object_handlers \n";
        echo "zend-user API (php_cairo_t_new(), php_cairo_operator_t_new(), ...) \n";// PARSE_PARAM if isOut lazyLoad
        echo "cairo_bool_t is int do not use class\n";
        

        /*$classGenerator->;*/

        /*
        $functions = $this->getFunctions($docBook);
        echo count($functions), ' functions found.', PHP_EOL;

        $func = $functions[10];
        echo $func->name, '()', PHP_EOL;
        echo $func->parent->id, PHP_EOL;
        echo $func->parent->parent->title, PHP_EOL;
        echo $func->parent->parent->parent->title, PHP_EOL;
        echo $func->parent->parent->parent->parent->title, PHP_EOL;
        echo $func->parent->parent->parent->parent->parent->title, PHP_EOL;
        echo null==$func->parent->parent->parent->parent->parent->parent ? 'null' : '...' , PHP_EOL;
        */


        return $packages;
    }

}
