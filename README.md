```
  ______              _        ______      _   
 |___  /             | |      |  ____|    | |  
    / / ___ _ __   __| |______| |__  __  _| |_ 
   / / / _ \ '_ \ / _` |______|  __| \ \/ / __|
  / /_|  __/ | | | (_| |      | |____ >  <| |_ 
 /_____\___|_| |_|\__,_|      |______/_/\_\\__|
```
# Zend-Ext
Generator of PHP extension

The `Zend\Ext` component provides tools for working with Gtk sources. Currently, we offer `Zend\Ext\CodeGenerator`, which provides a unified interface for modeling and generating C-code.

It will be used in GKT+PHP project.

# Usage
```
$] git clone Zend-Ext
$] cd zend-ext
$] composer install
$] cmd/generate-ext.sh /home/dev/php-src/ext/gtkml
$] cmd/generate-doc.sh /home/dev/php-doc/doc-en
$] cmd/generate-doc.sh /home/dev/php-doc/doc-fr
$] cmd/generate-web.sh /home/dev/php-web
```

# What it do
```
cmd/generate-ext.sh --gtk-version="[2|3|4]" /home/dev/php-src/ext/gtkml
```
It clone Gtk repository in `<zend-ext>/tmp` and it's dependency and build the documentation.
For a specific version
It store resume file in `<zend-ext>/data/<version>/enums|objects|boxed|data-structure`.

# Directory structure
```
/Models contains all file to modelize C-Code.
/Views contains all template to generate C-Code.
/Helpers contains all file to generate C-Code strategy naming.
/Services contains :
  /GtkDocSource.php (Parse documentation)
  /GlibDocSource.php
  /PangoDocSource.php
  /CairoDocSource.php
  /GtkSourceCode.php (Load C-Code library interface)
  /GlibSourceCode.php
  /SourceCode.php
```

# Known Causes of Trouble
`Zend\C\Engine\Error: identifier_list identifier not implemented on line 11`
`IDENTIFIER` is not defined, the parser switch to another rule. 
Define the unknown typedef in `<root>/data/config-glib.h`
see `<root>/tmp/declaration.h` to find the last undeclared `IDENTIFIER`

