<?php

use Gtk\Window;

/**
 * @var Gtk\Window $dialog
 */
$dialog = Null;

/**
 * @var SplDoublyLinkedList $toplevels
 */
$toplevels = Window::ListToplevels();

/**
 * @var Gtk\Window $current
 */
$current = Null;

for ($toplevels->rewind(); $toplevels->valid(); $toplevels->next()) {
    $current = $toplevels->current()->data;
    $title = $current->getTitle();
    if ($title != Null && strstr ($title, "Mozilla Firefox") !== False) {
        break;
    } else {
        $current = Null;
    }
}

if ($current != NULL) {
    $current->setTransientFor($dialog, $current);
    $current->setPosition($dialog, Window::POS_CENTER_ON_PARENT);
} else {
    // If no parent could be found, just center in the screen
    $dialog->setPosition(Window::POS_CENTER);
}

unset($toplevels);

