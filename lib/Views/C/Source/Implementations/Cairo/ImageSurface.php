<?php

namespace Zend\Ext\Views\C\Source\Implementations\Cairo;


class ImageSurface {
    public $require = [
        'php_g_list_insert_sorted_real',
    ];
    public $handler = [
        'php_g_list_unset_dimension',
        'php_g_list_write_dimension',
        'php_g_list_read_dimension',
        'php_g_list_has_dimension',
        'php_g_list_count_elements',
        'php_g_list_cast_object',
        'php_g_list_get_properties',
        'php_g_list_get_debug_info',
        'php_g_list_unset_property',
        'php_g_list_write_property',
        'php_g_list_read_property',
        'php_g_list_free_object',
        'php_g_list_dtor_object',
        'php_g_list_create_object',
    ];

    function php_g_list_first($list='php_g_list*') {
        return <<<EOC
    if (list) {
        while(list->prev) {
            list = list->prev;
        }
    }

    return list;
EOC;
    }
    function php_g_list_last($list='php_g_list*') {
        return <<<EOC
    php_g_list *last;

    if (list==NULL) {
        return NULL;
    }

    while(list) {
        last = list;
        list = list->next;
    }

    return last;
EOC;
    }
    function php_g_list_nth($list='php_g_list*', $n='zend_long') {
        return <<<EOC
    while ((n-- > 0) && list)
        list = list->next;
    
    return list;
EOC;
    }

    function php_g_list_length($list='php_g_list*') {
        return <<<EOC
    zend_long length = 0;

    while(list) {
        length++;
        list = list->next;
    }

    return length;
EOC;
    }
    function php_g_list_append($list='php_g_list*', $data="zval *") {
        return <<<EOC
    php_g_list *last = NULL;

    zend_object *new_std = php_g_list_create_object(php_g_list_class_entry);
    php_g_list *new_list = ZOBJ_TO_PHP_G_LIST(new_std);
    ZVAL_COPY(&new_list->data, data);

    if (list) {
        last = php_g_list_last(list);
        last->next = new_list;
        new_list->prev = last;
        GC_REFCOUNT(&last->std)++;

        return list;
    }

    return new_list;
EOC;
    }

    function php_g_list_prepend($list='php_g_list*', $data="zval *") {
        return <<<EOC
    zend_object *new_std = php_g_list_create_object(php_g_list_class_entry);// Ref: 1
    php_g_list *new_list = ZOBJ_TO_PHP_G_LIST(new_std);
    ZVAL_COPY(&new_list->data, data);

    if (list) {
        new_list->next = list;
        GC_REFCOUNT(&list->std)++;

        new_list->prev = list->prev;
        if (list->prev) {
            list->prev->next = new_list;
        }
        list->prev = new_list;
    }

    return new_list;
EOC;
    }

    function php_g_list_insert($list='php_g_list*', $data='zval *', $position='zend_long') {
        return <<<EOC
    php_g_list *tmp_list = NULL;
    php_g_list *new_list = NULL;

    if (position < 0)
      return php_g_list_append (list, data);
    else if (position == 0)
      return php_g_list_prepend (list, data);

    tmp_list = php_g_list_nth (list, position);
    if (!tmp_list)
      return php_g_list_append (list, data);

    zend_object *new_std = php_g_list_create_object(php_g_list_class_entry);
    new_list = ZOBJ_TO_PHP_G_LIST(new_std);
    ZVAL_COPY(&new_list->data, data);

    new_list->prev = tmp_list->prev;
    tmp_list->prev->next = new_list;
    new_list->next = tmp_list;
    tmp_list->prev = new_list;

    return list;
EOC;
    }

    function php_g_list_insert_sorted($list='php_g_list*', $data='zval *', $func='zval *') {
        return <<<EOC
    zval user_data; ZVAL_NULL(&user_data);
    return php_g_list_insert_sorted_real(list, data, func, &user_data);
EOC;
    }

    function php_g_list_insert_sorted_with_data($list='php_g_list*', $data='zval *', $func='zval *', $user_data='zval *') {
        return <<<EOC
    return php_g_list_insert_sorted_real (list, data, func, user_data);
EOC;
    }

    function php_g_list_insert_sorted_real() {
        return <<<EOC
static php_g_list*
php_g_list_insert_sorted_real(php_g_list *list, zval *data, zval *func, zval *user_data) {

    php_g_list *tmp_list = list;
    php_g_list *new_list;
    zend_object *tmp;
    zend_long cmp = 0;

    int result;
    int param_count = 3;
    zval retval;
    zval params[3];

    if (ZVAL_IS_NULL(func)) {
        return list;
    }

    if (!list)
      {
        tmp = php_g_list_create_object(php_g_list_class_entry);
        new_list = ZOBJ_TO_PHP_G_LIST(tmp);
        ZVAL_COPY(&new_list->data, data);
        return new_list;
      }

    ZVAL_COPY(&params[0], data);
    ZVAL_COPY(&params[1], &tmp_list->data);
    ZVAL_COPY(&params[2], user_data);

    result = call_user_function(NULL, NULL, func, &retval, param_count, params);
    if (result==FAILURE) {
        php_printf("Unexpected 222 : php_g_hash_table_hash_func\n");
    } else if (Z_TYPE(retval)==IS_LONG) {
        cmp = retval.value.lval;
    } else {
        php_printf("Unexpected 223 : php_g_hash_table_hash_func\n");
    }

    while ((tmp_list->next) && (cmp > 0))
      {
        tmp_list = tmp_list->next;

        ZVAL_COPY(&params[0], data);
        ZVAL_COPY(&params[1], &tmp_list->data);
        ZVAL_COPY(&params[2], user_data);

        result = call_user_function(NULL, NULL, func, &retval, param_count, params);
        cmp = retval.value.lval;

      }

    tmp = php_g_list_create_object(php_g_list_class_entry);
    new_list = ZOBJ_TO_PHP_G_LIST(tmp);
    ZVAL_COPY(&new_list->data, data);

    if ((!tmp_list->next) && (cmp > 0))
      {
        tmp_list->next = new_list;
        new_list->prev = tmp_list;
        GC_REFCOUNT(&tmp_list->std)++;
        return list;
      }
    if (tmp_list->prev)
      {
        //GC_REFCOUNT(&tmp_list->prev->std)++;
        tmp_list->prev->next = new_list;
        new_list->prev = tmp_list->prev;
      }
    new_list->next = tmp_list;
    tmp_list->prev = new_list;

    if (tmp_list == list) {
        GC_REFCOUNT(&tmp_list->std)++;
        return new_list;
    } else {
        GC_REFCOUNT(&new_list->std)++;
        return list;
    }
}
EOC;
    }

    function php_g_list_create_object() {
        return <<<EOC
/* {{{ php_g_list_create_object */
static zend_object*
php_g_list_create_object(zend_class_entry *class_type)
{
    php_sample_node *intern = ecalloc(1, sizeof(php_sample_node) + zend_object_properties_size(class_type));

    zend_object_std_init(&intern->std, class_type);
    object_properties_init(&intern->std, class_type);

    //php_sample_node_properties_init(intern);
    ZVAL_NULL(&intern->data);
    intern->child = NULL;
    intern->parent = NULL;

    intern->ptr = malloc(sizeof(char)*2);
    intern->ptr[0] = 'a';
    intern->ptr[1] = '\0';

    intern->std.handlers = &php_sample_node_handlers;

    TRACE("php_sample_node_create_object(%p) / %d\n", &intern->std, intern->std.gc.refcount);
    return &intern->std;
}
/* }}} php_sample_node_create_object */
EOC;
    }

    function php_g_list_dtor_object() {
        return <<<EOC
static void
php_sample_node_dtor_object(zend_object *obj) {
    php_sample_node *intern = ZOBJ_TO_PHP_SAMPLE_NODE(obj);
    TRACE("php_sample_node_dtor_object(\e[1;31m\"%s\"\e[0;m) / %d\n", intern->data.value.str->val, obj->gc.refcount);


    if (intern->child) {
        zend_object_release(&intern->child->std);
        intern->child=NULL;
    }

    if (intern->parent!=NULL) {
        zend_object_release(&intern->parent->std);
        intern->parent=NULL;
    }
}
EOC;
    }

    function php_g_list_free_object() {
        return <<<EOC
/* {{{ php_sample_node_free_object */
static void
php_sample_node_free_object(zend_object *object)
{
    php_sample_node *intern = ZOBJ_TO_PHP_SAMPLE_NODE(object);
    TRACE("php_sample_node_free_object(\e[1;31m\"%s\"\e[0;m) / %d\n", intern->data.value.str->val, object->gc.refcount);

    free(intern->ptr);
    if (intern->properties!=NULL) {
        zend_hash_destroy(intern->properties);
        efree(intern->properties);
        intern->properties=NULL;
    }

    zend_object_std_dtor(&intern->std);
    //efree(intern);
}
/* }}} php_sample_node_free_object */
EOC;
    }

    function php_g_list_read_property() {
        return <<<EOC
/* {{{ gtk_read_property */
static zval*
php_sample_node_read_property(zval *object, zval *member, int type, void **cache_slot, zval *rv)
{
    php_sample_node *obj = ZVAL_GET_PHP_SAMPLE_NODE(object);
    zend_string *member_str = zval_get_string(member);
    zval *retval;
    php_printf("%s(%s)\n", __FUNCTION__, member->value.str->val);

    zend_object_handlers *std_hnd = zend_get_std_object_handlers();
    retval = std_hnd->read_property(object, member, type, cache_slot, rv);

    zend_string_release(member_str);
    return retval;
}
/* }}} */
EOC;
    }

    function php_g_list_write_property() {
        return <<<EOC
/* {{{ php_sample_node_write_property */
static void
php_sample_node_write_property(zval *object, zval *member, zval *value, void **cache_slot)
{
    php_sample_node *obj = ZVAL_GET_PHP_SAMPLE_NODE(object);
    zend_string *member_str = zval_get_string(member);
    php_printf("%s(%s)\n", __FUNCTION__, member->value.str->val);

    if (zend_string_equals_literal(member->value.str, "child")
     || zend_string_equals_literal(member->value.str, "parent") ) {
#if 0
        if (ZVAL_IS_PHP_SAMPLE_NODE(value)) {
            // do unset(object->child) and php_sample_node_insert(object, value, 0);
        } else {
            zend_string *type = zend_zval_get_type(value);
            zend_error(E_USER_WARNING, "Cannot assign %s to property Node::\$next of type Node", type->val);
        }
#else
        zend_error(E_USER_WARNING, "Readonly property Node::$%s", member->value.str->val);
#endif
        return;
    }
    zend_object_handlers *std_hnd = zend_get_std_object_handlers();
    std_hnd->write_property(object, member, value, cache_slot);

    zend_string_release(member_str);
}
/* }}} */
EOC;
    }

    function php_g_list_unset_property() {
        return <<<EOC
static void
php_sample_node_unset_property(zval *object, zval *member, void **cache_slot) {
    php_sample_node *obj = ZVAL_GET_PHP_SAMPLE_NODE(object);
    zend_string *member_str = zval_get_string(member);
    php_printf("%s(%s)\n", __FUNCTION__, member->value.str->val);

    if (zend_string_equals_literal(member->value.str, "child")
     || zend_string_equals_literal(member->value.str, "parent")
     || zend_string_equals_literal(member->value.str, "data") ) {
#if 0
        if (ZVAL_IS_PHP_SAMPLE_NODE(value)) {
            // do unset(object->child) and php_sample_node_insert(object, value, 0);
        } else {
            zend_string *type = zend_zval_get_type(value);
            zend_error(E_USER_WARNING, "Cannot assign %s to property Node::\$next of type Node", type->val);
        }
#else
        zend_error(E_USER_WARNING, "Readonly property Node::$%s", member->value.str->val);
#endif
        return;
    }
    zend_object_handlers *std_hnd = zend_get_std_object_handlers();
    std_hnd->unset_property(object, member, cache_slot);

    zend_string_release(member_str);
}
EOC;
    }

    function php_g_list_get_debug_info() {
        return <<<EOC
static HashTable*
php_sample_node_get_debug_info(zval *object, int *is_temp) /* {{{ */
{
    php_sample_node  *obj =  ZVAL_GET_PHP_SAMPLE_NODE(object);
    HashTable   *debug_info,
                *std_props;
    zend_string *string_key = NULL;
    zval *value;

    *is_temp = 1;
    std_props = zend_std_get_properties(object);
    debug_info = zend_array_dup(std_props);


    ZEND_HASH_FOREACH_STR_KEY_VAL(obj->std.properties, string_key, value) {
        zend_hash_add(debug_info, string_key, value);
    } ZEND_HASH_FOREACH_END();


    zval data; ZVAL_COPY(&data, &obj->data);
    zend_hash_str_update(debug_info, "data", 4, &data);

    zval child; ZVAL_SET_PHP_SAMPLE_NODE(&child, obj->child);
    zend_hash_str_update(debug_info, "child", 5, &child);

    zval parent; ZVAL_SET_PHP_SAMPLE_NODE(&parent, obj->parent);
    zend_hash_str_update(debug_info, "parent", 6, &parent);

    return debug_info;
}
/* }}} */
EOC;
    }

    function php_g_list_get_properties() {
        return <<<EOC
static HashTable*
php_sample_node_get_properties(zval *object){
    php_sample_node  *self =  ZVAL_GET_PHP_SAMPLE_NODE(object);
    HashTable *props = self->properties;
    if (props==NULL) {
        ALLOC_HASHTABLE(self->properties);
        props = self->properties;
    } else {
        // TODO: rebuild the props( update)
        return props;// Else leaks : zend_hash_next_index_insert
    }

    zend_long length = php_sample_node_length(self);

    zend_hash_init(props, length, NULL, ZVAL_PTR_DTOR, 1);

    zval data;

    php_sample_node *it;
    for(it=php_sample_node_first(self); it; it = it->child){
        ZVAL_COPY(&data, &it->data);
        zend_hash_next_index_insert(props, &data);
    }

    return props;
}
EOC;
    }

    function php_g_list_cast_object() {
        return <<<EOC
static int
php_sample_node_cast_object(zval *readobj, zval *retval, int type)
{
    ZVAL_NULL(retval);

    return FAILURE;
}
EOC;
    }

    function php_g_list_count_elements() {
        return <<<EOC
/* updates *count to hold the number of elements present and returns SUCCESS.
 * Returns FAILURE if the object does not have any sense of overloaded dimensions */
static int
php_sample_node_count_elements(zval *object, zend_long *count) {

    *count = php_sample_node_length(ZVAL_GET_PHP_SAMPLE_NODE(object));

    return SUCCESS;
}
EOC;
    }

    function php_g_list_has_dimension() {
        return <<<EOC
static int
php_sample_node_has_dimension(zval *object, zval *member, int check_empty) {
    //return FAILURE;
    return SUCCESS;
}
EOC;
    }

    function php_g_list_read_dimension() {
        return <<<EOC
static zval*
php_sample_node_read_dimension(zval *object, zval *offset, int type, zval *rv) /* {{{ */
{
    if (!offset) {
        return NULL;
    }

    php_sample_node *intern = ZVAL_GET_PHP_SAMPLE_NODE(object);
    php_sample_node *list;
    void *cache=NULL;

    if (Z_TYPE_P(offset)==IS_LONG) {
        list = php_sample_node_nth(intern, offset->value.lval);
        if (list) {
            ZVAL_COPY(rv, &list->data);
        } else {
            ZVAL_NULL(rv);
            zend_error(E_USER_WARNING, "Undefined offset: %d", offset->value.lval);
        }
        return rv;
    } else if (Z_TYPE_P(offset)==IS_STRING) {
        return php_sample_node_read_property(object, offset, type, &cache, rv);
    } else {
        // error
    }

    return rv;
} /* }}} end php_g_hash_table_read_dimension */
EOC;
    }

    function php_g_list_write_dimension() {
        return <<<EOC
static void
php_sample_node_write_dimension(zval *object, zval *offset, zval *value)
{
    void *cache = NULL;
    zval member;
    ZVAL_COPY(&member, offset);
    php_sample_node_write_property(object, &member, value, &cache);
}
EOC;
    }

    function php_g_list_unset_dimension() {
        return <<<EOC
static void
php_sample_node_unset_dimension(zval *object, zval *offset) {
    //php_g_list *list = ZVAL_GET_PHP_G_LIST(object);
    void *cache;

    switch(Z_TYPE_P(offset)) {
    case IS_LONG:
        // @TODO
        //zend_hash_index_del(list->prop_handler, );
        // php_g_list
        break;
    case IS_STRING:
        php_sample_node_unset_property(object, offset, &cache);
        break;
    default:
        break;
    }
}
EOC;
    }

}