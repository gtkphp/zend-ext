<?php

class GtkSourceCode {
    public function prerequisite() {
        // creer les fichiers enum boxed
        // flat array() serialized
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
