//Glib
typedef struct _GArray GArray;
typedef struct _GHook GHook;
typedef struct _GHookList GHookList;
typedef struct _GIOFuncs GIOFuncs;
typedef struct _GList GList;
typedef struct _GSourceCallbackFuncs GSourceCallbackFuncs;
typedef struct _GSource GSource;
/*typedef struct _GSourcePrivate          GSourcePrivate;*/
typedef struct _GNode GNode;
/*typedef struct _GData GData;*/
typedef struct _GSList GSList;
typedef struct _GString GString;
typedef struct _GError GError;
typedef struct _GScannerConfig	GScannerConfig;
/*
typedef void            (*GDestroyNotify)       (gpointer       data);
typedef void            (*GFunc)                (gpointer       data,
                                                 gpointer       user_data);
*/
typedef struct _GLogField GLogField;
typedef struct _GTrashStack GTrashStack;
/*typedef struct _GVariant        GVariant;*/
/*typedef gpointer (*GThreadFunc) (gpointer data);*/
typedef enum _GThreadPriority GThreadPriority;
/*
typedef gchar*          (*GCompletionFunc)      (gpointer);
typedef gboolean (*GSourceFunc)       (gpointer user_data);
typedef void		(*GHookFinalizeFunc)	(GHookList      *hook_list,
						 GHook          *hook);
*/
typedef struct _GPollFD GPollFD;
typedef enum _GIOStatus GIOStatus;
typedef struct _GIOChannel	GIOChannel;
typedef enum _GSeekType GSeekType;
typedef enum _GIOCondition GIOCondition;
typedef enum _GIOFlags GIOFlags;
typedef struct _GScanner	GScanner;
/*
typedef gint (*GCompletionStrncmpFunc) (const gchar *s1,
                                        const gchar *s2,
                                        gsize        n);
*/
//typedef void (*GSourceDummyMarshal) (void);
typedef union  _GTokenValue     GTokenValue;
/*typedef struct _GHashTable  GHashTable;*/
/*
typedef void		(*GScannerMsgFunc)	(GScanner      *scanner,
						 gchar	       *message,
						 gboolean	error);
*/
/*typedef struct _GVariantType GVariantType;*/
typedef struct _GSourceFuncs            GSourceFuncs;
/*typedef struct _GMainContext            GMainContext;*/


typedef union  _GMutex          GMutex;
union _GMutex
{
  gpointer p;
  guint i[2];
};
typedef struct
{
  GMutex *mutex;
} GStaticMutex;
typedef struct _GCond           GCond;
typedef unsigned long int pthread_t;
typedef struct _GTimeVal                GTimeVal;
typedef struct _GPrivate        GPrivate;

typedef struct _GHashTableIter GHashTableIter;


//GObject
typedef int GInitiallyUnownedClass;
typedef struct _GClosure GClosure;
typedef struct _GClosureNotifyData GClosureNotifyData;
typedef struct _GTypeClass GTypeClass;
typedef struct _GTypeInstance GTypeInstance;
typedef struct  _GObject GObject;
typedef struct _GEnumValue GEnumValue;
typedef struct _GFlagsValue GFlagsValue;
typedef struct _GObjectConstructParam GObjectConstructParam;
typedef struct _GParamSpec GParamSpec;
typedef struct	_GEnumClass GEnumClass;
typedef struct	_GFlagsClass GFlagsClass;
typedef union _GTypeCValue
{
  gint     v_int;
  glong    v_long;
  gint64   v_int64;
  gdouble  v_double;
  gpointer v_pointer;
} GTypeCValue;
typedef struct _GObjectClass GObjectClass;
typedef struct _GTypeInterface GTypeInterface;
typedef struct _GTypeInfo GTypeInfo;
typedef struct _GTypeValueTable GTypeValueTable;
typedef struct _GInterfaceInfo GInterfaceInfo;
typedef struct _GTypeModule GTypeModule;
typedef struct _GSignalInvocationHint GSignalInvocationHint;
/*typedef int va_list;*/


//Cairo
typedef union _cairo_path_data_t cairo_path_data_t;
typedef int HDC;
typedef int HBITMAP;
typedef int HRGN;
typedef int HMODULE;
typedef int HBRUSH;
typedef int cairo_surface_clipper_t;//???
typedef int cairo_paginated_mode_t;
typedef int cairo_scaled_font_subsets_t;
typedef int cairo_compositor_t;
typedef int cairo_win32_alpha_blend_func_t;

//Gdk
typedef int Window;
typedef struct _GdkGeometry GdkGeometry;
typedef struct _GdkWindowImplClass GdkWindowImplClass;
typedef struct _GdkWindowImpl GdkWindowImpl;
typedef struct _GdkToplevelX11 GdkToplevelX11;
typedef union _GdkEvent GdkEvent;
typedef int XEvent;
typedef struct _GdkRectangle GdkRectangle;
typedef struct _MotifWmHints MwmHints;// modified
typedef int GdkSeat;

