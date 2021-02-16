<?php

namespace Zend\Ext\Services;

use Zend\Ext\Services\SourceCode;

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

    public function addSourceCode(SourceCode $service)
    {
        $serviceName = $service->getName();
        $this->sourceCode[$serviceName] = $service;
    }

}
