<?php

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
        $this->requestEvent->response->header('Content-Type', 'application/json');
        $this->requestEvent->response->end();
    }
}