<?php

namespace Zend\Ext\Models\DocBook;

use Zend\Ext\Models\DocBook\AbstractDocBook;
use Zend\Ext\Models\DocBook\TraitVersionDocBook;
use Zend\Ext\Models\DocBook\TraitDescriptionDocBook;

/**
 * Parents: set.
 * Childrens: article, bookinfo, chapter, part, preface, ...
 * 
 * @var string $name
 */
class FunctionDocBook extends AbstractDocBook
{
    use TraitVersionDocBook;

    public $name;

    protected $isStatic = FALSE;
    protected $isVirtual = FALSE;// gtk_widget_show{GtkWidgetClass.show},  g_object_get_property{GObjectClass.get_property}
    protected $isOverride = FALSE;// gtk_widget_get_visible (GtkWidget *this);
    protected $isCallback = FALSE;// PrototypeGenerator ?
    protected $isMacro = FALSE;
    
    
    /**
     * @var Array of ParameterDocBook
     */
    protected $parameters = [];

    protected $parameter_return = null;

    use TraitDescriptionDocBook;

    protected $short_description = '';

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->short_description;
    }

    /**
     * @param string $short_description
     * @return FunctionDocBook
     */
    public function setShortDescription(string $short_description): FunctionDocBook
    {
        $this->short_description = $short_description;
        return $this;
    }

    public function setIsStatic(bool $isStatic=True)
    {
        $this->isStatic = $isStatic;
        return $this;
    }
    public function isStatic()
    {
        return $this->isStatic;
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

    public function setIsMacro(bool $isMacro=True)
    {
        $this->isMacro = $isMacro;
        return $this;
    }
    public function isMacro()
    {
        return $this->isMacro;
    }
    


    /**
     * @var DocBlockDocBook
     */
    protected $docBlock;


    /*
    public function setType(TypeGenerator $type)
    {
        $this->type = $type;
        $this->type->setParentGenerator($this);
        return $this;
    }

    public function getType(): TypeGenerator
    {
        return $this->type;
    }
    */

    /**
     *
     * signed
     * unsigned
     * short
     * long
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;
        return $this;
    }

    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * const
     */
    public function setQualifier($qualifier)
    {
        $this->qualifier = $qualifier;
        return $this;
    }

    public function getQualifier()
    {
        return $this->qualifier;
    }

    /**
     * *
     * &
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }


    public function getParameter(string $name):?ParameterDocBook {
        if (isset($this->parameters[$name])) {
            return $this->parameters[$name];
        }
        return null;
    }

    public function getParameterAt(int $index):?ParameterDocBook {
        $i = 0;
        foreach($this->parameters as $parameter) {
            if ($i == $index) {
                return $parameter;
            }
            $i++;
        }
        return null;
    }

    public function getParameters() {
        return $this->parameters;
    }

    /**
     * @param  array $parameters
     * @throws InvalidArgumentException
     * @return FunctionDocBook
     */
    public function setParameters($parameters) {
        $len = count($parameters);
        foreach($parameters as $parameter) {
            $this->addParameter($parameter);
        }

        return $this;
    }


    /**
     * @param  ParameterDocBook $parameter
     * @throws InvalidArgumentException
     * @return FunctionDocBook
     */
    public function addParameter($parameter)
    {
        $this->parameters[$parameter->getName()] = $parameter;

        return $this;
    }

    public function getParameterReturn()
    {
        return $this->parameter_return;
    }
    
    public function setParameterReturn($parameter)
    {
        $this->parameter_return = $parameter;
        return $this;
    }
    
    function __toString():string { 
        $tab = str_repeat(AbstractDocBook::$tab, AbstractDocBook::$indent);
        AbstractDocBook::$indent++;
    
        $output = '';
        $output .= $tab . 'function ('.$this->name.') {'.PHP_EOL;
        $output .= $tab . '}'.PHP_EOL;

        AbstractDocBook::$indent--;
        return $output;
    }
}