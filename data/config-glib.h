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

//Gtk
typedef struct _GAppInfo GAppInfo;
typedef struct _GtkFileFilterInfo GtkFileFilterInfo;
typedef struct _GtkRecentFilterInfo GtkRecentFilterInfo;
typedef char gchar;
#define G_GNUC_DEPRECATED

typedef struct _GdkEventButton GdkEventButton;
typedef struct _GtkDialog GtkDialog;
typedef struct _GtkDialogClass GtkDialogClass;
typedef struct _GtkWindowClass GtkWindowClass;
typedef struct _GtkAboutDialog GtkAboutDialog;
typedef struct _GtkLabel GtkLabel;
typedef struct _GtkLabelClass GtkLabelClass;
typedef struct _GtkAccelKey GtkAccelKey;
//typedef struct _AtkObject AtkObject;
//typedef struct _AtkObjectClass AtkObjectClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkComboBox GtkComboBox;
typedef struct _GtkComboBoxClass GtkComboBoxClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GApplication GApplication;
typedef struct _GApplicationClass GApplicationClass;
typedef struct _GtkFrame GtkFrame;
typedef struct _GtkFrameClass GtkFrameClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkBindingEntry GtkBindingEntry;
typedef struct _GtkBindingSet GtkBindingSet;
typedef struct _GtkBindingSignal GtkBindingSignal;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkCssGadget GtkCssGadget;
typedef struct _GtkCssGadgetClass GtkCssGadgetClass;
typedef struct _GMarkupParser GMarkupParser;
typedef struct _GtkCssGadget GtkCssGadget;
typedef struct _GtkCssGadgetClass GtkCssGadgetClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkWidgetClass GtkWidgetClass;
typedef struct _GtkCellArea GtkCellArea;
typedef struct _GtkCellAreaClass GtkCellAreaClass;
typedef struct _GtkCellRenderer GtkCellRenderer;
typedef struct _GtkCellRendererText GtkCellRendererText;
typedef struct _GtkCellRendererTextClass GtkCellRendererTextClass;
typedef struct _GtkCellRendererText GtkCellRendererText;
typedef struct _GtkCellRendererTextClass GtkCellRendererTextClass;
typedef struct _GtkCellRenderer GtkCellRenderer;
typedef struct _GtkCellRendererClass GtkCellRendererClass;
typedef struct _GtkCellRenderer GtkCellRenderer;
typedef struct _GtkCellRendererClass GtkCellRendererClass;
typedef struct _GtkCellRendererText GtkCellRendererText;
typedef struct _GtkCellRendererTextClass GtkCellRendererTextClass;
typedef struct _GtkCellRenderer GtkCellRenderer;
typedef struct _GtkCellRendererClass GtkCellRendererClass;
typedef struct _GtkCellRenderer GtkCellRenderer;
typedef struct _GtkCellRendererClass GtkCellRendererClass;
typedef struct _GtkCellRenderer GtkCellRenderer;
typedef struct _GtkCellRendererClass GtkCellRendererClass;
typedef struct _GtkToggleButton GtkToggleButton;
typedef struct _GtkToggleButtonClass GtkToggleButtonClass;
typedef struct _GtkMenuItem GtkMenuItem;
typedef struct _GtkMenuItemClass GtkMenuItemClass;
typedef struct _GtkButton GtkButton;
typedef struct _GtkButtonClass GtkButtonClass;
typedef struct _GdkRGBA GdkRGBA;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkComboBox GtkComboBox;
typedef struct _GtkComboBoxClass GtkComboBoxClass;
typedef struct _GtkCssGadget GtkCssGadget;
typedef struct _GtkCssGadgetClass GtkCssGadgetClass;
typedef struct _GtkCssImage GtkCssImage;
typedef struct _GtkCssImageClass GtkCssImageClass;
typedef struct _GtkCssValue GtkCssValue;
typedef struct _GtkCssImage GtkCssImage;
typedef struct _GtkCssImageClass GtkCssImageClass;
typedef struct _GtkCssImageUrl GtkCssImageUrl;
typedef struct _GtkCssImageClass GtkCssImageClass;
typedef struct _GtkCssStyle GtkCssStyle;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkButton GtkButton;
typedef struct _GtkButtonClass GtkButtonClass;
typedef struct _PangoFontFamily PangoFontFamily;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkMisc GtkMisc;
typedef struct _GtkMiscClass GtkMiscClass;
typedef struct _GtkIMContext GtkIMContext;
typedef struct _GtkIMContextClass GtkIMContextClass;
typedef struct _GtkIMContext GtkIMContext;
typedef struct _GtkIMContextClass GtkIMContextClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkMisc GtkMisc;
typedef struct _GtkMiscClass GtkMiscClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkButton GtkButton;
typedef struct _GtkButtonClass GtkButtonClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkButton GtkButton;
typedef struct _GtkButtonClass GtkButtonClass;
typedef struct _GtkMenuShell GtkMenuShell;
typedef struct _GtkMenuShellClass GtkMenuShellClass;
typedef struct _GtkMenuShell GtkMenuShell;
typedef struct _GtkMenuShellClass GtkMenuShellClass;
typedef struct _GtkToggleButton GtkToggleButton;
typedef struct _GtkToggleButtonClass GtkToggleButtonClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkToolButton GtkToolButton;
typedef struct _GtkToolButtonClass GtkToolButtonClass;
typedef struct _GMountOperation GMountOperation;
typedef struct _GMountOperationClass GMountOperationClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkPopoverClass GtkPopoverClass;
typedef struct _GtkCheckButton GtkCheckButton;
typedef struct _GtkCheckButtonClass GtkCheckButtonClass;
typedef struct _GtkCheckMenuItem GtkCheckMenuItem;
typedef struct _GtkCheckMenuItemClass GtkCheckMenuItemClass;
typedef struct _GtkToggleToolButton GtkToggleToolButton;
typedef struct _GtkToggleToolButtonClass GtkToggleToolButtonClass;
typedef struct _GtkRecentManager GtkRecentManager;
typedef struct _GtkMenu GtkMenu;
typedef struct _GtkMenuClass GtkMenuClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkRange GtkRange;
typedef struct _GtkRangeClass GtkRangeClass;
typedef struct _GtkButton GtkButton;
typedef struct _GtkButtonClass GtkButtonClass;
typedef struct _GtkBorder GtkBorder;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkEntry GtkEntry;
typedef struct _GtkEntryClass GtkEntryClass;
typedef struct _GtkMenuItem GtkMenuItem;
typedef struct _GtkMenuItemClass GtkMenuItemClass;
typedef struct _GtkToolItem GtkToolItem;
typedef struct _GtkToolItemClass GtkToolItemClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkEntry GtkEntry;
typedef struct _GtkEntryClass GtkEntryClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkStyleProperties GtkStyleProperties;
typedef struct _GdkRGBA GdkRGBA;
typedef struct _GtkTextAppearance GtkTextAppearance;
typedef struct _GtkTextIter GtkTextIter;
typedef struct _GtkTextTag GtkTextTag;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkButton GtkButton;
typedef struct _GtkButtonClass GtkButtonClass;
typedef struct _GtkToolButton GtkToolButton;
typedef struct _GtkToolButtonClass GtkToolButtonClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkToolItem GtkToolItem;
typedef struct _GtkToolItemClass GtkToolItemClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _PangoEllipsizeMode PangoEllipsizeMode;
typedef struct _GtkTreeIter GtkTreeIter;
//typedef struct _GtkTreeIterCompareFunc GtkTreeIterCompareFunc;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkScaleButton GtkScaleButton;
typedef struct _GtkScaleButtonClass GtkScaleButtonClass;
typedef struct _GdkEventScroll GdkEventScroll;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkAction GtkAction;
typedef struct _GtkAction GtkAction;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkMisc GtkMisc;
typedef struct _GtkMiscClass GtkMiscClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkBin GtkBin;
typedef struct _GtkBinClass GtkBinClass;
typedef struct _GtkButtonBox GtkButtonBox;
typedef struct _GtkButtonBoxClass GtkButtonBoxClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkPaned GtkPaned;
typedef struct _GtkPanedClass GtkPanedClass;
typedef struct _GtkScale GtkScale;
typedef struct _GtkScaleClass GtkScaleClass;
typedef struct _GtkScrollbar GtkScrollbar;
typedef struct _GtkScrollbarClass GtkScrollbarClass;
typedef struct _GtkSeparator GtkSeparator;
typedef struct _GtkSeparatorClass GtkSeparatorClass;
typedef struct _GtkMenuItem GtkMenuItem;
typedef struct _GtkMenuItemClass GtkMenuItemClass;
typedef struct _GEmblemedIcon GEmblemedIcon;
typedef struct _GEmblemedIconClass GEmblemedIconClass;
typedef struct _GtkToggleAction GtkToggleAction;
typedef struct _GtkToggleActionClass GtkToggleActionClass;
typedef struct _GtkAction GtkAction;
typedef struct _GtkActionClass GtkActionClass;
typedef struct _GdkPixbuf GdkPixbuf;
typedef struct _GtkContainer GtkContainer;
typedef struct _GtkContainerClass GtkContainerClass;
typedef struct _GtkMenuItem GtkMenuItem;
typedef struct _GtkMenuItemClass GtkMenuItemClass;
typedef struct _GtkAction GtkAction;
typedef struct _GtkActionClass GtkActionClass;
typedef struct _GtkButtonBox GtkButtonBox;
typedef struct _GtkButtonBoxClass GtkButtonBoxClass;
typedef struct _GtkBox GtkBox;
typedef struct _GtkBoxClass GtkBoxClass;
typedef struct _GtkPaned GtkPaned;
typedef struct _GtkPanedClass GtkPanedClass;
typedef struct _GtkScale GtkScale;
typedef struct _GtkScaleClass GtkScaleClass;
typedef struct _GtkScrollbar GtkScrollbar;
typedef struct _GtkScrollbarClass GtkScrollbarClass;
typedef struct _GtkSeparator GtkSeparator;
typedef struct _GtkSeparatorClass GtkSeparatorClass;

typedef struct _AtkObject AtkObject;
typedef struct _AtkObjectClass AtkObjectClass;
typedef struct _GtkBindingArg GtkBindingArg;
typedef struct _GtkCssStyleChange GtkCssStyleChange;
typedef struct _GtkCssAffects GtkCssAffects;
typedef struct _PangoFontFace PangoFontFace;
typedef struct _PangoAttrList PangoAttrList;
typedef struct ___attribute__ __attribute__;
typedef struct _GtkIconFactory GtkIconFactory;
typedef struct _PangoFontDescription PangoFontDescription;
typedef struct _GtkTextChildAnchor GtkTextChildAnchor;
typedef struct _GtkSizeGroup GtkSizeGroup;
typedef struct _GdkEventMotion GdkEventMotion;
typedef struct _PangoLayout PangoLayout;

typedef struct _GtkBitmask GtkBitmask;
typedef struct _PangoFontMap PangoFontMap;
typedef struct _GdkEventKey GdkEventKey;
typedef struct _PangoTabArray PangoTabArray;
typedef struct _GtkTextMark GtkTextMark;
typedef struct _GdkEventAny GdkEventAny;

typedef struct _PangoLanguage PangoLanguage;
typedef struct _GdkEventCrossing GdkEventCrossing;
typedef struct _GdkEventConfigure GdkEventConfigure;
typedef struct _GdkEventFocus GdkEventFocus;
typedef struct _GdkEventProperty GdkEventProperty;
typedef struct _GdkEventSelection GdkEventSelection;
typedef struct _GdkEventProximity GdkEventProximity;
typedef struct _GdkEventVisibility GdkEventVisibility;
typedef struct _GdkEventWindowState GdkEventWindowState;
typedef struct _GdkEventExpose GdkEventExpose;
typedef struct _GdkEventGrabBroken GdkEventGrabBroken;
typedef struct _GdkEventTouch GdkEventTouch;


typedef struct _GtkAccelGroup GtkAccelGroup;
typedef struct _GtkAccessible GtkAccessible;
typedef struct _GtkAppChooserButton GtkAppChooserButton;
typedef struct _GtkAppChooserWidget GtkAppChooserWidget;
typedef struct _GtkApplication GtkApplication;
typedef struct _GtkAssistant GtkAssistant;
typedef struct _GtkCalendar GtkCalendar;
typedef struct _GtkCellRendererAccel GtkCellRendererAccel;
typedef struct _GtkCellRendererToggle GtkCellRendererToggle;
typedef struct _GtkColorButton GtkColorButton;
typedef struct _GtkCssProvider GtkCssProvider;
typedef struct _GtkEntryBuffer GtkEntryBuffer;
typedef struct _GtkEntryCompletion GtkEntryCompletion;
typedef struct _GtkExpander GtkExpander;
typedef struct _GtkFileChooserButton GtkFileChooserButton;
typedef struct _GtkFlowBox GtkFlowBox;
typedef struct _GtkFlowBoxChild GtkFlowBoxChild;
typedef struct _GtkFontButton GtkFontButton;
typedef struct _GtkGLArea GtkGLArea;
typedef struct _GtkIconTheme GtkIconTheme;
typedef struct _GtkIconView GtkIconView;
typedef struct _GtkInfoBar GtkInfoBar;
typedef struct _GtkLevelBar GtkLevelBar;
typedef struct _GtkLinkButton GtkLinkButton;
typedef struct _GtkListBox GtkListBox;
typedef struct _GtkListBoxRow GtkListBoxRow;
typedef struct _GtkMenuToolButton GtkMenuToolButton;
typedef struct _GtkNotebook GtkNotebook;
typedef struct _GtkOverlay GtkOverlay;
typedef struct _GtkPlug GtkPlug;
typedef struct _GtkPopover GtkPopover;
typedef struct _GtkPrinter GtkPrinter;
typedef struct _GtkPrintJob GtkPrintJob;
typedef struct _GtkPrintOperation GtkPrintOperation;
typedef struct _GtkRadioButton GtkRadioButton;
typedef struct _GtkRadioMenuItem GtkRadioMenuItem;
typedef struct _GtkScrolledWindow GtkScrolledWindow;
typedef struct _GtkSearchEntry GtkSearchEntry;
typedef struct _GtkShortcutsWindow GtkShortcutsWindow;
typedef struct _GtkSocket GtkSocket;
typedef struct _GtkSpinButton GtkSpinButton;
typedef struct _GtkStatusbar GtkStatusbar;
typedef struct _GtkSwitch GtkSwitch;
typedef struct _GtkTextView GtkTextView;
typedef struct _GtkToolbar GtkToolbar;
typedef struct _GtkTreeModelFilter GtkTreeModelFilter;
typedef struct _GtkTreeView GtkTreeView;
typedef struct _GtkTreeViewColumn GtkTreeViewColumn;
typedef struct _GtkActionGroup GtkActionGroup;
typedef struct _GtkColorSelection GtkColorSelection;
typedef struct _GtkHandleBox GtkHandleBox;
typedef struct _GtkHSV GtkHSV;
typedef struct _GtkRadioAction GtkRadioAction;
typedef struct _GtkStatusIcon GtkStatusIcon;
typedef struct _GtkThemingEngine GtkThemingEngine;
typedef struct _GtkUIManager GtkUIManager;

typedef struct _GtkRequestedSize GtkRequestedSize;
typedef struct _GtkRequisition GtkRequisition;
typedef struct _GActionGroup GActionGroup;
typedef enum _AtkRole AtkRole;
typedef int va_list;
typedef struct _PangoContext PangoContext;
typedef struct _GValue GValue;

typedef struct _GtkWidget GtkWidget;



