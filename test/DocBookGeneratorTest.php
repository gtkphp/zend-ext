<?php

namespace ZendTest\Ext;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\Error\Error;
use SebastianBergmann\CodeCoverage\Report\Xml\Method;
use Zend\Ext\Models\DocBook\TypeDocBook;

use Zend\Ext\Models\Dto\ObjectDto;
use Zend\Ext\Models\Dto\PackageDto;
use Zend\Ext\Models\Dto\ExtensionDto;

use Zend\Ext\Services\Classifier\Cairo as Classifier;

use Zend\Ext\Models\Code\Generator\FileGenerator;
use Zend\Ext\Models\Code\Generator\MethodGenerator;
use Zend\Ext\Models\Code\Reflection\FunctionReflection;

use Zend\Ext\Models\DocBook\FunctionDocBook;

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
use ZendExt\Dto;
use Zend\ExtGtk\Agent;


use Zend\Ext\Services\DocBook\Gnome as DocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;
use Zend\Ext\Services\Extension as CodeGenerator;

use Zend\ExtGtk\Implementation;
//use Zend\Gnome\Implementation;

//use Zend\View\HelperPluginManager;
use Zend\Ext\Views\HelperPluginManager;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Strategy\PhpRendererStrategy;
//use Zend\View\Resolver\TemplatePathStack;
use Zend\Ext\View\Resolver\TemplatePathStack;
use Zend\Filter\Whitelist;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Zend\View\View;
use Zend\Stdlib\Response;


class DocBookGeneratorTest extends TestCase
{
    /** @var TemplatePathStack */
    protected $resolver=null;

    /** @var PhpRenderer */
    protected $renderer;

    /** @var View */
    protected $view;

    /** @var CodeGeneratorRenderer */
    protected $dto;

    public function getRenderer() {
        if (isset($this->renderer)) {
            return $this->renderer;
        }

        if (!isset($this->resolver)) {
            $this->resolver = new TemplatePathStack('7.2');// last
        }

        $this->renderer = new PhpRenderer();
        
        $this->renderer->setResolver($this->resolver);
        return $this->renderer;
    }

    public function getView() {
        if (isset($this->view)) {
            return $this->view;
        }

        $renderer = $this->getRenderer();

        $this->view = new View();
        $this->view->setResponse(new Response());

        $rendererStrategy = new PhpRendererStrategy($renderer);
        $rendererStrategy->attach($this->view->getEventManager());

        return $this->view;
    }

    public function getDataTransferObject($php_version)
    {
        if (!isset($this->dto)) {
            $resolver = new TemplatePathStack($php_version);
            
            $renderer = new \Zend\Ext\View\Renderer\CodeGeneratorRenderer();
            $renderer->setResolver($resolver);

            $this->dto = $renderer;
        }
        
        return $this->dto;
    }

    public function testView() {
        // src/Views/C/Header   /7/4/3RC1/GLib/glib/GArray/{class.phtml}

        //   /7/4/3RC1/GLib/glib/GArray

        $renderer = new PhpRenderer();
        

        $resolver = new TemplatePathStack('7.2');// 7.2 exists
        /// extends path_stack + version_stack => override addPath()
        
        // config.php -> template_path_stack
        $resolver->addPath(__DIR__.'/../src/Views/');// priority low
        //$resolver->addPath(__DIR__.'/../src/Views/C/Header/');
        //$resolver->addPath(__DIR__.'/../src/Views/Js/');// priority hight

        $renderer->setResolver($resolver);

        $serviceManager = new ServiceManager();
        $pluginManager = new HelperPluginManager($serviceManager);
        
        /*
        $pluginManager->setResolver($resolver);
        public function setResolver(Resolver $resolver)
        {
            $this->__templateResolver = $resolver;
            return $this;
        }
        */

        $pluginManager->addPathHelper('/home/dev/Projects/gtkphp/generated/zend-ext/lib/Views/C/Header/Helpers',
                                      'Zend\\Ext\\Views\\C\\Header\Helpers');

        /*
        $pluginManager->addPathHelper(__DIR__.'/../../../../Views/C/Header/Helpers', 'Zend\\Ext\\Views\\C\\Header\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../../../../Views/C/Helpers', 'Zend\\Ext\\Views\\C\\Helpers');
        $pluginManager->addPathHelper(__DIR__.'/../../../../Views/Helpers', 'Zend\\Ext\\Views\\Helpers');
        */

        $renderer->setHelperPluginManager($pluginManager);


        //-----------------------------

        $view = new View();
        $view->setResponse(new Response());
        //$view->setPackage('Glib/GLib/GArray/');

        $rendererStrategy = new PhpRendererStrategy($renderer);
        $rendererStrategy->attach($view->getEventManager());


        //-----------------------------
        $model = new ViewModel();
        $model->setVariable('data', 'World');
        $model->setTemplate('class.phtml');

        //$resolver->setViewContext('Glib/GLib', 'GArray');// full override
        //$resolver->setViewContext('Glib/GLib', 'GList');// partial override
        //$resolver->setViewContext('Glib/GLib', 'GPtrArray');// partial generic
        $resolver->setViewContext('Glib/GObject', 'GObject');// generic

        
        //\Zend\View\Event\ViewEvent::EVENT_RESPONSE;
        /** @var \Zend\EventManager\EventManager $eventManager */
        $eventManager = $view->getEventManager();

        // MVC ?
        if (0) {
        $eventManager->attach(\Zend\View\ViewEvent::EVENT_RENDERER_POST, function ($e) use ($renderer) {
            /** @var \Zend\View\ViewEvent $e */
            //$renderer = $e->getRenderer();
            //get_class($renderer);
            $model = new ViewModel();
            $model->setVariable('data', 'World');
            $model->setTemplate('object_handlers/read_property.phtml');
    
            /** @var \Zend\Stdlib\Response $response */
            $response = $e->getResponse();
            $response->setContent($renderer->render($model));

            //$e->setRenderer($renderer);

            /** @var \Zend\View\ViewModel $viewModel */
            //$viewModel = $e->getModel();
            //var_dump(func_get_args());
            //$params = $e->getParams();
            //var_dump($viewModel);

            /*
            $event = $e->getName();
            $params = $e->getParams();
            printf(
                'Handled event "%s", with parameters %s',
                $event,
                json_encode($params)
            );*/
        }, 2);
        }


        $view->render($model);
        echo $view->getResponse()->getContent();

        $this->assertTrue(true);
    }
/*
typedef guint16   gboolean;
typedef unsigned short guint16;
typedef unsigned short int guint16;
*/

    public function testTypeDoc() {
        $sourceCode = new GlibSourceCode();
        $sourceCode->loadTypes(__DIR__.'/../data/gnome-3.28.2/glib-2.56.4.h');
        //$sourceCode->evaluate();// resolve enum value

        
        $type_name = 'gboolean';

        $type = new TypeDocBook();
        $type->setName('gboolean');// struct _name_t *ptr;
        
        $data = $sourceCode->getTypedef('gboolean');

        if ($sourceCode->hasTypedef($data['type'])) {
            $d = $sourceCode->getTypedef($data['type']);
            print_r($d);
        }
        //$type->specifier = [unsigned', 'short']; => TypeGenerator::fromString()->ff =='int'

        //print_r($sourceCode->getTypedef($d['type']));

        //$type->specifier = VOID | CHAR| SHORT| INT| LONG| FLOAT| DOUBLE| SIGNED| UNSIGNED| struct_or_union_specifier| enum_specifier| TYPE_NAME;
        
        ////$var->qualifiers = CONST | VOLATILE;
        ////$var->pointers = **;
        ////$var->type = ;
        ////$var->modifiers = [] | [size];
    }

    public function testGnome() {

        //define('APP_DIR', realpath(__DIR__.'/..'));
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
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gtk-3.22.30.h');
            /*
            */
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

        //print_r($sourceCode->getProto('GtkCallback'));
        //chdir('/home/dev/Projects/cairo/doc/public/');
        //echo 'Working directory: '.getcwd(), PHP_EOL;

        $docBook = new DocBook();
        $docBook->setSourceCode($sourceCode);
        $parent = null; //new ExtensionDocBook();
        $model = $docBook->load(__DIR__.'/../data/gnome-3.28.2/doc.xml', $parent);
        //echo $model, PHP_EOL;
        
        /*
        //$generator = new PhpCodeGenerator();// stub
        //$generator = new ExtCodeGenerator();
        //$generator = new XmlCodeGenerator();
        */
        $generator = new CodeGenerator();
        $generator->setDocBook($docBook);
        $packages = $generator->getCodeGenerator($model);
        
        /**
         * [x] Set 1 : read header definition *.h
         * [x] Set 2 : read docBook
         * [x] Set 3 : create model : one file by object + function/const
         * [-] Set 4 : transfert model to dto
         * [ ] Set 5 : render
         * [ ] Set 6 : save file
         */
        
        //$fileDto = Dto\Xml\FileDto::create($code);
        //$fileDto = Dto\Php\FileDto::create($code);
        //$fileDto = Dto\C\Source\FileDto::create($code);
        foreach ($packages as $package) {
            foreach ($package->files as $code) {

                $fileDto = Dto\Ext\Header\FileDto::create($code);//$fileGenerator

                $php_version = '7.2';
                $this->resolver = new TemplatePathStack($php_version);
                //$this->resolver->setViewVersion('7.2');
                $this->resolver->addPath(__DIR__.'/../src/Views/Ext');// priority low
                $this->resolver->addPath(__DIR__.'/../src/Views/Ext/Header');// priority hight
                $this->resolver->setViewContext('Glib/GObject', 'GObject');
                $this->resolver->setViewContext('Cairo', 'cairo_t');
        
                $view = $this->getView();
        
                $modelLicense = new ViewModel();
                $modelLicense->setVariable('author', 'William A. Hellman');
                $modelLicense->setVariable('php_version', $php_version);
                $modelLicense->setTemplate('license.phtml');
        
                $modelClass = new ViewModel();
                $modelClass->setVariables($fileDto['class']);
                $modelClass->setTemplate('class.phtml');
        
                $model = new ViewModel();
                //$model->setVariable('data', 'World');
                $model->setVariables($fileDto);
                $model->setTemplate('file.phtml');
                $model->addChild($modelLicense, 'license');
                $model->addChild($modelClass, 'content');
                
                $view->render($model);

                $content = $view->getResponse()->getContent();

                $path = realpath(__DIR__.'/../output') . '/' . $fileDto['pathname'];
                `mkdir $path`;
                $filename = __DIR__.'/../output/'. $fileDto['pathname'] . $fileDto['filename'];
                //echo $filename, PHP_EOL;
                file_put_contents($filename, $content);

            }
        }

        //$extensionDto = $agent->getExtension($model);


        /*
        echo PHP_EOL, $model;
        echo 'TODO: Documentation Var, (since : Union, Typedef, Macro)', PHP_EOL;
        echo 'TODO: Documentation property, style, signal, ...', PHP_EOL;
        */
        

        

        $this->assertTrue(true);
    }

    public function testPoo() {

        //define('APP_DIR', realpath(__DIR__.'/..'));
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
            $sourceCode->loadTypes($data_dir.'/gnome-3.28.2/gtk-3.22.30.h');
            /*
            */
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

        $docBook = new DocBook();
        $docBook->setSourceCode($sourceCode);
        $parent = null; //new ExtensionDocBook();
        $model = $docBook->load(__DIR__.'/../data/gnome-3.28.2/doc.xml', $parent);
        
        $generator = new CodeGenerator();
        $generator->setDocBook($docBook);
        $packages = $generator->getCodeGenerator($model);

        $php_version = '7.2';
        $this->resolver = new TemplatePathStack($php_version);
        //$this->resolver->setViewVersion('7.2');
        $this->resolver->addPath(__DIR__.'/../src/Views/Ext');// priority low
        $this->resolver->addPath(__DIR__.'/../src/Views/Ext/Header');// priority hight

        $transformer = $this->getDataTransferObject($php_version);
        $transformer->getResolver()->addPath(__DIR__.'/../src/Models/Ext');
        $transformer->getResolver()->addPath(__DIR__.'/../src/Models/Ext/Header');
        $transformer->addMap(__DIR__.'/../src/Models', 'ZendExt\\Dto\\');

        foreach ($packages as $package) {
            foreach ($package->files as $code) {

                /** @var FileGenerator $fileGenerator */
                $fileGenerator = $code;
                $object_name = $fileGenerator->getClass()->getName();

                // Template
                $this->resolver->setViewContext('Cairo', $object_name);

                // DTO
                $transformer->getResolver()->setViewContext('Cairo', $object_name);
                $fileDto = $transformer->transfer('FileDto.php', $code);
                
                
                $view = $this->getView();
        
                $modelLicense = new ViewModel();
                $modelLicense->setVariable('author', 'William A. Hellman');
                $modelLicense->setVariable('php_version', $php_version);
                $modelLicense->setTemplate('license.phtml');
        
                $modelClass = new ViewModel();
                $modelClass->setVariables((array)$fileDto->class);
                $modelClass->setTemplate('class.phtml');
        
                $model = new ViewModel();
                //$model->setVariable('data', 'World');
                $model->setVariables((array)$fileDto);
                $model->setTemplate('file.phtml');
                $model->addChild($modelLicense, 'license');
                $model->addChild($modelClass, 'content');
                
                $view->render($model);

                $content = $view->getResponse()->getContent();

                $path = realpath(__DIR__.'/../output') . '/' . $fileDto->pathname;
                `mkdir -p $path`;
                $filename = __DIR__.'/../output/'. $fileDto->pathname . $fileDto->filename;
                //echo $filename, PHP_EOL;
                echo $content, PHP_EOL;
                //file_put_contents($filename, $content);

            }
        }

        $this->assertTrue(true);
    }

    //  ./vendor/bin/phpunit --filter DocBookGeneratorTest::testAgent ./test
    //  ./vendor/bin/phpunit --filter DocBookGeneratorTest::testAgent ./test
    public function testAgent() {
        $agent = new Agent();

        /*
        ClassifierPoo::$map = [
            'cairo_t' => 'Context',
        ];
        ClassifierPoo::$map_method = [
            'cairo_copy_path'      => '__clone',
            'gtk_widget_new'       => '__construct',
            'gtk_widget_destroy'   => '__destructor',
            'gtk_requisition_copy' => '__clone',
        ];
        Classifier::$map_file = [
            'cairo_copy_path'      => '__clone',
            'gtk_widget_new'       => '__construct',
            'gtk_widget_destroy'   => '__destructor',
            'gtk_requisition_copy' => '__clone',
        ];
        */

        Classifier::$map_namespace = [
            'glib'    => 'g',
            'gobject' => 'g',
            'gio'     => 'g',
        ];
        Classifier::$map_function = [
            // PHP_FUNCTION()              => file-object
            // =========================== = =============================
            'cairo_create'                 => 'cairo_t',
            'cairo_rectangle_list_destroy' => 'cairo_rectangle_list_t',
            'cairo_copy_path'              => 'cairo_path_t',// depend on cairo_t
            'gtk_widget_new'               => 'GtkWidget',
            'gtk_cairo_should_draw_window' => 'GtkWidget',// PHP_FUNCTION(gtk_cairo_should_draw_window) in php_gtk/widget.c

            /** GError */
            'g_set_error'                  => 'GError',
            'g_set_error_literal'          => 'GError',
            'g_propagate_error'            => 'GError',
            'g_clear_error'                => 'GError',
            'g_prefix_error'               => 'GError',
            'g_propagate_prefixed_error'   => 'GError',

            /** GQuark */
            'g_intern_string'             => 'GQuark',
            'g_intern_static_string'      => 'GQuark',

            /** GChecksum */
            'g_compute_checksum_for_data'  => 'GChecksum',
            'g_compute_checksum_for_string'=> 'GChecksum',
            'g_compute_checksum_for_bytes' => 'GChecksum',

            /** GHmac */
            'g_compute_hmac_for_data'      => 'GHmac',
            'g_compute_hmac_for_string'    => 'GHmac',
            'g_compute_hmac_for_bytes'     => 'GHmac',

            /** GThread */
            'g_thread_init'                => 'GThread',
            'g_thread_get_initialized'     => 'GThread',
            'g_thread_create'              => 'GThread',
            'g_thread_create_full'         => 'GThread',
            'g_thread_set_priority'        => 'GThread',
            'g_thread_foreach'             => 'GThread',

            /** GMutex */
            'g_mutex_new'                  => 'GMutex',
            'g_mutex_free'                 => 'GMutex',

            /** GCond */
            'g_cond_new'                   => 'GCond',
            'g_cond_free'                  => 'GCond',

            'g_private_new'                => 'GPrivate',

            /*
            'g_test_get_root'              => 'GTestSuite',
            'g_test_run_suite'             => 'GTestSuite',
            'g_test_create_suite'          => 'GTestSuite',

            'g_test_create_case'          => 'GTestCase',
            */

        ];
        Classifier::$map_type = [
            /** C-Type      => Php-Type */
            'gboolean'      => 'bool',
            'gpointer'      => 'mixed',
            "gconstpointer" => "mixed",
            "gchar"         => "string",
            "guchar"        => "string",
            "gunichar"      => "string",
            "gunichar2"     => "string",
            "gshort"        => "int",
            "gushort"       => "int",
            "glong"         => "int",
            "gulong"        => "int",
            "gint"          => "int",
            "gint8"         => "int",
            "guint"         => "int",
            "guint8"        => "int",
            "gint16"        => "int",
            "guint16"       => "int",
            "gint32"        => "int",
            "guint32"       => "int",
            "gint64"        => "int",
            "guint64"       => "int",
            "gfloat"        => "float",
            "gdouble"       => "float",
            "gsize"         => "int",
            "gssize"        => "int",
            "goffset"       => "int",
            "gintptr"       => "int",
            "guintptr"      => "int",

            "gchararray"    => "string",// string[]

            "va_list"       => "array",// string[]
            "GTokenValue"   => "object|string|int|float",// gpointer=>mixed, but in this case we use object
            

            'cairo_bool_t' => 'bool',
        ];
        Classifier::$map_class = [
            /** Force to be class. GTypeClass is alias of gsize but GTypeInstance is struct */
            "GTypeClass",
            "GInitiallyUnownedClass",
        ];
        Classifier::$map_object = [
            /** Force to be object. GType is alias of gsize */
            "GType",
            "GInitiallyUnowned",
            "GMutex",
            "GMutexLocker",
            "GStrv",
            "GTime",
            "GDateDay",
            "GDateYear",
            "GTimeSpan",
            "GQuark",// GQuark is alias of long
        ];
        /*
        "GSignalCMarshaller",
        "GSignalCVaMarshaller",
        */

        /*
        $name:
        GSequenceIter doit-être un Iterator

        Display:int
        Drawable:int
        Screen:int
        Pixmap:int
        Visual:int
        CGContextRef
        HDC
        cairo_write_func_t:callable
        cairo_read_func_t:callable
        cairo_destroy_func_t:callable
        cairo_user_scaled_font_text_to_glyphs_func_t:callable
        */
        $dist = [
            'gnome-3.28.2' => [
                'headers'=>[
                    'glib-2.56.4.h',
                    'gobject-2.56.4.h',
                    'gio-2.56.4.h',
                    'cairo-1.15.10.h',
                    'pango-1.40.14.h',
                    'atk-2.28.1.h',
                    'gdk_pixbuf-2.36.11.h',
                    'gdk-3.22.30.h',
                    'gtk-3.22.30.h',
                ],
                'overwrite'=>[
                    'glib-2.56.4.php',// macro prototype
                ],
            ],
            'gnome-42.5' => [
                'headers'=>[
                    'glib-2.72.4.h',
                    //...
                ],
                'overwrite'=>[
                    'glib-2.72.4.php',
                    //...
                ],
            ]
        ];

        $features_threads = ['GAsyncQueue', 'GThreadPool', 'GThreadError', 'GThread', 'GMutex', 'GMutexLocker', 'GRecMutex', 'GRWLock', 'GCond', 'GPrivate', 'GOnce', 'GOnceStatus'];
        $features_database = ['GRelation', 'GTuples'];

        $gnome_version = '3.28.2';
        $php_version = '8.1.0';
        $key = 'gnome-'.$gnome_version;
        $agent->setVersion($php_version);
        $agent->setDataPath(__DIR__.'/../data/'.$key);
        $agent->setCachePath(__DIR__.'/../data');// use ../tmp
        $agent->setViewPath(__DIR__.'/../src/Views');
        $agent->setModelPath(__DIR__.'/../src/Models', 'ZendExt\\Dto\\');
        //$agent->setModelPath(__DIR__.'/../src/Models/Ext/Source', 'ZendExt\\Dto\\Ext\\Source');
        //Agent::save() near line 238, add : $transformer->addMap(__DIR__.'/../src/Models/Ext/Source/7', 'ZendDto\\Ext\\Source\\');
        //Agent::save() near line 238, add : $transformer->addMap(__DIR__.'/../src/Models/Ext/Source/8/2', 'ZendDto\\Ext\\Source\\');

        // $transformer->addMap(__DIR__.'/../src/Models/<Ext/Source/><cairo/cairo_t/cairo_create>', 'ZendDto\\Ext\\Source\\Cairo\\Cairo_t\\Cairo_create');// FunctionArgsDto;
        // $transformer->addMap(__DIR__.'/../src/Models/<Ext/Source/><8/1>/<cairo/cairo_t/cairo_create>', 'ZendDto\\Ext\\Source\\Cairo\\Cairo_t\\Cairo_create');// FunctionArgsDto;
        // $transformer->addMap(__DIR__.'/../src/Models/<Ext/Source/><8/2>/<cairo/cairo_t/cairo_create>', 'ZendDto\\Ext\\Source\\Cairo\\Cairo_t\\Cairo_create');// FunctionArgsDto;

        //$agent->useWhitelist(['cairo_t'=>['cairo_get_dash'/*, 'cairo_set_dash'*/], 'GtkWidget'=>['gtk_widget_new', 'gtk_widget_show'], 'GObject'=>[]]);
        //$agent->useBlacklist(['GDate'=>['g_date_to_struct_tm']]);
        //$agent->useWhitelist(['GBookmarkFile'=>['g_bookmark_file_get_uris']]);//'g_bookmark_file_new', 'g_bookmark_file_load_from_file', 
        //$agent->useWhitelist(['GQuark'=>[], 'GError'=>['g_error_new']]);
        $agent->useWhitelist(['GQuark'=>[], 'GError'=>[], 'GBookmarkFile'=>[]]);
        //gboolean 	g_bookmark_file_load_from_data_dirs ()
        //$agent->useWhitelist(['GRelation'=>[], 'GTuples'=>[]]);
        
        //$agent->clearCache();// use rm ../data/cache.txt
        $sourceCode = $agent->loadCode($dist[$key]['headers'], $dist[$key]['overwrite']);

        //print_r($sourceCode->getMacro('g_thread_supported'));
        $agent->loadBook('doc.xml', $sourceCode);
        

        
        $run_dry = false;
        //$agent->save('Stub/Poo', __DIR__.'/../output/stub/poo', $run_dry);
        //$agent->save('Stub/Pp', __DIR__.'/../output/stub/pp', $run_dry);
        
        /*
        */
        $agent->save('Ext/Header', __DIR__.'/../output/ext', $run_dry);
        $agent->save('Ext/Source', __DIR__.'/../output/ext', $run_dry);

        $this->assertTrue(true);
    }

    public function testMacro() {
        $agent = new Agent();
        $php_version = '8.0.0';
        $agent->setVersion($php_version);
        $agent->setDataPath(__DIR__.'/../data/gnome-3.28.2');
        $agent->setCachePath(__DIR__.'/../data');// use ../tmp
        $agent->setViewPath(__DIR__.'/../src/Views');
        $agent->setModelPath(__DIR__.'/../src/Models', 'ZendExt\\Dto\\');

        $sourceCode = $agent->loadCode();
        
        //$agent->loadBook('doc.xml', $sourceCode);
        $docBook = new \Zend\Ext\Services\DocBook\Gnome();
        $docBook->setSourceCode($sourceCode);
        $modelDocBook = $docBook->load(__DIR__.'/../data/gnome-3.28.2/doc.xml');

        $generator = new CodeGenerator();
        $generator->setVersion($php_version);
        $generator->setDocBook($docBook);
        //$generator->getCodeGenerator($modelDocBook);
        $output_str = $generator->macroCodeGenerator($modelDocBook);

        echo '<?php ', PHP_EOL;
        echo $output_str;

        $this->assertTrue(true);
    }

    public function testDto() {
        // ZendExt\Dto\Ext\Source\FunctionArgsDto == src/Models/Ext/Source/FunctionArgsDto.php
        // ZendExt\Dto\Ext\Source\...\FunctionArgsDto == src/Models/Ext/Source/8/1/FunctionArgsDto.php
        // ZendExt\Dto\Ext\Source\...\FunctionArgsDto == src/Models/Ext/Source/8/1/Cairo/FunctionArgsDto.php
        // ZendExt\Dto\Ext\Source\_8\_1\...\FunctionArgsDto == src/Models/Ext/Source/8/1/Cairo/Cairo_create/FunctionArgsDto.php

        $php_version = '8.1.2';
        $resolver = new \Zend\Ext\View\Resolver\TemplatePathStack($php_version);
        $resolver->addPath(__DIR__.'/../src/Models'.'/Ext/Source');// '/Ext/Header'
        $resolver->setViewContext('Cairo', 'cairo_create');

        $render = new \Zend\Ext\View\Renderer\CodeGeneratorRenderer();
        $render->setResolver($resolver);
        //$render->addMap(__DIR__.'/../src/Models/', '');
        //$render->addMap(__DIR__.'/../src/Models/Ext/Header', 'ZendDto\\Ext\\Header\\');
        $render->addMap(__DIR__.'/../src/Models/Ext/Source', 'ZendExt\\Dto\\Ext\\Source\\');
        //$render->addMap(__DIR__.'/../src/Models', 'ZendExt\\Dto\\');
        
        //$modelClass = new \Zend\Ext\View\Model\CodeGeneratorModel();
        //$modelClass->setTemplate('FunctionArgsDto.php');
        $modelClass = 'FunctionArgsDto.php';

        $model = new \Zend\Ext\Models\Code\Generator\MethodGenerator();
        $dto = $render->transfer($modelClass, $model);

        var_dump($dto);



        $this->assertTrue(true);
    }

    public function testResolver() {
        $path = __DIR__.'/../src/Views/Ext/Source';
        $version_target=[8, 0, 0];
        $resolver = new TemplatePathStack(implode('.', $version_target));// last
        $resolver->addPath($path);
        echo PHP_EOL;

        // /8/0/0 => /8/0 => 8/ => /8 => /7/99/99
        // 8.0.0 => 8.0 => 8 => 7.99.99
        echo implode('.', $version_target);
        $version_target = $resolver->downgrader($version_target, $path);
        echo ' => ', implode('.', $version_target), PHP_EOL;// 8

        echo implode('.', $version_target);
        $version_target = $resolver->downgrader($version_target, $path);
        echo ' => ', implode('.', $version_target), PHP_EOL;// 8

        echo implode('.', $version_target);
        $version_target = $resolver->downgrader($version_target, $path);
        echo ' => ', implode('.', $version_target), PHP_EOL;// 8

        $this->assertTrue(true);
    }

    public function testReflection() {
        $path = realpath(__DIR__.'/../data/gnome-3.28.2');
        $path .= '/glib-2.56.4.php';
        echo $path, PHP_EOL;

        $functions = include($path);
        $functions = array_diff($functions['user'], ['composer\autoload\includefile', 'deepcopy\deep_copy', 'gint']);
        $functions = array_filter($functions, function ($v) {
            // "composerrequireb77025529192e879922af895bdc5f677"
            if (0===strpos($v, 'composerrequire')) return false; return true;
        });
        $functions = array_values($functions);// remake index
        

        print_r($functions);
        $function = $functions[1];// g_node_append
        //FileGenerator::fromArray();

        /*
        $functionReflection = new FunctionReflection($function);
        echo $functionReflection->getName(), PHP_EOL;
        $parameters = $functionReflection->getParameters();
        foreach ($parameters as $parameter) {
            echo "\t" . $parameter->getType() . ' $' . $parameter->getName(), PHP_EOL;
        }
        $returns = $functionReflection->getReturnType();
        if ($returns) {
            echo " -> " . $returns->getName();
        }
        */

        /*
        $functionGenerator = new MethodGenerator($functionReflection->getName());
        echo $functionGenerator->getName(), PHP_EOL;
        $parameters = $functionGenerator->getParameters();
        foreach ($parameters as $parameter) {
            echo $parameter->getType() . ' $' . $parameter->getName(), PHP_EOL;
        }
        */

        $this->assertTrue(true);
    }
}
