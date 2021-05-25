<?php

namespace Zend\ExtGtk;

use Zend\ExtGtk\Implementation;

use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;

class Cairo {

    public $default;
    public $cairo_t;
    public $cairo_path_t;
    public $cairo_surface_t;
    public $cairo_matrix_t;

    public function __construct()
    {
        $this->default = new Implementation();

        $this->cairo_t = new CairoCairo();
        $this->cairo_path_t = new CairoPath();
        $this->cairo_surface_t = new CairoSurface();
        $this->cairo_matrix_t = new CairoMatrix();
    }

    // use trait ImplementationGet
    public function get(string $name)
    {
        if(isset($this->$name)) {
            return $this->$name;
        } else {
            return $this->default;
        }
    }
}

class CairoCairo extends Implementation{

    function cairo_destroy() {
        $output  = '    cairo_destroy(cr);'.PHP_EOL;
        $output .= '    php_cr->ptr = NULL;'.PHP_EOL;
        return $output;
    }

    function zend_extends_free_object() {
        $output  = '';
        $output .= '        cairo_destroy(intern->ptr);'.PHP_EOL;
        return $output;
    }

    //function zend_override_get_debug_info();
    function zend_override_get_debug_info() {
        $output  = '';

        $output .= '/** {{{ php_cairo_t_get_debug_info() */'.PHP_EOL;
        $output .= 'static HashTable*'.PHP_EOL;
        $output .= 'php_cairo_t_get_debug_info('.$this->param.', int *is_temp)'.PHP_EOL;
        $output .= '{'.PHP_EOL;
        $output .= '    php_cairo_t  *obj = '.$this->get_param.'CAIRO_T(object);'.PHP_EOL;
        $output .= '    HashTable   *debug_info,'.PHP_EOL;
        $output .= '    *std_props;'.PHP_EOL;
        $output .= '    zend_string *string_key = NULL;'.PHP_EOL;
        $output .= '    zval *value;'.PHP_EOL;
        $output .= PHP_EOL;
        
        $output .= '    *is_temp = 1;'.PHP_EOL;
        $output .= '    std_props = zend_std_get_properties(object);'.PHP_EOL;
        $output .= '    debug_info = zend_array_dup(std_props);'.PHP_EOL;
        $output .= PHP_EOL;
        
        $output .= $this->zend_extends_get_debug_info();
        $output .= PHP_EOL;
        
        $output .= '    return debug_info;'.PHP_EOL;
        $output .= '}'.PHP_EOL;
        $output .= '/* }}} */'.PHP_EOL;

        return $output;
    }

    //function zend_extends_get_debug_info();
    function zend_extends_get_debug_info() {
        $output  = '';
        $output .= '    zval zstatus; ZVAL_LONG(&zstatus, cairo_status(obj->ptr));'.PHP_EOL;
        $output .= '    zend_hash_str_update(debug_info, "status", sizeof("status")-1, &zstatus);'.PHP_EOL;
        return $output;
    }

    // add convenience function( get all methode and strstr('php_'))
    // TODO : in Implementation create function foo($name) foreach($this->name->methodes as $function)
    function php_cairo_new($declaration=false) {
        $output  = 'php_cairo_t *'.PHP_EOL;
        $output .= 'php_cairo_new()';
        
        if ($declaration)
            return $output . ';';
        
        $output .= ' {'.PHP_EOL;
        $output .= '    zend_object *zobj = php_cairo_t_create_object(php_cairo_t_class_entry);'.PHP_EOL;
        $output .= '    return ZOBJ_TO_PHP_CAIRO_T(zobj);'.PHP_EOL;
        $output .= '}'.PHP_EOL;
        return $output;
    }
}

class CairoPath extends Implementation {
    // method avec des parametre en deref ?
    
    function cairo_path_destroy() {
        $output  = '    cairo_path_destroy(path);'.PHP_EOL;
        $output .= '    php_path->ptr = NULL;'.PHP_EOL;
        return $output;
    }
    
    function php_cairo_path_data_t_create_header($declaration=false) {
        $output  = 'void'.PHP_EOL;
        $output .= 'php_cairo_path_data_t_create_header(cairo_path_data_t *data, zval *rv)';
        
        if ($declaration)
            return $output . ';'.PHP_EOL;

        echo $output;
        ?>
{
        zend_object *zobj = php_cairo_path_data_t_create_object(php_cairo_path_data_t_class_entry);
        php_cairo_path_data_t *t = ZOBJ_TO_PHP_CAIRO_PATH_DATA_T(zobj);
        t->ptr = data;// adpte ref
        t->is_header = 1;
    
        ZVAL_OBJ(rv, zobj);
}

<?php
        return '';
    }

    function php_cairo_path_data_t_create_point($declaration=false) {
        $output  = 'void'.PHP_EOL;
        $output .= 'php_cairo_path_data_t_create_point(cairo_path_data_t *data, zval *rv)';
        
        if ($declaration)
            return $output . ';'.PHP_EOL;


        echo $output;
        ?>
{
        zend_object *zobj = php_cairo_path_data_t_create_object(php_cairo_path_data_t_class_entry);
        php_cairo_path_data_t *t = ZOBJ_TO_PHP_CAIRO_PATH_DATA_T(zobj);
        t->ptr = data;// adpte ref
        t->is_header = 0;
    
        ZVAL_OBJ(rv, zobj);
}

<?php
        return '';
    }

    
    function php_cairo_path_data_new($declaration=false) {
        $output  = 'php_cairo_path_data_t *'.PHP_EOL;
        $output .= 'php_cairo_path_data_t_new(cairo_path_t *path)';
        
        if ($declaration)
            return $output . ';'.PHP_EOL;


        echo $output;
        ?>
{
        zend_array *zarray; ALLOC_HASHTABLE(zarray);
        zend_hash_init(zarray, 1, NULL, ZVAL_PTR_DTOR, 1);

        zval member_point; ZVAL_STRING(&member_point, "point");
        zval member_header; ZVAL_STRING(&member_header, "header");
        zval zheader;
        zval zpoint;
        zend_object *std_class;
        zval val;
        int i, j;
        cairo_path_data_t *data = path->data;
        for (i=0; i < path->num_data; i += path->data[i].header.length) {

            php_cairo_path_data_t_create_header(&path->data[i], &zheader);

            std_class = zend_objects_new(zend_standard_class_def);
            ZVAL_OBJ(&val, std_class);
            zend_std_write_property(&val, &member_header, &zheader, cache_slot);


            zend_hash_next_index_insert(zarray, &val);
            Z_TRY_DELREF(zheader);

            for(j=1; j<path->data[i].header.length; j++) {
                php_cairo_path_data_t_create_point(&path->data[i+j], &zpoint);

                std_class = zend_objects_new(zend_standard_class_def);
                ZVAL_OBJ(&val, std_class);
                zend_std_write_property(&val, &member_point, &zpoint, cache_slot);

                zend_hash_next_index_insert(zarray, &val);
                Z_TRY_DELREF(zpoint);
            }
        }


        ZVAL_ARR(rv, zarray);

        Z_TRY_DELREF(member_point);
        Z_TRY_DELREF(member_header);

        zend_string_release(member_str);
        return rv;
}

<?php
        return '';
    }
}

class CairoSurface extends Implementation {
    function cairo_surface_destroy() {
        $output  = '    cairo_surface_destroy(surface);'.PHP_EOL;
        $output .= '    php_surface->ptr = NULL;'.PHP_EOL;
        return $output;
    }
}

class CairoMatrix extends Implementation {
    function php_cairo_matrix_new($declaration=false) {
        $output  = 'php_cairo_matrix_t *'.PHP_EOL;
        $output .= 'php_cairo_matrix_t_new()';
        
        if ($declaration)
            return $output . ';';
        
        $output .= ' {'.PHP_EOL;
        $output .= '    zend_object *zobj = php_cairo_matrix_t_create_object(php_cairo_matrix_t_class_entry);'.PHP_EOL;
        $output .= '    php_cairo_matrix_t *matrix = ZOBJ_TO_PHP_CAIRO_MATRIX_T(zobj);'.PHP_EOL;
        $output .= '    matrix->ptr = emalloc(sizeof(cairo_matrix_t));'.PHP_EOL;
        $output .= '    return matrix;'.PHP_EOL;
        $output .= '}'.PHP_EOL;
        return $output;
    }
}
