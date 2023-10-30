<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\MessageServer;

class MessageServerEvent implements Event
{

    public function __construct(
        public readonly MessageServer $messageServer,
    )
    {
    }

}