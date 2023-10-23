<?php

declare(strict_types=1);

namespace App\Event;

use App\Infra\App;

class StartHandler implements Handler
{

    public function __construct(private App $app)
    {
    }

    public function resolve(): void
    {
        echo "OpenSwoole WebSocket in {$this->app->getServer()->host}:{$this->app->getServer()->port}";
    }

}