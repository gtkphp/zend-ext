<?php

namespace Zend\ExtGtk;

use Exception;
use Zend\Ext\Services\DocBook\Gnome as DocBook;
use Zend\Ext\Services\SourceCode\Glib as GlibSourceCode;
use Zend\Ext\Services\Extension as CodeGenerator;

use Zend\Ext\Models\Code\Package;
use \ZendExt\Dto\ClassDto;
use \ZendExt\Dto\EnumDto;

use Zend\ServiceManager\ServiceManager;
use Zend\View\Strategy\PhpRendererStrategy;
//use Zend\View\Resolver\TemplatePathStack;
use Zend\Ext\View\Resolver\TemplatePathStack;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Zend\View\View;
use Zend\Stdlib\Response;


class Agent
{
    const SOURCE_CACHE_FILENAME = 'cache.txt';

    /** @var string */
    protected $php_version = '7.2';

    /** @var string */
    protected $data_path;

    /** @var string */
    protected $cache_path;
    
    /** @var string */
    protected $view_path;

    /** @var string */
    protected $model_path;

    /** @var string */
    protected $model_namespace;

    /** @var Package[] */
    protected $packages;

    /** @var  The Data Transferer */
    protected $dto;

    /** @var  */
    protected $resolver;

    /** @var  */
    protected $renderer;

    /** @var View */
    protected $view;

    public function setVersion(string $php_version) {
        $this->php_version = $php_version;
        return $this;
    }

    public function setDataPath(string $data_path) {
        $this->data_path = $data_path;
        return $this;
    }

    public function setViewPath(string $path) {
        $this->view_path = $path;
        return $this;
    }
    
    public function setModelPath(string $path, string $namespace) {
        $this->model_path = $path;
        $this->model_namespace = $namespace;
        return $this;
    }
    
    public function setCachePath(string $path) {
        $this->cache_path = $path;
        return $this;
    }

    public function clearCache(string $path) {
        return $this;
    }

    protected $whitelist;
    public function useWhitelist(array $whitelist) {
        $this->whitelist = $whitelist;
        return $this;
    }
    protected $blacklist;
    public function useBlacklist(array $blacklist) {
        $this->blacklist = $blacklist;
        return $this;
    }
    
    

    public function loadCode(bool $use_cache=true) {
        $has_cache = false;
        $cache_filename = $this->cache_path . '/' . self::SOURCE_CACHE_FILENAME;
        if ($use_cache) {
            if (!is_dir($this->cache_path)) {
                throw new \Exception("Cache directory do not exists : '$this->cache_path'");
            }
            
            if (file_exists($cache_filename)) {
                $has_cache = true;
            } else {
                `touch $cache_filename`;
            }
        }

        if (! $has_cache) {
            $sourceCode = new GlibSourceCode();
            $sourceCode->loadTypes($this->data_path.'/glib-2.56.4.h');
            $sourceCode->loadTypes($this->data_path.'/gobject-2.56.4.h');
            $sourceCode->loadTypes($this->data_path.'/gio-2.56.4.h');
            $sourceCode->loadTypes($this->data_path.'/cairo-1.15.10.h');
            $sourceCode->loadTypes($this->data_path.'/pango-1.40.14.h');
            $sourceCode->loadTypes($this->data_path.'/atk-2.28.1.h');
            $sourceCode->loadTypes($this->data_path.'/gdk_pixbuf-2.36.11.h');
            $sourceCode->loadTypes($this->data_path.'/gdk-3.22.30.h');
            $sourceCode->loadTypes($this->data_path.'/gtk-3.22.30.h');
            /*
            */
            $sourceCode->evaluate();// resolve enum value
            // Time: 15.73 seconds, Memory: 129.69 MB

            file_put_contents($cache_filename, serialize(array('data'=>$sourceCode->array, 'macro'=>$sourceCode->defines)));
        } else {
            $sourceCode = new GlibSourceCode();
            $data = unserialize(file_get_contents($cache_filename));
            $sourceCode->array = $data['data'];
            $sourceCode->defines = $data['macro'];
            // Time: 147 ms, Memory: 61.69 MB
        }
        $sourceCode->loadStubs($this->data_path.'/glib-2.56.4.php');
        

        return $sourceCode;
    }
    
    public function loadBook($filename, $sourceCode) {
        $docBook = new DocBook();
        $docBook->setSourceCode($sourceCode);
        $parent = null; //new ExtensionDocBook();
        $modelDocBook = $docBook->load($this->data_path.'/'.$filename, $parent);

        $generator = new CodeGenerator();
        $generator->setVersion($this->php_version);
        $generator->setDocBook($docBook);
        if (isset($this->whitelist)) {
            $generator->setWhitelist($this->whitelist);
        }
        if (isset($this->blacklist)) {
            $generator->setBlacklist($this->blacklist);
        }
        
        $this->packages = $generator->getCodeGenerator($modelDocBook);

        return $this;
    }

    public function getDataTransferObject()
    {
        if (!isset($this->dto)) {
            $resolver = new TemplatePathStack($this->php_version);
            
            $renderer = new \Zend\Ext\View\Renderer\CodeGeneratorRenderer();
            $renderer->setResolver($resolver);

            $this->dto = $renderer;
        }
        
        return $this->dto;
    }

    public function getRenderer() {
        if (isset($this->renderer)) {
            return $this->renderer;
        }

        if (!isset($this->resolver)) {
            $this->resolver = new TemplatePathStack($this->php_version);// last
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

    public function save(string $name, $dir_output, $dry_run = true) {
        if (empty($this->packages)) {
            throw new Exception("Not package found. Ensure you have call Aggent::loadBook()");
        }

        echo PHP_EOL;
        echo 'Install: '.realpath($dir_output), PHP_EOL;


        $view = $this->getView();
        $this->resolver->clear();// $this->getRenderer()->resolver()->clear();

        $transformer = $this->getDataTransferObject();
        $transformer->getResolver()->clear();
        
        $stack_dir = '';
        $stack = explode('/', $name);
        foreach ($stack as $path) {
            $stack_dir .= '/'.$path;
            $transformer->getResolver()->addPath($this->model_path.$stack_dir);
            $this->resolver->addPath($this->view_path.$stack_dir);// priority low
        }
        $transformer->addMap(__DIR__.'/../src/Models', 'ZendExt\\Dto\\');

        $total = 0;
        foreach ($this->packages as $package) {
            echo "\t + php_".$package->name."/", PHP_EOL;
            $count = 0;
            foreach ($package->files as $code) {

                /** @var FileGenerator $fileGenerator */
                $fileGenerator = $code;
                if ($fileGenerator->hasClass()) {
                    $object_name = $fileGenerator->getClass()->getName();
                } else if ($fileGenerator->hasEnum()) {
                    $object_name = $fileGenerator->getEnum()->getName();
                } else {
                    $object_name = $fileGenerator->getAliasClass()->getName();
                }
                $ns_name = $fileGenerator->getNamespace();

                // Template
                $this->resolver->setViewContext($ns_name, $object_name);

                // DTO
                $transformer->getResolver()->setViewContext($ns_name, $object_name);
                try {
                    $fileDto = $transformer->transfer('FileDto.php', $code);
                } catch (Exception $e) {
                    $exc = new \Exception($e->getMessage() . "; For '$name' directory in '$this->model_path' path's", 404, $e);
                    throw $exc;
                }
                
                
                $view = $this->getView();
        
                $modelLicense = new ViewModel();
                $modelLicense->setVariable('author', 'William A. Hellman');
                $modelLicense->setVariable('php_version', $this->php_version);
                $modelLicense->setTemplate('license.phtml');
        
                if ($fileDto->class instanceof ClassDto) {
                    $modelClass = new ViewModel();
                    $modelClass->setVariables((array)$fileDto->class);
                    $modelClass->setTemplate('class.phtml');
                } else if ($fileDto->class instanceof EnumDto) {
                    $modelClass = new ViewModel();
                    $modelClass->setVariables((array)$fileDto->class);
                    $modelClass->setTemplate('enum.phtml');
                } else {
                    $modelClass = new ViewModel();
                    $modelClass->setVariables((array)$fileDto->class);
                    $modelClass->setTemplate('alias-class.phtml');
                }
        
                $model = new ViewModel();
                //$model->setVariable('data', 'World');
                $model->setVariables((array)$fileDto);
                $model->setTemplate('file.phtml');
                $model->addChild($modelLicense, 'license');
                $model->addChild($modelClass, 'content');
                
                try {
                    $view->render($model);
                } catch (\Exception $e) {
                    $exc = new \Exception("For '$name' directory in '$this->view_path' path's", 404, $e);
                    throw $exc;
                }
                $content = $view->getResponse()->getContent();

                if (!is_dir($dir_output)) {
                    throw new Exception("'$dir_output' do not exists");
                }
                
                $path = realpath($dir_output) . '/' . $fileDto->pathname;
                `mkdir -p $path`;
                $filename = $path . $fileDto->filename;

                $count++;
                //echo "\t\t + " . $fileDto->filename, PHP_EOL;
                if ($dry_run) {
                    //echo $content, PHP_EOL;
                } else {
                    file_put_contents($filename, $content);
                }

            }
            echo "\t\t + " . $count, ' files', PHP_EOL;
            $total += $count;
        }

        echo $total, ' files in 16 seconds', PHP_EOL;
        return true;
    }

    public function __construct()
    {
    }
    


}
