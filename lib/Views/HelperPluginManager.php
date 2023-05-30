<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Ext\Views;

use Zend\ServiceManager\Exception\InvalidServiceException;
use Zend\View\HelperPluginManager as ZendHelperPluginManager;

/**
 * Plugin manager implementation for view helpers
 *
 * Enforces that helpers retrieved are instances of
 * Helper\HelperInterface. Additionally, it registers a number of default
 * helpers.
 */
class HelperPluginManager extends ZendHelperPluginManager
{
    /**
     * @var array
     */
    protected $searchPath=array();

    function addPathHelper($dir, $namespace) {
        $this->searchPath[$dir] = $namespace;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $name Service name of plugin to retrieve.
     * @param null|array $options Options to use when creating the instance.
     * @return mixed
     * @throws Exception\ServiceNotFoundException if the manager does not have
     *     a service definition for the instance, and the service is not
     *     auto-invokable.
     * @throws InvalidServiceException if the plugin created is invalid for the
     *     plugin context.
     */
    public function get($name, array $options = null)
    {
        
        //echo get_class($this->getRenderer()->setResolver())." getResolver is private\n";
        //$this->getResolver()."\n";

        if (! $this->has($name)) {
            if (preg_match('#[a-z0-9]Helper$#', $name, $matchs)) {
                $class = ucfirst($name);
                foreach($this->searchPath as $path=>$ns) {
                    $filename = $path . '/' . $class . '.php';
                    $class_name = $ns . '\\' . $class;
                    if (file_exists($filename)) {
                        $this->setFactory($name, function ($pluginManager) use($class_name) {
                            return new $class_name;
                        });
                        break;
                    }
                }
            }
        }
        return parent::get($name, $options);
    }
}
