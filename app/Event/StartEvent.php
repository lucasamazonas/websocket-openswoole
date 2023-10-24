<?php

declare(strict_types=1);

namespace App\Event;

use App\App;

class StartEvent implements Event
{

    public function __construct(
        public readonly App $app,
    )
    {
    }

}