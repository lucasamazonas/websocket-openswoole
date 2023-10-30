<?php

declare(strict_types=1);

namespace App\Listener;

use App\App;
use App\Event\MessageServerEvent;

class MessageListener implements Listener
{

    public function __construct(
        public readonly MessageServerEvent $messageServerEvent,
    )
    {
    }

    public function resolve(): void
    {
        $message = $this->messageServerEvent->messageServer;

        foreach ($message->getTo() as $to) {
            $fd = App::getConnection($to);

            echo PHP_EOL . PHP_EOL;
            var_dump($fd);
            echo PHP_EOL . PHP_EOL . PHP_EOL;

            if (is_null($fd)) continue;
            App::getServer()->push($fd, $message->getContent());
        }
    }
}