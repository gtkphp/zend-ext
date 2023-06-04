# Zend Extension
C & Php code generator from ModelGenerator



Step 1 generate header definition 
$ ./vendor/bin/phpunit --filter ClassGeneratorTest::testDecl ./test
Step 2 adjust definition 
$ ./vendor/bin/phpunit --filter ClassGeneratorTest::testInc ./test

then copy tmp/declaration.h -> data/<gnome>/<glib>.h

Step 10 generate macro definition and put it in data/gnome/glib.php
$ ./vendor/bin/phpunit --filter DocBookGeneratorTest::testMacro ./test

Step 11 generate ext/stub/wrapper/doc
$ ./vendor/bin/phpunit --filter DocBookGeneratorTest::testAgent ./test





TODO: fixe annotation for cairo_get_dashe()
@dashes: (array) (element-type double) (transfer none)


TODO: MethodDocBlook::isInternal
example : gtk_widget_unparent() "This function is only for use in widget implementations."
          do not export in Gtk\Widget::methods()


Models\Code
+ array_map
function ($directive, $value) {return DeclareStatement::fromArray([$directive => $value]);}
+ str_contains
false!==strstr($name, '\\')



TODO: GList( type of GLib Gio)

FIXME: Filter\CommentHelper
 + Comment strip tag.
 + Replace reference in the document.
 -> (attendre de faire une doc php avant)


FIXME put services/Extension to lib/services\CodeGenerator.php

FIXME put Models\ClassGenerator in Models\CodeGenerator\ClassGenerator
FIXME Models\Dto\ClassDto in Models\Dto\Extension\ClassDto
                             Models\Dto\Poo\ClassDto
                             Models\Dto\Pp\ClassDto
                             Models\Dto\DocBook\ClassDto
FIXME rename Models\ClassGenerator by Models\ClassModel
FIXME refactors


// version de Gnome (3.28.2 définit les versions des dépendance gtk) 
git checkout 452802-0.0.0 // Gtk+4
git checkout 302802-0.0.0 // Gtk+3


 directory structure `ImplementationResolver` :
/
|   +-- _7
|   |   +-- _0
|   |   |   +-- _0
|   +-- _8
|   |   +-- _0
|   |   |   +-- _0
|   |   |   |   +-- Cairo/
|   |   |   |   |   +-- cairo_t/
|   |   |   |   |   |   +-- class.phtml                        --- ?
|   |   |   |   +-- Gtk/
|   |   |   |   |   +-- gtk/
|   |   |   |   |   |   +-- GtkWidget/
|   |   |   |   |   |       +-- class.phtml
|   |   |   |   +-- Glib/
|   |   |   |   |   +-- gio/
|   |   |   |   |   +-- glib/
|   |   |   |   |   |   +-- GList/
|   |   |   |   |   |   +-- GArray/
|   |   |   |   |   |   |   +-- class.phtml
|   |   |   |   |   |   |   +-- class_entry/
|   |   |   |   |   |   |   |   +-- create_object.phtml
|   |   |   |   |   |   |   +-- object_handlers/
|   |   |   |   |   |   |   |   +-- free_obj.phtml
|   |   |   |   |   |   |   |   +-- dtor_obj.phtml
|   |   |   |   |   |   |   |   +-- read_property.phtml
|   |   |   |   |   |   |   |   +-- write_property.phtml
|   |   |   |   |   |   |   |   +-- cast_object.phtml
|   |   |   +-- 2
|   |   |   |   +-- Cairo/
|   |   |   |   |   +-- cairo_t/
|   |   |   |   |   |   +-- class.phtml                           ---
|   |   +-- 1
|   |   |   +-- 0
|   |   |   |   +-- Cairo/
|   |   |   |   |   +-- cairo_t/
|   |   |   |   |   |   +-- class.phtml                           priority 5 (version 8.1.0 for cairo - branch 302802)
|   |   |   +-- Cairo/
|   |   |   |   +-- cairo_t/
|   |   |   |   |   +-- class.phtml                               priority 4 (version ^8.1.* for cairo/cairo_t)
|   |   |   +-- class.phtml                                       priority 3 (version ^8.1.* all)
|   |   +-- class.phtml                                           priority 2 (version ^8.* all)
|   +-- Cairo/
|   |   +-- cairo_t/
|   |   +-- class.phtml                                           priority 1 (all version for cairo)
|   +-- Gtk/
|   +-- Glib/
\


directory structure `ImplementationExtension` :
/
|   +-- ...
|   +-- class.phtml                                               priority 0 (all)
|   +-- class_entry/
|   |   +-- create_object.phtml
|   +-- object_handlers/
|   |   +-- read_property.phtml
|   +-- method.phtml
|   \-- function.phtml
\

        +-- src
        |   +-- Filters
        |   +-- Helpers
        |   |   +-- C
        |   |   |   +-- Header
        |   |   |   +-- Source
        |   |   |   +-- classnameHelper.php
        |   +-- Controller
        |   |   +-- GenerateDoc
        |   |   +-- GenerateExt(saveAction, clearAction)
        |   |
        |   +-- Views
        |   |   +-- license.tpl
        |   |   +-- version.tpl
        |   |   +-- author.tpl
        |   |   +-- DocBook
        |   |   |   +-- ImplementationResolver/...
        |   |   |   +-- license.tpl
        |   |   |   +-- index.tpl
        |   |   |   +-- class.tpl
        |   |   |   +-- method.tpl
        |   |   |   \-- fonction.tpl
        |   |   +-- C
        |   |   |   +-- Header
        |   |   |   |   +-- ImplementationResolver/...
        |   |   |   |   +-- classHelper.php
        |   |   |   |   +-- classDto.php
        |   |   |   |   +-- class.tpl
        |   |   |   |   \-- ...
        |   |   |   +-- Source
        |   |   |   |   +-- ImplementationResolver/...
        |   |   |   |   +-- classHelper.php
        |   |   |   |   +-- classDto.php
        |   |   |   |   +-- class.tpl
        |   |   |   |   \-- ...
        |   |   |   +-- classDto.php
        |   |   |   \-- license.tpl
        |   |   |
        |   |   \-- Php
        |   |       +-- Api
        |   |       |   +-- ImplementationResolver/...
        |   |       |   +-- class.tpl
        |   |       \-- Wrapper
        |   |           +-- ImplementationResolver/...
        |   |           +-- class.tpl
        |   |
        |   +-- Models
        |   |   +-- Extension/ClassDto.php (eat CodeGenerator)
        |   |   |   ...
        |   |   \-- DocBook/MethodDto.php
        |   |

        +-- lib/
        |   \-- Services/
        |       +-- CodeGenerator.php (provide ClassGenerator)
        |       +-- CodeGenerator/ (in src/)
        |       |   +-- C/
        |       |   |   +-- Header/
        |       |   |   |   +-- GlibGenerator.php (src/CodeGenerator/GLib.php)
        |       |   |   |   \-- ...
        |       |   |   +-- Source/
        |       |   |   |   +-- GlibGenerator.php ()
        |       |   |   |   \-- ...
        |       |   |   +-- GlibGenerator.php ()
        |       |   |   \-- ...
        |       |   +-- Php/
        |       |   |   +-- Api/
        |       |   |   |   +-- GlibGenerator.php
        |       |   |   |   \-- ...
        |       |   |   \-- Wrapper/
        |       |   |       +-- GlibGenerator.php
        |       |   |       \-- ...
        |       |   \-- Xml/
        |       |       +-- GlibGenerator.php
        |       |       \-- ...


        |       +-- DocBook.php (DocBook/GnomeDocBook.php)
        |       +-- DocBook/
        |       |   +-- GLibDocBook.php (kind of )
        |       |   \-- ...


        |       +-- SourceCode.php (SourceCode\GlibSourceCode) - read glib-decl.txt == glib.h
        |       +-- SourceCode/
        |       |    +-- Glib.php (reorder export)
        |       |    +-- Gtk.php
        |       |    +-- Glib/
        |       |    |    +-- 2.56.4/
        |       |    |    |    +-- GIO.php -> SourceCode
        |       |    |    |    +-- GLib.php
        |       |    |    |    +-- GModule.php
        |       |    |    |    +-- GObject.php
        |       |    |    |    +-- GThread.php
        |       |    |    +-- .../
        |       |    |    +-- 2.76.2/
        |       |    +-- Cairo/
        |       |    |    +-- 1.15.10/
        |       |    |    |    +-- Cairo.php
        |       |    +-- Gtk/
        |       |    |    +-- 3.22.30/
        |       |    |    |    +-- Gdk.php
        |       |    |    |    +-- Gtk.php
        |       |    |    +-- 4.11.1/
        |       |    |    |    +-- Gdk.php
        |       |    |    |    +-- Gsk.php
        |       |    |    |    +-- Gtk.php
        |       |    |    \-- ...
        |       |    \-- ...
        |       \-- ...
        \-- ...

