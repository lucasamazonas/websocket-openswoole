<?php

namespace App\Listener;

interface Listener
{
    public function resolve(): void;
}