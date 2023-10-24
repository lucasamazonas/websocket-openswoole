<?php

namespace App\Listener;

use App\Event\StartEvent;

class StartListener implements Listener
{

    public function __construct(
        private readonly StartEvent $startEvent
    )
    {
    }

    public function resolve(): void
    {
        $server = $this->startEvent->app->getServer();
        echo PHP_EOL . PHP_EOL . PHP_EOL;
        echo "Open Swoole Web Socket in http://{$server->host}:{$server->port}" . PHP_EOL;
        echo PHP_EOL . PHP_EOL . PHP_EOL;
    }
}