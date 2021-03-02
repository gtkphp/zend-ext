<?php

namespace Zend\Ext\Views\Helpers;

use Zend\Ext\Php\TypeGenerator;
use Zend\View\View;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Response;

use Zend\Ext\Models\MethodGenerator;

use Zend\View\Helper\AbstractHelper;


class ParameterHelper extends AbstractHelper
{
    public function __invoke($parameter)
    {
        $parameterModel = new ViewModel(array('author' => 'No Name'));
        $parameterModel->setVariable('name', $parameter->getName());

        if ($parameter->isCallback()) {
            $parameter->getType()->setName('callback');
        }
        $parameterModel->setVariable('type', $parameter->getType());

        $parameterModel->setVariable('parameter', $parameter);
        $parameterModel->setTemplate('parameter.phtml');

        /*
        $view = $this->getView();
        $view->render($licenseModel); /!\ not an instance of Zend\View
        $output = $view->getResponse()->getContent();
        */
        $view = $this->getView();// instance of PhpRenderer
        $output = $view->render($parameterModel);
        //$gtkwindow_c = $view->getResponse()->getContent();

        //$output = get_class($view)."\n";
        return $output;
    }
}
