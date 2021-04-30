Est-ce que GTK+PHP vous plait ?
Dans quel mesure GTK+PHP vous aiderais dans votre travail ?

# Where generate C

TODO: Generate CodeGenerator file extension
TODO: Generate DocBook xml, and refactor <src>/View
TODO: remove Zend-user API functions( use <src>/Implementations if necessary)

TODO: GtkWidget::property, signal, style
TODO: howto enable/disable : dimension, properti, cast, converte to array, debug_info ?
      ex : glist, ghashtable use dimension, cairo_rectangle do not use dimension

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
