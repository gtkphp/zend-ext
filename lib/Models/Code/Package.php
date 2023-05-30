<?php

namespace Zend\Ext\Models\Code;

use Zend\Ext\Models\Code\FileGenerator;

class Package
{
    public $name;

    /** @var FileGenerator[] $files */
    public $files = [];

}
