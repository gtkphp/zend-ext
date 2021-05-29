<?php

namespace Zend\ExtGtk\Cairo;

use Zend\ExtGtk\Implementation;


class Path extends Implementation {

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

    // -------------------------------------------------------------------
    // Zend Handler
    // -------------------------------------------------------------------
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

    // -------------------------------------------------------------------
    // PHP FUNCTION
    // -------------------------------------------------------------------
    function cairo_path_destroy() {
        $output = '';
        $output  = '    cairo_path_destroy(path);'.PHP_EOL;
        //$output .= '    php_path->ptr = NULL;'.PHP_EOL;
        return $output;
    }

    // -------------------------------------------------------------------
    // Zend-Utils
    // -------------------------------------------------------------------
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

                switch (type) {
                case CAIRO_PATH_MOVE_TO:
                    cairo_move_to(cr, points[0][0], points[0][1]);
                    break;
                case CAIRO_PATH_LINE_TO:
                    cairo_line_to(cr, points[0][0], points[0][1]);
                    break;
                case CAIRO_PATH_CLOSE_PATH:
                    cairo_close_path(cr);
                    break;
                case CAIRO_PATH_CURVE_TO:
                    if (count==3) {
                        cairo_curve_to(cr, points[0][0], points[0][1], points[1][0], points[1][1], points[2][0], points[2][1]);
                    }
                    break;
                default:
                    break;
                }

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
