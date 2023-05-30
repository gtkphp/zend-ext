#define GDK_WINDOW_XID(win)           (gdk_x11_window_get_xid (win))
#define GDK_WINDOW_XDISPLAY(win)      (GDK_DISPLAY_XDISPLAY (gdk_window_get_display (win)))
#define GDK_X11_WINDOW_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_X11_WINDOW, GdkX11WindowClass))
#define GDK_IS_X11_WINDOW_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_X11_WINDOW))
#define GDK_IS_X11_WINDOW(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_X11_WINDOW))
#define GDK_X11_WINDOW_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_X11_WINDOW, GdkX11WindowClass))
#define GDK_X11_WINDOW(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_X11_WINDOW, GdkX11Window))
#define GDK_TYPE_X11_WINDOW              (gdk_x11_window_get_type ())
#define GDK_VISUAL_XVISUAL(visual)    (gdk_x11_visual_get_xvisual (visual))
#define GDK_X11_VISUAL_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_X11_VISUAL, GdkX11VisualClass))
#define GDK_IS_X11_VISUAL_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_X11_VISUAL))
#define GDK_IS_X11_VISUAL(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_X11_VISUAL))
#define GDK_X11_VISUAL_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_X11_VISUAL, GdkX11VisualClass))
#define GDK_X11_VISUAL(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_X11_VISUAL, GdkX11Visual))
#define GDK_TYPE_X11_VISUAL              (gdk_x11_visual_get_type ())
#define GDK_POINTER_TO_XID(pointer) GPOINTER_TO_UINT(pointer)
#define GDK_XID_TO_POINTER(xid) GUINT_TO_POINTER(xid)
#define GDK_ROOT_WINDOW()             (gdk_x11_get_default_root_xwindow ())
#define GDK_SCREEN_XNUMBER(screen) (gdk_x11_screen_get_screen_number (screen))
#define GDK_SCREEN_XSCREEN(screen) (gdk_x11_screen_get_xscreen (screen))
#define GDK_SCREEN_XDISPLAY(screen) (gdk_x11_display_get_xdisplay (gdk_screen_get_display (screen)))
#define GDK_X11_SCREEN_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_X11_SCREEN, GdkX11ScreenClass))
#define GDK_IS_X11_SCREEN_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_X11_SCREEN))
#define GDK_IS_X11_SCREEN(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_X11_SCREEN))
#define GDK_X11_SCREEN_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_X11_SCREEN, GdkX11ScreenClass))
#define GDK_X11_SCREEN(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_X11_SCREEN, GdkX11Screen))
#define GDK_TYPE_X11_SCREEN              (gdk_x11_screen_get_type ())
#define GDK_IS_X11_MONITOR(object)     (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_X11_MONITOR))
#define GDK_X11_MONITOR(object)        (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_X11_MONITOR, GdkX11Monitor))
#define GDK_TYPE_X11_MONITOR           (gdk_x11_monitor_get_type ())
#define GDK_X11_KEYMAP_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_X11_KEYMAP, GdkX11KeymapClass))
#define GDK_IS_X11_KEYMAP_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_X11_KEYMAP))
#define GDK_IS_X11_KEYMAP(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_X11_KEYMAP))
#define GDK_X11_KEYMAP_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_X11_KEYMAP, GdkX11KeymapClass))
#define GDK_X11_KEYMAP(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_X11_KEYMAP, GdkX11Keymap))
#define GDK_TYPE_X11_KEYMAP              (gdk_x11_keymap_get_type())
#define GDK_X11_IS_GL_CONTEXT(obj)	(G_TYPE_CHECK_INSTANCE_TYPE ((obj), GDK_TYPE_X11_GL_CONTEXT))
#define GDK_X11_GL_CONTEXT(obj)		(G_TYPE_CHECK_INSTANCE_CAST ((obj), GDK_TYPE_X11_GL_CONTEXT, GdkX11GLContext))
#define GDK_TYPE_X11_GL_CONTEXT		(gdk_x11_gl_context_get_type ())
#define GDK_X11_DRAG_CONTEXT_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_X11_DRAG_CONTEXT, GdkX11DragContextClass))
#define GDK_IS_X11_DRAG_CONTEXT_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_X11_DRAG_CONTEXT))
#define GDK_IS_X11_DRAG_CONTEXT(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_X11_DRAG_CONTEXT))
#define GDK_X11_DRAG_CONTEXT_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_X11_DRAG_CONTEXT, GdkX11DragContextClass))
#define GDK_X11_DRAG_CONTEXT(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_X11_DRAG_CONTEXT, GdkX11DragContext))
#define GDK_TYPE_X11_DRAG_CONTEXT              (gdk_x11_drag_context_get_type ())
#define GDK_X11_DISPLAY_MANAGER_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_X11_DISPLAY_MANAGER, GdkX11DisplayManagerClass))
#define GDK_IS_X11_DISPLAY_MANAGER_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_X11_DISPLAY_MANAGER))
#define GDK_IS_X11_DISPLAY_MANAGER(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_X11_DISPLAY_MANAGER))
#define GDK_X11_DISPLAY_MANAGER_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_X11_DISPLAY_MANAGER, GdkX11DisplayManagerClass))
#define GDK_X11_DISPLAY_MANAGER(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_X11_DISPLAY_MANAGER, GdkX11DisplayManager))
#define GDK_TYPE_X11_DISPLAY_MANAGER              (gdk_x11_display_manager_get_type())
#define GDK_DISPLAY_XDISPLAY(display) (gdk_x11_display_get_xdisplay (display))
#define GDK_X11_DISPLAY_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_X11_DISPLAY, GdkX11DisplayClass))
#define GDK_IS_X11_DISPLAY_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_X11_DISPLAY))
#define GDK_IS_X11_DISPLAY(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_X11_DISPLAY))
#define GDK_X11_DISPLAY_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_X11_DISPLAY, GdkX11DisplayClass))
#define GDK_X11_DISPLAY(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_X11_DISPLAY, GdkX11Display))
#define GDK_TYPE_X11_DISPLAY              (gdk_x11_display_get_type())
#define GDK_X11_DEVICE_MANAGER_XI2_GET_CLASS(o) (G_TYPE_INSTANCE_GET_CLASS ((o), GDK_TYPE_X11_DEVICE_MANAGER_XI2, GdkX11DeviceManagerXI2Class))
#define GDK_IS_X11_DEVICE_MANAGER_XI2_CLASS(c)  (G_TYPE_CHECK_CLASS_TYPE ((c), GDK_TYPE_X11_DEVICE_MANAGER_XI2))
#define GDK_IS_X11_DEVICE_MANAGER_XI2(o)        (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_X11_DEVICE_MANAGER_XI2))
#define GDK_X11_DEVICE_MANAGER_XI2_CLASS(c)     (G_TYPE_CHECK_CLASS_CAST ((c), GDK_TYPE_X11_DEVICE_MANAGER_XI2, GdkX11DeviceManagerXI2Class))
#define GDK_X11_DEVICE_MANAGER_XI2(o)           (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_X11_DEVICE_MANAGER_XI2, GdkX11DeviceManagerXI2))
#define GDK_TYPE_X11_DEVICE_MANAGER_XI2         (gdk_x11_device_manager_xi2_get_type ())
#define GDK_X11_DEVICE_MANAGER_XI_GET_CLASS(o) (G_TYPE_INSTANCE_GET_CLASS ((o), GDK_TYPE_X11_DEVICE_MANAGER_XI, GdkX11DeviceManagerXIClass))
#define GDK_IS_X11_DEVICE_MANAGER_XI_CLASS(c)  (G_TYPE_CHECK_CLASS_TYPE ((c), GDK_TYPE_X11_DEVICE_MANAGER_XI))
#define GDK_IS_X11_DEVICE_MANAGER_XI(o)        (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_X11_DEVICE_MANAGER_XI))
#define GDK_X11_DEVICE_MANAGER_XI_CLASS(c)     (G_TYPE_CHECK_CLASS_CAST ((c), GDK_TYPE_X11_DEVICE_MANAGER_XI, GdkX11DeviceManagerXIClass))
#define GDK_X11_DEVICE_MANAGER_XI(o)           (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_X11_DEVICE_MANAGER_XI, GdkX11DeviceManagerXI))
#define GDK_TYPE_X11_DEVICE_MANAGER_XI         (gdk_x11_device_manager_xi_get_type ())
#define GDK_X11_DEVICE_MANAGER_CORE_GET_CLASS(o) (G_TYPE_INSTANCE_GET_CLASS ((o), GDK_TYPE_X11_DEVICE_MANAGER_CORE, GdkX11DeviceManagerCoreClass))
#define GDK_IS_X11_DEVICE_MANAGER_CORE_CLASS(c)  (G_TYPE_CHECK_CLASS_TYPE ((c), GDK_TYPE_X11_DEVICE_MANAGER_CORE))
#define GDK_IS_X11_DEVICE_MANAGER_CORE(o)        (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_X11_DEVICE_MANAGER_CORE))
#define GDK_X11_DEVICE_MANAGER_CORE_CLASS(c)     (G_TYPE_CHECK_CLASS_CAST ((c), GDK_TYPE_X11_DEVICE_MANAGER_CORE, GdkX11DeviceManagerCoreClass))
#define GDK_X11_DEVICE_MANAGER_CORE(o)           (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_X11_DEVICE_MANAGER_CORE, GdkX11DeviceManagerCore))
#define GDK_TYPE_X11_DEVICE_MANAGER_CORE         (gdk_x11_device_manager_core_get_type ())
#define GDK_X11_DEVICE_XI2_GET_CLASS(o) (G_TYPE_INSTANCE_GET_CLASS ((o), GDK_TYPE_X11_DEVICE_XI2, GdkX11DeviceXI2Class))
#define GDK_IS_X11_DEVICE_XI2_CLASS(c)  (G_TYPE_CHECK_CLASS_TYPE ((c), GDK_TYPE_X11_DEVICE_XI2))
#define GDK_IS_X11_DEVICE_XI2(o)        (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_X11_DEVICE_XI2))
#define GDK_X11_DEVICE_XI2_CLASS(c)     (G_TYPE_CHECK_CLASS_CAST ((c), GDK_TYPE_X11_DEVICE_XI2, GdkX11DeviceXI2Class))
#define GDK_X11_DEVICE_XI2(o)           (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_X11_DEVICE_XI2, GdkX11DeviceXI2))
#define GDK_TYPE_X11_DEVICE_XI2         (gdk_x11_device_xi2_get_type ())
#define GDK_X11_DEVICE_CORE_GET_CLASS(o) (G_TYPE_INSTANCE_GET_CLASS ((o), GDK_TYPE_X11_DEVICE_CORE, GdkX11DeviceCoreClass))
#define GDK_IS_X11_DEVICE_CORE_CLASS(c)  (G_TYPE_CHECK_CLASS_TYPE ((c), GDK_TYPE_X11_DEVICE_CORE))
#define GDK_IS_X11_DEVICE_CORE(o)        (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_X11_DEVICE_CORE))
#define GDK_X11_DEVICE_CORE_CLASS(c)     (G_TYPE_CHECK_CLASS_CAST ((c), GDK_TYPE_X11_DEVICE_CORE, GdkX11DeviceCoreClass))
#define GDK_X11_DEVICE_CORE(o)           (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_X11_DEVICE_CORE, GdkX11DeviceCore))
#define GDK_TYPE_X11_DEVICE_CORE         (gdk_x11_device_core_get_type ())
#define GDK_CURSOR_XCURSOR(cursor)    (gdk_x11_cursor_get_xcursor (cursor))
#define GDK_CURSOR_XDISPLAY(cursor)   (gdk_x11_cursor_get_xdisplay (cursor))
#define GDK_X11_CURSOR_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_X11_CURSOR, GdkX11CursorClass))
#define GDK_IS_X11_CURSOR_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_X11_CURSOR))
#define GDK_IS_X11_CURSOR(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_X11_CURSOR))
#define GDK_X11_CURSOR_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_X11_CURSOR, GdkX11CursorClass))
#define GDK_X11_CURSOR(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_X11_CURSOR, GdkX11Cursor))
#define GDK_TYPE_X11_CURSOR              (gdk_x11_cursor_get_type ())
#define GDK_X11_APP_LAUNCH_CONTEXT_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_X11_APP_LAUNCH_CONTEXT, GdkX11AppLaunchContextClass))
#define GDK_IS_X11_APP_LAUNCH_CONTEXT_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_X11_APP_LAUNCH_CONTEXT))
#define GDK_IS_X11_APP_LAUNCH_CONTEXT(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_X11_APP_LAUNCH_CONTEXT))
#define GDK_X11_APP_LAUNCH_CONTEXT_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_X11_APP_LAUNCH_CONTEXT, GdkX11AppLaunchContextClass))
#define GDK_X11_APP_LAUNCH_CONTEXT(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_X11_APP_LAUNCH_CONTEXT, GdkX11AppLaunchContext))
#define GDK_TYPE_X11_APP_LAUNCH_CONTEXT              (gdk_x11_app_launch_context_get_type ())
#define GDK_WINDOW_IMPL_X11_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_WINDOW_IMPL_X11, GdkWindowImplX11Class))
#define GDK_IS_WINDOW_IMPL_X11_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_WINDOW_IMPL_X11))
#define GDK_IS_WINDOW_IMPL_X11(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_WINDOW_IMPL_X11))
#define GDK_WINDOW_IMPL_X11_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_WINDOW_IMPL_X11, GdkWindowImplX11Class))
#define GDK_WINDOW_IMPL_X11(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_WINDOW_IMPL_X11, GdkWindowImplX11))
#define GDK_TYPE_WINDOW_IMPL_X11              (gdk_window_impl_x11_get_type ())
#define GDK_SCREEN_XDISPLAY(screen)   (GDK_X11_SCREEN (screen)->xdisplay)
#define GDK_WINDOW_XID(win)           (GDK_WINDOW_IMPL_X11(GDK_WINDOW (win)->impl)->xid)
#define GDK_WINDOW_XDISPLAY(win)      (GDK_X11_SCREEN (GDK_WINDOW_SCREEN (win))->xdisplay)
#define GDK_DISPLAY_XDISPLAY(display) (GDK_X11_DISPLAY(display)->xdisplay)
#define GDK_WINDOW_IS_X11(win)        (GDK_IS_WINDOW_IMPL_X11 ((win)->impl))
#define GDK_WINDOW_XROOTWIN(win)      (GDK_X11_SCREEN (GDK_WINDOW_SCREEN (win))->xroot_window)
#define GDK_WINDOW_DISPLAY(win)       (GDK_X11_SCREEN (GDK_WINDOW_SCREEN (win))->display)
#define GDK_WINDOW_SCREEN(win)        (gdk_window_get_screen (win))
#define GDK_SCREEN_XROOTWIN(screen)   (GDK_X11_SCREEN (screen)->xroot_window)
#define GDK_SCREEN_DISPLAY(screen)    (GDK_X11_SCREEN (screen)->display)
#define GDK_EVENT_TRANSLATOR_GET_IFACE(o) (G_TYPE_INSTANCE_GET_INTERFACE  ((o), GDK_TYPE_EVENT_TRANSLATOR, GdkEventTranslatorIface))
#define GDK_IS_EVENT_TRANSLATOR(o)        (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_EVENT_TRANSLATOR))
#define GDK_EVENT_TRANSLATOR(o)           (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_EVENT_TRANSLATOR, GdkEventTranslator))
#define GDK_TYPE_EVENT_TRANSLATOR         (_gdk_x11_event_translator_get_type ())
#define PROP_MWM_INFO_ELEMENTS PROP_MOTIF_WM_INFO_ELEMENTS
#define PROP_MOTIF_WM_INFO_ELEMENTS 2
#define PROP_MWM_HINTS_ELEMENTS PROP_MOTIF_WM_HINTS_ELEMENTS
#define PROP_MOTIF_WM_HINTS_ELEMENTS 5
#define MWM_INFO_STARTUP_CUSTOM		(1L<<1)
#define MWM_INFO_STARTUP_STANDARD	(1L<<0)
#define GDK_IS_MIR_WINDOW(object)         (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_MIR_WINDOW))
#define GDK_TYPE_MIR_WINDOW               (gdk_mir_window_get_type ())
#define GDK_MIR_IS_GL_CONTEXT(obj)        (G_TYPE_CHECK_INSTANCE_TYPE ((obj), GDK_TYPE_MIR_GL_CONTEXT))
#define GDK_TYPE_MIR_GL_CONTEXT           (gdk_mir_gl_context_get_type ())
#define GDK_IS_MIR_DISPLAY(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_MIR_DISPLAY))
#define GDK_TYPE_MIR_DISPLAY              (gdk_mir_display_get_type ())
#define GDK_MIR_GL_CONTEXT(obj)   (G_TYPE_CHECK_INSTANCE_CAST ((obj), GDK_TYPE_MIR_GL_CONTEXT, GdkMirGLContext))
#define GDK_IS_WINDOW_IMPL_MIR(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_MIR_WINDOW_IMPL))
#define GDK_MIR_WINDOW_IMPL(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_MIR_WINDOW_IMPL, GdkMirWindowImpl))
#define GDK_TYPE_MIR_WINDOW_IMPL              (gdk_mir_window_impl_get_type ())
#define GDK_TYPE_COLOR (gdk_color_get_type ())
#define GDK_WINDOW_IMPL_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_WINDOW_IMPL, GdkWindowImplClass))
#define GDK_IS_WINDOW_IMPL_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_WINDOW_IMPL))
#define GDK_IS_WINDOW_IMPL(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_WINDOW_IMPL))
#define GDK_WINDOW_IMPL_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_WINDOW_IMPL, GdkWindowImplClass))
#define GDK_WINDOW_IMPL(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_WINDOW_IMPL, GdkWindowImpl))
#define GDK_TYPE_WINDOW_IMPL           (gdk_window_impl_get_type ())
#define GDK_WINDOW_GET_CLASS(obj)    (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_WINDOW, GdkWindowClass))
#define GDK_IS_WINDOW_CLASS(klass)   (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_WINDOW))
#define GDK_IS_WINDOW(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_WINDOW))
#define GDK_WINDOW_CLASS(klass)      (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_WINDOW, GdkWindowClass))
#define GDK_WINDOW(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_WINDOW, GdkWindow))
#define GDK_TYPE_WINDOW              (gdk_window_get_type ())
#define GDK_IS_VISUAL(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_VISUAL))
#define GDK_VISUAL(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_VISUAL, GdkVisual))
#define GDK_TYPE_VISUAL              (gdk_visual_get_type ())
#define GDK_NONE            _GDK_MAKE_ATOM (0)
#define GDK_POINTER_TO_ATOM(ptr)  ((GdkAtom)(ptr))
#define GDK_ATOM_TO_POINTER(atom) (atom)
#define GDK_PARENT_RELATIVE  1L
#define GDK_CURRENT_TIME     0L
#define GDK_THREADS_LEAVE() gdk_threads_leave()
#define GDK_THREADS_ENTER() gdk_threads_enter()
#define GDK_THREADS_DEPRECATED _GDK_EXTERN
#define GDK_SELECTION_TYPE_STRING 	_GDK_MAKE_ATOM (31)
#define GDK_SELECTION_TYPE_WINDOW 	_GDK_MAKE_ATOM (33)
#define GDK_SELECTION_TYPE_PIXMAP 	_GDK_MAKE_ATOM (20)
#define GDK_SELECTION_TYPE_INTEGER 	_GDK_MAKE_ATOM (19)
#define GDK_SELECTION_TYPE_DRAWABLE 	_GDK_MAKE_ATOM (17)
#define GDK_SELECTION_TYPE_COLORMAP 	_GDK_MAKE_ATOM (7)
#define GDK_SELECTION_TYPE_BITMAP 	_GDK_MAKE_ATOM (5)
#define GDK_SELECTION_TYPE_ATOM 	_GDK_MAKE_ATOM (4)
#define GDK_TARGET_STRING 		_GDK_MAKE_ATOM (31)
#define GDK_TARGET_PIXMAP 		_GDK_MAKE_ATOM (20)
#define GDK_TARGET_DRAWABLE 		_GDK_MAKE_ATOM (17)
#define GDK_TARGET_COLORMAP 		_GDK_MAKE_ATOM (7)
#define GDK_TARGET_BITMAP 		_GDK_MAKE_ATOM (5)
#define GDK_SELECTION_CLIPBOARD 	_GDK_MAKE_ATOM (69)
#define GDK_SELECTION_SECONDARY 	_GDK_MAKE_ATOM (2)
#define GDK_SELECTION_PRIMARY 		_GDK_MAKE_ATOM (1)
#define GDK_IS_SEAT(o) (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_SEAT))
#define GDK_SEAT(o)    (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_SEAT, GdkSeat))
#define GDK_TYPE_SEAT  (gdk_seat_get_type ())
#define GDK_IS_SCREEN(object)      (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_SCREEN))
#define GDK_SCREEN(object)         (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_SCREEN, GdkScreen))
#define GDK_TYPE_SCREEN            (gdk_screen_get_type ())
#define GDK_TYPE_RGBA (gdk_rgba_get_type ())
#define GDK_TYPE_RECTANGLE (gdk_rectangle_get_type ())
#define GDK_MONITOR_GET_CLASS(obj)  (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_MONITOR, GdkMonitorClass))
#define GDK_IS_MONITOR_CLASS(klass) (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_MONITOR))
#define GDK_MONITOR_CLASS(klass)    (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_MONITOR, GdkMonitorClass))
#define GDK_IS_MONITOR(object)     (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_MONITOR))
#define GDK_MONITOR(object)        (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_MONITOR, GdkMonitor))
#define GDK_TYPE_MONITOR           (gdk_monitor_get_type ())
#define GDK_PRIORITY_EVENTS (G_PRIORITY_DEFAULT)
#define GDK_LogGrabInfo 0x1008fe25
#define GDK_LogWindowTree 0x1008fe24
#define GDK_Prev_VMode 0x1008fe23
#define GDK_Next_VMode 0x1008fe22
#define GDK_ClearGrab 0x1008fe21
#define GDK_Ungrab 0x1008fe20
#define GDK_Switch_VT_12 0x1008fe0c
#define GDK_Switch_VT_11 0x1008fe0b
#define GDK_Switch_VT_10 0x1008fe0a
#define GDK_Switch_VT_9 0x1008fe09
#define GDK_Switch_VT_8 0x1008fe08
#define GDK_Switch_VT_7 0x1008fe07
#define GDK_Switch_VT_6 0x1008fe06
#define GDK_Switch_VT_5 0x1008fe05
#define GDK_Switch_VT_4 0x1008fe04
#define GDK_Switch_VT_3 0x1008fe03
#define GDK_Switch_VT_2 0x1008fe02
#define GDK_Switch_VT_1 0x1008fe01
#define GDK_AudioMicMute 0x1008ffb2
#define GDK_TouchpadOff 0x1008ffb1
#define GDK_TouchpadOn 0x1008ffb0
#define GDK_TouchpadToggle 0x1008ffa9
#define GDK_Hibernate 0x1008ffa8
#define GDK_Suspend 0x1008ffa7
#define GDK_Blue 0x1008ffa6
#define GDK_Yellow 0x1008ffa5
#define GDK_Green 0x1008ffa4
#define GDK_Red 0x1008ffa3
#define GDK_TopMenu 0x1008ffa2
#define GDK_View 0x1008ffa1
#define GDK_SelectButton 0x1008ffa0
#define GDK_Time 0x1008ff9f
#define GDK_FrameForward 0x1008ff9e
#define GDK_FrameBack 0x1008ff9d
#define GDK_CycleAngle 0x1008ff9c
#define GDK_AudioCycleTrack 0x1008ff9b
#define GDK_Subtitle 0x1008ff9a
#define GDK_AudioRandomPlay 0x1008ff99
#define GDK_AudioRepeat 0x1008ff98
#define GDK_AudioForward 0x1008ff97
#define GDK_UWB 0x1008ff96
#define GDK_WLAN 0x1008ff95
#define GDK_Bluetooth 0x1008ff94
#define GDK_Battery 0x1008ff93
#define GDK_Music 0x1008ff92
#define GDK_Pictures 0x1008ff91
#define GDK_MailForward 0x1008ff90
#define GDK_WebCam 0x1008ff8f
#define GDK_Messenger 0x1008ff8e
#define GDK_Away 0x1008ff8d
#define GDK_ZoomOut 0x1008ff8c
#define GDK_ZoomIn 0x1008ff8b
#define GDK_Xfer 0x1008ff8a
#define GDK_Word 0x1008ff89
#define GDK_WheelButton 0x1008ff88
#define GDK_Video 0x1008ff87
#define GDK_User2KB 0x1008ff86
#define GDK_User1KB 0x1008ff85
#define GDK_UserPB 0x1008ff84
#define GDK_Travel 0x1008ff82
#define GDK_Tools 0x1008ff81
#define GDK_Terminal 0x1008ff80
#define GDK_TaskPane 0x1008ff7f
#define GDK_Support 0x1008ff7e
#define GDK_SplitScreen 0x1008ff7d
#define GDK_Spell 0x1008ff7c
#define GDK_Send 0x1008ff7b
#define GDK_ScrollClick 0x1008ff7a
#define GDK_ScrollDown 0x1008ff79
#define GDK_ScrollUp 0x1008ff78
#define GDK_Save 0x1008ff77
#define GDK_RotationKB 0x1008ff76
#define GDK_RotationPB 0x1008ff75
#define GDK_RotateWindows 0x1008ff74
#define GDK_Reload 0x1008ff73
#define GDK_Reply 0x1008ff72
#define GDK_Phone 0x1008ff6e
#define GDK_Paste 0x1008ff6d
#define GDK_Option 0x1008ff6c
#define GDK_Open 0x1008ff6b
#define GDK_OfficeHome 0x1008ff6a
#define GDK_News 0x1008ff69
#define GDK_New 0x1008ff68
#define GDK_MySites 0x1008ff67
#define GDK_MenuPB 0x1008ff66
#define GDK_MenuKB 0x1008ff65
#define GDK_Meeting 0x1008ff63
#define GDK_Market 0x1008ff62
#define GDK_LogOff 0x1008ff61
#define GDK_iTouch 0x1008ff60
#define GDK_Go 0x1008ff5f
#define GDK_Game 0x1008ff5e
#define GDK_Explorer 0x1008ff5d
#define GDK_Excel 0x1008ff5c
#define GDK_Documents 0x1008ff5b
#define GDK_DOS 0x1008ff5a
#define GDK_Display 0x1008ff59
#define GDK_Cut 0x1008ff58
#define GDK_Copy 0x1008ff57
#define GDK_Close 0x1008ff56
#define GDK_WindowClear 0x1008ff55
#define GDK_CD 0x1008ff53
#define GDK_Book 0x1008ff52
#define GDK_ApplicationRight 0x1008ff51
#define GDK_ApplicationLeft 0x1008ff50
#define GDK_LaunchF 0x1008ff4f
#define GDK_LaunchE 0x1008ff4e
#define GDK_LaunchD 0x1008ff4d
#define GDK_LaunchC 0x1008ff4c
#define GDK_LaunchB 0x1008ff4b
#define GDK_LaunchA 0x1008ff4a
#define GDK_Launch9 0x1008ff49
#define GDK_Launch8 0x1008ff48
#define GDK_Launch7 0x1008ff47
#define GDK_Launch6 0x1008ff46
#define GDK_Launch5 0x1008ff45
#define GDK_Launch4 0x1008ff44
#define GDK_Launch3 0x1008ff43
#define GDK_Launch2 0x1008ff42
#define GDK_Launch1 0x1008ff41
#define GDK_Launch0 0x1008ff40
#define GDK_BackForward 0x1008ff3f
#define GDK_AudioRewind 0x1008ff3e
#define GDK_Community 0x1008ff3d
#define GDK_Finance 0x1008ff3c
#define GDK_BrightnessAdjust 0x1008ff3b
#define GDK_HotLinks 0x1008ff3a
#define GDK_AddFavorite 0x1008ff39
#define GDK_OpenURL 0x1008ff38
#define GDK_History 0x1008ff37
#define GDK_Shop 0x1008ff36
#define GDK_LightBulb 0x1008ff35
#define GDK_VendorHome 0x1008ff34
#define GDK_MyComputer 0x1008ff33
#define GDK_AudioMedia 0x1008ff32
#define GDK_AudioPause 0x1008ff31
#define GDK_Favorites 0x1008ff30
#define GDK_Sleep 0x1008ff2f
#define GDK_WWW 0x1008ff2e
#define GDK_ScreenSaver 0x1008ff2d
#define GDK_Eject 0x1008ff2c
#define GDK_WakeUp 0x1008ff2b
#define GDK_PowerOff 0x1008ff2a
#define GDK_Refresh 0x1008ff29
#define GDK_Stop 0x1008ff28
#define GDK_Forward 0x1008ff27
#define GDK_Back 0x1008ff26
#define GDK_RockerEnter 0x1008ff25
#define GDK_RockerDown 0x1008ff24
#define GDK_RockerUp 0x1008ff23
#define GDK_ContrastAdjust 0x1008ff22
#define GDK_PowerDown 0x1008ff21
#define GDK_Calendar 0x1008ff20
#define GDK_ToDoList 0x1008ff1f
#define GDK_Memo 0x1008ff1e
#define GDK_Calculator 0x1008ff1d
#define GDK_AudioRecord 0x1008ff1c
#define GDK_Search 0x1008ff1b
#define GDK_Start 0x1008ff1a
#define GDK_Mail 0x1008ff19
#define GDK_HomePage 0x1008ff18
#define GDK_AudioNext 0x1008ff17
#define GDK_AudioPrev 0x1008ff16
#define GDK_AudioStop 0x1008ff15
#define GDK_AudioPlay 0x1008ff14
#define GDK_AudioRaiseVolume 0x1008ff13
#define GDK_AudioMute 0x1008ff12
#define GDK_AudioLowerVolume 0x1008ff11
#define GDK_Standby 0x1008ff10
#define GDK_KbdBrightnessDown 0x1008ff06
#define GDK_KbdBrightnessUp 0x1008ff05
#define GDK_KbdLightOnOff 0x1008ff04
#define GDK_MonBrightnessDown 0x1008ff03
#define GDK_MonBrightnessUp 0x1008ff02
#define GDK_ModeLock 0x1008ff01
#define GDK_Sinh_kunddaliya 0x1000df4
#define GDK_Sinh_luu2 0x1000df3
#define GDK_Sinh_ruu2 0x1000df2
#define GDK_Sinh_lu2 0x1000ddf
#define GDK_Sinh_au2 0x1000dde
#define GDK_Sinh_oo2 0x1000ddd
#define GDK_Sinh_o2 0x1000ddc
#define GDK_Sinh_ai2 0x1000ddb
#define GDK_Sinh_ee2 0x1000dda
#define GDK_Sinh_e2 0x1000dd9
#define GDK_Sinh_ru2 0x1000dd8
#define GDK_Sinh_uu2 0x1000dd6
#define GDK_Sinh_u2 0x1000dd4
#define GDK_Sinh_ii2 0x1000dd3
#define GDK_Sinh_i2 0x1000dd2
#define GDK_Sinh_aee2 0x1000dd1
#define GDK_Sinh_ae2 0x1000dd0
#define GDK_Sinh_aa2 0x1000dcf
#define GDK_Sinh_al 0x1000dca
#define GDK_Sinh_fa 0x1000dc6
#define GDK_Sinh_lla 0x1000dc5
#define GDK_Sinh_ha 0x1000dc4
#define GDK_Sinh_sa 0x1000dc3
#define GDK_Sinh_ssha 0x1000dc2
#define GDK_Sinh_sha 0x1000dc1
#define GDK_Sinh_va 0x1000dc0
#define GDK_Sinh_la 0x1000dbd
#define GDK_Sinh_ra 0x1000dbb
#define GDK_Sinh_ya 0x1000dba
#define GDK_Sinh_mba 0x1000db9
#define GDK_Sinh_ma 0x1000db8
#define GDK_Sinh_bha 0x1000db7
#define GDK_Sinh_ba 0x1000db6
#define GDK_Sinh_pha 0x1000db5
#define GDK_Sinh_pa 0x1000db4
#define GDK_Sinh_ndha 0x1000db3
#define GDK_Sinh_na 0x1000db1
#define GDK_Sinh_dhha 0x1000db0
#define GDK_Sinh_dha 0x1000daf
#define GDK_Sinh_thha 0x1000dae
#define GDK_Sinh_tha 0x1000dad
#define GDK_Sinh_ndda 0x1000dac
#define GDK_Sinh_nna 0x1000dab
#define GDK_Sinh_ddha 0x1000daa
#define GDK_Sinh_dda 0x1000da9
#define GDK_Sinh_ttha 0x1000da8
#define GDK_Sinh_tta 0x1000da7
#define GDK_Sinh_nja 0x1000da6
#define GDK_Sinh_jnya 0x1000da5
#define GDK_Sinh_nya 0x1000da4
#define GDK_Sinh_jha 0x1000da3
#define GDK_Sinh_ja 0x1000da2
#define GDK_Sinh_cha 0x1000da1
#define GDK_Sinh_ca 0x1000da0
#define GDK_Sinh_nga 0x1000d9f
#define GDK_Sinh_ng2 0x1000d9e
#define GDK_Sinh_gha 0x1000d9d
#define GDK_Sinh_ga 0x1000d9c
#define GDK_Sinh_kha 0x1000d9b
#define GDK_Sinh_ka 0x1000d9a
#define GDK_Sinh_au 0x1000d96
#define GDK_Sinh_oo 0x1000d95
#define GDK_Sinh_o 0x1000d94
#define GDK_Sinh_ai 0x1000d93
#define GDK_Sinh_ee 0x1000d92
#define GDK_Sinh_e 0x1000d91
#define GDK_Sinh_luu 0x1000d90
#define GDK_Sinh_lu 0x1000d8f
#define GDK_Sinh_rii 0x1000d8e
#define GDK_Sinh_ri 0x1000d8d
#define GDK_Sinh_uu 0x1000d8c
#define GDK_Sinh_u 0x1000d8b
#define GDK_Sinh_ii 0x1000d8a
#define GDK_Sinh_i 0x1000d89
#define GDK_Sinh_aee 0x1000d88
#define GDK_Sinh_ae 0x1000d87
#define GDK_Sinh_aa 0x1000d86
#define GDK_Sinh_a 0x1000d85
#define GDK_Sinh_h2 0x1000d83
#define GDK_Sinh_ng 0x1000d82
#define GDK_braille_dots_12345678 0x10028ff
#define GDK_braille_dots_2345678 0x10028fe
#define GDK_braille_dots_1345678 0x10028fd
#define GDK_braille_dots_345678 0x10028fc
#define GDK_braille_dots_1245678 0x10028fb
#define GDK_braille_dots_245678 0x10028fa
#define GDK_braille_dots_145678 0x10028f9
#define GDK_braille_dots_45678 0x10028f8
#define GDK_braille_dots_1235678 0x10028f7
#define GDK_braille_dots_235678 0x10028f6
#define GDK_braille_dots_135678 0x10028f5
#define GDK_braille_dots_35678 0x10028f4
#define GDK_braille_dots_125678 0x10028f3
#define GDK_braille_dots_25678 0x10028f2
#define GDK_braille_dots_15678 0x10028f1
#define GDK_braille_dots_5678 0x10028f0
#define GDK_braille_dots_1234678 0x10028ef
#define GDK_braille_dots_234678 0x10028ee
#define GDK_braille_dots_134678 0x10028ed
#define GDK_braille_dots_34678 0x10028ec
#define GDK_braille_dots_124678 0x10028eb
#define GDK_braille_dots_24678 0x10028ea
#define GDK_braille_dots_14678 0x10028e9
#define GDK_braille_dots_4678 0x10028e8
#define GDK_braille_dots_123678 0x10028e7
#define GDK_braille_dots_23678 0x10028e6
#define GDK_braille_dots_13678 0x10028e5
#define GDK_braille_dots_3678 0x10028e4
#define GDK_braille_dots_12678 0x10028e3
#define GDK_braille_dots_2678 0x10028e2
#define GDK_braille_dots_1678 0x10028e1
#define GDK_braille_dots_678 0x10028e0
#define GDK_braille_dots_1234578 0x10028df
#define GDK_braille_dots_234578 0x10028de
#define GDK_braille_dots_134578 0x10028dd
#define GDK_braille_dots_34578 0x10028dc
#define GDK_braille_dots_124578 0x10028db
#define GDK_braille_dots_24578 0x10028da
#define GDK_braille_dots_14578 0x10028d9
#define GDK_braille_dots_4578 0x10028d8
#define GDK_braille_dots_123578 0x10028d7
#define GDK_braille_dots_23578 0x10028d6
#define GDK_braille_dots_13578 0x10028d5
#define GDK_braille_dots_3578 0x10028d4
#define GDK_braille_dots_12578 0x10028d3
#define GDK_braille_dots_2578 0x10028d2
#define GDK_braille_dots_1578 0x10028d1
#define GDK_braille_dots_578 0x10028d0
#define GDK_braille_dots_123478 0x10028cf
#define GDK_braille_dots_23478 0x10028ce
#define GDK_braille_dots_13478 0x10028cd
#define GDK_braille_dots_3478 0x10028cc
#define GDK_braille_dots_12478 0x10028cb
#define GDK_braille_dots_2478 0x10028ca
#define GDK_braille_dots_1478 0x10028c9
#define GDK_braille_dots_478 0x10028c8
#define GDK_braille_dots_12378 0x10028c7
#define GDK_braille_dots_2378 0x10028c6
#define GDK_braille_dots_1378 0x10028c5
#define GDK_braille_dots_378 0x10028c4
#define GDK_braille_dots_1278 0x10028c3
#define GDK_braille_dots_278 0x10028c2
#define GDK_braille_dots_178 0x10028c1
#define GDK_braille_dots_78 0x10028c0
#define GDK_braille_dots_1234568 0x10028bf
#define GDK_braille_dots_234568 0x10028be
#define GDK_braille_dots_134568 0x10028bd
#define GDK_braille_dots_34568 0x10028bc
#define GDK_braille_dots_124568 0x10028bb
#define GDK_braille_dots_24568 0x10028ba
#define GDK_braille_dots_14568 0x10028b9
#define GDK_braille_dots_4568 0x10028b8
#define GDK_braille_dots_123568 0x10028b7
#define GDK_braille_dots_23568 0x10028b6
#define GDK_braille_dots_13568 0x10028b5
#define GDK_braille_dots_3568 0x10028b4
#define GDK_braille_dots_12568 0x10028b3
#define GDK_braille_dots_2568 0x10028b2
#define GDK_braille_dots_1568 0x10028b1
#define GDK_braille_dots_568 0x10028b0
#define GDK_braille_dots_123468 0x10028af
#define GDK_braille_dots_23468 0x10028ae
#define GDK_braille_dots_13468 0x10028ad
#define GDK_braille_dots_3468 0x10028ac
#define GDK_braille_dots_12468 0x10028ab
#define GDK_braille_dots_2468 0x10028aa
#define GDK_braille_dots_1468 0x10028a9
#define GDK_braille_dots_468 0x10028a8
#define GDK_braille_dots_12368 0x10028a7
#define GDK_braille_dots_2368 0x10028a6
#define GDK_braille_dots_1368 0x10028a5
#define GDK_braille_dots_368 0x10028a4
#define GDK_braille_dots_1268 0x10028a3
#define GDK_braille_dots_268 0x10028a2
#define GDK_braille_dots_168 0x10028a1
#define GDK_braille_dots_68 0x10028a0
#define GDK_braille_dots_123458 0x100289f
#define GDK_braille_dots_23458 0x100289e
#define GDK_braille_dots_13458 0x100289d
#define GDK_braille_dots_3458 0x100289c
#define GDK_braille_dots_12458 0x100289b
#define GDK_braille_dots_2458 0x100289a
#define GDK_braille_dots_1458 0x1002899
#define GDK_braille_dots_458 0x1002898
#define GDK_braille_dots_12358 0x1002897
#define GDK_braille_dots_2358 0x1002896
#define GDK_braille_dots_1358 0x1002895
#define GDK_braille_dots_358 0x1002894
#define GDK_braille_dots_1258 0x1002893
#define GDK_braille_dots_258 0x1002892
#define GDK_braille_dots_158 0x1002891
#define GDK_braille_dots_58 0x1002890
#define GDK_braille_dots_12348 0x100288f
#define GDK_braille_dots_2348 0x100288e
#define GDK_braille_dots_1348 0x100288d
#define GDK_braille_dots_348 0x100288c
#define GDK_braille_dots_1248 0x100288b
#define GDK_braille_dots_248 0x100288a
#define GDK_braille_dots_148 0x1002889
#define GDK_braille_dots_48 0x1002888
#define GDK_braille_dots_1238 0x1002887
#define GDK_braille_dots_238 0x1002886
#define GDK_braille_dots_138 0x1002885
#define GDK_braille_dots_38 0x1002884
#define GDK_braille_dots_128 0x1002883
#define GDK_braille_dots_28 0x1002882
#define GDK_braille_dots_18 0x1002881
#define GDK_braille_dots_8 0x1002880
#define GDK_braille_dots_1234567 0x100287f
#define GDK_braille_dots_234567 0x100287e
#define GDK_braille_dots_134567 0x100287d
#define GDK_braille_dots_34567 0x100287c
#define GDK_braille_dots_124567 0x100287b
#define GDK_braille_dots_24567 0x100287a
#define GDK_braille_dots_14567 0x1002879
#define GDK_braille_dots_4567 0x1002878
#define GDK_braille_dots_123567 0x1002877
#define GDK_braille_dots_23567 0x1002876
#define GDK_braille_dots_13567 0x1002875
#define GDK_braille_dots_3567 0x1002874
#define GDK_braille_dots_12567 0x1002873
#define GDK_braille_dots_2567 0x1002872
#define GDK_braille_dots_1567 0x1002871
#define GDK_braille_dots_567 0x1002870
#define GDK_braille_dots_123467 0x100286f
#define GDK_braille_dots_23467 0x100286e
#define GDK_braille_dots_13467 0x100286d
#define GDK_braille_dots_3467 0x100286c
#define GDK_braille_dots_12467 0x100286b
#define GDK_braille_dots_2467 0x100286a
#define GDK_braille_dots_1467 0x1002869
#define GDK_braille_dots_467 0x1002868
#define GDK_braille_dots_12367 0x1002867
#define GDK_braille_dots_2367 0x1002866
#define GDK_braille_dots_1367 0x1002865
#define GDK_braille_dots_367 0x1002864
#define GDK_braille_dots_1267 0x1002863
#define GDK_braille_dots_267 0x1002862
#define GDK_braille_dots_167 0x1002861
#define GDK_braille_dots_67 0x1002860
#define GDK_braille_dots_123457 0x100285f
#define GDK_braille_dots_23457 0x100285e
#define GDK_braille_dots_13457 0x100285d
#define GDK_braille_dots_3457 0x100285c
#define GDK_braille_dots_12457 0x100285b
#define GDK_braille_dots_2457 0x100285a
#define GDK_braille_dots_1457 0x1002859
#define GDK_braille_dots_457 0x1002858
#define GDK_braille_dots_12357 0x1002857
#define GDK_braille_dots_2357 0x1002856
#define GDK_braille_dots_1357 0x1002855
#define GDK_braille_dots_357 0x1002854
#define GDK_braille_dots_1257 0x1002853
#define GDK_braille_dots_257 0x1002852
#define GDK_braille_dots_157 0x1002851
#define GDK_braille_dots_57 0x1002850
#define GDK_braille_dots_12347 0x100284f
#define GDK_braille_dots_2347 0x100284e
#define GDK_braille_dots_1347 0x100284d
#define GDK_braille_dots_347 0x100284c
#define GDK_braille_dots_1247 0x100284b
#define GDK_braille_dots_247 0x100284a
#define GDK_braille_dots_147 0x1002849
#define GDK_braille_dots_47 0x1002848
#define GDK_braille_dots_1237 0x1002847
#define GDK_braille_dots_237 0x1002846
#define GDK_braille_dots_137 0x1002845
#define GDK_braille_dots_37 0x1002844
#define GDK_braille_dots_127 0x1002843
#define GDK_braille_dots_27 0x1002842
#define GDK_braille_dots_17 0x1002841
#define GDK_braille_dots_7 0x1002840
#define GDK_braille_dots_123456 0x100283f
#define GDK_braille_dots_23456 0x100283e
#define GDK_braille_dots_13456 0x100283d
#define GDK_braille_dots_3456 0x100283c
#define GDK_braille_dots_12456 0x100283b
#define GDK_braille_dots_2456 0x100283a
#define GDK_braille_dots_1456 0x1002839
#define GDK_braille_dots_456 0x1002838
#define GDK_braille_dots_12356 0x1002837
#define GDK_braille_dots_2356 0x1002836
#define GDK_braille_dots_1356 0x1002835
#define GDK_braille_dots_356 0x1002834
#define GDK_braille_dots_1256 0x1002833
#define GDK_braille_dots_256 0x1002832
#define GDK_braille_dots_156 0x1002831
#define GDK_braille_dots_56 0x1002830
#define GDK_braille_dots_12346 0x100282f
#define GDK_braille_dots_2346 0x100282e
#define GDK_braille_dots_1346 0x100282d
#define GDK_braille_dots_346 0x100282c
#define GDK_braille_dots_1246 0x100282b
#define GDK_braille_dots_246 0x100282a
#define GDK_braille_dots_146 0x1002829
#define GDK_braille_dots_46 0x1002828
#define GDK_braille_dots_1236 0x1002827
#define GDK_braille_dots_236 0x1002826
#define GDK_braille_dots_136 0x1002825
#define GDK_braille_dots_36 0x1002824
#define GDK_braille_dots_126 0x1002823
#define GDK_braille_dots_26 0x1002822
#define GDK_braille_dots_16 0x1002821
#define GDK_braille_dots_6 0x1002820
#define GDK_braille_dots_12345 0x100281f
#define GDK_braille_dots_2345 0x100281e
#define GDK_braille_dots_1345 0x100281d
#define GDK_braille_dots_345 0x100281c
#define GDK_braille_dots_1245 0x100281b
#define GDK_braille_dots_245 0x100281a
#define GDK_braille_dots_145 0x1002819
#define GDK_braille_dots_45 0x1002818
#define GDK_braille_dots_1235 0x1002817
#define GDK_braille_dots_235 0x1002816
#define GDK_braille_dots_135 0x1002815
#define GDK_braille_dots_35 0x1002814
#define GDK_braille_dots_125 0x1002813
#define GDK_braille_dots_25 0x1002812
#define GDK_braille_dots_15 0x1002811
#define GDK_braille_dots_5 0x1002810
#define GDK_braille_dots_1234 0x100280f
#define GDK_braille_dots_234 0x100280e
#define GDK_braille_dots_134 0x100280d
#define GDK_braille_dots_34 0x100280c
#define GDK_braille_dots_124 0x100280b
#define GDK_braille_dots_24 0x100280a
#define GDK_braille_dots_14 0x1002809
#define GDK_braille_dots_4 0x1002808
#define GDK_braille_dots_123 0x1002807
#define GDK_braille_dots_23 0x1002806
#define GDK_braille_dots_13 0x1002805
#define GDK_braille_dots_3 0x1002804
#define GDK_braille_dots_12 0x1002803
#define GDK_braille_dots_2 0x1002802
#define GDK_braille_dots_1 0x1002801
#define GDK_braille_blank 0x1002800
#define GDK_braille_dot_10 0xfffa
#define GDK_braille_dot_9 0xfff9
#define GDK_braille_dot_8 0xfff8
#define GDK_braille_dot_7 0xfff7
#define GDK_braille_dot_6 0xfff6
#define GDK_braille_dot_5 0xfff5
#define GDK_braille_dot_4 0xfff4
#define GDK_braille_dot_3 0xfff3
#define GDK_braille_dot_2 0xfff2
#define GDK_braille_dot_1 0xfff1
#define GDK_stricteq 0x1002263
#define GDK_notidentical 0x1002262
#define GDK_notapproxeq 0x1002247
#define GDK_approxeq 0x1002248
#define GDK_because 0x1002235
#define GDK_tintegral 0x100222d
#define GDK_dintegral 0x100222c
#define GDK_fourthroot 0x100221c
#define GDK_cuberoot 0x100221b
#define GDK_squareroot 0x100221a
#define GDK_containsas 0x100220b
#define GDK_notelementof 0x1002209
#define GDK_elementof 0x1002208
#define GDK_emptyset 0x1002205
#define GDK_partdifferential 0x1002202
#define GDK_ninesubscript 0x1002089
#define GDK_eightsubscript 0x1002088
#define GDK_sevensubscript 0x1002087
#define GDK_sixsubscript 0x1002086
#define GDK_fivesubscript 0x1002085
#define GDK_foursubscript 0x1002084
#define GDK_threesubscript 0x1002083
#define GDK_twosubscript 0x1002082
#define GDK_onesubscript 0x1002081
#define GDK_zerosubscript 0x1002080
#define GDK_ninesuperior 0x1002079
#define GDK_eightsuperior 0x1002078
#define GDK_sevensuperior 0x1002077
#define GDK_sixsuperior 0x1002076
#define GDK_fivesuperior 0x1002075
#define GDK_foursuperior 0x1002074
#define GDK_zerosuperior 0x1002070
#define GDK_EuroSign 0x20ac
#define GDK_DongSign 0x10020ab
#define GDK_NewSheqelSign 0x10020aa
#define GDK_WonSign 0x10020a9
#define GDK_RupeeSign 0x10020a8
#define GDK_PesetaSign 0x10020a7
#define GDK_NairaSign 0x10020a6
#define GDK_MillSign 0x10020a5
#define GDK_LiraSign 0x10020a4
#define GDK_FFrancSign 0x10020a3
#define GDK_CruzeiroSign 0x10020a2
#define GDK_ColonSign 0x10020a1
#define GDK_EcuSign 0x10020a0
#define GDK_uhorn 0x10001b0
#define GDK_Uhorn 0x10001af
#define GDK_ohorn 0x10001a1
#define GDK_Ohorn 0x10001a0
#define GDK_ytilde 0x1001ef9
#define GDK_Ytilde 0x1001ef8
#define GDK_yhook 0x1001ef7
#define GDK_Yhook 0x1001ef6
#define GDK_ybelowdot 0x1001ef5
#define GDK_Ybelowdot 0x1001ef4
#define GDK_uhornbelowdot 0x1001ef1
#define GDK_Uhornbelowdot 0x1001ef0
#define GDK_uhorntilde 0x1001eef
#define GDK_Uhorntilde 0x1001eee
#define GDK_uhornhook 0x1001eed
#define GDK_Uhornhook 0x1001eec
#define GDK_uhorngrave 0x1001eeb
#define GDK_Uhorngrave 0x1001eea
#define GDK_uhornacute 0x1001ee9
#define GDK_Uhornacute 0x1001ee8
#define GDK_uhook 0x1001ee7
#define GDK_Uhook 0x1001ee6
#define GDK_ubelowdot 0x1001ee5
#define GDK_Ubelowdot 0x1001ee4
#define GDK_ohornbelowdot 0x1001ee3
#define GDK_Ohornbelowdot 0x1001ee2
#define GDK_ohorntilde 0x1001ee1
#define GDK_Ohorntilde 0x1001ee0
#define GDK_ohornhook 0x1001edf
#define GDK_Ohornhook 0x1001ede
#define GDK_ohorngrave 0x1001edd
#define GDK_Ohorngrave 0x1001edc
#define GDK_ohornacute 0x1001edb
#define GDK_Ohornacute 0x1001eda
#define GDK_ocircumflexbelowdot 0x1001ed9
#define GDK_Ocircumflexbelowdot 0x1001ed8
#define GDK_ocircumflextilde 0x1001ed7
#define GDK_Ocircumflextilde 0x1001ed6
#define GDK_ocircumflexhook 0x1001ed5
#define GDK_Ocircumflexhook 0x1001ed4
#define GDK_ocircumflexgrave 0x1001ed3
#define GDK_Ocircumflexgrave 0x1001ed2
#define GDK_ocircumflexacute 0x1001ed1
#define GDK_Ocircumflexacute 0x1001ed0
#define GDK_ohook 0x1001ecf
#define GDK_Ohook 0x1001ece
#define GDK_obelowdot 0x1001ecd
#define GDK_Obelowdot 0x1001ecc
#define GDK_ibelowdot 0x1001ecb
#define GDK_Ibelowdot 0x1001eca
#define GDK_ihook 0x1001ec9
#define GDK_Ihook 0x1001ec8
#define GDK_ecircumflexbelowdot 0x1001ec7
#define GDK_Ecircumflexbelowdot 0x1001ec6
#define GDK_ecircumflextilde 0x1001ec5
#define GDK_Ecircumflextilde 0x1001ec4
#define GDK_ecircumflexhook 0x1001ec3
#define GDK_Ecircumflexhook 0x1001ec2
#define GDK_ecircumflexgrave 0x1001ec1
#define GDK_Ecircumflexgrave 0x1001ec0
#define GDK_ecircumflexacute 0x1001ebf
#define GDK_Ecircumflexacute 0x1001ebe
#define GDK_etilde 0x1001ebd
#define GDK_Etilde 0x1001ebc
#define GDK_ehook 0x1001ebb
#define GDK_Ehook 0x1001eba
#define GDK_ebelowdot 0x1001eb9
#define GDK_Ebelowdot 0x1001eb8
#define GDK_abrevebelowdot 0x1001eb7
#define GDK_Abrevebelowdot 0x1001eb6
#define GDK_abrevetilde 0x1001eb5
#define GDK_Abrevetilde 0x1001eb4
#define GDK_abrevehook 0x1001eb3
#define GDK_Abrevehook 0x1001eb2
#define GDK_abrevegrave 0x1001eb1
#define GDK_Abrevegrave 0x1001eb0
#define GDK_abreveacute 0x1001eaf
#define GDK_Abreveacute 0x1001eae
#define GDK_acircumflexbelowdot 0x1001ead
#define GDK_Acircumflexbelowdot 0x1001eac
#define GDK_acircumflextilde 0x1001eab
#define GDK_Acircumflextilde 0x1001eaa
#define GDK_acircumflexhook 0x1001ea9
#define GDK_Acircumflexhook 0x1001ea8
#define GDK_acircumflexgrave 0x1001ea7
#define GDK_Acircumflexgrave 0x1001ea6
#define GDK_acircumflexacute 0x1001ea5
#define GDK_Acircumflexacute 0x1001ea4
#define GDK_ahook 0x1001ea3
#define GDK_Ahook 0x1001ea2
#define GDK_abelowdot 0x1001ea1
#define GDK_Abelowdot 0x1001ea0
#define GDK_lbelowdot 0x1001e37
#define GDK_Lbelowdot 0x1001e36
#define GDK_ezh 0x1000292
#define GDK_EZH 0x10001b7
#define GDK_schwa 0x1000259
#define GDK_SCHWA 0x100018f
#define GDK_obarred 0x1000275
#define GDK_ocaron 0x10001d2
#define GDK_gcaron 0x10001e7
#define GDK_zstroke 0x10001b6
#define GDK_ibreve 0x100012d
#define GDK_xabovedot 0x1001e8b
#define GDK_Obarred 0x100019f
#define GDK_Ocaron 0x10001d1
#define GDK_Gcaron 0x10001e6
#define GDK_Zstroke 0x10001b5
#define GDK_Ibreve 0x100012c
#define GDK_Xabovedot 0x1001e8a
#define GDK_Georgian_fi 0x10010f6
#define GDK_Georgian_hoe 0x10010f5
#define GDK_Georgian_har 0x10010f4
#define GDK_Georgian_we 0x10010f3
#define GDK_Georgian_hie 0x10010f2
#define GDK_Georgian_he 0x10010f1
#define GDK_Georgian_hae 0x10010f0
#define GDK_Georgian_jhan 0x10010ef
#define GDK_Georgian_xan 0x10010ee
#define GDK_Georgian_char 0x10010ed
#define GDK_Georgian_cil 0x10010ec
#define GDK_Georgian_jil 0x10010eb
#define GDK_Georgian_can 0x10010ea
#define GDK_Georgian_chin 0x10010e9
#define GDK_Georgian_shin 0x10010e8
#define GDK_Georgian_qar 0x10010e7
#define GDK_Georgian_ghan 0x10010e6
#define GDK_Georgian_khar 0x10010e5
#define GDK_Georgian_phar 0x10010e4
#define GDK_Georgian_un 0x10010e3
#define GDK_Georgian_tar 0x10010e2
#define GDK_Georgian_san 0x10010e1
#define GDK_Georgian_rae 0x10010e0
#define GDK_Georgian_zhar 0x10010df
#define GDK_Georgian_par 0x10010de
#define GDK_Georgian_on 0x10010dd
#define GDK_Georgian_nar 0x10010dc
#define GDK_Georgian_man 0x10010db
#define GDK_Georgian_las 0x10010da
#define GDK_Georgian_kan 0x10010d9
#define GDK_Georgian_in 0x10010d8
#define GDK_Georgian_tan 0x10010d7
#define GDK_Georgian_zen 0x10010d6
#define GDK_Georgian_vin 0x10010d5
#define GDK_Georgian_en 0x10010d4
#define GDK_Georgian_don 0x10010d3
#define GDK_Georgian_gan 0x10010d2
#define GDK_Georgian_ban 0x10010d1
#define GDK_Georgian_an 0x10010d0
#define GDK_Armenian_apostrophe 0x100055a
#define GDK_Armenian_fe 0x1000586
#define GDK_Armenian_FE 0x1000556
#define GDK_Armenian_o 0x1000585
#define GDK_Armenian_O 0x1000555
#define GDK_Armenian_ke 0x1000584
#define GDK_Armenian_KE 0x1000554
#define GDK_Armenian_pyur 0x1000583
#define GDK_Armenian_PYUR 0x1000553
#define GDK_Armenian_vyun 0x1000582
#define GDK_Armenian_VYUN 0x1000552
#define GDK_Armenian_tso 0x1000581
#define GDK_Armenian_TSO 0x1000551
#define GDK_Armenian_re 0x1000580
#define GDK_Armenian_RE 0x1000550
#define GDK_Armenian_tyun 0x100057f
#define GDK_Armenian_TYUN 0x100054f
#define GDK_Armenian_vev 0x100057e
#define GDK_Armenian_VEV 0x100054e
#define GDK_Armenian_se 0x100057d
#define GDK_Armenian_SE 0x100054d
#define GDK_Armenian_ra 0x100057c
#define GDK_Armenian_RA 0x100054c
#define GDK_Armenian_je 0x100057b
#define GDK_Armenian_JE 0x100054b
#define GDK_Armenian_pe 0x100057a
#define GDK_Armenian_PE 0x100054a
#define GDK_Armenian_cha 0x1000579
#define GDK_Armenian_CHA 0x1000549
#define GDK_Armenian_vo 0x1000578
#define GDK_Armenian_VO 0x1000548
#define GDK_Armenian_sha 0x1000577
#define GDK_Armenian_SHA 0x1000547
#define GDK_Armenian_nu 0x1000576
#define GDK_Armenian_NU 0x1000546
#define GDK_Armenian_hi 0x1000575
#define GDK_Armenian_HI 0x1000545
#define GDK_Armenian_men 0x1000574
#define GDK_Armenian_MEN 0x1000544
#define GDK_Armenian_tche 0x1000573
#define GDK_Armenian_TCHE 0x1000543
#define GDK_Armenian_ghat 0x1000572
#define GDK_Armenian_GHAT 0x1000542
#define GDK_Armenian_dza 0x1000571
#define GDK_Armenian_DZA 0x1000541
#define GDK_Armenian_ho 0x1000570
#define GDK_Armenian_HO 0x1000540
#define GDK_Armenian_ken 0x100056f
#define GDK_Armenian_KEN 0x100053f
#define GDK_Armenian_tsa 0x100056e
#define GDK_Armenian_TSA 0x100053e
#define GDK_Armenian_khe 0x100056d
#define GDK_Armenian_KHE 0x100053d
#define GDK_Armenian_lyun 0x100056c
#define GDK_Armenian_LYUN 0x100053c
#define GDK_Armenian_ini 0x100056b
#define GDK_Armenian_INI 0x100053b
#define GDK_Armenian_zhe 0x100056a
#define GDK_Armenian_ZHE 0x100053a
#define GDK_Armenian_to 0x1000569
#define GDK_Armenian_TO 0x1000539
#define GDK_Armenian_at 0x1000568
#define GDK_Armenian_AT 0x1000538
#define GDK_Armenian_e 0x1000567
#define GDK_Armenian_E 0x1000537
#define GDK_Armenian_za 0x1000566
#define GDK_Armenian_ZA 0x1000536
#define GDK_Armenian_yech 0x1000565
#define GDK_Armenian_YECH 0x1000535
#define GDK_Armenian_da 0x1000564
#define GDK_Armenian_DA 0x1000534
#define GDK_Armenian_gim 0x1000563
#define GDK_Armenian_GIM 0x1000533
#define GDK_Armenian_ben 0x1000562
#define GDK_Armenian_BEN 0x1000532
#define GDK_Armenian_ayb 0x1000561
#define GDK_Armenian_AYB 0x1000531
#define GDK_Armenian_paruyk 0x100055e
#define GDK_Armenian_question 0x100055e
#define GDK_Armenian_shesht 0x100055b
#define GDK_Armenian_accent 0x100055b
#define GDK_Armenian_amanak 0x100055c
#define GDK_Armenian_exclam 0x100055c
#define GDK_Armenian_yentamna 0x100058a
#define GDK_Armenian_hyphen 0x100058a
#define GDK_Armenian_but 0x100055d
#define GDK_Armenian_separation_mark 0x100055d
#define GDK_Armenian_verjaket 0x1000589
#define GDK_Armenian_full_stop 0x1000589
#define GDK_Armenian_ligature_ew 0x1000587
#define GDK_Korean_Won 0xeff
#define GDK_Hangul_J_YeorinHieuh 0xefa
#define GDK_Hangul_J_KkogjiDalrinIeung 0xef9
#define GDK_Hangul_J_PanSios 0xef8
#define GDK_Hangul_AraeAE 0xef7
#define GDK_Hangul_AraeA 0xef6
#define GDK_Hangul_YeorinHieuh 0xef5
#define GDK_Hangul_SunkyeongeumPhieuf 0xef4
#define GDK_Hangul_KkogjiDalrinIeung 0xef3
#define GDK_Hangul_PanSios 0xef2
#define GDK_Hangul_SunkyeongeumPieub 0xef1
#define GDK_Hangul_SunkyeongeumMieum 0xef0
#define GDK_Hangul_RieulYeorinHieuh 0xeef
#define GDK_Hangul_J_Hieuh 0xeee
#define GDK_Hangul_J_Phieuf 0xeed
#define GDK_Hangul_J_Tieut 0xeec
#define GDK_Hangul_J_Khieuq 0xeeb
#define GDK_Hangul_J_Cieuc 0xeea
#define GDK_Hangul_J_Jieuj 0xee9
#define GDK_Hangul_J_Ieung 0xee8
#define GDK_Hangul_J_SsangSios 0xee7
#define GDK_Hangul_J_Sios 0xee6
#define GDK_Hangul_J_PieubSios 0xee5
#define GDK_Hangul_J_Pieub 0xee4
#define GDK_Hangul_J_Mieum 0xee3
#define GDK_Hangul_J_RieulHieuh 0xee2
#define GDK_Hangul_J_RieulPhieuf 0xee1
#define GDK_Hangul_J_RieulTieut 0xee0
#define GDK_Hangul_J_RieulSios 0xedf
#define GDK_Hangul_J_RieulPieub 0xede
#define GDK_Hangul_J_RieulMieum 0xedd
#define GDK_Hangul_J_RieulKiyeog 0xedc
#define GDK_Hangul_J_Rieul 0xedb
#define GDK_Hangul_J_Dikeud 0xeda
#define GDK_Hangul_J_NieunHieuh 0xed9
#define GDK_Hangul_J_NieunJieuj 0xed8
#define GDK_Hangul_J_Nieun 0xed7
#define GDK_Hangul_J_KiyeogSios 0xed6
#define GDK_Hangul_J_SsangKiyeog 0xed5
#define GDK_Hangul_J_Kiyeog 0xed4
#define GDK_Hangul_I 0xed3
#define GDK_Hangul_YI 0xed2
#define GDK_Hangul_EU 0xed1
#define GDK_Hangul_YU 0xed0
#define GDK_Hangul_WI 0xecf
#define GDK_Hangul_WE 0xece
#define GDK_Hangul_WEO 0xecd
#define GDK_Hangul_U 0xecc
#define GDK_Hangul_YO 0xecb
#define GDK_Hangul_OE 0xeca
#define GDK_Hangul_WAE 0xec9
#define GDK_Hangul_WA 0xec8
#define GDK_Hangul_O 0xec7
#define GDK_Hangul_YE 0xec6
#define GDK_Hangul_YEO 0xec5
#define GDK_Hangul_E 0xec4
#define GDK_Hangul_EO 0xec3
#define GDK_Hangul_YAE 0xec2
#define GDK_Hangul_YA 0xec1
#define GDK_Hangul_AE 0xec0
#define GDK_Hangul_A 0xebf
#define GDK_Hangul_Hieuh 0xebe
#define GDK_Hangul_Phieuf 0xebd
#define GDK_Hangul_Tieut 0xebc
#define GDK_Hangul_Khieuq 0xebb
#define GDK_Hangul_Cieuc 0xeba
#define GDK_Hangul_SsangJieuj 0xeb9
#define GDK_Hangul_Jieuj 0xeb8
#define GDK_Hangul_Ieung 0xeb7
#define GDK_Hangul_SsangSios 0xeb6
#define GDK_Hangul_Sios 0xeb5
#define GDK_Hangul_PieubSios 0xeb4
#define GDK_Hangul_SsangPieub 0xeb3
#define GDK_Hangul_Pieub 0xeb2
#define GDK_Hangul_Mieum 0xeb1
#define GDK_Hangul_RieulHieuh 0xeb0
#define GDK_Hangul_RieulPhieuf 0xeaf
#define GDK_Hangul_RieulTieut 0xeae
#define GDK_Hangul_RieulSios 0xead
#define GDK_Hangul_RieulPieub 0xeac
#define GDK_Hangul_RieulMieum 0xeab
#define GDK_Hangul_RieulKiyeog 0xeaa
#define GDK_Hangul_Rieul 0xea9
#define GDK_Hangul_SsangDikeud 0xea8
#define GDK_Hangul_Dikeud 0xea7
#define GDK_Hangul_NieunHieuh 0xea6
#define GDK_Hangul_NieunJieuj 0xea5
#define GDK_Hangul_Nieun 0xea4
#define GDK_Hangul_KiyeogSios 0xea3
#define GDK_Hangul_SsangKiyeog 0xea2
#define GDK_Hangul_Kiyeog 0xea1
#define GDK_Hangul_switch 0xff7e
#define GDK_Hangul_Special 0xff3f
#define GDK_Hangul_PreviousCandidate 0xff3e
#define GDK_Hangul_MultipleCandidate 0xff3d
#define GDK_Hangul_SingleCandidate 0xff3c
#define GDK_Hangul_PostHanja 0xff3b
#define GDK_Hangul_PreHanja 0xff3a
#define GDK_Hangul_Banja 0xff39
#define GDK_Hangul_Jeonja 0xff38
#define GDK_Hangul_Codeinput 0xff37
#define GDK_Hangul_Romaja 0xff36
#define GDK_Hangul_Jamo 0xff35
#define GDK_Hangul_Hanja 0xff34
#define GDK_Hangul_End 0xff33
#define GDK_Hangul_Start 0xff32
#define GDK_Hangul 0xff31
#define GDK_Thai_lekkao 0xdf9
#define GDK_Thai_lekpaet 0xdf8
#define GDK_Thai_lekchet 0xdf7
#define GDK_Thai_lekhok 0xdf6
#define GDK_Thai_lekha 0xdf5
#define GDK_Thai_leksi 0xdf4
#define GDK_Thai_leksam 0xdf3
#define GDK_Thai_leksong 0xdf2
#define GDK_Thai_leknung 0xdf1
#define GDK_Thai_leksun 0xdf0
#define GDK_Thai_nikhahit 0xded
#define GDK_Thai_thanthakhat 0xdec
#define GDK_Thai_maichattawa 0xdeb
#define GDK_Thai_maitri 0xdea
#define GDK_Thai_maitho 0xde9
#define GDK_Thai_maiek 0xde8
#define GDK_Thai_maitaikhu 0xde7
#define GDK_Thai_maiyamok 0xde6
#define GDK_Thai_lakkhangyao 0xde5
#define GDK_Thai_saraaimaimalai 0xde4
#define GDK_Thai_saraaimaimuan 0xde3
#define GDK_Thai_sarao 0xde2
#define GDK_Thai_saraae 0xde1
#define GDK_Thai_sarae 0xde0
#define GDK_Thai_baht 0xddf
#define GDK_Thai_maihanakat_maitho 0xdde
#define GDK_Thai_phinthu 0xdda
#define GDK_Thai_sarauu 0xdd9
#define GDK_Thai_sarau 0xdd8
#define GDK_Thai_sarauee 0xdd7
#define GDK_Thai_saraue 0xdd6
#define GDK_Thai_saraii 0xdd5
#define GDK_Thai_sarai 0xdd4
#define GDK_Thai_saraam 0xdd3
#define GDK_Thai_saraaa 0xdd2
#define GDK_Thai_maihanakat 0xdd1
#define GDK_Thai_saraa 0xdd0
#define GDK_Thai_paiyannoi 0xdcf
#define GDK_Thai_honokhuk 0xdce
#define GDK_Thai_oang 0xdcd
#define GDK_Thai_lochula 0xdcc
#define GDK_Thai_hohip 0xdcb
#define GDK_Thai_sosua 0xdca
#define GDK_Thai_sorusi 0xdc9
#define GDK_Thai_sosala 0xdc8
#define GDK_Thai_wowaen 0xdc7
#define GDK_Thai_lu 0xdc6
#define GDK_Thai_loling 0xdc5
#define GDK_Thai_ru 0xdc4
#define GDK_Thai_rorua 0xdc3
#define GDK_Thai_yoyak 0xdc2
#define GDK_Thai_moma 0xdc1
#define GDK_Thai_phosamphao 0xdc0
#define GDK_Thai_fofan 0xdbf
#define GDK_Thai_phophan 0xdbe
#define GDK_Thai_fofa 0xdbd
#define GDK_Thai_phophung 0xdbc
#define GDK_Thai_popla 0xdbb
#define GDK_Thai_bobaimai 0xdba
#define GDK_Thai_nonu 0xdb9
#define GDK_Thai_thothong 0xdb8
#define GDK_Thai_thothahan 0xdb7
#define GDK_Thai_thothung 0xdb6
#define GDK_Thai_totao 0xdb5
#define GDK_Thai_dodek 0xdb4
#define GDK_Thai_nonen 0xdb3
#define GDK_Thai_thophuthao 0xdb2
#define GDK_Thai_thonangmontho 0xdb1
#define GDK_Thai_thothan 0xdb0
#define GDK_Thai_topatak 0xdaf
#define GDK_Thai_dochada 0xdae
#define GDK_Thai_yoying 0xdad
#define GDK_Thai_chochoe 0xdac
#define GDK_Thai_soso 0xdab
#define GDK_Thai_chochang 0xdaa
#define GDK_Thai_choching 0xda9
#define GDK_Thai_chochan 0xda8
#define GDK_Thai_ngongu 0xda7
#define GDK_Thai_khorakhang 0xda6
#define GDK_Thai_khokhon 0xda5
#define GDK_Thai_khokhwai 0xda4
#define GDK_Thai_khokhuat 0xda3
#define GDK_Thai_khokhai 0xda2
#define GDK_Thai_kokai 0xda1
#define GDK_Hebrew_switch 0xff7e
#define GDK_hebrew_taf 0xcfa
#define GDK_hebrew_taw 0xcfa
#define GDK_hebrew_shin 0xcf9
#define GDK_hebrew_resh 0xcf8
#define GDK_hebrew_kuf 0xcf7
#define GDK_hebrew_qoph 0xcf7
#define GDK_hebrew_zadi 0xcf6
#define GDK_hebrew_zade 0xcf6
#define GDK_hebrew_finalzadi 0xcf5
#define GDK_hebrew_finalzade 0xcf5
#define GDK_hebrew_pe 0xcf4
#define GDK_hebrew_finalpe 0xcf3
#define GDK_hebrew_ayin 0xcf2
#define GDK_hebrew_samekh 0xcf1
#define GDK_hebrew_samech 0xcf1
#define GDK_hebrew_nun 0xcf0
#define GDK_hebrew_finalnun 0xcef
#define GDK_hebrew_mem 0xcee
#define GDK_hebrew_finalmem 0xced
#define GDK_hebrew_lamed 0xcec
#define GDK_hebrew_kaph 0xceb
#define GDK_hebrew_finalkaph 0xcea
#define GDK_hebrew_yod 0xce9
#define GDK_hebrew_teth 0xce8
#define GDK_hebrew_tet 0xce8
#define GDK_hebrew_het 0xce7
#define GDK_hebrew_chet 0xce7
#define GDK_hebrew_zayin 0xce6
#define GDK_hebrew_zain 0xce6
#define GDK_hebrew_waw 0xce5
#define GDK_hebrew_he 0xce4
#define GDK_hebrew_daleth 0xce3
#define GDK_hebrew_dalet 0xce3
#define GDK_hebrew_gimmel 0xce2
#define GDK_hebrew_gimel 0xce2
#define GDK_hebrew_beth 0xce1
#define GDK_hebrew_bet 0xce1
#define GDK_hebrew_aleph 0xce0
#define GDK_hebrew_doublelowline 0xcdf
#define GDK_righttack 0xbfc
#define GDK_lefttack 0xbdc
#define GDK_leftshoe 0xbda
#define GDK_rightshoe 0xbd8
#define GDK_downshoe 0xbd6
#define GDK_upstile 0xbd3
#define GDK_circle 0xbcf
#define GDK_uptack 0xbce
#define GDK_quad 0xbcc
#define GDK_jot 0xbca
#define GDK_underbar 0xbc6
#define GDK_downstile 0xbc4
#define GDK_upshoe 0xbc3
#define GDK_downtack 0xbc2
#define GDK_overbar 0xbc0
#define GDK_upcaret 0xba9
#define GDK_downcaret 0xba8
#define GDK_rightcaret 0xba6
#define GDK_leftcaret 0xba3
#define GDK_cursor 0xaff
#define GDK_doublelowquotemark 0xafe
#define GDK_singlelowquotemark 0xafd
#define GDK_caret 0xafc
#define GDK_phonographcopyright 0xafb
#define GDK_telephonerecorder 0xafa
#define GDK_telephone 0xaf9
#define GDK_femalesymbol 0xaf8
#define GDK_malesymbol 0xaf7
#define GDK_musicalflat 0xaf6
#define GDK_musicalsharp 0xaf5
#define GDK_ballotcross 0xaf4
#define GDK_checkmark 0xaf3
#define GDK_doubledagger 0xaf2
#define GDK_dagger 0xaf1
#define GDK_maltesecross 0xaf0
#define GDK_heart 0xaee
#define GDK_diamond 0xaed
#define GDK_club 0xaec
#define GDK_rightpointer 0xaeb
#define GDK_leftpointer 0xaea
#define GDK_filledtribulletdown 0xae9
#define GDK_filledtribulletup 0xae8
#define GDK_enfilledsqbullet 0xae7
#define GDK_enfilledcircbullet 0xae6
#define GDK_openstar 0xae5
#define GDK_opentribulletdown 0xae4
#define GDK_opentribulletup 0xae3
#define GDK_openrectbullet 0xae2
#define GDK_enopensquarebullet 0xae1
#define GDK_enopencircbullet 0xae0
#define GDK_emfilledrect 0xadf
#define GDK_emfilledcircle 0xade
#define GDK_filledrighttribullet 0xadd
#define GDK_filledlefttribullet 0xadc
#define GDK_filledrectbullet 0xadb
#define GDK_hexagram 0xada
#define GDK_latincross 0xad9
#define GDK_seconds 0xad7
#define GDK_minutes 0xad6
#define GDK_permille 0xad5
#define GDK_prescription 0xad4
#define GDK_rightdoublequotemark 0xad3
#define GDK_leftdoublequotemark 0xad2
#define GDK_rightsinglequotemark 0xad1
#define GDK_leftsinglequotemark 0xad0
#define GDK_emopenrectangle 0xacf
#define GDK_emopencircle 0xace
#define GDK_rightopentriangle 0xacd
#define GDK_leftopentriangle 0xacc
#define GDK_trademarkincircle 0xacb
#define GDK_signaturemark 0xaca
#define GDK_trademark 0xac9
#define GDK_seveneighths 0xac6
#define GDK_fiveeighths 0xac5
#define GDK_threeeighths 0xac4
#define GDK_oneeighth 0xac3
#define GDK_marker 0xabf
#define GDK_rightanglebracket 0xabe
#define GDK_decimalpoint 0xabd
#define GDK_leftanglebracket 0xabc
#define GDK_figdash 0xabb
#define GDK_careof 0xab8
#define GDK_fivesixths 0xab7
#define GDK_onesixth 0xab6
#define GDK_fourfifths 0xab5
#define GDK_threefifths 0xab4
#define GDK_twofifths 0xab3
#define GDK_onefifth 0xab2
#define GDK_twothirds 0xab1
#define GDK_onethird 0xab0
#define GDK_doubbaselinedot 0xaaf
#define GDK_ellipsis 0xaae
#define GDK_signifblank 0xaac
#define GDK_endash 0xaaa
#define GDK_emdash 0xaa9
#define GDK_hairspace 0xaa8
#define GDK_thinspace 0xaa7
#define GDK_punctspace 0xaa6
#define GDK_digitspace 0xaa5
#define GDK_em4space 0xaa4
#define GDK_em3space 0xaa3
#define GDK_enspace 0xaa2
#define GDK_emspace 0xaa1
#define GDK_vertbar 0x9f8
#define GDK_topt 0x9f7
#define GDK_bott 0x9f6
#define GDK_rightt 0x9f5
#define GDK_leftt 0x9f4
#define GDK_horizlinescan9 0x9f3
#define GDK_horizlinescan7 0x9f2
#define GDK_horizlinescan5 0x9f1
#define GDK_horizlinescan3 0x9f0
#define GDK_horizlinescan1 0x9ef
#define GDK_crossinglines 0x9ee
#define GDK_lowleftcorner 0x9ed
#define GDK_upleftcorner 0x9ec
#define GDK_uprightcorner 0x9eb
#define GDK_lowrightcorner 0x9ea
#define GDK_vt 0x9e9
#define GDK_nl 0x9e8
#define GDK_lf 0x9e5
#define GDK_cr 0x9e4
#define GDK_ff 0x9e3
#define GDK_ht 0x9e2
#define GDK_checkerboard 0x9e1
#define GDK_soliddiamond 0x9e0
#define GDK_blank 0x9df
#define GDK_downarrow 0x8fe
#define GDK_rightarrow 0x8fd
#define GDK_uparrow 0x8fc
#define GDK_leftarrow 0x8fb
#define GDK_function 0x8f6
#define GDK_partialderivative 0x8ef
#define GDK_logicalor 0x8df
#define GDK_logicaland 0x8de
#define GDK_union 0x8dd
#define GDK_intersection 0x8dc
#define GDK_includes 0x8db
#define GDK_includedin 0x8da
#define GDK_radical 0x8d6
#define GDK_identical 0x8cf
#define GDK_implies 0x8ce
#define GDK_ifonlyif 0x8cd
#define GDK_similarequal 0x8c9
#define GDK_approximate 0x8c8
#define GDK_nabla 0x8c5
#define GDK_infinity 0x8c2
#define GDK_variation 0x8c1
#define GDK_therefore 0x8c0
#define GDK_integral 0x8bf
#define GDK_greaterthanequal 0x8be
#define GDK_notequal 0x8bd
#define GDK_lessthanequal 0x8bc
#define GDK_rightmiddlesummation 0x8b7
#define GDK_botrightsummation 0x8b6
#define GDK_toprightsummation 0x8b5
#define GDK_botvertsummationconnector 0x8b4
#define GDK_topvertsummationconnector 0x8b3
#define GDK_botleftsummation 0x8b2
#define GDK_topleftsummation 0x8b1
#define GDK_rightmiddlecurlybrace 0x8b0
#define GDK_leftmiddlecurlybrace 0x8af
#define GDK_botrightparens 0x8ae
#define GDK_toprightparens 0x8ad
#define GDK_botleftparens 0x8ac
#define GDK_topleftparens 0x8ab
#define GDK_botrightsqbracket 0x8aa
#define GDK_toprightsqbracket 0x8a9
#define GDK_botleftsqbracket 0x8a8
#define GDK_topleftsqbracket 0x8a7
#define GDK_vertconnector 0x8a6
#define GDK_botintegral 0x8a5
#define GDK_topintegral 0x8a4
#define GDK_horizconnector 0x8a3
#define GDK_topleftradical 0x8a2
#define GDK_leftradical 0x8a1
#define GDK_Greek_switch 0xff7e
#define GDK_Greek_omega 0x7f9
#define GDK_Greek_psi 0x7f8
#define GDK_Greek_chi 0x7f7
#define GDK_Greek_phi 0x7f6
#define GDK_Greek_upsilon 0x7f5
#define GDK_Greek_tau 0x7f4
#define GDK_Greek_finalsmallsigma 0x7f3
#define GDK_Greek_sigma 0x7f2
#define GDK_Greek_rho 0x7f1
#define GDK_Greek_pi 0x7f0
#define GDK_Greek_omicron 0x7ef
#define GDK_Greek_xi 0x7ee
#define GDK_Greek_nu 0x7ed
#define GDK_Greek_mu 0x7ec
#define GDK_Greek_lambda 0x7eb
#define GDK_Greek_lamda 0x7eb
#define GDK_Greek_kappa 0x7ea
#define GDK_Greek_iota 0x7e9
#define GDK_Greek_theta 0x7e8
#define GDK_Greek_eta 0x7e7
#define GDK_Greek_zeta 0x7e6
#define GDK_Greek_epsilon 0x7e5
#define GDK_Greek_delta 0x7e4
#define GDK_Greek_gamma 0x7e3
#define GDK_Greek_beta 0x7e2
#define GDK_Greek_alpha 0x7e1
#define GDK_Greek_OMEGA 0x7d9
#define GDK_Greek_PSI 0x7d8
#define GDK_Greek_CHI 0x7d7
#define GDK_Greek_PHI 0x7d6
#define GDK_Greek_UPSILON 0x7d5
#define GDK_Greek_TAU 0x7d4
#define GDK_Greek_SIGMA 0x7d2
#define GDK_Greek_RHO 0x7d1
#define GDK_Greek_PI 0x7d0
#define GDK_Greek_OMICRON 0x7cf
#define GDK_Greek_XI 0x7ce
#define GDK_Greek_NU 0x7cd
#define GDK_Greek_MU 0x7cc
#define GDK_Greek_LAMBDA 0x7cb
#define GDK_Greek_LAMDA 0x7cb
#define GDK_Greek_KAPPA 0x7ca
#define GDK_Greek_IOTA 0x7c9
#define GDK_Greek_THETA 0x7c8
#define GDK_Greek_ETA 0x7c7
#define GDK_Greek_ZETA 0x7c6
#define GDK_Greek_EPSILON 0x7c5
#define GDK_Greek_DELTA 0x7c4
#define GDK_Greek_GAMMA 0x7c3
#define GDK_Greek_BETA 0x7c2
#define GDK_Greek_ALPHA 0x7c1
#define GDK_Greek_omegaaccent 0x7bb
#define GDK_Greek_upsilonaccentdieresis 0x7ba
#define GDK_Greek_upsilondieresis 0x7b9
#define GDK_Greek_upsilonaccent 0x7b8
#define GDK_Greek_omicronaccent 0x7b7
#define GDK_Greek_iotaaccentdieresis 0x7b6
#define GDK_Greek_iotadieresis 0x7b5
#define GDK_Greek_iotaaccent 0x7b4
#define GDK_Greek_etaaccent 0x7b3
#define GDK_Greek_epsilonaccent 0x7b2
#define GDK_Greek_alphaaccent 0x7b1
#define GDK_Greek_horizbar 0x7af
#define GDK_Greek_accentdieresis 0x7ae
#define GDK_Greek_OMEGAaccent 0x7ab
#define GDK_Greek_UPSILONdieresis 0x7a9
#define GDK_Greek_UPSILONaccent 0x7a8
#define GDK_Greek_OMICRONaccent 0x7a7
#define GDK_Greek_IOTAdiaeresis 0x7a5
#define GDK_Greek_IOTAdieresis 0x7a5
#define GDK_Greek_IOTAaccent 0x7a4
#define GDK_Greek_ETAaccent 0x7a3
#define GDK_Greek_EPSILONaccent 0x7a2
#define GDK_Greek_ALPHAaccent 0x7a1
#define GDK_Cyrillic_HARDSIGN 0x6ff
#define GDK_Cyrillic_CHE 0x6fe
#define GDK_Cyrillic_SHCHA 0x6fd
#define GDK_Cyrillic_E 0x6fc
#define GDK_Cyrillic_SHA 0x6fb
#define GDK_Cyrillic_ZE 0x6fa
#define GDK_Cyrillic_YERU 0x6f9
#define GDK_Cyrillic_SOFTSIGN 0x6f8
#define GDK_Cyrillic_VE 0x6f7
#define GDK_Cyrillic_ZHE 0x6f6
#define GDK_Cyrillic_U 0x6f5
#define GDK_Cyrillic_TE 0x6f4
#define GDK_Cyrillic_ES 0x6f3
#define GDK_Cyrillic_ER 0x6f2
#define GDK_Cyrillic_YA 0x6f1
#define GDK_Cyrillic_PE 0x6f0
#define GDK_Cyrillic_O 0x6ef
#define GDK_Cyrillic_EN 0x6ee
#define GDK_Cyrillic_EM 0x6ed
#define GDK_Cyrillic_EL 0x6ec
#define GDK_Cyrillic_KA 0x6eb
#define GDK_Cyrillic_SHORTI 0x6ea
#define GDK_Cyrillic_I 0x6e9
#define GDK_Cyrillic_HA 0x6e8
#define GDK_Cyrillic_GHE 0x6e7
#define GDK_Cyrillic_EF 0x6e6
#define GDK_Cyrillic_IE 0x6e5
#define GDK_Cyrillic_DE 0x6e4
#define GDK_Cyrillic_TSE 0x6e3
#define GDK_Cyrillic_BE 0x6e2
#define GDK_Cyrillic_A 0x6e1
#define GDK_Cyrillic_YU 0x6e0
#define GDK_Cyrillic_hardsign 0x6df
#define GDK_Cyrillic_che 0x6de
#define GDK_Cyrillic_shcha 0x6dd
#define GDK_Cyrillic_e 0x6dc
#define GDK_Cyrillic_sha 0x6db
#define GDK_Cyrillic_ze 0x6da
#define GDK_Cyrillic_yeru 0x6d9
#define GDK_Cyrillic_softsign 0x6d8
#define GDK_Cyrillic_ve 0x6d7
#define GDK_Cyrillic_zhe 0x6d6
#define GDK_Cyrillic_u 0x6d5
#define GDK_Cyrillic_te 0x6d4
#define GDK_Cyrillic_es 0x6d3
#define GDK_Cyrillic_er 0x6d2
#define GDK_Cyrillic_ya 0x6d1
#define GDK_Cyrillic_pe 0x6d0
#define GDK_Cyrillic_o 0x6cf
#define GDK_Cyrillic_en 0x6ce
#define GDK_Cyrillic_em 0x6cd
#define GDK_Cyrillic_el 0x6cc
#define GDK_Cyrillic_ka 0x6cb
#define GDK_Cyrillic_shorti 0x6ca
#define GDK_Cyrillic_i 0x6c9
#define GDK_Cyrillic_ha 0x6c8
#define GDK_Cyrillic_ghe 0x6c7
#define GDK_Cyrillic_ef 0x6c6
#define GDK_Cyrillic_ie 0x6c5
#define GDK_Cyrillic_de 0x6c4
#define GDK_Cyrillic_tse 0x6c3
#define GDK_Cyrillic_be 0x6c2
#define GDK_Cyrillic_a 0x6c1
#define GDK_Cyrillic_yu 0x6c0
#define GDK_Serbian_DZE 0x6bf
#define GDK_Cyrillic_DZHE 0x6bf
#define GDK_Byelorussian_SHORTU 0x6be
#define GDK_Ukrainian_GHE_WITH_UPTURN 0x6bd
#define GDK_Macedonia_KJE 0x6bc
#define GDK_Serbian_TSHE 0x6bb
#define GDK_Serbian_NJE 0x6ba
#define GDK_Cyrillic_NJE 0x6ba
#define GDK_Serbian_LJE 0x6b9
#define GDK_Cyrillic_LJE 0x6b9
#define GDK_Serbian_JE 0x6b8
#define GDK_Cyrillic_JE 0x6b8
#define GDK_Ukranian_YI 0x6b7
#define GDK_Ukrainian_YI 0x6b7
#define GDK_Ukranian_I 0x6b6
#define GDK_Ukrainian_I 0x6b6
#define GDK_Macedonia_DSE 0x6b5
#define GDK_Ukranian_JE 0x6b4
#define GDK_Ukrainian_IE 0x6b4
#define GDK_Cyrillic_IO 0x6b3
#define GDK_Macedonia_GJE 0x6b2
#define GDK_Serbian_DJE 0x6b1
#define GDK_numerosign 0x6b0
#define GDK_Serbian_dze 0x6af
#define GDK_Cyrillic_dzhe 0x6af
#define GDK_Byelorussian_shortu 0x6ae
#define GDK_Ukrainian_ghe_with_upturn 0x6ad
#define GDK_Macedonia_kje 0x6ac
#define GDK_Serbian_tshe 0x6ab
#define GDK_Serbian_nje 0x6aa
#define GDK_Cyrillic_nje 0x6aa
#define GDK_Serbian_lje 0x6a9
#define GDK_Cyrillic_lje 0x6a9
#define GDK_Serbian_je 0x6a8
#define GDK_Cyrillic_je 0x6a8
#define GDK_Ukranian_yi 0x6a7
#define GDK_Ukrainian_yi 0x6a7
#define GDK_Ukranian_i 0x6a6
#define GDK_Ukrainian_i 0x6a6
#define GDK_Macedonia_dse 0x6a5
#define GDK_Ukranian_je 0x6a4
#define GDK_Ukrainian_ie 0x6a4
#define GDK_Cyrillic_io 0x6a3
#define GDK_Macedonia_gje 0x6a2
#define GDK_Serbian_dje 0x6a1
#define GDK_Cyrillic_u_macron 0x10004ef
#define GDK_Cyrillic_U_macron 0x10004ee
#define GDK_Cyrillic_o_bar 0x10004e9
#define GDK_Cyrillic_O_bar 0x10004e8
#define GDK_Cyrillic_i_macron 0x10004e3
#define GDK_Cyrillic_I_macron 0x10004e2
#define GDK_Cyrillic_schwa 0x10004d9
#define GDK_Cyrillic_SCHWA 0x10004d8
#define GDK_Cyrillic_shha 0x10004bb
#define GDK_Cyrillic_SHHA 0x10004ba
#define GDK_Cyrillic_che_vertstroke 0x10004b9
#define GDK_Cyrillic_CHE_vertstroke 0x10004b8
#define GDK_Cyrillic_che_descender 0x10004b7
#define GDK_Cyrillic_CHE_descender 0x10004b6
#define GDK_Cyrillic_ha_descender 0x10004b3
#define GDK_Cyrillic_HA_descender 0x10004b2
#define GDK_Cyrillic_u_straight_bar 0x10004b1
#define GDK_Cyrillic_U_straight_bar 0x10004b0
#define GDK_Cyrillic_u_straight 0x10004af
#define GDK_Cyrillic_U_straight 0x10004ae
#define GDK_Cyrillic_en_descender 0x10004a3
#define GDK_Cyrillic_EN_descender 0x10004a2
#define GDK_Cyrillic_ka_vertstroke 0x100049d
#define GDK_Cyrillic_KA_vertstroke 0x100049c
#define GDK_Cyrillic_ka_descender 0x100049b
#define GDK_Cyrillic_KA_descender 0x100049a
#define GDK_Cyrillic_zhe_descender 0x1000497
#define GDK_Cyrillic_ZHE_descender 0x1000496
#define GDK_Cyrillic_ghe_bar 0x1000493
#define GDK_Cyrillic_GHE_bar 0x1000492
#define GDK_Arabic_switch 0xff7e
#define GDK_Arabic_heh_goal 0x10006c1
#define GDK_Arabic_yeh_baree 0x10006d2
#define GDK_Arabic_farsi_yeh 0x10006cc
#define GDK_Farsi_yeh 0x10006cc
#define GDK_Arabic_heh_doachashmee 0x10006be
#define GDK_Arabic_noon_ghunna 0x10006ba
#define GDK_Arabic_gaf 0x10006af
#define GDK_Arabic_keheh 0x10006a9
#define GDK_Arabic_veh 0x10006a4
#define GDK_Arabic_jeh 0x1000698
#define GDK_Arabic_hamza_below 0x1000655
#define GDK_Arabic_hamza_above 0x1000654
#define GDK_Arabic_madda_above 0x1000653
#define GDK_Arabic_sukun 0x5f2
#define GDK_Arabic_shadda 0x5f1
#define GDK_Arabic_kasra 0x5f0
#define GDK_Arabic_damma 0x5ef
#define GDK_Arabic_fatha 0x5ee
#define GDK_Arabic_kasratan 0x5ed
#define GDK_Arabic_dammatan 0x5ec
#define GDK_Arabic_fathatan 0x5eb
#define GDK_Arabic_yeh 0x5ea
#define GDK_Arabic_alefmaksura 0x5e9
#define GDK_Arabic_waw 0x5e8
#define GDK_Arabic_heh 0x5e7
#define GDK_Arabic_ha 0x5e7
#define GDK_Arabic_noon 0x5e6
#define GDK_Arabic_meem 0x5e5
#define GDK_Arabic_lam 0x5e4
#define GDK_Arabic_kaf 0x5e3
#define GDK_Arabic_qaf 0x5e2
#define GDK_Arabic_feh 0x5e1
#define GDK_Arabic_tatweel 0x5e0
#define GDK_Arabic_ghain 0x5da
#define GDK_Arabic_ain 0x5d9
#define GDK_Arabic_zah 0x5d8
#define GDK_Arabic_tah 0x5d7
#define GDK_Arabic_dad 0x5d6
#define GDK_Arabic_sad 0x5d5
#define GDK_Arabic_sheen 0x5d4
#define GDK_Arabic_seen 0x5d3
#define GDK_Arabic_zain 0x5d2
#define GDK_Arabic_ra 0x5d1
#define GDK_Arabic_thal 0x5d0
#define GDK_Arabic_dal 0x5cf
#define GDK_Arabic_khah 0x5ce
#define GDK_Arabic_hah 0x5cd
#define GDK_Arabic_jeem 0x5cc
#define GDK_Arabic_theh 0x5cb
#define GDK_Arabic_teh 0x5ca
#define GDK_Arabic_tehmarbuta 0x5c9
#define GDK_Arabic_beh 0x5c8
#define GDK_Arabic_alef 0x5c7
#define GDK_Arabic_hamzaonyeh 0x5c6
#define GDK_Arabic_hamzaunderalef 0x5c5
#define GDK_Arabic_hamzaonwaw 0x5c4
#define GDK_Arabic_hamzaonalef 0x5c3
#define GDK_Arabic_maddaonalef 0x5c2
#define GDK_Arabic_hamza 0x5c1
#define GDK_Arabic_question_mark 0x5bf
#define GDK_Arabic_semicolon 0x5bb
#define GDK_Arabic_9 0x1000669
#define GDK_Arabic_8 0x1000668
#define GDK_Arabic_7 0x1000667
#define GDK_Arabic_6 0x1000666
#define GDK_Arabic_5 0x1000665
#define GDK_Arabic_4 0x1000664
#define GDK_Arabic_3 0x1000663
#define GDK_Arabic_2 0x1000662
#define GDK_Arabic_1 0x1000661
#define GDK_Arabic_0 0x1000660
#define GDK_Arabic_fullstop 0x10006d4
#define GDK_Arabic_comma 0x5ac
#define GDK_Arabic_rreh 0x1000691
#define GDK_Arabic_ddal 0x1000688
#define GDK_Arabic_tcheh 0x1000686
#define GDK_Arabic_peh 0x100067e
#define GDK_Arabic_tteh 0x1000679
#define GDK_Arabic_superscript_alef 0x1000670
#define GDK_Arabic_percent 0x100066a
#define GDK_Farsi_9 0x10006f9
#define GDK_Farsi_8 0x10006f8
#define GDK_Farsi_7 0x10006f7
#define GDK_Farsi_6 0x10006f6
#define GDK_Farsi_5 0x10006f5
#define GDK_Farsi_4 0x10006f4
#define GDK_Farsi_3 0x10006f3
#define GDK_Farsi_2 0x10006f2
#define GDK_Farsi_1 0x10006f1
#define GDK_Farsi_0 0x10006f0
#define GDK_kana_switch 0xff7e
#define GDK_semivoicedsound 0x4df
#define GDK_voicedsound 0x4de
#define GDK_kana_N 0x4dd
#define GDK_kana_WA 0x4dc
#define GDK_kana_RO 0x4db
#define GDK_kana_RE 0x4da
#define GDK_kana_RU 0x4d9
#define GDK_kana_RI 0x4d8
#define GDK_kana_RA 0x4d7
#define GDK_kana_YO 0x4d6
#define GDK_kana_YU 0x4d5
#define GDK_kana_YA 0x4d4
#define GDK_kana_MO 0x4d3
#define GDK_kana_ME 0x4d2
#define GDK_kana_MU 0x4d1
#define GDK_kana_MI 0x4d0
#define GDK_kana_MA 0x4cf
#define GDK_kana_HO 0x4ce
#define GDK_kana_HE 0x4cd
#define GDK_kana_HU 0x4cc
#define GDK_kana_FU 0x4cc
#define GDK_kana_HI 0x4cb
#define GDK_kana_HA 0x4ca
#define GDK_kana_NO 0x4c9
#define GDK_kana_NE 0x4c8
#define GDK_kana_NU 0x4c7
#define GDK_kana_NI 0x4c6
#define GDK_kana_NA 0x4c5
#define GDK_kana_TO 0x4c4
#define GDK_kana_TE 0x4c3
#define GDK_kana_TU 0x4c2
#define GDK_kana_TSU 0x4c2
#define GDK_kana_TI 0x4c1
#define GDK_kana_CHI 0x4c1
#define GDK_kana_TA 0x4c0
#define GDK_kana_SO 0x4bf
#define GDK_kana_SE 0x4be
#define GDK_kana_SU 0x4bd
#define GDK_kana_SHI 0x4bc
#define GDK_kana_SA 0x4bb
#define GDK_kana_KO 0x4ba
#define GDK_kana_KE 0x4b9
#define GDK_kana_KU 0x4b8
#define GDK_kana_KI 0x4b7
#define GDK_kana_KA 0x4b6
#define GDK_kana_O 0x4b5
#define GDK_kana_E 0x4b4
#define GDK_kana_U 0x4b3
#define GDK_kana_I 0x4b2
#define GDK_kana_A 0x4b1
#define GDK_prolongedsound 0x4b0
#define GDK_kana_tu 0x4af
#define GDK_kana_tsu 0x4af
#define GDK_kana_yo 0x4ae
#define GDK_kana_yu 0x4ad
#define GDK_kana_ya 0x4ac
#define GDK_kana_o 0x4ab
#define GDK_kana_e 0x4aa
#define GDK_kana_u 0x4a9
#define GDK_kana_i 0x4a8
#define GDK_kana_a 0x4a7
#define GDK_kana_WO 0x4a6
#define GDK_kana_middledot 0x4a5
#define GDK_kana_conjunctive 0x4a5
#define GDK_kana_comma 0x4a4
#define GDK_kana_closingbracket 0x4a3
#define GDK_kana_openingbracket 0x4a2
#define GDK_kana_fullstop 0x4a1
#define GDK_overline 0x47e
#define GDK_Ydiaeresis 0x13be
#define GDK_oe 0x13bd
#define GDK_OE 0x13bc
#define GDK_ygrave 0x1001ef3
#define GDK_Ygrave 0x1001ef2
#define GDK_wdiaeresis 0x1001e85
#define GDK_Wdiaeresis 0x1001e84
#define GDK_wacute 0x1001e83
#define GDK_Wacute 0x1001e82
#define GDK_wgrave 0x1001e81
#define GDK_Wgrave 0x1001e80
#define GDK_tabovedot 0x1001e6b
#define GDK_Tabovedot 0x1001e6a
#define GDK_sabovedot 0x1001e61
#define GDK_Sabovedot 0x1001e60
#define GDK_pabovedot 0x1001e57
#define GDK_Pabovedot 0x1001e56
#define GDK_mabovedot 0x1001e41
#define GDK_Mabovedot 0x1001e40
#define GDK_fabovedot 0x1001e1f
#define GDK_Fabovedot 0x1001e1e
#define GDK_dabovedot 0x1001e0b
#define GDK_Dabovedot 0x1001e0a
#define GDK_babovedot 0x1001e03
#define GDK_Babovedot 0x1001e02
#define GDK_ycircumflex 0x1000177
#define GDK_Ycircumflex 0x1000176
#define GDK_wcircumflex 0x1000175
#define GDK_Wcircumflex 0x1000174
#define GDK_umacron 0x3fe
#define GDK_utilde 0x3fd
#define GDK_uogonek 0x3f9
#define GDK_kcedilla 0x3f3
#define GDK_omacron 0x3f2
#define GDK_ncedilla 0x3f1
#define GDK_imacron 0x3ef
#define GDK_eabovedot 0x3ec
#define GDK_iogonek 0x3e7
#define GDK_amacron 0x3e0
#define GDK_Umacron 0x3de
#define GDK_Utilde 0x3dd
#define GDK_Uogonek 0x3d9
#define GDK_Kcedilla 0x3d3
#define GDK_Omacron 0x3d2
#define GDK_Ncedilla 0x3d1
#define GDK_Imacron 0x3cf
#define GDK_Eabovedot 0x3cc
#define GDK_Iogonek 0x3c7
#define GDK_Amacron 0x3c0
#define GDK_eng 0x3bf
#define GDK_ENG 0x3bd
#define GDK_tslash 0x3bc
#define GDK_gcedilla 0x3bb
#define GDK_emacron 0x3ba
#define GDK_lcedilla 0x3b6
#define GDK_itilde 0x3b5
#define GDK_rcedilla 0x3b3
#define GDK_Tslash 0x3ac
#define GDK_Gcedilla 0x3ab
#define GDK_Emacron 0x3aa
#define GDK_Lcedilla 0x3a6
#define GDK_Itilde 0x3a5
#define GDK_Rcedilla 0x3a3
#define GDK_kappa 0x3a2
#define GDK_kra 0x3a2
#define GDK_scircumflex 0x2fe
#define GDK_ubreve 0x2fd
#define GDK_gcircumflex 0x2f8
#define GDK_gabovedot 0x2f5
#define GDK_ccircumflex 0x2e6
#define GDK_cabovedot 0x2e5
#define GDK_Scircumflex 0x2de
#define GDK_Ubreve 0x2dd
#define GDK_Gcircumflex 0x2d8
#define GDK_Gabovedot 0x2d5
#define GDK_Ccircumflex 0x2c6
#define GDK_Cabovedot 0x2c5
#define GDK_jcircumflex 0x2bc
#define GDK_gbreve 0x2bb
#define GDK_idotless 0x2b9
#define GDK_hcircumflex 0x2b6
#define GDK_hstroke 0x2b1
#define GDK_Jcircumflex 0x2ac
#define GDK_Gbreve 0x2ab
#define GDK_Iabovedot 0x2a9
#define GDK_Hcircumflex 0x2a6
#define GDK_Hstroke 0x2a1
#define GDK_abovedot 0x1ff
#define GDK_tcedilla 0x1fe
#define GDK_udoubleacute 0x1fb
#define GDK_uring 0x1f9
#define GDK_rcaron 0x1f8
#define GDK_odoubleacute 0x1f5
#define GDK_ncaron 0x1f2
#define GDK_nacute 0x1f1
#define GDK_dstroke 0x1f0
#define GDK_dcaron 0x1ef
#define GDK_ecaron 0x1ec
#define GDK_eogonek 0x1ea
#define GDK_ccaron 0x1e8
#define GDK_cacute 0x1e6
#define GDK_lacute 0x1e5
#define GDK_abreve 0x1e3
#define GDK_racute 0x1e0
#define GDK_Tcedilla 0x1de
#define GDK_Udoubleacute 0x1db
#define GDK_Uring 0x1d9
#define GDK_Rcaron 0x1d8
#define GDK_Odoubleacute 0x1d5
#define GDK_Ncaron 0x1d2
#define GDK_Nacute 0x1d1
#define GDK_Dstroke 0x1d0
#define GDK_Dcaron 0x1cf
#define GDK_Ecaron 0x1cc
#define GDK_Eogonek 0x1ca
#define GDK_Ccaron 0x1c8
#define GDK_Cacute 0x1c6
#define GDK_Lacute 0x1c5
#define GDK_Abreve 0x1c3
#define GDK_Racute 0x1c0
#define GDK_zabovedot 0x1bf
#define GDK_zcaron 0x1be
#define GDK_doubleacute 0x1bd
#define GDK_zacute 0x1bc
#define GDK_tcaron 0x1bb
#define GDK_scedilla 0x1ba
#define GDK_scaron 0x1b9
#define GDK_caron 0x1b7
#define GDK_sacute 0x1b6
#define GDK_lcaron 0x1b5
#define GDK_lstroke 0x1b3
#define GDK_ogonek 0x1b2
#define GDK_aogonek 0x1b1
#define GDK_Zabovedot 0x1af
#define GDK_Zcaron 0x1ae
#define GDK_Zacute 0x1ac
#define GDK_Tcaron 0x1ab
#define GDK_Scedilla 0x1aa
#define GDK_Scaron 0x1a9
#define GDK_Sacute 0x1a6
#define GDK_Lcaron 0x1a5
#define GDK_Lstroke 0x1a3
#define GDK_breve 0x1a2
#define GDK_Aogonek 0x1a1
#define GDK_ydiaeresis 0x0ff
#define GDK_thorn 0x0fe
#define GDK_yacute 0x0fd
#define GDK_udiaeresis 0x0fc
#define GDK_ucircumflex 0x0fb
#define GDK_uacute 0x0fa
#define GDK_ugrave 0x0f9
#define GDK_ooblique 0x0f8
#define GDK_oslash 0x0f8
#define GDK_division 0x0f7
#define GDK_odiaeresis 0x0f6
#define GDK_otilde 0x0f5
#define GDK_ocircumflex 0x0f4
#define GDK_oacute 0x0f3
#define GDK_ograve 0x0f2
#define GDK_ntilde 0x0f1
#define GDK_eth 0x0f0
#define GDK_idiaeresis 0x0ef
#define GDK_icircumflex 0x0ee
#define GDK_iacute 0x0ed
#define GDK_igrave 0x0ec
#define GDK_ediaeresis 0x0eb
#define GDK_ecircumflex 0x0ea
#define GDK_eacute 0x0e9
#define GDK_egrave 0x0e8
#define GDK_ccedilla 0x0e7
#define GDK_ae 0x0e6
#define GDK_aring 0x0e5
#define GDK_adiaeresis 0x0e4
#define GDK_atilde 0x0e3
#define GDK_acircumflex 0x0e2
#define GDK_aacute 0x0e1
#define GDK_agrave 0x0e0
#define GDK_ssharp 0x0df
#define GDK_Thorn 0x0de
#define GDK_THORN 0x0de
#define GDK_Yacute 0x0dd
#define GDK_Udiaeresis 0x0dc
#define GDK_Ucircumflex 0x0db
#define GDK_Uacute 0x0da
#define GDK_Ugrave 0x0d9
#define GDK_Ooblique 0x0d8
#define GDK_Oslash 0x0d8
#define GDK_multiply 0x0d7
#define GDK_Odiaeresis 0x0d6
#define GDK_Otilde 0x0d5
#define GDK_Ocircumflex 0x0d4
#define GDK_Oacute 0x0d3
#define GDK_Ograve 0x0d2
#define GDK_Ntilde 0x0d1
#define GDK_Eth 0x0d0
#define GDK_ETH 0x0d0
#define GDK_Idiaeresis 0x0cf
#define GDK_Icircumflex 0x0ce
#define GDK_Iacute 0x0cd
#define GDK_Igrave 0x0cc
#define GDK_Ediaeresis 0x0cb
#define GDK_Ecircumflex 0x0ca
#define GDK_Eacute 0x0c9
#define GDK_Egrave 0x0c8
#define GDK_Ccedilla 0x0c7
#define GDK_AE 0x0c6
#define GDK_Aring 0x0c5
#define GDK_Adiaeresis 0x0c4
#define GDK_Atilde 0x0c3
#define GDK_Acircumflex 0x0c2
#define GDK_Aacute 0x0c1
#define GDK_Agrave 0x0c0
#define GDK_questiondown 0x0bf
#define GDK_threequarters 0x0be
#define GDK_onehalf 0x0bd
#define GDK_onequarter 0x0bc
#define GDK_guillemotright 0x0bb
#define GDK_masculine 0x0ba
#define GDK_onesuperior 0x0b9
#define GDK_cedilla 0x0b8
#define GDK_periodcentered 0x0b7
#define GDK_paragraph 0x0b6
#define GDK_mu 0x0b5
#define GDK_acute 0x0b4
#define GDK_threesuperior 0x0b3
#define GDK_twosuperior 0x0b2
#define GDK_plusminus 0x0b1
#define GDK_degree 0x0b0
#define GDK_macron 0x0af
#define GDK_registered 0x0ae
#define GDK_hyphen 0x0ad
#define GDK_notsign 0x0ac
#define GDK_guillemotleft 0x0ab
#define GDK_ordfeminine 0x0aa
#define GDK_copyright 0x0a9
#define GDK_diaeresis 0x0a8
#define GDK_section 0x0a7
#define GDK_brokenbar 0x0a6
#define GDK_yen 0x0a5
#define GDK_currency 0x0a4
#define GDK_sterling 0x0a3
#define GDK_cent 0x0a2
#define GDK_exclamdown 0x0a1
#define GDK_nobreakspace 0x0a0
#define GDK_asciitilde 0x07e
#define GDK_braceright 0x07d
#define GDK_bar 0x07c
#define GDK_braceleft 0x07b
#define GDK_z 0x07a
#define GDK_y 0x079
#define GDK_x 0x078
#define GDK_w 0x077
#define GDK_v 0x076
#define GDK_u 0x075
#define GDK_t 0x074
#define GDK_s 0x073
#define GDK_r 0x072
#define GDK_q 0x071
#define GDK_p 0x070
#define GDK_o 0x06f
#define GDK_n 0x06e
#define GDK_m 0x06d
#define GDK_l 0x06c
#define GDK_k 0x06b
#define GDK_j 0x06a
#define GDK_i 0x069
#define GDK_h 0x068
#define GDK_g 0x067
#define GDK_f 0x066
#define GDK_e 0x065
#define GDK_d 0x064
#define GDK_c 0x063
#define GDK_b 0x062
#define GDK_a 0x061
#define GDK_quoteleft 0x060
#define GDK_grave 0x060
#define GDK_underscore 0x05f
#define GDK_asciicircum 0x05e
#define GDK_bracketright 0x05d
#define GDK_backslash 0x05c
#define GDK_bracketleft 0x05b
#define GDK_Z 0x05a
#define GDK_Y 0x059
#define GDK_X 0x058
#define GDK_W 0x057
#define GDK_V 0x056
#define GDK_U 0x055
#define GDK_T 0x054
#define GDK_S 0x053
#define GDK_R 0x052
#define GDK_Q 0x051
#define GDK_P 0x050
#define GDK_O 0x04f
#define GDK_N 0x04e
#define GDK_M 0x04d
#define GDK_L 0x04c
#define GDK_K 0x04b
#define GDK_J 0x04a
#define GDK_I 0x049
#define GDK_H 0x048
#define GDK_G 0x047
#define GDK_F 0x046
#define GDK_E 0x045
#define GDK_D 0x044
#define GDK_C 0x043
#define GDK_B 0x042
#define GDK_A 0x041
#define GDK_at 0x040
#define GDK_question 0x03f
#define GDK_greater 0x03e
#define GDK_equal 0x03d
#define GDK_less 0x03c
#define GDK_semicolon 0x03b
#define GDK_colon 0x03a
#define GDK_9 0x039
#define GDK_8 0x038
#define GDK_7 0x037
#define GDK_6 0x036
#define GDK_5 0x035
#define GDK_4 0x034
#define GDK_3 0x033
#define GDK_2 0x032
#define GDK_1 0x031
#define GDK_0 0x030
#define GDK_slash 0x02f
#define GDK_period 0x02e
#define GDK_minus 0x02d
#define GDK_comma 0x02c
#define GDK_plus 0x02b
#define GDK_asterisk 0x02a
#define GDK_parenright 0x029
#define GDK_parenleft 0x028
#define GDK_quoteright 0x027
#define GDK_apostrophe 0x027
#define GDK_ampersand 0x026
#define GDK_percent 0x025
#define GDK_dollar 0x024
#define GDK_numbersign 0x023
#define GDK_quotedbl 0x022
#define GDK_exclam 0x021
#define GDK_space 0x020
#define GDK_3270_Enter 0xfd1e
#define GDK_3270_PrintScreen 0xfd1d
#define GDK_3270_CursorSelect 0xfd1c
#define GDK_3270_ExSelect 0xfd1b
#define GDK_3270_DeleteWord 0xfd1a
#define GDK_3270_ChangeScreen 0xfd19
#define GDK_3270_Record 0xfd18
#define GDK_3270_Setup 0xfd17
#define GDK_3270_Play 0xfd16
#define GDK_3270_Copy 0xfd15
#define GDK_3270_Rule 0xfd14
#define GDK_3270_Ident 0xfd13
#define GDK_3270_Jump 0xfd12
#define GDK_3270_KeyClick 0xfd11
#define GDK_3270_AltCursor 0xfd10
#define GDK_3270_CursorBlink 0xfd0f
#define GDK_3270_Attn 0xfd0e
#define GDK_3270_Test 0xfd0d
#define GDK_3270_PA3 0xfd0c
#define GDK_3270_PA2 0xfd0b
#define GDK_3270_PA1 0xfd0a
#define GDK_3270_Quit 0xfd09
#define GDK_3270_Reset 0xfd08
#define GDK_3270_EraseInput 0xfd07
#define GDK_3270_EraseEOF 0xfd06
#define GDK_3270_BackTab 0xfd05
#define GDK_3270_Left2 0xfd04
#define GDK_3270_Right2 0xfd03
#define GDK_3270_FieldMark 0xfd02
#define GDK_3270_Duplicate 0xfd01
#define GDK_C_H 0xfea5
#define GDK_C_h 0xfea4
#define GDK_c_h 0xfea3
#define GDK_CH 0xfea2
#define GDK_Ch 0xfea1
#define GDK_ch 0xfea0
#define GDK_Pointer_DfltBtnPrev 0xfefc
#define GDK_Pointer_DfltBtnNext 0xfefb
#define GDK_Pointer_Accelerate 0xfefa
#define GDK_Pointer_EnableKeys 0xfef9
#define GDK_Pointer_Drag5 0xfefd
#define GDK_Pointer_Drag4 0xfef8
#define GDK_Pointer_Drag3 0xfef7
#define GDK_Pointer_Drag2 0xfef6
#define GDK_Pointer_Drag1 0xfef5
#define GDK_Pointer_Drag_Dflt 0xfef4
#define GDK_Pointer_DblClick5 0xfef3
#define GDK_Pointer_DblClick4 0xfef2
#define GDK_Pointer_DblClick3 0xfef1
#define GDK_Pointer_DblClick2 0xfef0
#define GDK_Pointer_DblClick1 0xfeef
#define GDK_Pointer_DblClick_Dflt 0xfeee
#define GDK_Pointer_Button5 0xfeed
#define GDK_Pointer_Button4 0xfeec
#define GDK_Pointer_Button3 0xfeeb
#define GDK_Pointer_Button2 0xfeea
#define GDK_Pointer_Button1 0xfee9
#define GDK_Pointer_Button_Dflt 0xfee8
#define GDK_Pointer_DownRight 0xfee7
#define GDK_Pointer_DownLeft 0xfee6
#define GDK_Pointer_UpRight 0xfee5
#define GDK_Pointer_UpLeft 0xfee4
#define GDK_Pointer_Down 0xfee3
#define GDK_Pointer_Up 0xfee2
#define GDK_Pointer_Right 0xfee1
#define GDK_Pointer_Left 0xfee0
#define GDK_AudibleBell_Enable 0xfe7a
#define GDK_Overlay2_Enable 0xfe79
#define GDK_Overlay1_Enable 0xfe78
#define GDK_MouseKeys_Accel_Enable 0xfe77
#define GDK_MouseKeys_Enable 0xfe76
#define GDK_StickyKeys_Enable 0xfe75
#define GDK_BounceKeys_Enable 0xfe74
#define GDK_SlowKeys_Enable 0xfe73
#define GDK_RepeatKeys_Enable 0xfe72
#define GDK_AccessX_Feedback_Enable 0xfe71
#define GDK_AccessX_Enable 0xfe70
#define GDK_Terminate_Server 0xfed5
#define GDK_Last_Virtual_Screen 0xfed4
#define GDK_Next_Virtual_Screen 0xfed2
#define GDK_Prev_Virtual_Screen 0xfed1
#define GDK_First_Virtual_Screen 0xfed0
#define GDK_dead_greek 0xfe8c
#define GDK_dead_capital_schwa 0xfe8b
#define GDK_dead_small_schwa 0xfe8a
#define GDK_dead_U 0xfe89
#define GDK_dead_u 0xfe88
#define GDK_dead_O 0xfe87
#define GDK_dead_o 0xfe86
#define GDK_dead_I 0xfe85
#define GDK_dead_i 0xfe84
#define GDK_dead_E 0xfe83
#define GDK_dead_e 0xfe82
#define GDK_dead_A 0xfe81
#define GDK_dead_a 0xfe80
#define GDK_dead_currency 0xfe6f
#define GDK_dead_belowcomma 0xfe6e
#define GDK_dead_invertedbreve 0xfe6d
#define GDK_dead_belowdiaeresis 0xfe6c
#define GDK_dead_belowbreve 0xfe6b
#define GDK_dead_belowtilde 0xfe6a
#define GDK_dead_belowcircumflex 0xfe69
#define GDK_dead_belowmacron 0xfe68
#define GDK_dead_belowring 0xfe67
#define GDK_dead_doublegrave 0xfe66
#define GDK_dead_dasia 0xfe65
#define GDK_dead_abovereversedcomma 0xfe65
#define GDK_dead_psili 0xfe64
#define GDK_dead_abovecomma 0xfe64
#define GDK_dead_stroke 0xfe63
#define GDK_dead_horn 0xfe62
#define GDK_dead_hook 0xfe61
#define GDK_dead_belowdot 0xfe60
#define GDK_dead_semivoiced_sound 0xfe5f
#define GDK_dead_voiced_sound 0xfe5e
#define GDK_dead_iota 0xfe5d
#define GDK_dead_ogonek 0xfe5c
#define GDK_dead_cedilla 0xfe5b
#define GDK_dead_caron 0xfe5a
#define GDK_dead_doubleacute 0xfe59
#define GDK_dead_abovering 0xfe58
#define GDK_dead_diaeresis 0xfe57
#define GDK_dead_abovedot 0xfe56
#define GDK_dead_breve 0xfe55
#define GDK_dead_macron 0xfe54
#define GDK_dead_perispomeni 0xfe53
#define GDK_dead_tilde 0xfe53
#define GDK_dead_circumflex 0xfe52
#define GDK_dead_acute 0xfe51
#define GDK_dead_grave 0xfe50
#define GDK_ISO_Enter 0xfe34
#define GDK_ISO_Center_Object 0xfe33
#define GDK_ISO_Emphasize 0xfe32
#define GDK_ISO_Discontinuous_Underline 0xfe31
#define GDK_ISO_Continuous_Underline 0xfe30
#define GDK_ISO_Fast_Cursor_Down 0xfe2f
#define GDK_ISO_Fast_Cursor_Up 0xfe2e
#define GDK_ISO_Fast_Cursor_Right 0xfe2d
#define GDK_ISO_Fast_Cursor_Left 0xfe2c
#define GDK_ISO_Release_Both_Margins 0xfe2b
#define GDK_ISO_Release_Margin_Right 0xfe2a
#define GDK_ISO_Release_Margin_Left 0xfe29
#define GDK_ISO_Set_Margin_Right 0xfe28
#define GDK_ISO_Set_Margin_Left 0xfe27
#define GDK_ISO_Partial_Space_Right 0xfe26
#define GDK_ISO_Partial_Space_Left 0xfe25
#define GDK_ISO_Partial_Line_Down 0xfe24
#define GDK_ISO_Partial_Line_Up 0xfe23
#define GDK_ISO_Move_Line_Down 0xfe22
#define GDK_ISO_Move_Line_Up 0xfe21
#define GDK_ISO_Left_Tab 0xfe20
#define GDK_ISO_Last_Group_Lock 0xfe0f
#define GDK_ISO_Last_Group 0xfe0e
#define GDK_ISO_First_Group_Lock 0xfe0d
#define GDK_ISO_First_Group 0xfe0c
#define GDK_ISO_Prev_Group_Lock 0xfe0b
#define GDK_ISO_Prev_Group 0xfe0a
#define GDK_ISO_Next_Group_Lock 0xfe09
#define GDK_ISO_Next_Group 0xfe08
#define GDK_ISO_Group_Lock 0xfe07
#define GDK_ISO_Group_Latch 0xfe06
#define GDK_ISO_Group_Shift 0xff7e
#define GDK_ISO_Level5_Lock 0xfe13
#define GDK_ISO_Level5_Latch 0xfe12
#define GDK_ISO_Level5_Shift 0xfe11
#define GDK_ISO_Level3_Lock 0xfe05
#define GDK_ISO_Level3_Latch 0xfe04
#define GDK_ISO_Level3_Shift 0xfe03
#define GDK_ISO_Level2_Latch 0xfe02
#define GDK_ISO_Lock 0xfe01
#define GDK_Hyper_R 0xffee
#define GDK_Hyper_L 0xffed
#define GDK_Super_R 0xffec
#define GDK_Super_L 0xffeb
#define GDK_Alt_R 0xffea
#define GDK_Alt_L 0xffe9
#define GDK_Meta_R 0xffe8
#define GDK_Meta_L 0xffe7
#define GDK_Shift_Lock 0xffe6
#define GDK_Caps_Lock 0xffe5
#define GDK_Control_R 0xffe4
#define GDK_Control_L 0xffe3
#define GDK_Shift_R 0xffe2
#define GDK_Shift_L 0xffe1
#define GDK_R15 0xffe0
#define GDK_F35 0xffe0
#define GDK_R14 0xffdf
#define GDK_F34 0xffdf
#define GDK_R13 0xffde
#define GDK_F33 0xffde
#define GDK_R12 0xffdd
#define GDK_F32 0xffdd
#define GDK_R11 0xffdc
#define GDK_F31 0xffdc
#define GDK_R10 0xffdb
#define GDK_F30 0xffdb
#define GDK_R9 0xffda
#define GDK_F29 0xffda
#define GDK_R8 0xffd9
#define GDK_F28 0xffd9
#define GDK_R7 0xffd8
#define GDK_F27 0xffd8
#define GDK_R6 0xffd7
#define GDK_F26 0xffd7
#define GDK_R5 0xffd6
#define GDK_F25 0xffd6
#define GDK_R4 0xffd5
#define GDK_F24 0xffd5
#define GDK_R3 0xffd4
#define GDK_F23 0xffd4
#define GDK_R2 0xffd3
#define GDK_F22 0xffd3
#define GDK_R1 0xffd2
#define GDK_F21 0xffd2
#define GDK_L10 0xffd1
#define GDK_F20 0xffd1
#define GDK_L9 0xffd0
#define GDK_F19 0xffd0
#define GDK_L8 0xffcf
#define GDK_F18 0xffcf
#define GDK_L7 0xffce
#define GDK_F17 0xffce
#define GDK_L6 0xffcd
#define GDK_F16 0xffcd
#define GDK_L5 0xffcc
#define GDK_F15 0xffcc
#define GDK_L4 0xffcb
#define GDK_F14 0xffcb
#define GDK_L3 0xffca
#define GDK_F13 0xffca
#define GDK_L2 0xffc9
#define GDK_F12 0xffc9
#define GDK_L1 0xffc8
#define GDK_F11 0xffc8
#define GDK_F10 0xffc7
#define GDK_F9 0xffc6
#define GDK_F8 0xffc5
#define GDK_F7 0xffc4
#define GDK_F6 0xffc3
#define GDK_F5 0xffc2
#define GDK_F4 0xffc1
#define GDK_F3 0xffc0
#define GDK_F2 0xffbf
#define GDK_F1 0xffbe
#define GDK_KP_9 0xffb9
#define GDK_KP_8 0xffb8
#define GDK_KP_7 0xffb7
#define GDK_KP_6 0xffb6
#define GDK_KP_5 0xffb5
#define GDK_KP_4 0xffb4
#define GDK_KP_3 0xffb3
#define GDK_KP_2 0xffb2
#define GDK_KP_1 0xffb1
#define GDK_KP_0 0xffb0
#define GDK_KP_Divide 0xffaf
#define GDK_KP_Decimal 0xffae
#define GDK_KP_Subtract 0xffad
#define GDK_KP_Separator 0xffac
#define GDK_KP_Add 0xffab
#define GDK_KP_Multiply 0xffaa
#define GDK_KP_Equal 0xffbd
#define GDK_KP_Delete 0xff9f
#define GDK_KP_Insert 0xff9e
#define GDK_KP_Begin 0xff9d
#define GDK_KP_End 0xff9c
#define GDK_KP_Page_Down 0xff9b
#define GDK_KP_Next 0xff9b
#define GDK_KP_Page_Up 0xff9a
#define GDK_KP_Prior 0xff9a
#define GDK_KP_Down 0xff99
#define GDK_KP_Right 0xff98
#define GDK_KP_Up 0xff97
#define GDK_KP_Left 0xff96
#define GDK_KP_Home 0xff95
#define GDK_KP_F4 0xff94
#define GDK_KP_F3 0xff93
#define GDK_KP_F2 0xff92
#define GDK_KP_F1 0xff91
#define GDK_KP_Enter 0xff8d
#define GDK_KP_Tab 0xff89
#define GDK_KP_Space 0xff80
#define GDK_Num_Lock 0xff7f
#define GDK_script_switch 0xff7e
#define GDK_Mode_switch 0xff7e
#define GDK_Break 0xff6b
#define GDK_Help 0xff6a
#define GDK_Cancel 0xff69
#define GDK_Find 0xff68
#define GDK_Menu 0xff67
#define GDK_Redo 0xff66
#define GDK_Undo 0xff65
#define GDK_Insert 0xff63
#define GDK_Execute 0xff62
#define GDK_Print 0xff61
#define GDK_Select 0xff60
#define GDK_Begin 0xff58
#define GDK_End 0xff57
#define GDK_Page_Down 0xff56
#define GDK_Next 0xff56
#define GDK_Page_Up 0xff55
#define GDK_Prior 0xff55
#define GDK_Down 0xff54
#define GDK_Right 0xff53
#define GDK_Up 0xff52
#define GDK_Left 0xff51
#define GDK_Home 0xff50
#define GDK_Mae_Koho 0xff3e
#define GDK_Zen_Koho 0xff3d
#define GDK_Kanji_Bangou 0xff37
#define GDK_Eisu_toggle 0xff30
#define GDK_Eisu_Shift 0xff2f
#define GDK_Kana_Shift 0xff2e
#define GDK_Kana_Lock 0xff2d
#define GDK_Massyo 0xff2c
#define GDK_Touroku 0xff2b
#define GDK_Zenkaku_Hankaku 0xff2a
#define GDK_Hankaku 0xff29
#define GDK_Zenkaku 0xff28
#define GDK_Hiragana_Katakana 0xff27
#define GDK_Katakana 0xff26
#define GDK_Hiragana 0xff25
#define GDK_Romaji 0xff24
#define GDK_Henkan 0xff23
#define GDK_Henkan_Mode 0xff23
#define GDK_Muhenkan 0xff22
#define GDK_Kanji 0xff21
#define GDK_PreviousCandidate 0xff3e
#define GDK_MultipleCandidate 0xff3d
#define GDK_SingleCandidate 0xff3c
#define GDK_Codeinput 0xff37
#define GDK_Multi_key 0xff20
#define GDK_Delete 0xffff
#define GDK_Escape 0xff1b
#define GDK_Sys_Req 0xff15
#define GDK_Scroll_Lock 0xff14
#define GDK_Pause 0xff13
#define GDK_Return 0xff0d
#define GDK_Clear 0xff0b
#define GDK_Linefeed 0xff0a
#define GDK_Tab 0xff09
#define GDK_BackSpace 0xff08
#define GDK_VoidSymbol 0xffffff
#define GDK_IS_KEYMAP(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_KEYMAP))
#define GDK_KEYMAP(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_KEYMAP, GdkKeymap))
#define GDK_TYPE_KEYMAP              (gdk_keymap_get_type ())
#define GDK_GL_ERROR       (gdk_gl_error_quark ())
#define GDK_IS_GL_CONTEXT(obj)          (G_TYPE_CHECK_INSTANCE_TYPE ((obj), GDK_TYPE_GL_CONTEXT))
#define GDK_GL_CONTEXT(obj)             (G_TYPE_CHECK_INSTANCE_CAST ((obj), GDK_TYPE_GL_CONTEXT, GdkGLContext))
#define GDK_TYPE_GL_CONTEXT             (gdk_gl_context_get_type ())
#define GDK_FRAME_CLOCK_IDLE_GET_CLASS(obj)  (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_FRAME_CLOCK_IDLE, GdkFrameClockIdleClass))
#define GDK_IS_FRAME_CLOCK_IDLE_CLASS(klass) (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_FRAME_CLOCK_IDLE))
#define GDK_IS_FRAME_CLOCK_IDLE(obj)         (G_TYPE_CHECK_INSTANCE_TYPE ((obj), GDK_TYPE_FRAME_CLOCK_IDLE))
#define GDK_FRAME_CLOCK_IDLE_CLASS(klass)    (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_FRAME_CLOCK_IDLE, GdkFrameClockIdleClass))
#define GDK_FRAME_CLOCK_IDLE(obj)            (G_TYPE_CHECK_INSTANCE_CAST ((obj), GDK_TYPE_FRAME_CLOCK_IDLE, GdkFrameClockIdle))
#define GDK_TYPE_FRAME_CLOCK_IDLE            (gdk_frame_clock_idle_get_type ())
#define GDK_FRAME_CLOCK_GET_CLASS(obj)  (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_FRAME_CLOCK, GdkFrameClockClass))
#define GDK_IS_FRAME_CLOCK_CLASS(klass) (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_FRAME_CLOCK))
#define GDK_IS_FRAME_CLOCK(obj)         (G_TYPE_CHECK_INSTANCE_TYPE ((obj), GDK_TYPE_FRAME_CLOCK))
#define GDK_FRAME_CLOCK_CLASS(klass)    (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_FRAME_CLOCK, GdkFrameClockClass))
#define GDK_FRAME_CLOCK(obj)            (G_TYPE_CHECK_INSTANCE_CAST ((obj), GDK_TYPE_FRAME_CLOCK, GdkFrameClock))
#define GDK_TYPE_FRAME_CLOCK            (gdk_frame_clock_get_type ())
#define GDK_BUTTON_SECONDARY    (3)
#define GDK_BUTTON_MIDDLE       (2)
#define GDK_BUTTON_PRIMARY      (1)
#define GDK_EVENT_STOP          (TRUE)
#define GDK_EVENT_PROPAGATE     (FALSE)
#define GDK_PRIORITY_REDRAW     (G_PRIORITY_HIGH_IDLE + 20)
#define GDK_PRIORITY_EVENTS	(G_PRIORITY_DEFAULT)
#define GDK_TYPE_EVENT_SEQUENCE (gdk_event_sequence_get_type ())
#define GDK_TYPE_EVENT          (gdk_event_get_type ())
#define GDK_DRAWING_CONTEXT_GET_CLASS(obj)      (G_TYPE_INSTANCE_GET_CLASS ((obj), GDK_TYPE_DRAWING_CONTEXT, GdkDrawingContextClass))
#define GDK_IS_DRAWING_CONTEXT_CLASS(klass)     (G_TYPE_CHECK_CLASS_TYPE ((klass), GDK_TYPE_DRAWING_CONTEXT))
#define GDK_DRAWING_CONTEXT_CLASS(klass)        (G_TYPE_CHECK_CLASS_CAST ((klass), GDK_TYPE_DRAWING_CONTEXT, GdkDrawingContextClass))
#define GDK_IS_DRAWING_CONTEXT(obj)     (G_TYPE_CHECK_INSTANCE_TYPE ((obj), GDK_TYPE_DRAWING_CONTEXT))
#define GDK_DRAWING_CONTEXT(obj)        (G_TYPE_CHECK_INSTANCE_CAST ((obj), GDK_TYPE_DRAWING_CONTEXT, GdkDrawingContext))
#define GDK_TYPE_DRAWING_CONTEXT (gdk_drawing_context_get_type ())
#define GDK_IS_DRAG_CONTEXT(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_DRAG_CONTEXT))
#define GDK_DRAG_CONTEXT(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_DRAG_CONTEXT, GdkDragContext))
#define GDK_TYPE_DRAG_CONTEXT              (gdk_drag_context_get_type ())
#define GDK_IS_DISPLAY_MANAGER(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_DISPLAY_MANAGER))
#define GDK_DISPLAY_MANAGER(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_DISPLAY_MANAGER, GdkDisplayManager))
#define GDK_TYPE_DISPLAY_MANAGER              (gdk_display_manager_get_type ())
#define GDK_DISPLAY_OBJECT(object)    GDK_DISPLAY(object)
#define GDK_IS_DISPLAY(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_DISPLAY))
#define GDK_DISPLAY(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_DISPLAY, GdkDisplay))
#define GDK_TYPE_DISPLAY              (gdk_display_get_type ())
#define GDK_IS_DEVICE_TOOL(o)   (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_DEVICE_TOOL))
#define GDK_DEVICE_TOOL(o)      (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_DEVICE_TOOL, GdkDeviceTool))
#define GDK_TYPE_DEVICE_TOOL    (gdk_device_tool_get_type ())
#define GDK_DEVICE_PAD_GET_IFACE(obj)  (G_TYPE_INSTANCE_GET_INTERFACE ((obj), GDK_TYPE_DEVICE_PAD, GdkDevicePadInterface))
#define GDK_IS_DEVICE_PAD(o)        (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_DEVICE_PAD))
#define GDK_DEVICE_PAD(o)           (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_DEVICE_PAD, GdkDevicePad))
#define GDK_TYPE_DEVICE_PAD         (gdk_device_pad_get_type ())
#define GDK_IS_DEVICE_MANAGER(o)        (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_DEVICE_MANAGER))
#define GDK_DEVICE_MANAGER(o)           (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_DEVICE_MANAGER, GdkDeviceManager))
#define GDK_TYPE_DEVICE_MANAGER         (gdk_device_manager_get_type ())
#define GDK_MAX_TIMECOORD_AXES 128
#define GDK_IS_DEVICE(o)        (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_DEVICE))
#define GDK_DEVICE(o)           (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_DEVICE, GdkDevice))
#define GDK_TYPE_DEVICE         (gdk_device_get_type ())
#define GDK_IS_CURSOR(object)        (G_TYPE_CHECK_INSTANCE_TYPE ((object), GDK_TYPE_CURSOR))
#define GDK_CURSOR(object)           (G_TYPE_CHECK_INSTANCE_CAST ((object), GDK_TYPE_CURSOR, GdkCursor))
#define GDK_TYPE_CURSOR              (gdk_cursor_get_type ())
#define GDK_IS_APP_LAUNCH_CONTEXT(o)        (G_TYPE_CHECK_INSTANCE_TYPE ((o), GDK_TYPE_APP_LAUNCH_CONTEXT))
#define GDK_APP_LAUNCH_CONTEXT(o)           (G_TYPE_CHECK_INSTANCE_CAST ((o), GDK_TYPE_APP_LAUNCH_CONTEXT, GdkAppLaunchContext))
#define GDK_TYPE_APP_LAUNCH_CONTEXT         (gdk_app_launch_context_get_type ())

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


typedef GdkWindow GdkX11Window;
typedef GdkVisual GdkX11Visual;
typedef GdkScreen GdkX11Screen;
typedef GdkKeymap GdkX11Keymap;
typedef GdkDragContext GdkX11DragContext;
typedef GdkDisplayManager GdkX11DisplayManager;
typedef GdkDisplay GdkX11Display;
typedef GdkCursor GdkX11Cursor;
typedef GdkAppLaunchContext GdkX11AppLaunchContext;
typedef PropMotifWmInfo PropMwmInfo;
typedef PropMotifWmHints PropMwmHints;
typedef MotifWmInfo MwmInfo;
typedef struct _GdkAtom            *GdkAtom;
typedef void GdkXEvent;	  /* Can be cast to window system specific */
typedef union _GdkEvent GdkEvent;
//typedef struct __GdkX11WindowClass GdkX11WindowClass;
//typedef struct __GdkX11Window GdkX11Window;
typedef struct __GdkX11VisualClass GdkX11VisualClass;
typedef struct __GdkX11Visual GdkX11Visual;
typedef struct __GdkX11KeymapClass GdkX11KeymapClass;
typedef struct __GdkX11Keymap GdkX11Keymap;
typedef struct __GdkX11DragContextClass GdkX11DragContextClass;
typedef struct __GdkX11DragContext GdkX11DragContext;
typedef struct __GdkX11DisplayManagerClass GdkX11DisplayManagerClass;
typedef struct __GdkX11DisplayManager GdkX11DisplayManager;
typedef struct __GdkX11DeviceManagerXI2Class GdkX11DeviceManagerXI2Class;
typedef struct __GdkX11DeviceManagerXI2 GdkX11DeviceManagerXI2;
typedef struct __GdkX11DeviceManagerXIClass GdkX11DeviceManagerXIClass;
typedef struct __GdkX11DeviceManagerXI GdkX11DeviceManagerXI;
typedef struct __GdkX11DeviceXI2Class GdkX11DeviceXI2Class;
typedef struct __GdkX11DeviceXI2 GdkX11DeviceXI2;
typedef struct __GdkX11DeviceCoreClass GdkX11DeviceCoreClass;
typedef struct __GdkX11DeviceCore GdkX11DeviceCore;
typedef struct __GdkX11CursorClass GdkX11CursorClass;
typedef struct __GdkX11Cursor GdkX11Cursor;
typedef struct __GdkX11AppLaunchContextClass GdkX11AppLaunchContextClass;
typedef struct __GdkX11AppLaunchContext GdkX11AppLaunchContext;
typedef struct __GdkXPositionInfo GdkXPositionInfo;
typedef struct _GdkToplevelX11 GdkToplevelX11;
typedef struct _GdkWindowImplX11Class GdkWindowImplX11Class;
typedef struct _GdkWindowImplX11 GdkWindowImplX11;
typedef struct _GdkX11ScreenClass GdkX11ScreenClass;
typedef struct _GdkX11Screen GdkX11Screen;
typedef struct _GdkX11MonitorClass GdkX11MonitorClass;
typedef struct _GdkX11Monitor GdkX11Monitor;
typedef struct _GdkX11GLContextClass GdkX11GLContextClass;
typedef struct _GdkX11GLContext GdkX11GLContext;
typedef struct __GdkEventTranslator GdkEventTranslator;
typedef struct _GdkEventTranslatorIface GdkEventTranslatorIface;
typedef struct __GdkEventSource GdkEventSource;
typedef struct _GdkX11DisplayClass GdkX11DisplayClass;
//typedef struct _GdkX11Display GdkX11Display;
typedef struct _GdkX11DeviceManagerCoreClass GdkX11DeviceManagerCoreClass;
typedef struct _GdkX11DeviceManagerCore GdkX11DeviceManagerCore;
typedef struct _GdkChildInfoX11 GdkChildInfoX11;
typedef struct __GdkMirWindowReference GdkMirWindowReference;
typedef struct __GdkMirWindowImpl GdkMirWindowImpl;
typedef struct __GdkMirEventSource GdkMirEventSource;
typedef struct _GdkMirGLContextClass GdkMirGLContextClass;
typedef struct _GdkMirGLContext GdkMirGLContext;
typedef struct _GdkColor GdkColor;
typedef struct _GdkWindowImplClass GdkWindowImplClass;
typedef struct _GdkWindowImpl GdkWindowImpl;
typedef struct __GdkWindowRedirect GdkWindowRedirect;
typedef struct _GdkWindowClass GdkWindowClass;
typedef struct _GdkGeometry GdkGeometry;
typedef struct _GdkWindowAttr GdkWindowAttr;
//typedef struct __GdkWindow GdkWindow;
//typedef struct __GdkVisual GdkVisual;
//typedef struct __GdkScreen GdkScreen;
//typedef struct __GdkKeymap GdkKeymap;
typedef struct __GdkGLContext GdkGLContext;
//typedef struct __GdkDragContext GdkDragContext;
//typedef struct __GdkDisplayManager GdkDisplayManager;
//typedef struct __GdkDisplay GdkDisplay;
typedef struct __GdkDeviceManager GdkDeviceManager;
//typedef struct __GdkDevice GdkDevice;
//typedef struct __GdkCursor GdkCursor;
//typedef struct __GdkAppLaunchContext GdkAppLaunchContext;
typedef struct _GdkPoint GdkPoint;
typedef struct _GdkRectangle GdkRectangle;
typedef struct _GdkSeat GdkSeat;
typedef struct _GdkRGBA GdkRGBA;
typedef struct _GdkMonitorClass GdkMonitorClass;
typedef struct _GdkMonitor GdkMonitor;
typedef struct _GdkKeymapKey GdkKeymapKey;
typedef struct __GdkFrameTimings GdkFrameTimings;
typedef struct __GdkFrameClockIdlePrivate GdkFrameClockIdlePrivate;
typedef struct _GdkFrameClockIdleClass GdkFrameClockIdleClass;
typedef struct _GdkFrameClockIdle GdkFrameClockIdle;
typedef struct __GdkFrameClockPrivate GdkFrameClockPrivate;
typedef struct __GdkFrameClockClass GdkFrameClockClass;
typedef struct __GdkFrameClock GdkFrameClock;
typedef struct __GdkEventSequence GdkEventSequence;
typedef struct _GdkEventPadGroupMode GdkEventPadGroupMode;
typedef struct _GdkEventPadAxis GdkEventPadAxis;
typedef struct _GdkEventPadButton GdkEventPadButton;
typedef struct _GdkEventTouchpadPinch GdkEventTouchpadPinch;
typedef struct _GdkEventTouchpadSwipe GdkEventTouchpadSwipe;
typedef struct _GdkEventDND GdkEventDND;
typedef struct _GdkEventGrabBroken GdkEventGrabBroken;
typedef struct _GdkEventWindowState GdkEventWindowState;
typedef struct _GdkEventSetting GdkEventSetting;
typedef struct _GdkEventProximity GdkEventProximity;
typedef struct _GdkEventOwnerChange GdkEventOwnerChange;
typedef struct _GdkEventSelection GdkEventSelection;
typedef struct _GdkEventProperty GdkEventProperty;
typedef struct _GdkEventConfigure GdkEventConfigure;
typedef struct _GdkEventFocus GdkEventFocus;
typedef struct _GdkEventCrossing GdkEventCrossing;
typedef struct _GdkEventKey GdkEventKey;
typedef struct _GdkEventScroll GdkEventScroll;
typedef struct _GdkEventTouch GdkEventTouch;
typedef struct _GdkEventButton GdkEventButton;
typedef struct _GdkEventMotion GdkEventMotion;
typedef struct _GdkEventVisibility GdkEventVisibility;
typedef struct _GdkEventExpose GdkEventExpose;
typedef struct _GdkEventAny GdkEventAny;
typedef struct _GdkDrawingContextClass GdkDrawingContextClass;
typedef struct _GdkDrawingContext GdkDrawingContext;
typedef struct _GdkDeviceToolClass GdkDeviceToolClass;
typedef struct _GdkDeviceTool GdkDeviceTool;
typedef struct _GdkDevicePadInterface GdkDevicePadInterface;
typedef struct __GdkDevicePad GdkDevicePad;
typedef struct _GdkTimeCoord GdkTimeCoord;

typedef enum
{
  GDK_FULLSCREEN_ON_CURRENT_MONITOR,
  GDK_FULLSCREEN_ON_ALL_MONITORS
} GdkFullscreenMode;
typedef enum
{
  GDK_WINDOW_EDGE_NORTH_WEST,
  GDK_WINDOW_EDGE_NORTH,
  GDK_WINDOW_EDGE_NORTH_EAST,
  GDK_WINDOW_EDGE_WEST,
  GDK_WINDOW_EDGE_EAST,
  GDK_WINDOW_EDGE_SOUTH_WEST,
  GDK_WINDOW_EDGE_SOUTH,
  GDK_WINDOW_EDGE_SOUTH_EAST  
} GdkWindowEdge;
typedef enum
{
  GDK_ANCHOR_FLIP_X   = 1 << 0,
  GDK_ANCHOR_FLIP_Y   = 1 << 1,
  GDK_ANCHOR_SLIDE_X  = 1 << 2,
  GDK_ANCHOR_SLIDE_Y  = 1 << 3,
  GDK_ANCHOR_RESIZE_X = 1 << 4,
  GDK_ANCHOR_RESIZE_Y = 1 << 5,
  GDK_ANCHOR_FLIP     = GDK_ANCHOR_FLIP_X | GDK_ANCHOR_FLIP_Y,
  GDK_ANCHOR_SLIDE    = GDK_ANCHOR_SLIDE_X | GDK_ANCHOR_SLIDE_Y,
  GDK_ANCHOR_RESIZE   = GDK_ANCHOR_RESIZE_X | GDK_ANCHOR_RESIZE_Y
} GdkAnchorHints;
typedef enum
{
  GDK_GRAVITY_NORTH_WEST = 1,
  GDK_GRAVITY_NORTH,
  GDK_GRAVITY_NORTH_EAST,
  GDK_GRAVITY_WEST,
  GDK_GRAVITY_CENTER,
  GDK_GRAVITY_EAST,
  GDK_GRAVITY_SOUTH_WEST,
  GDK_GRAVITY_SOUTH,
  GDK_GRAVITY_SOUTH_EAST,
  GDK_GRAVITY_STATIC
} GdkGravity;
typedef enum
{
  GDK_FUNC_ALL		= 1 << 0,
  GDK_FUNC_RESIZE	= 1 << 1,
  GDK_FUNC_MOVE		= 1 << 2,
  GDK_FUNC_MINIMIZE	= 1 << 3,
  GDK_FUNC_MAXIMIZE	= 1 << 4,
  GDK_FUNC_CLOSE	= 1 << 5
} GdkWMFunction;
typedef enum
{
  GDK_DECOR_ALL		= 1 << 0,
  GDK_DECOR_BORDER	= 1 << 1,
  GDK_DECOR_RESIZEH	= 1 << 2,
  GDK_DECOR_TITLE	= 1 << 3,
  GDK_DECOR_MENU	= 1 << 4,
  GDK_DECOR_MINIMIZE	= 1 << 5,
  GDK_DECOR_MAXIMIZE	= 1 << 6
} GdkWMDecoration;
typedef enum
{
  GDK_HINT_POS	       = 1 << 0,
  GDK_HINT_MIN_SIZE    = 1 << 1,
  GDK_HINT_MAX_SIZE    = 1 << 2,
  GDK_HINT_BASE_SIZE   = 1 << 3,
  GDK_HINT_ASPECT      = 1 << 4,
  GDK_HINT_RESIZE_INC  = 1 << 5,
  GDK_HINT_WIN_GRAVITY = 1 << 6,
  GDK_HINT_USER_POS    = 1 << 7,
  GDK_HINT_USER_SIZE   = 1 << 8
} GdkWindowHints;
typedef enum
{
  GDK_WA_TITLE	   = 1 << 1,
  GDK_WA_X	   = 1 << 2,
  GDK_WA_Y	   = 1 << 3,
  GDK_WA_CURSOR	   = 1 << 4,
  GDK_WA_VISUAL	   = 1 << 5,
  GDK_WA_WMCLASS   = 1 << 6,
  GDK_WA_NOREDIR   = 1 << 7,
  GDK_WA_TYPE_HINT = 1 << 8
} GdkWindowAttributesType;
typedef enum
{
  GDK_WINDOW_ROOT,
  GDK_WINDOW_TOPLEVEL,
  GDK_WINDOW_CHILD,
  GDK_WINDOW_TEMP,
  GDK_WINDOW_FOREIGN,
  GDK_WINDOW_OFFSCREEN,
  GDK_WINDOW_SUBSURFACE
} GdkWindowType;
typedef enum
{
  GDK_INPUT_OUTPUT, /*< nick=input-output >*/
  GDK_INPUT_ONLY    /*< nick=input-only >*/
} GdkWindowWindowClass;
typedef enum
{
  GDK_VISUAL_STATIC_GRAY,
  GDK_VISUAL_GRAYSCALE,
  GDK_VISUAL_STATIC_COLOR,
  GDK_VISUAL_PSEUDO_COLOR,
  GDK_VISUAL_TRUE_COLOR,
  GDK_VISUAL_DIRECT_COLOR
} GdkVisualType;
typedef enum
{
  GDK_AXIS_FLAG_X        = 1 << GDK_AXIS_X,
  GDK_AXIS_FLAG_Y        = 1 << GDK_AXIS_Y,
  GDK_AXIS_FLAG_PRESSURE = 1 << GDK_AXIS_PRESSURE,
  GDK_AXIS_FLAG_XTILT    = 1 << GDK_AXIS_XTILT,
  GDK_AXIS_FLAG_YTILT    = 1 << GDK_AXIS_YTILT,
  GDK_AXIS_FLAG_WHEEL    = 1 << GDK_AXIS_WHEEL,
  GDK_AXIS_FLAG_DISTANCE = 1 << GDK_AXIS_DISTANCE,
  GDK_AXIS_FLAG_ROTATION = 1 << GDK_AXIS_ROTATION,
  GDK_AXIS_FLAG_SLIDER   = 1 << GDK_AXIS_SLIDER,
} GdkAxisFlags;
typedef enum
{
  GDK_AXIS_IGNORE,
  GDK_AXIS_X,
  GDK_AXIS_Y,
  GDK_AXIS_PRESSURE,
  GDK_AXIS_XTILT,
  GDK_AXIS_YTILT,
  GDK_AXIS_WHEEL,
  GDK_AXIS_DISTANCE,
  GDK_AXIS_ROTATION,
  GDK_AXIS_SLIDER,
  GDK_AXIS_LAST
} GdkAxisUse;
typedef enum
{
  GDK_WINDOW_TYPE_HINT_NORMAL,
  GDK_WINDOW_TYPE_HINT_DIALOG,
  GDK_WINDOW_TYPE_HINT_MENU,		/* Torn off menu */
  GDK_WINDOW_TYPE_HINT_TOOLBAR,
  GDK_WINDOW_TYPE_HINT_SPLASHSCREEN,
  GDK_WINDOW_TYPE_HINT_UTILITY,
  GDK_WINDOW_TYPE_HINT_DOCK,
  GDK_WINDOW_TYPE_HINT_DESKTOP,
  GDK_WINDOW_TYPE_HINT_DROPDOWN_MENU,	/* A drop down menu (from a menubar) */
  GDK_WINDOW_TYPE_HINT_POPUP_MENU,	/* A popup menu (from right-click) */
  GDK_WINDOW_TYPE_HINT_TOOLTIP,
  GDK_WINDOW_TYPE_HINT_NOTIFICATION,
  GDK_WINDOW_TYPE_HINT_COMBO,
  GDK_WINDOW_TYPE_HINT_DND
} GdkWindowTypeHint;
typedef enum {
  GDK_GL_ERROR_NOT_AVAILABLE,
  GDK_GL_ERROR_UNSUPPORTED_FORMAT,
  GDK_GL_ERROR_UNSUPPORTED_PROFILE
} GdkGLError;
typedef enum
{
  GDK_EXPOSURE_MASK             = 1 << 1,
  GDK_POINTER_MOTION_MASK       = 1 << 2,
  GDK_POINTER_MOTION_HINT_MASK  = 1 << 3,
  GDK_BUTTON_MOTION_MASK        = 1 << 4,
  GDK_BUTTON1_MOTION_MASK       = 1 << 5,
  GDK_BUTTON2_MOTION_MASK       = 1 << 6,
  GDK_BUTTON3_MOTION_MASK       = 1 << 7,
  GDK_BUTTON_PRESS_MASK         = 1 << 8,
  GDK_BUTTON_RELEASE_MASK       = 1 << 9,
  GDK_KEY_PRESS_MASK            = 1 << 10,
  GDK_KEY_RELEASE_MASK          = 1 << 11,
  GDK_ENTER_NOTIFY_MASK         = 1 << 12,
  GDK_LEAVE_NOTIFY_MASK         = 1 << 13,
  GDK_FOCUS_CHANGE_MASK         = 1 << 14,
  GDK_STRUCTURE_MASK            = 1 << 15,
  GDK_PROPERTY_CHANGE_MASK      = 1 << 16,
  GDK_VISIBILITY_NOTIFY_MASK    = 1 << 17,
  GDK_PROXIMITY_IN_MASK         = 1 << 18,
  GDK_PROXIMITY_OUT_MASK        = 1 << 19,
  GDK_SUBSTRUCTURE_MASK         = 1 << 20,
  GDK_SCROLL_MASK               = 1 << 21,
  GDK_TOUCH_MASK                = 1 << 22,
  GDK_SMOOTH_SCROLL_MASK        = 1 << 23,
  GDK_TOUCHPAD_GESTURE_MASK     = 1 << 24,
  GDK_TABLET_PAD_MASK           = 1 << 25,
  GDK_ALL_EVENTS_MASK           = 0x3FFFFFE
} GdkEventMask;
typedef enum
{
  GDK_OWNERSHIP_NONE,
  GDK_OWNERSHIP_WINDOW,
  GDK_OWNERSHIP_APPLICATION
} GdkGrabOwnership;
typedef enum
{
  GDK_GRAB_SUCCESS         = 0,
  GDK_GRAB_ALREADY_GRABBED = 1,
  GDK_GRAB_INVALID_TIME    = 2,
  GDK_GRAB_NOT_VIEWABLE    = 3,
  GDK_GRAB_FROZEN          = 4,
  GDK_GRAB_FAILED          = 5
} GdkGrabStatus;
typedef enum
{
  GDK_OK          = 0,
  GDK_ERROR       = -1,
  GDK_ERROR_PARAM = -2,
  GDK_ERROR_FILE  = -3,
  GDK_ERROR_MEM   = -4
} GdkStatus;
typedef enum
{
  GDK_MODIFIER_INTENT_PRIMARY_ACCELERATOR,
  GDK_MODIFIER_INTENT_CONTEXT_MENU,
  GDK_MODIFIER_INTENT_EXTEND_SELECTION,
  GDK_MODIFIER_INTENT_MODIFY_SELECTION,
  GDK_MODIFIER_INTENT_NO_TEXT_INPUT,
  GDK_MODIFIER_INTENT_SHIFT_GROUP,
  GDK_MODIFIER_INTENT_DEFAULT_MOD_MASK,
} GdkModifierIntent;
typedef enum
{
  GDK_SHIFT_MASK    = 1 << 0,
  GDK_LOCK_MASK     = 1 << 1,
  GDK_CONTROL_MASK  = 1 << 2,
  GDK_MOD1_MASK     = 1 << 3,
  GDK_MOD2_MASK     = 1 << 4,
  GDK_MOD3_MASK     = 1 << 5,
  GDK_MOD4_MASK     = 1 << 6,
  GDK_MOD5_MASK     = 1 << 7,
  GDK_BUTTON1_MASK  = 1 << 8,
  GDK_BUTTON2_MASK  = 1 << 9,
  GDK_BUTTON3_MASK  = 1 << 10,
  GDK_BUTTON4_MASK  = 1 << 11,
  GDK_BUTTON5_MASK  = 1 << 12,

  GDK_MODIFIER_RESERVED_13_MASK  = 1 << 13,
  GDK_MODIFIER_RESERVED_14_MASK  = 1 << 14,
  GDK_MODIFIER_RESERVED_15_MASK  = 1 << 15,
  GDK_MODIFIER_RESERVED_16_MASK  = 1 << 16,
  GDK_MODIFIER_RESERVED_17_MASK  = 1 << 17,
  GDK_MODIFIER_RESERVED_18_MASK  = 1 << 18,
  GDK_MODIFIER_RESERVED_19_MASK  = 1 << 19,
  GDK_MODIFIER_RESERVED_20_MASK  = 1 << 20,
  GDK_MODIFIER_RESERVED_21_MASK  = 1 << 21,
  GDK_MODIFIER_RESERVED_22_MASK  = 1 << 22,
  GDK_MODIFIER_RESERVED_23_MASK  = 1 << 23,
  GDK_MODIFIER_RESERVED_24_MASK  = 1 << 24,
  GDK_MODIFIER_RESERVED_25_MASK  = 1 << 25,

  /* The next few modifiers are used by XKB, so we skip to the end.
   * Bits 15 - 25 are currently unused. Bit 29 is used internally.
   */
  
  GDK_SUPER_MASK    = 1 << 26,
  GDK_HYPER_MASK    = 1 << 27,
  GDK_META_MASK     = 1 << 28,
  
  GDK_MODIFIER_RESERVED_29_MASK  = 1 << 29,

  GDK_RELEASE_MASK  = 1 << 30,

  /* Combination of GDK_SHIFT_MASK..GDK_BUTTON5_MASK + GDK_SUPER_MASK
     + GDK_HYPER_MASK + GDK_META_MASK + GDK_RELEASE_MASK */
  GDK_MODIFIER_MASK = 0x5c001fff
} GdkModifierType;
typedef enum
{
  GDK_LSB_FIRST,
  GDK_MSB_FIRST
} GdkByteOrder;
typedef enum {
  GDK_SEAT_CAPABILITY_NONE          = 0,
  GDK_SEAT_CAPABILITY_POINTER       = 1 << 0,
  GDK_SEAT_CAPABILITY_TOUCH         = 1 << 1,
  GDK_SEAT_CAPABILITY_TABLET_STYLUS = 1 << 2,
  GDK_SEAT_CAPABILITY_KEYBOARD      = 1 << 3,
  GDK_SEAT_CAPABILITY_ALL_POINTING  = (GDK_SEAT_CAPABILITY_POINTER | GDK_SEAT_CAPABILITY_TOUCH | GDK_SEAT_CAPABILITY_TABLET_STYLUS),
  GDK_SEAT_CAPABILITY_ALL           = (GDK_SEAT_CAPABILITY_ALL_POINTING | GDK_SEAT_CAPABILITY_KEYBOARD)
} GdkSeatCapabilities;
typedef enum
{
  GDK_PROP_MODE_REPLACE,
  GDK_PROP_MODE_PREPEND,
  GDK_PROP_MODE_APPEND
} GdkPropMode;
typedef enum {
  GDK_SUBPIXEL_LAYOUT_UNKNOWN,
  GDK_SUBPIXEL_LAYOUT_NONE,
  GDK_SUBPIXEL_LAYOUT_HORIZONTAL_RGB,
  GDK_SUBPIXEL_LAYOUT_HORIZONTAL_BGR,
  GDK_SUBPIXEL_LAYOUT_VERTICAL_RGB,
  GDK_SUBPIXEL_LAYOUT_VERTICAL_BGR
} GdkSubpixelLayout;
typedef enum {
  GDK_FRAME_CLOCK_PHASE_NONE          = 0,
  GDK_FRAME_CLOCK_PHASE_FLUSH_EVENTS  = 1 << 0,
  GDK_FRAME_CLOCK_PHASE_BEFORE_PAINT  = 1 << 1,
  GDK_FRAME_CLOCK_PHASE_UPDATE        = 1 << 2,
  GDK_FRAME_CLOCK_PHASE_LAYOUT        = 1 << 3,
  GDK_FRAME_CLOCK_PHASE_PAINT         = 1 << 4,
  GDK_FRAME_CLOCK_PHASE_RESUME_EVENTS = 1 << 5,
  GDK_FRAME_CLOCK_PHASE_AFTER_PAINT   = 1 << 6
} GdkFrameClockPhase;
typedef enum
{
  GDK_OWNER_CHANGE_NEW_OWNER,
  GDK_OWNER_CHANGE_DESTROY,
  GDK_OWNER_CHANGE_CLOSE
} GdkOwnerChange;
typedef enum
{
  GDK_SETTING_ACTION_NEW,
  GDK_SETTING_ACTION_CHANGED,
  GDK_SETTING_ACTION_DELETED
} GdkSettingAction;
typedef enum
{
  GDK_WINDOW_STATE_WITHDRAWN        = 1 << 0,
  GDK_WINDOW_STATE_ICONIFIED        = 1 << 1,
  GDK_WINDOW_STATE_MAXIMIZED        = 1 << 2,
  GDK_WINDOW_STATE_STICKY           = 1 << 3,
  GDK_WINDOW_STATE_FULLSCREEN       = 1 << 4,
  GDK_WINDOW_STATE_ABOVE            = 1 << 5,
  GDK_WINDOW_STATE_BELOW            = 1 << 6,
  GDK_WINDOW_STATE_FOCUSED          = 1 << 7,
  GDK_WINDOW_STATE_TILED            = 1 << 8,
  GDK_WINDOW_STATE_TOP_TILED        = 1 << 9,
  GDK_WINDOW_STATE_TOP_RESIZABLE    = 1 << 10,
  GDK_WINDOW_STATE_RIGHT_TILED      = 1 << 11,
  GDK_WINDOW_STATE_RIGHT_RESIZABLE  = 1 << 12,
  GDK_WINDOW_STATE_BOTTOM_TILED     = 1 << 13,
  GDK_WINDOW_STATE_BOTTOM_RESIZABLE = 1 << 14,
  GDK_WINDOW_STATE_LEFT_TILED       = 1 << 15,
  GDK_WINDOW_STATE_LEFT_RESIZABLE   = 1 << 16
} GdkWindowState;
typedef enum
{
  GDK_PROPERTY_NEW_VALUE,
  GDK_PROPERTY_DELETE
} GdkPropertyState;
typedef enum
{
  GDK_CROSSING_NORMAL,
  GDK_CROSSING_GRAB,
  GDK_CROSSING_UNGRAB,
  GDK_CROSSING_GTK_GRAB,
  GDK_CROSSING_GTK_UNGRAB,
  GDK_CROSSING_STATE_CHANGED,
  GDK_CROSSING_TOUCH_BEGIN,
  GDK_CROSSING_TOUCH_END,
  GDK_CROSSING_DEVICE_SWITCH
} GdkCrossingMode;
typedef enum
{
  GDK_NOTIFY_ANCESTOR		= 0,
  GDK_NOTIFY_VIRTUAL		= 1,
  GDK_NOTIFY_INFERIOR		= 2,
  GDK_NOTIFY_NONLINEAR		= 3,
  GDK_NOTIFY_NONLINEAR_VIRTUAL	= 4,
  GDK_NOTIFY_UNKNOWN		= 5
} GdkNotifyType;
typedef enum
{
  GDK_SCROLL_UP,
  GDK_SCROLL_DOWN,
  GDK_SCROLL_LEFT,
  GDK_SCROLL_RIGHT,
  GDK_SCROLL_SMOOTH
} GdkScrollDirection;
typedef enum
{
  GDK_TOUCHPAD_GESTURE_PHASE_BEGIN,
  GDK_TOUCHPAD_GESTURE_PHASE_UPDATE,
  GDK_TOUCHPAD_GESTURE_PHASE_END,
  GDK_TOUCHPAD_GESTURE_PHASE_CANCEL
} GdkTouchpadGesturePhase;
typedef enum
{
  GDK_VISIBILITY_UNOBSCURED,
  GDK_VISIBILITY_PARTIAL,
  GDK_VISIBILITY_FULLY_OBSCURED
} GdkVisibilityState;
typedef enum
{
  GDK_NOTHING		= -1,
  GDK_DELETE		= 0,
  GDK_DESTROY		= 1,
  GDK_EXPOSE		= 2,
  GDK_MOTION_NOTIFY	= 3,
  GDK_BUTTON_PRESS	= 4,
  GDK_2BUTTON_PRESS	= 5,
  GDK_DOUBLE_BUTTON_PRESS = GDK_2BUTTON_PRESS,
  GDK_3BUTTON_PRESS	= 6,
  GDK_TRIPLE_BUTTON_PRESS = GDK_3BUTTON_PRESS,
  GDK_BUTTON_RELEASE	= 7,
  GDK_KEY_PRESS		= 8,
  GDK_KEY_RELEASE	= 9,
  GDK_ENTER_NOTIFY	= 10,
  GDK_LEAVE_NOTIFY	= 11,
  GDK_FOCUS_CHANGE	= 12,
  GDK_CONFIGURE		= 13,
  GDK_MAP		= 14,
  GDK_UNMAP		= 15,
  GDK_PROPERTY_NOTIFY	= 16,
  GDK_SELECTION_CLEAR	= 17,
  GDK_SELECTION_REQUEST = 18,
  GDK_SELECTION_NOTIFY	= 19,
  GDK_PROXIMITY_IN	= 20,
  GDK_PROXIMITY_OUT	= 21,
  GDK_DRAG_ENTER        = 22,
  GDK_DRAG_LEAVE        = 23,
  GDK_DRAG_MOTION       = 24,
  GDK_DRAG_STATUS       = 25,
  GDK_DROP_START        = 26,
  GDK_DROP_FINISHED     = 27,
  GDK_CLIENT_EVENT	= 28,
  GDK_VISIBILITY_NOTIFY = 29,
  GDK_SCROLL            = 31,
  GDK_WINDOW_STATE      = 32,
  GDK_SETTING           = 33,
  GDK_OWNER_CHANGE      = 34,
  GDK_GRAB_BROKEN       = 35,
  GDK_DAMAGE            = 36,
  GDK_TOUCH_BEGIN       = 37,
  GDK_TOUCH_UPDATE      = 38,
  GDK_TOUCH_END         = 39,
  GDK_TOUCH_CANCEL      = 40,
  GDK_TOUCHPAD_SWIPE    = 41,
  GDK_TOUCHPAD_PINCH    = 42,
  GDK_PAD_BUTTON_PRESS  = 43,
  GDK_PAD_BUTTON_RELEASE = 44,
  GDK_PAD_RING          = 45,
  GDK_PAD_STRIP         = 46,
  GDK_PAD_GROUP_MODE    = 47,
  GDK_EVENT_LAST        /* helper variable for decls */
} GdkEventType;
typedef enum {
  GDK_FILTER_CONTINUE,	  /* Event not handled, continue processesing */
  GDK_FILTER_TRANSLATE,	  /* Native event translated into a GDK event and
                             stored in the "event" structure that was
                             passed in */
  GDK_FILTER_REMOVE	  /* Terminate processing, removing event */
} GdkFilterReturn;
typedef enum
{
  GDK_DRAG_PROTO_NONE = 0,
  GDK_DRAG_PROTO_MOTIF,
  GDK_DRAG_PROTO_XDND,
  GDK_DRAG_PROTO_ROOTWIN,
  GDK_DRAG_PROTO_WIN32_DROPFILES,
  GDK_DRAG_PROTO_OLE2,
  GDK_DRAG_PROTO_LOCAL,
  GDK_DRAG_PROTO_WAYLAND
} GdkDragProtocol;
typedef enum {
  GDK_DRAG_CANCEL_NO_TARGET,
  GDK_DRAG_CANCEL_USER_CANCELLED,
  GDK_DRAG_CANCEL_ERROR
} GdkDragCancelReason;
typedef enum
{
  GDK_ACTION_DEFAULT = 1 << 0,
  GDK_ACTION_COPY    = 1 << 1,
  GDK_ACTION_MOVE    = 1 << 2,
  GDK_ACTION_LINK    = 1 << 3,
  GDK_ACTION_PRIVATE = 1 << 4,
  GDK_ACTION_ASK     = 1 << 5
} GdkDragAction;
typedef enum {
  GDK_DEVICE_TOOL_TYPE_UNKNOWN,
  GDK_DEVICE_TOOL_TYPE_PEN,
  GDK_DEVICE_TOOL_TYPE_ERASER,
  GDK_DEVICE_TOOL_TYPE_BRUSH,
  GDK_DEVICE_TOOL_TYPE_PENCIL,
  GDK_DEVICE_TOOL_TYPE_AIRBRUSH,
  GDK_DEVICE_TOOL_TYPE_MOUSE,
  GDK_DEVICE_TOOL_TYPE_LENS,
} GdkDeviceToolType;
typedef enum {
  GDK_DEVICE_PAD_FEATURE_BUTTON,
  GDK_DEVICE_PAD_FEATURE_RING,
  GDK_DEVICE_PAD_FEATURE_STRIP
} GdkDevicePadFeature;
typedef enum {
  GDK_DEVICE_TYPE_MASTER,
  GDK_DEVICE_TYPE_SLAVE,
  GDK_DEVICE_TYPE_FLOATING
} GdkDeviceType;
typedef enum
{
  GDK_MODE_DISABLED,
  GDK_MODE_SCREEN,
  GDK_MODE_WINDOW
} GdkInputMode;
typedef enum
{
  GDK_SOURCE_MOUSE,
  GDK_SOURCE_PEN,
  GDK_SOURCE_ERASER,
  GDK_SOURCE_CURSOR,
  GDK_SOURCE_KEYBOARD,
  GDK_SOURCE_TOUCHSCREEN,
  GDK_SOURCE_TOUCHPAD,
  GDK_SOURCE_TRACKPOINT,
  GDK_SOURCE_TABLET_PAD
} GdkInputSource;
typedef enum
{
  GDK_X_CURSOR 		  = 0,
  GDK_ARROW 		  = 2,
  GDK_BASED_ARROW_DOWN    = 4,
  GDK_BASED_ARROW_UP 	  = 6,
  GDK_BOAT 		  = 8,
  GDK_BOGOSITY 		  = 10,
  GDK_BOTTOM_LEFT_CORNER  = 12,
  GDK_BOTTOM_RIGHT_CORNER = 14,
  GDK_BOTTOM_SIDE 	  = 16,
  GDK_BOTTOM_TEE 	  = 18,
  GDK_BOX_SPIRAL 	  = 20,
  GDK_CENTER_PTR 	  = 22,
  GDK_CIRCLE 		  = 24,
  GDK_CLOCK	 	  = 26,
  GDK_COFFEE_MUG 	  = 28,
  GDK_CROSS 		  = 30,
  GDK_CROSS_REVERSE 	  = 32,
  GDK_CROSSHAIR 	  = 34,
  GDK_DIAMOND_CROSS 	  = 36,
  GDK_DOT 		  = 38,
  GDK_DOTBOX 		  = 40,
  GDK_DOUBLE_ARROW 	  = 42,
  GDK_DRAFT_LARGE 	  = 44,
  GDK_DRAFT_SMALL 	  = 46,
  GDK_DRAPED_BOX 	  = 48,
  GDK_EXCHANGE 		  = 50,
  GDK_FLEUR 		  = 52,
  GDK_GOBBLER 		  = 54,
  GDK_GUMBY 		  = 56,
  GDK_HAND1 		  = 58,
  GDK_HAND2 		  = 60,
  GDK_HEART 		  = 62,
  GDK_ICON 		  = 64,
  GDK_IRON_CROSS 	  = 66,
  GDK_LEFT_PTR 		  = 68,
  GDK_LEFT_SIDE 	  = 70,
  GDK_LEFT_TEE 		  = 72,
  GDK_LEFTBUTTON 	  = 74,
  GDK_LL_ANGLE 		  = 76,
  GDK_LR_ANGLE 	 	  = 78,
  GDK_MAN 		  = 80,
  GDK_MIDDLEBUTTON 	  = 82,
  GDK_MOUSE 		  = 84,
  GDK_PENCIL 		  = 86,
  GDK_PIRATE 		  = 88,
  GDK_PLUS 		  = 90,
  GDK_QUESTION_ARROW 	  = 92,
  GDK_RIGHT_PTR 	  = 94,
  GDK_RIGHT_SIDE 	  = 96,
  GDK_RIGHT_TEE 	  = 98,
  GDK_RIGHTBUTTON 	  = 100,
  GDK_RTL_LOGO 		  = 102,
  GDK_SAILBOAT 		  = 104,
  GDK_SB_DOWN_ARROW 	  = 106,
  GDK_SB_H_DOUBLE_ARROW   = 108,
  GDK_SB_LEFT_ARROW 	  = 110,
  GDK_SB_RIGHT_ARROW 	  = 112,
  GDK_SB_UP_ARROW 	  = 114,
  GDK_SB_V_DOUBLE_ARROW   = 116,
  GDK_SHUTTLE 		  = 118,
  GDK_SIZING 		  = 120,
  GDK_SPIDER		  = 122,
  GDK_SPRAYCAN 		  = 124,
  GDK_STAR 		  = 126,
  GDK_TARGET 		  = 128,
  GDK_TCROSS 		  = 130,
  GDK_TOP_LEFT_ARROW 	  = 132,
  GDK_TOP_LEFT_CORNER 	  = 134,
  GDK_TOP_RIGHT_CORNER 	  = 136,
  GDK_TOP_SIDE 		  = 138,
  GDK_TOP_TEE 		  = 140,
  GDK_TREK 		  = 142,
  GDK_UL_ANGLE 		  = 144,
  GDK_UMBRELLA 		  = 146,
  GDK_UR_ANGLE 		  = 148,
  GDK_WATCH 		  = 150,
  GDK_XTERM 		  = 152,
  GDK_LAST_CURSOR,
  GDK_BLANK_CURSOR        = -2,
  GDK_CURSOR_IS_PIXMAP 	  = -1
} GdkCursorType;
union _GdkEvent
{
  GdkEventType		    type;
  GdkEventAny		    any;
  GdkEventExpose	    expose;
  GdkEventVisibility	    visibility;
  GdkEventMotion	    motion;
  GdkEventButton	    button;
  GdkEventTouch             touch;
  GdkEventScroll            scroll;
  GdkEventKey		    key;
  GdkEventCrossing	    crossing;
  GdkEventFocus		    focus_change;
  GdkEventConfigure	    configure;
  GdkEventProperty	    property;
  GdkEventSelection	    selection;
  GdkEventOwnerChange  	    owner_change;
  GdkEventProximity	    proximity;
  GdkEventDND               dnd;
  GdkEventWindowState       window_state;
  GdkEventSetting           setting;
  GdkEventGrabBroken        grab_broken;
  GdkEventTouchpadSwipe     touchpad_swipe;
  GdkEventTouchpadPinch     touchpad_pinch;
  GdkEventPadButton         pad_button;
  GdkEventPadAxis           pad_axis;
  GdkEventPadGroupMode      pad_group_mode;
};

typedef void (*GdkRoundTripCallback) (GdkDisplay *display,
				       gpointer data,
				       gulong serial);
typedef void (*GdkSendXEventCallback) (Window   window,
				       gboolean success,
				       gpointer data);
typedef gboolean (*GdkWindowChildFunc) (GdkWindow *window,
                                                 gpointer   user_data);
typedef void (*GdkWindowInvalidateHandlerFunc) (GdkWindow      *window,
						 cairo_region_t *region);
typedef void (*GdkSeatGrabPrepareFunc) (GdkSeat   *seat,
                                         GdkWindow *window,
                                         gpointer   user_data);
typedef GdkFilterReturn (*GdkFilterFunc) (GdkXEvent *xevent,
					  GdkEvent *event,
					  gpointer  data);
typedef void (*GdkEventFunc) (GdkEvent *event,
			      gpointer	data);





















struct _GdkToplevelX11
{

  /* Set if the window, or any descendent of it, is the server's focus window
   */
  guint has_focus_window : 1;

  /* Set if window->has_focus_window and the focus isn't grabbed elsewhere.
   */
  guint has_focus : 1;

  /* Set if the pointer is inside this window. (This is needed for
   * for focus tracking)
   */
  guint has_pointer : 1;
  
  /* Set if the window is a descendent of the focus window and the pointer is
   * inside it. (This is the case where the window will receive keystroke
   * events even window->has_focus_window is FALSE)
   */
  guint has_pointer_focus : 1;

  /* Set if we are requesting these hints */
  guint skip_taskbar_hint : 1;
  guint skip_pager_hint : 1;
  guint urgency_hint : 1;

  guint on_all_desktops : 1;   /* <NET_WM_STICKY == 0xFFFFFFFF */

  guint have_sticky : 1;	/* <NET_WM_STATE_STICKY */
  guint have_maxvert : 1;       /* <NET_WM_STATE_MAXIMIZED_VERT */
  guint have_maxhorz : 1;       /* <NET_WM_STATE_MAXIMIZED_HORZ */
  guint have_fullscreen : 1;    /* <NET_WM_STATE_FULLSCREEN */
  guint have_hidden : 1;	/* <NET_WM_STATE_HIDDEN */

  guint is_leader : 1;

  /* Set if the WM is presenting us as focused, i.e. with active decorations
   */
  guint have_focused : 1;

  guint in_frame : 1;

  /* If we're expecting a response from the compositor after painting a frame */
  guint frame_pending : 1;

  /* Whether pending_counter_value/configure_counter_value are updates
   * to the extended update counter */
  guint pending_counter_value_is_extended : 1;
  guint configure_counter_value_is_extended : 1;

  gulong map_serial;	/* Serial of last transition from unmapped */
  
  cairo_surface_t *icon_pixmap;
  cairo_surface_t *icon_mask;
  GdkWindow *group_leader;

  /* Time of most recent user interaction. */
  gulong user_time;

  /* We use an extra X window for toplevel windows that we XSetInputFocus()
   * to in order to avoid getting keyboard events redirected to subwindows
   * that might not even be part of this app
   */
  Window focus_window;

  GdkWindowHints last_geometry_hints_mask;
  GdkGeometry last_geometry_hints;
  
  /* Constrained edge information */
  guint edge_constraints;

#ifdef HAVE_XSYNC
  XID update_counter;
  XID extended_update_counter;
  gint64 pending_counter_value; /* latest _NET_WM_SYNC_REQUEST value received */
  gint64 configure_counter_value; /* Latest _NET_WM_SYNC_REQUEST value received
				 * where we have also seen the corresponding
				 * ConfigureNotify
				 */
  gint64 current_counter_value;

  /* After a _NET_WM_FRAME_DRAWN message, this is the soonest that we think
   * frame after will be presented */
  gint64 throttled_presentation_time;
#endif
};
struct _GdkWindowImplX11Class 
{
  GdkWindowImplClass parent_class;
};
struct _GdkWindowImplX11
{
  GdkWindowImpl parent_instance;

  GdkWindow *wrapper;

  Window xid;

  GdkToplevelX11 *toplevel;	/* Toplevel-specific information */
  GdkCursor *cursor;
  GHashTable *device_cursor;

  guint no_bg : 1;        /* Set when the window background is temporarily
                           * unset during resizing and scaling */
  guint override_redirect : 1;
  guint frame_clock_connected : 1;
  guint frame_sync_enabled : 1;
  guint tracking_damage: 1;

  gint window_scale;

  /* Width and height not divided by window_scale - this matters in the
   * corner-case where the window manager assigns us a size that isn't
   * a multiple of window_scale - for example for a maximized window
   * with an odd-sized title-bar.
   */
  gint unscaled_width;
  gint unscaled_height;

  cairo_surface_t *cairo_surface;

#if defined (HAVE_XCOMPOSITE) && defined(HAVE_XDAMAGE) && defined (HAVE_XFIXES)
  Damage damage;
#endif
};
struct _GdkX11ScreenClass
{
  GdkScreenClass parent_class;

  void (* window_manager_changed) (GdkX11Screen *x11_screen);
};
struct _GdkX11Screen
{
  GdkScreen parent_instance;

  GdkDisplay *display;
  Display *xdisplay;
  Screen *xscreen;
  Window xroot_window;
  GdkWindow *root_window;
  gint screen_num;

  gint width;
  gint height;

  gint window_scale;
  gboolean fixed_window_scale;

  /* Xft resources for the display, used for default values for
   * the Xft/ XSETTINGS
   */
  gint xft_hintstyle;
  gint xft_rgba;
  gint xft_dpi;

  /* Window manager */
  long last_wmspec_check_time;
  Window wmspec_check_window;
  char *window_manager_name;

  /* X Settings */
  GdkWindow *xsettings_manager_window;
  Atom xsettings_selection_atom;
  GHashTable *xsettings; /* string of GDK settings name => GValue */

  /* TRUE if wmspec_check_window has changed since last
   * fetch of _NET_SUPPORTED
   */
  guint need_refetch_net_supported : 1;
  /* TRUE if wmspec_check_window has changed since last
   * fetch of window manager name
   */
  guint need_refetch_wm_name : 1;
  guint is_composited : 1;
  guint xft_init : 1; /* Whether we've intialized these values yet */
  guint xft_antialias : 1;
  guint xft_hinting : 1;

  /* Visual Part */
  gint nvisuals;
  GdkVisual **visuals;
  GdkVisual *system_visual;
  gint available_depths[7];
  GdkVisualType available_types[6];
  gint16 navailable_depths;
  gint16 navailable_types;
  GHashTable *visual_hash;
  GdkVisual *rgba_visual;

  /* cache for window->translate vfunc */
  GC subwindow_gcs[32];
};
struct _GdkX11MonitorClass {
  GdkMonitorClass parent_class;
};
struct _GdkX11Monitor
{
  GdkMonitor parent;

  XID output;
  guint add     : 1;
  guint remove  : 1;
};
struct _GdkX11GLContextClass
{
  GdkGLContextClass parent_class;
};
struct _GdkX11GLContext
{
  GdkGLContext parent_instance;

  GLXContext glx_context;
  GLXFBConfig glx_config;
  GLXDrawable drawable;

  guint is_attached : 1;
  guint is_direct : 1;
  guint do_frame_sync : 1;

  guint do_blit_swap : 1;
};

struct _GdkEventTranslatorIface
{
  GTypeInterface iface;

  /* VMethods */
  gboolean (* translate_event) (GdkEventTranslator *translator,
                                GdkDisplay         *display,
                                GdkEvent           *event,
                                XEvent             *xevent);

  GdkEventMask (* get_handled_events)   (GdkEventTranslator *translator);
  void         (* select_window_events) (GdkEventTranslator *translator,
                                         Window              window,
                                         GdkEventMask        event_mask);
  GdkWindow *  (* get_window)           (GdkEventTranslator *translator,
                                         XEvent             *xevent);
};

struct _GdkX11DisplayClass
{
  GdkDisplayClass parent_class;
};
struct _GdkX11Display
{
  GdkDisplay parent_instance;
  Display *xdisplay;
  GdkScreen *screen;
  GList *screens;

  GSource *event_source;

  gint grab_count;

  /* Keyboard related information */
  gint xkb_event_type;
  gboolean use_xkb;

  /* Whether we were able to turn on detectable-autorepeat using
   * XkbSetDetectableAutorepeat. If FALSE, we'll fall back
   * to checking the next event with XPending().
   */
  gboolean have_xkb_autorepeat;

  GdkKeymap *keymap;
  guint      keymap_serial;

  gboolean have_xfixes;
  gint xfixes_event_base;

  gboolean have_xcomposite;
  gboolean have_xdamage;
  gint xdamage_event_base;

  gboolean have_randr12;
  gboolean have_randr13;
  gboolean have_randr15;
  gint xrandr_event_base;

  /* If the SECURITY extension is in place, whether this client holds
   * a trusted authorization and so is allowed to make various requests
   * (grabs, properties etc.) Otherwise always TRUE.
   */
  gboolean trusted_client;

  /* drag and drop information */
  GdkDragContext *current_dest_drag;

  /* Mapping to/from virtual atoms */
  GHashTable *atom_from_virtual;
  GHashTable *atom_to_virtual;

  /* Session Management leader window see ICCCM */
  Window leader_window;
  GdkWindow *leader_gdk_window;
  gboolean leader_window_title_set;

  /* List of functions to go from extension event => X window */
  GSList *event_types;

  /* X ID hashtable */
  GHashTable *xid_ht;

  /* translation queue */
  GQueue *translate_queue;

  /* input GdkWindow list */
  GList *input_windows;

  GPtrArray *monitors;
  int primary_monitor;

  /* Startup notification */
  gchar *startup_notification_id;

  /* Time of most recent user interaction. */
  gulong user_time;

  /* Sets of atoms for DND */
  guint base_dnd_atoms_precached : 1;
  guint xdnd_atoms_precached : 1;
  guint motif_atoms_precached : 1;
  guint use_sync : 1;

  guint have_shapes : 1;
  guint have_input_shapes : 1;
  gint shape_event_base;

  /* The offscreen window that has the pointer in it (if any) */
  GdkWindow *active_offscreen_window;

  GSList *error_traps;

  gint wm_moveresize_button;

  /* GLX information */
  gint glx_version;
  gint glx_error_base;
  gint glx_event_base;

  /* Translation between X server time and system-local monotonic time */
  gint64 server_time_query_time;
  gint64 server_time_offset;

  guint server_time_is_monotonic_time : 1;

  guint have_glx : 1;

  /* GLX extensions we check */
  guint has_glx_swap_interval : 1;
  guint has_glx_create_context : 1;
  guint has_glx_texture_from_pixmap : 1;
  guint has_glx_video_sync : 1;
  guint has_glx_buffer_age : 1;
  guint has_glx_sync_control : 1;
  guint has_glx_multisample : 1;
  guint has_glx_visual_rating : 1;
  guint has_glx_create_es2_context : 1;
};
struct _GdkX11DeviceManagerCoreClass
{
  GdkDeviceManagerClass parent_class;
};
struct _GdkX11DeviceManagerCore
{
  GdkDeviceManager parent_object;
  GdkDevice *core_pointer;
  GdkDevice *core_keyboard;
};
struct _GdkChildInfoX11
{
  Window window;
  gint x;
  gint y;
  gint width;
  gint height;
  guint is_mapped : 1;
  guint has_wm_state : 1;
  guint window_class : 2;
};


#define MWM_HINTS_FUNCTIONS     (1L << 0)
#define MWM_HINTS_DECORATIONS   (1L << 1)
#define MWM_HINTS_INPUT_MODE    (1L << 2)
#define MWM_HINTS_STATUS        (1L << 3)

#define MWM_FUNC_ALL            (1L << 0)
#define MWM_FUNC_RESIZE         (1L << 1)
#define MWM_FUNC_MOVE           (1L << 2)
#define MWM_FUNC_MINIMIZE       (1L << 3)
#define MWM_FUNC_MAXIMIZE       (1L << 4)
#define MWM_FUNC_CLOSE          (1L << 5)

#define MWM_DECOR_ALL           (1L << 0)
#define MWM_DECOR_BORDER        (1L << 1)
#define MWM_DECOR_RESIZEH       (1L << 2)
#define MWM_DECOR_TITLE         (1L << 3)
#define MWM_DECOR_MENU          (1L << 4)
#define MWM_DECOR_MINIMIZE      (1L << 5)
#define MWM_DECOR_MAXIMIZE      (1L << 6)

#define MWM_INPUT_MODELESS 0
#define MWM_INPUT_PRIMARY_APPLICATION_MODAL 1
#define MWM_INPUT_SYSTEM_MODAL 2
#define MWM_INPUT_FULL_APPLICATION_MODAL 3
#define MWM_INPUT_APPLICATION_MODAL MWM_INPUT_PRIMARY_APPLICATION_MODAL

#define MWM_TEAROFF_WINDOW	(1L<<0)

/*
 * atoms
 */
#define _XA_MOTIF_BINDINGS		"_MOTIF_BINDINGS"
#define _XA_MOTIF_WM_HINTS		"_MOTIF_WM_HINTS"
#define _XA_MOTIF_WM_MESSAGES		"_MOTIF_WM_MESSAGES"
#define _XA_MOTIF_WM_OFFSET		"_MOTIF_WM_OFFSET"
#define _XA_MOTIF_WM_MENU		"_MOTIF_WM_MENU"
#define _XA_MOTIF_WM_INFO		"_MOTIF_WM_INFO"
#define _XA_MWM_HINTS			_XA_MOTIF_WM_HINTS
#define _XA_MWM_MESSAGES		_XA_MOTIF_WM_MESSAGES
#define _XA_MWM_MENU			_XA_MOTIF_WM_MENU
#define _XA_MWM_INFO			_XA_MOTIF_WM_INFO



struct _GdkMirGLContextClass
{
  GdkGLContextClass parent_class;
};
struct _GdkMirGLContext
{
  GdkGLContext parent_instance;

  EGLContext egl_context;
  EGLConfig egl_config;
  gboolean is_attached;
};
struct _GdkColor
{
  guint32 pixel;
  guint16 red;
  guint16 green;
  guint16 blue;
};
struct _GdkWindowImplClass
{
  GObjectClass parent_class;

  cairo_surface_t *
               (* ref_cairo_surface)    (GdkWindow       *window);
  cairo_surface_t *
               (* create_similar_image_surface) (GdkWindow *     window,
                                                 cairo_format_t  format,
                                                 int             width,
                                                 int             height);

  void         (* show)                 (GdkWindow       *window,
					 gboolean         already_mapped);
  void         (* hide)                 (GdkWindow       *window);
  void         (* withdraw)             (GdkWindow       *window);
  void         (* raise)                (GdkWindow       *window);
  void         (* lower)                (GdkWindow       *window);
  void         (* restack_under)        (GdkWindow       *window,
					 GList           *native_siblings);
  void         (* restack_toplevel)     (GdkWindow       *window,
					 GdkWindow       *sibling,
					 gboolean        above);

  void         (* move_resize)          (GdkWindow       *window,
                                         gboolean         with_move,
                                         gint             x,
                                         gint             y,
                                         gint             width,
                                         gint             height);
  void         (* move_to_rect)         (GdkWindow       *window,
                                         const GdkRectangle *rect,
                                         GdkGravity       rect_anchor,
                                         GdkGravity       window_anchor,
                                         GdkAnchorHints   anchor_hints,
                                         gint             rect_anchor_dx,
                                         gint             rect_anchor_dy);
  void         (* set_background)       (GdkWindow       *window,
                                         cairo_pattern_t *pattern);

  GdkEventMask (* get_events)           (GdkWindow       *window);
  void         (* set_events)           (GdkWindow       *window,
                                         GdkEventMask     event_mask);
  
  gboolean     (* reparent)             (GdkWindow       *window,
                                         GdkWindow       *new_parent,
                                         gint             x,
                                         gint             y);

  void         (* set_device_cursor)    (GdkWindow       *window,
                                         GdkDevice       *device,
                                         GdkCursor       *cursor);

  void         (* get_geometry)         (GdkWindow       *window,
                                         gint            *x,
                                         gint            *y,
                                         gint            *width,
                                         gint            *height);
  void         (* get_root_coords)      (GdkWindow       *window,
					 gint             x,
					 gint             y,
                                         gint            *root_x,
                                         gint            *root_y);
  gboolean     (* get_device_state)     (GdkWindow       *window,
                                         GdkDevice       *device,
                                         gdouble         *x,
                                         gdouble         *y,
                                         GdkModifierType *mask);
  gboolean    (* begin_paint)           (GdkWindow       *window);
  void        (* end_paint)             (GdkWindow       *window);

  cairo_region_t * (* get_shape)        (GdkWindow       *window);
  cairo_region_t * (* get_input_shape)  (GdkWindow       *window);
  void         (* shape_combine_region) (GdkWindow       *window,
                                         const cairo_region_t *shape_region,
                                         gint             offset_x,
                                         gint             offset_y);
  void         (* input_shape_combine_region) (GdkWindow       *window,
					       const cairo_region_t *shape_region,
					       gint             offset_x,
					       gint             offset_y);

  /* Called before processing updates for a window. This gives the windowing
   * layer a chance to save the region for later use in avoiding duplicate
   * exposes.
   */
  void     (* queue_antiexpose)     (GdkWindow       *window,
                                     cairo_region_t  *update_area);

/* Called to do the windowing system specific part of gdk_window_destroy(),
 *
 * window: The window being destroyed
 * recursing: If TRUE, then this is being called because a parent
 *     was destroyed. This generally means that the call to the windowing
 *     system to destroy the window can be omitted, since it will be
 *     destroyed as a result of the parent being destroyed.
 *     Unless @foreign_destroy
 * foreign_destroy: If TRUE, the window or a parent was destroyed by some
 *     external agency. The window has already been destroyed and no
 *     windowing system calls should be made. (This may never happen
 *     for some windowing systems.)
 */
  void         (* destroy)              (GdkWindow       *window,
					 gboolean         recursing,
					 gboolean         foreign_destroy);


 /* Called when gdk_window_destroy() is called on a foreign window
  * or an ancestor of the foreign window. It should generally reparent
  * the window out of it's current heirarchy, hide it, and then
  * send a message to the owner requesting that the window be destroyed.
  */
  void         (*destroy_foreign)       (GdkWindow       *window);

  /* optional */
  gboolean     (* beep)                 (GdkWindow       *window);

  void         (* focus)                (GdkWindow       *window,
					 guint32          timestamp);
  void         (* set_type_hint)        (GdkWindow       *window,
					 GdkWindowTypeHint hint);
  GdkWindowTypeHint (* get_type_hint)   (GdkWindow       *window);
  void         (* set_modal_hint)       (GdkWindow *window,
					 gboolean   modal);
  void         (* set_skip_taskbar_hint) (GdkWindow *window,
					  gboolean   skips_taskbar);
  void         (* set_skip_pager_hint)  (GdkWindow *window,
					 gboolean   skips_pager);
  void         (* set_urgency_hint)     (GdkWindow *window,
					 gboolean   urgent);
  void         (* set_geometry_hints)   (GdkWindow         *window,
					 const GdkGeometry *geometry,
					 GdkWindowHints     geom_mask);
  void         (* set_title)            (GdkWindow   *window,
					 const gchar *title);
  void         (* set_role)             (GdkWindow   *window,
					 const gchar *role);
  void         (* set_startup_id)       (GdkWindow   *window,
					 const gchar *startup_id);
  void         (* set_transient_for)    (GdkWindow *window,
					 GdkWindow *parent);
  void         (* get_frame_extents)    (GdkWindow    *window,
					 GdkRectangle *rect);
  void         (* set_override_redirect) (GdkWindow *window,
					  gboolean override_redirect);
  void         (* set_accept_focus)     (GdkWindow *window,
					 gboolean accept_focus);
  void         (* set_focus_on_map)     (GdkWindow *window,
					 gboolean focus_on_map);
  void         (* set_icon_list)        (GdkWindow *window,
					 GList     *pixbufs);
  void         (* set_icon_name)        (GdkWindow   *window,
					 const gchar *name);
  void         (* iconify)              (GdkWindow *window);
  void         (* deiconify)            (GdkWindow *window);
  void         (* stick)                (GdkWindow *window);
  void         (* unstick)              (GdkWindow *window);
  void         (* maximize)             (GdkWindow *window);
  void         (* unmaximize)           (GdkWindow *window);
  void         (* fullscreen)           (GdkWindow *window);
  void         (* fullscreen_on_monitor) (GdkWindow *window, gint monitor);
  void         (* apply_fullscreen_mode) (GdkWindow *window);
  void         (* unfullscreen)         (GdkWindow *window);
  void         (* set_keep_above)       (GdkWindow *window,
					 gboolean   setting);
  void         (* set_keep_below)       (GdkWindow *window,
					 gboolean   setting);
  GdkWindow *  (* get_group)            (GdkWindow *window);
  void         (* set_group)            (GdkWindow *window,
					 GdkWindow *leader);
  void         (* set_decorations)      (GdkWindow      *window,
					 GdkWMDecoration decorations);
  gboolean     (* get_decorations)      (GdkWindow       *window,
					 GdkWMDecoration *decorations);
  void         (* set_functions)        (GdkWindow    *window,
					 GdkWMFunction functions);
  void         (* begin_resize_drag)    (GdkWindow     *window,
                                         GdkWindowEdge  edge,
                                         GdkDevice     *device,
                                         gint           button,
                                         gint           root_x,
                                         gint           root_y,
                                         guint32        timestamp);
  void         (* begin_move_drag)      (GdkWindow *window,
                                         GdkDevice     *device,
                                         gint       button,
                                         gint       root_x,
                                         gint       root_y,
                                         guint32    timestamp);
  void         (* enable_synchronized_configure) (GdkWindow *window);
  void         (* configure_finished)   (GdkWindow *window);
  void         (* set_opacity)          (GdkWindow *window,
					 gdouble    opacity);
  void         (* set_composited)       (GdkWindow *window,
                                         gboolean   composited);
  void         (* destroy_notify)       (GdkWindow *window);
  GdkDragProtocol (* get_drag_protocol) (GdkWindow *window,
                                         GdkWindow **target);
  void         (* register_dnd)         (GdkWindow *window);
  GdkDragContext * (*drag_begin)        (GdkWindow *window,
                                         GdkDevice *device,
                                         GList     *targets,
                                         gint       x_root,
                                         gint       y_root);

  void         (*process_updates_recurse) (GdkWindow      *window,
                                           cairo_region_t *region);

  void         (*sync_rendering)          (GdkWindow      *window);
  gboolean     (*simulate_key)            (GdkWindow      *window,
                                           gint            x,
                                           gint            y,
                                           guint           keyval,
                                           GdkModifierType modifiers,
                                           GdkEventType    event_type);
  gboolean     (*simulate_button)         (GdkWindow      *window,
                                           gint            x,
                                           gint            y,
                                           guint           button,
                                           GdkModifierType modifiers,
                                           GdkEventType    event_type);

  gboolean     (*get_property)            (GdkWindow      *window,
                                           GdkAtom         property,
                                           GdkAtom         type,
                                           gulong          offset,
                                           gulong          length,
                                           gint            pdelete,
                                           GdkAtom        *actual_type,
                                           gint           *actual_format,
                                           gint           *actual_length,
                                           guchar        **data);
  void         (*change_property)         (GdkWindow      *window,
                                           GdkAtom         property,
                                           GdkAtom         type,
                                           gint            format,
                                           GdkPropMode     mode,
                                           const guchar   *data,
                                           gint            n_elements);
  void         (*delete_property)         (GdkWindow      *window,
                                           GdkAtom         property);

  gint         (* get_scale_factor)       (GdkWindow      *window);
  void         (* get_unscaled_size)      (GdkWindow      *window,
                                           int            *unscaled_width,
                                           int            *unscaled_height);

  void         (* set_opaque_region)      (GdkWindow      *window,
                                           cairo_region_t *region);
  void         (* set_shadow_width)       (GdkWindow      *window,
                                           gint            left,
                                           gint            right,
                                           gint            top,
                                           gint            bottom);
  gboolean     (* show_window_menu)       (GdkWindow      *window,
                                           GdkEvent       *event);
  GdkGLContext *(*create_gl_context)      (GdkWindow      *window,
					   gboolean        attached,
                                           GdkGLContext   *share,
                                           GError        **error);
  gboolean     (* realize_gl_context)     (GdkWindow      *window,
                                           GdkGLContext   *context,
                                           GError        **error);
  void         (*invalidate_for_new_frame)(GdkWindow      *window,
                                           cairo_region_t *update_area);

  GdkDrawingContext *(* create_draw_context)  (GdkWindow            *window,
                                               const cairo_region_t *region);
  void               (* destroy_draw_context) (GdkWindow            *window,
                                               GdkDrawingContext    *context);
};
struct _GdkWindowImpl
{
  GObject parent;
};

struct _GdkWindowClass
{
  GObjectClass      parent_class;

  GdkWindow       * (* pick_embedded_child) (GdkWindow *window,
                                             gdouble    x,
                                             gdouble    y);

  /*  the following 3 signals will only be emitted by offscreen windows */
  void              (* to_embedder)         (GdkWindow *window,
                                             gdouble    offscreen_x,
                                             gdouble    offscreen_y,
                                             gdouble   *embedder_x,
                                             gdouble   *embedder_y);
  void              (* from_embedder)       (GdkWindow *window,
                                             gdouble    embedder_x,
                                             gdouble    embedder_y,
                                             gdouble   *offscreen_x,
                                             gdouble   *offscreen_y);
  cairo_surface_t * (* create_surface)      (GdkWindow *window,
                                             gint       width,
                                             gint       height);

  /* Padding for future expansion */
  void (*_gdk_reserved1) (void);
  void (*_gdk_reserved2) (void);
  void (*_gdk_reserved3) (void);
  void (*_gdk_reserved4) (void);
  void (*_gdk_reserved5) (void);
  void (*_gdk_reserved6) (void);
  void (*_gdk_reserved7) (void);
  void (*_gdk_reserved8) (void);
};
struct _GdkGeometry
{
  gint min_width;
  gint min_height;
  gint max_width;
  gint max_height;
  gint base_width;
  gint base_height;
  gint width_inc;
  gint height_inc;
  gdouble min_aspect;
  gdouble max_aspect;
  GdkGravity win_gravity;
};
struct _GdkWindowAttr
{
  gchar *title;
  gint event_mask;
  gint x, y;
  gint width;
  gint height;
  GdkWindowWindowClass wclass;
  GdkVisual *visual;
  GdkWindowType window_type;
  GdkCursor *cursor;
  gchar *wmclass_name;
  gchar *wmclass_class;
  gboolean override_redirect;
  GdkWindowTypeHint type_hint;
};












struct _GdkPoint
{
  gint x;
  gint y;
};
struct _GdkRectangle
{
    int x, y;
    int width, height;
};
struct _GdkSeat
{
  GObject parent_instance;
};
struct _GdkRGBA
{
  gdouble red;
  gdouble green;
  gdouble blue;
  gdouble alpha;
};
struct _GdkMonitorClass {
  GObjectClass parent_class;

  void (* get_workarea) (GdkMonitor   *monitor,
                         GdkRectangle *geometry);
};
struct _GdkMonitor {
  GObject parent;

  GdkDisplay *display;
  char *manufacturer;
  char *model;
  GdkRectangle geometry;
  int width_mm;
  int height_mm;
  int scale_factor;
  int refresh_rate;
  GdkSubpixelLayout subpixel_layout;
};
struct _GdkKeymapKey
{
  guint keycode;
  gint  group;
  gint  level;
};


struct _GdkFrameClockIdleClass
{
  GdkFrameClockClass parent_class;
};
struct _GdkFrameClockIdle
{
  GdkFrameClock parent_instance;

  /*< private >*/
  GdkFrameClockIdlePrivate *priv;
};




struct _GdkEventPadGroupMode {
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  guint32 time;
  guint group;
  guint mode;
};
struct _GdkEventPadAxis {
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  guint32 time;
  guint group;
  guint index;
  guint mode;
  gdouble value;
};
struct _GdkEventPadButton {
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  guint32 time;
  guint group;
  guint button;
  guint mode;
};
struct _GdkEventTouchpadPinch {
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  gint8 phase;
  gint8 n_fingers;
  guint32 time;
  gdouble x;
  gdouble y;
  gdouble dx;
  gdouble dy;
  gdouble angle_delta;
  gdouble scale;
  gdouble x_root, y_root;
  guint state;
};
struct _GdkEventTouchpadSwipe {
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  gint8 phase;
  gint8 n_fingers;
  guint32 time;
  gdouble x;
  gdouble y;
  gdouble dx;
  gdouble dy;
  gdouble x_root, y_root;
  guint state;
};
struct _GdkEventDND {
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  GdkDragContext *context;

  guint32 time;
  gshort x_root, y_root;
};
struct _GdkEventGrabBroken {
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  gboolean keyboard;
  gboolean implicit;
  GdkWindow *grab_window;
};
struct _GdkEventWindowState
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  GdkWindowState changed_mask;
  GdkWindowState new_window_state;
};
struct _GdkEventSetting
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  GdkSettingAction action;
  char *name;
};
struct _GdkEventProximity
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  guint32 time;
  GdkDevice *device;
};
struct _GdkEventOwnerChange
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  GdkWindow *owner;
  GdkOwnerChange reason;
  GdkAtom selection;
  guint32 time;
  guint32 selection_time;
};
struct _GdkEventSelection
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  GdkAtom selection;
  GdkAtom target;
  GdkAtom property;
  guint32 time;
  GdkWindow *requestor;
};
struct _GdkEventProperty
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  GdkAtom atom;
  guint32 time;
  guint state;
};
struct _GdkEventConfigure
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  gint x, y;
  gint width;
  gint height;
};
struct _GdkEventFocus
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  gint16 in;
};
struct _GdkEventCrossing
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  GdkWindow *subwindow;
  guint32 time;
  gdouble x;
  gdouble y;
  gdouble x_root;
  gdouble y_root;
  GdkCrossingMode mode;
  GdkNotifyType detail;
  gboolean focus;
  guint state;
};
struct _GdkEventKey
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  guint32 time;
  guint state;
  guint keyval;
  gint length;
  gchar *string;
  guint16 hardware_keycode;
  guint8 group;
  guint is_modifier : 1;
};
struct _GdkEventScroll
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  guint32 time;
  gdouble x;
  gdouble y;
  guint state;
  GdkScrollDirection direction;
  GdkDevice *device;
  gdouble x_root, y_root;
  gdouble delta_x;
  gdouble delta_y;
  guint is_stop : 1;
};
struct _GdkEventTouch
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  guint32 time;
  gdouble x;
  gdouble y;
  gdouble *axes;
  guint state;
  GdkEventSequence *sequence;
  gboolean emulating_pointer;
  GdkDevice *device;
  gdouble x_root, y_root;
};
struct _GdkEventButton
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  guint32 time;
  gdouble x;
  gdouble y;
  gdouble *axes;
  guint state;
  guint button;
  GdkDevice *device;
  gdouble x_root, y_root;
};
struct _GdkEventMotion
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  guint32 time;
  gdouble x;
  gdouble y;
  gdouble *axes;
  guint state;
  gint16 is_hint;
  GdkDevice *device;
  gdouble x_root, y_root;
};
struct _GdkEventVisibility
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  GdkVisibilityState state;
};
struct _GdkEventExpose
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
  GdkRectangle area;
  cairo_region_t *region;
  gint count; /* If non-zero, how many more events follow. */
};
struct _GdkEventAny
{
  GdkEventType type;
  GdkWindow *window;
  gint8 send_event;
};
struct _GdkDrawingContextClass
{
  GObjectClass parent_instance;
};
struct _GdkDrawingContext
{
  GObject parent_instance;

  GdkWindow *window;

  cairo_region_t *clip;
  cairo_t *cr;
};
struct _GdkDeviceToolClass
{
  GObjectClass parent_class;
};
struct _GdkDeviceTool
{
  GObject parent_instance;
  guint64 serial;
  guint64 hw_id;
  GdkDeviceToolType type;
  GdkAxisFlags tool_axes;
};
struct _GdkDevicePadInterface {
  GTypeInterface parent_interface;

  gint (* get_n_groups)      (GdkDevicePad        *pad);

  gint (* get_group_n_modes) (GdkDevicePad        *pad,
                              gint                 group);
  gint (* get_n_features)    (GdkDevicePad        *pad,
                              GdkDevicePadFeature  feature);
  gint (* get_feature_group) (GdkDevicePad        *pad,
                              GdkDevicePadFeature  feature,
                              gint                 idx);
};

struct _GdkTimeCoord
{
  guint32 time;
  gdouble axes[GDK_MAX_TIMECOORD_AXES];
};
GdkWindow   * gdk_x11_window_lookup_for_display(GdkDisplay *display, Window      window);
GdkWindow   * gdk_x11_window_foreign_new_for_display(GdkDisplay *display, Window      window);
guint32 gdk_x11_get_server_time(GdkWindow       *window);
void gdk_x11_window_set_frame_sync_enabled(GdkWindow *window, gboolean   frame_sync_enabled);
void gdk_x11_window_move_to_desktop(GdkWindow   *window, guint32      desktop);
guint32 gdk_x11_window_get_desktop(GdkWindow   *window);
void gdk_x11_window_move_to_current_desktop(GdkWindow   *window);
void gdk_x11_window_set_hide_titlebar_when_maximized(GdkWindow *window, gboolean   hide_titlebar_when_maximized);
void gdk_x11_window_set_frame_extents(GdkWindow *window, int        left, int        right, int        top, int        bottom);
void gdk_x11_window_set_theme_variant(GdkWindow   *window, char        *variant);
void gdk_x11_window_set_utf8_property(GdkWindow *window, const gchar *name, const gchar *value);
void gdk_x11_window_set_user_time(GdkWindow   *window, guint32      timestamp);
Window gdk_x11_window_get_xid(GdkWindow   *window);
GType gdk_x11_window_get_type(void);
GdkVisual * gdk_x11_screen_lookup_visual(GdkScreen *screen, VisualID   xvisualid);
Visual  * gdk_x11_visual_get_xvisual(GdkVisual   *visual);
GType gdk_x11_visual_get_type(void);
void gdk_x11_ungrab_server(void);
void gdk_x11_grab_server(void);
Display  * gdk_x11_get_default_xdisplay(void);
Window gdk_x11_get_default_root_xwindow(void);
void gdk_x11_free_compound_text(guchar       *ctext);
gboolean gdk_x11_display_utf8_to_compound_text(GdkDisplay   *display, const gchar  *str, GdkAtom      *encoding, gint         *format, guchar      **ctext, gint         *length);
gint gdk_x11_display_string_to_compound_text(GdkDisplay   *display, const gchar  *str, GdkAtom      *encoding, gint         *format, guchar      **ctext, gint         *length);
void gdk_x11_free_text_list(gchar       **list);
gint gdk_x11_display_text_property_to_text_list(GdkDisplay   *display, GdkAtom       encoding, gint          format, const guchar *text, gint          length, gchar      ***list);
guint32 gdk_x11_screen_get_current_desktop(GdkScreen *screen);
guint32 gdk_x11_screen_get_number_of_desktops(GdkScreen *screen);
XID gdk_x11_screen_get_monitor_output(GdkScreen *screen, gint       monitor_num);
gboolean gdk_x11_screen_supports_net_wm_hint(GdkScreen *screen, GdkAtom    property);
gint gdk_x11_get_default_screen(void);
const char * gdk_x11_screen_get_window_manager_name(GdkScreen *screen);
int gdk_x11_screen_get_screen_number(GdkScreen   *screen);
Screen  * gdk_x11_screen_get_xscreen(GdkScreen   *screen);
GType gdk_x11_screen_get_type(void);
const gchar  * gdk_x11_get_xatom_name(Atom         xatom);
Atom gdk_x11_get_xatom_by_name(const gchar *atom_name);
GdkAtom gdk_x11_xatom_to_atom(Atom         xatom);
Atom gdk_x11_atom_to_xatom(GdkAtom      atom);
const gchar  * gdk_x11_get_xatom_name_for_display(GdkDisplay  *display, Atom         xatom);
Atom gdk_x11_get_xatom_by_name_for_display(GdkDisplay  *display, const gchar *atom_name);
GdkAtom gdk_x11_xatom_to_atom_for_display(GdkDisplay  *display, Atom         xatom);
Atom gdk_x11_atom_to_xatom_for_display(GdkDisplay  *display, GdkAtom      atom);
XID gdk_x11_monitor_get_output(GdkMonitor *monitor);
GType gdk_x11_monitor_get_type(void);
gboolean gdk_x11_keymap_key_is_modifier(GdkKeymap *keymap, guint      keycode);
gint gdk_x11_keymap_get_group_for_state(GdkKeymap *keymap, guint      state);
GType gdk_x11_keymap_get_type(void);
gboolean gdk_x11_display_get_glx_version(GdkDisplay *display, gint       *major, gint       *minor);
GType gdk_x11_gl_context_get_type(void);
GType gdk_x11_drag_context_get_type(void);
GType gdk_x11_display_manager_get_type(void);
void gdk_x11_set_sm_client_id(const gchar *sm_client_id);
void gdk_x11_register_standard_event_type(GdkDisplay *display, gint        event_base, gint        n_events);
void gdk_x11_display_error_trap_pop_ignored(GdkDisplay *display);
gint gdk_x11_display_error_trap_pop(GdkDisplay *display);
void gdk_x11_display_error_trap_push(GdkDisplay *display);
void gdk_x11_display_set_window_scale(GdkDisplay *display, gint scale);
void gdk_x11_display_ungrab(GdkDisplay *display);
void gdk_x11_display_grab(GdkDisplay *display);
GdkDisplay    * gdk_x11_lookup_xdisplay(Display *xdisplay);
void gdk_x11_display_broadcast_startup_message(GdkDisplay *display, const char *message_type, ...);
void gdk_x11_display_set_cursor_theme(GdkDisplay  *display, const gchar *theme, const gint   size);
void gdk_x11_display_set_startup_notification_id(GdkDisplay  *display, const gchar *startup_id);
const gchar  * gdk_x11_display_get_startup_notification_id(GdkDisplay *display);
guint32 gdk_x11_display_get_user_time(GdkDisplay *display);
Display  * gdk_x11_display_get_xdisplay(GdkDisplay  *display);
GType gdk_x11_display_get_type(void);
GdkDevice  * gdk_x11_device_manager_lookup(GdkDeviceManager *device_manager, gint              device_id);
GType gdk_x11_device_manager_xi2_get_type(void);
GType gdk_x11_device_manager_xi_get_type(void);
GType gdk_x11_device_manager_core_get_type(void);
gint gdk_x11_device_get_id(GdkDevice *device);
GType gdk_x11_device_xi2_get_type(void);
GType gdk_x11_device_core_get_type(void);
Cursor gdk_x11_cursor_get_xcursor(GdkCursor   *cursor);
Display  * gdk_x11_cursor_get_xdisplay(GdkCursor   *cursor);
GType gdk_x11_cursor_get_type(void);
GType gdk_x11_app_launch_context_get_type(void);
void gdk_x11_window_set_frame_sync_enabled(GdkWindow *window, gboolean   frame_sync_enabled);
void gdk_x11_window_set_user_time(GdkWindow *window, guint32    timestamp);
GType gdk_window_impl_x11_get_type(void);
gint gdk_x11_screen_get_number(GdkScreen *screen);
gint gdk_x11_screen_get_height(GdkScreen *screen);
gint gdk_x11_screen_get_width(GdkScreen *screen);
void gdk_x11_screen_get_work_area(GdkScreen    *screen, GdkRectangle *area);
void gdk_x11_device_xi2_store_axes(GdkX11DeviceXI2 *device, gdouble         *axes, gint             n_axes);
gdouble gdk_x11_device_xi2_get_last_axis_value(GdkX11DeviceXI2 *device, gint             n_axis);
gboolean gdk_x11_display_make_gl_context_current(GdkDisplay        *display, GdkGLContext      *context);
void gdk_x11_window_invalidate_for_new_frame(GdkWindow         *window, cairo_region_t    *update_area);
GdkGLContext  * gdk_x11_window_create_gl_context(GdkWindow         *window, gboolean           attached, GdkGLContext      *share, GError           **error);
gboolean gdk_x11_screen_init_gl(GdkScreen         *screen);
void gdk_x11_event_source_select_events(GdkEventSource *source, Window          window, GdkEventMask    event_mask, unsigned int    extra_x_mask);
void gdk_x11_event_source_add_translator(GdkEventSource  *source, GdkEventTranslator *translator);
GSource  * gdk_x11_event_source_new(GdkDisplay *display);
GType gdk_mir_gl_context_get_type(void);
MirSurface  * gdk_mir_window_get_mir_surface(GdkWindow *window);
GType gdk_mir_window_get_type(void);
MirConnection  * gdk_mir_display_get_mir_connection(GdkDisplay *display);
GType gdk_mir_display_get_type(void);
GType gdk_mir_window_impl_get_type(void);
gchar  * gdk_color_to_string(const GdkColor *color);
gboolean gdk_color_parse(const gchar    *spec, GdkColor       *color);
gboolean gdk_color_equal(const GdkColor *colora, const GdkColor *colorb);
guint gdk_color_hash(const GdkColor *color);
void gdk_color_free(GdkColor       *color);
GdkColor  * gdk_color_copy(const GdkColor *color);
GType gdk_color_get_type(void);
GType gdk_window_impl_get_type(void);
GdkGLContext  * gdk_window_create_gl_context(GdkWindow      *window, GError        **error);
gboolean gdk_window_show_window_menu(GdkWindow      *window, GdkEvent       *event);
void gdk_window_set_shadow_width(GdkWindow      *window, gint            left, gint            right, gint            top, gint            bottom);
gboolean gdk_window_get_event_compression(GdkWindow      *window);
void gdk_window_set_event_compression(GdkWindow      *window, gboolean        event_compression);
void gdk_window_set_opaque_region(GdkWindow      *window, cairo_region_t *region);
GdkFrameClock * gdk_window_get_frame_clock(GdkWindow     *window);
gboolean gdk_window_get_support_multidevice(GdkWindow *window);
void gdk_window_set_support_multidevice(GdkWindow *window, gboolean   support_multidevice);
void gdk_window_geometry_changed(GdkWindow     *window);
GdkWindow  * gdk_offscreen_window_get_embedder(GdkWindow     *window);
void gdk_offscreen_window_set_embedder(GdkWindow     *window, GdkWindow     *embedder);
cairo_surface_t  * gdk_offscreen_window_get_surface(GdkWindow     *window);
GdkWindow  * gdk_get_default_root_window(void);
void gdk_window_configure_finished(GdkWindow *window);
void gdk_window_enable_synchronized_configure(GdkWindow *window);
void gdk_window_constrain_size(GdkGeometry    *geometry, GdkWindowHints  flags, gint            width, gint            height, gint           *new_width, gint           *new_height);
void gdk_window_set_debug_updates(gboolean      setting);
void gdk_window_process_updates(GdkWindow    *window, gboolean      update_children);
void gdk_window_process_all_updates(void);
void gdk_window_thaw_toplevel_updates_libgtk_only(GdkWindow *window);
void gdk_window_freeze_toplevel_updates_libgtk_only(GdkWindow *window);
void gdk_window_thaw_updates(GdkWindow    *window);
void gdk_window_freeze_updates(GdkWindow    *window);
cairo_region_t  * gdk_window_get_update_area(GdkWindow            *window);
void gdk_window_invalidate_maybe_recurse(GdkWindow            *window, const cairo_region_t *region, GdkWindowChildFunc    child_func, gpointer              user_data);
void gdk_window_invalidate_region(GdkWindow          *window, const cairo_region_t    *region, gboolean            invalidate_children);
void gdk_window_invalidate_rect(GdkWindow          *window, const GdkRectangle *rect, gboolean            invalidate_children);
void gdk_window_begin_move_drag_for_device(GdkWindow     *window, GdkDevice     *device, gint           button, gint           root_x, gint           root_y, guint32        timestamp);
void gdk_window_begin_move_drag(GdkWindow     *window, gint           button, gint           root_x, gint           root_y, guint32        timestamp);
void gdk_window_begin_resize_drag_for_device(GdkWindow     *window, GdkWindowEdge  edge, GdkDevice     *device, gint           button, gint           root_x, gint           root_y, guint32        timestamp);
void gdk_window_begin_resize_drag(GdkWindow     *window, GdkWindowEdge  edge, gint           button, gint           root_x, gint           root_y, guint32        timestamp);
GdkDragProtocol gdk_window_get_drag_protocol(GdkWindow      *window, GdkWindow     **target);
void gdk_window_register_dnd(GdkWindow       *window);
void gdk_window_set_opacity(GdkWindow       *window, gdouble          opacity);
void gdk_window_set_keep_below(GdkWindow       *window, gboolean         setting);
void gdk_window_set_keep_above(GdkWindow       *window, gboolean         setting);
void gdk_window_unfullscreen(GdkWindow       *window);
GdkFullscreenMode gdk_window_get_fullscreen_mode(GdkWindow   *window);
void gdk_window_set_fullscreen_mode(GdkWindow   *window, GdkFullscreenMode mode);
void gdk_window_fullscreen_on_monitor(GdkWindow      *window, gint            monitor);
void gdk_window_fullscreen(GdkWindow       *window);
void gdk_window_unmaximize(GdkWindow       *window);
void gdk_window_maximize(GdkWindow       *window);
void gdk_window_unstick(GdkWindow       *window);
void gdk_window_stick(GdkWindow       *window);
void gdk_window_deiconify(GdkWindow       *window);
void gdk_window_iconify(GdkWindow       *window);
void gdk_window_beep(GdkWindow       *window);
cairo_surface_t  * gdk_window_create_similar_image_surface(GdkWindow *window, cairo_format_t format, int            width, int            height, int            scale);
cairo_surface_t  * gdk_window_create_similar_surface(GdkWindow *window, cairo_content_t  content, int              width, int              height);
void gdk_window_set_functions(GdkWindow	  *window, GdkWMFunction	   functions);
gboolean gdk_window_get_decorations(GdkWindow       *window, GdkWMDecoration *decorations);
void gdk_window_set_decorations(GdkWindow	  *window, GdkWMDecoration  decorations);
GdkWindow * gdk_window_get_group(GdkWindow	  *window);
void gdk_window_set_group(GdkWindow	  *window, GdkWindow	  *leader);
void gdk_window_set_icon_name(GdkWindow	  *window, const gchar	  *name);
void gdk_window_set_icon_list(GdkWindow       *window, GList           *pixbufs);
GdkEventMask gdk_window_get_source_events(GdkWindow      *window, GdkInputSource  source);
void gdk_window_set_source_events(GdkWindow      *window, GdkInputSource  source, GdkEventMask    event_mask);
GdkEventMask gdk_window_get_device_events(GdkWindow    *window, GdkDevice    *device);
void gdk_window_set_device_events(GdkWindow    *window, GdkDevice    *device, GdkEventMask  event_mask);
void gdk_window_set_events(GdkWindow	  *window, GdkEventMask	   event_mask);
GdkEventMask gdk_window_get_events(GdkWindow	  *window);
GList  * gdk_window_get_children_with_user_data(GdkWindow *window, gpointer   user_data);
GList  * gdk_window_peek_children(GdkWindow       *window);
GList  * gdk_window_get_children(GdkWindow	  *window);
GdkWindow  * gdk_window_get_effective_toplevel(GdkWindow *window);
GdkWindow  * gdk_window_get_effective_parent(GdkWindow *window);
GdkWindow  * gdk_window_get_toplevel(GdkWindow       *window);
GdkWindow  * gdk_window_get_parent(GdkWindow       *window);
GdkWindow  * gdk_window_get_device_position_double(GdkWindow       *window, GdkDevice       *device, gdouble         *x, gdouble         *y, GdkModifierType *mask);
GdkWindow  * gdk_window_get_device_position(GdkWindow       *window, GdkDevice       *device, gint            *x, gint            *y, GdkModifierType *mask);
GdkWindow  * gdk_window_get_pointer(GdkWindow       *window, gint            *x, gint            *y, GdkModifierType *mask);
gint gdk_window_get_scale_factor(GdkWindow     *window);
void gdk_window_get_frame_extents(GdkWindow     *window, GdkRectangle  *rect);
void gdk_window_get_root_origin(GdkWindow	  *window, gint		  *x, gint		  *y);
void gdk_window_coords_from_parent(GdkWindow       *window, gdouble          parent_x, gdouble          parent_y, gdouble         *x, gdouble         *y);
void gdk_window_coords_to_parent(GdkWindow       *window, gdouble          x, gdouble          y, gdouble         *parent_x, gdouble         *parent_y);
void gdk_window_get_root_coords(GdkWindow	  *window, gint             x, gint             y, gint		  *root_x, gint		  *root_y);
gint gdk_window_get_origin(GdkWindow	  *window, gint		  *x, gint		  *y);
void gdk_window_get_position(GdkWindow	  *window, gint		  *x, gint		  *y);
int gdk_window_get_height(GdkWindow       *window);
int gdk_window_get_width(GdkWindow       *window);
void gdk_window_get_geometry(GdkWindow	  *window, gint		  *x, gint		  *y, gint		  *width, gint		  *height);
void gdk_window_get_user_data(GdkWindow	  *window, gpointer	  *data);
GdkCursor     * gdk_window_get_device_cursor(GdkWindow     *window, GdkDevice     *device);
void gdk_window_set_device_cursor(GdkWindow	  *window, GdkDevice     *device, GdkCursor	  *cursor);
GdkCursor     * gdk_window_get_cursor(GdkWindow       *window);
void gdk_window_set_cursor(GdkWindow	  *window, GdkCursor	  *cursor);
cairo_pattern_t  * gdk_window_get_background_pattern(GdkWindow     *window);
void gdk_window_set_background_pattern(GdkWindow	 *window, cairo_pattern_t *pattern);
void gdk_window_set_background_rgba(GdkWindow     *window, const GdkRGBA *rgba);
void gdk_window_set_background(GdkWindow	  *window, const GdkColor  *color);
void gdk_window_set_transient_for(GdkWindow     *window, GdkWindow     *parent);
void gdk_window_set_startup_id(GdkWindow     *window, const gchar   *startup_id);
void gdk_window_set_role(GdkWindow     *window, const gchar   *role);
void gdk_window_set_title(GdkWindow	  *window, const gchar	  *title);
void gdk_window_flush(GdkWindow          *window);
void gdk_window_end_draw_frame(GdkWindow            *window, GdkDrawingContext    *context);
GdkDrawingContext  * gdk_window_begin_draw_frame(GdkWindow            *window, const cairo_region_t *region);
void gdk_window_end_paint(GdkWindow          *window);
void gdk_window_begin_paint_region(GdkWindow          *window, const cairo_region_t    *region);
void gdk_window_mark_paint_from_clip(GdkWindow          *window, cairo_t            *cr);
void gdk_window_begin_paint_rect(GdkWindow          *window, const GdkRectangle *rectangle);
cairo_region_t  * gdk_window_get_visible_region(GdkWindow         *window);
cairo_region_t  * gdk_window_get_clip_region(GdkWindow          *window);
void gdk_window_set_geometry_hints(GdkWindow          *window, const GdkGeometry  *geometry, GdkWindowHints      geom_mask);
void gdk_window_set_urgency_hint(GdkWindow *window, gboolean   urgent);
void gdk_window_set_skip_pager_hint(GdkWindow *window, gboolean   skips_pager);
void gdk_window_set_skip_taskbar_hint(GdkWindow *window, gboolean   skips_taskbar);
void gdk_window_set_modal_hint(GdkWindow       *window, gboolean         modal);
gboolean gdk_window_get_modal_hint(GdkWindow       *window);
GdkWindowTypeHint gdk_window_get_type_hint(GdkWindow        *window);
void gdk_window_set_type_hint(GdkWindow        *window, GdkWindowTypeHint hint);
gboolean gdk_window_has_native(GdkWindow       *window);
void gdk_window_set_invalidate_handler(GdkWindow                      *window, GdkWindowInvalidateHandlerFunc  handler);
gboolean gdk_window_set_static_gravities(GdkWindow *window, gboolean   use_static);
GdkWindowState gdk_window_get_state(GdkWindow *window);
gboolean gdk_window_is_shaped(GdkWindow *window);
gboolean gdk_window_is_input_only(GdkWindow *window);
gboolean gdk_window_is_viewable(GdkWindow *window);
gboolean gdk_window_is_visible(GdkWindow *window);
gboolean gdk_window_get_pass_through(GdkWindow *window);
void gdk_window_set_pass_through(GdkWindow *window, gboolean   pass_through);
void gdk_window_merge_child_input_shapes(GdkWindow       *window);
void gdk_window_set_child_input_shapes(GdkWindow       *window);
void gdk_window_input_shape_combine_region(GdkWindow       *window, const cairo_region_t *shape_region, gint             offset_x, gint             offset_y);
void gdk_window_merge_child_shapes(GdkWindow       *window);
void gdk_window_set_composited(GdkWindow *window, gboolean   composited);
gboolean gdk_window_get_composited(GdkWindow *window);
void gdk_window_set_child_shapes(GdkWindow *window);
void gdk_window_shape_combine_region(GdkWindow	      *window, const cairo_region_t *shape_region, gint	       offset_x, gint	       offset_y);
gboolean gdk_window_ensure_native(GdkWindow       *window);
void gdk_window_move_region(GdkWindow       *window, const cairo_region_t *region, gint             dx, gint             dy);
void gdk_window_scroll(GdkWindow     *window, gint           dx, gint           dy);
void gdk_window_remove_filter(GdkWindow     *window, GdkFilterFunc  function, gpointer       data);
void gdk_window_add_filter(GdkWindow     *window, GdkFilterFunc  function, gpointer       data);
void gdk_window_set_focus_on_map(GdkWindow     *window, gboolean       focus_on_map);
gboolean gdk_window_get_focus_on_map(GdkWindow     *window);
void gdk_window_set_accept_focus(GdkWindow     *window, gboolean       accept_focus);
gboolean gdk_window_get_accept_focus(GdkWindow     *window);
void gdk_window_set_override_redirect(GdkWindow     *window, gboolean       override_redirect);
void gdk_window_set_user_data(GdkWindow     *window, gpointer       user_data);
void gdk_window_focus(GdkWindow     *window, guint32        timestamp);
void gdk_window_restack(GdkWindow     *window, GdkWindow     *sibling, gboolean       above);
void gdk_window_lower(GdkWindow     *window);
void gdk_window_raise(GdkWindow     *window);
void gdk_window_reparent(GdkWindow     *window, GdkWindow     *new_parent, gint           x, gint           y);
void gdk_window_move_resize(GdkWindow     *window, gint           x, gint           y, gint           width, gint           height);
void gdk_window_resize(GdkWindow     *window, gint           width, gint           height);
void gdk_window_move(GdkWindow     *window, gint           x, gint           y);
void gdk_window_show_unraised(GdkWindow     *window);
void gdk_window_withdraw(GdkWindow     *window);
void gdk_window_hide(GdkWindow     *window);
void gdk_window_show(GdkWindow     *window);
GdkWindow * gdk_window_at_pointer(gint          *win_x, gint          *win_y);
GdkDisplay  * gdk_window_get_display(GdkWindow     *window);
GdkScreen  * gdk_window_get_screen(GdkWindow     *window);
GdkVisual  * gdk_window_get_visual(GdkWindow     *window);
gboolean gdk_window_is_destroyed(GdkWindow     *window);
GdkWindowType gdk_window_get_window_type(GdkWindow     *window);
void gdk_window_destroy(GdkWindow     *window);
GdkWindow * gdk_window_new(GdkWindow     *parent, GdkWindowAttr *attributes, gint           attributes_mask);
GType gdk_window_get_type(void);
void gdk_visual_get_blue_pixel_details(GdkVisual *visual, guint32   *mask, gint      *shift, gint      *precision);
void gdk_visual_get_green_pixel_details(GdkVisual *visual, guint32   *mask, gint      *shift, gint      *precision);
void gdk_visual_get_red_pixel_details(GdkVisual *visual, guint32   *mask, gint      *shift, gint      *precision);
gint gdk_visual_get_bits_per_rgb(GdkVisual *visual);
gint gdk_visual_get_colormap_size(GdkVisual *visual);
GdkByteOrder gdk_visual_get_byte_order(GdkVisual *visual);
gint gdk_visual_get_depth(GdkVisual *visual);
GdkVisualType gdk_visual_get_visual_type(GdkVisual *visual);
GdkScreen     * gdk_visual_get_screen(GdkVisual *visual);
GList * gdk_list_visuals(void);
void gdk_query_visual_types(GdkVisualType  **visual_types, gint            *count);
void gdk_query_depths(gint           **depths, gint            *count);
GdkVisual * gdk_visual_get_best_with_both(gint           depth, GdkVisualType  visual_type);
GdkVisual * gdk_visual_get_best_with_type(GdkVisualType  visual_type);
GdkVisual * gdk_visual_get_best_with_depth(gint           depth);
GdkVisual * gdk_visual_get_best(void);
GdkVisual * gdk_visual_get_system(void);
GdkVisualType gdk_visual_get_best_type(void);
gint gdk_visual_get_best_depth(void);
GType gdk_visual_get_type(void);
guint gdk_threads_add_timeout_seconds(guint          interval, GSourceFunc    function, gpointer       data);
guint gdk_threads_add_timeout_seconds_full(gint           priority, guint          interval, GSourceFunc    function, gpointer       data, GDestroyNotify notify);
guint gdk_threads_add_timeout(guint          interval, GSourceFunc    function, gpointer       data);
guint gdk_threads_add_timeout_full(gint           priority, guint          interval, GSourceFunc    function, gpointer       data, GDestroyNotify notify);
guint gdk_threads_add_idle(GSourceFunc    function, gpointer       data);
guint gdk_threads_add_idle_full(gint           priority, GSourceFunc    function, gpointer       data, GDestroyNotify notify);
void gdk_threads_set_lock_functions(GCallback enter_fn, GCallback leave_fn);
void gdk_threads_leave(void);
void gdk_threads_enter(void);
void gdk_threads_init(void);
gboolean gdk_test_simulate_button(GdkWindow      *window, gint            x, gint            y, guint           button, GdkModifierType modifiers, GdkEventType    button_pressrelease);
gboolean gdk_test_simulate_key(GdkWindow      *window, gint            x, gint            y, guint           keyval, GdkModifierType modifiers, GdkEventType    key_pressrelease);
void gdk_test_render_sync(GdkWindow      *window);
void gdk_selection_send_notify_for_display(GdkDisplay      *display, GdkWindow       *requestor, GdkAtom     	   selection, GdkAtom     	   target, GdkAtom     	   property, guint32     	   time_);
void gdk_selection_send_notify(GdkWindow      *requestor, GdkAtom	      selection, GdkAtom	      target, GdkAtom	      property, guint32	      time_);
gint gdk_selection_property_get(GdkWindow  *requestor, guchar	 **data, GdkAtom	  *prop_type, gint	  *prop_format);
void gdk_selection_convert(GdkWindow	 *requestor, GdkAtom	  selection, GdkAtom	  target, guint32	  time_);
GdkWindow  * gdk_selection_owner_get_for_display(GdkDisplay *display, GdkAtom     selection);
gboolean gdk_selection_owner_set_for_display(GdkDisplay *display, GdkWindow  *owner, GdkAtom     selection, guint32     time_, gboolean    send_event);
GdkWindow * gdk_selection_owner_get(GdkAtom	  selection);
gboolean gdk_selection_owner_set(GdkWindow	 *owner, GdkAtom	  selection, guint32	  time_, gboolean      send_event);
GdkDevice  * gdk_seat_get_keyboard(GdkSeat             *seat);
GdkDevice  * gdk_seat_get_pointer(GdkSeat             *seat);
GList  * gdk_seat_get_slaves(GdkSeat             *seat, GdkSeatCapabilities  capabilities);
GdkSeatCapabilities gdk_seat_get_capabilities(GdkSeat             *seat);
GdkDisplay  * gdk_seat_get_display(GdkSeat             *seat);
void gdk_seat_ungrab(GdkSeat                *seat);
GdkGrabStatus gdk_seat_grab(GdkSeat                *seat, GdkWindow              *window, GdkSeatCapabilities     capabilities, gboolean                owner_events, GdkCursor              *cursor, const GdkEvent         *event, GdkSeatGrabPrepareFunc  prepare_func, gpointer                prepare_func_data);
GType gdk_seat_get_type(void);
GList      * gdk_screen_get_window_stack(GdkScreen *screen);
GdkWindow  * gdk_screen_get_active_window(GdkScreen *screen);
gdouble gdk_screen_get_resolution(GdkScreen *screen);
void gdk_screen_set_resolution(GdkScreen *screen, gdouble    dpi);
const cairo_font_options_t  * gdk_screen_get_font_options(GdkScreen                  *screen);
void gdk_screen_set_font_options(GdkScreen                  *screen, const cairo_font_options_t *options);
gboolean gdk_screen_get_setting(GdkScreen   *screen, const gchar *name, GValue      *value);
GdkScreen  * gdk_screen_get_default(void);
gint gdk_screen_get_monitor_scale_factor(GdkScreen *screen, gint       monitor_num);
gchar  * gdk_screen_get_monitor_plug_name(GdkScreen *screen, gint       monitor_num);
gint gdk_screen_get_monitor_height_mm(GdkScreen *screen, gint       monitor_num);
gint gdk_screen_get_monitor_width_mm(GdkScreen *screen, gint       monitor_num);
gint gdk_screen_get_monitor_at_window(GdkScreen *screen, GdkWindow *window);
gint gdk_screen_get_monitor_at_point(GdkScreen *screen, gint       x, gint       y);
void gdk_screen_get_monitor_workarea(GdkScreen    *screen, gint          monitor_num, GdkRectangle *dest);
void gdk_screen_get_monitor_geometry(GdkScreen    *screen, gint          monitor_num, GdkRectangle *dest);
gint gdk_screen_get_primary_monitor(GdkScreen    *screen);
gint gdk_screen_get_n_monitors(GdkScreen    *screen);
gchar  * gdk_screen_make_display_name(GdkScreen   *screen);
GList  * gdk_screen_get_toplevel_windows(GdkScreen   *screen);
GList  * gdk_screen_list_visuals(GdkScreen   *screen);
gint gdk_screen_get_height_mm(GdkScreen   *screen);
gint gdk_screen_get_width_mm(GdkScreen   *screen);
gint gdk_screen_get_height(GdkScreen   *screen);
gint gdk_screen_get_width(GdkScreen   *screen);
gint gdk_screen_get_number(GdkScreen   *screen);
GdkDisplay  * gdk_screen_get_display(GdkScreen   *screen);
GdkWindow  * gdk_screen_get_root_window(GdkScreen   *screen);
gboolean gdk_screen_is_composited(GdkScreen   *screen);
GdkVisual  * gdk_screen_get_rgba_visual(GdkScreen   *screen);
GdkVisual  * gdk_screen_get_system_visual(GdkScreen   *screen);
GType gdk_screen_get_type(void);
gchar  * gdk_rgba_to_string(const GdkRGBA *rgba);
gboolean gdk_rgba_parse(GdkRGBA       *rgba, const gchar   *spec);
gboolean gdk_rgba_equal(gconstpointer  p1, gconstpointer  p2);
guint gdk_rgba_hash(gconstpointer  p);
void gdk_rgba_free(GdkRGBA       *rgba);
GdkRGBA  * gdk_rgba_copy(const GdkRGBA *rgba);
GType gdk_rgba_get_type(void);
GType gdk_rectangle_get_type(void);
gboolean gdk_rectangle_equal(const GdkRectangle *rect1, const GdkRectangle *rect2);
void gdk_rectangle_union(const GdkRectangle *src1, const GdkRectangle *src2, GdkRectangle       *dest);
gboolean gdk_rectangle_intersect(const GdkRectangle *src1, const GdkRectangle *src2, GdkRectangle       *dest);
gchar  * gdk_utf8_to_string_target(const gchar    *str);
gint gdk_text_property_to_utf8_list_for_display(GdkDisplay     *display, GdkAtom         encoding, gint            format, const guchar   *text, gint            length, gchar        ***list);
void gdk_property_delete(GdkWindow     *window, GdkAtom        property);
void gdk_property_change(GdkWindow     *window, GdkAtom        property, GdkAtom        type, gint           format, GdkPropMode    mode, const guchar  *data, gint           nelements);
gboolean gdk_property_get(GdkWindow     *window, GdkAtom        property, GdkAtom        type, gulong         offset, gulong         length, gint           pdelete, GdkAtom       *actual_property_type, gint          *actual_format, gint          *actual_length, guchar       **data);
gchar * gdk_atom_name(GdkAtom      atom);
GdkAtom gdk_atom_intern_static_string(const gchar *atom_name);
GdkAtom gdk_atom_intern(const gchar *atom_name, gboolean     only_if_exists);
GdkPixbuf  * gdk_pixbuf_get_from_surface(cairo_surface_t *surface, gint             src_x, gint             src_y, gint             width, gint             height);
GdkPixbuf  * gdk_pixbuf_get_from_window(GdkWindow       *window, gint             src_x, gint             src_y, gint             width, gint             height);
cairo_region_t     * gdk_pango_layout_get_clip_region(PangoLayout     *layout, gint             x_origin, gint             y_origin, const gint      *index_ranges, gint             n_ranges);
cairo_region_t     * gdk_pango_layout_line_get_clip_region(PangoLayoutLine *line, gint             x_origin, gint             y_origin, const gint      *index_ranges, gint             n_ranges);
PangoContext  * gdk_pango_context_get(void);
PangoContext  * gdk_pango_context_get_for_display(GdkDisplay *display);
PangoContext  * gdk_pango_context_get_for_screen(GdkScreen    *screen);
void gdk_monitor_invalidate(GdkMonitor *monitor);
void gdk_monitor_set_subpixel_layout(GdkMonitor        *monitor, GdkSubpixelLayout  subpixel);
void gdk_monitor_set_refresh_rate(GdkMonitor *monitor, int         refresh_rate);
void gdk_monitor_set_scale_factor(GdkMonitor *monitor, int         scale);
void gdk_monitor_set_physical_size(GdkMonitor *monitor, int         width_mm, int         height_mm);
void gdk_monitor_set_size(GdkMonitor *monitor, int         width, int         height);
void gdk_monitor_set_position(GdkMonitor *monitor, int         x, int         y);
void gdk_monitor_set_model(GdkMonitor *monitor, const char *model);
void gdk_monitor_set_manufacturer(GdkMonitor *monitor, const char *manufacturer);
GdkMonitor  * gdk_monitor_new(GdkDisplay *display);
gboolean gdk_monitor_is_primary(GdkMonitor   *monitor);
GdkSubpixelLayout gdk_monitor_get_subpixel_layout(GdkMonitor   *monitor);
int gdk_monitor_get_refresh_rate(GdkMonitor   *monitor);
int gdk_monitor_get_scale_factor(GdkMonitor   *monitor);
const char  * gdk_monitor_get_model(GdkMonitor   *monitor);
const char  * gdk_monitor_get_manufacturer(GdkMonitor   *monitor);
int gdk_monitor_get_height_mm(GdkMonitor   *monitor);
int gdk_monitor_get_width_mm(GdkMonitor   *monitor);
void gdk_monitor_get_workarea(GdkMonitor   *monitor, GdkRectangle *workarea);
void gdk_monitor_get_geometry(GdkMonitor   *monitor, GdkRectangle *geometry);
GdkDisplay   * gdk_monitor_get_display(GdkMonitor   *monitor);
GType gdk_monitor_get_type(void);
void gdk_set_allowed_backends(const gchar *backends);
void gdk_disable_multidevice(void);
void gdk_flush(void);
void gdk_beep(void);
void gdk_set_double_click_time(guint msec);
gint gdk_screen_height_mm(void);
gint gdk_screen_width_mm(void);
gint gdk_screen_height(void);
gint gdk_screen_width(void);
gboolean gdk_pointer_is_grabbed(void);
void gdk_keyboard_ungrab(guint32       time_);
void gdk_pointer_ungrab(guint32       time_);
GdkGrabStatus gdk_keyboard_grab(GdkWindow    *window, gboolean      owner_events, guint32       time_);
GdkGrabStatus gdk_pointer_grab(GdkWindow    *window, gboolean      owner_events, GdkEventMask  event_mask, GdkWindow    *confine_to, GdkCursor    *cursor, guint32       time_);
gchar * gdk_get_display(void);
const gchar  * gdk_get_display_arg_name(void);
void gdk_error_trap_pop_ignored(void);
gint gdk_error_trap_pop(void);
void gdk_error_trap_push(void);
void gdk_notify_startup_complete_with_id(const gchar* startup_id);
void gdk_notify_startup_complete(void);
void gdk_set_program_class(const gchar    *program_class);
const gchar  * gdk_get_program_class(void);
void gdk_pre_parse_libgtk_only(void);
void gdk_add_option_entries_libgtk_only(GOptionGroup   *group);
gboolean gdk_init_check(gint           *argc, gchar        ***argv);
void gdk_init(gint           *argc, gchar        ***argv);
void gdk_parse_args(gint           *argc, gchar        ***argv);
guint gdk_unicode_to_keyval(guint32      wc);
guint32 gdk_keyval_to_unicode(guint        keyval);
gboolean gdk_keyval_is_lower(guint        keyval);
gboolean gdk_keyval_is_upper(guint        keyval);
guint gdk_keyval_to_lower(guint        keyval);
guint gdk_keyval_to_upper(guint        keyval);
void gdk_keyval_convert_case(guint        symbol, guint       *lower, guint       *upper);
guint gdk_keyval_from_name(const gchar *keyval_name);
gchar * gdk_keyval_name(guint        keyval);
GdkModifierType gdk_keymap_get_modifier_mask(GdkKeymap           *keymap, GdkModifierIntent    intent);
gboolean gdk_keymap_map_virtual_modifiers(GdkKeymap           *keymap, GdkModifierType     *state);
void gdk_keymap_add_virtual_modifiers(GdkKeymap           *keymap, GdkModifierType     *state);
guint gdk_keymap_get_modifier_state(GdkKeymap           *keymap);
gboolean gdk_keymap_get_scroll_lock_state(GdkKeymap           *keymap);
gboolean gdk_keymap_get_num_lock_state(GdkKeymap           *keymap);
gboolean gdk_keymap_get_caps_lock_state(GdkKeymap           *keymap);
gboolean gdk_keymap_have_bidi_layouts(GdkKeymap           *keymap);
PangoDirection gdk_keymap_get_direction(GdkKeymap           *keymap);
gboolean gdk_keymap_get_entries_for_keycode(GdkKeymap           *keymap, guint                hardware_keycode, GdkKeymapKey       **keys, guint              **keyvals, gint                *n_entries);
gboolean gdk_keymap_get_entries_for_keyval(GdkKeymap           *keymap, guint                keyval, GdkKeymapKey       **keys, gint                *n_keys);
gboolean gdk_keymap_translate_keyboard_state(GdkKeymap           *keymap, guint                hardware_keycode, GdkModifierType      state, gint                 group, guint               *keyval, gint                *effective_group, gint                *level, GdkModifierType     *consumed_modifiers);
guint gdk_keymap_lookup_key(GdkKeymap           *keymap, const GdkKeymapKey  *key);
GdkKeymap * gdk_keymap_get_for_display(GdkDisplay *display);
GdkKeymap * gdk_keymap_get_default(void);
GType gdk_keymap_get_type(void);
void gdk_gl_context_clear_current(void);
GdkGLContext  * gdk_gl_context_get_current(void);
void gdk_gl_context_make_current(GdkGLContext  *context);
gboolean gdk_gl_context_realize(GdkGLContext  *context, GError       **error);
gboolean gdk_gl_context_get_use_es(GdkGLContext  *context);
void gdk_gl_context_set_use_es(GdkGLContext  *context, int            use_es);
gboolean gdk_gl_context_get_forward_compatible(GdkGLContext  *context);
void gdk_gl_context_set_forward_compatible(GdkGLContext  *context, gboolean       compatible);
gboolean gdk_gl_context_get_debug_enabled(GdkGLContext  *context);
void gdk_gl_context_set_debug_enabled(GdkGLContext  *context, gboolean       enabled);
void gdk_gl_context_get_required_version(GdkGLContext  *context, int           *major, int           *minor);
void gdk_gl_context_set_required_version(GdkGLContext  *context, int            major, int            minor);
gboolean gdk_gl_context_is_legacy(GdkGLContext  *context);
void gdk_gl_context_get_version(GdkGLContext  *context, int           *major, int           *minor);
GdkGLContext  * gdk_gl_context_get_shared_context(GdkGLContext  *context);
GdkWindow  * gdk_gl_context_get_window(GdkGLContext  *context);
GdkDisplay  * gdk_gl_context_get_display(GdkGLContext  *context);
GType gdk_gl_context_get_type(void);
GQuark gdk_gl_error_quark(void);
gint64 gdk_frame_timings_get_predicted_presentation_time(GdkFrameTimings *timings);
gint64 gdk_frame_timings_get_refresh_interval(GdkFrameTimings *timings);
gint64 gdk_frame_timings_get_presentation_time(GdkFrameTimings *timings);
gint64 gdk_frame_timings_get_frame_time(GdkFrameTimings *timings);
gboolean gdk_frame_timings_get_complete(GdkFrameTimings *timings);
gint64 gdk_frame_timings_get_frame_counter(GdkFrameTimings *timings);
void gdk_frame_timings_unref(GdkFrameTimings *timings);
GdkFrameTimings  * gdk_frame_timings_ref(GdkFrameTimings *timings);
GType gdk_frame_timings_get_type(void);
GType gdk_frame_clock_idle_get_type(void);
void gdk_frame_clock_get_refresh_info(GdkFrameClock *frame_clock, gint64         base_time, gint64        *refresh_interval_return, gint64        *presentation_time_return);
GdkFrameTimings  * gdk_frame_clock_get_current_timings(GdkFrameClock *frame_clock);
GdkFrameTimings  * gdk_frame_clock_get_timings(GdkFrameClock *frame_clock, gint64         frame_counter);
gint64 gdk_frame_clock_get_history_start(GdkFrameClock *frame_clock);
gint64 gdk_frame_clock_get_frame_counter(GdkFrameClock *frame_clock);
void gdk_frame_clock_end_updating(GdkFrameClock      *frame_clock);
void gdk_frame_clock_begin_updating(GdkFrameClock      *frame_clock);
void gdk_frame_clock_request_phase(GdkFrameClock      *frame_clock, GdkFrameClockPhase  phase);
gint64 gdk_frame_clock_get_frame_time(GdkFrameClock *frame_clock);
GType gdk_frame_clock_get_type(void);
gboolean gdk_event_get_pointer_emulated(GdkEvent *event);
int gdk_event_get_scancode(GdkEvent *event);
void gdk_event_set_device_tool(GdkEvent       *event, GdkDeviceTool  *tool);
GdkDeviceTool  * gdk_event_get_device_tool(const GdkEvent *event);
gboolean gdk_setting_get(const gchar    *name, GValue         *value);
gboolean gdk_get_show_events(void);
void gdk_set_show_events(gboolean	 show_events);
GdkSeat   * gdk_event_get_seat(const GdkEvent *event);
GdkEventType gdk_event_get_event_type(const GdkEvent *event);
GdkEventSequence  * gdk_event_get_event_sequence(const GdkEvent *event);
GdkScreen  * gdk_event_get_screen(const GdkEvent  *event);
void gdk_event_set_screen(GdkEvent        *event, GdkScreen       *screen);
void gdk_event_handler_set(GdkEventFunc    func, gpointer        data, GDestroyNotify  notify);
gboolean gdk_events_get_center(GdkEvent        *event1, GdkEvent        *event2, gdouble         *x, gdouble         *y);
gboolean gdk_events_get_angle(GdkEvent        *event1, GdkEvent        *event2, gdouble         *angle);
gboolean gdk_events_get_distance(GdkEvent        *event1, GdkEvent        *event2, gdouble         *distance);
gboolean gdk_event_triggers_context_menu(const GdkEvent *event);
void gdk_event_request_motions(const GdkEventMotion *event);
GdkDevice * gdk_event_get_source_device(const GdkEvent  *event);
void gdk_event_set_source_device(GdkEvent        *event, GdkDevice       *device);
GdkDevice * gdk_event_get_device(const GdkEvent  *event);
void gdk_event_set_device(GdkEvent        *event, GdkDevice       *device);
gboolean gdk_event_get_axis(const GdkEvent  *event, GdkAxisUse       axis_use, gdouble         *value);
gboolean gdk_event_is_scroll_stop_event(const GdkEvent *event);
gboolean gdk_event_get_scroll_deltas(const GdkEvent *event, gdouble         *delta_x, gdouble         *delta_y);
gboolean gdk_event_get_scroll_direction(const GdkEvent *event, GdkScrollDirection *direction);
gboolean gdk_event_get_keycode(const GdkEvent *event, guint16        *keycode);
gboolean gdk_event_get_keyval(const GdkEvent *event, guint          *keyval);
gboolean gdk_event_get_click_count(const GdkEvent *event, guint          *click_count);
gboolean gdk_event_get_button(const GdkEvent *event, guint          *button);
gboolean gdk_event_get_root_coords(const GdkEvent *event, gdouble	*x_root, gdouble	*y_root);
gboolean gdk_event_get_coords(const GdkEvent  *event, gdouble	 *x_win, gdouble	 *y_win);
gboolean gdk_event_get_state(const GdkEvent  *event, GdkModifierType *state);
guint32 gdk_event_get_time(const GdkEvent  *event);
GdkWindow  * gdk_event_get_window(const GdkEvent *event);
void gdk_event_free(GdkEvent 	*event);
GdkEvent * gdk_event_copy(const GdkEvent *event);
GdkEvent * gdk_event_new(GdkEventType    type);
void gdk_event_put(const GdkEvent *event);
GdkEvent * gdk_event_peek(void);
GdkEvent * gdk_event_get(void);
gboolean gdk_events_pending(void);
GType gdk_event_sequence_get_type(void);
GType gdk_event_get_type(void);
cairo_t  * gdk_drawing_context_get_cairo_context(GdkDrawingContext *context);
gboolean gdk_drawing_context_is_valid(GdkDrawingContext *context);
cairo_region_t  * gdk_drawing_context_get_clip(GdkDrawingContext *context);
GdkWindow  * gdk_drawing_context_get_window(GdkDrawingContext *context);
GType gdk_drawing_context_get_type(void);
gboolean gdk_drag_context_manage_dnd(GdkDragContext *context, GdkWindow      *ipc_window, GdkDragAction   actions);
void gdk_drag_context_set_hotspot(GdkDragContext *context, gint            hot_x, gint            hot_y);
GdkWindow       * gdk_drag_context_get_drag_window(GdkDragContext *context);
void gdk_drag_drop_done(GdkDragContext *context, gboolean        success);
gboolean gdk_drag_drop_succeeded(GdkDragContext *context);
void gdk_drag_abort(GdkDragContext *context, guint32         time_);
void gdk_drag_drop(GdkDragContext *context, guint32         time_);
gboolean gdk_drag_motion(GdkDragContext *context, GdkWindow      *dest_window, GdkDragProtocol protocol, gint            x_root, gint            y_root, GdkDragAction   suggested_action, GdkDragAction   possible_actions, guint32         time_);
void gdk_drag_find_window_for_screen(GdkDragContext   *context, GdkWindow        *drag_window, GdkScreen        *screen, gint              x_root, gint              y_root, GdkWindow       **dest_window, GdkDragProtocol  *protocol);
GdkDragContext  * gdk_drag_begin_from_point(GdkWindow      *window, GdkDevice      *device, GList          *targets, gint            x_root, gint            y_root);
GdkDragContext  * gdk_drag_begin_for_device(GdkWindow      *window, GdkDevice      *device, GList          *targets);
GdkDragContext  * gdk_drag_begin(GdkWindow      *window, GList          *targets);
GdkAtom gdk_drag_get_selection(GdkDragContext   *context);
void gdk_drop_finish(GdkDragContext   *context, gboolean          success, guint32           time_);
void gdk_drop_reply(GdkDragContext   *context, gboolean          accepted, guint32           time_);
void gdk_drag_status(GdkDragContext   *context, GdkDragAction     action, guint32           time_);
GdkDragProtocol gdk_drag_context_get_protocol(GdkDragContext *context);
GdkWindow        * gdk_drag_context_get_dest_window(GdkDragContext *context);
GdkWindow        * gdk_drag_context_get_source_window(GdkDragContext *context);
GdkDragAction gdk_drag_context_get_selected_action(GdkDragContext *context);
GdkDragAction gdk_drag_context_get_suggested_action(GdkDragContext *context);
GdkDragAction gdk_drag_context_get_actions(GdkDragContext *context);
GList            * gdk_drag_context_list_targets(GdkDragContext *context);
GdkDevice  * gdk_drag_context_get_device(GdkDragContext *context);
void gdk_drag_context_set_device(GdkDragContext *context, GdkDevice      *device);
GType gdk_drag_context_get_type(void);
GdkDisplay  * gdk_display_manager_open_display(GdkDisplayManager *manager, const gchar       *name);
GSList  * gdk_display_manager_list_displays(GdkDisplayManager *manager);
void gdk_display_manager_set_default_display(GdkDisplayManager *manager, GdkDisplay        *display);
GdkDisplay  * gdk_display_manager_get_default_display(GdkDisplayManager *manager);
GdkDisplayManager  * gdk_display_manager_get(void);
GType gdk_display_manager_get_type(void);
GdkMonitor  * gdk_display_get_monitor_at_window(GdkDisplay *display, GdkWindow  *window);
GdkMonitor  * gdk_display_get_monitor_at_point(GdkDisplay *display, int         x, int         y);
GdkMonitor  * gdk_display_get_primary_monitor(GdkDisplay *display);
GdkMonitor  * gdk_display_get_monitor(GdkDisplay *display, int         monitor_num);
int gdk_display_get_n_monitors(GdkDisplay *display);
GList    * gdk_display_list_seats(GdkDisplay *display);
GdkSeat  * gdk_display_get_default_seat(GdkDisplay *display);
GdkAppLaunchContext  * gdk_display_get_app_launch_context(GdkDisplay *display);
GdkDeviceManager  * gdk_display_get_device_manager(GdkDisplay *display);
void gdk_display_notify_startup_complete(GdkDisplay    *display, const gchar   *startup_id);
gboolean gdk_display_supports_composite(GdkDisplay    *display);
gboolean gdk_display_supports_input_shapes(GdkDisplay    *display);
gboolean gdk_display_supports_shapes(GdkDisplay    *display);
void gdk_display_store_clipboard(GdkDisplay    *display, GdkWindow     *clipboard_window, guint32        time_, const GdkAtom *targets, gint           n_targets);
gboolean gdk_display_supports_clipboard_persistence(GdkDisplay    *display);
gboolean gdk_display_request_selection_notification(GdkDisplay *display, GdkAtom     selection);
gboolean gdk_display_supports_selection_notification(GdkDisplay *display);
GdkWindow  * gdk_display_get_default_group(GdkDisplay *display);
void gdk_display_get_maximal_cursor_size(GdkDisplay    *display, guint         *width, guint         *height);
guint gdk_display_get_default_cursor_size(GdkDisplay    *display);
gboolean gdk_display_supports_cursor_color(GdkDisplay    *display);
gboolean gdk_display_supports_cursor_alpha(GdkDisplay    *display);
GdkDisplay  * gdk_display_open_default_libgtk_only(void);
void gdk_display_warp_pointer(GdkDisplay             *display, GdkScreen              *screen, gint                   x, gint                   y);
GdkWindow  * gdk_display_get_window_at_pointer(GdkDisplay             *display, gint                   *win_x, gint                   *win_y);
void gdk_display_get_pointer(GdkDisplay             *display, GdkScreen             **screen, gint                   *x, gint                   *y, GdkModifierType        *mask);
GdkDisplay  * gdk_display_get_default(void);
void gdk_display_set_double_click_distance(GdkDisplay   *display, guint         distance);
void gdk_display_set_double_click_time(GdkDisplay   *display, guint         msec);
gboolean gdk_display_has_pending(GdkDisplay  *display);
void gdk_display_put_event(GdkDisplay     *display, const GdkEvent *event);
GdkEvent * gdk_display_peek_event(GdkDisplay     *display);
GdkEvent * gdk_display_get_event(GdkDisplay     *display);
GList  * gdk_display_list_devices(GdkDisplay  *display);
gboolean gdk_display_is_closed(GdkDisplay  *display);
void gdk_display_close(GdkDisplay  *display);
void gdk_display_flush(GdkDisplay  *display);
void gdk_display_sync(GdkDisplay  *display);
void gdk_display_beep(GdkDisplay  *display);
gboolean gdk_display_device_is_grabbed(GdkDisplay  *display, GdkDevice   *device);
gboolean gdk_display_pointer_is_grabbed(GdkDisplay  *display);
void gdk_display_keyboard_ungrab(GdkDisplay  *display, guint32      time_);
void gdk_display_pointer_ungrab(GdkDisplay  *display, guint32      time_);
GdkScreen  * gdk_display_get_default_screen(GdkDisplay  *display);
GdkScreen  * gdk_display_get_screen(GdkDisplay  *display, gint         screen_num);
gint gdk_display_get_n_screens(GdkDisplay  *display);
const gchar  * gdk_display_get_name(GdkDisplay *display);
GdkDisplay  * gdk_display_open(const gchar *display_name);
GType gdk_display_get_type(void);
GdkDeviceTool  * gdk_device_tool_new(guint64            serial, guint64            hw_id, GdkDeviceToolType  type, GdkAxisFlags       tool_axes);
GdkDeviceToolType gdk_device_tool_get_tool_type(GdkDeviceTool *tool);
guint64 gdk_device_tool_get_hardware_id(GdkDeviceTool *tool);
guint64 gdk_device_tool_get_serial(GdkDeviceTool *tool);
GType gdk_device_tool_get_type(void);
gint gdk_device_pad_get_feature_group(GdkDevicePad        *pad, GdkDevicePadFeature  feature, gint                 feature_idx);
gint gdk_device_pad_get_n_features(GdkDevicePad        *pad, GdkDevicePadFeature  feature);
gint gdk_device_pad_get_group_n_modes(GdkDevicePad *pad, gint          group_idx);
gint gdk_device_pad_get_n_groups(GdkDevicePad *pad);
GType gdk_device_pad_get_type(void);
GdkDevice  * gdk_device_manager_get_client_pointer(GdkDeviceManager *device_manager);
GList  * gdk_device_manager_list_devices(GdkDeviceManager *device_manager, GdkDeviceType     type);
GdkDisplay  * gdk_device_manager_get_display(GdkDeviceManager *device_manager);
GType gdk_device_manager_get_type(void);
GdkAxisFlags gdk_device_get_axes(GdkDevice *device);
GdkSeat      * gdk_device_get_seat(GdkDevice *device);
const gchar  * gdk_device_get_product_id(GdkDevice *device);
const gchar  * gdk_device_get_vendor_id(GdkDevice *device);
GdkWindow  * gdk_device_get_last_event_window(GdkDevice *device);
gboolean gdk_device_grab_info_libgtk_only(GdkDisplay  *display, GdkDevice   *device, GdkWindow  **grab_window, gboolean    *owner_events);
void gdk_device_warp(GdkDevice        *device, GdkScreen        *screen, gint              x, gint              y);
void gdk_device_ungrab(GdkDevice        *device, guint32           time_);
GdkGrabStatus gdk_device_grab(GdkDevice        *device, GdkWindow        *window, GdkGrabOwnership  grab_ownership, gboolean          owner_events, GdkEventMask      event_mask, GdkCursor        *cursor, guint32           time_);
GdkDeviceType gdk_device_get_device_type(GdkDevice *device);
GList  * gdk_device_list_slave_devices(GdkDevice     *device);
GdkDevice   * gdk_device_get_associated_device(GdkDevice     *device);
GdkDisplay  * gdk_device_get_display(GdkDevice      *device);
gboolean gdk_device_get_axis(GdkDevice         *device, gdouble           *axes, GdkAxisUse         use, gdouble           *value);
gboolean gdk_device_get_axis_value(GdkDevice       *device, gdouble         *axes, GdkAtom          axis_label, gdouble         *value);
GList  * gdk_device_list_axes(GdkDevice       *device);
gint gdk_device_get_n_axes(GdkDevice       *device);
void gdk_device_free_history(GdkTimeCoord     **events, gint               n_events);
gboolean gdk_device_get_history(GdkDevice         *device, GdkWindow         *window, guint32            start, guint32            stop, GdkTimeCoord    ***events, gint              *n_events);
GdkWindow * gdk_device_get_window_at_position_double(GdkDevice         *device, gdouble           *win_x, gdouble           *win_y);
void gdk_device_get_position_double(GdkDevice         *device, GdkScreen        **screen, gdouble           *x, gdouble           *y);
GdkWindow * gdk_device_get_window_at_position(GdkDevice         *device, gint              *win_x, gint              *win_y);
void gdk_device_get_position(GdkDevice         *device, GdkScreen        **screen, gint              *x, gint              *y);
void gdk_device_get_state(GdkDevice         *device, GdkWindow         *window, gdouble           *axes, GdkModifierType   *mask);
void gdk_device_set_axis_use(GdkDevice         *device, guint              index_, GdkAxisUse         use);
GdkAxisUse gdk_device_get_axis_use(GdkDevice         *device, guint              index_);
void gdk_device_set_key(GdkDevice      *device, guint           index_, guint           keyval, GdkModifierType modifiers);
gboolean gdk_device_get_key(GdkDevice       *device, guint            index_, guint           *keyval, GdkModifierType *modifiers);
gint gdk_device_get_n_keys(GdkDevice       *device);
gboolean gdk_device_set_mode(GdkDevice      *device, GdkInputMode    mode);
GdkInputMode gdk_device_get_mode(GdkDevice      *device);
GdkInputSource gdk_device_get_source(GdkDevice      *device);
gboolean gdk_device_get_has_cursor(GdkDevice *device);
const gchar  * gdk_device_get_name(GdkDevice *device);
GType gdk_device_get_type(void);
GdkCursorType gdk_cursor_get_cursor_type(GdkCursor       *cursor);
cairo_surface_t  * gdk_cursor_get_surface(GdkCursor       *cursor, gdouble         *x_hot, gdouble         *y_hot);
GdkPixbuf * gdk_cursor_get_image(GdkCursor       *cursor);
void gdk_cursor_unref(GdkCursor       *cursor);
GdkCursor  * gdk_cursor_ref(GdkCursor       *cursor);
GdkDisplay * gdk_cursor_get_display(GdkCursor	  *cursor);
GdkCursor * gdk_cursor_new_from_name(GdkDisplay      *display, const gchar     *name);
GdkCursor * gdk_cursor_new_from_surface(GdkDisplay      *display, cairo_surface_t *surface, gdouble          x, gdouble          y);
GdkCursor * gdk_cursor_new_from_pixbuf(GdkDisplay      *display, GdkPixbuf       *pixbuf, gint             x, gint             y);
GdkCursor * gdk_cursor_new(GdkCursorType	   cursor_type);
GdkCursor * gdk_cursor_new_for_display(GdkDisplay      *display, GdkCursorType    cursor_type);
GType gdk_cursor_get_type(void);
GdkDrawingContext  * gdk_cairo_get_drawing_context(cairo_t *cr);
void gdk_cairo_draw_from_gl(cairo_t              *cr, GdkWindow            *window, int                   source, int                   source_type, int                   buffer_scale, int                   x, int                   y, int                   width, int                   height);
cairo_surface_t  * gdk_cairo_surface_create_from_pixbuf(const GdkPixbuf *pixbuf, int scale, GdkWindow *for_window);
void gdk_cairo_set_source_color(cairo_t              *cr, const GdkColor       *color);
cairo_region_t * gdk_cairo_region_create_from_surface(cairo_surface_t      *surface);
void gdk_cairo_region(cairo_t              *cr, const cairo_region_t *region);
void gdk_cairo_rectangle(cairo_t              *cr, const GdkRectangle   *rectangle);
void gdk_cairo_set_source_window(cairo_t              *cr, GdkWindow            *window, gdouble               x, gdouble               y);
void gdk_cairo_set_source_pixbuf(cairo_t              *cr, const GdkPixbuf      *pixbuf, gdouble               pixbuf_x, gdouble               pixbuf_y);
void gdk_cairo_set_source_rgba(cairo_t              *cr, const GdkRGBA        *rgba);
gboolean gdk_cairo_get_clip_rectangle(cairo_t            *cr, GdkRectangle       *rect);
cairo_t   * gdk_cairo_create(GdkWindow          *window);
void gdk_app_launch_context_set_icon_name(GdkAppLaunchContext *context, const char          *icon_name);
void gdk_app_launch_context_set_icon(GdkAppLaunchContext *context, GIcon               *icon);
void gdk_app_launch_context_set_timestamp(GdkAppLaunchContext *context, guint32              timestamp);
void gdk_app_launch_context_set_desktop(GdkAppLaunchContext *context, gint                 desktop);
void gdk_app_launch_context_set_screen(GdkAppLaunchContext *context, GdkScreen           *screen);
void gdk_app_launch_context_set_display(GdkAppLaunchContext *context, GdkDisplay          *display);
GdkAppLaunchContext  * gdk_app_launch_context_new(void);
GType gdk_app_launch_context_get_type(void);
