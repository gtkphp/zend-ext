<?php

namespace Zend\ExtGtk;

use Zend\ExtGtk\Implementation;

use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;

class Cairo {

    public $cairo_t;
    public $cairo_path_t;
    public $cairo_surface_t;

    public function __construct()
    {
        $this->cairo_t = new CairoCairo();
        $this->cairo_path_t = new CairoPath();
        $this->cairo_surface_t = new CairoSurface();
    }
}

class CairoCairo extends Implementation{

    function cairo_destroy() {
        $output  = '    cairo_destroy(cr);'.PHP_EOL;
        $output .= '    php_cr->ptr = NULL;'.PHP_EOL;
        return $output;
    }

    // add convenience function( get all methode and strstr('php_'))
    // TODO : in Implementation create function foo($name) foreach($this->name->methodes as $function)
    function php_cairo_new($declaration=false) {
        if ($declaration)
        return 'php_cairo_t * php_cairo_new();';
        
        $output  = 'php_cairo_t *'.PHP_EOL;
        $output .= 'php_cairo_new() {'.PHP_EOL;
        $output .= '    zend_object *zobj = php_cairo_t_create_object(php_cairo_t_class_entry);'.PHP_EOL;
        $output .= '    return ZOBJ_TO_PHP_CAIRO_T(zobj);'.PHP_EOL;
        $output .= '}'.PHP_EOL;
        return $output;
    }
}

class CairoPath extends Implementation {
    function cairo_path_destroy() {
        $output  = '    cairo_path_destroy(path);'.PHP_EOL;
        $output .= '    php_path->ptr = NULL;'.PHP_EOL;
        return $output;
    }
}

class CairoSurface extends Implementation {
    function cairo_surface_destroy() {
        $output  = '    cairo_surface_destroy(surface);'.PHP_EOL;
        $output .= '    php_surface->ptr = NULL;'.PHP_EOL;
        return $output;
    }
}
