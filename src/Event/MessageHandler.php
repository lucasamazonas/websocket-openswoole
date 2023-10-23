<?php

declare(strict_types=1);

namespace App\Event;

use OpenSwoole\WebSocket\Frame;

class MessageHandler implements Handler
{

    public function __construct(
        private Frame $frame,
    )
    {
    }

    public function resolve(): void
    {
//        $this->frame->fd;
    }
}