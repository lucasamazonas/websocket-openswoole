<?php

declare(strict_types=1);

namespace App\Event;

use OpenSwoole\Http\{Request, Response};

class RequestHandler implements Handler
{

    public function __construct(
        private Request $request,
        private Response $response
    )
    {
    }

    public function resolve(): void
    {
        $this->response->end("oi");
    }
}