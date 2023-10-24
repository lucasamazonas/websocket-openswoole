<?php

declare(strict_types=1);

namespace App\Event;

class DisconnectEvent implements Event
{

    public function __construct(
        public readonly int $fd,
    )
    {
    }

}