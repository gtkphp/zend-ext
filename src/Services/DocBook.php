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

    public function addCodeGenerator(CodeGenerator $service)
    {
        $serviceName = $service->getName();
        $this->codeGenerator[$serviceName] = $service;
    }

    // load
    // save

}
