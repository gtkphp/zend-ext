<?php

namespace Zend\ExtGtk;

use Zend\ExtGtk\Implementation;

use Zend\Ext\Models\MethodGenerator;
use Zend\Ext\Models\TypeGenerator;

class Cairo {

    public $default;
    public $cairo_t;
    public $cairo_path_t;
    public $cairo_path_data_t;
    public $cairo_surface_t;
    public $cairo_matrix_t;

    public function __construct()
    {
        $this->default = new Implementation();

        $this->cairo_t = new CairoCairo();
        $this->cairo_path_t = new CairoPath();
        $this->cairo_path_data_t = new CairoPathData();
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
    function cairo_append_path() {
        $output  = '    cairo_append_path(cr, path);'.PHP_EOL;
        $output .= '    cairo_path_destroy(path);'.PHP_EOL;
        return $output;
    }

    function cairo_copy_path() {
        $output  = '    cairo_path_t *ret = cairo_copy_path(cr);'.PHP_EOL;
        $output .= '    php_cairo_path_t *php_ret = php_cairo_path_t_new(ret);'.PHP_EOL;
        $output .= '    zend_object *z_ret = &php_ret->std;'.PHP_EOL;
        $output .= '    cairo_path_destroy(ret);'.PHP_EOL;

        return $output;
    }

    function cairo_copy_path_flat() {
        $output  = '    cairo_path_t *ret = cairo_copy_path_flat(cr);'.PHP_EOL;
        $output .= '    php_cairo_path_t *php_ret = php_cairo_path_t_new(ret);'.PHP_EOL;
        $output .= '    zend_object *z_ret = &php_ret->std;'.PHP_EOL;
        $output .= '    cairo_path_destroy(ret);'.PHP_EOL;

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

    public function macro_copy_set($declaration=false) {
?>

#define PHP_CAIRO_PATH_T_COPY(intern, dest) \
    dest = PHP_CAIRO_PATH_T_PTR(intern);

#define PHP_CAIRO_PATH_T_SET(dest, src)


<?php
        return '';
    }
        
    function zend_update_property($name) {
        $output  = '';
        switch($name) {
            case 'num_data':
                $output .= '            ';
                $output .= 'php_cairo_path_t_update_num_data(intern);'.PHP_EOL;
                break;
        }

        return $output;
    }
    function zend_extends_setter_php_cairo_path_data_t()
    {
        $output  = '';
        
        $output .= '    if(IS_ARRAY==Z_TYPE_P(value)) {'.PHP_EOL;
        $output .= '        Z_DELREF_P(dest);'.PHP_EOL;
        $output .= '        if (dest->value.arr->gc.refcount==0) {'.PHP_EOL;
        $output .= '            zend_hash_destroy(dest->value.arr);'.PHP_EOL;
        $output .= '            FREE_HASHTABLE(dest->value.arr);'.PHP_EOL;
        $output .= '        }'.PHP_EOL;
        $output .= '    }'.PHP_EOL;

        return $output;
    }

    function cairo_path_destroy() {
        $output = '';
        $output  = '    cairo_path_destroy(path);'.PHP_EOL;
        //$output .= '    php_path->ptr = NULL;'.PHP_EOL;
        return $output;
    }

    public function php_cairo_path_t_new($declaration=false) {
        $output  = 'php_cairo_path_t*'.PHP_EOL;
        $output .= 'php_cairo_path_t_new(cairo_path_t *path)';
        
        if ($declaration)
            return $output . ';'.PHP_EOL;


        echo $output;
?>
{

    zend_object *zpath = php_cairo_path_t_create_object(php_cairo_path_t_class_entry);
    php_cairo_path_t *intern = ZOBJ_TO_PHP_CAIRO_PATH_T(zpath);

    zend_array *zarray = intern->data.value.arr;

    zval zheader;
    zval zpoint;
    php_cairo_path_data_t *intern_data;

    int i, j;
    cairo_path_data_t *data = path->data;
    for (i=0; i < path->num_data; i += path->data[i].header.length) {
        intern_data = php_cairo_path_data_t_new();

        php_cairo_path_data_t_create_header(intern_data, &path->data[i]);
        ZVAL_OBJ(&zheader, &intern_data->std);
        zend_hash_next_index_insert(zarray, &zheader);

        for(j=1; j<path->data[i].header.length; j++) {
            intern_data = php_cairo_path_data_t_new();
            php_cairo_path_data_t_create_point(intern_data, &path->data[i+j]);
            ZVAL_OBJ(&zpoint, &intern_data->std);
            zend_hash_next_index_insert(zarray, &zpoint);
        }

    }
    ZVAL_ARR(&intern->data, zarray);
    ZVAL_LONG(&intern->num_data, path->num_data);
    ZVAL_LONG(&intern->status, path->status);

    return intern;
}

<?php
    }

    public function php_cairo_path_t_get_ptr($declaration=false) {
        $output  = 'cairo_path_t *'.PHP_EOL;
        $output .= 'php_cairo_path_t_get_ptr(php_cairo_path_t *php_path)';
        
        if ($declaration)
            return $output . ';'.PHP_EOL;


        echo $output;
?>
{
    cairo_path_t *path;

    cairo_surface_t *surface = cairo_image_surface_create (CAIRO_FORMAT_ARGB32, 250, 80);
    cairo_t *cr = cairo_create (surface);

    zend_string *member_header_str = zend_string_init("header", sizeof("header")-1, 0);
    zend_string *member_point_str = zend_string_init("point", sizeof("point")-1, 0);
    zend_string *member_x_str = zend_string_init("x", sizeof("x")-1, 0);
    zend_string *member_y_str = zend_string_init("y", sizeof("y")-1, 0);
    zend_string *member_type_str = zend_string_init("type", sizeof("type")-1, 0);
    zend_string *member_length_str = zend_string_init("length", sizeof("length")-1, 0);

    zval member_point; ZVAL_STR(&member_point, member_point_str);
    zval member_header; ZVAL_STR(&member_header, member_header_str);
    zval member_x; ZVAL_STR(&member_x, member_x_str);
    zval member_y; ZVAL_STR(&member_y, member_y_str);
    zval member_type; ZVAL_STR(&member_type, member_type_str);
    zval member_length; ZVAL_STR(&member_length, member_length_str);

    void *cache_slot = NULL;
    zend_object_handlers *std_hnd = zend_get_std_object_handlers();
    zval *ztype;
    zval *zlength;
    zval *zx;
    zval *zy;
    zval rv;
    zval *value;
    zval *data = &php_path->data;

    cairo_path_data_type_t type;
    int length;
    int count;
    double points[3][2];
    //g_print("php_cairo_path_t_get_path: %d\n", data->value.arr->nNumOfElements);
    ZEND_HASH_FOREACH_VAL(Z_ARRVAL_P(data), value) {
        //g_print("  value: %d\n", Z_TYPE_P(value));

        if  (ZVAL_IS_PHP_CAIRO_PATH_DATA_T(value)) {
            php_cairo_path_data_t *path_data = ZVAL_GET_PHP_CAIRO_PATH_DATA_T(value);
            // isset header|point
            //zval *ret = std_hnd->read_property(value, &member_point, IS_OBJECT, &cache_slot, &rv);
            if (path_data->union_type==1/*PHP_CAIRO_PATH_DATA_T_HEADER*/) {
                zval *zheader = &path_data->header;
                ztype = std_hnd->read_property(zheader, &member_type, IS_LONG, NULL, NULL);
                zlength = std_hnd->read_property(zheader, &member_length, IS_LONG, NULL, NULL);
                type = ztype->value.lval;
                length = zlength->value.lval;
                count = 0;
            } else {
                zval *zpoint;
                zpoint = &path_data->point;
                zx = std_hnd->read_property(zpoint, &member_x, IS_DOUBLE, NULL, NULL);
                zy = std_hnd->read_property(zpoint, &member_y, IS_DOUBLE, NULL, NULL);
                points[0+count][0] = zx->value.dval;
                points[0+count][1] = zy->value.dval;
                count++;
            }
            switch (type) {
            case CAIRO_PATH_MOVE_TO:
                if (count==1) cairo_move_to(cr, points[0][0], points[0][1]);
                break;
            case CAIRO_PATH_LINE_TO:
                if (count==1) cairo_line_to(cr, points[0][0], points[0][1]);
                break;
            case CAIRO_PATH_CLOSE_PATH:
                if (count==0) cairo_close_path(cr);
                break;
            case CAIRO_PATH_CURVE_TO:
                if (count==3) cairo_curve_to(cr, points[0][0], points[0][1], points[1][0], points[1][1], points[2][0], points[2][1]);
                break;
            default:
                break;
            }
        } else {
            g_print("Unexpected zval, isn't cairo_path_data_t");
        }
    } ZEND_HASH_FOREACH_END();


    zend_string_release(member_header_str);
    zend_string_release(member_point_str);
    zend_string_release(member_x_str);
    zend_string_release(member_y_str);
    zend_string_release(member_type_str);
    zend_string_release(member_length_str);

    path = cairo_copy_path(cr);

    cairo_surface_destroy (surface);
    cairo_destroy (cr);

    return path;
}
<?php
    return '';
    }

    public function php_cairo_path_t_update_num_data($declaration=false) {
        $output  = 'void'.PHP_EOL;
        $output .= 'php_cairo_path_t_update_num_data(php_cairo_path_t *intern)';
        
        if ($declaration)
            return $output . ';'.PHP_EOL;

        echo $output;
?>
{
    if (IS_ARRAY==Z_TYPE(intern->data)) {
        ZVAL_SET_LONG(&intern->num_data, zend_array_count(intern->data.value.arr));
    } else if (IS_REFERENCE==Z_TYPE(intern->data)) {
        if (IS_ARRAY==Z_TYPE(intern->data.value.ref->val)) {
            ZVAL_SET_LONG(&intern->num_data, zend_array_count(intern->data.value.ref->val.value.arr));
        } else {
            g_print("Expecting array for data\n");
        }
    } else {
        g_print("Expecting array for data\n");
    }
}
<?php
        return '';
    }

}

class CairoPathData extends Implementation {
    // see CairoPath

    public function define_extern($declaration=false) {
        return 'extern zend_class_entry *zend_standard_class_def;'.PHP_EOL;
    }

    function php_cairo_path_data_t_create_header($declaration=false) {
        $output  = 'void'.PHP_EOL;
        $output .= 'php_cairo_path_data_t_create_header(php_cairo_path_data_t*intern, cairo_path_data_t *data)';
        
        if ($declaration)
            return $output . ';'.PHP_EOL;

        echo $output;
        ?>
{
    zval *rv = &intern->header;
    //zend_object *object = php_cairo_path_data_t_create_object(php_cairo_path_data_t_class_entry);
    //cairo_path_data_t *intern = ZOBJ_TO_PHP_CAIRO_PATH_DATA_T(object);
    zend_object *std_class;

    //intern->header
    intern->union_type = PHP_CAIRO_PATH_DATA_T_HEADER;


    zend_string *member_type_str = zend_string_init("type", sizeof("type")-1, 0);
    zend_string *member_length_str = zend_string_init("length", sizeof("length")-1, 0);
    zval member_type; ZVAL_STR(&member_type, member_type_str);
    zval member_length; ZVAL_STR(&member_length, member_length_str);

    zval ztype; ZVAL_LONG(&ztype, data->header.type);
    zval zlength; ZVAL_LONG(&zlength, data->header.length);


    std_class = zend_objects_new(zend_standard_class_def);
    ZVAL_OBJ(rv, std_class);

    zend_std_write_property(rv, &member_type, &ztype, NULL);
    zend_std_write_property(rv, &member_length, &zlength, NULL);

    zend_string_delref(member_type_str);
    zend_string_delref(member_length_str);

}

<?php
        return '';
    }

    function php_cairo_path_data_t_create_point($declaration=false) {
        $output  = 'void'.PHP_EOL;
        $output .= 'php_cairo_path_data_t_create_point(php_cairo_path_data_t *intern, cairo_path_data_t *data)';
        
        if ($declaration)
            return $output . ';'.PHP_EOL;


        echo $output;
        ?>
{
    zend_object *std_class;
    zval *rv = &intern->point;
    intern->union_type = PHP_CAIRO_PATH_DATA_T_POINT;

    zend_string *member_x_str = zend_string_init("x", sizeof("x")-1, 0);
    zend_string *member_y_str = zend_string_init("y", sizeof("y")-1, 0);
    zval member_x; ZVAL_STR(&member_x, member_x_str);
    zval member_y; ZVAL_STR(&member_y, member_y_str);

    zval zx; ZVAL_DOUBLE(&zx, data->point.x);
    zval zy; ZVAL_DOUBLE(&zy, data->point.y);


    std_class = zend_objects_new(zend_standard_class_def);
    ZVAL_OBJ(rv, std_class);


    zend_std_write_property(rv, &member_x, &zx, NULL);
    zend_std_write_property(rv, &member_y, &zy, NULL);

    zend_string_delref(member_x_str);
    zend_string_delref(member_y_str);
}

<?php
        return '';
    }

    
    function php_cairo_path_data_t_new($declaration=false) {
        $output  = 'php_cairo_path_data_t *'.PHP_EOL;
        $output .= 'php_cairo_path_data_t_new()';
        
        if ($declaration)
            return $output . ';'.PHP_EOL;


        echo $output;
        ?>
{
    zend_object *object = php_cairo_path_data_t_create_object(php_cairo_path_data_t_class_entry);
    php_cairo_path_data_t *path_data = ZOBJ_TO_PHP_CAIRO_PATH_DATA_T(object);
    return path_data;

}

<?php
        return '';
    }

    public function zend_extends_setter_anonymous_0()
    {
        $output  = '';

        $output .= '    switch (intern->union_type) {'.PHP_EOL;
        $output .= '        case PHP_CAIRO_PATH_DATA_T_HEADER:'.PHP_EOL;
        $output .= '            zval_delref_p(&intern->header);'.PHP_EOL;
        $output .= '            break;'.PHP_EOL;
        $output .= '        case PHP_CAIRO_PATH_DATA_T_POINT:'.PHP_EOL;
        $output .= '            zval_delref_p(&intern->point);'.PHP_EOL;
        $output .= '            break;'.PHP_EOL;
        $output .= '    }'.PHP_EOL;

        return $output;
    }
    public function zend_extends_setter_anonymous_1()
    {
        return $this->zend_extends_setter_anonymous_0();
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
        //$output .= '    matrix->ptr = emalloc(sizeof(cairo_matrix_t));'.PHP_EOL;
        $output .= '    return matrix;'.PHP_EOL;
        $output .= '}'.PHP_EOL;
        return $output;
    }

    public function macro_copy_set($declaration=false) {
?>

#define PHP_CAIRO_MATRIX_T_COPY(src, dest) \
    ZVAL_GET_DOUBLE(&src->xx, (dest)->xx) \
    ZVAL_GET_DOUBLE(&src->yx, (dest)->yx) \
    ZVAL_GET_DOUBLE(&src->xy, (dest)->xy) \
    ZVAL_GET_DOUBLE(&src->yy, (dest)->yy) \
    ZVAL_GET_DOUBLE(&src->x0, (dest)->x0) \
    ZVAL_GET_DOUBLE(&src->y0, (dest)->y0)

#define PHP_CAIRO_MATRIX_T_SET(dest, src) \
    ZVAL_SET_DOUBLE(&(dest)->xx, (src)->xx) \
    ZVAL_SET_DOUBLE(&(dest)->yx, (src)->yx) \
    ZVAL_SET_DOUBLE(&(dest)->xy, (src)->xy) \
    ZVAL_SET_DOUBLE(&(dest)->yy, (src)->yy) \
    ZVAL_SET_DOUBLE(&(dest)->x0, (src)->x0) \
    ZVAL_SET_DOUBLE(&(dest)->y0, (src)->y0)


<?php
        return '';
    }

    function cairo_matrix_init() {
        $output  = '';
        $output .= '    cairo_matrix_init(matrix, xx, yx, xy, yy, x0, y0);'.PHP_EOL;
        $output .= '    PHP_CAIRO_MATRIX_T_SET(php_matrix, matrix);'.PHP_EOL;
    
        return $output;
    }

    function cairo_matrix_init_identity() {
        $output  = '';
        $output .= '    cairo_matrix_init_identity(matrix);'.PHP_EOL;
        $output .= '    PHP_CAIRO_MATRIX_T_SET(php_matrix, matrix);'.PHP_EOL;
    
        return $output;
    }

    function cairo_matrix_init_translate() {
        $output  = '';
        $output .= '    cairo_matrix_init_translate(matrix, tx, ty);'.PHP_EOL;
        $output .= '    PHP_CAIRO_MATRIX_T_SET(php_matrix, matrix);'.PHP_EOL;
    
        return $output;
    }

    function cairo_matrix_init_scale() {
        $output  = '';
        $output .= '    cairo_matrix_init_scale(matrix, sx, sy);'.PHP_EOL;
        $output .= '    PHP_CAIRO_MATRIX_T_SET(php_matrix, matrix);'.PHP_EOL;
    
        return $output;
    }

    function cairo_matrix_init_rotate() {
        $output  = '';
        $output .= '    cairo_matrix_init_rotate(matrix, radians);'.PHP_EOL;
        $output .= '    PHP_CAIRO_MATRIX_T_SET(php_matrix, matrix);'.PHP_EOL;
    
        return $output;
    }
    
    function cairo_matrix_translate() {
        $output  = '';
        $output .= '    cairo_matrix_translate(matrix, tx, ty);'.PHP_EOL;
        $output .= '    PHP_CAIRO_MATRIX_T_SET(php_matrix, matrix);'.PHP_EOL;
    
        return $output;
    }

    function cairo_matrix_scale() {
        $output  = '';
        $output .= '    cairo_matrix_scale(matrix, sx, sy);'.PHP_EOL;
        $output .= '    PHP_CAIRO_MATRIX_T_SET(php_matrix, matrix);'.PHP_EOL;
    
        return $output;
    }

    function cairo_matrix_rotate() {
        $output  = '';
        $output .= '    cairo_matrix_rotate(matrix, radians);'.PHP_EOL;
        $output .= '    PHP_CAIRO_MATRIX_T_SET(php_matrix, matrix);'.PHP_EOL;
    
        return $output;
    }

    function cairo_matrix_invert() {
        $output  = '';
        $output .= '    cairo_status_t ret = cairo_matrix_invert(matrix);'.PHP_EOL;
        $output .= '    PHP_CAIRO_MATRIX_T_SET(php_matrix, matrix);'.PHP_EOL;
    
        return $output;
    }

    function cairo_matrix_multiply() {
        $output  = '';
        $output .= '    cairo_matrix_multiply(result, a, b);'.PHP_EOL;
        $output .= '    PHP_CAIRO_MATRIX_T_SET(php_result, result);'.PHP_EOL;
    
        return $output;
    }

    function cairo_matrix_transform_distance() {
        $output  = '';
        $output .= '    cairo_matrix_transform_distance(matrix, &dx, &dy);'.PHP_EOL;
        $output .= '    ZVAL_DOUBLE(zdx, dx);'.PHP_EOL;
        $output .= '    ZVAL_DOUBLE(zdy, dy);'.PHP_EOL;

        return $output;
    }

    function cairo_matrix_transform_point() {
        $output  = '';
        $output .= '    cairo_matrix_transform_point(matrix, &x, &y);'.PHP_EOL;
        $output .= '    ZVAL_DOUBLE(zx, x);'.PHP_EOL;
        $output .= '    ZVAL_DOUBLE(zy, y);'.PHP_EOL;

        return $output;
    }
    
    

    
}
