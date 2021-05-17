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
use Zend\Ext\Models\FileGenerator;
use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\DocBook\Cairo as CairoDocBook;
use Zend\Ext\Services\DocBook\Gtk as GtkDocBook;
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
            foreach($component->getConstants() as $constant)
                $output .= $indent.'  '.$constant->getName().' ('.get_class($constant).');'.PHP_EOL;
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
        $output.= 'Function('.$component->getName()."):Object {";
        $output.= '}'.PHP_EOL;
        //$output.= "'".$component->getName()."' => 'cairo_pattern_t',".PHP_EOL;
        //$output.= "'".$component->getName()."' => '".$self_type."',".PHP_EOL;

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
            $output.= $indent;
            $output.= '  children : ['.PHP_EOL;
            foreach($component->children as $objects) {
                if ($objects->isClassified) continue;
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
        $clone_dir = '/home/dev/Projets/';
        $docBook = new GtkDocBook(__DIR__.'/../data/gtkphp.xml', $clone_dir);
        $docBook->blacklist = array('cairo-version.xml', 'cairo-quartz-fonts.xml');
        // map struct name
        $docBook->remap = array(
            /*<entry id>*/          /* refname(master object)*/
            //'cairo-cairo-t'         => 'cairo_t',
            'cairo-Paths'           => 'cairo_path_t',
            'cairo-Error-handling'  => 'cairo_status_t',
            //'cairo_cairo_pattern_t' => 'cairo_pattern_t',
            'cairo-Regions'         => 'cairo_region_t',
            //'cairo-Transformations' => 'cairo_matrix_t',
            'cairo-text'            => 'cairo_glyph_t',
            'cairo-Image-Surfaces'  => null,
        );
        $docBook->remap_function = array(
         /* function name */        /* object name*/
            'cairo_create'          => 'cairo_t',
            // paths.xml
            // pattern
            'cairo_pattern_create_rgb' => 'cairo_pattern_t',
            'cairo_pattern_create_rgba' => 'cairo_pattern_t',
            'cairo_pattern_create_for_surface' => 'cairo_pattern_t',
            'cairo_pattern_create_linear' => 'cairo_pattern_t',
            'cairo_pattern_create_radial' => 'cairo_pattern_t',
            'cairo_pattern_create_mesh' => 'cairo_pattern_t',
            // Region
            'cairo_region_create' => 'cairo_region_t',
            'cairo_region_create_rectangle' => 'cairo_region_t',
            'cairo_region_create_rectangles' => 'cairo_region_t',
            // transform
            // font_face
            'cairo_toy_font_face_create' => 'cairo_font_face_t',
            'cairo_toy_font_face_get_family' => 'cairo_font_face_t',
            'cairo_toy_font_face_get_slant' => 'cairo_font_face_t',
            'cairo_toy_font_face_get_weight' => 'cairo_font_face_t',

            'cairo_glyph_allocate' => 'cairo_glyph_t',
            'cairo_text_cluster_allocate' => 'cairo_text_cluster_t',

            
            'cairo_pattern_create_raster_source' => 'cairo_pattern_t',

            'cairo_font_options_create' => 'cairo_font_options_t',

            // text
            'cairo_ft_font_face_create_for_ft_face' => 'cairo_font_face_t',
            'cairo_ft_font_face_create_for_pattern' => 'cairo_font_face_t',
            'cairo_win32_font_face_create_for_logfontw' => 'cairo_font_face_t',
            'cairo_win32_font_face_create_for_hfont' => 'cairo_font_face_t',
            'cairo_win32_font_face_create_for_logfontw_hfont' => 'cairo_font_face_t',
            'cairo_user_font_face_create' => 'cairo_font_face_t',

            //'cairo_format_stride_for_width' => 'cairo_format_t',

            'cairo_image_surface_create' => 'cairo_surface_t',
            'cairo_image_surface_create_for_data' => 'cairo_surface_t',

            'cairo_pdf_surface_create' => 'cairo_surface_t',
            'cairo_pdf_surface_create_for_stream' => 'cairo_surface_t',
            'cairo_pdf_get_versions' => 'cairo_surface_t',
            'cairo_pdf_version_to_string' => 'cairo_surface_t',

            'cairo_image_surface_create_from_png' => 'cairo_surface_t',
            'cairo_image_surface_create_from_png_stream' => 'cairo_surface_t',

            'cairo_ps_surface_create' => 'cairo_surface_t',
            'cairo_ps_surface_create_for_stream' => 'cairo_surface_t',
            'cairo_ps_get_levels' => 'cairo_surface_t',
            'cairo_ps_level_to_string' => 'cairo_surface_t',

            'cairo_recording_surface_create' => 'cairo_surface_t',

            'cairo_win32_surface_create' => 'cairo_surface_t',
            'cairo_win32_surface_create_with_dib' => 'cairo_surface_t',
            'cairo_win32_surface_create_with_ddb' => 'cairo_surface_t',
            'cairo_win32_surface_create_with_format' => 'cairo_surface_t',
            'cairo_win32_printing_surface_create' => 'cairo_surface_t',

            'cairo_svg_surface_create' => 'cairo_surface_t',
            'cairo_svg_surface_create_for_stream' => 'cairo_surface_t',
            'cairo_svg_get_versions' => 'cairo_surface_t',
            'cairo_svg_version_to_string' => 'cairo_surface_t',

            'cairo_quartz_surface_create' => 'cairo_surface_t',
            'cairo_quartz_surface_create_for_cg_context' => 'cairo_surface_t',
            'cairo_xcb_surface_create' => 'cairo_surface_t',
            'cairo_xcb_surface_create_for_bitmap' => 'cairo_surface_t',
            'cairo_xcb_surface_create_with_xrender_format' => 'cairo_surface_t',
            'cairo_xlib_surface_create' => 'cairo_surface_t',
            'cairo_xlib_surface_create_for_bitmap' => 'cairo_surface_t',
            'cairo_xlib_surface_create_with_xrender_format' => 'cairo_surface_t',
            'cairo_script_create' => 'cairo_surface_t',
            'cairo_script_create_for_stream' => 'cairo_surface_t',

            // Error-handling
            'cairo_debug_reset_static_data' => 'cairo_status_t',
        );

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
        
        $package = $docBook->getPackage();


        
        Implementation::$version = '7';
        $enable_test = true;
        $enable = false;
        if ($enable_test) {
            // generate Source PHP Extension
            $generator = CodeGenerator::Factory('C/Source/Glib', 'GlibNotUsedPut $docBook');
            $generator->setDocBook($docBook);
            $generator->save($output_dir);
        }
        if ($enable_test) {
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
