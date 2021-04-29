<?php

namespace ZendTest\Ext;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\Error\Error;

use Zend\Ext\Services\CodeGenerator;
use Zend\Ext\Services\DocBook\Glib as GlibDocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;// rename by GlibParser


class ClassGeneratorTest extends TestCase
{

    function getNamespace($filename) {
        $filename = str_replace('_', '-', $filename);
        $ln = strlen($filename);
        $suffix = substr($filename, $ln-2);
        if ('-t'==$suffix) {
            $filename = substr($filename, 0, $ln-2);
        }
        
        $pos = strpos($filename, '-');
        if (false===$pos) {
            $namespace = $filename;
        } else {
            $namespace = substr($filename, 0, $pos);
        }

        return $namespace;
    }
    function getFilename($filename) {
        $filename = str_replace('_', '-', $filename);
        $ln = strlen($filename);
        $suffix = substr($filename, $ln-2);
        if ('-t'==$suffix) {
            $filename = substr($filename, 0, $ln-2);
        }
        
        $pos = strpos($filename, '-');
        if (false===$pos) {
            $namespace = $filename;
            $filename = $filename;
        } else {
            $namespace = substr($filename, 0, $pos);
            $filename = substr($filename, $pos+1);
        }

        return $filename;
    }

    function testGetFilename() {
        $filenames = [
            'g_hash_table',
            'gtk_widget',
            'cairo_path_t',
            'cairo_path_data_t',
            'cairo_t',
        ];
        echo PHP_EOL;
        foreach($filenames as $filename) {
            $name = $this->getFilename($filename);
            $ns = $this->getNamespace($filename);
            echo $ns, '::', $name, PHP_EOL;
        }

    }

    // Group by nth letter
    public function groupByMotif(array $properties, $index)
    {
        $tab = '        ';
        $group = [];
        foreach ($properties as $property) {
            if (empty($property)) {
                var_dump($property);
                echo 'property is null'.PHP_EOL;
                continue;
            }
            $c = $property[$index];
            if (isset($group[$c])) {
                $group[$c][] = $property;
            } else {
                $group[$c] = array($property);
            }
        }

        foreach ($group as $key=>$items) {
            if (count($items)>1) {
                $subgroup = $this->groupByMotif($items, $index+1);
                //$group[$key] = $subgroup;
                if (count($subgroup)>1) {
                    $group[$key] = $subgroup;
                } else {
                    $keys = array_keys($subgroup);
                    $group[$key.$keys[0]] = $subgroup[$keys[0]];
                    unset($group[$key]);
                }
            } else {
                $group[$key] = $items[0];
            }
        }

        return $group;
    }
    public function testBinarySearch()
    {
        $properties = array(
            'aaaa',
            'baaa',
            'baab',
            'bbaa',
            'bbca',
            'bbda',
            'bcaa',
            'bbaz',
            'caaa',
        );

        $actual = $this->groupByMotif($properties, 0);

        $expect = array(
            'a' => 'aaaa',
            'b' => Array(
                'b' => Array(
                    'a' => Array(
                        'a' => 'bbaa',
                        'z' => 'bbaz'
                    ),
                    'c' => 'bbca',
                    'd' => 'bbda'
                ),
                'c' => 'bcaa',
                'aa' => Array(
                    'a' => 'baaa',
                    'b' => 'baab'
                ),
            ),
            'c' => 'caaa'
        );

        echo PHP_EOL;
        echo $this->printGroup($actual, 0, 1);

        $this->assertTrue($actual===$expect);
    }

    public function printCondition($motif, $start)
    {
        $output = '';
        $glue = '';
        $max = 4;
        $n = 1;
        $ln = strlen($motif);
        for($i=0; $i<$ln; $i++, $n++) {
            $output .= $glue . 'str['.($start+$i).'] == \''. $motif[$i] .'\'';
            if ($n!=0 && $n%$max == 0 && $i<($ln-1)) {
                $output .= PHP_EOL.'        ';
            }
            $glue = ' && ';
        }
        return $output;
    }

    public function printCheck(string $item, $index, $indent)
    {
        $tab = '    ';
        $ws = str_repeat($tab, $indent);
        $output = '';
        $glue = '';
        $max = 4;
        $n = 1;
        $ln = strlen($item);
        for($i=$index; $i<$ln; $i++, $n++) {
            $output .= $glue . 'str['.$i.'] == \''. $item[$i] .'\'';
            if ($n!=0 && $n%$max == 0 && $i<($ln-1)) {
                $output .= PHP_EOL.$ws;
            }
            $glue = ' && ';
        }

        return $output;
    }

    public function printGroup($group, $index = 0, $indent=0)
    {
        $output = '';
        $tab = '    ';
        $ws = str_repeat($tab, $indent);
        $glue = $ws;
        foreach($group as $motif=>$items) {
            $ln = 0;
            $ln = strlen($motif);

            if (is_array($items)) {
                    $output .= $glue . 'if ('.$this->printCondition($motif, $index).') {'.PHP_EOL;
                    $output .= $this->printGroup($items, $index + $ln, $indent+1);
            } else {
                $output .= $glue.'if ('.$this->printCheck($items, $index, 2).') {'.PHP_EOL;
                //$output .= $ws.'    //'.$items.PHP_EOL;
                $output .= '#'.$items.PHP_EOL;
            }

            $output .= $ws.'}';
            $glue = ' else ';
        }
        $output .= PHP_EOL;
        /*
        $output .= ' else {'.PHP_EOL;
        $output .= $ws.'    // NOTFOUND'.PHP_EOL;
        $output .= $ws.'}'.PHP_EOL;
        */

        return $output;
    }


    public function testRefactory()
    {
        //$generator = CodeGenerator::Factory('Xml/Glib', 'Glib');
        //$generator = CodeGenerator::Factory('C/Header/Glib', 'Glib');
        $generator = CodeGenerator::Factory('C/Source/Glib', 'Glib');
        //$generator = CodeGenerator::Factory('C/Glib', 'Glib');

        $generator->save('output/dir/path');
    }

    public function testDocumentation()
    {

        $src_dir = '/home/dev/Projects/glib';
        $build_dir = '/home/dev/Projects/glib-build-doc';
        $service = new GlibSourceCode($src_dir, $build_dir);
        $service->addBlackList(array('STRUCT'=>array('utimbuf', 'GMarkupParser')));
        $service->loadTypes();

        $servicePhp = new Php8CodeGenerator();
        $servicePhp->setCode(CodeGenerator::XML_CODE);

        // compare glib-decl vs glib docBook
        $docBook = new GlibDocBook();
        $docBook->addSourceCode($service);
        $docBook->addCodeGenerator($servicePhp);
        $docBook->load(/*doc.sgml*/);
        echo $docBook->save('/home/dev/Projects/gtkphp/output');

        $this->assertTrue(True);
    }
    public function testImplementation()
    {
        $src_dir = '/home/dev/Projects/glib';
        $build_dir = '/home/dev/Projects/glib-build-doc';
        $service = new GlibSourceCode($src_dir, $build_dir);
        $service->addBlackList(array('STRUCT'=>array('utimbuf', 'GMarkupParser')));
        $service->loadTypes();

        $servicePhp = new Php8CodeGenerator();
        $servicePhp->setCode(CodeGenerator::C_CODE);
        $servicePhp->setStyle(CodeGenerator::C_SOURCE_STYLE);

        // compare glib-decl vs glib docBook
        $docBook = new GlibDocBook(/*'Gnome/GLib'*/);
        //$docBook->addServiceAPI($service);
        $docBook->addSourceCode($service);
        $docBook->addCodeGenerator($servicePhp);
        $docBook->load(/*doc.sgml*/);
        echo $docBook->save('/home/dev/Projects/gtkphp/output');

        /**
         * $extension = PhpExtension();
         * $extension->addSourceCode($serviceCode);
         * $extension->addAPICode($serviceReflexion);
         * $extension->addGenerator($serviceGenerator);
         * $extension->save('output/src|doc-en');
         *
         * 1) Generate PHP API ... edit manualy
         * 2) Generate Extension( Doc, *.[hc], PhpWrapper)
         *
         */
        $this->assertTrue(True);
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
        $servicePhp->setStyle(CodeGenerator::C_HEADER_STYLE);

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
