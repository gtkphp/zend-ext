<?php

namespace Zend\Ext\View\Resolver;

use Exception as GlobalException;
use FFI\Exception as FFIException;
use SplFileInfo;
use Traversable;
use Zend\Stdlib\SplStack;
use Zend\View\Resolver\TemplatePathStack as ZendTemplatePathStack;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Exception;

use Zend\View\Renderer\PhpRenderer;
/**
 * 
// ObjectPathResolver
// PackagePathResolver
// VersionPathResolver
// AggregateResolver

AggregateResolver
: VersionPathResolver + PackagePathResolver + ObjectPathResolver
| VersionPathResolver + PackagePathResolver
| VersionPathResolver
|                       PackagePathResolver + ObjectPathResolver
|                       PackagePathResolver
|                                             ObjectPathResolver
;

TemplatePathStack
: T_PATH_2 + AggregateResolver + T_NAME 
| T_PATH_1 + AggregateResolver + T_NAME 
;


T_NAME : "file.phtml"
T_PATH_X : "Ext/Header" | "Ext/Source" | "Xml" | "Php/Poo" | "Php/Pp"

 */
class TemplatePathStack extends ZendTemplatePathStack
{
    const MAJOR_VERSION = 0;
    const MINOR_VERSION = 1;
    const MINUS_VERSION = 2;

    /**
     * @var array<int>[]
     */
    protected $version_target;

    /** @var array<int, array<int, array<int, array>>>[3] */
    private $versions = null;

    private $contextPackage = null;
    public $contextObject = null;

    /**
     * @var string $version_target Version '1.0.0'
     * 
     */
    public function __construct(string $target, $options = null)
    {
        $this->setVersionTarget($target);

        parent::__construct($options);
    }
    
    public function clear()
    {
        $this->clearPaths();
        $this->versions = null;
    }

    public function setViewContext(string $package, string $object)
    {
        $this->contextPackage = $package;
        $this->contextObject = $object;
    }

    /**
     * Set LFI protection flag
     *
     * @param  string $version 
     * @return TemplatePathStack
     */
    public function setVersionTarget(string $version)
    {
        // TODO 7.4.0.RC1
        $this->version_target = array();
        $major_minor_minus = explode('.', $version);
        $deep = count($major_minor_minus);
        for ($i=0; $i<$deep; $i++){
            $v = isset($major_minor_minus[$i]) ? $major_minor_minus[$i] : '0';
            $this->version_target[$i] = $v;
        } 
        return $this;
    }
    /**
     * @return string $version
     */
    public function getVersionTarget()
    {
        return implode('.', $this->version_target);
    }

    public function resolveModel($name, $path, $namespace)
    {
        $filePath = $this->resolve($name);

        // Ensure we remove the file extension
        $suffix = pathinfo($name, PATHINFO_EXTENSION);

        $klass = substr($filePath, strlen(realpath($path))+1, - strlen($suffix) - 1);// ".php"
        $klass = $namespace . str_replace('/', '\\', $klass);
        
        require_once $filePath;

        return $klass;
    }

    public function resolve($name, Renderer $renderer = null)
    {
        $this->lastLookupFailure = false;

        if ($this->isLfiProtectionOn() && preg_match('#\.\.[\\\/]#', $name)) {
            throw new Exception\DomainException(
                'Requested scripts may not include parent directory traversal ("../", "..\\" notation)'
            );
        }

        if (! count($this->paths)) {
            $this->lastLookupFailure = static::FAILURE_NO_PATHS;
            return false;
        }

        // Ensure we have the expected file extension
        $defaultSuffix = $this->getDefaultSuffix();
        if (pathinfo($name, PATHINFO_EXTENSION) == '') {
            $name .= '.' . $defaultSuffix;
        }

        /** @var array<int> */
        $version_target = $this->version_target;

        // template path
        foreach ($this->paths as $path) {

            // version path
            while(count($version_target)) {
                $stack_path = $path . implode('/', $version_target) . '/';
                // {php_version} . {Glib/Glib} .  {GArray} . 'class.phtml'
                $full_stack_path = $stack_path . '/' . $this->contextPackage . '/' . $this->contextObject . '/' ;//. $this->contextFunction;
                $filePath = $this->resolvePath($full_stack_path, $name);
                if ($filePath !== false) {
                    return $filePath;
                }

                // {php_version} . 'Glib/GLib' . 'class.phtml'
                // {php_version} . 'Glib'      . 'class.phtml'
                $stack_package = explode('/', $this->contextPackage);
                $ln = count($stack_package);
                for($i=0; $i<$ln; $i++) {
                    $stack_package_path = implode('/', $stack_package);
                    $full_stack_path = $stack_path . '/' . $stack_package_path . '/';
                    $filePath = $this->resolvePath($full_stack_path, $name);
                    if ($filePath !== false) {
                        return $filePath;
                    }
                    array_pop($stack_package);
                }

                // {php_version} . 'class.phtml'
                $filePath = $this->resolvePath($stack_path, $name);
                if ($filePath !== false) {
                    return $filePath;
                }

                $version_target = $this->downgrader($version_target, $path);
            }

            $stack_package = explode('/', $this->contextPackage);

            $ln = count($stack_package);
            for($i=0; $i<$ln; $i++) {
                $stack_package_path = implode('/', $stack_package);

                // 'Glib/Glib' . 'GArray' . 'class.phtml'
                $full_stack_path = $path . '/' . $stack_package_path . '/' . $this->contextObject . '/';
                $filePath = $this->resolvePath($full_stack_path, $name);
                if ($filePath !== false) {
                    return $filePath;
                }

                // 'Glib/GLib' . 'class.phtml'
                // 'Glib'      . 'class.phtml'
                $full_stack_path = $path . '/' . $stack_package_path . '/';
                $filePath = $this->resolvePath($full_stack_path, $name);
                if ($filePath !== false) {
                    return $filePath;
                }
                array_pop($stack_package);
            }

            //       'class.phtml'
            $filePath = $this->resolvePath($path, $name);
            if ($filePath !== false) {
                return $filePath;
            }

        }

        $this->lastLookupFailure = static::FAILURE_NOT_FOUND;
        return false;
    }

    public function versionToString($versions)
    {
        return implode('.', $versions);
        //$versions[0] . '.' . $versions[1] . '.' . $versions[2];
    }

    public function getVersionPath($dir, $version, $level)
    {
        $path = '';

        for($i=0; $i<$level; $i++) {
            $path .= '/' . $version[$i];
        }
        $path = $dir . $path;

        return $path;
    }

    public function loadVersionsByDirectory($path):array
    {
        $versions = [];

        if (file_exists($path)) {
            $directories = scandir($path, SCANDIR_SORT_ASCENDING);
            $directories = array_diff($directories, array('..', '.'));
            foreach ($directories as $directory) {
                $dir = realpath($path . '/' . $directory);
                if (is_dir($dir)) {
                    if (is_numeric($directory)) {
                        $key = (int)$directory;
                        $versions[$key] = null;// null mean : subdirectory not loaded
                    }
                }
            } 
        }

        return $versions;
    }
    public function loadVersions($version, $dir)
    {
        if (! isset($this->versions)) {
            $path = $this->getVersionPath($dir, $version, 0);
            $this->versions = $this->loadVersionsByDirectory($path);
        }
        
        if ( isset($version[0]) && array_key_exists($version[0], $this->versions) ) {
            $path_major = $this->getVersionPath($dir, $version, 1);
            if ( is_null($this->versions[$version[0]]) ) {// cached ?
                $this->versions[$version[0]] = $this->loadVersionsByDirectory($path_major);
            }
        }

        if (isset($version[1]) && isset($this->versions[$version[0]]) && array_key_exists($version[1], $this->versions[$version[0]])) {
            $path_minor = $this->getVersionPath($dir, $version, 2);
            if ( is_null($this->versions[$version[0]][$version[1]]) ) {// cached ?
                $this->versions[$version[0]][$version[1]] = $this->loadVersionsByDirectory($path_minor);
            }
        }

    }

    public function fallbackVersion($versions) {
        $minor = -1;
        $num = count($versions);
        if ($num) {
            $minor = array_keys($versions)[$num-1];// array_key_last
        }
        return $minor;
    }
    public function falldownVersion($versions, $version) {
        $major = -1;
        for ( end($versions); false!==current($versions); prev($versions)) {
            $v = key($versions); 
            if ($v <= $version) {
                $major = $v;
                break;
            }
        }
        return $major;
    }

    public function rollbackVersion($version, $path) {
        $indexs = [-1, -1, -1];
        $major = -1;// major|minor|minus
        $this->loadVersions($version, $path);// ensure root is loaded
        $versions = $this->versions;
        
        $major = -1;

        if (isset($version[0])) {// $major accept
            for ( end($versions); false!==current($versions); prev($versions)) {
                $v = key($versions); 
                if ($v <= $version[0]) { // 3 <= 2
                    $major = $v;
                    //echo "match major $v\n";
                    break;
                }
            }
        }
        // $major est déjà la plus petit version si == -1

        $minor = -1;
        if ($major!=-1 && isset($version[1])) {// $major accept
            $this->loadVersions([$major], $path);// ensure major is loaded
            $versions = $this->versions[$major];
            if ($major==$version[0]) {// $major match
                //$minor = $this->falldownVersion($versions, $version[1]);
                for ( end($versions); false!==current($versions); prev($versions)) {
                    $v = key($versions); 
                    if ($v <= $version[1]) { // 3 <= 2
                        $minor = $v;
                        //echo "match minor $v\n";
                        break;
                    }
                }
            } else {// major fallback
                //$minor = $this->fallbackVersion($versions, $version);
                $num = count($versions);
                if ($num) {
                    $minor = array_keys($versions)[$num-1];// array_key_last
                }
            }
            reset($versions);
        } else {
            // minor est déjà la plus petit version
        }

        $minus = -1;
        if ($minor!=-1 && isset($version[2])) {// $major match or fallback
            $this->loadVersions([$major, $minor], $path); // ensure minor is loaded
            $versions = $this->versions[$major][$minor];
            if ($major==$version[0] && $minor==$version[1]) {// $major match
                //$minus = $this->falldownVersion($versions, $version[2]);
                for ( end($versions); false!==current($versions); prev($versions)) {
                    $v = key($versions); 
                    if ($v <= $version[2]) { // 3 <= 2
                        $minus = $v;
                        //echo "match minus $v\n";
                        break;
                    }
                }
            } else {// major fallback
                //$minus = $this->fallbackVersion($versions, $version);
                //echo "miss major|minor $v\n";
                $num = count($versions);
                if ($num) {
                    $minus = array_keys($versions)[$num-1];// array_key_last
                }
            }
            reset($versions);
        } else {
            // minus est déjà la plus petit version
        }

        $indexs = [$major, $minor, $minus];
        return $indexs;
    }

    public function downgradeVersion($version_a) {

        $ln = count($version_a);
        if ($ln>0) {
            $index = $ln-1;

            $version_a[$index]--;
            if ($version_a[$index]<0) {
                unset($version_a[$index]);
            } else {
                for ($i=$index+1; $i<3; $i++) {
                    $version_a[$i] = 99;
                }
            }
        } else {
            // Error "" - 0.0.1 = "99.99.99"
        }

        return $version_a;
    }

    public function downgrader($versions, $path) {
        $version = [];

        // decrement by one the version (1.0.1 => 1.0.0) (1.0.0 => 1.0) (1.0 => 1) (1 => 0.99.99)
        $versions = $this->downgradeVersion($versions);

        // catch the previous version
        $all_index = $this->rollbackVersion($versions, $path);

        /*$this->all_index[0] = $all_index[0];
        $this->all_index[1] = $all_index[1];
        $this->all_index[2] = $all_index[2];*/

        // fallback
        for ($i=0; $i<3; $i++) {
            if ($all_index[$i]<0) {
                //echo "stop\n";
                break;/*Unexpected*/
            } else {
                $version[$i] = $all_index[$i];
            }
        }

        return $version;
    }

    /**
     * Retrieve the filesystem path to a view script
     *
     * @param  string $name
     * @param  null|Renderer $renderer
     * @return string
     * @throws Exception\DomainException
     */
    public function resolvePath($path, $name)
    {
//if ('class.phtml'==$name) echo $path.$name, PHP_EOL; 
        /*if ('function.phtml'==$name) echo $path, PHP_EOL; 
        else echo $name, PHP_EOL;*/

        $file = new SplFileInfo($path . $name);
        if ($file->isReadable()) {
            // Found! Return it.
            if (($filePath = $file->getRealPath()) === false && substr($path, 0, 7) === 'phar://') {
                // Do not try to expand phar paths (realpath + phars == fail)
                $filePath = $path . $name;
                if (! file_exists($filePath)) {
                    return false;
                }
            }
            if ($this->useStreamWrapper()) {
                // If using a stream wrapper, prepend the spec to the path
                $filePath = 'zend.view://' . $filePath;
            }
            return $filePath;
        }
        
        $this->lastLookupFailure = static::FAILURE_NOT_FOUND;
        return false;
    }

}
