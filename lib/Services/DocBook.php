<?php

namespace Zend\Ext\Services;

use Zend\Ext\Services\SourceCode;
use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Models\PackageGenerator;

class DocBook
{
    /**
     * @var bool $trace
     */
    protected $trace = true;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var SourceCode
     */
    protected $sourceCode = null;

    /**
     * @var array $codeGenerator
     */
    protected $codeGenerator = array();

    // add function addClassifier(SourceCode $service, $name)

    // rename by addSourceCode
    public function addSourceCode(SourceCode $service)
    {
        $this->sourceCode = $service;
    }

    public function getSourceCode($name=null):SourceCode
    {
        return $this->sourceCode;
    }

    /**
     * @return PackageGenerator
     */
    public function getPackage()
    {
        echo __METHOD__ . " Not implemented\n";
        return null;
    }
    public function enableTrace(bool $enable) : DocBook
    {
        $this->trace = $enable;
        return $this;
    }


    /**
     * TODO: remove, it's CodeGenerator who use DocBook
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
