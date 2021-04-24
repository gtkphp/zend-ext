# Zend Extension
C & Php code generator from ModelGenerator

TODO: GList( type of GLib Gio)


FIXME rename Models\ClassGenerator by Models\ClassModel
FIXME refactors

        +-- src
        |   +-- Filters
        |   +-- Helpers
        |   |   +-- C
        |   |   |   +-- Header
        |   |   |   +-- Source
        |   |   |   +-- classnameHelper.php
        |   +-- Views
        |   |   +-- DocBook
        |   |   |   +-- index.tpl
        |   |   |   +-- class.tpl
        |   |   |   +-- method.tpl
        |   |   |   \-- fonction.tpl
        |   |   +-- C
        |   |   |   +-- Header
        |   |   |   |   +-- classHelper.php
        |   |   |   |   +-- classDto.php
        |   |   |   |   +-- class.tpl
        |   |   |   |   \-- ...
        |   |   |   +-- Source
        |   |   |   |   +-- classHelper.php
        |   |   |   |   +-- classDto.php
        |   |   |   |   +-- class.tpl
        |   |   |   |   \-- ...
        |   |   |   +-- classDto.php
        |   |   |   +-- license.tpl
        |   |   \-- Php
        |   |       +-- Api
        |   |       |   +-- class.tpl
        |   |       \-- Wrapper
        |   |           +-- class.tpl
        |   +-- Models
        |   |   +-- ClassModel
        |   |   |   ...
        |   |   \-- MethodModel
        |   \-- Services/
        |       +-- CodeGenerator/
        |       |   +-- C/
        |       |   |   +-- Header/
        |       |   |   |   +-- GlibGenerator.php (create Dto)
        |       |   |   |   \-- ...
        |       |   |   +-- Source/
        |       |   |   |   +-- GlibGenerator.php (create Dto)
        |       |   |   |   \-- ...
        |       |   |   +-- GlibGenerator.php (create Dto)
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
        |       +-- DocBook/
        |       |   +-- GlibDocBook
        |       |   \-- ...
        |       +--SourceCode/
        |       |   +-- GlibSourceCode
        |       |   \-- ...



FIXME: Filter\CommentHelper
 + Comment strip tag.
 + Replace reference in the document.
 -> (attendre de faire une doc php avant)

