<?php

namespace Zend\ExtGtk;

use Zend\ExtGtk\Documentation\Cairo\Cairo as CairoDocumentation;
//use Zend\ExtGtk\Gdk\Documentation as GdkDocumentation;

class Documentation {

    static public function Factory(string $package) {
        $doc = new self();
        return $doc;
    }

    public function example(string $name):string {
        $filename = realpath(__DIR__.'/../data/'.$name.'.xml');
        if ($filename) {
            $strxml = file_get_contents($filename);
            return $strxml;
        }
        return '';
    }

    public function refpurpose(string $name):string {
        switch($name) {
            case 'cairo_create': return 'Create a new graphic context';
            default: return '';
        }
    }
    


}
