<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\TraitVersionDocBook;
use Zend\Ext\Models\DocBook\TraitDescriptionDocBook;
use Zend\Ext\Models\DocBook\ConstantDocBook;

/**
 */
class EnumDocBook extends AbstractDocBook
{
    /** @var string $name The public name of struct */
    public $name;
    
    use TraitDescriptionDocBook;

    /**
     * @var ConstantDocBook[]
     */
    public $constants = [];

    public function setConstants(array $constants): self
    {
        $this->constants = [];
        foreach($constants as $name=>$constant) {
            $this->addConstant($constant);
        }
        return $this;
    }
    /**
     * @var ConstantDocBook $constant
     */
    public function addConstant($constant): self
    {
        $this->constants[$constant->name] = $constant;
        return $this;
    }
    public function getConstants(): array
    {
        return $this->constants;
    }
    /**
     * @return ConstantDocBook|null
     */
    public function getConstant($name):? ConstantDocBook
    {
        foreach($this->constants as $constant_name=>$constant) {
            if ($constant->name == $name) {
                return $constant;
            }
        }
        return null;
    }

    
    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'enum ('.$this->name.') {';
        /*
        $output .= PHP_EOL;
        foreach($this->constants as $constant) {
            //$output .= $tab . '    "'.$constant->getDescription().'"'.PHP_EOL;
            $output .= $constant->__toString();
        }
        $output .= $tab;
        */
        $output .= '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}