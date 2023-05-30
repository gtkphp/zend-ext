<?php

namespace ZendExt;

use Zend\ServiceManager\ServiceManager;
use Zend\View\Strategy\PhpRendererStrategy;
//use Zend\View\Resolver\TemplatePathStack;
use Zend\Ext\View\Resolver\TemplatePathStack;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Zend\View\View;
use Zend\Stdlib\Response;


class AgentController
{
    /** @var TemplatePathStack */
    protected $resolver;

    /** @var PhpRenderer */
    protected $renderer;

    /** @var View */
    protected $view;

    public function __construct()
    {
        $this->resolver = new TemplatePathStack('7.2');// 7.2 exists
        $this->resolver->addPath(__DIR__.'/../src/Views/');// priority low
    }
    
    public function getRenderer() {
        if (isset($this->renderer)) {
            return $this->renderer;
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

    public function Action () {

        //$this->resolver->setViewVersion('7.2');
        $this->resolver->setViewContext('Glib/GObject', 'GObject');

        //-----------------------------
        // CodeModelService();
        //-----------------------------
        $view = $this->getView();

        $model = new ViewModel();
        $model->setVariable('data', 'World');
        $model->setTemplate('class.phtml');

        $view->render($model);
        echo $view->getResponse()->getContent();

    }

}
