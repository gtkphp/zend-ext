Est-ce que GTK+PHP vous plait ?
Dans quel mesure GTK+PHP vous aiderais dans votre travail ?


TODO: GtkWidget::property, signal, style
TODO: Parameter deref
FIXME: revoir decl.txt, ne pas traiter struct quand empty et mettre une declaration dans data/config-glib.h

Where generate Php
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
- Refactor Services/DocBook by Services/PhpExtension
- Refactor Services/CodeGenerator by Services/Generator(C/C++, PHP5/7/8)
- Add Services/ApiCode (Php reflexion)
- ???>>>

- When C Source generator
- FIXME Assume no parameter, g_list_alloc (pas de parametre)
- FIXME Assume g-list.h

- remove <src>/Php

- Assume each php version, create global Glib API
```
 <src>/Views
      + Helpers(P4)
      + Php<default>
      + Php4_4_9  // override <default>
      + Php5_6_9  // override <default>
      + Php7_4_9  // override <default>
      + Php8_0_1  // override <default>
```