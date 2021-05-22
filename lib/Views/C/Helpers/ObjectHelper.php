<?php

namespace Zend\Ext\Views\C\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;

use Zend\Ext\Views\PackageDto;
use Zend\Ext\Views\ClassDto;
use Zend\Ext\Views\StructDto;
use Zend\Ext\Views\EnumDto;
use Zend\Ext\Views\UnionDto;
use Zend\Ext\Views\ObjectDto;

use Zend\ExtGtk\Implementation;

class ObjectHelper extends AbstractHelper
{
    public function __invoke(ObjectDto $objectDto)
    {
        /**
         * @var Zend\View\Renderer\PhpRenderer
         */
        $view = $this->getView();

        if ($objectDto instanceof ClassDto) {
            $output = get_class($objectDto);

        } else if ($objectDto instanceof EnumDto) {
            $package_name = $objectDto->package->package->name;
            $impl = Implementation::Factory($package_name)->get($objectDto->name);

            $model = new ViewModel((array)$objectDto);
            $model->setVariable('implementation', $impl);
            $model->setTemplate('enum.phtml');
            $output = $view->render($model);
        } else if ($objectDto instanceof UnionDto) {
            $package_name = $objectDto->package->package->name;
            $impl = Implementation::Factory($package_name)->get($objectDto->name);

            $model = new ViewModel((array)$objectDto);
            $model->setVariable('implementation', $impl);
            $model->setTemplate('union.phtml');
            $output = $view->render($model);
        } else if ($objectDto instanceof StructDto) {
            $package_name = $objectDto->package->package->name;
            $impl = Implementation::Factory($package_name)->get($objectDto->name);

            $model = new ViewModel((array)$objectDto);
            $model->setVariable('implementation', $impl);
            $model->setTemplate('struct.phtml');
            $output = $view->render($model);
        } else {
            $output = 'In ObjectHelper "'.get_class($objectDto).'" not implemented';
        }

        return $output;
    }
}
