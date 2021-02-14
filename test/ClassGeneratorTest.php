<?php

namespace ZendTest\Ext;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\Error\Error;

use Zend\DocBook\Gtk\DocReference;
use Zend\Ext\Services\GlibSourceCode;// rename by GlibParser

define('GTK_DOC_SRC_DIR', '/home/dev/Projects/gtk/docs/reference/gtk');
define('GTK_DOC_BIN_DIR', '/home/dev/Projects/gtk-build-doc/docs/reference/gtk');

use ClassGenerator;

class ClassGeneratorTest extends TestCase
{
    public function testNow()
    {
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

        /*} catch (Error $ex) {
            echo $ex->getMessage() . PHP_EOL;
            $this->assertTrue(FALSE);
        }*/
    }
}
