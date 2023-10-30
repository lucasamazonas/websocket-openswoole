<?php

declare(strict_types=1);

namespace App\Listener;

use App\App;
use App\Event\DisconnectEvent;

class DisconnectListener implements Listener
{

    public function __construct(
        private readonly DisconnectEvent $disconnectEvent,
    )
    {
    }

    public function resolve(): void
    {
        $userId = App::getUserIdConnectionsFromFd($this->disconnectEvent->fd);

        echo PHP_EOL . PHP_EOL . PHP_EOL;
        var_dump($userId);
        echo PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;

        if (is_int($userId)) {
            App::removeConnection($userId);
        }
    }
}