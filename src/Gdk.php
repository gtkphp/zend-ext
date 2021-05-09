<?php

namespace Zend\ExtGtk;

use Zend\ExtGtk\Implementation;

use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;

class Gdk {

    public $GdkPixbuf;
    public $GdkWindow;

    public function __construct()
    {
        $this->GdkPixbuf = new GdkPixbuf();
        $this->GdkWindow = new GdkWindow();
    }
}

class GdkPixbuf extends Implementation {
}

class GdkWindow extends Implementation {
}
