<?php

namespace Zend\ExtGtk;

use Zend\ExtGtk\Cairo as CairoImplementation;
use Zend\ExtGtk\Gdk as GdkImplementation;

/**
 * All function than start by 'php_' will be write in code generated
 * All function with same name as Gtk... will override excecute in code generated
 */
class Implementation {
    static $version = '7';// version of php

    // Control override of struct _zend_object_handlers
    public $enable_clone = false;
    public $enable_property = false;
    public $enable_dimension = false;

    public $enable_count = false;
    public $enable_cast = false;
    public $enable_compare = false;
    public $enable_debug = true;

    //public $visibility___construct = false;
    //public $disable___construct = false;

    public $param = 'zval *object';
    public $get_param = 'ZVAL_GET_PHP_';
    /*public $zend_object_new = 'ecalloc(1, sizeof(php_<?php echo $name_function ?>) + zend_object_properties_size(class_type));';*/

    public function __construct() {
        if (Implementation::$version=='8') {
            $this->param = 'zend_object *object';
            $this->get_param = 'ZOBJ_TO_PHP_';
            /*$this->zend_object_new = 'zend_object_new(php_<?php echo $name_function ?>);';*/
        }
    }

    /*
    struct _zend_object_handlers {
        // offset of real object header (usually zero)
        int										offset;
        // general object functions
        zend_object_free_obj_t					free_obj;
        zend_object_dtor_obj_t					dtor_obj;
        zend_object_clone_obj_t					clone_obj;
        // individual object functions
        zend_object_read_property_t				read_property;
        zend_object_write_property_t			write_property;
        zend_object_read_dimension_t			read_dimension;
        zend_object_write_dimension_t			write_dimension;
        zend_object_get_property_ptr_ptr_t		get_property_ptr_ptr;
        zend_object_get_t						get;
        zend_object_set_t						set;
        zend_object_has_property_t				has_property;
        zend_object_unset_property_t			unset_property;
        zend_object_has_dimension_t				has_dimension;
        zend_object_unset_dimension_t			unset_dimension;
        zend_object_get_properties_t			get_properties;
        zend_object_get_method_t				get_method;
        zend_object_call_method_t				call_method;
        zend_object_get_constructor_t			get_constructor;
        zend_object_get_class_name_t			get_class_name;
        zend_object_compare_t					compare_objects;
        zend_object_cast_t						cast_object;
        zend_object_count_elements_t			count_elements;
        zend_object_get_debug_info_t			get_debug_info;
        zend_object_get_closure_t				get_closure;
        zend_object_get_gc_t					get_gc;
        zend_object_do_operation_t				do_operation;
        zend_object_compare_zvals_t				compare;
    };
    */

    static public function Factory($name) {
        static $called=[];
        switch ($name) {
            case 'cairo':
            case 'Cairo':
                return new CairoImplementation();
                break;
            case 'gdk':
            case 'Gdk':
                return new GdkImplementation();
                break;
            default:
                if (empty($called[$name])) {
                    echo 'Unknown "' . $name . '" implementation override.' . PHP_EOL;
                    $called[$name]=true;
                }
                return new EmptyImplementation();
                break;
        }
    }

    // ajoute toute les fonctions commençant par 'php_' ( ex: php_cairo_new)
    public function writeFunctions(bool $declaration=false) {
        $output = '';
        $methods = get_class_methods ($this);
        foreach ($methods as $method) {
            if ('php_'==substr($method, 0, 4)) {
                $output .= $this->$method($declaration);
            }
        }
        return $output;
    }
    // remplace l'appel d'un fonction
    public function writeDefine(bool $declaration=false) {
        $output = '';
        $methods = get_class_methods ($this);
        foreach ($methods as $method) {
            if ('define_'==substr($method, 0, 7)) {
                $output .= $this->$method($declaration);
            }
        }
        return $output;
    }

    // remplace une fonction( ex: get_debug_info)
    public function zend_override($name) {
        $output = '';
        $methods = get_class_methods ($this);
        $method_name = 'zend_override_'.$name;
        foreach ($methods as $method) {
            if ($method==$method_name) {
                $output .= $this->$method_name();
            }
        }
        return $output;
    }

    // ajoute du code dans une fonction( ex: get_debug_info)
    public function zend_extends($name) {
        $output = '';
        $methods = get_class_methods ($this);
        $method_name = 'zend_extends_'.$name;
        foreach ($methods as $method) {
            if ($method==$method_name) {
                $output .= $this->$method_name();
            }
        }
        return $output;
    }
    
    
}

class EmptyImplementation {
    public function get(string $name)
    {
        return new Implementation();
    }
}