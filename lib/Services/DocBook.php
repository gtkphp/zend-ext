<?php

namespace Zend\Ext\Services;

use Zend\Ext\Services\SourceCode;
use Zend\Ext\Services\CodeGenerator;

class DocBook
{
    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var array $sourceCode
     */
    protected $sourceCode = array();

    /**
     * @var array $codeGenerator
     */
    protected $codeGenerator = array();

    public function addSourceCode(SourceCode $service)
    {
        $serviceName = $service->getName();
        $this->sourceCode[$serviceName] = $service;
    }

    public function getSourceCode($name):SourceCode
    {
        return $this->sourceCode[$name];
    }

    /**
     * TODO: remove
     * @param \Zend\Ext\Services\CodeGenerator $service
     */
    public function addCodeGenerator(CodeGenerator $service)
    {
        $serviceName = $service->getName();
        $this->codeGenerator[$serviceName] = $service;
    }

    //public $useWhitelist = true;
    protected $whitelist = [];
    public function setWhitelist($whitelist) {
        $this->whitelist = $whitelist;
    }
    public function addWhitelist($primary, $secondary) {
        if (!isset($this->whitelist[$primary])) {
            $this->whitelist[$primary] = array();
        }
        $this->whitelist[$primary][]=$secondary;
    }
    public function isAllowed($primary, $secondary) {
        //if(!$this->current_package->useWhitelist) return true;
        if (null==$this->whitelist) {
            return true;
        }
        if (isset($this->whitelist[$primary])) {
            if (isset($this->whitelist[$primary][$secondary])) {
                return true;
            }
        }
        return false;
    }

}
