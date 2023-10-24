<?php

declare(strict_types=1);

namespace App\Event;

use OpenSwoole\Http\Request;

class OpenEvent implements Event
{

    public function __construct(
        public readonly Request $request
    )
    {
    }
}