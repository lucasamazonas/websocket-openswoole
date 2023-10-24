<?php

declare(strict_types=1);

namespace App\Listener;

interface Listener
{
    public function resolve(): void;
}