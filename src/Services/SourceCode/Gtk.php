<?php

namespace Zend\Ext\Services\SourceCode;

use Zend\Ext\Services\SourceCode;
use Exception;


class Gtk extends SourceCode
{

    function __construct($source_dir=NULL, $build_dir=NULL){
        $this->doc_dir = 'docs/reference/gtk';
        $this->name = 'Gtk';
        parent::__construct($source_dir, $build_dir);
    }

    // Load the file Enum, Object, Boxed, Interface, Data structure( HashTable, GList,...)
    function loadTypes($decl) {
        // near "struct _GMarkupParser" In glib-decl.txt : /* Called for open tags <foo bar="baz"> */
        // in gdk3-decl.txt '/* Can be cast to window system specific'
        $search = array('&(v)', ' << ', '/*< ', '/* <', ' >*/', '&&', '&', ' <= ', '->', ' < ', ' > ', '_-|> <.', '<foo bar="baz">', '</foo>', '<Space> does', '<Return> does', '> */', '(1L<<0)', '(1L<<1)', '/*<private>*/');
        $replace = array('V_REF_PASS', 'SHIFT_LEFT', '/*_ ', '/* _', ' _*/', 'DOUBLE_PASS_REF', 'PASS_REF', 'GREATER_OR_EQUAL', 'SPECIAL_ARROW', ' GREATER ', ' LESSER ', 'EXCEPTIONEL', 'OPEN_TAG_FOO', 'CLOSE_TAG_FOO', '_SPACE_DOES', '_RETURN_DOES', '_ */', '_JOKE_1', '_JOKE_2', '/*_private_*/');
        $this->getDeclarations($decl, $search, $replace);

        //$constants = $this->getConstants();

    }
}

// gtk, gdk, pangocairo, pango, atk, cairo-gobject, cairo, gdk_pixbuf, gio, gobject, glib
// pkg-config -libs gtk+-3.0

// Do prerequisite
// Charge les Enums, Boxed : Gtk, Gdk, Glib, Gio, Pango...

// Gtk\DocReference



// Gtk and Gdk

// git clone https://github.com/GNOME/gtk.git
// cd gtk
// pkg-config --modversion gtk+-3.0
// 3.22.30
// git checkout tags/3.22.30 -b gtk-localhost
// export NOCONFIGURE=1
// ./autogen.sh
// mkdir ../gtk-build-doc
// cd ../gtk-build-doc
// ../gtk/configure --enable-gtk-doc

// Do it For Glib, Gio

// Do it Pango
// Do it Cairo
// Do it Atk
