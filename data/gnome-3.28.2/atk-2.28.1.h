#define atk_interface_age atk_get_interface_age ()
#define atk_binary_age atk_get_binary_age ()
#define atk_micro_version atk_get_micro_version ()
#define atk_minor_version atk_get_minor_version ()
#define atk_major_version atk_get_major_version ()
# define ATK_AVAILABLE_IN_2_14                 ATK_UNAVAILABLE(2, 14)
# define ATK_DEPRECATED_IN_2_14_FOR(f)         ATK_DEPRECATED_FOR(f)
# define ATK_DEPRECATED_IN_2_14                ATK_DEPRECATED
# define ATK_AVAILABLE_IN_2_12                 ATK_UNAVAILABLE(2, 12)
# define ATK_DEPRECATED_IN_2_12_FOR(f)         ATK_DEPRECATED_FOR(f)
# define ATK_DEPRECATED_IN_2_12                ATK_DEPRECATED
# define ATK_AVAILABLE_IN_2_10                 ATK_UNAVAILABLE(2, 10)
# define ATK_DEPRECATED_IN_2_10_FOR(f)         ATK_DEPRECATED_FOR(f)
# define ATK_DEPRECATED_IN_2_10                ATK_DEPRECATED
# define ATK_AVAILABLE_IN_2_8                 ATK_UNAVAILABLE(2, 8)
# define ATK_DEPRECATED_IN_2_8_FOR(f)         ATK_DEPRECATED_FOR(f)
# define ATK_DEPRECATED_IN_2_8                ATK_DEPRECATED
# define ATK_AVAILABLE_IN_2_6                 ATK_UNAVAILABLE(2, 6)
# define ATK_DEPRECATED_IN_2_6_FOR(f)         ATK_DEPRECATED_FOR(f)
# define ATK_DEPRECATED_IN_2_6                ATK_DEPRECATED
# define ATK_AVAILABLE_IN_2_4                 ATK_UNAVAILABLE(2, 4)
# define ATK_DEPRECATED_IN_2_4_FOR(f)         ATK_DEPRECATED_FOR(f)
# define ATK_DEPRECATED_IN_2_4                ATK_DEPRECATED
# define ATK_AVAILABLE_IN_2_2                 ATK_UNAVAILABLE(2, 2)
# define ATK_DEPRECATED_IN_2_2_FOR(f)         ATK_DEPRECATED_FOR(f)
# define ATK_DEPRECATED_IN_2_2                ATK_DEPRECATED
#define ATK_AVAILABLE_IN_ALL _ATK_EXTERN
#define ATK_UNAVAILABLE(maj,min) _ATK_EXTERN
#define ATK_DEPRECATED_FOR(f) _ATK_EXTERN
#define ATK_DEPRECATED _ATK_EXTERN
# define ATK_VERSION_MAX_ALLOWED      (ATK_VERSION_CUR_STABLE)
# define ATK_VERSION_MIN_REQUIRED      (ATK_VERSION_CUR_STABLE)
#define ATK_VERSION_PREV_STABLE        (G_ENCODE_VERSION (ATK_MAJOR_VERSION, ATK_MINOR_VERSION - 1))
#define ATK_VERSION_CUR_STABLE         (G_ENCODE_VERSION (ATK_MAJOR_VERSION, ATK_MINOR_VERSION + 1))
#define ATK_VERSION_2_14       (G_ENCODE_VERSION (2, 14))
#define ATK_VERSION_2_12       (G_ENCODE_VERSION (2, 12))
#define ATK_VERSION_2_10       (G_ENCODE_VERSION (2, 10))
#define ATK_VERSION_2_8       (G_ENCODE_VERSION (2, 8))
#define ATK_VERSION_2_6       (G_ENCODE_VERSION (2, 6))
#define ATK_VERSION_2_4       (G_ENCODE_VERSION (2, 4))
#define ATK_VERSION_2_2       (G_ENCODE_VERSION (2, 2))
#define ATK_CHECK_VERSION(major,minor,micro)                          \
    (ATK_MAJOR_VERSION > (major) ||                                   \
     (ATK_MAJOR_VERSION == (major) && ATK_MINOR_VERSION > (minor)) || \
     (ATK_MAJOR_VERSION == (major) && ATK_MINOR_VERSION == (minor) && \
      ATK_MICRO_VERSION >= (micro)))
#define ATK_INTERFACE_AGE (1)
#define ATK_BINARY_AGE    (22811)
#define ATK_MICRO_VERSION (1)
#define ATK_MINOR_VERSION (28)
#define ATK_MAJOR_VERSION (2)
#define ATK_TYPE_VALUE_TYPE (atk_value_type_get_type())
#define ATK_TYPE_COORD_TYPE (atk_coord_type_get_type())
#define ATK_TYPE_KEY_EVENT_TYPE (atk_key_event_type_get_type())
#define ATK_TYPE_TEXT_CLIP_TYPE (atk_text_clip_type_get_type())
#define ATK_TYPE_TEXT_GRANULARITY (atk_text_granularity_get_type())
#define ATK_TYPE_TEXT_BOUNDARY (atk_text_boundary_get_type())
#define ATK_TYPE_TEXT_ATTRIBUTE (atk_text_attribute_get_type())
#define ATK_TYPE_STATE_TYPE (atk_state_type_get_type())
#define ATK_TYPE_RELATION_TYPE (atk_relation_type_get_type())
#define ATK_TYPE_LAYER (atk_layer_get_type())
#define ATK_TYPE_ROLE (atk_role_get_type())
#define ATK_TYPE_HYPERLINK_STATE_FLAGS (atk_hyperlink_state_flags_get_type())
#define ATK_WINDOW_GET_IFACE(obj)          (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_WINDOW, AtkWindowIface))
#define ATK_WINDOW(obj)                    G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_WINDOW, AtkWindow)
#define ATK_IS_WINDOW(obj)                 G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_WINDOW)
#define ATK_TYPE_WINDOW                    (atk_window_get_type ())
#define ATK_VALUE_GET_IFACE(obj)          (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_VALUE, AtkValueIface))
#define ATK_VALUE(obj)                    G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_VALUE, AtkValue)
#define ATK_IS_VALUE(obj)                 G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_VALUE)
#define ATK_TYPE_VALUE                    (atk_value_get_type ())
#define ATK_DEFINE_TYPE_EXTENDED(TN, t_n, T_P, _f_, _C_)      _ATK_DEFINE_TYPE_EXTENDED_BEGIN (TN, t_n, T_P, _f_) {_C_;} _ATK_DEFINE_TYPE_EXTENDED_END()
#define ATK_DEFINE_ABSTRACT_TYPE_WITH_CODE(TN, t_n, T_P, _C_) _ATK_DEFINE_TYPE_EXTENDED_BEGIN (TN, t_n, T_P, G_TYPE_FLAG_ABSTRACT) {_C_;} _ATK_DEFINE_TYPE_EXTENDED_END()
#define ATK_DEFINE_ABSTRACT_TYPE(TN, t_n, T_P)		       ATK_DEFINE_TYPE_EXTENDED (TN, t_n, T_P, G_TYPE_FLAG_ABSTRACT, {})
#define ATK_DEFINE_TYPE_WITH_CODE(TN, t_n, T_P, _C_)	      _ATK_DEFINE_TYPE_EXTENDED_BEGIN (TN, t_n, T_P, 0) {_C_;} _ATK_DEFINE_TYPE_EXTENDED_END()
#define ATK_DEFINE_TYPE(TN, t_n, T_P)			       ATK_DEFINE_TYPE_EXTENDED (TN, t_n, T_P, 0, {})
#define ATK_UTIL_GET_CLASS(obj)                 (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_UTIL, AtkUtilClass))
#define ATK_IS_UTIL_CLASS(klass)                (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_UTIL))
#define ATK_UTIL_CLASS(klass)                   (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_UTIL, AtkUtilClass))
#define ATK_UTIL(obj)                   G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_UTIL, AtkUtil)
#define ATK_IS_UTIL(obj)                G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_UTIL)
#define ATK_TYPE_UTIL                   (atk_util_get_type ())
#define ATK_TEXT_GET_IFACE(obj)          (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_TEXT, AtkTextIface))
#define ATK_TEXT(obj)                    G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_TEXT, AtkText)
#define ATK_IS_TEXT(obj)                 G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_TEXT)
#define ATK_TYPE_TEXT                    (atk_text_get_type ())
#define ATK_TABLE_CELL_GET_IFACE(obj)          (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_TABLE_CELL, AtkTableCellIface))
#define ATK_TABLE_CELL(obj)                    G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_TABLE_CELL, AtkTableCell)
#define ATK_IS_TABLE_CELL(obj)                 G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_TABLE_CELL)
#define ATK_TYPE_TABLE_CELL                    (atk_table_cell_get_type ())
#define ATK_TABLE_GET_IFACE(obj)          (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_TABLE, AtkTableIface))
#define ATK_TABLE(obj)                    G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_TABLE, AtkTable)
#define ATK_IS_TABLE(obj)                 G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_TABLE)
#define ATK_TYPE_TABLE                    (atk_table_get_type ())
#define ATK_STREAMABLE_CONTENT_GET_IFACE(obj) (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_STREAMABLE_CONTENT, AtkStreamableContentIface))
#define ATK_STREAMABLE_CONTENT(obj)           G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_STREAMABLE_CONTENT, AtkStreamableContent)
#define ATK_IS_STREAMABLE_CONTENT(obj)        G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_STREAMABLE_CONTENT)
#define ATK_TYPE_STREAMABLE_CONTENT           (atk_streamable_content_get_type ())
#define ATK_STATE_SET_GET_CLASS(obj)              (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_STATE_SET, AtkStateSetClass))
#define ATK_IS_STATE_SET_CLASS(klass)             (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_STATE_SET))
#define ATK_IS_STATE_SET(obj)                     (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_STATE_SET))
#define ATK_STATE_SET_CLASS(klass)                (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_STATE_SET, AtkStateSetClass))
#define ATK_STATE_SET(obj)                        (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_STATE_SET, AtkStateSet))
#define ATK_TYPE_STATE_SET                        (atk_state_set_get_type ())
#define ATK_SOCKET_GET_CLASS(obj)     (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_SOCKET, AtkSocketClass))
#define ATK_IS_SOCKET_CLASS(klass)    (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_SOCKET))
#define ATK_SOCKET_CLASS(klass)       (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_SOCKET, AtkSocketClass))
#define ATK_IS_SOCKET(obj)            (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_SOCKET))
#define ATK_SOCKET(obj)               (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_SOCKET, AtkSocket))
#define ATK_TYPE_SOCKET               (atk_socket_get_type ())
#define ATK_SELECTION_GET_IFACE(obj)              (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_SELECTION, AtkSelectionIface))
#define ATK_SELECTION(obj)                        G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_SELECTION, AtkSelection)
#define ATK_IS_SELECTION(obj)                     G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_SELECTION)
#define ATK_TYPE_SELECTION                        (atk_selection_get_type ())
#define ATK_RELATION_SET_GET_CLASS(obj)           (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_RELATION_SET, AtkRelationSetClass))
#define ATK_IS_RELATION_SET_CLASS(klass)          (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_RELATION_SET))
#define ATK_IS_RELATION_SET(obj)                  (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_RELATION_SET))
#define ATK_RELATION_SET_CLASS(klass)             (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_RELATION_SET, AtkRelationSetClass))
#define ATK_RELATION_SET(obj)                     (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_RELATION_SET, AtkRelationSet))
#define ATK_TYPE_RELATION_SET                     (atk_relation_set_get_type ())
#define ATK_RELATION_GET_CLASS(obj)               (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_RELATION, AtkRelationClass))
#define ATK_IS_RELATION_CLASS(klass)              (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_RELATION))
#define ATK_IS_RELATION(obj)                      (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_RELATION))
#define ATK_RELATION_CLASS(klass)                 (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_RELATION, AtkRelationClass))
#define ATK_RELATION(obj)                         (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_RELATION, AtkRelation))
#define ATK_TYPE_RELATION                         (atk_relation_get_type ())
#define ATK_REGISTRY_GET_CLASS(obj)      (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_REGISTRY, AtkRegistryClass))
#define ATK_IS_REGISTRY_CLASS(klass)     (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_REGISTRY))
#define ATK_IS_REGISTRY(obj)            (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_REGISTRY))
#define ATK_REGISTRY_CLASS(klass)       (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_REGISTRY, AtkRegistryClass))
#define ATK_REGISTRY(obj)                (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_REGISTRY, AtkRegistry))
#define ATK_TYPE_REGISTRY                (atk_registry_get_type ())
#define ATK_TYPE_RANGE         (atk_range_get_type ())
#define ATK_PLUG_GET_CLASS(obj)     (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_PLUG, AtkPlugClass))
#define ATK_IS_PLUG_CLASS(klass)    (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_PLUG))
#define ATK_PLUG_CLASS(klass)       (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_PLUG, AtkPlugClass))
#define ATK_IS_PLUG(obj)            (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_PLUG))
#define ATK_PLUG(obj)               (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_PLUG, AtkPlug))
#define ATK_TYPE_PLUG               (atk_plug_get_type ())
#define ATK_OBJECT_FACTORY_GET_CLASS(obj)           (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_OBJECT_FACTORY, AtkObjectFactoryClass))
#define ATK_IS_OBJECT_FACTORY_CLASS(klass)          (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_OBJECT_FACTORY))
#define ATK_IS_OBJECT_FACTORY(obj)                  (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_OBJECT_FACTORY))
#define ATK_OBJECT_FACTORY_CLASS(klass)             (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_OBJECT_FACTORY, AtkObjectFactoryClass))
#define ATK_OBJECT_FACTORY(obj)                     (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_OBJECT_FACTORY, AtkObjectFactory))
#define ATK_TYPE_OBJECT_FACTORY                     (atk_object_factory_get_type ())
#define ATK_IMPLEMENTOR_GET_IFACE(obj)            (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_IMPLEMENTOR, AtkImplementorIface))
#define ATK_IMPLEMENTOR(obj)                      G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_IMPLEMENTOR, AtkImplementor)
#define ATK_IS_IMPLEMENTOR(obj)                   G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_IMPLEMENTOR)
#define ATK_TYPE_IMPLEMENTOR                      (atk_implementor_get_type ())
#define ATK_OBJECT_GET_CLASS(obj)                 (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_OBJECT, AtkObjectClass))
#define ATK_IS_OBJECT_CLASS(klass)                (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_OBJECT))
#define ATK_IS_OBJECT(obj)                        (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_OBJECT))
#define ATK_OBJECT_CLASS(klass)                   (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_OBJECT, AtkObjectClass))
#define ATK_OBJECT(obj)                           (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_OBJECT, AtkObject))
#define ATK_TYPE_OBJECT                           (atk_object_get_type ())
#define ATK_NO_OP_OBJECT_FACTORY_GET_CLASS(obj)     (G_TYPE_INSTANCE_GET_CLASS ( (obj), ATK_TYPE_NO_OP_OBJECT_FACTORY, AtkNoOpObjectFactoryClass))
#define ATK_IS_NO_OP_OBJECT_FACTORY_CLASS(klass)    (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_NO_OP_OBJECT_FACTORY))
#define ATK_IS_NO_OP_OBJECT_FACTORY(obj)            (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_NO_OP_OBJECT_FACTORY))
#define ATK_NO_OP_OBJECT_FACTORY_CLASS(klass)       (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_NO_OP_OBJECT_FACTORY, AtkNoOpObjectFactoryClass))
#define ATK_NO_OP_OBJECT_FACTORY(obj)               (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_NO_OP_OBJECT_FACTORY, AtkNoOpObjectFactory))
#define ATK_TYPE_NO_OP_OBJECT_FACTORY                (atk_no_op_object_factory_get_type ())
#define ATK_NO_OP_OBJECT_GET_CLASS(obj)      (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_NO_OP_OBJECT, AtkNoOpObjectClass))
#define ATK_IS_NO_OP_OBJECT_CLASS(klass)     (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_NO_OP_OBJECT))
#define ATK_IS_NO_OP_OBJECT(obj)             (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_NO_OP_OBJECT))
#define ATK_NO_OP_OBJECT_CLASS(klass)        (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_NO_OP_OBJECT, AtkNoOpObjectClass))
#define ATK_NO_OP_OBJECT(obj)                (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_NO_OP_OBJECT, AtkNoOpObject))
#define ATK_TYPE_NO_OP_OBJECT                (atk_no_op_object_get_type ())
#define ATK_MISC_GET_CLASS(obj)                 (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_MISC, AtkMiscClass))
#define ATK_IS_MISC_CLASS(klass)                (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_MISC))
#define ATK_MISC_CLASS(klass)                   (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_MISC, AtkMiscClass))
#define ATK_MISC(obj)                   G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_MISC, AtkMisc)
#define ATK_IS_MISC(obj)                G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_MISC)
#define ATK_TYPE_MISC                   (atk_misc_get_type ())
#      define ATK_VAR extern
#define ATK_IMAGE_GET_IFACE(obj)         (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_IMAGE, AtkImageIface))
#define ATK_IMAGE(obj)                   G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_IMAGE, AtkImage)
#define ATK_IS_IMAGE(obj)                G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_IMAGE)
#define ATK_TYPE_IMAGE                   (atk_image_get_type ())
#define ATK_HYPERTEXT_GET_IFACE(obj)          (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_HYPERTEXT, AtkHypertextIface))
#define ATK_HYPERTEXT(obj)                    G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_HYPERTEXT, AtkHypertext)
#define ATK_IS_HYPERTEXT(obj)                 G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_HYPERTEXT)
#define ATK_TYPE_HYPERTEXT                    (atk_hypertext_get_type ())
#define ATK_HYPERLINK_IMPL_GET_IFACE(obj)   G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_HYPERLINK_IMPL, AtkHyperlinkImplIface)
#define ATK_HYPERLINK_IMPL(obj)             G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_HYPERLINK_IMPL, AtkHyperlinkImpl)
#define ATK_IS_HYPERLINK_IMPL(obj)       G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_HYPERLINK_IMPL)
#define ATK_TYPE_HYPERLINK_IMPL          (atk_hyperlink_impl_get_type ())
#define ATK_HYPERLINK_GET_CLASS(obj)              (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_HYPERLINK, AtkHyperlinkClass))
#define ATK_IS_HYPERLINK_CLASS(klass)             (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_HYPERLINK))
#define ATK_IS_HYPERLINK(obj)                     (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_HYPERLINK))
#define ATK_HYPERLINK_CLASS(klass)                (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_HYPERLINK, AtkHyperlinkClass))
#define ATK_HYPERLINK(obj)                        (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_HYPERLINK, AtkHyperlink))
#define ATK_TYPE_HYPERLINK                        (atk_hyperlink_get_type ())
#define ATK_GOBJECT_ACCESSIBLE_GET_CLASS(obj)  (G_TYPE_INSTANCE_GET_CLASS ((obj), ATK_TYPE_GOBJECT_ACCESSIBLE, AtkGObjectAccessibleClass))
#define ATK_IS_GOBJECT_ACCESSIBLE_CLASS(klass) (G_TYPE_CHECK_CLASS_TYPE ((klass), ATK_TYPE_GOBJECT_ACCESSIBLE))
#define ATK_IS_GOBJECT_ACCESSIBLE(obj)         (G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_GOBJECT_ACCESSIBLE))
#define ATK_GOBJECT_ACCESSIBLE_CLASS(klass)    (G_TYPE_CHECK_CLASS_CAST ((klass), ATK_TYPE_GOBJECT_ACCESSIBLE, AtkGObjectAccessibleClass))
#define ATK_GOBJECT_ACCESSIBLE(obj)            (G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_GOBJECT_ACCESSIBLE, AtkGObjectAccessible))
#define ATK_TYPE_GOBJECT_ACCESSIBLE            (atk_gobject_accessible_get_type ())
#define ATK_EDITABLE_TEXT_GET_IFACE(obj)          (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_EDITABLE_TEXT, AtkEditableTextIface))
#define ATK_EDITABLE_TEXT(obj)                    G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_EDITABLE_TEXT, AtkEditableText)
#define ATK_IS_EDITABLE_TEXT(obj)                 G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_EDITABLE_TEXT)
#define ATK_TYPE_EDITABLE_TEXT                    (atk_editable_text_get_type ())
#define ATK_DOCUMENT_GET_IFACE(obj)         (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_DOCUMENT, AtkDocumentIface))
#define ATK_DOCUMENT(obj)                   G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_DOCUMENT, AtkDocument)
#define ATK_IS_DOCUMENT(obj)                G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_DOCUMENT)
#define ATK_TYPE_DOCUMENT                   (atk_document_get_type ())
#define ATK_TYPE_RECTANGLE (atk_rectangle_get_type ())
#define ATK_COMPONENT_GET_IFACE(obj)          (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_COMPONENT, AtkComponentIface))
#define ATK_COMPONENT(obj)                    G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_COMPONENT, AtkComponent)
#define ATK_IS_COMPONENT(obj)                 G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_COMPONENT)
#define ATK_TYPE_COMPONENT                    (atk_component_get_type ())
#define ATK_ACTION_GET_IFACE(obj)          (G_TYPE_INSTANCE_GET_INTERFACE ((obj), ATK_TYPE_ACTION, AtkActionIface))
#define ATK_ACTION(obj)                    G_TYPE_CHECK_INSTANCE_CAST ((obj), ATK_TYPE_ACTION, AtkAction)
#define ATK_IS_ACTION(obj)                 G_TYPE_CHECK_INSTANCE_TYPE ((obj), ATK_TYPE_ACTION)
#define ATK_TYPE_ACTION                    (atk_action_get_type ())
typedef guint64      AtkState;
typedef GSList AtkAttributeSet;
typedef enum _AtkValueType AtkValueType;
typedef enum _AtkCoordType AtkCoordType;
typedef enum _AtkKeyEventType AtkKeyEventType;
typedef enum _AtkTextClipType AtkTextClipType;
typedef enum _AtkTextGranularity AtkTextGranularity;
typedef enum _AtkTextBoundary AtkTextBoundary;
typedef enum _AtkTextAttribute AtkTextAttribute;
typedef enum _AtkStateType AtkStateType;
typedef enum _AtkRelationType AtkRelationType;
typedef enum _AtkLayer AtkLayer;
typedef enum _AtkRole AtkRole;
typedef enum _AtkHyperlinkStateFlags AtkHyperlinkStateFlags;
typedef struct _AtkWindow AtkWindow;
typedef struct _AtkWindowIface AtkWindowIface;
typedef struct _AtkValue AtkValue;
typedef struct _AtkValueIface AtkValueIface;
typedef struct _AtkUtilClass AtkUtilClass;
typedef struct _AtkUtil AtkUtil;
typedef struct _AtkKeyEventStruct AtkKeyEventStruct;
typedef struct _AtkText AtkText;
typedef struct _AtkTextIface AtkTextIface;
typedef struct _AtkTextRange AtkTextRange;
typedef struct _AtkTextRectangle AtkTextRectangle;
typedef struct _AtkTableCell AtkTableCell;
typedef struct _AtkTableCellIface AtkTableCellIface;
typedef struct _AtkTable AtkTable;
typedef struct _AtkTableIface AtkTableIface;
typedef struct _AtkStreamableContent AtkStreamableContent;
typedef struct _AtkStreamableContentIface AtkStreamableContentIface;
typedef struct _AtkStateSetClass AtkStateSetClass;
typedef struct _AtkStateSet AtkStateSet;
typedef struct _AtkSocketClass AtkSocketClass;
typedef struct _AtkSocket AtkSocket;
typedef struct _AtkSelection AtkSelection;
typedef struct _AtkSelectionIface AtkSelectionIface;
typedef struct _AtkRelationSetClass AtkRelationSetClass;
typedef struct _AtkRelationSet AtkRelationSet;
typedef struct _AtkRelationClass AtkRelationClass;
typedef struct _AtkRelation AtkRelation;
typedef struct _AtkRegistryClass AtkRegistryClass;
typedef struct _AtkRegistry AtkRegistry;
typedef struct _AtkRegistryClass AtkRegistryClass;
typedef struct _AtkRegistry AtkRegistry;
typedef struct _AtkRange AtkRange;
typedef struct _AtkPlugClass AtkPlugClass;
typedef struct _AtkPlug AtkPlug;
typedef struct _AtkObjectFactoryClass AtkObjectFactoryClass;
typedef struct _AtkObjectFactory AtkObjectFactory;
typedef struct _AtkStateSet AtkStateSet;
typedef struct _AtkRelationSet AtkRelationSet;
typedef struct _AtkPropertyValues AtkPropertyValues;
typedef struct _AtkImplementor AtkImplementor;
typedef struct _AtkImplementorIface AtkImplementorIface;
typedef struct _AtkObjectClass AtkObjectClass;
typedef struct _AtkObject AtkObject;
typedef struct _AtkPropertyValues AtkPropertyValues;
typedef struct _AtkAttribute AtkAttribute;
typedef struct _AtkNoOpObjectFactoryClass AtkNoOpObjectFactoryClass;
typedef struct _AtkNoOpObjectFactory AtkNoOpObjectFactory;
typedef struct _AtkNoOpObjectClass AtkNoOpObjectClass;
typedef struct _AtkNoOpObject AtkNoOpObject;
typedef struct _AtkMiscClass AtkMiscClass;
typedef struct _AtkMisc AtkMisc;
typedef struct _AtkImage AtkImage;
typedef struct _AtkImageIface AtkImageIface;
typedef struct _AtkHypertext AtkHypertext;
typedef struct _AtkHypertextIface AtkHypertextIface;
typedef struct _AtkHyperlinkImpl AtkHyperlinkImpl;
typedef struct _AtkHyperlinkImplIface AtkHyperlinkImplIface;
typedef struct _AtkHyperlinkClass AtkHyperlinkClass;
typedef struct _AtkHyperlink AtkHyperlink;
typedef struct _AtkGObjectAccessibleClass AtkGObjectAccessibleClass;
typedef struct _AtkGObjectAccessible AtkGObjectAccessible;
typedef struct _AtkEditableText AtkEditableText;
typedef struct _AtkEditableTextIface AtkEditableTextIface;
typedef struct _AtkDocument AtkDocument;
typedef struct _AtkDocumentIface AtkDocumentIface;
typedef struct _AtkComponent AtkComponent;
typedef struct _AtkComponentIface AtkComponentIface;
typedef struct _AtkRectangle AtkRectangle;
typedef struct _AtkAction AtkAction;
typedef struct _AtkActionIface AtkActionIface;
typedef gint (*AtkKeySnoopFunc) (AtkKeyEventStruct *event,
				   gpointer user_data);
typedef void (*AtkEventListenerInit) (void);
typedef void (*AtkEventListener) (AtkObject* obj);
typedef void (*AtkPropertyChangeHandler) (AtkObject* obj, AtkPropertyValues* vals);
typedef gboolean (*AtkFunction) (gpointer user_data);
typedef void (*AtkFocusHandler) (AtkObject* object, gboolean focus_in);
typedef enum
{
  ATK_VALUE_VERY_WEAK,
  ATK_VALUE_WEAK,
  ATK_VALUE_ACCEPTABLE,
  ATK_VALUE_STRONG,
  ATK_VALUE_VERY_STRONG,
  ATK_VALUE_VERY_LOW,
  ATK_VALUE_LOW,
  ATK_VALUE_MEDIUM,
  ATK_VALUE_HIGH,
  ATK_VALUE_VERY_HIGH,
  ATK_VALUE_VERY_BAD,
  ATK_VALUE_BAD,
  ATK_VALUE_GOOD,
  ATK_VALUE_VERY_GOOD,
  ATK_VALUE_BEST,
  ATK_VALUE_LAST_DEFINED
}AtkValueType;
typedef enum {
  ATK_XY_SCREEN,
  ATK_XY_WINDOW
}AtkCoordType;
typedef enum
{
  ATK_KEY_EVENT_PRESS,
  ATK_KEY_EVENT_RELEASE,
  ATK_KEY_EVENT_LAST_DEFINED
} AtkKeyEventType;
typedef enum {
    ATK_TEXT_CLIP_NONE,
    ATK_TEXT_CLIP_MIN,
    ATK_TEXT_CLIP_MAX,
    ATK_TEXT_CLIP_BOTH
} AtkTextClipType;
typedef enum {
  ATK_TEXT_GRANULARITY_CHAR,
  ATK_TEXT_GRANULARITY_WORD,
  ATK_TEXT_GRANULARITY_SENTENCE,
  ATK_TEXT_GRANULARITY_LINE,
  ATK_TEXT_GRANULARITY_PARAGRAPH
} AtkTextGranularity;
typedef enum {
  ATK_TEXT_BOUNDARY_CHAR,
  ATK_TEXT_BOUNDARY_WORD_START,
  ATK_TEXT_BOUNDARY_WORD_END,
  ATK_TEXT_BOUNDARY_SENTENCE_START,
  ATK_TEXT_BOUNDARY_SENTENCE_END,
  ATK_TEXT_BOUNDARY_LINE_START,
  ATK_TEXT_BOUNDARY_LINE_END
} AtkTextBoundary;
typedef enum
{
  ATK_TEXT_ATTR_INVALID = 0,
  ATK_TEXT_ATTR_LEFT_MARGIN,
  ATK_TEXT_ATTR_RIGHT_MARGIN,
  ATK_TEXT_ATTR_INDENT,
  ATK_TEXT_ATTR_INVISIBLE,
  ATK_TEXT_ATTR_EDITABLE,
  ATK_TEXT_ATTR_PIXELS_ABOVE_LINES,
  ATK_TEXT_ATTR_PIXELS_BELOW_LINES,
  ATK_TEXT_ATTR_PIXELS_INSIDE_WRAP,
  ATK_TEXT_ATTR_BG_FULL_HEIGHT,
  ATK_TEXT_ATTR_RISE,
  ATK_TEXT_ATTR_UNDERLINE,
  ATK_TEXT_ATTR_STRIKETHROUGH,
  ATK_TEXT_ATTR_SIZE,
  ATK_TEXT_ATTR_SCALE,
  ATK_TEXT_ATTR_WEIGHT,
  ATK_TEXT_ATTR_LANGUAGE,
  ATK_TEXT_ATTR_FAMILY_NAME,
  ATK_TEXT_ATTR_BG_COLOR,
  ATK_TEXT_ATTR_FG_COLOR,
  ATK_TEXT_ATTR_BG_STIPPLE,
  ATK_TEXT_ATTR_FG_STIPPLE,
  ATK_TEXT_ATTR_WRAP_MODE,
  ATK_TEXT_ATTR_DIRECTION,
  ATK_TEXT_ATTR_JUSTIFICATION,
  ATK_TEXT_ATTR_STRETCH,
  ATK_TEXT_ATTR_VARIANT,
  ATK_TEXT_ATTR_STYLE,
  ATK_TEXT_ATTR_LAST_DEFINED
} AtkTextAttribute;
typedef enum
{
  ATK_STATE_INVALID,
  ATK_STATE_ACTIVE,
  ATK_STATE_ARMED,
  ATK_STATE_BUSY,
  ATK_STATE_CHECKED,
  ATK_STATE_DEFUNCT,
  ATK_STATE_EDITABLE,
  ATK_STATE_ENABLED,
  ATK_STATE_EXPANDABLE,
  ATK_STATE_EXPANDED,
  ATK_STATE_FOCUSABLE,
  ATK_STATE_FOCUSED,
  ATK_STATE_HORIZONTAL,
  ATK_STATE_ICONIFIED,
  ATK_STATE_MODAL,
  ATK_STATE_MULTI_LINE,
  ATK_STATE_MULTISELECTABLE,
  ATK_STATE_OPAQUE,
  ATK_STATE_PRESSED,
  ATK_STATE_RESIZABLE,
  ATK_STATE_SELECTABLE,
  ATK_STATE_SELECTED,
  ATK_STATE_SENSITIVE,
  ATK_STATE_SHOWING,
  ATK_STATE_SINGLE_LINE,
  ATK_STATE_STALE,
  ATK_STATE_TRANSIENT,
  ATK_STATE_VERTICAL,
  ATK_STATE_VISIBLE,
  ATK_STATE_MANAGES_DESCENDANTS,
  ATK_STATE_INDETERMINATE,
  ATK_STATE_TRUNCATED,
  ATK_STATE_REQUIRED,
  ATK_STATE_INVALID_ENTRY,
  ATK_STATE_SUPPORTS_AUTOCOMPLETION,
  ATK_STATE_SELECTABLE_TEXT,
  ATK_STATE_DEFAULT,
  ATK_STATE_ANIMATED,
  ATK_STATE_VISITED,
  ATK_STATE_CHECKABLE,
  ATK_STATE_HAS_POPUP,
  ATK_STATE_HAS_TOOLTIP,
  ATK_STATE_READ_ONLY,
  ATK_STATE_LAST_DEFINED
} AtkStateType;
typedef enum
{
  ATK_RELATION_NULL = 0,
  ATK_RELATION_CONTROLLED_BY,
  ATK_RELATION_CONTROLLER_FOR,
  ATK_RELATION_LABEL_FOR,
  ATK_RELATION_LABELLED_BY,
  ATK_RELATION_MEMBER_OF,
  ATK_RELATION_NODE_CHILD_OF,
  ATK_RELATION_FLOWS_TO,
  ATK_RELATION_FLOWS_FROM,
  ATK_RELATION_SUBWINDOW_OF, 
  ATK_RELATION_EMBEDS, 
  ATK_RELATION_EMBEDDED_BY, 
  ATK_RELATION_POPUP_FOR, 
  ATK_RELATION_PARENT_WINDOW_OF, 
  ATK_RELATION_DESCRIBED_BY,
  ATK_RELATION_DESCRIPTION_FOR,
  ATK_RELATION_NODE_PARENT_OF,
  ATK_RELATION_DETAILS,
  ATK_RELATION_DETAILS_FOR,
  ATK_RELATION_ERROR_MESSAGE,
  ATK_RELATION_ERROR_FOR,
  ATK_RELATION_LAST_DEFINED
} AtkRelationType;
typedef enum
{
  ATK_LAYER_INVALID,
  ATK_LAYER_BACKGROUND,
  ATK_LAYER_CANVAS,
  ATK_LAYER_WIDGET,
  ATK_LAYER_MDI,
  ATK_LAYER_POPUP,
  ATK_LAYER_OVERLAY,
  ATK_LAYER_WINDOW
} AtkLayer;
typedef enum
{
  ATK_ROLE_INVALID = 0,
  ATK_ROLE_ACCEL_LABEL,      /*<nick=accelerator-label>*/
  ATK_ROLE_ALERT,
  ATK_ROLE_ANIMATION,
  ATK_ROLE_ARROW,
  ATK_ROLE_CALENDAR,
  ATK_ROLE_CANVAS,
  ATK_ROLE_CHECK_BOX,
  ATK_ROLE_CHECK_MENU_ITEM,
  ATK_ROLE_COLOR_CHOOSER,
  ATK_ROLE_COLUMN_HEADER,
  ATK_ROLE_COMBO_BOX,
  ATK_ROLE_DATE_EDITOR,
  ATK_ROLE_DESKTOP_ICON,
  ATK_ROLE_DESKTOP_FRAME,
  ATK_ROLE_DIAL,
  ATK_ROLE_DIALOG,
  ATK_ROLE_DIRECTORY_PANE,
  ATK_ROLE_DRAWING_AREA,
  ATK_ROLE_FILE_CHOOSER,
  ATK_ROLE_FILLER,
  ATK_ROLE_FONT_CHOOSER,
  ATK_ROLE_FRAME,
  ATK_ROLE_GLASS_PANE,
  ATK_ROLE_HTML_CONTAINER,
  ATK_ROLE_ICON,
  ATK_ROLE_IMAGE,
  ATK_ROLE_INTERNAL_FRAME,
  ATK_ROLE_LABEL,
  ATK_ROLE_LAYERED_PANE,
  ATK_ROLE_LIST,
  ATK_ROLE_LIST_ITEM,
  ATK_ROLE_MENU,
  ATK_ROLE_MENU_BAR,
  ATK_ROLE_MENU_ITEM,
  ATK_ROLE_OPTION_PANE,
  ATK_ROLE_PAGE_TAB,
  ATK_ROLE_PAGE_TAB_LIST,
  ATK_ROLE_PANEL,
  ATK_ROLE_PASSWORD_TEXT,
  ATK_ROLE_POPUP_MENU,
  ATK_ROLE_PROGRESS_BAR,
  ATK_ROLE_PUSH_BUTTON,
  ATK_ROLE_RADIO_BUTTON,
  ATK_ROLE_RADIO_MENU_ITEM,
  ATK_ROLE_ROOT_PANE,
  ATK_ROLE_ROW_HEADER,
  ATK_ROLE_SCROLL_BAR,
  ATK_ROLE_SCROLL_PANE,
  ATK_ROLE_SEPARATOR,
  ATK_ROLE_SLIDER,
  ATK_ROLE_SPLIT_PANE,
  ATK_ROLE_SPIN_BUTTON,
  ATK_ROLE_STATUSBAR,
  ATK_ROLE_TABLE,
  ATK_ROLE_TABLE_CELL,
  ATK_ROLE_TABLE_COLUMN_HEADER,
  ATK_ROLE_TABLE_ROW_HEADER,
  ATK_ROLE_TEAR_OFF_MENU_ITEM,
  ATK_ROLE_TERMINAL,
  ATK_ROLE_TEXT,
  ATK_ROLE_TOGGLE_BUTTON,
  ATK_ROLE_TOOL_BAR,
  ATK_ROLE_TOOL_TIP,
  ATK_ROLE_TREE,
  ATK_ROLE_TREE_TABLE,
  ATK_ROLE_UNKNOWN,
  ATK_ROLE_VIEWPORT,
  ATK_ROLE_WINDOW,
  ATK_ROLE_HEADER,
  ATK_ROLE_FOOTER,
  ATK_ROLE_PARAGRAPH,
  ATK_ROLE_RULER,
  ATK_ROLE_APPLICATION,
  ATK_ROLE_AUTOCOMPLETE,
  ATK_ROLE_EDITBAR,          /*<nick=edit-bar>*/
  ATK_ROLE_EMBEDDED,
  ATK_ROLE_ENTRY,
  ATK_ROLE_CHART,
  ATK_ROLE_CAPTION,
  ATK_ROLE_DOCUMENT_FRAME,
  ATK_ROLE_HEADING,
  ATK_ROLE_PAGE,
  ATK_ROLE_SECTION,
  ATK_ROLE_REDUNDANT_OBJECT,
  ATK_ROLE_FORM,
  ATK_ROLE_LINK,
  ATK_ROLE_INPUT_METHOD_WINDOW,
  ATK_ROLE_TABLE_ROW,
  ATK_ROLE_TREE_ITEM,
  ATK_ROLE_DOCUMENT_SPREADSHEET,
  ATK_ROLE_DOCUMENT_PRESENTATION,
  ATK_ROLE_DOCUMENT_TEXT,
  ATK_ROLE_DOCUMENT_WEB,
  ATK_ROLE_DOCUMENT_EMAIL,
  ATK_ROLE_COMMENT,
  ATK_ROLE_LIST_BOX,
  ATK_ROLE_GROUPING,
  ATK_ROLE_IMAGE_MAP,
  ATK_ROLE_NOTIFICATION,
  ATK_ROLE_INFO_BAR,
  ATK_ROLE_LEVEL_BAR,
  ATK_ROLE_TITLE_BAR,
  ATK_ROLE_BLOCK_QUOTE,
  ATK_ROLE_AUDIO,
  ATK_ROLE_VIDEO,
  ATK_ROLE_DEFINITION,
  ATK_ROLE_ARTICLE,
  ATK_ROLE_LANDMARK,
  ATK_ROLE_LOG,
  ATK_ROLE_MARQUEE,
  ATK_ROLE_MATH,
  ATK_ROLE_RATING,
  ATK_ROLE_TIMER,
  ATK_ROLE_DESCRIPTION_LIST,
  ATK_ROLE_DESCRIPTION_TERM,
  ATK_ROLE_DESCRIPTION_VALUE,
  ATK_ROLE_STATIC,
  ATK_ROLE_MATH_FRACTION,
  ATK_ROLE_MATH_ROOT,
  ATK_ROLE_SUBSCRIPT,
  ATK_ROLE_SUPERSCRIPT,
  ATK_ROLE_FOOTNOTE,
  ATK_ROLE_LAST_DEFINED
} AtkRole;
typedef enum 
{
  ATK_HYPERLINK_IS_INLINE = 1 << 0
} AtkHyperlinkStateFlags;

struct _AtkWindowIface
{
  GTypeInterface parent;
};

struct _AtkValueIface
{
  GTypeInterface parent;

  /*<deprecated>*/
  void     (* get_current_value) (AtkValue     *obj,
                                  GValue       *value);
  void     (* get_maximum_value) (AtkValue     *obj,
                                  GValue       *value);
  void     (* get_minimum_value) (AtkValue     *obj,
                                  GValue       *value);
  gboolean (* set_current_value) (AtkValue     *obj,
                                  const GValue *value);
  void     (* get_minimum_increment) (AtkValue   *obj,
				      GValue     *value);
  /*</deprecated>*/
  void     (* get_value_and_text) (AtkValue *obj,
                                   gdouble *value,
                                   gchar  **text);
  AtkRange*(* get_range)          (AtkValue *obj);
  gdouble  (* get_increment)      (AtkValue *obj);
  GSList*  (* get_sub_ranges)     (AtkValue *obj);
  void     (* set_value)          (AtkValue     *obj,
                                   const gdouble new_value);

};
struct _AtkUtilClass
{
   GObjectClass parent;
   guint        (* add_global_event_listener)    (GSignalEmissionHook listener,
						  const gchar        *event_type);
   void         (* remove_global_event_listener) (guint               listener_id);
   guint	(* add_key_event_listener) 	 (AtkKeySnoopFunc     listener,
						  gpointer data);
   void         (* remove_key_event_listener)    (guint               listener_id);
   AtkObject*   (* get_root)                     (void);
   const gchar* (* get_toolkit_name)             (void);
   const gchar* (* get_toolkit_version)          (void);
};
struct _AtkUtil
{
  GObject parent;
};
struct _AtkKeyEventStruct {
  gint type;
  guint state;
  guint keyval;
  gint length;
  gchar *string;
  guint16 keycode;
  guint32 timestamp;	
};

struct _AtkTextIface
{
  GTypeInterface parent;

  gchar*         (* get_text)                     (AtkText          *text,
                                                   gint             start_offset,
                                                   gint             end_offset);
  gchar*         (* get_text_after_offset)        (AtkText          *text,
                                                   gint             offset,
                                                   AtkTextBoundary  boundary_type,
						   gint             *start_offset,
						   gint             *end_offset);
  gchar*         (* get_text_at_offset)           (AtkText          *text,
                                                   gint             offset,
                                                   AtkTextBoundary  boundary_type,
						   gint             *start_offset,
						   gint             *end_offset);
  gunichar       (* get_character_at_offset)      (AtkText          *text,
                                                   gint             offset);
  gchar*         (* get_text_before_offset)       (AtkText          *text,
                                                   gint             offset,
                                                   AtkTextBoundary  boundary_type,
 						   gint             *start_offset,
						   gint             *end_offset);
  gint           (* get_caret_offset)             (AtkText          *text);
  AtkAttributeSet* (* get_run_attributes)         (AtkText	    *text,
						   gint	  	    offset,
						   gint             *start_offset,
						   gint	 	    *end_offset);
  AtkAttributeSet* (* get_default_attributes)     (AtkText	    *text);
  void           (* get_character_extents)        (AtkText          *text,
                                                   gint             offset,
                                                   gint             *x,
                                                   gint             *y,
                                                   gint             *width,
                                                   gint             *height,
                                                   AtkCoordType	    coords);
  gint           (* get_character_count)          (AtkText          *text);
  gint           (* get_offset_at_point)          (AtkText          *text,
                                                   gint             x,
                                                   gint             y,
                                                   AtkCoordType	    coords);
  gint		 (* get_n_selections)		  (AtkText          *text);
  gchar*         (* get_selection)	          (AtkText          *text,
						   gint		    selection_num,
						   gint		    *start_offset,
						   gint		    *end_offset);
  gboolean       (* add_selection)		  (AtkText          *text,
						   gint		    start_offset,
						   gint		    end_offset);
  gboolean       (* remove_selection)		  (AtkText          *text,
						   gint             selection_num);
  gboolean       (* set_selection)		  (AtkText          *text,
						   gint		    selection_num,
						   gint		    start_offset,
						   gint		    end_offset);
  gboolean       (* set_caret_offset)             (AtkText          *text,
                                                   gint             offset);

  /*
   * signal handlers
   */
  void		 (* text_changed)                 (AtkText          *text,
                                                   gint             position,
                                                   gint             length);
  void           (* text_caret_moved)             (AtkText          *text,
                                                   gint             location);
  void           (* text_selection_changed)       (AtkText          *text);

  void           (* text_attributes_changed)      (AtkText          *text);


  void           (* get_range_extents)            (AtkText          *text,
                                                   gint             start_offset,
                                                   gint             end_offset,
                                                   AtkCoordType     coord_type,
                                                   AtkTextRectangle *rect);

  AtkTextRange** (* get_bounded_ranges)           (AtkText          *text,
                                                   AtkTextRectangle *rect,
                                                   AtkCoordType     coord_type,
                                                   AtkTextClipType  x_clip_type,
                                                   AtkTextClipType  y_clip_type);

  gchar*         (* get_string_at_offset)         (AtkText            *text,
                                                   gint               offset,
                                                   AtkTextGranularity granularity,
                                                   gint               *start_offset,
                                                   gint               *end_offset);
};
struct _AtkTextRange {
  AtkTextRectangle bounds;
  gint start_offset;
  gint end_offset;
  gchar* content;
};
struct _AtkTextRectangle {
  gint x;
  gint y;
  gint width;
  gint height;
};

struct _AtkTableCellIface
{
  GTypeInterface parent;

  gint          (*get_column_span)         (AtkTableCell *cell);
  GPtrArray *   (*get_column_header_cells) (AtkTableCell *cell);
  gboolean      (*get_position)            (AtkTableCell *cell,
                                            gint         *row,
                                            gint         *column);
  gint          (*get_row_span)            (AtkTableCell *cell);
  GPtrArray *   (*get_row_header_cells)    (AtkTableCell *cell);
  gboolean      (*get_row_column_span)     (AtkTableCell *cell,
                                            gint         *row,
                                            gint         *column,
                                            gint         *row_span,
                                            gint         *column_span);
  AtkObject *   (*get_table)               (AtkTableCell *cell);
};

struct _AtkTableIface
{
  GTypeInterface parent;

  AtkObject*        (* ref_at)                   (AtkTable      *table,
                                                  gint          row,
                                                  gint          column);
  gint              (* get_index_at)             (AtkTable      *table,
                                                  gint          row,
                                                  gint          column);
  gint              (* get_column_at_index)      (AtkTable      *table,
                                                  gint          index_);
  gint              (* get_row_at_index)         (AtkTable      *table,
                                                  gint          index_);
  gint              (* get_n_columns)           (AtkTable      *table);
  gint              (* get_n_rows)               (AtkTable      *table);
  gint              (* get_column_extent_at)     (AtkTable      *table,
                                                  gint          row,
                                                  gint          column);
  gint              (* get_row_extent_at)        (AtkTable      *table,
                                                  gint          row,
                                                  gint          column);
  AtkObject*
                    (* get_caption)              (AtkTable      *table);
  const gchar*      (* get_column_description)   (AtkTable      *table,
                                                  gint          column);
  AtkObject*        (* get_column_header)        (AtkTable      *table,
						  gint		column);
  const gchar*      (* get_row_description)      (AtkTable      *table,
                                                  gint          row);
  AtkObject*        (* get_row_header)           (AtkTable      *table,
						  gint		row);
  AtkObject*        (* get_summary)              (AtkTable      *table);
  void              (* set_caption)              (AtkTable      *table,
                                                  AtkObject     *caption);
  void              (* set_column_description)   (AtkTable      *table,
                                                  gint          column,
                                                  const gchar   *description);
  void              (* set_column_header)        (AtkTable      *table,
                                                  gint          column,
                                                  AtkObject     *header);
  void              (* set_row_description)      (AtkTable      *table,
                                                  gint          row,
                                                  const gchar   *description);
  void              (* set_row_header)           (AtkTable      *table,
                                                  gint          row,
                                                  AtkObject     *header);
  void              (* set_summary)              (AtkTable      *table,
                                                  AtkObject     *accessible);
  gint              (* get_selected_columns)     (AtkTable      *table,
                                                  gint          **selected);
  gint              (* get_selected_rows)        (AtkTable      *table,
                                                  gint          **selected);
  gboolean          (* is_column_selected)       (AtkTable      *table,
                                                  gint          column);
  gboolean          (* is_row_selected)          (AtkTable      *table,
                                                  gint          row);
  gboolean          (* is_selected)              (AtkTable      *table,
                                                  gint          row,
                                                  gint          column);
  gboolean          (* add_row_selection)        (AtkTable      *table,
                                                  gint          row);
  gboolean          (* remove_row_selection)     (AtkTable      *table,
                                                  gint          row);
  gboolean          (* add_column_selection)     (AtkTable      *table,
                                                  gint          column);
  gboolean          (* remove_column_selection)  (AtkTable      *table,
                                                  gint          column);

  /*
   * signal handlers
   */
  void              (* row_inserted)             (AtkTable      *table,
                                                  gint          row,
                                                  gint          num_inserted);
  void              (* column_inserted)          (AtkTable      *table,
                                                  gint          column,
                                                  gint          num_inserted);
  void              (* row_deleted)              (AtkTable      *table,
                                                  gint          row,
                                                  gint          num_deleted);
  void              (* column_deleted)           (AtkTable      *table,
                                                  gint          column,
                                                  gint          num_deleted);
  void              (* row_reordered)            (AtkTable      *table);
  void              (* column_reordered)         (AtkTable      *table);
  void              (* model_changed)            (AtkTable      *table);
};

struct _AtkStreamableContentIface
{
  GTypeInterface parent;

  /*
   * Get the number of mime types supported by this object
   */
  gint                      (* get_n_mime_types)  (AtkStreamableContent     *streamable);
  /*
   * Gets the specified mime type supported by this object.
   * The mime types are 0-based so the first mime type is 
   * at index 0, the second at index 1 and so on.  The mime-type
   * at index 0 should be considered the "default" data type for the stream.
   *
   * This assumes that the strings for the mime types are stored in the
   * AtkStreamableContent. Alternatively the const could be removed
   * and the caller would be responsible for calling g_free() on the
   * returned value.
   */
  const gchar*              (* get_mime_type)     (AtkStreamableContent     *streamable,
                                                   gint                     i);
  /*
   * One possible implementation for this method is that it constructs the
   * content appropriate for the mime type and then creates a temporary
   * file containing the content, opens the file and then calls
   * g_io_channel_unix_new_fd().
   */
  GIOChannel*               (* get_stream)        (AtkStreamableContent     *streamable,
                                                   const gchar              *mime_type);

/*
 * Returns a string representing a URI in IETF standard format
 * (see http://www.ietf.org/rfc/rfc2396.txt) from which the object's content
 * may be streamed in the specified mime-type.
 * If mime_type is NULL, the URI for the default (and possibly only) mime-type is
 * returned.
 *
 * returns NULL if the mime-type is not supported, or if no URI can be 
 * constructed.  Note that it is possible for get_uri to return NULL but for
 * get_stream to work nonetheless, since not all GIOChannels connect to URIs.
 */
    const  gchar*           (* get_uri)           (AtkStreamableContent     *streamable,
                                                   const gchar              *mime_type);


  AtkFunction               pad1;
  AtkFunction               pad2;
  AtkFunction               pad3;
};
struct _AtkStateSetClass
{
  GObjectClass parent;
};
struct _AtkStateSet
{
  GObject parent;

};
struct _AtkSocketClass
{
  AtkObjectClass parent_class;
  
  /* to be subscribed to by atk-bridge */

  /*< protected >*/
  void (* embed) (AtkSocket *obj, gchar* plug_id);
};
struct _AtkSocket
{
  AtkObject parent;

  /*< private >*/
  gchar* embedded_plug_id;
};

struct _AtkSelectionIface
{
  GTypeInterface parent;

  gboolean     (* add_selection)        (AtkSelection   *selection,
                                         gint           i);
  gboolean     (* clear_selection)      (AtkSelection   *selection);
  AtkObject*   (* ref_selection)        (AtkSelection   *selection,
                                         gint           i);
  gint         (* get_selection_count)  (AtkSelection   *selection);
  gboolean     (* is_child_selected)    (AtkSelection   *selection,
                                         gint           i);
  gboolean     (* remove_selection)     (AtkSelection   *selection,
                                         gint           i);
  gboolean     (* select_all_selection) (AtkSelection   *selection);

  /* signal handlers */
  
  void         (*selection_changed)     (AtkSelection   *selection);
};
struct _AtkRelationSetClass
{
  GObjectClass parent;

  AtkFunction pad1;
  AtkFunction pad2;
};
struct _AtkRelationSet
{
  GObject parent;

  GPtrArray *relations;
};
struct _AtkRelationClass
{
  GObjectClass parent;
};
struct _AtkRelation
{
  GObject parent;

  GPtrArray       *target;
  AtkRelationType relationship;
};


struct _AtkRegistryClass
{
  GObjectClass    parent_class;
};
struct _AtkRegistry
{
  GObject    parent;
  GHashTable *factory_type_registry;
  GHashTable *factory_singleton_cache;
};

struct _AtkPlugClass
{
  AtkObjectClass parent_class;
  
  /* to be subscribed to by atk-bridge */

  /*< protected >*/
  gchar* (* get_object_id) (AtkPlug* obj);
};
struct _AtkPlug
{
  AtkObject parent;
};
struct _AtkObjectFactoryClass
{
  GObjectClass parent_class;

  AtkObject* (* create_accessible) (GObject          *obj);
  void       (* invalidate)        (AtkObjectFactory *factory);
  GType      (* get_accessible_type)    (void);

  AtkFunction pad1;
  AtkFunction pad2;
};
struct _AtkObjectFactory
{
  GObject parent;
};




struct _AtkImplementorIface
{
  GTypeInterface parent;

  AtkObject*   (*ref_accessible) (AtkImplementor *implementor);
};
struct _AtkObjectClass
{
  GObjectClass parent;

  /*
   * Gets the accessible name of the object
   */
  const gchar*             (* get_name)            (AtkObject                *accessible);
  /*
   * Gets the accessible description of the object
   */
  const gchar*             (* get_description)     (AtkObject                *accessible);
  /*
   * Gets the accessible parent of the object
   */
  AtkObject*               (*get_parent)           (AtkObject                *accessible);

  /*
   * Gets the number of accessible children of the object
   */
  gint                    (* get_n_children)       (AtkObject                *accessible);
  /*
   * Returns a reference to the specified accessible child of the object.
   * The accessible children are 0-based so the first accessible child is
   * at index 0, the second at index 1 and so on.
   */
  AtkObject*              (* ref_child)            (AtkObject                *accessible,
                                                    gint                      i);
  /*
   * Gets the 0-based index of this object in its parent; returns -1 if the
   * object does not have an accessible parent.
   */
  gint                    (* get_index_in_parent) (AtkObject                 *accessible);
  /*
   * Gets the RelationSet associated with the object
   */
  AtkRelationSet*         (* ref_relation_set)    (AtkObject                 *accessible);
  /*
   * Gets the role of the object
   */
  AtkRole                 (* get_role)            (AtkObject                 *accessible);
  AtkLayer                (* get_layer)           (AtkObject                 *accessible);
  gint                    (* get_mdi_zorder)      (AtkObject                 *accessible);
  /*
   * Gets the state set of the object
   */
  AtkStateSet*            (* ref_state_set)       (AtkObject                 *accessible);
  /*
   * Sets the accessible name of the object
   */
  void                    (* set_name)            (AtkObject                 *accessible,
                                                   const gchar               *name);
  /*
   * Sets the accessible description of the object
   */
  void                    (* set_description)     (AtkObject                 *accessible,
                                                   const gchar               *description);
  /*
   * Sets the accessible parent of the object
   */
  void                    (* set_parent)          (AtkObject                 *accessible,
                                                   AtkObject                 *parent);
  /*
   * Sets the accessible role of the object
   */
  void                    (* set_role)            (AtkObject                 *accessible,
                                                   AtkRole                   role);
  /*
   * Specifies a function to be called when a property changes value
   */
guint                     (* connect_property_change_handler)    (AtkObject
                 *accessible,
                                                                  AtkPropertyChangeHandler       *handler);
  /*
   * Removes a property change handler which was specified using
   * connect_property_change_handler
   */
void                      (* remove_property_change_handler)     (AtkObject
                *accessible,
                                                                  guint
                handler_id);
void                      (* initialize)                         (AtkObject                     *accessible,
                                                                  gpointer                      data);
  /*
   * The signal handler which is executed when there is a change in the
   * children of the object
   */
  void                    (* children_changed)    (AtkObject                  *accessible,
                                                   guint                      change_index,
                                                   gpointer                   changed_child);
  /*
   * The signal handler which is executed  when there is a focus event
   * for an object.
   */
  void                    (* focus_event)         (AtkObject                  *accessible,
                                                   gboolean                   focus_in);
  /*
   * The signal handler which is executed  when there is a property_change 
   * signal for an object.
   */
  void                    (* property_change)     (AtkObject                  *accessible,
                                                   AtkPropertyValues          *values);
  /*
   * The signal handler which is executed  when there is a state_change 
   * signal for an object.
   */
  void                    (* state_change)        (AtkObject                  *accessible,
                                                   const gchar                *name,
                                                   gboolean                   state_set);
  /*
   * The signal handler which is executed when there is a change in the
   * visible data for an object
   */
  void                    (*visible_data_changed) (AtkObject                  *accessible);

  /*
   * The signal handler which is executed when there is a change in the
   * 'active' child or children of the object, for instance when 
   * interior focus changes in a table or list.  This signal should be emitted
   * by objects whose state includes ATK_STATE_MANAGES_DESCENDANTS.
   */
  void                    (*active_descendant_changed) (AtkObject                  *accessible,
                                                        gpointer                   *child);

  /*    	
   * Gets a list of properties applied to this object as a whole, as an #AtkAttributeSet consisting of name-value pairs. 
   * Since ATK 1.12
   */
  AtkAttributeSet* 	  (*get_attributes)            (AtkObject                  *accessible);

  const gchar*            (*get_object_locale)         (AtkObject                  *accessible);

  AtkFunction             pad1;
};
struct _AtkObject
{
  GObject parent;

  gchar *description;
  gchar *name;
  AtkObject *accessible_parent;
  AtkRole role;
  AtkRelationSet *relation_set;
  AtkLayer layer;
};
struct _AtkPropertyValues
{
  const gchar  *property_name;
  GValue old_value;
  GValue new_value;
};
struct _AtkAttribute {
  gchar* name;
  gchar* value;
};
struct _AtkNoOpObjectFactoryClass
{
  AtkObjectFactoryClass parent_class;
};
struct _AtkNoOpObjectFactory
{
  AtkObjectFactory parent;
};
struct _AtkNoOpObjectClass
{
  AtkObjectClass parent_class;
};
struct _AtkNoOpObject
{
  AtkObject     parent;
};
struct _AtkMiscClass
{
   GObjectClass parent;
   void   (* threads_enter)                     (AtkMisc *misc);
   void   (* threads_leave)                     (AtkMisc *misc);
   gpointer vfuncs[32]; /* future bincompat */
};
struct _AtkMisc
{
  GObject parent;
};

struct _AtkImageIface
{
  GTypeInterface parent;
  void          	( *get_image_position)    (AtkImage		 *image,
                                                   gint                  *x,
				                   gint	                 *y,
    			                           AtkCoordType	         coord_type);
  const gchar*          ( *get_image_description) (AtkImage              *image);
  void                  ( *get_image_size)        (AtkImage              *image,
                                                   gint                  *width,
                                                   gint                  *height);
  gboolean              ( *set_image_description) (AtkImage              *image,
                                                   const gchar           *description);
  const gchar*          ( *get_image_locale)      (AtkImage              *image);
};

struct _AtkHypertextIface
{
  GTypeInterface parent;

  AtkHyperlink*(* get_link)                 (AtkHypertext       *hypertext,
                                             gint               link_index);
  gint         (* get_n_links)              (AtkHypertext       *hypertext);
  gint         (* get_link_index)           (AtkHypertext       *hypertext,
                                             gint               char_index);

  /*
   * signal handlers
   */
  void         (* link_selected)            (AtkHypertext       *hypertext,
                                             gint               link_index);
};

struct _AtkHyperlinkImplIface
{
  GTypeInterface parent;
    
  AtkHyperlink*  (* get_hyperlink) (AtkHyperlinkImpl *impl);
};
struct _AtkHyperlinkClass
{
  GObjectClass parent;

  gchar*           (* get_uri)             (AtkHyperlink     *link_,
                                            gint             i);
  AtkObject*       (* get_object)          (AtkHyperlink     *link_,
                                            gint             i);
  gint             (* get_end_index)       (AtkHyperlink     *link_);
  gint             (* get_start_index)     (AtkHyperlink     *link_);
  gboolean         (* is_valid)            (AtkHyperlink     *link_);
  gint	           (* get_n_anchors)	   (AtkHyperlink     *link_);
  guint	           (* link_state)	   (AtkHyperlink     *link_);
  gboolean         (* is_selected_link)    (AtkHyperlink     *link_);

  /* Signals */
  void             ( *link_activated)      (AtkHyperlink     *link_);
  AtkFunction      pad1;
};
struct _AtkHyperlink
{
  GObject parent;
};
struct _AtkGObjectAccessibleClass
{
  AtkObjectClass parent_class;

  AtkFunction pad1;
  AtkFunction pad2;
};
struct _AtkGObjectAccessible
{
  AtkObject parent;
};

struct _AtkEditableTextIface
{
  GTypeInterface parent_interface;

  gboolean (* set_run_attributes) (AtkEditableText  *text,
                                   AtkAttributeSet  *attrib_set,
                                   gint		    start_offset,
 				   gint		    end_offset);
  void   (* set_text_contents)    (AtkEditableText  *text,
                                   const gchar      *string);
  void   (* insert_text)          (AtkEditableText  *text,
                                   const gchar      *string,
                                   gint             length,
                                   gint             *position);
  void   (* copy_text)            (AtkEditableText  *text,
                                   gint             start_pos,
                                   gint             end_pos);
  void   (* cut_text)             (AtkEditableText  *text,
                                   gint             start_pos,
                                   gint             end_pos);
  void   (* delete_text)          (AtkEditableText  *text,
                                   gint             start_pos,
                                   gint             end_pos);
  void   (* paste_text)           (AtkEditableText  *text,
                                   gint             position);
};

struct _AtkDocumentIface
{
  GTypeInterface parent;
  const gchar*          ( *get_document_type) (AtkDocument              *document);
  gpointer              ( *get_document)      (AtkDocument              *document);

  const gchar*          ( *get_document_locale) (AtkDocument              *document);
  AtkAttributeSet *     ( *get_document_attributes) (AtkDocument        *document);
  const gchar*          ( *get_document_attribute_value) (AtkDocument   *document,
                                                          const gchar   *attribute_name);
  gboolean              ( *set_document_attribute) (AtkDocument         *document,
                                                    const gchar         *attribute_name,
                                                    const gchar         *attribute_value);
  gint                  ( *get_current_page_number) (AtkDocument *document);
  gint                  ( *get_page_count) (AtkDocument *document);
};

struct _AtkComponentIface
{
  GTypeInterface parent;

  guint          (* add_focus_handler)  (AtkComponent          *component,
                                         AtkFocusHandler        handler);

  gboolean       (* contains)           (AtkComponent          *component,
                                         gint                   x,
                                         gint                   y,
                                         AtkCoordType           coord_type);

  AtkObject*    (* ref_accessible_at_point)  (AtkComponent     *component,
                                         gint                   x,
                                         gint                   y,
                                         AtkCoordType           coord_type);
  void          (* get_extents)         (AtkComponent          *component,
                                         gint                  *x,
                                         gint                  *y,
                                         gint                  *width,
                                         gint                  *height,
                                         AtkCoordType          coord_type);
  void                     (* get_position)     (AtkComponent   *component,
                                                 gint           *x,
                                                 gint           *y,
                                                 AtkCoordType   coord_type);
  void                     (* get_size)                 (AtkComponent   *component,
                                                         gint           *width,
                                                         gint           *height);
  gboolean                 (* grab_focus)               (AtkComponent   *component);
  void                     (* remove_focus_handler)      (AtkComponent  *component,
                                                          guint         handler_id);
  gboolean                 (* set_extents)      (AtkComponent   *component,
                                                 gint           x,
                                                 gint           y,
                                                 gint           width,
                                                 gint           height,
                                                 AtkCoordType   coord_type);
  gboolean                 (* set_position)     (AtkComponent   *component,
                                                 gint           x,
                                                 gint           y,
                                                 AtkCoordType   coord_type);
  gboolean                 (* set_size)         (AtkComponent   *component,
                                                 gint           width,
                                                 gint           height);
  	
  AtkLayer                 (* get_layer)        (AtkComponent   *component);
  gint                     (* get_mdi_zorder)   (AtkComponent   *component);

  /*
   * signal handlers
   */
  void                     (* bounds_changed)   (AtkComponent   *component,
                                                 AtkRectangle   *bounds);
  gdouble                  (* get_alpha)        (AtkComponent   *component);
};
struct _AtkRectangle
{
  gint x;
  gint y;
  gint width;
  gint height;
};

struct _AtkActionIface
{
  GTypeInterface parent;

  gboolean                (*do_action)         (AtkAction         *action,
                                                gint              i);
  gint                    (*get_n_actions)     (AtkAction         *action);
  const gchar*            (*get_description)   (AtkAction         *action,
                                                gint              i);
  const gchar*            (*get_name)          (AtkAction         *action,
                                                gint              i);
  const gchar*            (*get_keybinding)    (AtkAction         *action,
                                                gint              i);
  gboolean                (*set_description)   (AtkAction         *action,
                                                gint              i,
                                                const gchar       *desc);
  const gchar*            (*get_localized_name)(AtkAction         *action,
						gint              i);
};
guint atk_get_interface_age(void);
guint atk_get_binary_age(void);
guint atk_get_micro_version(void);
guint atk_get_minor_version(void);
guint atk_get_major_version(void);
GType atk_value_type_get_type(void);
GType atk_coord_type_get_type(void);
GType atk_key_event_type_get_type(void);
GType atk_text_clip_type_get_type(void);
GType atk_text_granularity_get_type(void);
GType atk_text_boundary_get_type(void);
GType atk_text_attribute_get_type(void);
GType atk_state_type_get_type(void);
GType atk_relation_type_get_type(void);
GType atk_layer_get_type(void);
GType atk_role_get_type(void);
GType atk_hyperlink_state_flags_get_type(void);
GType atk_window_get_type(void);
const gchar * atk_value_type_get_localized_name(AtkValueType value_type);
const gchar * atk_value_type_get_name(AtkValueType value_type);
void atk_value_set_value(AtkValue     *obj, const gdouble new_value);
GSList * atk_value_get_sub_ranges(AtkValue *obj);
gdouble atk_value_get_increment(AtkValue *obj);
AtkRange * atk_value_get_range(AtkValue *obj);
void atk_value_get_value_and_text(AtkValue *obj, gdouble *value, gchar  **text);
void atk_value_get_minimum_increment(AtkValue     *obj, GValue       *value);
gboolean atk_value_set_current_value(AtkValue     *obj, const GValue *value);
void atk_value_get_minimum_value(AtkValue     *obj, GValue       *value);
void atk_value_get_maximum_value(AtkValue     *obj, GValue       *value);
void atk_value_get_current_value(AtkValue     *obj, GValue       *value);
GType atk_value_get_type(void);
const gchar  * atk_get_version(void);
const gchar  * atk_get_toolkit_version(void);
const gchar  * atk_get_toolkit_name(void);
AtkObject * atk_get_focus_object(void);
AtkObject * atk_get_root(void);
void atk_remove_key_event_listener(guint listener_id);
guint atk_add_key_event_listener(AtkKeySnoopFunc listener, gpointer data);
void atk_remove_global_event_listener(guint listener_id);
guint atk_add_global_event_listener(GSignalEmissionHook listener, const gchar        *event_type);
void atk_focus_tracker_notify(AtkObject            *object);
void atk_focus_tracker_init(AtkEventListenerInit  init);
void atk_remove_focus_tracker(guint                tracker_id);
guint atk_add_focus_tracker(AtkEventListener      focus_tracker);
GType atk_util_get_type(void);
const gchar * atk_text_attribute_get_value(AtkTextAttribute attr, gint             index_);
AtkTextAttribute atk_text_attribute_for_name(const gchar      *name);
const gchar * atk_text_attribute_get_name(AtkTextAttribute attr);
void atk_attribute_set_free(AtkAttributeSet  *attrib_set);
void atk_text_free_ranges(AtkTextRange     **ranges);
AtkTextRange ** atk_text_get_bounded_ranges(AtkText          *text, AtkTextRectangle *rect, AtkCoordType     coord_type, AtkTextClipType  x_clip_type, AtkTextClipType  y_clip_type);
void atk_text_get_range_extents(AtkText          *text, gint             start_offset, gint             end_offset, AtkCoordType     coord_type, AtkTextRectangle *rect);
gboolean atk_text_set_caret_offset(AtkText          *text, gint             offset);
gboolean atk_text_set_selection(AtkText          *text, gint		    selection_num, gint             start_offset, gint             end_offset);
gboolean atk_text_remove_selection(AtkText          *text, gint		    selection_num);
gboolean atk_text_add_selection(AtkText          *text, gint             start_offset, gint             end_offset);
gchar * atk_text_get_selection(AtkText          *text, gint		    selection_num, gint             *start_offset, gint             *end_offset);
gint atk_text_get_n_selections(AtkText          *text);
gint atk_text_get_offset_at_point(AtkText          *text, gint             x, gint             y, AtkCoordType	    coords);
gint atk_text_get_character_count(AtkText          *text);
AtkAttributeSet * atk_text_get_default_attributes(AtkText	    *text);
AtkAttributeSet * atk_text_get_run_attributes(AtkText	    *text, gint	  	    offset, gint             *start_offset, gint	 	    *end_offset);
void atk_text_get_character_extents(AtkText          *text, gint             offset, gint             *x, gint             *y, gint             *width, gint             *height, AtkCoordType	    coords);
gint atk_text_get_caret_offset(AtkText          *text);
gchar * atk_text_get_string_at_offset(AtkText            *text, gint               offset, AtkTextGranularity granularity, gint               *start_offset, gint               *end_offset);
gchar * atk_text_get_text_before_offset(AtkText          *text, gint             offset, AtkTextBoundary  boundary_type, gint             *start_offset, gint	            *end_offset);
gchar * atk_text_get_text_at_offset(AtkText          *text, gint             offset, AtkTextBoundary  boundary_type, gint             *start_offset, gint             *end_offset);
gchar * atk_text_get_text_after_offset(AtkText          *text, gint             offset, AtkTextBoundary  boundary_type, gint             *start_offset, gint	            *end_offset);
gunichar atk_text_get_character_at_offset(AtkText          *text, gint             offset);
gchar * atk_text_get_text(AtkText          *text, gint             start_offset, gint             end_offset);
GType atk_text_get_type(void);
GType atk_text_range_get_type(void);
AtkTextAttribute atk_text_attribute_register(const gchar *name);
AtkObject  * atk_table_cell_get_table(AtkTableCell *cell);
gboolean atk_table_cell_get_row_column_span(AtkTableCell *cell, gint         *row, gint         *column, gint         *row_span, gint         *column_span);
GPtrArray  * atk_table_cell_get_row_header_cells(AtkTableCell *cell);
gint atk_table_cell_get_row_span(AtkTableCell *cell);
gboolean atk_table_cell_get_position(AtkTableCell *cell, gint         *row, gint         *column);
GPtrArray  * atk_table_cell_get_column_header_cells(AtkTableCell *cell);
gint atk_table_cell_get_column_span(AtkTableCell *cell);
GType atk_table_cell_get_type(void);
gboolean atk_table_remove_column_selection(AtkTable         *table, gint             column);
gboolean atk_table_add_column_selection(AtkTable         *table, gint             column);
gboolean atk_table_remove_row_selection(AtkTable         *table, gint             row);
gboolean atk_table_add_row_selection(AtkTable         *table, gint             row);
gboolean atk_table_is_selected(AtkTable         *table, gint             row, gint             column);
gboolean atk_table_is_row_selected(AtkTable         *table, gint             row);
gboolean atk_table_is_column_selected(AtkTable         *table, gint             column);
gint atk_table_get_selected_rows(AtkTable         *table, gint             **selected);
gint atk_table_get_selected_columns(AtkTable         *table, gint             **selected);
void atk_table_set_summary(AtkTable         *table, AtkObject        *accessible);
void atk_table_set_row_header(AtkTable         *table, gint             row, AtkObject        *header);
void atk_table_set_row_description(AtkTable         *table, gint             row, const gchar      *description);
void atk_table_set_column_header(AtkTable         *table, gint             column, AtkObject        *header);
void atk_table_set_column_description(AtkTable         *table, gint             column, const gchar      *description);
void atk_table_set_caption(AtkTable         *table, AtkObject        *caption);
AtkObject * atk_table_get_summary(AtkTable         *table);
AtkObject * atk_table_get_row_header(AtkTable         *table, gint		   row);
const gchar * atk_table_get_row_description(AtkTable         *table, gint             row);
AtkObject * atk_table_get_column_header(AtkTable         *table, gint		   column);
const gchar * atk_table_get_column_description(AtkTable         *table, gint             column);
AtkObject * atk_table_get_caption(AtkTable         *table);
gint atk_table_get_row_extent_at(AtkTable         *table, gint             row, gint             column);
gint atk_table_get_column_extent_at(AtkTable         *table, gint             row, gint             column);
gint atk_table_get_n_rows(AtkTable         *table);
gint atk_table_get_n_columns(AtkTable         *table);
gint atk_table_get_row_at_index(AtkTable         *table, gint             index_);
gint atk_table_get_column_at_index(AtkTable         *table, gint             index_);
gint atk_table_get_index_at(AtkTable         *table, gint             row, gint             column);
AtkObject * atk_table_ref_at(AtkTable         *table, gint             row, gint             column);
GType atk_table_get_type(void);
const gchar * atk_streamable_content_get_uri(AtkStreamableContent     *streamable, const gchar              *mime_type);
GIOChannel * atk_streamable_content_get_stream(AtkStreamableContent     *streamable, const gchar              *mime_type);
const gchar * atk_streamable_content_get_mime_type(AtkStreamableContent     *streamable, gint                     i);
gint atk_streamable_content_get_n_mime_types(AtkStreamableContent     *streamable);
GType atk_streamable_content_get_type(void);
AtkStateSet * atk_state_set_xor_sets(AtkStateSet  *set, AtkStateSet  *compare_set);
AtkStateSet * atk_state_set_or_sets(AtkStateSet  *set, AtkStateSet  *compare_set);
AtkStateSet * atk_state_set_and_sets(AtkStateSet  *set, AtkStateSet  *compare_set);
gboolean atk_state_set_remove_state(AtkStateSet  *set, AtkStateType type);
gboolean atk_state_set_contains_states(AtkStateSet  *set, AtkStateType *types, gint         n_types);
gboolean atk_state_set_contains_state(AtkStateSet  *set, AtkStateType type);
void atk_state_set_clear_states(AtkStateSet  *set);
void atk_state_set_add_states(AtkStateSet  *set, AtkStateType *types, gint         n_types);
gboolean atk_state_set_add_state(AtkStateSet  *set, AtkStateType type);
gboolean atk_state_set_is_empty(AtkStateSet  *set);
AtkStateSet * atk_state_set_new(void);
GType atk_state_set_get_type(void);
AtkStateType atk_state_type_for_name(const gchar  *name);
const gchar * atk_state_type_get_name(AtkStateType type);
AtkStateType atk_state_type_register(const gchar *name);
gboolean atk_socket_is_occupied(AtkSocket* obj);
void atk_socket_embed(AtkSocket* obj, gchar* plug_id);
AtkObject * atk_socket_new(void);
GType atk_socket_get_type(void);
gboolean atk_selection_select_all_selection(AtkSelection   *selection);
gboolean atk_selection_remove_selection(AtkSelection   *selection, gint           i);
gboolean atk_selection_is_child_selected(AtkSelection   *selection, gint           i);
gint atk_selection_get_selection_count(AtkSelection   *selection);
AtkObject * atk_selection_ref_selection(AtkSelection   *selection, gint           i);
gboolean atk_selection_clear_selection(AtkSelection   *selection);
gboolean atk_selection_add_selection(AtkSelection   *selection, gint           i);
GType atk_selection_get_type(void);
void atk_relation_set_add_relation_by_type(AtkRelationSet  *set, AtkRelationType relationship, AtkObject       *target);
AtkRelation * atk_relation_set_get_relation_by_type(AtkRelationSet  *set, AtkRelationType relationship);
AtkRelation * atk_relation_set_get_relation(AtkRelationSet  *set, gint            i);
gint atk_relation_set_get_n_relations(AtkRelationSet  *set);
void atk_relation_set_add(AtkRelationSet  *set, AtkRelation     *relation);
void atk_relation_set_remove(AtkRelationSet  *set, AtkRelation     *relation);
gboolean atk_relation_set_contains_target(AtkRelationSet  *set, AtkRelationType relationship, AtkObject       *target);
gboolean atk_relation_set_contains(AtkRelationSet  *set, AtkRelationType relationship);
AtkRelationSet * atk_relation_set_new(void);
GType atk_relation_set_get_type(void);
gboolean atk_relation_remove_target(AtkRelation     *relation, AtkObject       *target);
void atk_relation_add_target(AtkRelation     *relation, AtkObject       *target);
GPtrArray * atk_relation_get_target(AtkRelation     *relation);
AtkRelationType atk_relation_get_relation_type(AtkRelation     *relation);
AtkRelation * atk_relation_new(AtkObject       **targets, gint            n_targets, AtkRelationType relationship);
AtkRelationType atk_relation_type_for_name(const gchar     *name);
const gchar * atk_relation_type_get_name(AtkRelationType type);
AtkRelationType atk_relation_type_register(const gchar     *name);
GType atk_relation_get_type(void);
AtkRegistry * atk_get_default_registry(void);
AtkObjectFactory * atk_registry_get_factory(AtkRegistry *registry, GType type);
GType atk_registry_get_factory_type(AtkRegistry *registry, GType type);
void atk_registry_set_factory_type(AtkRegistry *registry, GType type, GType factory_type);
GType atk_registry_get_type(void);
AtkRange * atk_range_new(gdouble      lower_limit, gdouble      upper_limit, const gchar *description);
const gchar * atk_range_get_description(AtkRange    *range);
gdouble atk_range_get_upper_limit(AtkRange    *range);
gdouble atk_range_get_lower_limit(AtkRange    *range);
void atk_range_free(AtkRange *range);
AtkRange * atk_range_copy(AtkRange *src);
GType atk_range_get_type(void);
gchar * atk_plug_get_id(AtkPlug* plug);
AtkObject * atk_plug_new(void);
GType atk_plug_get_type(void);
GType atk_object_factory_get_accessible_type(AtkObjectFactory *factory);
void atk_object_factory_invalidate(AtkObjectFactory *factory);
AtkObject * atk_object_factory_create_accessible(AtkObjectFactory *factory, GObject *obj);
GType atk_object_factory_get_type(void);
const gchar * atk_object_get_object_locale(AtkObject   *accessible);
AtkRole atk_role_register(const gchar *name);
const gchar * atk_role_get_localized_name(AtkRole     role);
gboolean atk_object_remove_relationship(AtkObject      *object, AtkRelationType relationship, AtkObject      *target);
gboolean atk_object_add_relationship(AtkObject      *object, AtkRelationType relationship, AtkObject      *target);
AtkRole atk_role_for_name(const gchar     *name);
const gchar * atk_role_get_name(AtkRole         role);
void atk_object_initialize(AtkObject                     *accessible, gpointer                      data);
void atk_object_notify_state_change(AtkObject                      *accessible, AtkState                       state, gboolean                       value);
void atk_object_remove_property_change_handler(AtkObject                      *accessible, guint                          handler_id);
guint atk_object_connect_property_change_handler(AtkObject                      *accessible, AtkPropertyChangeHandler       *handler);
void atk_object_set_role(AtkObject *accessible, AtkRole   role);
void atk_object_set_parent(AtkObject *accessible, AtkObject *parent);
void atk_object_set_description(AtkObject *accessible, const gchar *description);
void atk_object_set_name(AtkObject *accessible, const gchar *name);
gint atk_object_get_index_in_parent(AtkObject *accessible);
AtkStateSet * atk_object_ref_state_set(AtkObject *accessible);
AtkAttributeSet * atk_object_get_attributes(AtkObject *accessible);
gint atk_object_get_mdi_zorder(AtkObject *accessible);
AtkLayer atk_object_get_layer(AtkObject *accessible);
AtkRole atk_object_get_role(AtkObject *accessible);
AtkRelationSet * atk_object_ref_relation_set(AtkObject *accessible);
AtkObject * atk_object_ref_accessible_child(AtkObject *accessible, gint        i);
gint atk_object_get_n_accessible_children(AtkObject *accessible);
AtkObject * atk_object_peek_parent(AtkObject *accessible);
AtkObject * atk_object_get_parent(AtkObject *accessible);
const gchar * atk_object_get_description(AtkObject *accessible);
const gchar * atk_object_get_name(AtkObject *accessible);
AtkObject * atk_implementor_ref_accessible(AtkImplementor *implementor);
GType atk_implementor_get_type(void);
GType atk_object_get_type(void);
AtkObjectFactory  * atk_no_op_object_factory_new(void);
GType atk_no_op_object_factory_get_type(void);
AtkObject  * atk_no_op_object_new(GObject  *obj);
GType atk_no_op_object_get_type(void);
const AtkMisc  * atk_misc_get_instance(void);
void atk_misc_threads_leave(AtkMisc *misc);
void atk_misc_threads_enter(AtkMisc *misc);
GType atk_misc_get_type(void);
const gchar * atk_image_get_image_locale(AtkImage   *image);
void atk_image_get_image_position(AtkImage	     *image, gint               *x, gint	             *y, AtkCoordType	     coord_type);
gboolean atk_image_set_image_description(AtkImage           *image, const gchar       *description);
void atk_image_get_image_size(AtkImage           *image, gint               *width, gint               *height);
const gchar * atk_image_get_image_description(AtkImage   *image);
GType atk_image_get_type(void);
gint atk_hypertext_get_link_index(AtkHypertext *hypertext, gint          char_index);
gint atk_hypertext_get_n_links(AtkHypertext *hypertext);
AtkHyperlink * atk_hypertext_get_link(AtkHypertext *hypertext, gint          link_index);
GType atk_hypertext_get_type(void);
AtkHyperlink     * atk_hyperlink_impl_get_hyperlink(AtkHyperlinkImpl *impl);
GType atk_hyperlink_impl_get_type(void);
gboolean atk_hyperlink_is_selected_link(AtkHyperlink     *link_);
gint atk_hyperlink_get_n_anchors(AtkHyperlink     *link_);
gboolean atk_hyperlink_is_inline(AtkHyperlink     *link_);
gboolean atk_hyperlink_is_valid(AtkHyperlink     *link_);
gint atk_hyperlink_get_start_index(AtkHyperlink     *link_);
gint atk_hyperlink_get_end_index(AtkHyperlink     *link_);
AtkObject * atk_hyperlink_get_object(AtkHyperlink     *link_, gint             i);
gchar * atk_hyperlink_get_uri(AtkHyperlink     *link_, gint             i);
GType atk_hyperlink_get_type(void);
GObject    * atk_gobject_accessible_get_object(AtkGObjectAccessible *obj);
AtkObject  * atk_gobject_accessible_for_object(GObject           *obj);
GType atk_gobject_accessible_get_type(void);
void atk_editable_text_paste_text(AtkEditableText  *text, gint             position);
void atk_editable_text_delete_text(AtkEditableText  *text, gint             start_pos, gint             end_pos);
void atk_editable_text_cut_text(AtkEditableText  *text, gint             start_pos, gint             end_pos);
void atk_editable_text_copy_text(AtkEditableText  *text, gint             start_pos, gint             end_pos);
void atk_editable_text_insert_text(AtkEditableText  *text, const gchar      *string, gint             length, gint             *position);
void atk_editable_text_set_text_contents(AtkEditableText  *text, const gchar      *string);
gboolean atk_editable_text_set_run_attributes(AtkEditableText          *text, AtkAttributeSet  *attrib_set, gint    	        start_offset, gint	        end_offset);
GType atk_editable_text_get_type(void);
gint atk_document_get_page_count(AtkDocument *document);
gint atk_document_get_current_page_number(AtkDocument *document);
gboolean atk_document_set_attribute_value(AtkDocument *document, const gchar *attribute_name, const gchar *attribute_value);
const gchar * atk_document_get_attribute_value(AtkDocument *document, const gchar *attribute_name);
AtkAttributeSet * atk_document_get_attributes(AtkDocument *document);
const gchar * atk_document_get_locale(AtkDocument *document);
gpointer atk_document_get_document(AtkDocument   *document);
const gchar * atk_document_get_document_type(AtkDocument   *document);
GType atk_document_get_type(void);
gdouble atk_component_get_alpha(AtkComponent    *component);
gboolean atk_component_set_size(AtkComponent    *component, gint            width, gint            height);
gboolean atk_component_set_position(AtkComponent    *component, gint            x, gint            y, AtkCoordType    coord_type);
gboolean atk_component_set_extents(AtkComponent    *component, gint            x, gint            y, gint            width, gint            height, AtkCoordType    coord_type);
void atk_component_remove_focus_handler(AtkComponent    *component, guint           handler_id);
gboolean atk_component_grab_focus(AtkComponent    *component);
gint atk_component_get_mdi_zorder(AtkComponent    *component);
AtkLayer atk_component_get_layer(AtkComponent    *component);
void atk_component_get_size(AtkComponent    *component, gint            *width, gint            *height);
void atk_component_get_position(AtkComponent    *component, gint            *x, gint            *y, AtkCoordType    coord_type);
void atk_component_get_extents(AtkComponent    *component, gint            *x, gint            *y, gint            *width, gint            *height, AtkCoordType    coord_type);
AtkObject * atk_component_ref_accessible_at_point(AtkComponent    *component, gint            x, gint            y, AtkCoordType    coord_type);
gboolean atk_component_contains(AtkComponent    *component, gint            x, gint            y, AtkCoordType    coord_type);
guint atk_component_add_focus_handler(AtkComponent    *component, AtkFocusHandler handler);
GType atk_component_get_type(void);
GType atk_rectangle_get_type(void);
const gchar * atk_action_get_localized_name(AtkAction       *action, gint            i);
gboolean atk_action_set_description(AtkAction         *action, gint              i, const gchar       *desc);
const gchar * atk_action_get_keybinding(AtkAction         *action, gint              i);
const gchar * atk_action_get_name(AtkAction         *action, gint              i);
const gchar * atk_action_get_description(AtkAction         *action, gint              i);
gint atk_action_get_n_actions(AtkAction *action);
gboolean atk_action_do_action(AtkAction         *action, gint              i);
GType atk_action_get_type(void);
