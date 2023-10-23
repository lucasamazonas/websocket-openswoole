<?php

declare(strict_types=1);

namespace App\Event;

interface Handler
{

    public function resolve(): void;
    
}