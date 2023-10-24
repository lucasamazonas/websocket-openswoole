<?php

declare(strict_types=1);

namespace App\Listener;

use App\Event\MessageEvent;

class MessageListener implements Listener
{

    public function __construct(
        private MessageEvent $messageEvent,
    )
    {
    }

    public function resolve(): void
    {
        // TODO: Implement resolve() method.
    }
}