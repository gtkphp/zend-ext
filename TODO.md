
Where generate Php
- in docBlock type is displayed white '*' pass ref
- in docBlock description need to be display in 2 lines
- in function parameters need to specify if the parameter is nullable
- Improve parameter is pass reference( To know this, we need to reflexion an *.php API)
  
- Fixe requiredargHelper();// check Nullable argument
- Fixe maxargHelper();// return -1 if has variadic


- remove <src>/Php
- remove <src>/Helpers

- refactor Views
```
 <src>/Views
      + Helpers(P4)
      + Php<default>
         + Helpers(P3)
         + C // used for generate Php extension
            + Helpers(P2)
            + Source
               + Helpers(P1)
               - class.phtml
               - method.phtml
            + Header
               + Helpers
               - class.phtml
               - method.phtml
         + Php
            + Helpers
            + Poo// used for generate Php Wrapper POO
               + Helpers
            + Pp// used for generate Php API
               + Helpers

      + Php4_4_9  // override <default>
      + Php5_6_9  // override <default>
      + Php7_4_9  // override <default>
      + Php8_0_1  // override <default>
```