<?php

namespace App\Views;

interface ViewInterface
{

    public function render(mixed $data): string;
}
