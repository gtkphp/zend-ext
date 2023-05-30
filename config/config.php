<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
            => 'Zend\Db\Adapter\AdapterServiceFactory',

            'Zend\Ext\CodeSource\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'data_manager' => array(
        __DIR__ . '/../data/gnome-3.28.2/doc.xml',
    ),

    'view_manager' => array(
        // {template_path}{template_path_stack}    {template_map}{/GArray}/class.phtml
        // {Views}        {/C/Header}{/_7/_4/_3RC1}{/GLib/glib}  {/GArray}/class.phtml
        'template_path' => array(
            __DIR__ . '/../lib/Views',
        ),
        /*'template_stack' => array(
            '_[0-9]{1,2}/_[0-9]{1,2}/_[0-9]{1,2}(RC[0-9]|BETA[0-9])?',
        ),*/
        'template_path_stack' => array(
            'C/Header',
            'C/Source',
            'DocBook',
            'Php/Poo',
            'Php/Pp',
        ),
        'template_map' => array(
            'glib'       => '/Glib/GLib',
            'gio'        => '/Glib/GIo',
            'gobject'    => '/Glib/GObject',
            'gmodule'    => '/Glib/GModule',
            'gthread'    => '/GLib/GThread',
            'gtk'        => '/Gtk/Gtk',
            'gdk'        => '/Gtk/Gdk',
            'gdk_pixbuf' => '/GdkPixbuf',
            'pango'      => '/Pango',
            'Atk'        => '/Atk',
            'Cairo'      => '/Cairo',
        ),
        // src/Views/C/Header/7/4/3RC1/GLib/glib/GArray/{class.phtml}
    ),
);
