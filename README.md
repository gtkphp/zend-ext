```
  ______              _        ______      _   
 |___  /             | |      |  ____|    | |  
    / / ___ _ __   __| |______| |__  __  _| |_ 
   / / / _ \ '_ \ / _` |______|  __| \ \/ / __|
  / /_|  __/ | | | (_| |      | |____ >  <| |_ 
 /_____\___|_| |_|\__,_|      |______/_/\_\\__|
```
# Zend-Ext
Generator of PHP extension

The Zend\Ext component provides tools for working with Gtk sources. Currently, we offer Zend\Ext\CodeGenerator, which provides a unified interface for modeling and generating C-code.

It will be used in GKT+PHP project.

# Usage
```
$] git clone Zend-Ext
$] cd zend-ext
$] composer install
$] cmd/generate-ext.sh /home/dev/php-src/ext/gtkml
$] cmd/generate-doc.sh /home/dev/php-doc/doc-en
$] cmd/generate-doc.sh /home/dev/php-doc/doc-fr
$] cmd/generate-web.sh /home/dev/php-web
```

# What it do
```
cmd/generate-ext.sh --gtk-version="3.22.30" /home/dev/php-src/ext/gtkml
```
It clone Gtk repository in <zend-ext>/tmp and it's dependency and build the documentation.
For a specific version
It store resume file in <zend-ext>/data/<version>/enums|objects|boxed|data-structure.

# Directory structure
```
/Models contains all file to modelize C-Code.
/Views contains all template to generate C-Code.
/Helpers contains all file to generate C-Code strategy naming.
/Services contains :
  /GtkDocSource.php (Parse documentation)
  /GlibDocSource.php
  /PangoDocSource.php
  /CairoDocSource.php
  /GtkSourceCode.php (Load C-Code library interface)
  /GlibSourceCode.php
  /SourceCode.php
```

# Known Causes of Trouble
Zend\C\Engine\Error: identifier_list identifier not implemented on line 11
IDENTIFIER is not defined, the parser switch to another rule. 
Define the unknown typedef in <root>/data/config-glib.h
see <root>/tmp/declaration.h to find the last undeclared IDENTIFIER 


## Parse glib-decl.txt to generate glib-2.56.4.h
zend-ext$ ./vendor/bin/phpunit --filter=ClassGeneratorTest::testDecl ./test

## Test validation
zend-ext$ ./vendor/bin/phpunit --filter=ClassGeneratorTest::testInc ./test

### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(goffset)
Reorder : typedef gint64 goffset;

### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(GLogLevelFlags)

### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(GStaticMutex)
near line 1090
```
#define _GLIB_EXTERN extern
typedef __gnuc_va_list va_list;
typedef int FILE;
typedef int time_t;
typedef unsigned long int pthread_t;
typedef struct
{
  GMutex *mutex;
} GStaticMutex;
```



### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(va_list)
```
typedef __gnuc_va_list va_list;
```

### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(_GLIB_EXTERN)
```
#define _GLIB_EXTERN extern
```

### Zend\C\Engine\Error: direct_abstract_declarator with parameter list not implemented
```
int atexit(void (*)(void));
by
int atexit(void (*callback)(void));
```

### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(FILE)
```
typedef int FILE;
```

### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(__attribute__)
```
#define G_ANALYZER_NORETURN 


//GLIB_AVAILABLE_IN_ALL guint(g_bit_storage)         (gulong number);
//GLIB_AVAILABLE_IN_ALL gint(g_bit_nth_lsf)         (gulong mask, gint   nth_bit);
```



## Parse gobject-decl.txt to generate gobject-2.56.4.h
zend-ext$ ./vendor/bin/phpunit --filter=ClassGeneratorTest::testDecl ./test

## Test validation
zend-ext$ ./vendor/bin/phpunit --filter=ClassGeneratorTest::testInc ./test

## Fix issue

### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(GSignalCVaMarshaller)
reorder @558 to @700:
```
typedef GVaClosureMarshal		 GSignalCVaMarshaller;
typedef GClosureMarshal			 GSignalCMarshaller;
```

### Undefined property: Zend\C\Engine\Node\Type\TagType\RecordType::$name
in "struct _GValue" replace union by "int data[2];"


## Parse gio-decl.txt to generate gio-2.56.4.h
zend-ext$ ./vendor/bin/phpunit --filter=ClassGeneratorTest::testDecl ./test

## Test validation
zend-ext$ ./vendor/bin/phpunit --filter=ClassGeneratorTest::testInc ./test

## Fix issue

### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(GNetworkMonitorBaseClass)
near line 2600
```
typedef struct _GNetworkMonitorBase        GNetworkMonitorBase;
typedef struct _GNetworkMonitorBaseClass   GNetworkMonitorBaseClass;
typedef struct _GNetworkMonitorBasePrivate GNetworkMonitorBasePrivate;

struct _GNetworkMonitorBase {
  GObject parent_instance;

  GNetworkMonitorBasePrivate *priv;
};

struct _GNetworkMonitorBaseClass {
  GObjectClass parent_class;

  /*< private >*/
  /* Padding for future expansion */
  gpointer padding[8];
};
```

### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(uid_t)
```
typedef int uid_t;
typedef int pid_t;
```




## Parse cairo-decl.txt to generate cairo-2.56.4.h
zend-ext$ ./vendor/bin/phpunit --filter=ClassGeneratorTest::testDecl ./test

## Test validation
zend-ext$ ./vendor/bin/phpunit --filter=ClassGeneratorTest::testInc ./test

## Fix issue


### LogicException: Cannot compile empty type list
reorder "typedef struct _" and declare it before prototype function

### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(HMODULE)

```
typedef int Visual;
typedef int Screen;
typedef int Drawable;
typedef int Display;

typedef int HMODULE;
typedef struct _cairo_compositor_t cairo_compositor_t;
typedef int cairo_win32_alpha_blend_func_t;
typedef int cairo_win32_surface_t;
typedef int cairo_surface_clipper_t;
typedef int cairo_paginated_mode_t;
typedef int HBRUSH;
typedef struct _cairo_scaled_font_subsets_t cairo_scaled_font_subsets_t;
typedef int HBITMAP;
typedef int HRGN;
typedef int HDC;

typedef int Pixmap;
typedef struct _XRenderPictFormat XRenderPictFormat;
typedef struct _xcb_connection_t xcb_connection_t;
typedef struct _xcb_drawable_t xcb_drawable_t;
typedef struct _xcb_screen_t xcb_screen_t;
typedef struct _xcb_render_pictforminfo_t xcb_render_pictforminfo_t;
typedef struct _xcb_pixmap_t xcb_pixmap_t;
typedef struct _xcb_visualtype_t xcb_visualtype_t;
typedef int LOGFONTW;
typedef int HFONT;

typedef int ATSUFontID;
typedef int CGFontRef;
typedef int CGContextRef;
typedef int FcPattern;
typedef int FT_Face;
```


## Parse gdk-decl.txt to generate gdk-2.56.4.h
near line 2529

```
typedef struct _GdkWindow GdkWindow;
typedef struct _GdkVisual GdkVisual;
typedef struct _GdkScreen GdkScreen;
typedef struct _GdkKeymap GdkKeymap;
typedef struct _GdkDragContext GdkDragContext;
typedef struct _GdkDisplayManager GdkDisplayManager;
typedef struct _GdkDisplay GdkDisplay;
typedef struct _GdkCursor GdkCursor;
typedef struct _GdkAppLaunchContext GdkAppLaunchContext;
typedef struct _GdkDevice GdkDevice;


typedef int Window;
typedef struct _GdkScreenClass GdkScreenClass;
typedef int Atom;
typedef int GC;
typedef int XID;
typedef struct _GdkGLContextClass GdkGLContextClass;
typedef struct _GLXContext GLXContext;
typedef struct _GLXFBConfig GLXFBConfig;
typedef struct _GLXDrawable GLXDrawable;
typedef struct _XEvent XEvent;
typedef struct _GdkDisplayClass GdkDisplayClass;
typedef struct _GdkDeviceManagerClass GdkDeviceManagerClass;
typedef struct _EGLContext EGLContext;
typedef struct _EGLConfig EGLConfig;

typedef int VisualID;
typedef int Cursor;
typedef int MirSurface;
typedef int MirConnection;
typedef struct _GdkPixbuf GdkPixbuf;
typedef struct _PangoLayout PangoLayout;
typedef struct _PangoLayoutLine PangoLayoutLine;
typedef struct _PangoContext PangoContext;
typedef struct _GdkMonitor GdkMonitor;
typedef int GdkSubpixelLayout;
typedef struct _PangoDirection PangoDirection;

/*
 * _MWM_INFO property
 */
typedef struct {
    long flags;
    Window wm_window;
} MotifWmInfo;

typedef struct {
    unsigned long flags;
    unsigned long wmWindow;
} PropMotifWmInfo;
typedef struct {
    unsigned long flags;
    unsigned long functions;
    unsigned long decorations;
    long inputMode;
    unsigned long status;
} PropMotifWmHints;
typedef struct {
    unsigned long flags;
    unsigned long functions;
    unsigned long decorations;
    long input_mode;
    unsigned long status;
} MotifWmHints, MwmHints;
```
comment :
```
//typedef struct __GdkX11WindowClass GdkX11WindowClass;
//typedef struct __GdkX11Window GdkX11Window;
//typedef struct _GdkX11Display GdkX11Display;
//typedef struct __GdkWindow GdkWindow;
//typedef struct __GdkVisual GdkVisual;
//typedef struct __GdkScreen GdkScreen;
//typedef struct __GdkKeymap GdkKeymap;
//typedef struct __GdkDragContext GdkDragContext;
//typedef struct __GdkDisplayManager GdkDisplayManager;
//typedef struct __GdkDisplay GdkDisplay;
//typedef struct __GdkDevice GdkDevice;
//typedef struct __GdkCursor GdkCursor;
//typedef struct __GdkAppLaunchContext GdkAppLaunchContext;

```

move:
```
typedef void (*GdkRoundTripCallback) (GdkDisplay *display
    ...
```
below enum at line 3337




## Parse gtk-decl.txt to generate gtk-3.22.30.h
near line @2500 add :
```
typedef union _GtkImageDefinition GtkImageDefinition;

typedef struct _PangoFontFamily PangoFontFamily;
typedef struct _PangoFontFace PangoFontFace;
typedef struct _PangoFontDescription PangoFontDescription;
typedef struct _PangoEllipsizeMode PangoEllipsizeMode;
typedef struct _PangoTabArray PangoTabArray;
typedef struct _PangoLanguage PangoLanguage;
typedef struct _PangoAttrList PangoAttrList;
typedef struct _PangoFontMap PangoFontMap;

typedef struct _GtkCssStyle GtkCssStyle;
typedef struct _GtkCssAffects GtkCssAffects;
typedef struct _GtkBitmask GtkBitmask;
typedef struct _GtkCssImageClass GtkCssImageClass;
typedef struct _GtkCssImageUrl GtkCssImageUrl;
typedef struct _GtkCssValue GtkCssValue;
typedef struct _GtkCssImage GtkCssImage;

typedef struct _GtkPrintOperationPrintFunc GtkPrintOperationPrintFunc;// it's a callback
typedef enum _PangoWrapMode PangoWrapMode;
typedef struct _GdkPixbufAnimation GdkPixbufAnimation;
typedef struct _GtkCssNumberParseFlags GtkCssNumberParseFlags;
typedef struct _GtkCssParser GtkCssParser;
typedef struct _GtkCssNodeStyleCache GtkCssNodeStyleCache;
typedef struct _GtkCssNodeDeclaration GtkCssNodeDeclaration;
typedef struct _GtkCssNode GtkCssNode;
typedef struct _GtkCssUnit GtkCssUnit;
typedef struct _GtkCssImageBuiltinType GtkCssImageBuiltinType;
```

declare 
`typedef gboolean (*GtkStylePropertyParser) (const gchar  *string,`
below typedef enum {}
### Zend\C\Engine\Error: Syntax error, unexpected IDENTIFIER(__attribute__)
remove
G_GNUC_DEPRECATED
