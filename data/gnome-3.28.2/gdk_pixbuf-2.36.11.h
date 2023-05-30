#    define GDK_PIXBUF_VAR extern
#define GDK_PIXBUF_VERSION "2.36.11"
#define GDK_PIXBUF_MICRO (11)
#define GDK_PIXBUF_MINOR (36)
#define GDK_PIXBUF_MAJOR (2)
#define GDK_TYPE_PIXBUF_ROTATION (gdk_pixbuf_rotation_get_type ())
#define GDK_TYPE_INTERP_TYPE (gdk_interp_type_get_type ())
#define GDK_TYPE_PIXBUF_ERROR (gdk_pixbuf_error_get_type ())
#define GDK_TYPE_COLORSPACE (gdk_colorspace_get_type ())
#define GDK_TYPE_PIXBUF_ALPHA_MODE (gdk_pixbuf_alpha_mode_get_type ())
GType gdk_pixbuf_rotation_get_type(void);
GType gdk_interp_type_get_type(void);
GType gdk_pixbuf_error_get_type(void);
GType gdk_colorspace_get_type(void);
GType gdk_pixbuf_alpha_mode_get_type(void);
