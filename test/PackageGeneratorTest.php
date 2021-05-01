<?php

namespace ZendTest\Ext;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\Error\Error;

use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\DocBook\Cairo as CairoDocBook;
use Zend\Ext\Services\DocBook\Gtk as GtkDocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;
use Zend\Ext\Services\SourceCode\Gtk as GtkSourceCode;

define('APP_DIR', realpath(__DIR__.'/..'));


class PackageGeneratorTest extends TestCase
{
    public function testDump() {
        $var = new \StdClass();
        $var->foo = 'sdg';
        $var->prop = new \StdClass();
        $var->prop->bar = new \StdClass();
        $var->prop->bar->var = array('jh', 'oiu', 'kjhkjh');// output : '...'
        //$widget->prop->bar->properties = array('jh', 'oiu', 'kjhkjh');// output : '...'
        //$widget->prop->bar->properties['app-paintable'] = ...
        //
        var_dump($var);
    }

    public function testCairo() {
        $tag = '2.56.4';
        $log_dir = APP_DIR."/log/glib-$tag";
        $tmp_dir = APP_DIR.'/tmp';
        $output_dir = APP_DIR.'/output';
        $log = $log_dir.'/log.txt';
        
        `mkdir -p $log_dir`;
        `mkdir -p $output_dir`;
        //`mkdir -p $output_dir/API`;
        //`chmod u+w $log_dir`;
        
        
        `touch $log`;
        //`touch $output_dir/API/GHashTable.php`;
        //`touch $output_dir/g-hash-table.c`;
        
        
        `echo "Starting..." > $log`;
        

        $src_dir = '/home/dev/Projects/gtk';
        $build_dir = '/home/dev/Projects/gtk-build-doc';// has no effect
        $sourceCode = new GtkSourceCode($src_dir, $build_dir);
        $sourceCode->addBlackList(array('STRUCT'=>array('utimbuf')));
        $sourceCode->loadTypes('/home/dev/Projects/glib-build-doc/docs/reference/glib/glib-decl.txt');
        $sourceCode->loadTypes('/home/dev/Projects/glib-build-doc/docs/reference/gobject/gobject-decl.txt');// depend on glib-decl.txt
        $sourceCode->loadTypes('/home/dev/Projects/cairo/doc/public/cairo-decl.txt');// depend on glib-decl.txt
        
        $sourceCode->loadTypes('/home/dev/Projects/gtk-build-doc/docs/reference/gdk/gdk3-decl.txt');// depend on cairo-decl.txt
        //var_dump($sourceCode->getStruct('MotifWmInfo'));
        //var_dump($sourceCode->getStruct('MotifWmHints'));
        //var_dump($sourceCode->getStruct('MwmHints'));
        $sourceCode->loadTypes('/home/dev/Projects/gtk-build-doc/docs/reference/gtk/gtk3-decl.txt');

        $docBook = new GtkDocBook();
        $docBook->addSourceCode($sourceCode);
        //$docBook->loadBook('/home/dev/Projects/glib/docs/reference/glib/glib-docs.xml');
        //$docBook->loadBook('/home/dev/Projects/glib/docs/reference/gobject/gobject-docs.xml');
        //$docBook->loadBook('/home/dev/Projects/glib/docs/reference/gio/gio-docs.xml');

        //$docBook->loadBook('/home/dev/Projects/cairo-1.14/doc/public/cairo-docs.xml');
        // retrive all file's xml ...
        // ex : '/home/dev/Projects/cairo/doc/public/xml/cairo.xml'
    
        if (true) {
            // generate Source PHP Extension
            $generator = CodeGenerator::Factory('C/Source/Glib', 'GlibNotUsedPut $docBook');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);
        }
        if (false) {
            // generate Header PHP Extension
            $generator = CodeGenerator::Factory('C/Header/Glib', 'Glib');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);
        }
        if (false) {
            // generate PHP API
            $generator = CodeGenerator::Factory('Php/Pp', 'Glib');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);
        }
        if (false) {
            // generate PHP Doc
            $generator = CodeGenerator::Factory('Xml/Doc', 'Glib');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);
        }

        
        $this->assertTrue(true);

    }

}
