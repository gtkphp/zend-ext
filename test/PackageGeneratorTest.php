<?php

namespace ZendTest\Ext;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\Error\Error;

use Zend\Ext\Models\PackageGenerator;
use Zend\Ext\Models\StructGenerator;
use Zend\Ext\Models\EnumGenerator;
use Zend\Ext\Models\UnionGenerator;
use Zend\Ext\Models\ClassGenerator;
use Zend\Ext\Models\ObjectGenerator;
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

    /**
     * gtk+( Package)
     *   cairo( Package)
     *     cairo-drawing( Package)
     *       cairo_t( Class)
     *       cairo_path_t( Class)
     *  
     * 
     */
    public function dumStruct(StructGenerator $struct, $tab) {
        $indent = str_repeat('  ', $tab);
        $output = '';
        $output .= 'Struct('.$struct->getName().'):Object {'.PHP_EOL;
        foreach($struct->getMembers() as $member) {
            //echo $struct->getName(), PHP_EOL;
            $type_name = $member->getType()->getName();
            //$type_name = get_class($member);
            $output .= $indent.'  '.$member->getName().' ('.$type_name.');'.PHP_EOL;
        }
        $output .= $indent.'}'.PHP_EOL;
        return $output;
    }
    public function dumUnion(UnionGenerator $union, $tab) {
        $indent = str_repeat('  ', $tab);
        $output = '';
        $output .= 'Union('.$union->getName().'):Object {'.PHP_EOL;
        foreach($union->getMembers() as $name=>$member) {
            $type_name = $member->getType()->getName();
            //$type_name = get_class($member)
            $output .= $indent.'  '.$name.' ('.$type_name.');'.PHP_EOL;
        }

        if (!empty($union->children)) {
            $output .= $indent.'  children : ['.PHP_EOL;
            foreach($union->children as $child) {
                $type_name = $child->getName();
                $output .= $indent.'    '.$this->dumObject($child, $tab+2);
            }
            $output .= $indent.'  ]'.PHP_EOL;
        }
    
        $output .= $indent.'}'.PHP_EOL;
        return $output;
    }
    public function dumEnum(EnumGenerator $component, $tab) {
        $indent = str_repeat('  ', $tab);
        $output = '';
        $output .= 'Enum('.$component->getName().'):Object {'.PHP_EOL;
        foreach($component->getConstants() as $constant)
            $output .= $indent.'  '.$constant->getName().' ('.get_class($constant).');'.PHP_EOL;
        $output .= $indent.'}'.PHP_EOL;
        return $output;
    }
    public function dumClass(ClassGenerator $component, $tab) {
        $indent = str_repeat('  ', $tab);
        $output = '';
        $output.= 'Class('.$component->getName().'):Object {'.PHP_EOL;
        if (null!=$component->getInstance()) {
            $output.= $indent;
            $output.= '  instance :'.$this->dumStruct($component->getInstance(), $tab+1);
        }
        if (null!=$component->getVtable()) {
            $output.= $indent;
            $output.= '  vtable :'.$this->dumStruct($component->getVtable(), $tab+1);
        }
        $output.= $indent;
        $output.= '  related : ['.PHP_EOL;
        foreach($component->getRelatedObjects() as $objects) {
            $output.= $indent.'    ';
            $output.= $this->dumObject($objects, $tab+2);
        }
        $output.= $indent;
        $output.= '  ]'.PHP_EOL;
        $output.= $indent;
        $output.= '}'.PHP_EOL;
        return $output;
    }

    public function dumPackage(PackageGenerator $package, $tab) {
        $indent = str_repeat('  ', $tab);
        $output = '';
        $output .= 'Package('.$package->getName().'):Object {'.PHP_EOL;
        $output .= $indent;
        $output .= '  description: "'.$package->getDescription().'"'.PHP_EOL;
        $output .= $indent;
        $output .= '  subpackage: ['.PHP_EOL;
        foreach($package->subpackage as $subpackage) {
            $output .= $indent.'    ';
            $output .= $this->dumObject($subpackage, $tab+2);
        }
        $output .= $indent;
        $output .= '  ]'.PHP_EOL;
        $output .= $indent;
        $output .= '  children: ['.PHP_EOL;
        foreach($package->children as $child) {
            $output .= $indent . '    ';
            $output .= $this->dumObject($child, $tab+2);
        }
        $output .= $indent;
        $output .= '  ]'.PHP_EOL;
        $output .= $indent;
        $output .= '}'.PHP_EOL;
        return $output;
    }

    public function dumObject(ObjectGenerator $component, $tab) {
        
        if ($component instanceof ClassGenerator) {
            return $this->dumClass($component, $tab);
        }
        if ($component instanceof StructGenerator) {
            return $this->dumStruct($component, $tab);
        }
        if ($component instanceof UnionGenerator) {
            return $this->dumUnion($component, $tab);
        }
        if ($component instanceof EnumGenerator) {
            return $this->dumEnum($component, $tab);
        }
        
        if ($component instanceof PackageGenerator) {
            return $this->dumPackage($component, $tab);
        }
        return '';
    }

    public function dum(PackageGenerator $root) {
        var_dump('-----------------------------------------------');
        return $this->dumPackage($root, 0);
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
        echo PHP_EOL;


        $src_dir = '/home/dev/Projects/gtk';
        $build_dir = '/home/dev/Projects/gtk-build-doc';// has no effect
        $sourceCode = new GtkSourceCode($src_dir, $build_dir);
        $sourceCode->addBlackList(array('STRUCT'=>array('utimbuf'), 'FUNCTION'=>array('atexit')));
        $sourceCode->loadTypes('/home/dev/Projects/glib-build-doc/docs/reference/glib/glib-decl.txt');

        $sourceCode->loadTypes('/home/dev/Projects/cairo/doc/public/cairo-decl.txt');// depend on glib-decl.txt
        /*
        $sourceCode->loadTypes('/home/dev/Projects/glib-build-doc/docs/reference/gobject/gobject-decl.txt');// depend on glib-decl.txt
        $sourceCode->loadTypes('/home/dev/Projects/gtk-build-doc/docs/reference/gdk/gdk3-decl.txt');// depend on cairo-decl.txt
        $sourceCode->loadTypes('/home/dev/Projects/gtk-build-doc/docs/reference/gtk/gtk3-decl.txt');
        */

        // PHP Manual > Function Reference > GUI Extensions > GTK+
        $clone_dir = __DIR__.'/../tmp/';
        $clone_dir = '/home/dev/Projects/';
        $docBook = new GtkDocBook(__DIR__.'/../data/gtkphp.xml', $clone_dir);
        $docBook->blacklist = array('cairo-version.xml', 'cairo-quartz-fonts.xml');
        $docBook->remap = array('cairo_cairo_t'=>'cairo_t');
        $docBook->addSourceCode($sourceCode);

        /*
        $package = $docBook->getPackage();
        if (false) {
            var_dump($package);
        } else if (false) {
            echo $this->dum($package);
        } else if (false) {
            foreach($package->subpackage as $subpackage) {
                echo $this->dumObject($subpackage, 0);
            }
        }
        */


        $enable = false;
        if (true) {
            // generate Source PHP Extension
            $generator = CodeGenerator::Factory('C/Source/Glib', 'GlibNotUsedPut $docBook');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);
        }
        if (true) {
            // generate Header PHP Extension
            $generator = CodeGenerator::Factory('C/Header/Glib', 'Glib');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);
        }
        if ($enable) {
            // generate PHP API
            $generator = CodeGenerator::Factory('Php/Pp', 'Glib');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);
        }
        if ($enable) {
            // generate PHP Doc
            $generator = CodeGenerator::Factory('Xml/Doc', 'Glib');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);
        }

        
        $this->assertTrue(true);

    }

}
