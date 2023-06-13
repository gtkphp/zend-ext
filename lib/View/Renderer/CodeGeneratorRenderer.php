<?php

namespace Zend\Ext\View\Renderer;

// use JsonSerializable;
// use Traversable;
// use Zend\Json\Json;
// use Zend\Stdlib\ArrayUtils;
// use Zend\View\Exception;
// use Zend\View\Model\JsonModel;
// use Zend\View\Model\ModelInterface as Model;
// use Zend\View\Renderer\RendererInterface as Renderer;

use Exception;
use Zend\View\Resolver\ResolverInterface as Resolver;
use Zend\Ext\View\Resolver\TemplatePathStack;


use Zend\Ext\View\Model\CodeGeneratorModel as Model;

/**
 * CodeGenerator renderer
 */
class CodeGeneratorRenderer
{
    /**
     * @var TemplatePathStack
     */
    protected $resolver;

    /**
     * @var array <string: path, string: namespace>
     */
    protected $map = [];
    

    /**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * Set the resolver used to map a template name to a resource the renderer may consume.
     *
     * @todo   Determine use case for resolvers when rendering JSON
     * @param  TemplatePathStack $resolver
     * @return Renderer
     */
    public function setResolver(TemplatePathStack $resolver)
    {
        $this->resolver = $resolver;
    }
    /**
     * @return TemplatePathStack
     */
    public function getResolver() {
        return $this->resolver;
    }

    public function addMap($path, $namepsace)
    {
        $path = realpath($path);
        if ($path) {
            $this->map[$path] = $namepsace;
        } else {
            // Exception
        }
    }

    public function loadClass($filePath)
    {
        $klass = null;// default ?
        
        // Ensure we remove the file extension
        $suffix = pathinfo($filePath, PATHINFO_EXTENSION);
        foreach ($this->map as $path=>$namespace) {
            if (0===strpos($filePath, $path)) {
                $filename = basename($filePath, '.php');
                $pathname = dirname($filePath);
                $pathname = '/'.substr($pathname, strlen($path)+1);
                $pathname = preg_replace('#/(\d+)#i', '/_$1', $pathname, 3);
                $klass = $namespace . str_replace('/', '\\', substr($pathname, 1)) . '\\' . $filename;

                //$klass = substr($filePath, strlen($path)+1, - strlen($suffix) - 1);// ".php"
                //$klass = $namespace . str_replace('/', '\\', $klass);
                
                require_once $filePath;
        
                return $klass;
            }
        }

        return $klass;
    }

    /**
     * Renders values as JSON
     *
     * @todo   Determine what use case exists for accepting both $nameOrModel and $values
     * @param  string|Model $nameOrModel The script/resource process, or a view model
     * @param  null|array|\ArrayAccess $values Values to use during rendering
     * @throws Exception\DomainException
     * @return object The data output.
     */
    public function transfer($nameOrModel, $value = null)
    {
        if ($nameOrModel instanceof Model) {
            $filePath = $this->resolver->resolve($nameOrModel->getTemplate());
            $klass = $this->loadClass($filePath);
            if (empty($klass)) {
                throw new Exception("'".$nameOrModel->getTemplate()."' Not found");
            }

            $data = $nameOrModel->convert($klass, $this->getEngine());

            return $data;
        }

        if (is_string($nameOrModel)) {
            $filePath = $this->resolver->resolve($nameOrModel);
            $klass = $this->loadClass($filePath);
            if (empty($klass)) {
                throw new Exception("'$nameOrModel' Not found");
            }

            $model = new \Zend\Ext\View\Model\CodeGeneratorModel();
            $model->setCodeGenerator($value);// CodeGenerator

            $data = $model->convert($klass, $this->getEngine());
            
            return $data;
        }

        /*
        // use case 3: Both $nameOrModel and $values are populated
        throw new Exception\DomainException(sprintf(
            '%s: Do not know how to handle operation when both $nameOrModel and $values are populated',
            __METHOD__
        ));
        */
    }

}
