<?php

declare(strict_types=1);

namespace App\Event;

use OpenSwoole\Http\{Request, Response};

class RequestEvent implements Event
{

    public function __construct(
        public readonly Request $request,
        public readonly Response $response
    )
    {
    }
}