<?php

namespace Zend\Ext\Views\Helpers;

use Zend\View\View;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Response;

use Zend\Ext\Models\MethodGenerator;

use Zend\View\Helper\AbstractHelper;


class MethodHelper extends AbstractHelper
{
    public function __invoke($methodDto)
    {
        $licenseModel = new ViewModel(array('author' => 'No Name'));
        $licenseModel->setVariable('date', '31/12/1999');
        $licenseModel->setVariable('name', $methodDto->name);
        $licenseModel->setVariable('short_description', ''/*$method->getShortDescription()*/);
        $licenseModel->setVariable('type', ''/*$method->getType()*/);
        $licenseModel->setVariable('method', $methodDto);
        $licenseModel->setVariable('parameters', $methodDto->parameters);
        $licenseModel->setTemplate('method.phtml');

        $view = $this->getView();// instance of PhpRenderer
        $output = $view->render($licenseModel);

        return $output;
    }
}
