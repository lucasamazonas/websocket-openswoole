<?php

namespace App\Listener;

use App\Event\OpenEvent;

class OpenListener implements Listener
{

    public function __construct(
        private OpenEvent $openEvent
    )
    {
    }

    public function resolve(): void
    {
        echo PHP_EOL . PHP_EOL . PHP_EOL;
        echo $this->openEvent->request->fd . PHP_EOL;
        echo PHP_EOL . PHP_EOL . PHP_EOL;
    }
}