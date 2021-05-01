Est-ce que GTK+PHP vous plait ?
Dans quel mesure GTK+PHP vous aiderais dans votre travail ?

# Where generate C

TODO: var_dump(GtkWidget)
      // si on var_dump() un GtkWidget on appel gtk_window_set_interactive_debugging(TRUE)
      // var_dump($widget['app-paintable']); // output: bool(true)
      // g_signal_list_ids(GType)


TODO: short
TODO : GtkWidget['styles::cursor-color']// gtk_widget_style_get_property
TODO : GtkWidget['signals::button-press-event']// g_signal_lookup()
TODO : GtkWidget['app-paintable']//g_object_get_property
TODO : GtkWidget['data::app-paintable']//g_object_get_data();
TODO : GtkWidget->member
TODO : cairo_rectangle_t->x// php_object->ptr->x


Comment éviter g_object_set_data('zend_object')
// ----------------------------------------------------------
struct _MyWidget {
      GtkWidget parent_instance;// instead of GObject *ptr ?

      zend_object std;
}

$widget=
create_object();
      -> php_gtk_widget_new();
            zend_object_creat();

gtk_container_remove_all_children($window);
var_dump($widget) zval.value.object invalid memory area

$widget = new GtkWidget(); destroy zval.value.object


TODO : GtkWidget properties
TODO: GtkWidget::property, signal, style
TODO: howto enable/disable : dimension, properti, cast, converte to array, debug_info ?
      ex : glist, ghashtable use dimension, cairo_rectangle do not use dimension

TODO: remove DocBook/[Cairo,Glib, Php]
TODO : Assume multiline commentHelper
TODO : Php API declared dependency : use GdkVisual; etc.
TODO: Php API generate the related object


TODO: View/C/Source/class.phtml remove enum _type_properties if{empty}

TODO: remove Zend-user API functions( use <src>/Implementations if necessary)
TODO: in _write_properties()
      add zend_std_write_() if dynamic property allowed

TODO: generate php API( edit manualy deref for GLib, use annotation for Gtk)
TODO: Parameter deref( see in the docbook; but for glib is not set)
TODO: Parameter variadic
TODO: Parameter is nullable
TODO: loop doc/public/cairo-docs.xml to find the entities

TODO: property getter setter( implement all types and put it in :
      php_gtk.h
      php_gtk.c)
TODO: do not generate member of struct GtkWidget

TODO: parser la doc des membre de la struct Class( Done pour les relatedObjects)
TODO: struct class to php static member class

FIXME: revoir decl.txt, ne pas traiter struct quand empty et mettre une declaration dans data/config-glib.h

TODO: Fix name CodeGenerator : Php/GlibGenerator, C/Header/GlibGenerator, 
TODO: Refactor <src>/View to assume Php version


# Where generate Php
- in docBlock type is displayed white '*' pass ref
- in docBlock description need to be display in 2 lines
- in function parameters need to specify if the parameter is nullable
- Improve parameter is pass by reference
  (To know this, we need to reflexion an *.php API)
  generate API with Views/Php/Pp/... and edit it manualy,
  then use this API as the reference.
  
- Fixe requiredargHelper();// check Nullable argument
- Fixe maxargHelper();// return -1 if has variadic

- <<<???
- Refactor Services/CodeGenerator by Services/Generator(C/C++, PHP5/7/8)
- Add Services/Reflection (Php reflexion)
- ???>>>

- When C Source generator
- FIXME Assume no parameter, g_list_alloc (pas de parametre)
- FIXME Assume php_glib/list.h

- remove <src>/Php
- rename <src> by <lib> and put <src>/Views/C/Source/implementations/* in new <src>/*
 <src>/Glib
   + GList.php( this can customize code, and hinibite depracate function definition)

- Assume each php version to generate API IDE
```
 <src>/Views
      + Helpers(P4)
      + Php<default>
      + Php4_4_9  // override <default>
      + Php5_6_9  // override <default>
      + Php7_4_9  // override <default>
      + Php8_0_1  // override <default>
```
