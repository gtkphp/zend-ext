<?php

namespace Zend\Ext\Models\DocBook;

use \DOMElement;
use Iterator;
use Exception;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\BookDocBook;

/**
 * @var string $title
 * @var SetInfoDocBook $info
 */
class SetDocBook extends AbstractDocBook {
    public $id;
    public $title;
    public $setinfo;

    protected $sets = [];
    protected $books = [];

    function addBook(BookDocBook $book):self { 
        $this->books[] = $book;
        return $this;
    }
    function books():array { 
        return $this->books;
    }

    function addSet(SetDocBook $set):self { 
        $this->sets[] = $set;
        return $this;
    }
    function sets():array { 
        return $this->sets;
    }

    public function getFunctions(AbstractDocBook $docBook) {
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

    public function getBooks(AbstractDocBook $docBook) {
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

    public function getRefEntries(AbstractDocBook $docBook) {
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
    public function getStructs(AbstractDocBook $docBook) {
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
    public function getEnums(AbstractDocBook $docBook) {
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
    public function getUnions(AbstractDocBook $docBook) {
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
    public function getTypedefs(AbstractDocBook $docBook) {
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

    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'set ('.$this->title.') {'.PHP_EOL;
        foreach($this->sets() as $set) {
            $output .= $set->__toString();
        }
        foreach($this->books() as $book) {
            $output .= $book->__toString();
        }
        $output .= $tab . '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}
