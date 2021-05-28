Est-ce que GTK+PHP vous plait ?
Dans quel mesure GTK+PHP vous aiderais dans votre travail ?

TODO: Refactor src/Implementation
               src/Implementation/Cairo/Path.php
TODO: 
diff -b ~/Projects/gtkphp/php-src/ext/gtk/php_cairo/path.c ~/Projets/zend-ext/output/php_cairo/path.c

# Model

Package(gtkml):Object {
      objects => []
      enums => []
      structs => []
      classes => []
      symbols => []
      description => "Gtk Markup Language"
      subpackage=>[
            Package(cairo):Object {
                  description => "Cairo: A Vector Graphics Library"
                  subpackage=>[
                        Package(cairo-drawing):Object {
                              description => "Drawing"
                              children => [
                                    File(cairo.xml):Object {
                                          children : [
                                                Struct(cairo_t):Object {
                                                }
                                                Function(cairo_create):Object {}
                                                Function(cairo_reference):Object {}
                                                Function(cairo_destroy):Object {}
                                                Function(cairo_status):Object {}
                                                Function(cairo_save):Object {}
                                                Function(cairo_restore):Object {}
                                                Function(cairo_get_target):Object {}
                                                Function(cairo_push_group):Object {}
                                                Function(cairo_push_group_with_content):Object {}
                                                Function(cairo_pop_group):Object {}
                                                Function(cairo_pop_group_to_source):Object {}
                                                Function(cairo_get_group_target):Object {}
                                                Function(cairo_set_source_rgb):Object {}
                                                Function(cairo_set_source_rgba):Object {}
                                                Function(cairo_set_source):Object {}
                                                Function(cairo_set_source_surface):Object {}
                                                Function(cairo_get_source):Object {}
                                                Function(cairo_set_antialias):Object {}
                                                Function(cairo_get_antialias):Object {}
                                                Function(cairo_set_dash):Object {}
                                                Function(cairo_get_dash_count):Object {}
                                                Function(cairo_get_dash):Object {}
                                                Function(cairo_set_fill_rule):Object {}
                                                Function(cairo_get_fill_rule):Object {}
                                                Function(cairo_set_line_cap):Object {}
                                                Function(cairo_get_line_cap):Object {}
                                                Function(cairo_set_line_join):Object {}
                                                Function(cairo_get_line_join):Object {}
                                                Function(cairo_set_line_width):Object {}
                                                Function(cairo_get_line_width):Object {}
                                                Function(cairo_set_miter_limit):Object {}
                                                Function(cairo_get_miter_limit):Object {}
                                                Function(cairo_set_operator):Object {}
                                                Function(cairo_get_operator):Object {}
                                                Function(cairo_set_tolerance):Object {}
                                                Function(cairo_get_tolerance):Object {}
                                                Function(cairo_clip):Object {}
                                                Function(cairo_clip_preserve):Object {}
                                                Function(cairo_clip_extents):Object {}
                                                Function(cairo_in_clip):Object {}
                                                Function(cairo_reset_clip):Object {}
                                                Function(cairo_rectangle_list_destroy):Object {}
                                                Function(cairo_copy_clip_rectangle_list):Object {}
                                                Function(cairo_fill):Object {}
                                                Function(cairo_fill_preserve):Object {}
                                                Function(cairo_fill_extents):Object {}
                                                Function(cairo_in_fill):Object {}
                                                Function(cairo_mask):Object {}
                                                Function(cairo_mask_surface):Object {}
                                                Function(cairo_paint):Object {}
                                                Function(cairo_paint_with_alpha):Object {}
                                                Function(cairo_stroke):Object {}
                                                Function(cairo_stroke_preserve):Object {}
                                                Function(cairo_stroke_extents):Object {}
                                                Function(cairo_in_stroke):Object {}
                                                Function(cairo_copy_page):Object {}
                                                Function(cairo_show_page):Object {}
                                                Function(cairo_get_reference_count):Object {}
                                                Function(cairo_set_user_data):Object {}
                                                Function(cairo_get_user_data):Object {}
                                                Enum(cairo_antialias_t):Object {
                                                      CAIRO_ANTIALIAS_DEFAULT (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_ANTIALIAS_NONE (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_ANTIALIAS_GRAY (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_ANTIALIAS_SUBPIXEL (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_ANTIALIAS_FAST (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_ANTIALIAS_GOOD (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_ANTIALIAS_BEST (Zend\Ext\Models\ConstantGenerator);
                                                }
                                                Enum(cairo_fill_rule_t):Object {
                                                      CAIRO_FILL_RULE_WINDING (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_FILL_RULE_EVEN_ODD (Zend\Ext\Models\ConstantGenerator);
                                                }
                                                Enum(cairo_line_cap_t):Object {
                                                      CAIRO_LINE_CAP_BUTT (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_LINE_CAP_ROUND (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_LINE_CAP_SQUARE (Zend\Ext\Models\ConstantGenerator);
                                                }
                                                Enum(cairo_line_join_t):Object {
                                                      CAIRO_LINE_JOIN_MITER (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_LINE_JOIN_ROUND (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_LINE_JOIN_BEVEL (Zend\Ext\Models\ConstantGenerator);
                                                }
                                                Enum(cairo_operator_t):Object {
                                                      CAIRO_OPERATOR_CLEAR (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_SOURCE (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_OVER (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_IN (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_OUT (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_ATOP (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_DEST (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_DEST_OVER (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_DEST_IN (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_DEST_OUT (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_DEST_ATOP (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_XOR (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_ADD (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_SATURATE (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_MULTIPLY (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_SCREEN (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_OVERLAY (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_DARKEN (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_LIGHTEN (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_COLOR_DODGE (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_COLOR_BURN (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_HARD_LIGHT (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_SOFT_LIGHT (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_DIFFERENCE (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_EXCLUSION (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_HSL_HUE (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_HSL_SATURATION (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_HSL_COLOR (Zend\Ext\Models\ConstantGenerator);
                                                      CAIRO_OPERATOR_HSL_LUMINOSITY (Zend\Ext\Models\ConstantGenerator);
                                                }
                                                Struct(cairo_rectangle_t):Object {
                                                      x (double);
                                                      y (double);
                                                      width (double);
                                                      height (double);
                                                }
                                                Struct(cairo_rectangle_list_t):Object {
                                                      status (cairo_status_t);
                                                      rectangles (cairo_rectangle_t);
                                                      num_rectangles (int);
                                                }
                                          ]
                                    }
                                    File(cairo-paths.xml):Object {
                                          children => [
                                                Struct(cairo_path_t):Object{}
                                                Enum(cairo_path_data_type_t):Object{}
                                                Union(cairo_path_data_t):Object{}
                                                Function(cairo_copy_path):Object{}
                                          ]
                                    }
                                    File(transformations.xml):Object {
                                          children => [
                                                Function(cairo_translate) {}
                                          ]
                                    }
                              ]
                        }
                  ]
            }
      ]
}



Package(Gtkml):Object {
      description => "Gtk Markup Language"
      subpackage=>[
            Package(G):Object {
                  description => "G library"
                  subpackage=>[
                        Package(glib):Object {
                              description => "Data structure library"
                              
                        }
                        Package(gobject):Object {
                              
                        }
                        Package(gio):Object {
                              
                        }
                  ]
            }
            Package(Cairo):Object {
                  description => "Cairo Graphic library"
                  children => [
                        Class(Cairo):Object {
                              parent => Class:Object{$package->get_list_type_object};
                              instance => Struct:Object { members=>[
                                    Var:Object(parent_instance){}
                                    Var:Object(status){}
                              ]}
                              virtualTable => Struct:Object{members=> [
                                    Var:Object(debug){}
                                    Var:Object(cairo_move_to){ type: Prototype}
                              ]}
                              children => [// related 
                                    Method:Object(Create) {}
                                    Function:Object(Create) {????}
                                    Enum:Object(Antialias) {}
                                    Struct:Object(Rectangle) {}
                              ]
                        }
                        //File(Transformations.xml) {}
                        Function(cairo_translate){}
                        Function(cairo_scale){}
                        Function(cairo_rotate){}
                        Function(cairo_transform){}
                        Function(cairo_set_matrix){}
                        Function(cairo_get_matrix){}
                        Function(cairo_identity_matrix){}
                        Function(cairo_device_to_user){}

                        Struct(Device):Object {
                        }
                        Class(Path):Object {
                              Instance =>
                              VirtualTable =>
                              children => [
                                    Union(PathData) {
                                          members =>
                                          children => [
                                                Enum(PathDataType):Object {Constants =>}
                                          ]
                                    }
                              ]
                        }
                        Object(ErrorHandling.c) {
                              children => [
                                    Enum(Status){}
                                    Function(cairo_status_to_string){}
                              ]
                        }
                  ]
            }
            Package(Gtk):Object {
                  Package(gtk):Object {
                        
                  }
                  Package(gdk):Object {
                        
                  }
            }
            Package(GStream):Object {
                  
            }
      ]
}


# Where generate C

$ # find special char for cairo documentation
$ find . -name '*.h' -print0 | xargs -0 grep -axv '.*'

TODO: var_dump(GtkWidget)
      // si on var_dump() un GtkWidget on appel gtk_window_set_interactive_debugging(TRUE)
      // var_dump($widget['app-paintable']); // output: bool(true)
      // g_signal_list_ids(GType)


TODO: docBook::getPackage()
TODO: Generate each cairo, gdk,... have it's own PackageGenerator::name
TODO: Generate Php => add use
TODO: Generate C source => add include( path depend on cairo_glyph_path...)
TODO: Generate C source => PHP_GTK_ASSERT(cr)
TODO: Generate C source => write_property
TODO: Generate C source => disable property if void
TODO: Generate C source => disable dimension...
TODO: Generate C source => generate dependency
TODO: Generate C source => overwrite CallHelper( <src>/Cairo.php)
TODO: Generate C source => overwrite GtkWidget class

TODO: short or no
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
      -> gtk_widget_my_new();
                  zend_object_creat();
                        gtkwidget.listen.destroy();

gtk_container_remove_all_children($window);
var_dump($widget) zval.value.object invalid memory area

$widget = new GtkWidget(); destroy zval.value.object

TODO: Cairo gerer les version(cairo-version.h) et les features( cairo-config.h)

TODO: Gtk::loadEnum like Gtk::loadClass
      ClassGenerator and EnumGenerator extends FileGenerator::getRelatedObject
      // file.phtml display object, and object->related
TODO: See Also
TODO : GtkWidget properties
TODO: GtkWidget::property, signal, style
TODO: howto enable/disable : dimension, properti, cast, converte to array, debug_info ?
      ex : glist, ghashtable use dimension, cairo_rectangle do not use dimension

TODO: remove DocBook/[Cairo,Glib, Php]
TODO : Assume multiline commentHelper
TODO : Php API declared dependency : use GdkVisual; etc.
TODO: Php API generate the related object
      IDE autocompletion signal property etc...


TODO: View/C/Source/class.phtml remove enum _type_properties if{empty}

TODO: remove Zend-user API functions( use <src>/Implementations if necessary)
TODO: in _write_properties()
      add zend_std_write_() if dynamic property allowed

//- -------------------------------------------------------------

TODO: generate php API( edit manualy deref for GLib, use annotation for Gtk)
TODO: Parameter deref( see in the docbook; but for glib is not set)
TODO: Parameter variadic
TODO: Parameter is nullable
TODO: loop doc/public/cairo-docs.xml to find the entities
TODO: Php API generer le vendendor namespace

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
