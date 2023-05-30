<?php

namespace Zend\Ext\View\Model;


class CodeGeneratorModel
{
    /**
     * Template to use when rendering this model
     *
     * @var string
     */
    protected $template = '';

    protected $codeGenerator;
    
    /**
     * Constructor
     *
     * @param  null|array|Traversable $variables
     * @param  array|Traversable $options
     */
    public function __construct($codeGenerator = null, $options = null)
    {
        $this->setCodeGenerator($codeGenerator);
    }

    /**
     * Set the template to be used by this model
     *
     * @param  string $template
     * @return ViewModel
     */
    public function setTemplate($template)
    {
        $this->template = (string) $template;
        return $this;
    }

    /**
     * Get the template to be used by this model
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set flag indicating whether or not this is considered a terminal or standalone model
     *
     * @param Code\Generator\AbstractGenerator
     * @return CodeGeneratorModel
     */
    public function setCodeGenerator($codeGenerator)
    {
        $this->codeGenerator = $codeGenerator;
        return $this;
    }

    /**
     *
     * @return Code\Generator
     */
    public function getCodeGenerator()
    {
        return $this->codeGenerator;
    }

    /**
     * Is this considered an interface ?
     *
     * @return object
     */
    public function convert($klass, $renderer)
    {
        return $klass::create($this->codeGenerator, $renderer);
    }

}
