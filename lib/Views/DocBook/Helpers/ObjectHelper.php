<?php

namespace Zend\Ext\Views\DocBook\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;

use Zend\Ext\Views\PackageDto;
use Zend\Ext\Views\GroupDto;
use Zend\Ext\Views\ClassDto;
use Zend\Ext\Views\StructDto;
use Zend\Ext\Views\EnumDto;
use Zend\Ext\Views\UnionDto;
use Zend\Ext\Views\MethodDto;
use Zend\Ext\Views\ParameterDto;
use Zend\Ext\Views\ObjectDto;

use Zend\ExtGtk\Implementation;
use Zend\ExtGtk\Documentation;

class ObjectHelper extends AbstractHelper
{
    public function __invoke(ObjectDto $objectDto)
    {
        /**
         * @var Zend\View\Renderer\PhpRenderer
         */
        $view = $this->getView();

        if ($objectDto instanceof EnumDto) {
            $package_name = $objectDto->package->package->name;
            $impl = Implementation::Factory($package_name)->get($objectDto->name);

            $model = new ViewModel((array)$objectDto);
            $model->setVariable('implementation', $impl);
            $model->setVariable('type', 'enum');
            $model->setTemplate('enum.phtml');
            $output = $view->render($model);
        } else if ($objectDto instanceof MethodDto) {
            $package_name = $objectDto->package->package->name;
            $impl = Implementation::Factory($package_name)->get($objectDto->name);
            $documentation = Documentation::Factory($package_name);

            $model = new ViewModel((array)$objectDto);
            $model->setVariable('documentation', $documentation);
            //$model->setVariable('implementation', $impl);
            $model->setVariable('type', 'function');
            $model->setTemplate('function.phtml');
            $output = $view->render($model);
        } else if ($objectDto instanceof UnionDto) {
            /*$package_name = $objectDto->package->package->name;
            $impl = Implementation::Factory($package_name)->get($objectDto->name);

            $model = new ViewModel((array)$objectDto);
            $model->setVariable('implementation', $impl);
            $model->setVariable('type', 'union');
            $model->setTemplate('union.phtml');
            $output = $view->render($model);*/
        } else if ($objectDto instanceof ClassDto) {
            /*$package_name = $objectDto->package->package->name;
            $impl = Implementation::Factory($package_name)->get($objectDto->name);

            $model = new ViewModel((array)$objectDto);
            $model->setVariable('implementation', $impl);
            $model->setVariable('type', 'class');
            $model->setTemplate('class.phtml');
            $output = $view->render($model);*/
        } else if ($objectDto instanceof StructDto) {
            /*$package_name = $objectDto->package->package->name;
            $impl = Implementation::Factory($package_name)->get($objectDto->name);

            $model = new ViewModel((array)$objectDto);
            $model->setVariable('implementation', $impl);
            $model->setVariable('type', 'struct');
            $model->setTemplate('struct.phtml');
            $output = $view->render($model);*/
        } else if ($objectDto instanceof GroupDto) {
            /*$package_name = $objectDto->package->package->name;
            $impl = Implementation::Factory($package_name)->get($objectDto->name);

            $model = new ViewModel((array)$objectDto);
            $model->setVariable('implementation', $impl);
            $model->setVariable('type', 'struct');
            $model->setTemplate('group.phtml');
            $output = $view->render($model);*/
        } else {
            $output = 'In ObjectHelper "'.get_class($objectDto).'" not implemented';
        }

        return $output;
    }
}
