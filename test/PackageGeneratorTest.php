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
use Zend\Ext\Models\FunctionGenerator;
use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\ObjectGenerator;
use Zend\Ext\Models\GroupGenerator;
use Zend\Ext\Models\FileGenerator;
use Zend\Ext\Models\ConstantGenerator;

use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\DocBook\Cairo as CairoDocBook;
use Zend\Ext\Services\DocBook\Gtk as GtkDocBook;
use Zend\Ext\Services\SourceCode;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;
use Zend\Ext\Services\SourceCode\Gtk as GtkSourceCode;

use Zend\ExtGtk\Implementation;

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
        if (true) {
            foreach($struct->getMembers() as $member) {
                //echo $struct->getName(), PHP_EOL;
                $type_name = $member->getType()->getName();
                //$type_name = get_class($member);
                $output .= $indent.'  '.$member->getName().' ('.$type_name.');'.PHP_EOL;
            }
        }
        if (false) {
            $output .= $indent.'  ';
            $output .= 'classified : '.($struct->isClassified?'yes':'no').PHP_EOL;
        }
        if (true && count($struct->relateds)) {
            $output .= $indent.'  ';
            $output .= 'related : ['.PHP_EOL;
            foreach($struct->relateds as $object) {
                $output .= $indent.'    ';
                $output .= $this->dumObject($object, $tab+2);
            }
            $output .= $indent.'  ';
            $output .= ']'.PHP_EOL;
        }
        $output .= $indent.'}'.PHP_EOL;
        return $output;
    }
    public function dumUnion(UnionGenerator $union, $tab) {
        $indent = str_repeat('  ', $tab);
        $output = '';
        $output .= 'Union('.$union->getName().'):Object {'.PHP_EOL;
        if (true) {
            foreach($union->getMembers() as $name=>$member) {
                $type_name = $member->getType()->getName();
                //$type_name = get_class($member)
                $output .= $indent.'  '.$name.' ('.$type_name.');'.PHP_EOL;
            }
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
        if (true) {
            foreach($component->getConstants() as $constant) {
                $output .= $indent.'  '.$constant->getName();
                //$output .= ' ('.get_class($constant).');';
                //$output .= ' {'.$constant->getParentGenerator()->getName().'}';
                //$output .= ' {'.$constant->getValue().'}';
                $output .= PHP_EOL;
            }
        }
        if (true && count($component->relateds)) {
            $output .= $indent.'  ';
            $output .= 'related : ['.PHP_EOL;
            foreach($component->relateds as $object) {
                $output .= $indent.'    ';
                $output .= $this->dumObject($object, $tab+2);
            }
            $output .= $indent.'  ';
            $output .= ']'.PHP_EOL;
        }
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
    public function dumFunction(FunctionGenerator $component, $tab) {
        $indent = str_repeat('  ', $tab);
        $self = current($component->getParameters());
        $self_type = $self? $self->getType()->getName() : '';
        $output = '';
        //$output.= $component->getName()."(\e[1;34m".$self_type."\e[0m):Function:Object {";
            //$Function = get_class($component); $Function = substr($Function, strlen('Zend\\Ext\\Models\\')); $Function = substr($Function, 0, strlen($Function)-strlen('Generator'));
            $Function = substr(strrchr(get_class($component), "\\"), 1); $Function = substr($Function, 0, strlen($Function)-strlen('Generator'));
            if ($Function=='Prototype') {
                $output.= 'Function('.$component->getName()."):Prototype {";
            }/* else if ($Function=='Method') {
                $output.= 'Function('.$component->getName()."):Method {";
            }*/ else if ($component->isMacro()) {
                $output.= 'Function('.$component->getName()."):Macro {";
            } else {
                $output.= 'Function('.$component->getName()."):Object {";
            }
        $output.= $component->getParentGenerator()->getName();
        $output.= '}'.PHP_EOL;
        //$output.= "'".$component->getName()."' => 'cairo_pattern_t',".PHP_EOL;
        //$output.= "'".$component->getName()."' => '".$self_type."',".PHP_EOL;

        return $output;
    }

    public function dumConstant(ConstantGenerator $component, $tab) {
        $indent = str_repeat('  ', $tab);
        $output = '';
        //TODO: NULL var_dump($component->getValue());
        $output.= 'Constant('.$component->getName()."):Object {";
        $output.= $component->getParentGenerator()->getName();
        $output.= '}'.PHP_EOL;

        return $output;
    }

    public function dumGroup(GroupGenerator $component, $tab) {
        $indent = str_repeat('  ', $tab);
        $output = '';
        $output.= 'Group('.$component->getName().'):Object {'.PHP_EOL;
        if (true && $component->getMatserObject()) {
            $output.= $indent.'  master : ';
            $output.= $this->dumObject($component->getMatserObject(), $tab+1);
        }
        if (true) {
            $count = 0;
            $output.= $indent;
            $output.= '  children('.count($component->children).') : ['.PHP_EOL;
            foreach($component->children as $objects) {
                if ($objects->isClassified){ $count++; continue;}
                $output.= $indent.'    ';
                $output.= $this->dumObject($objects, $tab+2);
            }
            $output.= $indent;
            $output.= '  ]'.PHP_EOL;
        }
        $output.= $indent;
        $output.= '}'.PHP_EOL;
        return $output;
    }

    public function dumFile(FileGenerator $component, $tab) {
        $indent = str_repeat('  ', $tab);
        $output = '';
        $output.= 'File('.$component->getName().'):Object {'.PHP_EOL;
        if (true && $component->getMatserObject()) {
            $output.= $indent.'  master : ';
            $output.= $this->dumObject($component->getMatserObject(), $tab+1);
        }
        if (true) {
            $count = 0;
            $output.= $indent;
            $output.= '  children('.count($component->children).') : ['.PHP_EOL;
            foreach($component->children as $objects) {
                if ($objects->isClassified){ $count++; continue;}
                $output.= $indent.'    ';
                $output.= $this->dumObject($objects, $tab+2);
            }
            $output.= $indent;
            $output.= '  ]'.PHP_EOL;
        }
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
        $output .= '  count(symbol): '.count($package->getSymbols()) . PHP_EOL;
        if ($package->getParentGenerator()) {
            $output .= $indent;
            $output .= '  parent: '.$package->getParentGenerator()->getName() . PHP_EOL;
        }
        if ($package->isModule()) {
            $output .= $indent;
            $output .= '  isModule: true'.PHP_EOL;
        }
        if (count($package->subpackage)) {
            $output .= $indent;
            $output .= '  subpackage: ['.PHP_EOL;
            foreach($package->subpackage as $subpackage) {
                $output .= $indent.'    ';
                $output .= $this->dumObject($subpackage, $tab+2);
            }
            $output .= $indent;
            $output .= '  ]'.PHP_EOL;
        }
        if (count($package->children)) {
            $output .= $indent;
            $output .= '  children: ['.PHP_EOL;
            foreach($package->children as $child) {
                $output .= $indent . '    ';
                $output .= $this->dumObject($child, $tab+2);
            }
            $output .= $indent;
            $output .= '  ]'.PHP_EOL;
        }
        
        /*
        // chaque symbol est défini dans un fichier( un fichier peu contenir plusisuer symbol)
        foreach( $package->getSymbols() as $object) {
            $output .= '  ';
            $name = get_class($object);
            $output .= $object->getName().' ( '.substr($name, strrpos($name, '\\')+1).' )'.PHP_EOL;
        }
        */

        $output .= $indent;
        $output .= '}'.PHP_EOL;
        return $output;
    }

    public function dumObject(ObjectGenerator $component, $tab) {
        
        if ($component instanceof PackageGenerator) {
            return $this->dumPackage($component, $tab);
        }
        if ($component instanceof GroupGenerator) {
            return $this->dumGroup($component, $tab);
        }
/**/
        if ($component instanceof FileGenerator) {
            return $this->dumFile($component, $tab);
        }
        if ($component instanceof FunctionGenerator) {
            return $this->dumFunction($component, $tab);
        }
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
        if ($component instanceof ConstantGenerator) {
            return $this->dumConstant($component, $tab);
        }

        echo "Unknow ", get_class($component), PHP_EOL;
/**/
        return '';
    }

    public function dum(PackageGenerator $root) {
        var_dump('-----------------------------------------------');
        return $this->dumPackage($root, 0);
    }



    /**
     * Test le fichier <package>-decl.txt
     */
    public function testDecl() {
        $filename = '/home/dev/Projects/glib-build-doc/docs/reference/glib/glib-decl.txt';
        $filename = __DIR__.'/glib/docs/reference/glib/glib-decl.txt';

        $search = array('&(v)', ' << ', '/*< ', '/* <', ' >*/', '&&', '&', ' <= ', '->', ' < ', ' > ', '_-|> <.', '<foo bar="baz">', '</foo>', '<Space> does', '<Return> does', '> */', '(1L<<0)', '(1L<<1)', '/*<private>*/');
        $replace = array('V_REF_PASS', 'SHIFT_LEFT', '/*_ ', '/* _', ' _*/', 'DOUBLE_PASS_REF', 'PASS_REF', 'GREATER_OR_EQUAL', 'SPECIAL_ARROW', ' GREATER ', ' LESSER ', 'EXCEPTIONEL', 'OPEN_TAG_FOO', 'CLOSE_TAG_FOO', '_SPACE_DOES', '_RETURN_DOES', '_ */', '_JOKE_1', '_JOKE_2', '/*_private_*/');
        $str = file_get_contents($filename);
        $str_xml = "<root>$str</root>";
        $str_xml = str_replace($search, $replace, $str_xml);

        $doc = new \DOMDocument();
        $doc->loadXML($str_xml);
        $xpath = new \DOMXPath($doc);

        $collections = array();
        $kinds = $this->taskResume($xpath, $collections);
        print_r($kinds);
        //print_r($collections['STRUCT']);

        $this->assertTrue(true);
    }

    function taskResume($xpath, &$collections) {
        $tags = array();
        $nodes = $xpath->query('/root/*');
        foreach($nodes as $child) {
            if (isset($tags[$child->nodeName])) {
                $tags[$child->nodeName] += 1;
            } else {
                $tags[$child->nodeName] = 1;
                $collections[$child->nodeName] = array();
            }
            $n = $xpath->query('NAME', $child);
            $collections[$child->nodeName][$n[0]->nodeValue] = 1;
        }
        return $tags;
    }

    public function testGLib() {
        // -lgtk-3 -lgdk-3 -lpangocairo-1.0 -lpango-1.0 -latk-1.0 -lcairo-gobject -lcairo -lgdk_pixbuf-2.0 -lgio-2.0 -lgobject-2.0 -lglib-2.0
        //-lpangocairo-1.0 -lcairo-gobject

        $data_dir = __DIR__."/../data";
        $cache_file = $data_dir."/cache.txt";

        if (False) {
            $sourceCode = new GlibSourceCode();
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/glib-2.56.4.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gobject-2.56.4.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gio-2.56.4.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/cairo-1.15.10.h');
            /*
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/pango-1.40.14.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/atk-2.28.1.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gdk_pixbuf-2.36.11.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gdk-3.22.30.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gtk-3.22.30.h');
            */
            $sourceCode->evaluate();// resolve enum value
            // Time: 15.73 seconds, Memory: 129.69 MB

            //file_put_contents($cache_file, serialize($sourceCode));
            file_put_contents($cache_file, serialize(array('data'=>$sourceCode->array, 'macro'=>$sourceCode->defines)));
        } else {
            $sourceCode = new GlibSourceCode();
            $data = unserialize(file_get_contents($cache_file));
            $sourceCode->array = $data['data'];
            $sourceCode->defines = $data['macro'];
            //$sourceCode = unserialize(file_get_contents($cache_file));
            // Time: 147 ms, Memory: 61.69 MB
        }
        
        
        //print_r($sourceCode->getEnum('GApplicationFlags'));// defined in gio
        //print_r($sourceCode->getEnum('GDateWeekday'));// defined in glib
        //print_r($sourceCode->getStruct('GValue'));// defined in glib
        //print_r($sourceCode->getUnion('GTypeCValue'));// defined in gobject
        //print_r($sourceCode->getEnum('cairo_line_join_t'));// defined in cairo
        //print_r($sourceCode->getFunction('cairo_create'));// defined in cairo
        //print_r($sourceCode->getProto('cairo_raster_source_acquire_func_t'));// defined in cairo
        //print_r($sourceCode->getTypedef('cairo_t'));// defined in cairo
        //print_r($sourceCode->getStruct('_cairo'));// defined in cairo
        //print_r($sourceCode->getMacro('CAIRO_TAG_LINK'));// defined in cairo
        //print_r($sourceCode->array['macros']);
        

        $docBook = new GtkDocBook(__DIR__.'/../data/gtkphp.xml', '/home/dev/Projects/');
        $docBook->addSourceCode($sourceCode);// setSourceCode();
        //$docBook->addClassifier($glibClassifier, 'cairo');
        //$docBook->addClassifier($gioClassifier, 'gio');
        //$docBook->addClassifier($gobjectClassifier, 'gobject');
        //$docBook->addClassifier($gdkClassifier, 'gdk');
        //$docBook->addClassifier($gtkClassifier, 'gtk');
        
        $package = $docBook->getPackage();
        
        // TODO distingue Function/Method
        // TODO Seealso
        // TODO classify()
        // TODO dependencies
        //echo $this->dumFile($package->subpackage[0]->subpackage[2]->children[4], 0);// PNG Support (use of Prototype)
        //echo $this->dumFile($package->subpackage[0]->subpackage[3]->children[2], 0);// cairo-version.xml (use of Macro parametrable)

        echo $this->dumGroup($package->subpackage[0]->subpackage[1]->children[0], 0);// cairo-font-face.xml

        //echo $this->dum($package->subpackage[0]->subpackage[2]);// cairo-surfaces.xml
        //echo $this->dum($package->subpackage[0]->subpackage[1]);// cairo-font-face.xml
        //echo $this->dum($package->subpackage[0]->subpackage[0]);// cairo.xml
        //echo $this->dum($package);
        
        /*
        print_r($package);
        var_dump($package);
        */
        /*
        $output_dir = APP_DIR.'/output';
        `mkdir -p $output_dir`;
        
        Implementation::$version = '8';
        $generator = CodeGenerator::Factory('C/Source/Glib', 'GlibNotUsedPut $docBook');
        $generator->setDocBook($docBook);
        $generator->save($output_dir);
        */


        $this->assertTrue(true);
    }

    public function testCairo() {
        $tag = '2.56.4';
        $log_dir = APP_DIR."/log/glib-$tag";
        $tmp_dir = APP_DIR.'/tmp';
        $output_dir = APP_DIR.'/output';
        $output_dir = '/home/dev/Projects/gtkphp/en/reference/gtk';

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
        $sourceCode = new SourceCode($src_dir, $build_dir);
        //$sourceCode->addBlackList(array('STRUCT'=>array('utimbuf'), 'FUNCTION'=>array('atexit')));
        $sourceCode->loadTypes('/home/dev/Projects/glib-build-doc/docs/reference/glib/glib-decl.txt');
        //$sourceCode->loadTypes(__DIR__.'/glib/docs/reference/glib/glib-decl.txt');
        
        //$sourceCode->loadTypes('/home/dev/Projects/cairo/doc/public/cairo-decl.txt');// depend on glib-decl.txt
        //$sourceCode->loadTypes('/home/dev/Projects/glib-build-doc/docs/reference/gobject/gobject-decl.txt');// depend on glib-decl.txt

        echo  "-----------------\n";
/*
        $sourceCode->loadTypes('/home/dev/Projects/gtk-build-doc/docs/reference/gdk/gdk3-decl.txt');// depend on cairo-decl.txt
        $sourceCode->loadTypes('/home/dev/Projects/gtk-build-doc/docs/reference/gtk/gtk3-decl.txt');
        */
        
        /*
        // PHP Manual > Function Reference > GUI Extensions > GTK+
        $clone_dir = __DIR__.'/../tmp/';
        $clone_dir = '/home/dev/Projects/';
        $docBook = new GtkDocBook(__DIR__.'/../data/gtkphp.xml', $clone_dir);
        //$docBook->blacklist = array('cairo-version.xml', 'cairo-quartz-fonts.xml');
        // map struct name
        $docBook->remap = array();
        $docBook->remap_function = array();

        $docBook->addSourceCode($sourceCode);

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

/*
        $package = $docBook->getPackage();


        
        Implementation::$version = '8';
        $enable_test = false;//true
        $enable = false;
        if ($enable) {
            // generate Source PHP Extension
            $generator = CodeGenerator::Factory('C/Source/Glib', 'GlibNotUsedPut $docBook');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);
        }
        if ($enable) {
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
        if ($enable_test) {
            // generate PHP Doc
            $generator = CodeGenerator::Factory('Xml/Doc', 'Glib');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);

        }
*/
        
        $this->assertTrue(true);

    }


    public function testGdk() {
        // -lgtk-3 -lgdk-3 -lpangocairo-1.0 -lpango-1.0 -latk-1.0 -lcairo-gobject -lcairo -lgdk_pixbuf-2.0 -lgio-2.0 -lgobject-2.0 -lglib-2.0
        //-lpangocairo-1.0 -lcairo-gobject

        $data_dir = __DIR__."/../data";
        $cache_file = $data_dir."/cache.txt";

        if (False) {
            $sourceCode = new GlibSourceCode();
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/glib-2.56.4.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gobject-2.56.4.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gio-2.56.4.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/cairo-1.15.10.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/pango-1.40.14.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/atk-2.28.1.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gdk_pixbuf-2.36.11.h');
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gdk-3.22.30.h');
            /*
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gtk-3.22.30.h');
            */
            $sourceCode->evaluate();// resolve enum value
            // Time: 15.73 seconds, Memory: 129.69 MB

            //file_put_contents($cache_file, serialize($sourceCode));
            file_put_contents($cache_file, serialize(array('data'=>$sourceCode->array, 'macro'=>$sourceCode->defines)));
        } else {
            $sourceCode = new GlibSourceCode();
            $data = unserialize(file_get_contents($cache_file));
            $sourceCode->array = $data['data'];
            $sourceCode->defines = $data['macro'];
            //$sourceCode = unserialize(file_get_contents($cache_file));
            // Time: 147 ms, Memory: 61.69 MB
        }
        
        
        //print_r($sourceCode->getEnum('GApplicationFlags'));// defined in gio
        //print_r($sourceCode->getEnum('GDateWeekday'));// defined in glib
        //print_r($sourceCode->getStruct('GValue'));// defined in glib
        //print_r($sourceCode->getUnion('GTypeCValue'));// defined in gobject
        //print_r($sourceCode->getEnum('cairo_line_join_t'));// defined in cairo
        //print_r($sourceCode->getFunction('cairo_create'));// defined in cairo
        //print_r($sourceCode->getProto('cairo_raster_source_acquire_func_t'));// defined in cairo
        //print_r($sourceCode->getTypedef('cairo_t'));// defined in cairo
        //print_r($sourceCode->getStruct('_cairo'));// defined in cairo
        //print_r($sourceCode->getMacro('CAIRO_TAG_LINK'));// defined in cairo
        //print_r($sourceCode->array['macros']);

        //print_r($sourceCode->getTypedef('GdkAtom'));
        print_r($sourceCode->getTypedef('GdkAtom'));// ['name'=>'GdkAtom', 'type'=>'_GdkAtom', 'pass'=>'*']; no structure for "_GdkAtom"
                                                    //                      type => "struct _GdkAtom"
        print_r($sourceCode->getStruct('_GdkAtom'));// Add struct in CPrinter

        /*$keys = array_keys($sourceCode->array['structs']);
        var_dump($sourceCode->array['structs']['_GdkAtom']);
        var_dump($sourceCode->array['structs']['__GdkAtom']);
        var_dump($sourceCode->array['structs']['#GdkAtom']);*/

/*
typedef MotifWmInfo MwmInfo;
typedef struct _GdkAtom            *GdkAtom;
typedef void GdkXEvent;
typedef union _GdkEvent GdkEvent;
//typedef struct __GdkX11WindowClass GdkX11WindowClass;
//typedef struct __GdkX11Window GdkX11Window;
typedef struct __GdkX11VisualClass GdkX11VisualClass;
*/


        $this->assertTrue(true);
    }

}
