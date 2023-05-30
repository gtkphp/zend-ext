Est-ce que GTK+PHP vous plait ?
Dans quel mesure GTK+PHP vous aiderais dans votre travail ?




Make patch to fixe *.xml


Zend\C\Engine\Error: Syntax error, unexpected TYPEDEF_NAME(show_help), expecting IDENTIFIER or '(' on line 3035 on unknown line

gio-2.56.4.h:typedef void (*show_help) (GOptionContext *context, const char     *message);
gtk-3.22.30.h:  gboolean (* show_help)           (GtkWidget          *widget,

union _GDoubleIEEE754; est déclaré deux fois et inversement définie


TODO: generalize "// Description :"
TODO: Version #if CAIRO_VERSIO >= 11600 (getTagSince '1.16' to int)
TODO: Since, Deprecate, Stability
TODO: Comment surcharger les fonctions PHP_FUNCTION(__construct)
       zif_cairo_path_data_t___construct
TODO: Refactor src/Implementation
               src/Implementation/Cairo/Path.php
TODO: 
diff -b ~/Projects/gtkphp/php-src/ext/gtk/php_cairo/path.c ~/Projets/zend-ext/output/php_cairo/path.c


TODO :
cairo/doc/public/html/cairo-cairo-font-face-t.html
"The font is of type Quartz (Since: 1.6, in 1.2 and 1.4 it was named CAIRO_FONT_TYPE_ATSUI)"
Reformater la documentation avec les annotation Since


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



Package(gtkml):Object {
  description: "GTK Markup Language: "
  count(symbol): 51
  subpackage: [
    Package(cairo):Object {
      description: "Cairo: A Vector Graphics Library"
      count(symbol): 51
      parent: gtkml
      isModule: true
      subpackage: [
        Package(cairo-drawing):Object {
          description: "Drawing"
          count(symbol): 0
          parent: cairo
          children: [
            File(cairo.xml):Object {
              master : Struct(cairo_t):Object {
                related : [
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
                    related : [
                      Function(cairo_rectangle_list_destroy):Object {}
                    ]
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
                  Function(cairo_copy_path):Object {}
                  Function(cairo_copy_path_flat):Object {}
                  Function(cairo_append_path):Object {}
                  Function(cairo_has_current_point):Object {}
                  Function(cairo_get_current_point):Object {}
-                 Function(cairo_new_path):Object {}
-                 Function(cairo_new_sub_path):Object {}
-                 Function(cairo_close_path):Object {}
-                 Function(cairo_arc):Object {}
-                 Function(cairo_arc_negative):Object {}
-                 Function(cairo_curve_to):Object {}
-                 Function(cairo_line_to):Object {}
-                 Function(cairo_move_to):Object {}
                  Function(cairo_rectangle):Object {}
                  Function(cairo_glyph_path):Object {}
                  Function(cairo_text_path):Object {}
                  Function(cairo_rel_curve_to):Object {}
                  Function(cairo_rel_line_to):Object {}
                  Function(cairo_rel_move_to):Object {}
                  Function(cairo_path_extents):Object {}
+                 Function(cairo_translate):Object {}
+                 Function(cairo_scale):Object {}
+                 Function(cairo_rotate):Object {}
+                 Function(cairo_transform):Object {}
+                 Function(cairo_set_matrix):Object {}
                  Function(cairo_get_matrix):Object {}
                  Function(cairo_identity_matrix):Object {}
                  Function(cairo_user_to_device):Object {}
                  Function(cairo_user_to_device_distance):Object {}
                  Function(cairo_device_to_user):Object {}
                  Function(cairo_device_to_user_distance):Object {}
                  Function(cairo_select_font_face):Object {}
                  Function(cairo_set_font_size):Object {}
                  Function(cairo_set_font_matrix):Object {}
                  Function(cairo_get_font_matrix):Object {}
                  Function(cairo_set_font_options):Object {}
                  Function(cairo_get_font_options):Object {}
                  Function(cairo_set_font_face):Object {}
                  Function(cairo_get_font_face):Object {}
                  Function(cairo_set_scaled_font):Object {}
                  Function(cairo_get_scaled_font):Object {}
                  Function(cairo_show_text):Object {}
                  Function(cairo_show_glyphs):Object {}
                  Function(cairo_show_text_glyphs):Object {}
                  Function(cairo_font_extents):Object {}
                  Function(cairo_text_extents):Object {}
                  Function(cairo_glyph_extents):Object {}
                  Function(cairo_tag_begin):Object {}
                  Function(cairo_tag_end):Object {}
                ]
              }
              children : [
              ]
            }
            File(cairo-paths.xml):Object {
              master : Struct(cairo_path_t):Object {
                status (cairo_status_t);
                data (cairo_path_data_t);
                num_data (int);
                related : [
                  Union(cairo_path_data_t):Object {
                    header (@anonymous#0);
                    point (@anonymous#1);
                    children : [
                      Struct(@anonymous#0):Object {
                        type (cairo_path_data_type_t);
                        length (int);
                      }
                      Struct(@anonymous#1):Object {
                        x (double);
                        y (double);
                      }
                    ]
                  }
                  Enum(cairo_path_data_type_t):Object {
                    CAIRO_PATH_MOVE_TO (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_PATH_LINE_TO (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_PATH_CURVE_TO (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_PATH_CLOSE_PATH (Zend\Ext\Models\ConstantGenerator);
                  }
                  Function(cairo_path_destroy):Object {}
                ]
              }
              children : [
              ]
            }
            File(cairo-pattern.xml):Object {
              master : Struct(cairo_pattern_t):Object {
                related : [
                  Enum(cairo_extend_t):Object {
                    CAIRO_EXTEND_NONE (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_EXTEND_REPEAT (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_EXTEND_REFLECT (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_EXTEND_PAD (Zend\Ext\Models\ConstantGenerator);
                  }
                  Enum(cairo_filter_t):Object {
                    CAIRO_FILTER_FAST (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FILTER_GOOD (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FILTER_BEST (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FILTER_NEAREST (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FILTER_BILINEAR (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FILTER_GAUSSIAN (Zend\Ext\Models\ConstantGenerator);
                  }
                  Enum(cairo_pattern_type_t):Object {
                    CAIRO_PATTERN_TYPE_SOLID (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_PATTERN_TYPE_SURFACE (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_PATTERN_TYPE_LINEAR (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_PATTERN_TYPE_RADIAL (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_PATTERN_TYPE_MESH (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_PATTERN_TYPE_RASTER_SOURCE (Zend\Ext\Models\ConstantGenerator);
                  }
                  Function(cairo_pattern_add_color_stop_rgb):Object {}
                  Function(cairo_pattern_add_color_stop_rgba):Object {}
                  Function(cairo_pattern_get_color_stop_count):Object {}
                  Function(cairo_pattern_get_color_stop_rgba):Object {}
                  Function(cairo_pattern_create_rgb):Object {}
                  Function(cairo_pattern_create_rgba):Object {}
                  Function(cairo_pattern_get_rgba):Object {}
                  Function(cairo_pattern_create_for_surface):Object {}
                  Function(cairo_pattern_get_surface):Object {}
                  Function(cairo_pattern_create_linear):Object {}
                  Function(cairo_pattern_get_linear_points):Object {}
                  Function(cairo_pattern_create_radial):Object {}
                  Function(cairo_pattern_get_radial_circles):Object {}
                  Function(cairo_pattern_create_mesh):Object {}
                  Function(cairo_mesh_pattern_begin_patch):Object {}
                  Function(cairo_mesh_pattern_end_patch):Object {}
                  Function(cairo_mesh_pattern_move_to):Object {}
                  Function(cairo_mesh_pattern_line_to):Object {}
                  Function(cairo_mesh_pattern_curve_to):Object {}
                  Function(cairo_mesh_pattern_set_control_point):Object {}
                  Function(cairo_mesh_pattern_set_corner_color_rgb):Object {}
                  Function(cairo_mesh_pattern_set_corner_color_rgba):Object {}
                  Function(cairo_mesh_pattern_get_patch_count):Object {}
                  Function(cairo_mesh_pattern_get_path):Object {}
                  Function(cairo_mesh_pattern_get_control_point):Object {}
                  Function(cairo_mesh_pattern_get_corner_color_rgba):Object {}
                  Function(cairo_pattern_reference):Object {}
                  Function(cairo_pattern_destroy):Object {}
                  Function(cairo_pattern_status):Object {}
                  Function(cairo_pattern_set_extend):Object {}
                  Function(cairo_pattern_get_extend):Object {}
                  Function(cairo_pattern_set_filter):Object {}
                  Function(cairo_pattern_get_filter):Object {}
                  Function(cairo_pattern_set_matrix):Object {}
                  Function(cairo_pattern_get_matrix):Object {}
                  Function(cairo_pattern_get_type):Object {}
                  Function(cairo_pattern_get_reference_count):Object {}
                  Function(cairo_pattern_set_user_data):Object {}
                  Function(cairo_pattern_get_user_data):Object {}
                  Function(cairo_pattern_create_raster_source):Object {}
                  Function(cairo_raster_source_pattern_set_callback_data):Object {}
                  Function(cairo_raster_source_pattern_get_callback_data):Object {}
                  Function(cairo_raster_source_pattern_set_acquire):Object {}
                  Function(cairo_raster_source_pattern_get_acquire):Object {}
                  Function(cairo_raster_source_pattern_set_snapshot):Object {}
                  Function(cairo_raster_source_pattern_get_snapshot):Object {}
                  Function(cairo_raster_source_pattern_set_copy):Object {}
                  Function(cairo_raster_source_pattern_get_copy):Object {}
                  Function(cairo_raster_source_pattern_set_finish):Object {}
                  Function(cairo_raster_source_pattern_get_finish):Object {}
                ]
              }
              children : [
              ]
            }
            File(cairo-region.xml):Object {
              master : Struct(cairo_region_t):Object {
                related : [
                  Enum(cairo_region_overlap_t):Object {
                    CAIRO_REGION_OVERLAP_IN (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_REGION_OVERLAP_OUT (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_REGION_OVERLAP_PART (Zend\Ext\Models\ConstantGenerator);
                  }
                  Function(cairo_region_create):Object {}
                  Function(cairo_region_create_rectangle):Object {}
                  Function(cairo_region_create_rectangles):Object {}
                  Function(cairo_region_copy):Object {}
                  Function(cairo_region_reference):Object {}
                  Function(cairo_region_destroy):Object {}
                  Function(cairo_region_status):Object {}
                  Function(cairo_region_get_extents):Object {}
                  Function(cairo_region_num_rectangles):Object {}
                  Function(cairo_region_get_rectangle):Object {}
                  Function(cairo_region_is_empty):Object {}
                  Function(cairo_region_contains_point):Object {}
                  Function(cairo_region_contains_rectangle):Object {}
                  Function(cairo_region_equal):Object {}
                  Function(cairo_region_translate):Object {}
                  Function(cairo_region_intersect):Object {}
                  Function(cairo_region_intersect_rectangle):Object {}
                  Function(cairo_region_subtract):Object {}
                  Function(cairo_region_subtract_rectangle):Object {}
                  Function(cairo_region_union):Object {}
                  Function(cairo_region_union_rectangle):Object {}
                  Function(cairo_region_xor):Object {}
                  Function(cairo_region_xor_rectangle):Object {}
                ]
              }
              children : [
              ]
            }
            File(cairo-transforms.xml):Object {
              children : [
              ]
            }
            File(cairo-text.xml):Object {
              master : Struct(cairo_glyph_t):Object {
                index (long);
                x (double);
                y (double);
                related : [
                  Enum(cairo_font_slant_t):Object {
                    CAIRO_FONT_SLANT_NORMAL (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FONT_SLANT_ITALIC (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FONT_SLANT_OBLIQUE (Zend\Ext\Models\ConstantGenerator);
                  }
                  Enum(cairo_font_weight_t):Object {
                    CAIRO_FONT_WEIGHT_NORMAL (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FONT_WEIGHT_BOLD (Zend\Ext\Models\ConstantGenerator);
                  }
                  Struct(cairo_text_cluster_t):Object {
                    num_bytes (int);
                    num_glyphs (int);
                    related : [
                      Function(cairo_text_cluster_allocate):Object {}
                      Function(cairo_text_cluster_free):Object {}
                    ]
                  }
                  Enum(cairo_text_cluster_flags_t):Object {
                    CAIRO_TEXT_CLUSTER_FLAG_BACKWARD (Zend\Ext\Models\ConstantGenerator);
                  }
                  Function(cairo_glyph_allocate):Object {}
                  Function(cairo_glyph_free):Object {}
                ]
              }
              children : [
              ]
            }
            File(cairo-raster-source.xml):Object {
              children : [
              ]
            }
            File(cairo-tag.xml):Object {
              children : [
              ]
            }
          ]
        }
        Package(cairo-fonts):Object {
          description: "Fonts"
          count(symbol): 0
          parent: cairo
          children: [
            File(cairo-font-face.xml):Object {
              master : Struct(cairo_font_face_t):Object {
                related : [
                  Enum(cairo_font_type_t):Object {
                    CAIRO_FONT_TYPE_TOY (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FONT_TYPE_FT (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FONT_TYPE_WIN32 (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FONT_TYPE_QUARTZ (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_FONT_TYPE_USER (Zend\Ext\Models\ConstantGenerator);
                  }
                  Function(cairo_toy_font_face_create):Object {}
                  Function(cairo_toy_font_face_get_family):Object {}
                  Function(cairo_toy_font_face_get_slant):Object {}
                  Function(cairo_toy_font_face_get_weight):Object {}
                  Function(cairo_font_face_reference):Object {}
                  Function(cairo_font_face_destroy):Object {}
                  Function(cairo_font_face_status):Object {}
                  Function(cairo_font_face_get_type):Object {}
                  Function(cairo_font_face_get_reference_count):Object {}
                  Function(cairo_font_face_set_user_data):Object {}
                  Function(cairo_font_face_get_user_data):Object {}
                  Function(cairo_scaled_font_create):Object {}
                  Function(cairo_ft_font_face_create_for_ft_face):Object {}
                  Function(cairo_ft_font_face_create_for_pattern):Object {}
                  Function(cairo_ft_font_face_get_synthesize):Object {}
                  Function(cairo_ft_font_face_set_synthesize):Object {}
                  Function(cairo_ft_font_face_unset_synthesize):Object {}
                  Function(cairo_win32_font_face_create_for_logfontw):Object {}
                  Function(cairo_win32_font_face_create_for_hfont):Object {}
                  Function(cairo_win32_font_face_create_for_logfontw_hfont):Object {}
                  Function(cairo_user_font_face_create):Object {}
                  Function(cairo_user_font_face_set_init_func):Object {}
                  Function(cairo_user_font_face_get_init_func):Object {}
                  Function(cairo_user_font_face_set_render_glyph_func):Object {}
                  Function(cairo_user_font_face_get_render_glyph_func):Object {}
                  Function(cairo_user_font_face_set_unicode_to_glyph_func):Object {}
                  Function(cairo_user_font_face_get_unicode_to_glyph_func):Object {}
                  Function(cairo_user_font_face_set_text_to_glyphs_func):Object {}
                  Function(cairo_user_font_face_get_text_to_glyphs_func):Object {}
                ]
              }
              children : [
              ]
            }
            File(cairo-scaled-font.xml):Object {
              master : Struct(cairo_scaled_font_t):Object {
                related : [
                  Struct(cairo_font_extents_t):Object { }
                  Struct(cairo_text_extents_t):Object { }
                  Function(cairo_scaled_font_reference):Object {}
                  Function(cairo_scaled_font_destroy):Object {}
                  Function(cairo_scaled_font_status):Object {}
                  Function(cairo_scaled_font_extents):Object {}
                  Function(cairo_scaled_font_text_extents):Object {}
                  Function(cairo_scaled_font_glyph_extents):Object {}
                  Function(cairo_scaled_font_text_to_glyphs):Object {}
                  Function(cairo_scaled_font_get_font_face):Object {}
                  Function(cairo_scaled_font_get_font_options):Object {}
                  Function(cairo_scaled_font_get_font_matrix):Object {}
                  Function(cairo_scaled_font_get_ctm):Object {}
                  Function(cairo_scaled_font_get_scale_matrix):Object {}
                  Function(cairo_scaled_font_get_type):Object {}
                  Function(cairo_scaled_font_get_reference_count):Object {}
                  Function(cairo_scaled_font_set_user_data):Object {}
                  Function(cairo_scaled_font_get_user_data):Object {}
                  Function(cairo_ft_scaled_font_lock_face):Object {}
                  Function(cairo_ft_scaled_font_unlock_face):Object {}
                  Function(cairo_win32_scaled_font_select_font):Object {}
                  Function(cairo_win32_scaled_font_done_font):Object {}
                  Function(cairo_win32_scaled_font_get_metrics_factor):Object {}
                  Function(cairo_win32_scaled_font_get_logical_to_device):Object {}
                  Function(cairo_win32_scaled_font_get_device_to_logical):Object {}
                ]
              }
              children : [
              ]
            }
            File(cairo-font-options.xml):Object {
              master : Struct(cairo_font_options_t):Object {
                related : [
                  Enum(cairo_subpixel_order_t):Object {
                    CAIRO_SUBPIXEL_ORDER_DEFAULT (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_SUBPIXEL_ORDER_RGB (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_SUBPIXEL_ORDER_BGR (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_SUBPIXEL_ORDER_VRGB (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_SUBPIXEL_ORDER_VBGR (Zend\Ext\Models\ConstantGenerator);
                  }
                  Enum(cairo_hint_style_t):Object {
                    CAIRO_HINT_STYLE_DEFAULT (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_HINT_STYLE_NONE (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_HINT_STYLE_SLIGHT (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_HINT_STYLE_MEDIUM (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_HINT_STYLE_FULL (Zend\Ext\Models\ConstantGenerator);
                  }
                  Enum(cairo_hint_metrics_t):Object {
                    CAIRO_HINT_METRICS_DEFAULT (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_HINT_METRICS_OFF (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_HINT_METRICS_ON (Zend\Ext\Models\ConstantGenerator);
                  }
                  Function(cairo_font_options_create):Object {}
                  Function(cairo_font_options_copy):Object {}
                  Function(cairo_font_options_destroy):Object {}
                  Function(cairo_font_options_status):Object {}
                  Function(cairo_font_options_merge):Object {}
                  Function(cairo_font_options_hash):Object {}
                  Function(cairo_font_options_equal):Object {}
                  Function(cairo_font_options_set_antialias):Object {}
                  Function(cairo_font_options_get_antialias):Object {}
                  Function(cairo_font_options_set_subpixel_order):Object {}
                  Function(cairo_font_options_get_subpixel_order):Object {}
                  Function(cairo_font_options_set_hint_style):Object {}
                  Function(cairo_font_options_get_hint_style):Object {}
                  Function(cairo_font_options_set_hint_metrics):Object {}
                  Function(cairo_font_options_get_hint_metrics):Object {}
                  Function(cairo_font_options_get_variations):Object {}
                  Function(cairo_font_options_set_variations):Object {}
                  Function(cairo_ft_font_options_substitute):Object {}
                ]
              }
              children : [
              ]
            }
            File(cairo-ft.xml):Object {
              children : [
                Enum(cairo_ft_synthesize_t):Object {
                  CAIRO_FT_SYNTHESIZE_BOLD (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_FT_SYNTHESIZE_OBLIQUE (Zend\Ext\Models\ConstantGenerator);
                }
              ]
            }
            File(cairo-win32-fonts.xml):Object {
              children : [
              ]
            }
            File(cairo-user-fonts.xml):Object {
              children : [
              ]
            }
          ]
        }
        Package(cairo-surfaces):Object {
          description: "Surfaces"
          count(symbol): 0
          parent: cairo
          children: [
            File(cairo-device.xml):Object {
              master : Struct(cairo_device_t):Object {
                related : [
                  Enum(cairo_device_type_t):Object {
                    CAIRO_DEVICE_TYPE_DRM (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_DEVICE_TYPE_GL (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_DEVICE_TYPE_SCRIPT (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_DEVICE_TYPE_XCB (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_DEVICE_TYPE_XLIB (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_DEVICE_TYPE_XML (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_DEVICE_TYPE_COGL (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_DEVICE_TYPE_WIN32 (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_DEVICE_TYPE_INVALID (Zend\Ext\Models\ConstantGenerator);
                  }
                  Function(cairo_device_reference):Object {}
                  Function(cairo_device_destroy):Object {}
                  Function(cairo_device_status):Object {}
                  Function(cairo_device_finish):Object {}
                  Function(cairo_device_flush):Object {}
                  Function(cairo_device_get_type):Object {}
                  Function(cairo_device_get_reference_count):Object {}
                  Function(cairo_device_set_user_data):Object {}
                  Function(cairo_device_get_user_data):Object {}
                  Function(cairo_device_acquire):Object {}
                  Function(cairo_device_release):Object {}
                  Function(cairo_device_observer_elapsed):Object {}
                  Function(cairo_device_observer_fill_elapsed):Object {}
                  Function(cairo_device_observer_glyphs_elapsed):Object {}
                  Function(cairo_device_observer_mask_elapsed):Object {}
                  Function(cairo_device_observer_paint_elapsed):Object {}
                  Function(cairo_device_observer_print):Object {}
                  Function(cairo_device_observer_stroke_elapsed):Object {}
                  Function(cairo_xcb_device_get_connection):Object {}
                  Function(cairo_xcb_device_debug_cap_xrender_version):Object {}
                  Function(cairo_xcb_device_debug_cap_xshm_version):Object {}
                  Function(cairo_xcb_device_debug_get_precision):Object {}
                  Function(cairo_xcb_device_debug_set_precision):Object {}
                  Function(cairo_xlib_device_debug_cap_xrender_version):Object {}
                  Function(cairo_xlib_device_debug_get_precision):Object {}
                  Function(cairo_xlib_device_debug_set_precision):Object {}
                  Function(cairo_script_from_recording_surface):Object {}
                  Function(cairo_script_get_mode):Object {}
                  Function(cairo_script_set_mode):Object {}
                  Function(cairo_script_surface_create):Object {}
                  Function(cairo_script_surface_create_for_target):Object {}
                  Function(cairo_script_write_comment):Object {}
                ]
              }
              children : [
              ]
            }
            File(cairo-surface.xml):Object {
              master : Struct(cairo_surface_t):Object {
                related : [
                  Enum(cairo_content_t):Object {
                    CAIRO_CONTENT_COLOR (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_CONTENT_ALPHA (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_CONTENT_COLOR_ALPHA (Zend\Ext\Models\ConstantGenerator);
                  }
                  Enum(cairo_surface_type_t):Object {
                    CAIRO_SURFACE_TYPE_IMAGE (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_SURFACE_TYPE_PDF (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_SURFACE_TYPE_PS (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_SURFACE_TYPE_SUBSURFACE (Zend\Ext\Models\ConstantGenerator);
                    CAIRO_SURFACE_TYPE_COGL (Zend\Ext\Models\ConstantGenerator);
                  }
                  Function(cairo_surface_create_similar):Object {}
                  Function(cairo_surface_create_similar_image):Object {}
                  Function(cairo_surface_create_for_rectangle):Object {}
                  Function(cairo_surface_reference):Object {}
                  Function(cairo_surface_destroy):Object {}
                  Function(cairo_surface_status):Object {}
                  Function(cairo_surface_finish):Object {}
                  Function(cairo_surface_flush):Object {}
                  Function(cairo_surface_get_device):Object {}
                  Function(cairo_surface_get_font_options):Object {}
                  Function(cairo_surface_get_content):Object {}
                  Function(cairo_surface_mark_dirty):Object {}
                  Function(cairo_surface_mark_dirty_rectangle):Object {}
                  Function(cairo_surface_set_device_offset):Object {}
                  Function(cairo_surface_get_device_offset):Object {}
                  Function(cairo_surface_get_device_scale):Object {}
                  Function(cairo_surface_set_device_scale):Object {}
                  Function(cairo_surface_set_fallback_resolution):Object {}
                  Function(cairo_surface_get_fallback_resolution):Object {}
                  Function(cairo_surface_get_type):Object {}
                  Function(cairo_surface_get_reference_count):Object {}
                  Function(cairo_surface_set_user_data):Object {}
                  Function(cairo_surface_get_user_data):Object {}
                  Function(cairo_surface_copy_page):Object {}
                  Function(cairo_surface_show_page):Object {}
                  Function(cairo_surface_has_show_text_glyphs):Object {}
                  Function(cairo_surface_set_mime_data):Object {}
                  Function(cairo_surface_get_mime_data):Object {}
                  Function(cairo_surface_supports_mime_type):Object {}
                  Function(cairo_surface_map_to_image):Object {}
                  Function(cairo_surface_unmap_image):Object {}
                  Function(cairo_image_surface_create):Object {}
                  Function(cairo_image_surface_create_for_data):Object {}
                  Function(cairo_image_surface_get_data):Object {}
                  Function(cairo_image_surface_get_format):Object {}
                  Function(cairo_image_surface_get_width):Object {}
                  Function(cairo_image_surface_get_height):Object {}
                  Function(cairo_image_surface_get_stride):Object {}
                  Function(cairo_pdf_surface_create):Object {}
                  Function(cairo_pdf_surface_create_for_stream):Object {}
                  Function(cairo_pdf_surface_restrict_to_version):Object {}
                  Function(cairo_pdf_get_versions):Object {}
                  Function(cairo_pdf_version_to_string):Object {}
                  Function(cairo_pdf_surface_set_size):Object {}
                  Function(cairo_pdf_surface_add_outline):Object {}
                  Function(cairo_pdf_surface_set_metadata):Object {}
                  Function(cairo_pdf_surface_set_page_label):Object {}
                  Function(cairo_pdf_surface_set_thumbnail_size):Object {}
                  Function(cairo_image_surface_create_from_png):Object {}
                  Function(cairo_image_surface_create_from_png_stream):Object {}
                  Function(cairo_surface_write_to_png):Object {}
                  Function(cairo_surface_write_to_png_stream):Object {}
                  Function(cairo_ps_surface_create):Object {}
                  Function(cairo_ps_surface_create_for_stream):Object {}
                  Function(cairo_ps_surface_restrict_to_level):Object {}
                  Function(cairo_ps_get_levels):Object {}
                  Function(cairo_ps_level_to_string):Object {}
                  Function(cairo_ps_surface_set_eps):Object {}
                  Function(cairo_ps_surface_get_eps):Object {}
                  Function(cairo_ps_surface_set_size):Object {}
                  Function(cairo_ps_surface_dsc_begin_setup):Object {}
                  Function(cairo_ps_surface_dsc_begin_page_setup):Object {}
                  Function(cairo_ps_surface_dsc_comment):Object {}
                  Function(cairo_recording_surface_create):Object {}
                  Function(cairo_recording_surface_ink_extents):Object {}
                  Function(cairo_recording_surface_get_extents):Object {}
                  Function(cairo_win32_surface_create):Object {}
                  Function(cairo_win32_surface_create_with_dib):Object {}
                  Function(cairo_win32_surface_create_with_ddb):Object {}
                  Function(cairo_win32_surface_create_with_format):Object {}
                  Function(cairo_win32_printing_surface_create):Object {}
                  Function(cairo_win32_surface_get_dc):Object {}
                  Function(cairo_win32_surface_get_image):Object {}
                  Function(cairo_svg_surface_create):Object {}
                  Function(cairo_svg_surface_create_for_stream):Object {}
                  Function(cairo_svg_surface_get_document_unit):Object {}
                  Function(cairo_svg_surface_set_document_unit):Object {}
                  Function(cairo_svg_surface_restrict_to_version):Object {}
                  Function(cairo_svg_get_versions):Object {}
                  Function(cairo_svg_version_to_string):Object {}
                  Function(cairo_quartz_surface_create):Object {}
                  Function(cairo_quartz_surface_create_for_cg_context):Object {}
                  Function(cairo_quartz_surface_get_cg_context):Object {}
                  Function(cairo_xcb_surface_create):Object {}
                  Function(cairo_xcb_surface_create_for_bitmap):Object {}
                  Function(cairo_xcb_surface_create_with_xrender_format):Object {}
                  Function(cairo_xcb_surface_set_size):Object {}
                  Function(cairo_xcb_surface_set_drawable):Object {}
                  Function(cairo_xlib_surface_create):Object {}
                  Function(cairo_xlib_surface_create_for_bitmap):Object {}
                  Function(cairo_xlib_surface_set_size):Object {}
                  Function(cairo_xlib_surface_get_display):Object {}
                  Function(cairo_xlib_surface_get_screen):Object {}
                  Function(cairo_xlib_surface_set_drawable):Object {}
                  Function(cairo_xlib_surface_get_drawable):Object {}
                  Function(cairo_xlib_surface_get_visual):Object {}
                  Function(cairo_xlib_surface_get_width):Object {}
                  Function(cairo_xlib_surface_get_height):Object {}
                  Function(cairo_xlib_surface_get_depth):Object {}
                  Function(cairo_xlib_surface_create_with_xrender_format):Object {}
                  Function(cairo_xlib_surface_get_xrender_format):Object {}
                  Function(cairo_script_create):Object {}
                  Function(cairo_script_create_for_stream):Object {}
                ]
              }
              children : [
              ]
            }
            File(cairo-image.xml):Object {
              children : [
                Enum(cairo_format_t):Object {
                  CAIRO_FORMAT_INVALID (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_FORMAT_ARGB32 (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_FORMAT_RGB24 (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_FORMAT_A8 (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_FORMAT_A1 (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_FORMAT_RGB16_565 (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_FORMAT_RGB30 (Zend\Ext\Models\ConstantGenerator);
                  related : [
                    Function(cairo_format_stride_for_width):Object {}
                  ]
                }
              ]
            }
            File(cairo-pdf.xml):Object {
              children : [
                Enum(cairo_pdf_outline_flags_t):Object {
                  CAIRO_PDF_OUTLINE_FLAG_OPEN (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_PDF_OUTLINE_FLAG_BOLD (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_PDF_OUTLINE_FLAG_ITALIC (Zend\Ext\Models\ConstantGenerator);
                }
                Enum(cairo_pdf_metadata_t):Object {
                  CAIRO_PDF_METADATA_TITLE (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_PDF_METADATA_AUTHOR (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_PDF_METADATA_SUBJECT (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_PDF_METADATA_KEYWORDS (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_PDF_METADATA_CREATOR (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_PDF_METADATA_CREATE_DATE (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_PDF_METADATA_MOD_DATE (Zend\Ext\Models\ConstantGenerator);
                }
                Enum(cairo_pdf_version_t):Object {
                  CAIRO_PDF_VERSION_1_4 (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_PDF_VERSION_1_5 (Zend\Ext\Models\ConstantGenerator);
                }
              ]
            }
            File(cairo-png.xml):Object {
              children : [
              ]
            }
            File(cairo-ps.xml):Object {
              children : [
                Enum(cairo_ps_level_t):Object {
                  CAIRO_PS_LEVEL_2 (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_PS_LEVEL_3 (Zend\Ext\Models\ConstantGenerator);
                }
              ]
            }
            File(cairo-recording.xml):Object {
              children : [
              ]
            }
            File(cairo-win32.xml):Object {
              children : [
              ]
            }
            File(cairo-svg.xml):Object {
              children : [
                Enum(cairo_svg_version_t):Object {
                  CAIRO_SVG_VERSION_1_1 (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SVG_VERSION_1_2 (Zend\Ext\Models\ConstantGenerator);
                }
                Enum(cairo_svg_unit_t):Object {
                  CAIRO_SVG_UNIT_USER (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SVG_UNIT_EM (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SVG_UNIT_EX (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SVG_UNIT_PX (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SVG_UNIT_IN (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SVG_UNIT_CM (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SVG_UNIT_MM (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SVG_UNIT_PT (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SVG_UNIT_PC (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SVG_UNIT_PERCENT (Zend\Ext\Models\ConstantGenerator);
                }
              ]
            }
            File(cairo-quartz.xml):Object {
              children : [
              ]
            }
            File(cairo-xcb.xml):Object {
              children : [
              ]
            }
            File(cairo-xlib.xml):Object {
              children : [
              ]
            }
            File(cairo-xlib-xrender.xml):Object {
              children : [
              ]
            }
            File(cairo-script.xml):Object {
              children : [
                Enum(cairo_script_mode_t):Object {
                  CAIRO_SCRIPT_MODE_ASCII (Zend\Ext\Models\ConstantGenerator);
                  CAIRO_SCRIPT_MODE_BINARY (Zend\Ext\Models\ConstantGenerator);
                }
              ]
            }
          ]
        }
        Package(cairo-support):Object {
          description: "Utilities"
          count(symbol): 0
          parent: cairo
          children: [
            File(cairo-matrix.xml):Object {
              master : Struct(cairo_matrix_t):Object {
                related : [
                  Function(cairo_matrix_init):Object {}
                  Function(cairo_matrix_init_identity):Object {}
                  Function(cairo_matrix_init_translate):Object {}
                  Function(cairo_matrix_init_scale):Object {}
                  Function(cairo_matrix_init_rotate):Object {}
                  Function(cairo_matrix_translate):Object {}
                  Function(cairo_matrix_scale):Object {}
                  Function(cairo_matrix_rotate):Object {}
                  Function(cairo_matrix_invert):Object {}
                  Function(cairo_matrix_multiply):Object {}
                  Function(cairo_matrix_transform_distance):Object {}
                  Function(cairo_matrix_transform_point):Object {}
                ]
              }
              children : []
            }
            File(cairo-status.xml):Object {
              master : Enum(cairo_status_t):Object {
                CAIRO_STATUS_SUCCESS (Zend\Ext\Models\ConstantGenerator);
                CAIRO_STATUS_TAG_ERROR (Zend\Ext\Models\ConstantGenerator);
                CAIRO_STATUS_LAST_STATUS (Zend\Ext\Models\ConstantGenerator);
                related : [
                  Function(cairo_status_to_string):Object {}
                  Function(cairo_debug_reset_static_data):Object {}
                ]
              }
              children : []
            }
            File(cairo-types.xml):Object {
              children : [
                Struct(cairo_user_data_key_t):Object {}
                Struct(cairo_rectangle_int_t):Object {}
              ]
            }
          ]
        }
      ]
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
