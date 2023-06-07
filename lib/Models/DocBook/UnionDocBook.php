<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\TraitVersionDocBook;
use Zend\Ext\Models\DocBook\TraitDescriptionDocBook;
use Zend\Ext\Models\DocBook\VarDocBook;

/**
 */
class UnionDocBook extends AbstractDocBook
{
    /** @var string $name The public name of struct */
    public $name;
    public function getName() {
        return $this->name;
    }

    use TraitDescriptionDocBook;

    /**
     * @var VarDocBook[]
     */
    public $fields = [];

    public function setFields(array $fields): self
    {
        $this->fields = [];
        foreach($fields as $name=>$field) {
            $this->addField($field);
        }
        return $this;
    }
    /**
     * @var VarDocBook $member
     */
    public function addField($field): self
    {
        $this->fields[$field->name] = $field;
        return $this;
    }
    public function getFields(): array
    {
        return $this->fields;
    }
    /**
     * @return VarDocBook|null
     */
    public function getField($name):? VarDocBook
    {
        foreach($this->fields as $var_name=>$field) {
            if ($field->name == $name) {
                return $field;
            }
        }
        return null;
    }

    
    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'union ('.$this->name.') {';
        //$output .= $tab . '    "'.$this->getDescription().'"'.PHP_EOL;
        /*
        $output .= PHP_EOL;
        foreach($this->fields as $field) {
            //$output .= $tab . '    "'.$field->getDescription().'"'.PHP_EOL;
            $output .= $field->__toString();
        }
        $output .= $tab;
        */
        $output .= '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}