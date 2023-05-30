<?php

namespace ZendTest\Ext;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\Error\Error;

//use Zend\Ext\Models\PackageGenerator; => Zend\Ext\Models\DocBook\Package

use Zend\Ext\Models\Dto\ObjectDto;
use Zend\Ext\Models\Dto\PackageDto;
use Zend\Ext\Models\Dto\ExtensionDto;

/*
use Zend\Ext\Models\Dto\StructDto;
use Zend\Ext\Models\Dto\EnumDto;
use Zend\Ext\Models\Dto\UnionDto;
use Zend\Ext\Models\Dto\ClassDto;
use Zend\Ext\Models\Dto\FunctionDto;
use Zend\Ext\Models\Dto\MethodDto;
use Zend\Ext\Models\Dto\GroupDto;
use Zend\Ext\Models\Dto\FileDto;
use Zend\Ext\Models\Dto\ConstantDto;
*/

use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\DocBook\Cairo as CairoDocBook;
use Zend\Ext\Services\DocBook\Gtk as GtkDocBook;
use Zend\Ext\Services\SourceCode;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;
use Zend\Ext\Services\SourceCode\Gtk as GtkSourceCode;

use Zend\ExtGtk\Implementation;


class ModuleGeneratorTest extends TestCase
{
    public function dumpExtensionDto(ExtensionDto $packageDto) {
        print_r($packageDto);
    }

    public function testGLib() {
        // -lgtk-3 -lgdk-3 -lpangocairo-1.0 -lpango-1.0 -latk-1.0 -lcairo-gobject -lcairo -lgdk_pixbuf-2.0 -lgio-2.0 -lgobject-2.0 -lglib-2.0
        //-lpangocairo-1.0 -lcairo-gobject

        //define('APP_DIR', realpath(__DIR__.'/..'));
        $data_dir = __DIR__."/../data";
        $cache_file = $data_dir."/cache.txt";

        if (False) {
            $sourceCode = new GlibSourceCode();
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/glib-2.56.4.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gobject-2.56.4.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gio-2.56.4.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/cairo-1.15.10.h');
            $sourceCode->evaluate();// resolve enum value
            // Time: 15.73 seconds, Memory: 129.69 MB

            file_put_contents($cache_file, serialize(array('data'=>$sourceCode->array, 'macro'=>$sourceCode->defines)));
        } else {
            $sourceCode = new GlibSourceCode();
            $data = unserialize(file_get_contents($cache_file));
            $sourceCode->array = $data['data'];
            $sourceCode->defines = $data['macro'];
            // Time: 147 ms, Memory: 61.69 MB
        }

        
        $docBook = new GtkDocBook(__DIR__.'/../data/gtkphp.xml', '/home/dev/Projects/');
        $docBook->addSourceCode($sourceCode);// setSourceCode();
        //$docBook->enableTrace(false);
        
        $package = $docBook->getPackage();
        
        /*
        $generator = CodeGenerator::Factory('C/Source/Glib', 'GlibNotUsedPut $docBook');
        $generator->setDocBook($docBook);
        //$generator->addClassifier($glibClassifier, 'cairo');
        //$generator->addClassifier($gioClassifier, 'gio');
        //$generator->addClassifier($gobjectClassifier, 'gobject');
        //$generator->addClassifier($gdkClassifier, 'gdk');
        //$generator->addClassifier($gtkClassifier, 'gtk');
        $dto = $generator->getExtensionDto($docBook->getPackage());

        $this->dumpExtensionDto($dto);
        */


        $this->assertTrue(true);
    }

}
