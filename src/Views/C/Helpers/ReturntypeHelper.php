<?php

namespace Zend\Ext\Views\C\Helpers;

use Zend\Ext\Views\Helpers\TypeHelper;


class ReturntypeHelper extends TypeHelper
{
    static public $filter = NULL;
    protected static $returnMap = [
        'int'=>'long',
    ];

    public function __invoke($type, $case=0)
    {
        $str = '';
        if ($type->isPrimitive()) {
            $str = self::$internalPhpTypes[$type->getPrimitiveType()];
            if (isset(self::$returnMap[$str])) {
                $str = self::$returnMap[$str];
            }
        }

        if ($case==-1) {
            return strtolower($str);
        } else if ($case==0) {
            return $str;
        } else {
            return strtoupper($str);
        }
    }
}
