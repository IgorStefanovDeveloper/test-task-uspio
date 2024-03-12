<?php

namespace App\Helpers;

class EnvReader
{
    public static function readEnv(string $dotenvPath): void
    {

        if (!file_exists($dotenvPath)) {
            die('.env файл не найден');
        }

        $lines = file($dotenvPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '=') !== false && substr($line, 0, 1) !== '#') {
                list($key, $value) = explode('=', $line, 2);
                putenv("$key=$value");
            }
        }
    }
}
