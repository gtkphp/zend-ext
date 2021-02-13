<?php

namespace Zend\Ext\Helpers\Php\Poo;

use Zend\View\View;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Response;

use Zend\Ext\Models\MethodGenerator;

use Zend\View\Helper\AbstractHelper;


class MethodHelper extends AbstractHelper
{
    static public $filter = NULL;

    public function __invoke($method)
    {
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', '31/12/1999');
        $licenseModel->setVariable('name', $method->getName());
        $licenseModel->setVariable('short_description', $method->getShortDescription());
        $licenseModel->setVariable('type', $method->getType());
        $licenseModel->setVariable('method', $method);
        $licenseModel->setTemplate('method.phtml');

        $view = $this->getView();
        /*
        $view->render($licenseModel); /!\ not an instance of Zend\View
        $output = $view->getResponse()->getContent();
        */
        $view = $this->getView();// instance of PhpRenderer
        $output = $view->render($licenseModel);
        //$gtkwindow_c = $view->getResponse()->getContent();

        //$output = get_class($view)."\n";
        return $output;
    }
}
