<?php

declare(strict_types=1);

namespace App\Event;

use App\App;
use OpenSwoole\WebSocket\Frame;

class MessageEvent implements Event
{

    public function __construct(
        public readonly Frame $frame,
    )
    {
        $app = new App();
        var_dump($app->getServer()->connections );
    }

}