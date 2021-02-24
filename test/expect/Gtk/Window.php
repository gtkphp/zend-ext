<?php

namespace Gtk;

class Window
{
    const TOPLEVEL = 0x00;
    const POPUP = 0x01;

    static function ListToplevels(): SplDoublyLinkedList {}

    function __construct(int $type=self::TOPLEVEL) {}
    function setTitle(string $title): void {}

}