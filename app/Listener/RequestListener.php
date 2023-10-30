<?php

declare(strict_types=1);

namespace App\Listener;

use App\Event\RequestEvent;

class RequestListener implements Listener
{

    public function __construct(
        private readonly RequestEvent $requestEvent
    )
    {
    }

    public function resolve(): void
    {
        $this->requestEvent->response->status(404);
        $this->requestEvent->response->end("<h1>Not Found</h1>");
    }
}