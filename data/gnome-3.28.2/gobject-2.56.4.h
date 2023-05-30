#define G_VALUE_HOLDS_VARIANT(value)     (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_VARIANT))
#define G_VALUE_HOLDS_GTYPE(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_GTYPE))
#define	G_TYPE_GTYPE			 (g_gtype_get_type())
#define G_VALUE_HOLDS_POINTER(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_POINTER))
#define G_VALUE_HOLDS_STRING(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_STRING))
#define G_VALUE_HOLDS_DOUBLE(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_DOUBLE))
#define G_VALUE_HOLDS_FLOAT(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_FLOAT))
#define G_VALUE_HOLDS_UINT64(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_UINT64))
#define G_VALUE_HOLDS_INT64(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_INT64))
#define G_VALUE_HOLDS_ULONG(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_ULONG))
#define G_VALUE_HOLDS_LONG(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_LONG))
#define G_VALUE_HOLDS_UINT(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_UINT))
#define G_VALUE_HOLDS_INT(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_INT))
#define G_VALUE_HOLDS_BOOLEAN(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_BOOLEAN))
#define G_VALUE_HOLDS_UCHAR(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_UCHAR))
#define G_VALUE_HOLDS_CHAR(value)	 (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_CHAR))
#define	G_VALUE_COLLECT_FORMAT_MAX_LENGTH	(8)
#define G_VALUE_LCOPY(value, var_args, flags, __error)					\
G_STMT_START {										\
  const GValue *_value = (value);							\
  guint _flags = (flags);								\
  GType _value_type = G_VALUE_TYPE (_value);						\
  GTypeValueTable *_vtable = g_type_value_table_peek (_value_type);			\
  const gchar *_lcopy_format = _vtable->lcopy_format;					\
  GTypeCValue _cvalues[G_VALUE_COLLECT_FORMAT_MAX_LENGTH] = { { 0, }, };		\
  guint _n_values = 0;									\
                                                                                        \
  while (*_lcopy_format)								\
    {											\
      GTypeCValue *_cvalue = _cvalues + _n_values++;					\
                                                                                        \
      switch (*_lcopy_format++)								\
	{										\
	case G_VALUE_COLLECT_INT:							\
	  _cvalue->v_int = va_arg ((var_args), gint);					\
	  break;									\
	case G_VALUE_COLLECT_LONG:							\
	  _cvalue->v_long = va_arg ((var_args), glong);					\
	  break;									\
	case G_VALUE_COLLECT_INT64:							\
	  _cvalue->v_int64 = va_arg ((var_args), gint64);				\
	  break;									\
	case G_VALUE_COLLECT_DOUBLE:							\
	  _cvalue->v_double = va_arg ((var_args), gdouble);				\
	  break;									\
	case G_VALUE_COLLECT_POINTER:							\
	  _cvalue->v_pointer = va_arg ((var_args), gpointer);				\
	  break;									\
	default:									\
	  g_assert_not_reached ();							\
	}										\
    }											\
  *(__error) = _vtable->lcopy_value (_value,						\
				     _n_values,						\
				     _cvalues,						\
				     _flags);						\
} G_STMT_END
#define G_VALUE_COLLECT_SKIP(_value_type, var_args)					\
G_STMT_START {										\
  GTypeValueTable *_vtable = g_type_value_table_peek (_value_type);			\
  const gchar *_collect_format = _vtable->collect_format;				\
                                                                                        \
  while (*_collect_format)								\
    {											\
      switch (*_collect_format++)							\
	{										\
	case G_VALUE_COLLECT_INT:							\
	  va_arg ((var_args), gint);							\
	  break;									\
	case G_VALUE_COLLECT_LONG:							\
	  va_arg ((var_args), glong);							\
	  break;									\
	case G_VALUE_COLLECT_INT64:							\
	  va_arg ((var_args), gint64);							\
	  break;									\
	case G_VALUE_COLLECT_DOUBLE:							\
	  va_arg ((var_args), gdouble);							\
	  break;									\
	case G_VALUE_COLLECT_POINTER:							\
	  va_arg ((var_args), gpointer);						\
	  break;									\
	default:									\
	  g_assert_not_reached ();							\
	}										\
    }											\
} G_STMT_END
#define G_VALUE_COLLECT(value, var_args, flags, __error) G_STMT_START {			\
  GValue *_value = (value);								\
  GType _value_type = G_VALUE_TYPE (_value);						\
  GTypeValueTable *_vtable = g_type_value_table_peek (_value_type);			\
											\
  if (_vtable->value_free)								\
    _vtable->value_free (_value);							\
  memset (_value->data, 0, sizeof (_value->data));					\
											\
  G_VALUE_COLLECT_INIT(value, _value_type, var_args, flags, __error);			\
} G_STMT_END
#define G_VALUE_COLLECT_INIT(value, _value_type, var_args, flags, __error)		\
G_STMT_START {										\
  GValue *_val = (value);								\
  guint _flags = (flags);								\
  GTypeValueTable *_vtab = g_type_value_table_peek (_value_type);			\
  const gchar *_collect_format = _vtab->collect_format;					\
  GTypeCValue _cvalues[G_VALUE_COLLECT_FORMAT_MAX_LENGTH] = { { 0, }, };		\
  guint _n_values = 0;									\
                                                                                        \
  _val->g_type = _value_type;		/* value_meminit() from gvalue.c */		\
  while (*_collect_format)								\
    {											\
      GTypeCValue *_cvalue = _cvalues + _n_values++;					\
                                                                                        \
      switch (*_collect_format++)							\
	{										\
	case G_VALUE_COLLECT_INT:							\
	  _cvalue->v_int = va_arg ((var_args), gint);					\
	  break;									\
	case G_VALUE_COLLECT_LONG:							\
	  _cvalue->v_long = va_arg ((var_args), glong);					\
	  break;									\
	case G_VALUE_COLLECT_INT64:							\
	  _cvalue->v_int64 = va_arg ((var_args), gint64);				\
	  break;									\
	case G_VALUE_COLLECT_DOUBLE:							\
	  _cvalue->v_double = va_arg ((var_args), gdouble);				\
	  break;									\
	case G_VALUE_COLLECT_POINTER:							\
	  _cvalue->v_pointer = va_arg ((var_args), gpointer);				\
	  break;									\
	default:									\
	  g_assert_not_reached ();							\
	}										\
    }											\
  *(__error) = _vtab->collect_value (_val,						\
				       _n_values,					\
				       _cvalues,					\
				       _flags);						\
} G_STMT_END
#define G_TYPE_VALUE_ARRAY (g_value_array_get_type ())
#define G_VALUE_INIT  { 0, { { 0 } } }
#define G_VALUE_NOCOPY_CONTENTS (1 << 27)
#define G_VALUE_HOLDS(value,type)	(G_TYPE_CHECK_VALUE_TYPE ((value), (type)))
#define	G_VALUE_TYPE_NAME(value)	(g_type_name (G_VALUE_TYPE (value)))
#define	G_VALUE_TYPE(value)		(((GValue*) (value))->g_type)
#define	G_IS_VALUE(value)		(G_TYPE_CHECK_VALUE (value))
#define	G_TYPE_IS_VALUE(type)		(g_type_check_is_value_type (type))
#define G_TYPE_PLUGIN_GET_CLASS(inst)	(G_TYPE_INSTANCE_GET_INTERFACE ((inst), G_TYPE_TYPE_PLUGIN, GTypePluginClass))
#define G_IS_TYPE_PLUGIN_CLASS(vtable)	(G_TYPE_CHECK_CLASS_TYPE ((vtable), G_TYPE_TYPE_PLUGIN))
#define G_IS_TYPE_PLUGIN(inst)		(G_TYPE_CHECK_INSTANCE_TYPE ((inst), G_TYPE_TYPE_PLUGIN))
#define G_TYPE_PLUGIN_CLASS(vtable)	(G_TYPE_CHECK_CLASS_CAST ((vtable), G_TYPE_TYPE_PLUGIN, GTypePluginClass))
#define G_TYPE_PLUGIN(inst)		(G_TYPE_CHECK_INSTANCE_CAST ((inst), G_TYPE_TYPE_PLUGIN, GTypePlugin))
#define G_TYPE_TYPE_PLUGIN		(g_type_plugin_get_type ())
#define G_ADD_PRIVATE_DYNAMIC(TypeName)         { \
  TypeName##_private_offset = sizeof (TypeName##Private); \
}
#define G_IMPLEMENT_INTERFACE_DYNAMIC(TYPE_IFACE, iface_init)       { \
  const GInterfaceInfo g_implement_interface_info = { \
    (GInterfaceInitFunc) iface_init, NULL, NULL      \
  }; \
  g_type_module_add_interface (type_module, g_define_type_id, TYPE_IFACE, &g_implement_interface_info); \
}
#define G_DEFINE_DYNAMIC_TYPE_EXTENDED(TypeName, type_name, TYPE_PARENT, flags, CODE) \
static void     type_name##_init              (TypeName        *self); \
static void     type_name##_class_init        (TypeName##Class *klass); \
static void     type_name##_class_finalize    (TypeName##Class *klass); \
static gpointer type_name##_parent_class = NULL; \
static GType    type_name##_type_id = 0; \
static gint     TypeName##_private_offset; \
\
_G_DEFINE_TYPE_EXTENDED_CLASS_INIT(TypeName, type_name) \
\
G_GNUC_UNUSED \
static inline gpointer \
type_name##_get_instance_private (TypeName *self) \
{ \
  return (G_STRUCT_MEMBER_P (self, TypeName##_private_offset)); \
} \
\
GType \
type_name##_get_type (void) \
{ \
  return type_name##_type_id; \
} \
static void \
type_name##_register_type (GTypeModule *type_module) \
{ \
  GType g_define_type_id G_GNUC_UNUSED; \
  const GTypeInfo g_define_type_info = { \
    sizeof (TypeName##Class), \
    (GBaseInitFunc) NULL, \
    (GBaseFinalizeFunc) NULL, \
    (GClassInitFunc) type_name##_class_intern_init, \
    (GClassFinalizeFunc) type_name##_class_finalize, \
    NULL,   /* class_data */ \
    sizeof (TypeName), \
    0,      /* n_preallocs */ \
    (GInstanceInitFunc) type_name##_init, \
    NULL    /* value_table */ \
  }; \
  type_name##_type_id = g_type_module_register_type (type_module, \
						     TYPE_PARENT, \
						     #TypeName, \
						     &g_define_type_info, \
						     (GTypeFlags) flags); \
  g_define_type_id = type_name##_type_id; \
  { CODE ; } \
}
#define G_DEFINE_DYNAMIC_TYPE(TN, t_n, T_P)          G_DEFINE_DYNAMIC_TYPE_EXTENDED (TN, t_n, T_P, 0, {})
#define G_TYPE_MODULE_GET_CLASS(module) (G_TYPE_INSTANCE_GET_CLASS ((module), G_TYPE_TYPE_MODULE, GTypeModuleClass))
#define G_IS_TYPE_MODULE_CLASS(class)   (G_TYPE_CHECK_CLASS_TYPE ((class), G_TYPE_TYPE_MODULE))
#define G_IS_TYPE_MODULE(module)        (G_TYPE_CHECK_INSTANCE_TYPE ((module), G_TYPE_TYPE_MODULE))
#define G_TYPE_MODULE_CLASS(class)      (G_TYPE_CHECK_CLASS_CAST ((class), G_TYPE_TYPE_MODULE, GTypeModuleClass))
#define G_TYPE_MODULE(module)           (G_TYPE_CHECK_INSTANCE_CAST ((module), G_TYPE_TYPE_MODULE, GTypeModule))
#define G_TYPE_TYPE_MODULE              (g_type_module_get_type ())
#define	G_TYPE_FLAG_RESERVED_ID_BIT	((GType) (1 << 0))
#define G_DEFINE_POINTER_TYPE_WITH_CODE(TypeName, type_name, _C_) _G_DEFINE_POINTER_TYPE_BEGIN (TypeName, type_name) {_C_;} _G_DEFINE_TYPE_EXTENDED_END()
#define G_DEFINE_POINTER_TYPE(TypeName, type_name) G_DEFINE_POINTER_TYPE_WITH_CODE (TypeName, type_name, {})
#define G_DEFINE_BOXED_TYPE_WITH_CODE(TypeName, type_name, copy_func, free_func, _C_) _G_DEFINE_BOXED_TYPE_BEGIN (TypeName, type_name, copy_func, free_func) {_C_;} _G_DEFINE_TYPE_EXTENDED_END()
#define G_DEFINE_BOXED_TYPE(TypeName, type_name, copy_func, free_func) G_DEFINE_BOXED_TYPE_WITH_CODE (TypeName, type_name, copy_func, free_func, {})
#define G_PRIVATE_FIELD(TypeName, inst, field_type, field_name) \
  G_STRUCT_MEMBER (field_type, inst, G_PRIVATE_OFFSET (TypeName, field_name))
#define G_PRIVATE_FIELD_P(TypeName, inst, field_name) \
  G_STRUCT_MEMBER_P (inst, G_PRIVATE_OFFSET (TypeName, field_name))
#define G_PRIVATE_OFFSET(TypeName, field) \
  (TypeName##_private_offset + (G_STRUCT_OFFSET (TypeName##Private, field)))
#define G_ADD_PRIVATE(TypeName) { \
  TypeName##_private_offset = \
    g_type_add_instance_private (g_define_type_id, sizeof (TypeName##Private)); \
}
#define G_IMPLEMENT_INTERFACE(TYPE_IFACE, iface_init)       { \
  const GInterfaceInfo g_implement_interface_info = { \
    (GInterfaceInitFunc)(void (*)(void)) iface_init, NULL, NULL \
  }; \
  g_type_add_interface_static (g_define_type_id, TYPE_IFACE, &g_implement_interface_info); \
}
#define G_DEFINE_INTERFACE_WITH_CODE(TN, t_n, T_P, _C_)     _G_DEFINE_INTERFACE_EXTENDED_BEGIN(TN, t_n, T_P) {_C_;} _G_DEFINE_INTERFACE_EXTENDED_END()
#define G_DEFINE_INTERFACE(TN, t_n, T_P)		    G_DEFINE_INTERFACE_WITH_CODE(TN, t_n, T_P, ;)
#define G_DEFINE_TYPE_EXTENDED(TN, t_n, T_P, _f_, _C_)	    _G_DEFINE_TYPE_EXTENDED_BEGIN (TN, t_n, T_P, _f_) {_C_;} _G_DEFINE_TYPE_EXTENDED_END()
#define G_DEFINE_ABSTRACT_TYPE_WITH_PRIVATE(TN, t_n, T_P)   G_DEFINE_TYPE_EXTENDED (TN, t_n, T_P, G_TYPE_FLAG_ABSTRACT, G_ADD_PRIVATE (TN))
#define G_DEFINE_ABSTRACT_TYPE_WITH_CODE(TN, t_n, T_P, _C_) _G_DEFINE_TYPE_EXTENDED_BEGIN (TN, t_n, T_P, G_TYPE_FLAG_ABSTRACT) {_C_;} _G_DEFINE_TYPE_EXTENDED_END()
#define G_DEFINE_ABSTRACT_TYPE(TN, t_n, T_P)		    G_DEFINE_TYPE_EXTENDED (TN, t_n, T_P, G_TYPE_FLAG_ABSTRACT, {})
#define G_DEFINE_TYPE_WITH_PRIVATE(TN, t_n, T_P)            G_DEFINE_TYPE_EXTENDED (TN, t_n, T_P, 0, G_ADD_PRIVATE (TN))
#define G_DEFINE_TYPE_WITH_CODE(TN, t_n, T_P, _C_)	    _G_DEFINE_TYPE_EXTENDED_BEGIN (TN, t_n, T_P, 0) {_C_;} _G_DEFINE_TYPE_EXTENDED_END()
#define G_DEFINE_TYPE(TN, t_n, T_P)			    G_DEFINE_TYPE_EXTENDED (TN, t_n, T_P, 0, {})
#define G_DECLARE_INTERFACE(ModuleObjName, module_obj_name, MODULE, OBJ_NAME, PrerequisiteName) \
  GType module_obj_name##_get_type (void);                                                                 \
  G_GNUC_BEGIN_IGNORE_DEPRECATIONS                                                                         \
  typedef struct _##ModuleObjName ModuleObjName;                                                           \
  typedef struct _##ModuleObjName##Interface ModuleObjName##Interface;                                     \
                                                                                                           \
  _GLIB_DEFINE_AUTOPTR_CHAINUP (ModuleObjName, PrerequisiteName)                                           \
                                                                                                           \
  static inline ModuleObjName * MODULE##_##OBJ_NAME (gpointer ptr) {                                       \
    return G_TYPE_CHECK_INSTANCE_CAST (ptr, module_obj_name##_get_type (), ModuleObjName); }               \
  static inline gboolean MODULE##_IS_##OBJ_NAME (gpointer ptr) {                                           \
    return G_TYPE_CHECK_INSTANCE_TYPE (ptr, module_obj_name##_get_type ()); }                              \
  static inline ModuleObjName##Interface * MODULE##_##OBJ_NAME##_GET_IFACE (gpointer ptr) {                \
    return G_TYPE_INSTANCE_GET_INTERFACE (ptr, module_obj_name##_get_type (), ModuleObjName##Interface); } \
  G_GNUC_END_IGNORE_DEPRECATIONS
#define G_DECLARE_DERIVABLE_TYPE(ModuleObjName, module_obj_name, MODULE, OBJ_NAME, ParentName) \
  GType module_obj_name##_get_type (void);                                                               \
  G_GNUC_BEGIN_IGNORE_DEPRECATIONS                                                                       \
  typedef struct _##ModuleObjName ModuleObjName;                                                         \
  typedef struct _##ModuleObjName##Class ModuleObjName##Class;                                           \
  struct _##ModuleObjName { ParentName parent_instance; };                                               \
                                                                                                         \
  _GLIB_DEFINE_AUTOPTR_CHAINUP (ModuleObjName, ParentName)                                               \
                                                                                                         \
  static inline ModuleObjName * MODULE##_##OBJ_NAME (gpointer ptr) {                                     \
    return G_TYPE_CHECK_INSTANCE_CAST (ptr, module_obj_name##_get_type (), ModuleObjName); }             \
  static inline ModuleObjName##Class * MODULE##_##OBJ_NAME##_CLASS (gpointer ptr) {                      \
    return G_TYPE_CHECK_CLASS_CAST (ptr, module_obj_name##_get_type (), ModuleObjName##Class); }         \
  static inline gboolean MODULE##_IS_##OBJ_NAME (gpointer ptr) {                                         \
    return G_TYPE_CHECK_INSTANCE_TYPE (ptr, module_obj_name##_get_type ()); }                            \
  static inline gboolean MODULE##_IS_##OBJ_NAME##_CLASS (gpointer ptr) {                                 \
    return G_TYPE_CHECK_CLASS_TYPE (ptr, module_obj_name##_get_type ()); }                               \
  static inline ModuleObjName##Class * MODULE##_##OBJ_NAME##_GET_CLASS (gpointer ptr) {                  \
    return G_TYPE_INSTANCE_GET_CLASS (ptr, module_obj_name##_get_type (), ModuleObjName##Class); }       \
  G_GNUC_END_IGNORE_DEPRECATIONS
#define G_DECLARE_FINAL_TYPE(ModuleObjName, module_obj_name, MODULE, OBJ_NAME, ParentName) \
  GType module_obj_name##_get_type (void);                                                               \
  G_GNUC_BEGIN_IGNORE_DEPRECATIONS                                                                       \
  typedef struct _##ModuleObjName ModuleObjName;                                                         \
  typedef struct { ParentName##Class parent_class; } ModuleObjName##Class;                               \
                                                                                                         \
  _GLIB_DEFINE_AUTOPTR_CHAINUP (ModuleObjName, ParentName)                                               \
                                                                                                         \
  static inline ModuleObjName * MODULE##_##OBJ_NAME (gpointer ptr) {                                     \
    return G_TYPE_CHECK_INSTANCE_CAST (ptr, module_obj_name##_get_type (), ModuleObjName); }             \
  static inline gboolean MODULE##_IS_##OBJ_NAME (gpointer ptr) {                                         \
    return G_TYPE_CHECK_INSTANCE_TYPE (ptr, module_obj_name##_get_type ()); }                            \
  G_GNUC_END_IGNORE_DEPRECATIONS
#define G_TYPE_CLASS_GET_PRIVATE(klass, g_type, c_type)   ((c_type*) g_type_class_get_private ((GTypeClass*) (klass), (g_type)))
#define G_TYPE_INSTANCE_GET_PRIVATE(instance, g_type, c_type)   ((c_type*) g_type_instance_get_private ((GTypeInstance*) (instance), (g_type)))
#define G_TYPE_FROM_INTERFACE(g_iface)                          (((GTypeInterface*) (g_iface))->g_type)
#define G_TYPE_FROM_CLASS(g_class)                              (((GTypeClass*) (g_class))->g_type)
#define G_TYPE_FROM_INSTANCE(instance)                          (G_TYPE_FROM_CLASS (((GTypeInstance*) (instance))->g_class))
#define G_TYPE_CHECK_VALUE_TYPE(value, g_type)			(_G_TYPE_CVH ((value), (g_type)))
#define G_TYPE_CHECK_VALUE(value)				(_G_TYPE_CHV ((value)))
#define G_TYPE_CHECK_CLASS_TYPE(g_class, g_type)                (_G_TYPE_CCT ((g_class), (g_type)))
#define G_TYPE_CHECK_CLASS_CAST(g_class, g_type, c_type)        (_G_TYPE_CCC ((g_class), (g_type), c_type))
#define G_TYPE_INSTANCE_GET_INTERFACE(instance, g_type, c_type) (_G_TYPE_IGI ((instance), (g_type), c_type))
#define G_TYPE_INSTANCE_GET_CLASS(instance, g_type, c_type)     (_G_TYPE_IGC ((instance), (g_type), c_type))
#define G_TYPE_CHECK_INSTANCE_FUNDAMENTAL_TYPE(instance, g_type)            (_G_TYPE_CIFT ((instance), (g_type)))
#define G_TYPE_CHECK_INSTANCE_TYPE(instance, g_type)            (_G_TYPE_CIT ((instance), (g_type)))
#define G_TYPE_CHECK_INSTANCE_CAST(instance, g_type, c_type)    (_G_TYPE_CIC ((instance), (g_type), c_type))
#define G_TYPE_CHECK_INSTANCE(instance)				(_G_TYPE_CHI ((GTypeInstance*) (instance)))
#define G_TYPE_HAS_VALUE_TABLE(type)            (g_type_value_table_peek (type) != NULL)
#define G_TYPE_IS_VALUE_TYPE(type)              (g_type_check_is_value_type (type))
#define G_TYPE_IS_VALUE_ABSTRACT(type)          (g_type_test_flags ((type), G_TYPE_FLAG_VALUE_ABSTRACT))
#define G_TYPE_IS_ABSTRACT(type)                (g_type_test_flags ((type), G_TYPE_FLAG_ABSTRACT))
#define G_TYPE_IS_DEEP_DERIVABLE(type)          (g_type_test_flags ((type), G_TYPE_FLAG_DEEP_DERIVABLE))
#define G_TYPE_IS_DERIVABLE(type)               (g_type_test_flags ((type), G_TYPE_FLAG_DERIVABLE))
#define G_TYPE_IS_INSTANTIATABLE(type)          (g_type_test_flags ((type), G_TYPE_FLAG_INSTANTIATABLE))
#define G_TYPE_IS_CLASSED(type)                 (g_type_test_flags ((type), G_TYPE_FLAG_CLASSED))
#define G_TYPE_IS_INTERFACE(type)               (G_TYPE_FUNDAMENTAL (type) == G_TYPE_INTERFACE)
#define G_TYPE_IS_DERIVED(type)                 ((type) > G_TYPE_FUNDAMENTAL_MAX)
#define G_TYPE_IS_FUNDAMENTAL(type)             ((type) <= G_TYPE_FUNDAMENTAL_MAX)
#define G_TYPE_RESERVED_USER_FIRST	(49)
#define G_TYPE_RESERVED_BSE_LAST	(48)
#define G_TYPE_RESERVED_BSE_FIRST	(32)
#define G_TYPE_RESERVED_GLIB_LAST	(31)
#define G_TYPE_RESERVED_GLIB_FIRST	(22)
#define	G_TYPE_MAKE_FUNDAMENTAL(x)	((GType) ((x) << G_TYPE_FUNDAMENTAL_SHIFT))
#define	G_TYPE_FUNDAMENTAL_SHIFT	(2)
#define	G_TYPE_VARIANT                  G_TYPE_MAKE_FUNDAMENTAL (21)
#define G_TYPE_OBJECT			G_TYPE_MAKE_FUNDAMENTAL (20)
#define G_TYPE_PARAM			G_TYPE_MAKE_FUNDAMENTAL (19)
#define G_TYPE_BOXED			G_TYPE_MAKE_FUNDAMENTAL (18)
#define G_TYPE_POINTER			G_TYPE_MAKE_FUNDAMENTAL (17)
#define G_TYPE_STRING			G_TYPE_MAKE_FUNDAMENTAL (16)
#define G_TYPE_DOUBLE			G_TYPE_MAKE_FUNDAMENTAL (15)
#define G_TYPE_FLOAT			G_TYPE_MAKE_FUNDAMENTAL (14)
#define G_TYPE_FLAGS			G_TYPE_MAKE_FUNDAMENTAL (13)
#define G_TYPE_ENUM			G_TYPE_MAKE_FUNDAMENTAL (12)
#define G_TYPE_UINT64			G_TYPE_MAKE_FUNDAMENTAL (11)
#define G_TYPE_INT64			G_TYPE_MAKE_FUNDAMENTAL (10)
#define G_TYPE_ULONG			G_TYPE_MAKE_FUNDAMENTAL (9)
#define G_TYPE_LONG			G_TYPE_MAKE_FUNDAMENTAL (8)
#define G_TYPE_UINT			G_TYPE_MAKE_FUNDAMENTAL (7)
#define G_TYPE_INT			G_TYPE_MAKE_FUNDAMENTAL (6)
#define G_TYPE_BOOLEAN			G_TYPE_MAKE_FUNDAMENTAL (5)
#define G_TYPE_UCHAR			G_TYPE_MAKE_FUNDAMENTAL (4)
#define G_TYPE_CHAR			G_TYPE_MAKE_FUNDAMENTAL (3)
#define G_TYPE_INTERFACE		G_TYPE_MAKE_FUNDAMENTAL (2)
#define G_TYPE_NONE			G_TYPE_MAKE_FUNDAMENTAL (1)
#define G_TYPE_INVALID			G_TYPE_MAKE_FUNDAMENTAL (0)
#define	G_TYPE_FUNDAMENTAL_MAX		(255 << G_TYPE_FUNDAMENTAL_SHIFT)
#define G_TYPE_FUNDAMENTAL(type)	(g_type_fundamental (type))
#define	g_signal_handlers_unblock_by_func(instance, func, data)							\
    g_signal_handlers_unblock_matched    ((instance),								\
				          (GSignalMatchType) (G_SIGNAL_MATCH_FUNC | G_SIGNAL_MATCH_DATA),	\
				          0, 0, NULL, (func), (data))
#define	g_signal_handlers_block_by_func(instance, func, data)							\
    g_signal_handlers_block_matched      ((instance),								\
				          (GSignalMatchType) (G_SIGNAL_MATCH_FUNC | G_SIGNAL_MATCH_DATA),	\
				          0, 0, NULL, (func), (data))
#define g_signal_handlers_disconnect_by_data(instance, data) \
  g_signal_handlers_disconnect_matched ((instance), G_SIGNAL_MATCH_DATA, 0, 0, NULL, NULL, (data))
#define	g_signal_handlers_disconnect_by_func(instance, func, data)						\
    g_signal_handlers_disconnect_matched ((instance),								\
					  (GSignalMatchType) (G_SIGNAL_MATCH_FUNC | G_SIGNAL_MATCH_DATA),	\
					  0, 0, NULL, (func), (data))
#define g_signal_connect_swapped(instance, detailed_signal, c_handler, data) \
    g_signal_connect_data ((instance), (detailed_signal), (c_handler), (data), NULL, G_CONNECT_SWAPPED)
#define g_signal_connect_after(instance, detailed_signal, c_handler, data) \
    g_signal_connect_data ((instance), (detailed_signal), (c_handler), (data), NULL, G_CONNECT_AFTER)
#define g_signal_connect(instance, detailed_signal, c_handler, data) \
    g_signal_connect_data ((instance), (detailed_signal), (c_handler), (data), NULL, (GConnectFlags) 0)
#define	G_SIGNAL_TYPE_STATIC_SCOPE (G_TYPE_FLAG_RESERVED_ID_BIT)
#define G_SIGNAL_MATCH_MASK  0x3f
#define G_SIGNAL_FLAGS_MASK  0x1ff
#      define GOBJECT_VAR extern
#define G_PARAM_SPEC_VARIANT(pspec)         (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_VARIANT, GParamSpecVariant))
#define G_IS_PARAM_SPEC_VARIANT(pspec)      (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_VARIANT))
#define G_TYPE_PARAM_VARIANT                (g_param_spec_types[22])
#define G_PARAM_SPEC_GTYPE(pspec)          (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_GTYPE, GParamSpecGType))
#define G_IS_PARAM_SPEC_GTYPE(pspec)       (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_GTYPE))
#define	G_TYPE_PARAM_GTYPE		   (g_param_spec_types[21])
#define G_PARAM_SPEC_OVERRIDE(pspec)       (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_OVERRIDE, GParamSpecOverride))
#define G_IS_PARAM_SPEC_OVERRIDE(pspec)    (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_OVERRIDE))
#define	G_TYPE_PARAM_OVERRIDE		   (g_param_spec_types[20])
#define G_PARAM_SPEC_OBJECT(pspec)         (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_OBJECT, GParamSpecObject))
#define G_IS_PARAM_SPEC_OBJECT(pspec)      (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_OBJECT))
#define	G_TYPE_PARAM_OBJECT		   (g_param_spec_types[19])
#define G_PARAM_SPEC_VALUE_ARRAY(pspec)    (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_VALUE_ARRAY, GParamSpecValueArray))
#define G_IS_PARAM_SPEC_VALUE_ARRAY(pspec) (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_VALUE_ARRAY))
#define	G_TYPE_PARAM_VALUE_ARRAY	   (g_param_spec_types[18])
#define G_PARAM_SPEC_POINTER(pspec)        (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_POINTER, GParamSpecPointer))
#define G_IS_PARAM_SPEC_POINTER(pspec)     (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_POINTER))
#define	G_TYPE_PARAM_POINTER		   (g_param_spec_types[17])
#define G_PARAM_SPEC_BOXED(pspec)          (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_BOXED, GParamSpecBoxed))
#define G_IS_PARAM_SPEC_BOXED(pspec)       (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_BOXED))
#define	G_TYPE_PARAM_BOXED		   (g_param_spec_types[16])
#define G_PARAM_SPEC_PARAM(pspec)          (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_PARAM, GParamSpecParam))
#define G_IS_PARAM_SPEC_PARAM(pspec)       (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_PARAM))
#define	G_TYPE_PARAM_PARAM		   (g_param_spec_types[15])
#define G_PARAM_SPEC_STRING(pspec)         (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_STRING, GParamSpecString))
#define G_IS_PARAM_SPEC_STRING(pspec)      (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_STRING))
#define	G_TYPE_PARAM_STRING		   (g_param_spec_types[14])
#define G_PARAM_SPEC_DOUBLE(pspec)         (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_DOUBLE, GParamSpecDouble))
#define G_IS_PARAM_SPEC_DOUBLE(pspec)      (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_DOUBLE))
#define	G_TYPE_PARAM_DOUBLE		   (g_param_spec_types[13])
#define G_PARAM_SPEC_FLOAT(pspec)          (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_FLOAT, GParamSpecFloat))
#define G_IS_PARAM_SPEC_FLOAT(pspec)       (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_FLOAT))
#define	G_TYPE_PARAM_FLOAT		   (g_param_spec_types[12])
#define G_PARAM_SPEC_FLAGS(pspec)          (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_FLAGS, GParamSpecFlags))
#define G_IS_PARAM_SPEC_FLAGS(pspec)       (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_FLAGS))
#define	G_TYPE_PARAM_FLAGS		   (g_param_spec_types[11])
#define G_PARAM_SPEC_ENUM(pspec)           (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_ENUM, GParamSpecEnum))
#define G_IS_PARAM_SPEC_ENUM(pspec)        (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_ENUM))
#define	G_TYPE_PARAM_ENUM		   (g_param_spec_types[10])
#define G_IS_PARAM_SPEC_UNICHAR(pspec)     (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_UNICHAR))
#define G_PARAM_SPEC_UNICHAR(pspec)        (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_UNICHAR, GParamSpecUnichar))
#define	G_TYPE_PARAM_UNICHAR		   (g_param_spec_types[9])
#define G_PARAM_SPEC_UINT64(pspec)         (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_UINT64, GParamSpecUInt64))
#define G_IS_PARAM_SPEC_UINT64(pspec)      (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_UINT64))
#define	G_TYPE_PARAM_UINT64		   (g_param_spec_types[8])
#define G_PARAM_SPEC_INT64(pspec)          (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_INT64, GParamSpecInt64))
#define G_IS_PARAM_SPEC_INT64(pspec)       (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_INT64))
#define	G_TYPE_PARAM_INT64		   (g_param_spec_types[7])
#define G_PARAM_SPEC_ULONG(pspec)          (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_ULONG, GParamSpecULong))
#define G_IS_PARAM_SPEC_ULONG(pspec)       (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_ULONG))
#define	G_TYPE_PARAM_ULONG		   (g_param_spec_types[6])
#define G_PARAM_SPEC_LONG(pspec)           (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_LONG, GParamSpecLong))
#define G_IS_PARAM_SPEC_LONG(pspec)        (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_LONG))
#define	G_TYPE_PARAM_LONG		   (g_param_spec_types[5])
#define G_PARAM_SPEC_UINT(pspec)           (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_UINT, GParamSpecUInt))
#define G_IS_PARAM_SPEC_UINT(pspec)        (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_UINT))
#define	G_TYPE_PARAM_UINT		   (g_param_spec_types[4])
#define G_PARAM_SPEC_INT(pspec)            (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_INT, GParamSpecInt))
#define G_IS_PARAM_SPEC_INT(pspec)         (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_INT))
#define	G_TYPE_PARAM_INT		   (g_param_spec_types[3])
#define G_PARAM_SPEC_BOOLEAN(pspec)        (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_BOOLEAN, GParamSpecBoolean))
#define G_IS_PARAM_SPEC_BOOLEAN(pspec)     (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_BOOLEAN))
#define	G_TYPE_PARAM_BOOLEAN		   (g_param_spec_types[2])
#define G_PARAM_SPEC_UCHAR(pspec)          (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_UCHAR, GParamSpecUChar))
#define G_IS_PARAM_SPEC_UCHAR(pspec)       (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_UCHAR))
#define	G_TYPE_PARAM_UCHAR		   (g_param_spec_types[1])
#define G_PARAM_SPEC_CHAR(pspec)           (G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM_CHAR, GParamSpecChar))
#define G_IS_PARAM_SPEC_CHAR(pspec)        (G_TYPE_CHECK_INSTANCE_TYPE ((pspec), G_TYPE_PARAM_CHAR))
#define	G_TYPE_PARAM_CHAR		   (g_param_spec_types[0])
#define	G_PARAM_USER_SHIFT	(8)
#define	G_PARAM_MASK		(0x000000ff)
#define	G_PARAM_STATIC_STRINGS (G_PARAM_STATIC_NAME | G_PARAM_STATIC_NICK | G_PARAM_STATIC_BLURB)
#define G_VALUE_HOLDS_PARAM(value)	(G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_PARAM))
#define	G_PARAM_SPEC_VALUE_TYPE(pspec)	(G_PARAM_SPEC (pspec)->value_type)
#define G_PARAM_SPEC_TYPE_NAME(pspec)	(g_type_name (G_PARAM_SPEC_TYPE (pspec)))
#define G_PARAM_SPEC_TYPE(pspec)	(G_TYPE_FROM_INSTANCE (pspec))
#define G_PARAM_SPEC_GET_CLASS(pspec)	(G_TYPE_INSTANCE_GET_CLASS ((pspec), G_TYPE_PARAM, GParamSpecClass))
#define G_IS_PARAM_SPEC_CLASS(pclass)   (G_TYPE_CHECK_CLASS_TYPE ((pclass), G_TYPE_PARAM))
#define G_PARAM_SPEC_CLASS(pclass)      (G_TYPE_CHECK_CLASS_CAST ((pclass), G_TYPE_PARAM, GParamSpecClass))
#define G_IS_PARAM_SPEC(pspec)		(G_TYPE_CHECK_INSTANCE_FUNDAMENTAL_TYPE ((pspec), G_TYPE_PARAM))
#define G_PARAM_SPEC(pspec)		(G_TYPE_CHECK_INSTANCE_CAST ((pspec), G_TYPE_PARAM, GParamSpec))
#define G_TYPE_IS_PARAM(type)		(G_TYPE_FUNDAMENTAL (type) == G_TYPE_PARAM)
#define g_set_weak_pointer(weak_pointer_location, new_object) \
 (/* Check types match. */ \
  0 ? *(weak_pointer_location) = (new_object), FALSE : \
  (g_set_weak_pointer) ((gpointer *) (weak_pointer_location), (GObject *) (new_object)) \
 )
#define g_clear_weak_pointer(weak_pointer_location) \
 (/* Check types match. */ \
  (g_clear_weak_pointer) ((gpointer *) (weak_pointer_location)) \
 )
#define g_set_object(object_ptr, new_object) \
 (/* Check types match. */ \
  0 ? *(object_ptr) = (new_object), FALSE : \
  (g_set_object) ((GObject **) (object_ptr), (GObject *) (new_object)) \
 )
#define G_OBJECT_WARN_INVALID_PROPERTY_ID(object, property_id, pspec) \
    G_OBJECT_WARN_INVALID_PSPEC ((object), "property", (property_id), (pspec))
#define G_OBJECT_WARN_INVALID_PSPEC(object, pname, property_id, pspec) \
G_STMT_START { \
  GObject *_glib__object = (GObject*) (object); \
  GParamSpec *_glib__pspec = (GParamSpec*) (pspec); \
  guint _glib__property_id = (property_id); \
  g_warning ("%s:%d: invalid %s id %u for \"%s\" of type '%s' in '%s'", \
             __FILE__, __LINE__, \
             (pname), \
             _glib__property_id, \
             _glib__pspec->name, \
             g_type_name (G_PARAM_SPEC_TYPE (_glib__pspec)), \
             G_OBJECT_TYPE_NAME (_glib__object)); \
} G_STMT_END
#define G_INITIALLY_UNOWNED_GET_CLASS(object) (G_TYPE_INSTANCE_GET_CLASS ((object), G_TYPE_INITIALLY_UNOWNED, GInitiallyUnownedClass))
#define G_IS_INITIALLY_UNOWNED_CLASS(class)   (G_TYPE_CHECK_CLASS_TYPE ((class), G_TYPE_INITIALLY_UNOWNED))
#define G_IS_INITIALLY_UNOWNED(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), G_TYPE_INITIALLY_UNOWNED))
#define G_INITIALLY_UNOWNED_CLASS(class)      (G_TYPE_CHECK_CLASS_CAST ((class), G_TYPE_INITIALLY_UNOWNED, GInitiallyUnownedClass))
#define G_INITIALLY_UNOWNED(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), G_TYPE_INITIALLY_UNOWNED, GInitiallyUnowned))
#define G_TYPE_INITIALLY_UNOWNED	      (g_initially_unowned_get_type())
#define G_VALUE_HOLDS_OBJECT(value) (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_OBJECT))
#define G_OBJECT_CLASS_NAME(class)  (g_type_name (G_OBJECT_CLASS_TYPE (class)))
#define G_OBJECT_CLASS_TYPE(class)  (G_TYPE_FROM_CLASS (class))
#define G_OBJECT_TYPE_NAME(object)  (g_type_name (G_OBJECT_TYPE (object)))
#define G_OBJECT_TYPE(object)       (G_TYPE_FROM_INSTANCE (object))
#define G_OBJECT_GET_CLASS(object)  (G_TYPE_INSTANCE_GET_CLASS ((object), G_TYPE_OBJECT, GObjectClass))
#define G_IS_OBJECT_CLASS(class)    (G_TYPE_CHECK_CLASS_TYPE ((class), G_TYPE_OBJECT))
#define G_IS_OBJECT(object)         (G_TYPE_CHECK_INSTANCE_FUNDAMENTAL_TYPE ((object), G_TYPE_OBJECT))
#define G_OBJECT_CLASS(class)       (G_TYPE_CHECK_CLASS_CAST ((class), G_TYPE_OBJECT, GObjectClass))
#define G_OBJECT(object)            (G_TYPE_CHECK_INSTANCE_CAST ((object), G_TYPE_OBJECT, GObject))
#define G_TYPE_IS_OBJECT(type)      (G_TYPE_FUNDAMENTAL (type) == G_TYPE_OBJECT)
#define g_cclosure_marshal_BOOL__BOXED_BOXED	g_cclosure_marshal_BOOLEAN__BOXED_BOXED
#define g_cclosure_marshal_BOOL__FLAGS	g_cclosure_marshal_BOOLEAN__FLAGS
#define G_TYPE_OPTION_GROUP (g_option_group_get_type ())
#define G_TYPE_CHECKSUM (g_checksum_get_type ())
#define G_TYPE_THREAD (g_thread_get_type ())
#define G_TYPE_MAPPED_FILE (g_mapped_file_get_type ())
#define G_TYPE_KEY_FILE (g_key_file_get_type ())
#define G_TYPE_MARKUP_PARSE_CONTEXT (g_markup_parse_context_get_type ())
#define G_TYPE_POLLFD (g_pollfd_get_type ())
#define G_TYPE_SOURCE (g_source_get_type ())
#define G_TYPE_MAIN_CONTEXT (g_main_context_get_type ())
#define G_TYPE_MAIN_LOOP (g_main_loop_get_type ())
#define G_TYPE_VARIANT_DICT (g_variant_dict_get_type ())
#define G_TYPE_VARIANT_BUILDER (g_variant_builder_get_type ())
#define G_TYPE_IO_CONDITION (g_io_condition_get_type ())
#define G_TYPE_IO_CHANNEL (g_io_channel_get_type ())
#define G_TYPE_TIME_ZONE (g_time_zone_get_type ())
#define G_TYPE_DATE_TIME (g_date_time_get_type ())
#define G_TYPE_ERROR (g_error_get_type ())
#define G_TYPE_VARIANT_TYPE (g_variant_type_get_gtype ())
#define G_TYPE_BYTES (g_bytes_get_type ())
#define G_TYPE_PTR_ARRAY (g_ptr_array_get_type ())
#define G_TYPE_BYTE_ARRAY (g_byte_array_get_type ())
#define G_TYPE_ARRAY (g_array_get_type ())
#define G_TYPE_MATCH_INFO (g_match_info_get_type ())
#define G_TYPE_REGEX (g_regex_get_type ())
#define G_TYPE_HASH_TABLE (g_hash_table_get_type ())
#define G_TYPE_GSTRING (g_gstring_get_type ())
#define G_TYPE_STRV (g_strv_get_type ())
#define G_TYPE_DATE (g_date_get_type ())
#define G_VALUE_HOLDS_FLAGS(value)     (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_FLAGS))
#define G_VALUE_HOLDS_ENUM(value)      (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_ENUM))
#define G_FLAGS_CLASS_TYPE_NAME(class) (g_type_name (G_FLAGS_CLASS_TYPE (class)))
#define G_FLAGS_CLASS_TYPE(class)      (G_TYPE_FROM_CLASS (class))
#define G_IS_FLAGS_CLASS(class)        (G_TYPE_CHECK_CLASS_TYPE ((class), G_TYPE_FLAGS))
#define G_FLAGS_CLASS(class)	       (G_TYPE_CHECK_CLASS_CAST ((class), G_TYPE_FLAGS, GFlagsClass))
#define G_TYPE_IS_FLAGS(type)	       (G_TYPE_FUNDAMENTAL (type) == G_TYPE_FLAGS)
#define G_ENUM_CLASS_TYPE_NAME(class)  (g_type_name (G_ENUM_CLASS_TYPE (class)))
#define G_ENUM_CLASS_TYPE(class)       (G_TYPE_FROM_CLASS (class))
#define G_IS_ENUM_CLASS(class)	       (G_TYPE_CHECK_CLASS_TYPE ((class), G_TYPE_ENUM))
#define G_ENUM_CLASS(class)	       (G_TYPE_CHECK_CLASS_CAST ((class), G_TYPE_ENUM, GEnumClass))
#define G_TYPE_IS_ENUM(type)	       (G_TYPE_FUNDAMENTAL (type) == G_TYPE_ENUM)
#define	G_CALLBACK(f)			 ((GCallback) (f))
#define	G_CCLOSURE_SWAP_DATA(cclosure)	 (((GClosure*) (cclosure))->derivative_flag)
#define	G_CLOSURE_N_NOTIFIERS(cl)	 (((cl)->n_guards << 1L) + \
                                          (cl)->n_fnotifiers + (cl)->n_inotifiers)
#define	G_CLOSURE_NEEDS_MARSHAL(closure) (((GClosure*) (closure))->marshal == NULL)
#define G_TYPE_VALUE (g_value_get_type ())
#define G_TYPE_CLOSURE (g_closure_get_type ())
#define G_VALUE_HOLDS_BOXED(value) (G_TYPE_CHECK_VALUE_TYPE ((value), G_TYPE_BOXED))
#define G_TYPE_IS_BOXED(type)      (G_TYPE_FUNDAMENTAL (type) == G_TYPE_BOXED)
#define G_IS_BINDING(obj)       (G_TYPE_CHECK_INSTANCE_TYPE ((obj), G_TYPE_BINDING))
#define G_BINDING(obj)          (G_TYPE_CHECK_INSTANCE_CAST ((obj), G_TYPE_BINDING, GBinding))
#define G_TYPE_BINDING          (g_binding_get_type ())
#define G_TYPE_BINDING_FLAGS    (g_binding_flags_get_type ())
typedef gchar* gchararray;
typedef gsize                           GType;
typedef struct _GObjectClass             GInitiallyUnownedClass;
typedef struct _GObject                  GInitiallyUnowned;
typedef gsize GType;
typedef union _GTypeCValue GTypeCValue;
typedef struct _GValueArray GValueArray;
typedef struct _GValue GValue;
typedef struct _GTypePluginClass GTypePluginClass;
typedef struct _GTypeModuleClass GTypeModuleClass;
typedef struct _GTypeModule GTypeModule;
typedef struct __GTypePlugin GTypePlugin;
typedef struct _GTypeValueTable GTypeValueTable;
typedef struct _GInterfaceInfo GInterfaceInfo;
typedef struct _GTypeFundamentalInfo GTypeFundamentalInfo;
typedef struct _GTypeInfo GTypeInfo;
typedef struct _GTypeQuery GTypeQuery;
typedef struct _GTypeInterface GTypeInterface;
typedef struct _GTypeInstance GTypeInstance;
typedef struct _GTypeClass GTypeClass;
typedef struct _GSignalQuery GSignalQuery;
typedef struct _GSignalInvocationHint GSignalInvocationHint;
typedef struct _GParamSpecVariant GParamSpecVariant;
typedef struct _GParamSpecGType GParamSpecGType;
typedef struct _GParamSpecOverride GParamSpecOverride;
typedef struct _GParamSpecObject GParamSpecObject;
typedef struct _GParamSpecValueArray GParamSpecValueArray;
typedef struct _GParamSpecPointer GParamSpecPointer;
typedef struct _GParamSpecBoxed GParamSpecBoxed;
typedef struct _GParamSpecParam GParamSpecParam;
typedef struct _GParamSpecString GParamSpecString;
typedef struct _GParamSpecDouble GParamSpecDouble;
typedef struct _GParamSpecFloat GParamSpecFloat;
typedef struct _GParamSpecFlags GParamSpecFlags;
typedef struct _GParamSpecEnum GParamSpecEnum;
typedef struct _GParamSpecUnichar GParamSpecUnichar;
typedef struct _GParamSpecUInt64 GParamSpecUInt64;
typedef struct _GParamSpecInt64 GParamSpecInt64;
typedef struct _GParamSpecULong GParamSpecULong;
typedef struct _GParamSpecLong GParamSpecLong;
typedef struct _GParamSpecUInt GParamSpecUInt;
typedef struct _GParamSpecInt GParamSpecInt;
typedef struct _GParamSpecBoolean GParamSpecBoolean;
typedef struct _GParamSpecUChar GParamSpecUChar;
typedef struct _GParamSpecChar GParamSpecChar;
typedef struct __GParamSpecPool GParamSpecPool;
typedef struct _GParamSpecTypeInfo GParamSpecTypeInfo;
typedef struct _GParameter /* auxiliary structure for _setv() variants */ GParameter;
typedef struct _GParamSpecClass GParamSpecClass;
typedef struct _GParamSpec GParamSpec;
typedef struct _GObjectConstructParam GObjectConstructParam;
typedef struct _GObjectClass GObjectClass;
typedef struct _GObject GObject;
typedef struct _GFlagsValue GFlagsValue;
typedef struct _GEnumValue GEnumValue;
typedef struct _GFlagsClass GFlagsClass;
typedef struct _GEnumClass GEnumClass;
typedef struct _GCClosure GCClosure;
typedef struct _GClosure GClosure;
typedef struct _GClosureNotifyData GClosureNotifyData;
typedef struct __GBinding GBinding;
typedef void (*GValueTransform) (const GValue *src_value,
				 GValue       *dest_value);
typedef void (*GTypePluginCompleteInterfaceInfo) (GTypePlugin     *plugin,
						   GType            instance_type,
						   GType            interface_type,
						   GInterfaceInfo  *info);
typedef void (*GTypePluginCompleteTypeInfo) (GTypePlugin     *plugin,
						   GType            g_type,
						   GTypeInfo       *info,
						   GTypeValueTable *value_table);
typedef void (*GTypePluginUnuse) (GTypePlugin     *plugin);
typedef void (*GTypePluginUse) (GTypePlugin     *plugin);
typedef void (*GTypeInterfaceCheckFunc) (gpointer	       check_data,
					      gpointer         g_iface);
typedef gboolean (*GTypeClassCacheFunc) (gpointer	       cache_data,
					      GTypeClass      *g_class);
typedef void (*GInterfaceFinalizeFunc) (gpointer         g_iface,
					      gpointer         iface_data);
typedef void (*GInterfaceInitFunc) (gpointer         g_iface,
					      gpointer         iface_data);
typedef void (*GInstanceInitFunc) (GTypeInstance   *instance,
					      gpointer         g_class);
typedef void (*GClassFinalizeFunc) (gpointer         g_class,
					      gpointer         class_data);
typedef void (*GClassInitFunc) (gpointer         g_class,
					      gpointer         class_data);
typedef void (*GBaseFinalizeFunc) (gpointer         g_class);
typedef void (*GBaseInitFunc) (gpointer         g_class);
typedef gboolean (*GSignalAccumulator) (GSignalInvocationHint *ihint,
					 GValue		       *return_accu,
					 const GValue	       *handler_return,
					 gpointer               data);
typedef gboolean (*GSignalEmissionHook) (GSignalInvocationHint *ihint,
					 guint			n_param_values,
					 const GValue	       *param_values,
					 gpointer		data);
typedef void (*GToggleNotify) (gpointer      data,
			       GObject      *object,
			       gboolean      is_last_ref);
typedef void (*GWeakNotify) (gpointer      data,
					 GObject      *where_the_object_was);
typedef void (*GObjectFinalizeFunc) (GObject      *object);
typedef void (*GObjectSetPropertyFunc) (GObject      *object,
                                         guint         property_id,
                                         const GValue *value,
                                         GParamSpec   *pspec);
typedef void (*GObjectGetPropertyFunc) (GObject      *object,
                                         guint         property_id,
                                         GValue       *value,
                                         GParamSpec   *pspec);
typedef void (*GVaClosureMarshal) (GClosure *closure,
				    GValue   *return_value,
				    gpointer  instance,
				    va_list   args,
				    gpointer  marshal_data,
				    int       n_params,
				    GType    *param_types);
typedef void (*GClosureMarshal) (GClosure	*closure,
					 GValue         *return_value,
					 guint           n_param_values,
					 const GValue   *param_values,
					 gpointer        invocation_hint,
					 gpointer	 marshal_data);
typedef void (*GClosureNotify) (gpointer	 data,
					 GClosure	*closure);
typedef void (*GCallback) (void);
typedef void (*GBoxedFreeFunc) (gpointer boxed);
typedef gpointer (*GBoxedCopyFunc) (gpointer boxed);
typedef gboolean (*GBindingTransformFunc) (GBinding     *binding,
                                            const GValue *from_value,
                                            GValue       *to_value,
                                            gpointer      user_data);
typedef GVaClosureMarshal		 GSignalCVaMarshaller;
typedef GClosureMarshal			 GSignalCMarshaller;

typedef enum    /*< skip >*/
{
  G_TYPE_FLAG_ABSTRACT		= (1 << 4),
  G_TYPE_FLAG_VALUE_ABSTRACT	= (1 << 5)
} GTypeFlags;
typedef enum    /*< skip >*/
{
  G_TYPE_FLAG_CLASSED           = (1 << 0),
  G_TYPE_FLAG_INSTANTIATABLE    = (1 << 1),
  G_TYPE_FLAG_DERIVABLE         = (1 << 2),
  G_TYPE_FLAG_DEEP_DERIVABLE    = (1 << 3)
} GTypeFundamentalFlags;
typedef enum	/*< skip >*/
{
  G_TYPE_DEBUG_NONE	= 0,
  G_TYPE_DEBUG_OBJECTS	= 1 << 0,
  G_TYPE_DEBUG_SIGNALS	= 1 << 1,
  G_TYPE_DEBUG_INSTANCE_COUNT = 1 << 2,
  G_TYPE_DEBUG_MASK	= 0x07
} GTypeDebugFlags;
typedef enum
{
  G_SIGNAL_MATCH_ID	   = 1 << 0,
  G_SIGNAL_MATCH_DETAIL	   = 1 << 1,
  G_SIGNAL_MATCH_CLOSURE   = 1 << 2,
  G_SIGNAL_MATCH_FUNC	   = 1 << 3,
  G_SIGNAL_MATCH_DATA	   = 1 << 4,
  G_SIGNAL_MATCH_UNBLOCKED = 1 << 5
} GSignalMatchType;
typedef enum
{
  G_CONNECT_AFTER	= 1 << 0,
  G_CONNECT_SWAPPED	= 1 << 1
} GConnectFlags;
typedef enum
{
  G_SIGNAL_RUN_FIRST	= 1 << 0,
  G_SIGNAL_RUN_LAST	= 1 << 1,
  G_SIGNAL_RUN_CLEANUP	= 1 << 2,
  G_SIGNAL_NO_RECURSE	= 1 << 3,
  G_SIGNAL_DETAILED	= 1 << 4,
  G_SIGNAL_ACTION	= 1 << 5,
  G_SIGNAL_NO_HOOKS	= 1 << 6,
  G_SIGNAL_MUST_COLLECT = 1 << 7,
  G_SIGNAL_DEPRECATED   = 1 << 8
} GSignalFlags;
typedef enum
{
  G_PARAM_READABLE            = 1 << 0,
  G_PARAM_WRITABLE            = 1 << 1,
  G_PARAM_READWRITE           = (G_PARAM_READABLE | G_PARAM_WRITABLE),
  G_PARAM_CONSTRUCT	      = 1 << 2,
  G_PARAM_CONSTRUCT_ONLY      = 1 << 3,
  G_PARAM_LAX_VALIDATION      = 1 << 4,
  G_PARAM_STATIC_NAME	      = 1 << 5,
#ifndef G_DISABLE_DEPRECATED
  G_PARAM_PRIVATE	      = G_PARAM_STATIC_NAME,
#endif
  G_PARAM_STATIC_NICK	      = 1 << 6,
  G_PARAM_STATIC_BLURB	      = 1 << 7,
  /* User defined flags go here */
  G_PARAM_EXPLICIT_NOTIFY     = 1 << 30,
  /* Avoid warning with -Wpedantic for gcc6 */
  G_PARAM_DEPRECATED          = (gint)(1u << 31)
} GParamFlags;
typedef enum { /*< prefix=G_BINDING >*/
  G_BINDING_DEFAULT        = 0,

  G_BINDING_BIDIRECTIONAL  = 1 << 0,
  G_BINDING_SYNC_CREATE    = 1 << 1,
  G_BINDING_INVERT_BOOLEAN = 1 << 2
} GBindingFlags;
union _GTypeCValue
{
  gint     v_int;
  glong    v_long;
  gint64   v_int64;
  gdouble  v_double;
  gpointer v_pointer;
};
struct _GValueArray
{
  guint   n_values;
  GValue *values;

  /*< private >*/
  guint   n_prealloced;
};
struct _GValue
{
  /*< private >*/
  GType		g_type;

  /* public for GTypeValueTable methods */
  /*union {
    gint	v_int;
    guint	v_uint;
    glong	v_long;
    gulong	v_ulong;
    gint64      v_int64;
    guint64     v_uint64;
    gfloat	v_float;
    gdouble	v_double;
    gpointer	v_pointer;
  }*/ int data[2];
};
struct _GTypePluginClass
{
  /*< private >*/
  GTypeInterface		   base_iface;
  
  /*< public >*/
  GTypePluginUse		   use_plugin;
  GTypePluginUnuse		   unuse_plugin;
  GTypePluginCompleteTypeInfo	   complete_type_info;
  GTypePluginCompleteInterfaceInfo complete_interface_info;
};
struct _GTypeModuleClass
{
  GObjectClass parent_class;

  /*< public >*/
  gboolean (* load)   (GTypeModule *module);
  void     (* unload) (GTypeModule *module);

  /*< private >*/
  /* Padding for future expansion */
  void (*reserved1) (void);
  void (*reserved2) (void);
  void (*reserved3) (void);
  void (*reserved4) (void);
};
struct _GTypeModule 
{
  GObject parent_instance;

  guint use_count;
  GSList *type_infos;
  GSList *interface_infos;

  /*< public >*/
  gchar *name;
};

struct _GTypeValueTable
{
  void     (*value_init)         (GValue       *value);
  void     (*value_free)         (GValue       *value);
  void     (*value_copy)         (const GValue *src_value,
				  GValue       *dest_value);
  /* varargs functionality (optional) */
  gpointer (*value_peek_pointer) (const GValue *value);
  const gchar *collect_format;
  gchar*   (*collect_value)      (GValue       *value,
				  guint         n_collect_values,
				  GTypeCValue  *collect_values,
				  guint		collect_flags);
  const gchar *lcopy_format;
  gchar*   (*lcopy_value)        (const GValue *value,
				  guint         n_collect_values,
				  GTypeCValue  *collect_values,
				  guint		collect_flags);
};
struct _GInterfaceInfo
{
  GInterfaceInitFunc     interface_init;
  GInterfaceFinalizeFunc interface_finalize;
  gpointer               interface_data;
};
struct _GTypeFundamentalInfo
{
  GTypeFundamentalFlags  type_flags;
};
struct _GTypeInfo
{
  /* interface types, classed types, instantiated types */
  guint16                class_size;
  
  GBaseInitFunc          base_init;
  GBaseFinalizeFunc      base_finalize;
  
  /* interface types, classed types, instantiated types */
  GClassInitFunc         class_init;
  GClassFinalizeFunc     class_finalize;
  gconstpointer          class_data;
  
  /* instantiated types */
  guint16                instance_size;
  guint16                n_preallocs;
  GInstanceInitFunc      instance_init;
  
  /* value handling */
  const GTypeValueTable	*value_table;
};
struct _GTypeQuery
{
  GType		type;
  const gchar  *type_name;
  guint		class_size;
  guint		instance_size;
};
struct _GTypeInterface
{
  /*< private >*/
  GType g_type;         /* iface type */
  GType g_instance_type;
};
struct _GTypeInstance
{
  /*< private >*/
  GTypeClass *g_class;
};
struct _GTypeClass
{
  /*< private >*/
  GType g_type;
};
struct _GSignalQuery
{
  guint		signal_id;
  const gchar  *signal_name;
  GType		itype;
  GSignalFlags	signal_flags;
  GType		return_type; /* mangled with G_SIGNAL_TYPE_STATIC_SCOPE flag */
  guint		n_params;
  const GType  *param_types; /* mangled with G_SIGNAL_TYPE_STATIC_SCOPE flag */
};
struct _GSignalInvocationHint
{
  guint		signal_id;
  GQuark	detail;
  GSignalFlags	run_type;
};
struct _GParamSpecVariant
{
  GParamSpec    parent_instance;
  GVariantType *type;
  GVariant     *default_value;

  /*< private >*/
  gpointer      padding[4];
};
struct _GParamSpecGType
{
  GParamSpec    parent_instance;
  GType         is_a_type;
};
struct _GParamSpecOverride
{
  /*< private >*/
  GParamSpec    parent_instance;
  GParamSpec   *overridden;
};
struct _GParamSpecObject
{
  GParamSpec    parent_instance;
};
struct _GParamSpecValueArray
{
  GParamSpec    parent_instance;
  GParamSpec   *element_spec;
  guint		fixed_n_elements;
};
struct _GParamSpecPointer
{
  GParamSpec    parent_instance;
};
struct _GParamSpecBoxed
{
  GParamSpec    parent_instance;
};
struct _GParamSpecParam
{
  GParamSpec    parent_instance;
};
struct _GParamSpecString
{
  GParamSpec    parent_instance;
  
  gchar        *default_value;
  gchar        *cset_first;
  gchar        *cset_nth;
  gchar         substitutor;
  guint         null_fold_if_empty : 1;
  guint         ensure_non_null : 1;
};
struct _GParamSpecDouble
{
  GParamSpec    parent_instance;
  
  gdouble       minimum;
  gdouble       maximum;
  gdouble       default_value;
  gdouble       epsilon;
};
struct _GParamSpecFloat
{
  GParamSpec    parent_instance;
  
  gfloat        minimum;
  gfloat        maximum;
  gfloat        default_value;
  gfloat        epsilon;
};
struct _GParamSpecFlags
{
  GParamSpec    parent_instance;
  
  GFlagsClass  *flags_class;
  guint         default_value;
};
struct _GParamSpecEnum
{
  GParamSpec    parent_instance;
  
  GEnumClass   *enum_class;
  gint          default_value;
};
struct _GParamSpecUnichar
{
  GParamSpec    parent_instance;
  
  gunichar      default_value;
};
struct _GParamSpecUInt64
{
  GParamSpec    parent_instance;
  
  guint64       minimum;
  guint64       maximum;
  guint64       default_value;
};
struct _GParamSpecInt64
{
  GParamSpec    parent_instance;
  
  gint64        minimum;
  gint64        maximum;
  gint64        default_value;
};
struct _GParamSpecULong
{
  GParamSpec    parent_instance;
  
  gulong        minimum;
  gulong        maximum;
  gulong        default_value;
};
struct _GParamSpecLong
{
  GParamSpec    parent_instance;
  
  glong         minimum;
  glong         maximum;
  glong         default_value;
};
struct _GParamSpecUInt
{
  GParamSpec    parent_instance;
  
  guint         minimum;
  guint         maximum;
  guint         default_value;
};
struct _GParamSpecInt
{
  GParamSpec    parent_instance;
  
  gint          minimum;
  gint          maximum;
  gint          default_value;
};
struct _GParamSpecBoolean
{
  GParamSpec    parent_instance;
  
  gboolean      default_value;
};
struct _GParamSpecUChar
{
  GParamSpec    parent_instance;
  
  guint8        minimum;
  guint8        maximum;
  guint8        default_value;
};
struct _GParamSpecChar
{
  GParamSpec    parent_instance;
  
  gint8         minimum;
  gint8         maximum;
  gint8         default_value;
};

struct _GParamSpecTypeInfo
{
  /* type system portion */
  guint16         instance_size;                               /* obligatory */
  guint16         n_preallocs;                                 /* optional */
  void		(*instance_init)	(GParamSpec   *pspec); /* optional */

  /* class portion */
  GType           value_type;				       /* obligatory */
  void          (*finalize)             (GParamSpec   *pspec); /* optional */
  void          (*value_set_default)    (GParamSpec   *pspec,  /* recommended */
					 GValue       *value);
  gboolean      (*value_validate)       (GParamSpec   *pspec,  /* optional */
					 GValue       *value);
  gint          (*values_cmp)           (GParamSpec   *pspec,  /* recommended */
					 const GValue *value1,
					 const GValue *value2);
};
struct _GParameter /* auxiliary structure for _setv() variants */
{
  const gchar *name;
  GValue       value;
};
struct _GParamSpecClass
{
  GTypeClass      g_type_class;

  GType		  value_type;

  void	        (*finalize)		(GParamSpec   *pspec);

  /* GParam methods */
  void          (*value_set_default)    (GParamSpec   *pspec,
					 GValue       *value);
  gboolean      (*value_validate)       (GParamSpec   *pspec,
					 GValue       *value);
  gint          (*values_cmp)           (GParamSpec   *pspec,
					 const GValue *value1,
					 const GValue *value2);
  /*< private >*/
  gpointer	  dummy[4];
};
struct _GParamSpec
{
  GTypeInstance  g_type_instance;

  const gchar   *name;          /* interned string */
  GParamFlags    flags;
  GType		 value_type;
  GType		 owner_type;	/* class or interface using this property */

  /*< private >*/
  gchar         *_nick;
  gchar         *_blurb;
  GData		*qdata;
  guint          ref_count;
  guint		 param_id;	/* sort-criteria */
};
typedef struct {
    /*<private>*/
    union { gpointer p; } priv;
} GWeakRef;
struct _GObjectConstructParam
{
  GParamSpec *pspec;
  GValue     *value;
};
struct  _GObjectClass
{
  GTypeClass   g_type_class;

  /*< private >*/
  GSList      *construct_properties;

  /*< public >*/
  /* seldom overidden */
  GObject*   (*constructor)     (GType                  type,
                                 guint                  n_construct_properties,
                                 GObjectConstructParam *construct_properties);
  /* overridable methods */
  void       (*set_property)		(GObject        *object,
                                         guint           property_id,
                                         const GValue   *value,
                                         GParamSpec     *pspec);
  void       (*get_property)		(GObject        *object,
                                         guint           property_id,
                                         GValue         *value,
                                         GParamSpec     *pspec);
  void       (*dispose)			(GObject        *object);
  void       (*finalize)		(GObject        *object);
  /* seldom overidden */
  void       (*dispatch_properties_changed) (GObject      *object,
					     guint	   n_pspecs,
					     GParamSpec  **pspecs);
  /* signals */
  void	     (*notify)			(GObject	*object,
					 GParamSpec	*pspec);

  /* called when done constructing */
  void	     (*constructed)		(GObject	*object);

  /*< private >*/
  gsize		flags;

  /* padding */
  gpointer	pdummy[6];
};
struct  _GObject
{
  GTypeInstance  g_type_instance;
  
  /*< private >*/
  volatile guint ref_count;
  GData         *qdata;
};
struct _GFlagsValue
{
  guint	 value;
  const gchar *value_name;
  const gchar *value_nick;
};
struct _GEnumValue
{
  gint	 value;
  const gchar *value_name;
  const gchar *value_nick;
};
struct	_GFlagsClass
{
  GTypeClass   g_type_class;
  
  /*< public >*/  
  guint	       mask;
  guint	       n_values;
  GFlagsValue *values;
};
struct	_GEnumClass
{
  GTypeClass  g_type_class;

  /*< public >*/  
  gint	      minimum;
  gint	      maximum;
  guint	      n_values;
  GEnumValue *values;
};
struct _GCClosure
{
  GClosure	closure;
  gpointer	callback;
};
struct _GClosure
{
  /*< private >*/
  volatile      	guint	 ref_count : 15;
  /* meta_marshal is not used anymore but must be zero for historical reasons
     as it was exposed in the G_CLOSURE_N_NOTIFIERS macro */
  volatile       	guint	 meta_marshal_nouse : 1;
  volatile       	guint	 n_guards : 1;
  volatile       	guint	 n_fnotifiers : 2;	/* finalization notifiers */
  volatile       	guint	 n_inotifiers : 8;	/* invalidation notifiers */
  volatile       	guint	 in_inotify : 1;
  volatile       	guint	 floating : 1;
  /*< protected >*/
  volatile         	guint	 derivative_flag : 1;
  /*< public >*/
  volatile       	guint	 in_marshal : 1;
  volatile       	guint	 is_invalid : 1;

  /*< private >*/	void   (*marshal)  (GClosure       *closure,
					    GValue /*out*/ *return_value,
					    guint           n_param_values,
					    const GValue   *param_values,
					    gpointer        invocation_hint,
					    gpointer	    marshal_data);
  /*< protected >*/	gpointer data;

  /*< private >*/	GClosureNotifyData *notifiers;

  /* invariants/constrains:
   * - ->marshal and ->data are _invalid_ as soon as ->is_invalid==TRUE
   * - invocation of all inotifiers occours prior to fnotifiers
   * - order of inotifiers is random
   *   inotifiers may _not_ free/invalidate parameter values (e.g. ->data)
   * - order of fnotifiers is random
   * - each notifier may only be removed before or during its invocation
   * - reference counting may only happen prior to fnotify invocation
   *   (in that sense, fnotifiers are really finalization handlers)
   */
};
struct _GClosureNotifyData
{
  gpointer       data;
  GClosureNotify notify;
};

void g_value_set_string_take_ownership(GValue            *value, gchar             *v_string);
void g_value_take_string(GValue		   *value, gchar		   *v_string);
gchar * g_strdup_value_contents(const GValue *value);
GType g_pointer_type_register_static(const gchar *name);
GVariant * g_value_dup_variant(const GValue *value);
GVariant * g_value_get_variant(const GValue *value);
void g_value_take_variant(GValue	      *value, GVariant     *variant);
void g_value_set_variant(GValue	      *value, GVariant     *variant);
GType g_value_get_gtype(const GValue *value);
void g_value_set_gtype(GValue	      *value, GType         v_gtype);
GType g_gtype_get_type(void);
gpointer g_value_get_pointer(const GValue *value);
void g_value_set_pointer(GValue	      *value, gpointer      v_pointer);
gchar * g_value_dup_string(const GValue *value);
const gchar  * g_value_get_string(const GValue *value);
void g_value_set_static_string(GValue	      *value, const gchar  *v_string);
void g_value_set_string(GValue	      *value, const gchar  *v_string);
gdouble g_value_get_double(const GValue *value);
void g_value_set_double(GValue	      *value, gdouble       v_double);
gfloat g_value_get_float(const GValue *value);
void g_value_set_float(GValue	      *value, gfloat	       v_float);
guint64 g_value_get_uint64(const GValue *value);
void g_value_set_uint64(GValue	      *value, guint64      v_uint64);
gint64 g_value_get_int64(const GValue *value);
void g_value_set_int64(GValue	      *value, gint64	       v_int64);
gulong g_value_get_ulong(const GValue *value);
void g_value_set_ulong(GValue	      *value, gulong	       v_ulong);
glong g_value_get_long(const GValue *value);
void g_value_set_long(GValue	      *value, glong	       v_long);
guint g_value_get_uint(const GValue *value);
void g_value_set_uint(GValue	      *value, guint	       v_uint);
gint g_value_get_int(const GValue *value);
void g_value_set_int(GValue	      *value, gint	       v_int);
gboolean g_value_get_boolean(const GValue *value);
void g_value_set_boolean(GValue	      *value, gboolean      v_boolean);
guchar g_value_get_uchar(const GValue *value);
void g_value_set_uchar(GValue	      *value, guchar	       v_uchar);
gint8 g_value_get_schar(const GValue *value);
void g_value_set_schar(GValue	      *value, gint8	       v_char);
gchar g_value_get_char(const GValue *value);
void g_value_set_char(GValue       *value, gchar         v_char);
GValueArray * g_value_array_sort_with_data(GValueArray	*value_array, GCompareDataFunc	 compare_func, gpointer		 user_data);
GValueArray * g_value_array_sort(GValueArray	*value_array, GCompareFunc	 compare_func);
GValueArray * g_value_array_remove(GValueArray	*value_array, guint		 index_);
GValueArray * g_value_array_insert(GValueArray	*value_array, guint		 index_, const GValue	*value);
GValueArray * g_value_array_append(GValueArray	*value_array, const GValue	*value);
GValueArray * g_value_array_prepend(GValueArray	*value_array, const GValue	*value);
GValueArray * g_value_array_copy(const GValueArray *value_array);
void g_value_array_free(GValueArray	*value_array);
GValueArray * g_value_array_new(guint		 n_prealloced);
GValue * g_value_array_get_nth(GValueArray	*value_array, guint		 index_);
GType g_value_array_get_type(void);
void g_value_register_transform_func(GType		 src_type, GType		 dest_type, GValueTransform transform_func);
gboolean g_value_transform(const GValue   *src_value, GValue         *dest_value);
gboolean g_value_type_transformable(GType           src_type, GType           dest_type);
gboolean g_value_type_compatible(GType		 src_type, GType		 dest_type);
gpointer g_value_peek_pointer(const GValue *value);
gboolean g_value_fits_pointer(const GValue *value);
void g_value_init_from_instance(GValue       *value, gpointer      instance);
void g_value_set_instance(GValue	      *value, gpointer      instance);
void g_value_unset(GValue       *value);
GValue * g_value_reset(GValue       *value);
void g_value_copy(const GValue *src_value, GValue       *dest_value);
GValue * g_value_init(GValue       *value, GType         g_type);
void g_type_plugin_complete_interface_info(GTypePlugin     *plugin, GType            instance_type, GType            interface_type, GInterfaceInfo  *info);
void g_type_plugin_complete_type_info(GTypePlugin     *plugin, GType            g_type, GTypeInfo       *info, GTypeValueTable *value_table);
void g_type_plugin_unuse(GTypePlugin	 *plugin);
void g_type_plugin_use(GTypePlugin	 *plugin);
GType g_type_plugin_get_type(void);
GType g_type_module_register_flags(GTypeModule          *module, const gchar          *name, const GFlagsValue    *const_static_values);
GType g_type_module_register_enum(GTypeModule          *module, const gchar          *name, const GEnumValue     *const_static_values);
void g_type_module_add_interface(GTypeModule          *module, GType                 instance_type, GType                 interface_type, const GInterfaceInfo *interface_info);
GType g_type_module_register_type(GTypeModule          *module, GType                 parent_type, const gchar          *type_name, const GTypeInfo      *type_info, GTypeFlags            flags);
void g_type_module_set_name(GTypeModule          *module, const gchar          *name);
void g_type_module_unuse(GTypeModule          *module);
gboolean g_type_module_use(GTypeModule          *module);
GType g_type_module_get_type(void);
const gchar  * g_type_name_from_class(GTypeClass	*g_class);
const gchar  * g_type_name_from_instance(GTypeInstance	*instance);
gboolean g_type_test_flags(GType               type, guint               flags);
gboolean g_type_check_value_holds(const GValue	    *value, GType		     type);
gboolean g_type_check_value(const GValue       *value);
gboolean g_type_check_is_value_type(GType		     type);
gboolean g_type_check_class_is_a(GTypeClass         *g_class, GType               is_a_type);
GTypeClass * g_type_check_class_cast(GTypeClass         *g_class, GType               is_a_type);
gboolean g_type_check_instance_is_fundamentally_a(GTypeInstance *instance, GType          fundamental_type);
gboolean g_type_check_instance_is_a(GTypeInstance      *instance, GType               iface_type);
GTypeInstance * g_type_check_instance_cast(GTypeInstance      *instance, GType               iface_type);
gboolean g_type_check_instance(GTypeInstance      *instance);
GTypeValueTable * g_type_value_table_peek(GType		     type);
void g_type_remove_interface_check(gpointer	         check_data, GTypeInterfaceCheckFunc check_func);
void g_type_add_interface_check(gpointer	         check_data, GTypeInterfaceCheckFunc check_func);
void g_type_class_unref_uncached(gpointer            g_class);
void g_type_remove_class_cache_func(gpointer	     cache_data, GTypeClassCacheFunc cache_func);
void g_type_add_class_cache_func(gpointer	     cache_data, GTypeClassCacheFunc cache_func);
void g_type_free_instance(GTypeInstance      *instance);
GTypeInstance * g_type_create_instance(GType               type);
GType g_type_fundamental(GType		     type_id);
GType g_type_fundamental_next(void);
GTypePlugin * g_type_interface_get_plugin(GType		     instance_type, GType               interface_type);
GTypePlugin * g_type_get_plugin(GType		     type);
guint g_type_get_type_registration_serial(void);
void g_type_ensure(GType                       type);
gint g_type_class_get_instance_private_offset(gpointer         g_class);
gpointer g_type_class_get_private(GTypeClass 		    *klass, GType			     private_type);
void g_type_add_class_private(GType    		     class_type, gsize    		     private_size);
void g_type_class_adjust_private_offset(gpointer                g_class, gint                   *private_size_or_offset);
gpointer g_type_instance_get_private(GTypeInstance              *instance, GType                       private_type);
gint g_type_add_instance_private(GType                       class_type, gsize                       private_size);
void g_type_class_add_private(gpointer                    g_class, gsize                       private_size);
GType * g_type_interface_prerequisites(GType                       interface_type, guint                      *n_prerequisites);
void g_type_interface_add_prerequisite(GType			     interface_type, GType			     prerequisite_type);
void g_type_add_interface_dynamic(GType			     instance_type, GType			     interface_type, GTypePlugin		    *plugin);
void g_type_add_interface_static(GType			     instance_type, GType			     interface_type, const GInterfaceInfo	    *info);
GType g_type_register_fundamental(GType			     type_id, const gchar		    *type_name, const GTypeInfo	    *info, const GTypeFundamentalInfo *finfo, GTypeFlags		     flags);
GType g_type_register_dynamic(GType			     parent_type, const gchar		    *type_name, GTypePlugin		    *plugin, GTypeFlags		     flags);
GType g_type_register_static_simple(GType                       parent_type, const gchar                *type_name, guint                       class_size, GClassInitFunc              class_init, guint                       instance_size, GInstanceInitFunc           instance_init, GTypeFlags	             flags);
GType g_type_register_static(GType			     parent_type, const gchar		    *type_name, const GTypeInfo	    *info, GTypeFlags		     flags);
int g_type_get_instance_count(GType            type);
void g_type_query(GType	       type, GTypeQuery      *query);
gpointer g_type_get_qdata(GType            type, GQuark           quark);
void g_type_set_qdata(GType            type, GQuark           quark, gpointer         data);
GType * g_type_interfaces(GType            type, guint           *n_interfaces);
GType * g_type_children(GType            type, guint           *n_children);
void g_type_default_interface_unref(gpointer         g_iface);
gpointer g_type_default_interface_peek(GType            g_type);
gpointer g_type_default_interface_ref(GType            g_type);
gpointer g_type_interface_peek_parent(gpointer         g_iface);
gpointer g_type_interface_peek(gpointer         instance_class, GType            iface_type);
gpointer g_type_class_peek_parent(gpointer         g_class);
void g_type_class_unref(gpointer         g_class);
gpointer g_type_class_peek_static(GType            type);
gpointer g_type_class_peek(GType            type);
gpointer g_type_class_ref(GType            type);
gboolean g_type_is_a(GType            type, GType            is_a_type);
GType g_type_next_base(GType            leaf_type, GType            root_type);
guint g_type_depth(GType            type);
GType g_type_parent(GType            type);
GType g_type_from_name(const gchar     *name);
GQuark g_type_qname(GType            type);
const gchar  * g_type_name(GType            type);
void g_type_init_with_debug_flags(GTypeDebugFlags  debug_flags);
void g_type_init(void);
void g_source_set_dummy_callback(GSource  *source);
void g_source_set_closure(GSource  *source, GClosure *closure);
void g_signal_handlers_destroy(gpointer		  instance);
gboolean g_signal_accumulator_first_wins(GSignalInvocationHint *ihint, GValue                *return_accu, const GValue          *handler_return, gpointer               dummy);
gboolean g_signal_accumulator_true_handled(GSignalInvocationHint *ihint, GValue                *return_accu, const GValue          *handler_return, gpointer               dummy);
void g_signal_chain_from_overridden_handler(gpointer           instance, ...);
void g_signal_chain_from_overridden(const GValue      *instance_and_params, GValue            *return_value);
void g_signal_override_class_handler(const gchar       *signal_name, GType              instance_type, GCallback          class_handler);
void g_signal_override_class_closure(guint              signal_id, GType              instance_type, GClosure          *class_closure);
guint g_signal_handlers_disconnect_matched(gpointer		  instance, GSignalMatchType	  mask, guint		  signal_id, GQuark		  detail, GClosure		 *closure, gpointer		  func, gpointer		  data);
guint g_signal_handlers_unblock_matched(gpointer		  instance, GSignalMatchType	  mask, guint		  signal_id, GQuark		  detail, GClosure		 *closure, gpointer		  func, gpointer		  data);
guint g_signal_handlers_block_matched(gpointer		  instance, GSignalMatchType	  mask, guint		  signal_id, GQuark		  detail, GClosure		 *closure, gpointer		  func, gpointer		  data);
gulong g_signal_handler_find(gpointer		  instance, GSignalMatchType	  mask, guint		  signal_id, GQuark		  detail, GClosure		 *closure, gpointer		  func, gpointer		  data);
gboolean g_signal_handler_is_connected(gpointer		  instance, gulong		  handler_id);
void g_signal_handler_disconnect(gpointer		  instance, gulong		  handler_id);
void g_signal_handler_unblock(gpointer		  instance, gulong		  handler_id);
void g_signal_handler_block(gpointer		  instance, gulong		  handler_id);
gulong g_signal_connect_data(gpointer		  instance, const gchar	 *detailed_signal, GCallback	  c_handler, gpointer		  data, GClosureNotify	  destroy_data, GConnectFlags	  connect_flags);
gulong g_signal_connect_closure(gpointer		  instance, const gchar       *detailed_signal, GClosure		 *closure, gboolean		  after);
gulong g_signal_connect_closure_by_id(gpointer		  instance, guint		  signal_id, GQuark		  detail, GClosure		 *closure, gboolean		  after);
gboolean g_signal_has_handler_pending(gpointer		  instance, guint		  signal_id, GQuark		  detail, gboolean		  may_be_blocked);
void g_signal_remove_emission_hook(guint		  signal_id, gulong		  hook_id);
gulong g_signal_add_emission_hook(guint		  signal_id, GQuark		  detail, GSignalEmissionHook  hook_func, gpointer	       	  hook_data, GDestroyNotify	  data_destroy);
void g_signal_stop_emission_by_name(gpointer		  instance, const gchar	 *detailed_signal);
void g_signal_stop_emission(gpointer		  instance, guint		  signal_id, GQuark		  detail);
GSignalInvocationHint * g_signal_get_invocation_hint(gpointer    instance);
gboolean g_signal_parse_name(const gchar	*detailed_signal, GType		 itype, guint		*signal_id_p, GQuark		*detail_p, gboolean		 force_detail_quark);
guint * g_signal_list_ids(GType               itype, guint              *n_ids);
void g_signal_query(guint               signal_id, GSignalQuery       *query);
const gchar  * g_signal_name(guint               signal_id);
guint g_signal_lookup(const gchar        *name, GType               itype);
void g_signal_emit_by_name(gpointer            instance, const gchar        *detailed_signal, ...);
void g_signal_emit(gpointer            instance, guint               signal_id, GQuark              detail, ...);
void g_signal_emit_valist(gpointer            instance, guint               signal_id, GQuark              detail, va_list             var_args);
void g_signal_emitv(const GValue       *instance_and_params, guint               signal_id, GQuark              detail, GValue             *return_value);
void g_signal_set_va_marshaller(guint              signal_id, GType              instance_type, GSignalCVaMarshaller va_marshaller);
guint g_signal_new_class_handler(const gchar        *signal_name, GType               itype, GSignalFlags        signal_flags, GCallback           class_handler, GSignalAccumulator  accumulator, gpointer            accu_data, GSignalCMarshaller  c_marshaller, GType               return_type, guint               n_params, ...);
guint g_signal_new(const gchar        *signal_name, GType               itype, GSignalFlags        signal_flags, guint               class_offset, GSignalAccumulator	 accumulator, gpointer		 accu_data, GSignalCMarshaller  c_marshaller, GType               return_type, guint               n_params, ...);
guint g_signal_new_valist(const gchar        *signal_name, GType               itype, GSignalFlags        signal_flags, GClosure           *class_closure, GSignalAccumulator	 accumulator, gpointer		 accu_data, GSignalCMarshaller  c_marshaller, GType               return_type, guint               n_params, va_list             args);
guint g_signal_newv(const gchar        *signal_name, GType               itype, GSignalFlags        signal_flags, GClosure           *class_closure, GSignalAccumulator	 accumulator, gpointer		 accu_data, GSignalCMarshaller  c_marshaller, GType               return_type, guint               n_params, GType              *param_types);
GParamSpec * g_param_spec_variant(const gchar        *name, const gchar        *nick, const gchar	     *blurb, const GVariantType *type, GVariant           *default_value, GParamFlags         flags);
GParamSpec * g_param_spec_gtype(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, GType           is_a_type, GParamFlags	  flags);
GParamSpec * g_param_spec_override(const gchar    *name, GParamSpec     *overridden);
GParamSpec * g_param_spec_object(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, GType		  object_type, GParamFlags	  flags);
GParamSpec * g_param_spec_value_array(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, GParamSpec	 *element_spec, GParamFlags	  flags);
GParamSpec * g_param_spec_pointer(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, GParamFlags	  flags);
GParamSpec * g_param_spec_boxed(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, GType		  boxed_type, GParamFlags	  flags);
GParamSpec * g_param_spec_param(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, GType		  param_type, GParamFlags	  flags);
GParamSpec * g_param_spec_string(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, const gchar	 *default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_double(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, gdouble	  minimum, gdouble	  maximum, gdouble	  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_float(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, gfloat	  minimum, gfloat	  maximum, gfloat	  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_flags(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, GType		  flags_type, guint		  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_enum(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, GType		  enum_type, gint		  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_unichar(const gchar    *name, const gchar    *nick, const gchar    *blurb, gunichar	  default_value, GParamFlags     flags);
GParamSpec * g_param_spec_uint64(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, guint64	  minimum, guint64	  maximum, guint64	  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_int64(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, gint64       	  minimum, gint64       	  maximum, gint64       	  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_ulong(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, gulong	  minimum, gulong	  maximum, gulong	  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_long(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, glong		  minimum, glong		  maximum, glong		  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_uint(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, guint		  minimum, guint		  maximum, guint		  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_int(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, gint		  minimum, gint		  maximum, gint		  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_boolean(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, gboolean	  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_uchar(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, guint8	  minimum, guint8	  maximum, guint8	  default_value, GParamFlags	  flags);
GParamSpec * g_param_spec_char(const gchar	 *name, const gchar	 *nick, const gchar	 *blurb, gint8		  minimum, gint8		  maximum, gint8		  default_value, GParamFlags	  flags);
GParamSpec ** g_param_spec_pool_list(GParamSpecPool	*pool, GType		 owner_type, guint		*n_pspecs_p);
GList * g_param_spec_pool_list_owned(GParamSpecPool	*pool, GType		 owner_type);
GParamSpec * g_param_spec_pool_lookup(GParamSpecPool	*pool, const gchar	*param_name, GType		 owner_type, gboolean	 walk_ancestors);
void g_param_spec_pool_remove(GParamSpecPool	*pool, GParamSpec	*pspec);
void g_param_spec_pool_insert(GParamSpecPool	*pool, GParamSpec	*pspec, GType		 owner_type);
GParamSpecPool * g_param_spec_pool_new(gboolean	type_prefixing);
gpointer g_param_spec_internal(GType	        param_type, const gchar   *name, const gchar   *nick, const gchar   *blurb, GParamFlags    flags);
GType g_param_type_register_static(const gchar		  *name, const GParamSpecTypeInfo *pspec_info);
GQuark g_param_spec_get_name_quark(GParamSpec    *pspec);
const GValue  * g_param_spec_get_default_value(GParamSpec    *pspec);
void g_value_set_param_take_ownership(GValue        *value, GParamSpec    *param);
void g_value_take_param(GValue        *value, GParamSpec    *param);
GParamSpec * g_value_dup_param(const GValue  *value);
GParamSpec * g_value_get_param(const GValue  *value);
void g_value_set_param(GValue	       *value, GParamSpec    *param);
const gchar  * g_param_spec_get_blurb(GParamSpec    *pspec);
const gchar  * g_param_spec_get_nick(GParamSpec    *pspec);
const gchar  * g_param_spec_get_name(GParamSpec    *pspec);
gint g_param_values_cmp(GParamSpec    *pspec, const GValue  *value1, const GValue  *value2);
gboolean g_param_value_convert(GParamSpec    *pspec, const GValue  *src_value, GValue	       *dest_value, gboolean	strict_validation);
gboolean g_param_value_validate(GParamSpec    *pspec, GValue	       *value);
gboolean g_param_value_defaults(GParamSpec    *pspec, GValue	       *value);
void g_param_value_set_default(GParamSpec    *pspec, GValue	       *value);
GParamSpec * g_param_spec_get_redirect_target(GParamSpec   *pspec);
gpointer g_param_spec_steal_qdata(GParamSpec    *pspec, GQuark         quark);
void g_param_spec_set_qdata_full(GParamSpec    *pspec, GQuark         quark, gpointer       data, GDestroyNotify destroy);
void g_param_spec_set_qdata(GParamSpec    *pspec, GQuark         quark, gpointer       data);
gpointer g_param_spec_get_qdata(GParamSpec    *pspec, GQuark         quark);
GParamSpec * g_param_spec_ref_sink(GParamSpec    *pspec);
void g_param_spec_sink(GParamSpec    *pspec);
void g_param_spec_unref(GParamSpec    *pspec);
GParamSpec * g_param_spec_ref(GParamSpec    *pspec);
void g_weak_ref_set(GWeakRef *weak_ref, gpointer  object);
gpointer g_weak_ref_get(GWeakRef *weak_ref);
void g_weak_ref_clear(GWeakRef *weak_ref);
void g_weak_ref_init(GWeakRef *weak_ref, gpointer  object);
void g_clear_object(volatile GObject **object_ptr);
gsize g_object_compat_control(gsize	       what, gpointer	       data);
void g_value_set_object_take_ownership(GValue         *value, gpointer        v_object);
void g_value_take_object(GValue         *value, gpointer        v_object);
void g_object_run_dispose(GObject	      *object);
void g_object_force_floating(GObject        *object);
gulong g_signal_connect_object(gpointer	       instance, const gchar    *detailed_signal, GCallback       c_handler, gpointer	       gobject, GConnectFlags   connect_flags);
gpointer g_value_dup_object(const GValue   *value);
gpointer g_value_get_object(const GValue   *value);
void g_value_set_object(GValue         *value, gpointer        v_object);
GClosure * g_closure_new_object(guint           sizeof_closure, GObject        *object);
GClosure * g_cclosure_new_object_swap(GCallback       callback_func, GObject	      *object);
GClosure * g_cclosure_new_object(GCallback       callback_func, GObject	      *object);
void g_object_watch_closure(GObject        *object, GClosure       *closure);
gboolean g_object_replace_data(GObject        *object, const gchar    *key, gpointer        oldval, gpointer        newval, GDestroyNotify  destroy, GDestroyNotify *old_destroy);
gpointer g_object_dup_data(GObject        *object, const gchar    *key, GDuplicateFunc  dup_func, gpointer         user_data);
gpointer g_object_steal_data(GObject        *object, const gchar    *key);
void g_object_set_data_full(GObject        *object, const gchar    *key, gpointer        data, GDestroyNotify  destroy);
void g_object_set_data(GObject        *object, const gchar    *key, gpointer        data);
gpointer g_object_get_data(GObject        *object, const gchar    *key);
gboolean g_object_replace_qdata(GObject        *object, GQuark          quark, gpointer        oldval, gpointer        newval, GDestroyNotify  destroy, GDestroyNotify *old_destroy);
gpointer g_object_dup_qdata(GObject        *object, GQuark          quark, GDuplicateFunc  dup_func, gpointer         user_data);
gpointer g_object_steal_qdata(GObject        *object, GQuark          quark);
void g_object_set_qdata_full(GObject        *object, GQuark          quark, gpointer        data, GDestroyNotify  destroy);
void g_object_set_qdata(GObject        *object, GQuark          quark, gpointer        data);
gpointer g_object_get_qdata(GObject        *object, GQuark          quark);
void g_object_remove_toggle_ref(GObject       *object, GToggleNotify  notify, gpointer       data);
void g_object_add_toggle_ref(GObject       *object, GToggleNotify  notify, gpointer       data);
void g_object_remove_weak_pointer(GObject        *object, gpointer       *weak_pointer_location);
void g_object_add_weak_pointer(GObject        *object, gpointer       *weak_pointer_location);
void g_object_weak_unref(GObject	      *object, GWeakNotify     notify, gpointer	       data);
void g_object_weak_ref(GObject	      *object, GWeakNotify     notify, gpointer	       data);
void g_object_unref(gpointer        object);
gpointer g_object_ref(gpointer        object);
gpointer g_object_ref_sink(gpointer	       object);
gboolean g_object_is_floating(gpointer        object);
void g_object_thaw_notify(GObject        *object);
void g_object_notify_by_pspec(GObject        *object, GParamSpec     *pspec);
void g_object_notify(GObject        *object, const gchar    *property_name);
void g_object_freeze_notify(GObject        *object);
void g_object_get_property(GObject        *object, const gchar    *property_name, GValue         *value);
void g_object_set_property(GObject        *object, const gchar    *property_name, const GValue   *value);
void g_object_get_valist(GObject        *object, const gchar    *first_property_name, va_list         var_args);
void g_object_getv(GObject        *object, guint           n_properties, const gchar    *names[], GValue          values[]);
void g_object_set_valist(GObject        *object, const gchar    *first_property_name, va_list         var_args);
void g_object_setv(GObject        *object, guint           n_properties, const gchar    *names[], const GValue    values[]);
void g_object_disconnect(gpointer	       object, const gchar    *signal_spec, ...);
gpointer g_object_connect(gpointer	       object, const gchar    *signal_spec, ...);
void g_object_get(gpointer        object, const gchar    *first_property_name, ...);
void g_object_set(gpointer	       object, const gchar    *first_property_name, ...);
GObject * g_object_new_valist(GType           object_type, const gchar    *first_property_name, va_list         var_args);
gpointer g_object_newv(GType           object_type, guint	       n_parameters, GParameter     *parameters);
GObject * g_object_new_with_properties(GType           object_type, guint           n_properties, const char     *names[], const GValue    values[]);
gpointer g_object_new(GType           object_type, const gchar    *first_property_name, ...);
GType g_object_get_type(void);
GParamSpec ** g_object_interface_list_properties(gpointer     g_iface, guint       *n_properties_p);
GParamSpec * g_object_interface_find_property(gpointer     g_iface, const gchar *property_name);
void g_object_interface_install_property(gpointer     g_iface, GParamSpec  *pspec);
void g_object_class_install_properties(GObjectClass   *oclass, guint           n_pspecs, GParamSpec    **pspecs);
void g_object_class_override_property(GObjectClass   *oclass, guint           property_id, const gchar    *name);
GParamSpec ** g_object_class_list_properties(GObjectClass   *oclass, guint	      *n_properties);
GParamSpec * g_object_class_find_property(GObjectClass   *oclass, const gchar    *property_name);
void g_object_class_install_property(GObjectClass   *oclass, guint           property_id, GParamSpec     *pspec);
GType g_initially_unowned_get_type(void);
void g_cclosure_marshal_BOOLEAN__BOXED_BOXEDv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_BOOLEAN__BOXED_BOXED(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_STRING__OBJECT_POINTERv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_STRING__OBJECT_POINTER(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_BOOLEAN__FLAGSv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_BOOLEAN__FLAGS(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__UINT_POINTERv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__UINT_POINTER(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__VARIANTv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__VARIANT(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__OBJECTv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__OBJECT(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__POINTERv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__POINTER(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__BOXEDv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__BOXED(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__PARAMv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__PARAM(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__STRINGv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__STRING(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__DOUBLEv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__DOUBLE(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__FLOATv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__FLOAT(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__FLAGSv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__FLAGS(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__ENUMv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__ENUM(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__ULONGv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__ULONG(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__LONGv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__LONG(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__UINTv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__UINT(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__INTv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__INT(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__UCHARv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__UCHAR(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__CHARv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__CHAR(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__BOOLEANv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__BOOLEAN(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_cclosure_marshal_VOID__VOIDv(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_VOID__VOID(GClosure     *closure, GValue       *return_value, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
GType g_variant_get_gtype(void);
GType g_option_group_get_type(void);
GType g_mapped_file_get_type(void);
GType g_markup_parse_context_get_type(void);
GType g_checksum_get_type(void);
GType g_thread_get_type(void);
GType g_pollfd_get_type(void);
GType g_source_get_type(void);
GType g_main_context_get_type(void);
GType g_main_loop_get_type(void);
GType g_key_file_get_type(void);
GType g_variant_dict_get_type(void);
GType g_variant_builder_get_type(void);
GType g_io_condition_get_type(void);
GType g_io_channel_get_type(void);
GType g_time_zone_get_type(void);
GType g_date_time_get_type(void);
GType g_error_get_type(void);
GType g_match_info_get_type(void);
GType g_regex_get_type(void);
GType g_variant_type_get_gtype(void);
GType g_bytes_get_type(void);
GType g_ptr_array_get_type(void);
GType g_byte_array_get_type(void);
GType g_array_get_type(void);
GType g_hash_table_get_type(void);
GType g_gstring_get_type(void);
GType g_strv_get_type(void);
GType g_date_get_type(void);
void g_flags_complete_type_info(GType	       g_flags_type, GTypeInfo	      *info, const GFlagsValue *const_values);
void g_enum_complete_type_info(GType	       g_enum_type, GTypeInfo	      *info, const GEnumValue  *const_values);
GType g_flags_register_static(const gchar	      *name, const GFlagsValue *const_static_values);
GType g_enum_register_static(const gchar	      *name, const GEnumValue  *const_static_values);
guint g_value_get_flags(const GValue   *value);
void g_value_set_flags(GValue         *value, guint           v_flags);
gint g_value_get_enum(const GValue   *value);
void g_value_set_enum(GValue         *value, gint            v_enum);
gchar           * g_flags_to_string(GType           flags_type, guint           value);
gchar           * g_enum_to_string(GType           g_enum_type, gint            value);
GFlagsValue * g_flags_get_value_by_nick(GFlagsClass	*flags_class, const gchar	*nick);
GFlagsValue * g_flags_get_value_by_name(GFlagsClass	*flags_class, const gchar	*name);
GFlagsValue * g_flags_get_first_value(GFlagsClass	*flags_class, guint		 value);
GEnumValue * g_enum_get_value_by_nick(GEnumClass	*enum_class, const gchar	*nick);
GEnumValue * g_enum_get_value_by_name(GEnumClass	*enum_class, const gchar	*name);
GEnumValue * g_enum_get_value(GEnumClass	*enum_class, gint		 value);
void g_cclosure_marshal_generic_va(GClosure *closure, GValue   *return_value, gpointer  instance, va_list   args_list, gpointer  marshal_data, int       n_params, GType    *param_types);
void g_cclosure_marshal_generic(GClosure     *closure, GValue       *return_gvalue, guint         n_param_values, const GValue *param_values, gpointer      invocation_hint, gpointer      marshal_data);
void g_closure_invoke(GClosure 	*closure, GValue		*return_value, guint		 n_param_values, const GValue	*param_values, gpointer	 invocation_hint);
void g_closure_invalidate(GClosure	*closure);
void g_closure_set_meta_marshal(GClosure       *closure, gpointer	 marshal_data, GClosureMarshal meta_marshal);
void g_closure_set_marshal(GClosure	*closure, GClosureMarshal marshal);
void g_closure_add_marshal_guards(GClosure	*closure, gpointer        pre_marshal_data, GClosureNotify	 pre_marshal_notify, gpointer        post_marshal_data, GClosureNotify	 post_marshal_notify);
void g_closure_remove_invalidate_notifier(GClosure       *closure, gpointer	 notify_data, GClosureNotify	 notify_func);
void g_closure_add_invalidate_notifier(GClosure       *closure, gpointer	 notify_data, GClosureNotify	 notify_func);
void g_closure_remove_finalize_notifier(GClosure       *closure, gpointer	 notify_data, GClosureNotify	 notify_func);
void g_closure_add_finalize_notifier(GClosure       *closure, gpointer	 notify_data, GClosureNotify	 notify_func);
GClosure * g_closure_new_simple(guint		 sizeof_closure, gpointer	 data);
void g_closure_unref(GClosure	*closure);
void g_closure_sink(GClosure	*closure);
GClosure * g_closure_ref(GClosure	*closure);
GClosure * g_signal_type_cclosure_new(GType          itype, guint          struct_offset);
GClosure * g_cclosure_new_swap(GCallback	callback_func, gpointer	user_data, GClosureNotify destroy_data);
GClosure * g_cclosure_new(GCallback	callback_func, gpointer	user_data, GClosureNotify destroy_data);
GType g_value_get_type(void);
GType g_closure_get_type(void);
GType g_boxed_type_register_static(const gchar   *name, GBoxedCopyFunc boxed_copy, GBoxedFreeFunc boxed_free);
gpointer g_value_dup_boxed(const GValue  *value);
gpointer g_value_get_boxed(const GValue  *value);
void g_value_set_boxed_take_ownership(GValue        *value, gconstpointer  v_boxed);
void g_value_take_boxed(GValue        *value, gconstpointer  v_boxed);
void g_value_set_static_boxed(GValue        *value, gconstpointer  v_boxed);
void g_value_set_boxed(GValue        *value, gconstpointer  v_boxed);
void g_boxed_free(GType          boxed_type, gpointer       boxed);
gpointer g_boxed_copy(GType boxed_type, gconstpointer  src_boxed);
GBinding  * g_object_bind_property_with_closures(gpointer               source, const gchar           *source_property, gpointer               target, const gchar           *target_property, GBindingFlags          flags, GClosure              *transform_to, GClosure              *transform_from);
GBinding  * g_object_bind_property_full(gpointer               source, const gchar           *source_property, gpointer               target, const gchar           *target_property, GBindingFlags          flags, GBindingTransformFunc  transform_to, GBindingTransformFunc  transform_from, gpointer               user_data, GDestroyNotify         notify);
GBinding  * g_object_bind_property(gpointer               source, const gchar           *source_property, gpointer               target, const gchar           *target_property, GBindingFlags          flags);
void g_binding_unbind(GBinding *binding);
const gchar  * g_binding_get_target_property(GBinding *binding);
const gchar  * g_binding_get_source_property(GBinding *binding);
GObject  * g_binding_get_target(GBinding *binding);
GObject  * g_binding_get_source(GBinding *binding);
GBindingFlags g_binding_get_flags(GBinding *binding);
GType g_binding_get_type(void);
GType g_binding_flags_get_type(void);
