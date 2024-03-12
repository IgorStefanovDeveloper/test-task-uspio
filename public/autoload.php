<?php

spl_autoload_register(function ($class) {
    $file = __DIR__ . '\..\src\\' . str_replace(['\\', 'App'], ['/', ''], $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

