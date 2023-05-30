<?php

namespace Zend\Ext\Models\DocBook;

use Exception;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\TraitDescriptionDocBook;
use Zend\Ext\Models\DocBook\TraitAnnotationDocBook;
use Zend\Ext\Models\DocBook\TypeDocBook;
use Zend\Ext\Models\DocBook\AnnotationDocBook;
use Zend\Ext\Models\DocBook\TraitDeclarationDocBook;

/**
 * Parents: set.
 * Childrens: article, bookinfo, chapter, part, preface, ...
 * 
 * @var string $name
 */
class ParameterDocBook extends AbstractDocBook
{
    use TraitDescriptionDocBook;
    use TraitAnnotationDocBook;
    use TraitDeclarationDocBook;
    
    /** @var string $name */
    protected $name;
    
    /**
     * @var boolean
     */
    protected $isVariadic=False;
    /**
     * @var bool
     */
    protected $isOptional=False;
    /**
     * @var bool $isCallback
     */
    protected $isCallback = FALSE;
    /**
     * @var array of AnnotationDocBook
     */
    protected $annotations = [];
    
    public function setName($name) {
        if ('...'==$name) {
            $this->setVariadic();
        }
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }

    public function setVariadic($isVariadic=true)
    {
        $this->isVariadic = $isVariadic;
        return $this;
    }

    public function isVariadic()
    {
        return $this->isVariadic;
    }
    /**
     * @return bool
     */
    public function isOptional(): bool
    {
        return $this->isOptional;
    }

    /**
     * @param bool $isOptional
     */
    public function setIsOptional(bool $isOptional): void
    {
        $this->isOptional = $isOptional;
    }

    public function setIsCallback(bool $isCallback=True)
    {
        $this->isCallback = $isCallback;
        return $this;
    }
    public function isCallback()
    {
        return $this->isCallback;
    }

    public function isDeref():bool
    {
        $is_redef = $this->hasAnnotation(AnnotationDocBook::ANNOTATION_OUT)
                  | $this->hasAnnotation(AnnotationDocBook::ANNOTATION_INOUT);
        return $is_redef;
    }

    public function isIn():bool
    {
        $is_in = ! $this->hasAnnotation(AnnotationDocBook::ANNOTATION_OUT);
        return $is_in;
    }
    
    public function isTransferFull():bool {
        foreach($this->annotations as $annotation) {
            if ($annotation->getType() == AnnotationDocBook::ANNOTATION_TRANSFER) {
                $param = $annotation->getParam();
                if ('full'==$param) {
                    return true;
                }
            }
        }
        return false;
    }

    public function isArray():bool {
        foreach($this->annotations as $annotation) {
            if ($annotation->getType() == AnnotationDocBook::ANNOTATION_ARRAY) {
                return true;
            }
        }
        return false;
    }

    
    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'parameter ('.$this->name.') {'. $this->type->__toString() . '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}
