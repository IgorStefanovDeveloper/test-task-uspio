<?php

namespace App\Controllers;

use App\Views\ViewInterface;

interface ControllerInterface
{
    public function __invoke(mixed $params);

    public function render(mixed $data): string;
}
