<?php

namespace Zend\Ext\Services\Classifier;

use Exception;
use Zend\Ext\Models\TypeGenerator;
use Zend\Ext\Models\ParameterGenerator;
use Zend\Ext\Models\FunctionGenerator;
use Zend\Ext\Models\FileGenerator;
use Zend\Ext\Models\GroupGenerator;
use Zend\Ext\Models\ObjectGenerator;
use Zend\Ext\Models\EnumGenerator;
use Zend\Ext\Models\UnionGenerator;
use Zend\Ext\Models\StructGenerator;// vtable
use Zend\Ext\Models\ClassGenerator;// vtable

use Zend\Ext\Models\DocBook\FunctionDocBook;
use Zend\Ext\Models\DocBook\RefEntryDocBook;
use Zend\Ext\Models\DocBook\StructDocBook;
use Zend\Ext\Models\DocBook\TypedefDocBook;
use Zend\Ext\Models\DocBook\TypeDocBook;
use Zend\Ext\Models\DocBook\AbstractDocBook;

class Cairo
{
    static public $map = [];
    static public $map_namespace = [];
    static public $map_function = [];
    static public $map_method = [];
    static public $map_type = [];
    static public $map_object = [];
    static public $map_class = [];
    

    public function isExportable(ObjectGenerator $object):bool {
        // union, macro, typedef
        if ($object instanceof EnumGenerator) {
            return true;
        }
        if ($object instanceof StructGenerator) {
            return true;
        }
        return false;
    }

    public function getPackageName(ObjectGenerator $object):string {
        //$object->par
    }

    public function getExportName(ObjectGenerator $object):string {
        $name = $object->getName();
        //cairo_font_face_t => font-face

        $name = substr($name, 6);// remove prefix
        $name = substr($name, 0, -2);// remove suffix
        $name = str_replace('_', '-', $name);

        //$name = 'php_cairo/'.$name.'.h';

        return $name;
    }

    public function getThis(FunctionDocBook $functionDocBook):? string {

        $parameter = $functionDocBook->getParameterAt(0);
        /** @var TypeDocBook */
        if ($parameter) {
            $type = $parameter->getType();// TypeGenerator
            if ($type) {
                return $type->getName();
            }
        }
        
        return null;
    }
    
    public static function RemoveSufix_t(string $name):string {
        if ('_t'==substr($name, -2)) {
            return substr($name, 0, -2);
        }
        return $name;
    }

    /**
     * PascalCase to snake_case
     */
    public static function PascalToSnake(string $name):string {
        // lcfirst($name)
        $name = strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $name));
        if ('_'==$name[0]) {
            $name = substr($name, 1);
        }
        return $name;
    }

    // [Camel|Snake|Dashe]ToPascal
    // PascalTo[Camel|Snake|Dashe]

    // [Pascal|Snake|Dashe]ToCamel
    // CamelTo[Pascal|Snake|Dashe]
    

    // [Pascal|Camel|Dashe]ToSnake
    // SnakeTo[Pascal|Camel|Dashe]
    
    // [Pascal|Camel|Snake]ToDashe
    // DasheTo[Pascal|Camel|Snake]
    public static function DasheToPascale(string $name):string {
        return ucfirst(str_replace('-', '', ucwords($name, '-')));
    }

    /**
     * camelCase to snake_ase
     */
    public static function CamelToSnake(string $name):string {
        //return strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', lcfirst($name)));
    }
    /**
     * snake_case to PascalCase
     */
    public static function SnakeToPascal(string $name):string {
        return ucfirst(str_replace('_', '', ucwords($name, '_')));
    }
    /**
     * snake_case to camelCase
     * 
     * For a better SnakeToCamel() use https://github.com/dwyl/english-words
     * gtk_widget_get_halign() => Gtk\Widget::getHAlign();
     * gtk_widget_set_hexpand() => Gtk\Widget::setHExpand();
     */
    public static function SnakeToCamel(string $name):string {
        return lcfirst(str_replace('_', '', ucwords($name, '_')));
    }
    public static function SnakeToDashe(string $name):string {
        return lcfirst(str_replace('_', '-', $name));
    }

    public static function Suffix(string $name, $suffix='_t'):string {
        $end = substr($name, -strlen($suffix));
        if ($end===$suffix) {
            return substr($name, 0, -strlen($suffix));
        }
        return $name;
    }

    public static function Prefix(string $name, $prefix='cairo_'):string {
        $begin = substr($name, 0, strlen($prefix));
        if ($begin===$prefix) {
            return substr($name, strlen($prefix));
        }
        return $name;
    }
    
    
    /**
     */
    public function getMethodName(FunctionDocBook $functionDocBook, AbstractDocBook $objectDocBook):? string {
        /** @var StructDocBook $structDocBook */
        $structDocBook = $objectDocBook;
        if ($structDocBook) {
            $prefix = self::PascalToSnake($structDocBook->name);
            $prefix = self::RemoveSufix_t($prefix);
            if (0===strpos($functionDocBook->name, $prefix.'_')) {// str_start_with()
                $ThisName = $this->getThis($functionDocBook);
                if ($ThisName && $ThisName == $structDocBook->name) {
                    $method_name = substr($functionDocBook->name, strlen($prefix.'_'));
                    return $method_name;
                }
            }
        }
        
        return null;
    }
    /**
     * Find the struct than match with the function parameter according with the namespace
     * g_set_error([GError] $err); match with the struct [GError]
     * 
     * Exception :
     * gtk_cairo_should_draw_window(cairo_t $cr); match with the struct [cairo_t] but not with the namespace
     * 
     *  @return StructDocBook|TypedefDocBook|null
     */
    public function getObjectOfStaticFunction(FunctionDocBook $functionDocBook) {
        /** @var RefEntryDocBook $refEntryDocBook */
        $refEntryDocBook = $functionDocBook->parent;

        /** @var ParameterDocBook $parameterDocBook */
        $parameterDocBook = $functionDocBook->getParameterAt(0);
        if ($parameterDocBook) {
            $typeDocBook = $parameterDocBook->getType();
            $structs = $refEntryDocBook->structs();
            $typedefs = $refEntryDocBook->typedefs();
            if (array_key_exists($typeDocBook->getName(), $structs)) {
                return $structs[$typeDocBook->getName()];
            }
            if (array_key_exists($typeDocBook->getName(), $typedefs)) {
                return $typedefs[$typeDocBook->getName()];
            }
            //throw new Exception("Type ".$typeDocBook->getName()." of first parameter do not exist in refEntry ".$refEntryDocBook->id);
        }

        return null;
    }

    
    public function getNamespaceOfFunction(FunctionDocBook $functionDocBook) {
        $parts = explode('_', $functionDocBook->name);
        $namespace = array_shift($parts);
        if (count($parts)>1) {
            $sub_namespace = array_shift($parts);
        }
        $method_name = implode('_', $parts);
        return $method_name;
    }

    /**
     * Find the struct than match with the function name
     * [g_error_]matches(); match with the type [GError]
     * 
     *  @return StructDocBook|TypedefDocBook|null
     */
    public function getObjectOfFunction(FunctionDocBook $functionDocBook/*, StructDocBook $structDocBook*/) {
        $object_name = null;
        if (array_key_exists($functionDocBook->name, self::$map_function)) {
            $object_name = self::$map_function[$functionDocBook->name];
        }
        
        /** @var RefEntryDocBook $refEntryDocBook */
        $refEntryDocBook = $functionDocBook->parent;
        /** @var SetDocBook $root; */
        $root = $refEntryDocBook->getRoot();
        $structs = $root->getStructs($root);// function refer to an other RefEntry
        foreach ($structs as $name=>$struct) {
            if ($object_name) {
                if ($object_name==$name) {
                    return $struct;
                }
                continue;// function is mapped, search struct...
            }

            // Cairo exception
            if (0===strpos(strrev($name), 't_')) {
                $prefix = substr($name, 0, -2);
            } else {
                $prefix = self::PascalToSnake($name);
            }
            if ('gs_list'==$prefix) { $prefix = 'g_slist';}
            if ('gio_channel'==$prefix) { $prefix = 'g_io_channel';}
            
            // Exceptions
            if (0===strpos($functionDocBook->name, $prefix.'_')) {
                    return $struct;
            }
        }
        $typedefs = $root->getTypedefs($root);
        foreach ($typedefs as $name=>$typedef) {
            if ($object_name) {
                if ($object_name==$name) {
                    return $typedef;
                }
                continue;// function is mapped, search struct...
            }
            
            // Cairo exception
            if (0===strpos(strrev($name), 't_')) {
                $prefix = substr($name, 0, -2);
            } else {
                $prefix = self::PascalToSnake($name);
            }
            /*if ('GTestSuite'==$name && $functionDocBook->name=='g_test_run_suite') {

                throw new Exception("".$prefix);
            }*/

            if (0===strpos($functionDocBook->name, $prefix.'_')) {
                return $typedef;
            }
        }

        $unions = $root->getUnions($root);
        foreach ($unions as $name=>$union) {
            if ($object_name) {
                if ($object_name==$name) {
                    return $union;
                }
                continue;// function is mapped, search struct...
            }

            // Cairo exception
            if (0===strpos(strrev($name), 't_')) {
                $prefix = substr($name, 0, -2);
            } else {
                $prefix = self::PascalToSnake($name);
            }
            if (0===strpos($functionDocBook->name, $prefix.'_')) {
                return $union;
            }
        }

        return null;
    }

    /**
     * Check if function name match with struct name
     * then check if parameter is struct
     */
    public function isFunctionOfObject(FunctionDocBook $functionDocBook, AbstractDocBook $objectDocBook):bool {
        /** @var StructDocBook $structDocBook */
        $structDocBook = $objectDocBook;
        $prefix = self::PascalToSnake($structDocBook->name);
        if (0===strpos($functionDocBook->name, $prefix.'_')) {// str_start_with()
            $ThisName = $this->getThis($functionDocBook);
            if ($ThisName == $structDocBook->name) {
                return true;
            }
        }

        return false;
    }

    public function isMethod(FunctionDocBook $functionDocBook): bool {
        $structDocBook = $this->getObjectOfFunction($functionDocBook);
        if ($structDocBook) {
            if($this->isFunctionOfObject($functionDocBook, $structDocBook)){
                return true;
            }
        }
        
        return false;
    }
    public function isStatic(FunctionDocBook $functionDocBook): bool {
        $structDocBook = $this->getObjectOfFunction($functionDocBook);
        if ($structDocBook) {
            $thisName = $this->getThis($functionDocBook);
            if($thisName!=$structDocBook->name){
                return true;// The 1st parameter is not context
            }
        }
        return false;
    }

    // allocator
    public function isMMNew(FunctionDocBook $functionDocBook): bool {
        $function_name = $functionDocBook->name;
        $name_function = strrev($function_name);

        $pos = strpos($functionDocBook->name, '_new');
        if (false!==$pos) {
            if (0===strpos($name_function, strrev('_new'))) {
                // gtk_button_new();
                return true;
            }
            if (false!==strpos($functionDocBook->name, '_new_')) {
                // g_tree_new_full();
                return true;
            }
            /*
            if (0===strpos($name_function, strrev('_new_full'))) {
                // g_tree_new_full();
                return true;
            }

            if (false!==strpos($functionDocBook->name, '_new_with_')) {
                // gtk_button_new_with_icon_name();
                return true;
            }
            if (false!==strpos($functionDocBook->name, '_new_from_')) {
                // gtk_button_new_from_stock();
                return true;
            }
            */
        }

        if (0===strpos($name_function, strrev('_alloc'))) {
            // g_list_alloc();
            return true;
        }

        if (0===strpos($name_function, strrev('_create'))) {
            // gtk_button_new_from_stock();
            return true;
        }

        return false;
    }
    public function isMMCopy(FunctionDocBook $functionDocBook): bool {
        $function_name = $functionDocBook->name;
        $name_function = strrev($function_name);
        
        $pos = strpos($name_function, strrev('_copy'));
        if (0===$pos) {
            return true;
        }
        $pos = strpos($functionDocBook->name, '_copy_');
        if (false!==$pos) {
            return true;
        }

        return false;
    }


    // referentor
    public function isMMRef(FunctionDocBook $functionDocBook): bool {
        $function_name = $functionDocBook->name;
        $name_function = strrev($function_name);

        if (0===strpos($name_function, strrev('_reference'))) {
            return true;
        }
        if (0===strpos($name_function, strrev('_get_reference_count'))) {
            return true;
        }

        return false;
    }
    public function isMMFree(FunctionDocBook $functionDocBook): bool {
        $function_name = $functionDocBook->name;
        $name_function = strrev($function_name);

        $pos = strpos($functionDocBook->name, '_free');
        if (false!==$pos) {
            if (0===strpos($name_function, strrev('_free'))) {
                // g_list_free();
                return true;
            }
            if (0===strpos($name_function, strrev('_free_full'))) {
                // g_list_free();
                return true;
            }
            if (0===strpos($name_function, strrev('_free_1'))) {
                // g_list_free_1();
                return true;
            }
        }

        if (0===strpos($name_function, strrev('_destroy'))) {
            return true;
        }

        $pos = strpos($functionDocBook->name, '_clear_');
        if (false!==$pos) {
            return true;
        }
        
        return false;
    }
    
    public function isMemoryManagement(FunctionDocBook $functionDocBook): bool {
        if ($this->isMMNew($functionDocBook)) {
            return true;
        }
        if ($this->isMMCopy($functionDocBook)) {
            return true;
        }
        if ($this->isMMRef($functionDocBook)) {
            return true;
        }
        if ($this->isMMFree($functionDocBook)) {
            return true;
        }
        
        return false;
    }

    public function isErrorManagement(FunctionDocBook $functionDocBook): bool {

        $function_name = $functionDocBook->name;

        $name_function = strrev($function_name);
        if (0===strpos($name_function, strrev('_status'))) {// str_end_with()
            return true;
        }

        return false;
    }
    
    public function isUserData(FunctionDocBook $functionDocBook): bool {

        $function_name = $functionDocBook->name;

        $name_function = strrev($function_name);
        if (0===strpos($name_function, strrev('_user_data'))) {// str_end_with()
            return true;
        }
        
        return false;
    }

    public function isGetterSetter(FunctionDocBook $functionDocBook): bool {

        $function_name = $functionDocBook->name;

        if (false!==strpos($function_name, '_set_')) {// str_end_with()
            return true;
        }
        if (false!==strpos($function_name, '_get_')) {
            return true;
        }
        
        return false;
    }

    /**
     * TODO: REMOVE it
     */
    public function getMatserObjectByFile(GroupGenerator $fileGenerator) {
        $id = $fileGenerator->refentry_id;

        if ($id=='cairo-Paths') {
            return 'cairo_path_t';
        }
        
        $suffix = substr($id, -2);
        if ($suffix=='-t') {
            $struct_name = substr($id, 6);
            $struct_name = str_replace('-', '_', $struct_name);
            return $struct_name;
        }
        return null;

        // exception => Regions, Transformations, text, Raster-Sources, Tags-and-Links
        //              FreeType-Fonts, Win32-Fonts, Quartz-(CGFont)-Fonts, User-Fonts
        //              Image-Surfaces, 
        $map = array(
            /* Drawing */
            'cairo-cairo-t'               => 'cairo_t',
            'cairo-Paths'                 => 'cairo_path_t',
            'cairo-cairo-pattern-t'       => 'cairo_pattern_t',
            'cairo-Regions'               => 'cairo_region_t',
            'cairo-Transformations'       => null,// function only
            'cairo-text'                  => 'cairo_glyph_t',
            'cairo-Raster-Sources'        => null,
            'cairo-Tags-and-Links'        => null,

            /* Fonts */
            'cairo-cairo-font-face-t'     => 'cairo_font_face_t',
            'cairo-cairo-scaled-font-t'   => 'cairo_scaled_font_t',
            'cairo-cairo-font-options-t'  => 'cairo_font_options_t',
            'cairo-FreeType-Fonts'        => null,//'FT_Face',
            'cairo-Win32-Fonts'           => null,//'HFONT|LOGFONTW',
            'cairo-Quartz-(CGFont)-Fonts' => null,//'CGFontRef|ATSUFontID',
            'cairo-User-Fonts'            => null,

            /* Surfaces */
            'cairo-cairo-device-t'        => 'cairo_device_t',
            'cairo-cairo-surface-t'       => 'cairo_surface_t',
            'cairo-Image-Surfaces'        => null,
            'cairo-PDF-Surfaces'          => null,
            'cairo-PNG-Support'           => null,
            'cairo-PostScript-Surfaces'   => null,
            'cairo-Recording-Surfaces'    => null,
            'cairo-Win32-Surfaces'        => null,
            'cairo-SVG-Surfaces'          => null,
            'cairo-Quartz-Surfaces'       => null,
            'cairo-XCB-Surfaces'          => null,
            'cairo-XLib-Surfaces'         => null,
            'cairo-XLib-XRender-Backend'  => null,
            'cairo-Script-Surfaces'       => null,

            /* Utilities */
            'cairo-cairo-matrix-t'        => 'cairo_matrix_t',
            'cairo-Error-handling'        => 'cairo_status_t',
            'cairo-Version-Information'   => null,
            'cairo-Types'                 => 'cairo_bool_t',//cairo_rectangle_int_t
        );

        return '';
    }

}
