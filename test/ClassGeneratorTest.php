<?php

namespace ZendTest\Ext;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\Error\Error;

use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;// rename by GlibParser
use Zend\Ext\Services\CodeGenerator\Php8 as Php8CodeGenerator;


class ClassGeneratorTest extends TestCase
{

    public function testDocumentation()
    {

    }
    public function testImplementation()
    {

    }
    public function testExtension()
    {
        $src_dir = '/home/dev/Projects/glib';
        $build_dir = '/home/dev/Projects/glib-build-doc';
        $service = new GlibSourceCode($src_dir, $build_dir);
        $service->addBlackList(array('STRUCT'=>array('utimbuf', 'GMarkupParser')));
        $service->loadTypes();

        $servicePhp = new Php8CodeGenerator();
        $servicePhp->setCode(CodeGenerator::C_CODE);

        // compare glib-decl vs glib docBook
        $docBook = new GlibDocBook();
        //$docBook->addServiceAPI($service);
        $docBook->addSourceCode($service);
        $docBook->addCodeGenerator($servicePhp);
        $docBook->load(/*doc.sgml*/);
        echo $docBook->save('/home/dev/Projects/gtkphp/output');

        $this->assertTrue(True);
    }
    public function testPhpWrapper()
    {
        // extends GtkWindow{ function add(); }
    }
    public function testPhpAPI()
    {
        /** clone glib-version */
        // step One : snif glib-decl.txt and store the result( Typedef, Enum, Struct...)
        // Step Two : snif documentation and generate CodeModel|Generator
        // Step Three : merge ...
        // Step for : generate

        $src_dir = '/home/dev/Projects/glib';
        $build_dir = '/home/dev/Projects/glib-build-doc';
        $service = new GlibSourceCode($src_dir, $build_dir);
        $service->addBlackList(array('STRUCT'=>array('utimbuf', 'GMarkupParser')));
        $service->loadTypes();

        $servicePhp = new Php8CodeGenerator();

        // compare glib-decl vs glib docBook
        $docBook = new GlibDocBook();
        $docBook->addSourceCode($service);
        $docBook->addCodeGenerator($servicePhp);
        $docBook->load(/*doc.sgml*/);
        echo $docBook->save('/home/dev/Projects/gtkphp/output');

        $this->assertTrue(True);
    }
    public function testGlibRepository()
    {
        $this->assertTrue(True);
        //try {
            $src_dir = '/home/dev/Projects/glib';
            $build_dir = '/home/dev/Projects/glib-build-doc';
            $service = new GlibSourceCode($src_dir, $build_dir);
            //$service->setOrderList("white", "black", "");
            $service->addBlackList(array('STRUCT'=>array('utimbuf', 'GMarkupParser')));
            //$service->addWhiteList(); for deprecated
            // $service->addOverrideList(array('STRUCT'=>array('utimbuf'=>'struct utimbuf;')));
            // order deny,allow
            // deny from all
            // allow from env=let_me_in
            $service->loadTypes();
            /*
            foreach ($service->data as $type => $data) {
                echo $type , PHP_EOL;
                foreach ($data as $group => $list) {
                    echo "\t", $group , PHP_EOL;
                }
            }
            */
            //print_r($service->data['TYPEDEF']['GDate']);
            //print_r($service->data['STRUCT']['_GDate']);
        //print_r($service->data['TYPEDEF']['GIConv']);
        //print_r($service->data['STRUCT']['GIConv']);

            //print_r($service->data['ENUM']['enums']['GBookmarkFileError']);

        /*} catch (Error $ex) {
            echo $ex->getMessage() . PHP_EOL;
            $this->assertTrue(FALSE);
        }*/
    }
}
