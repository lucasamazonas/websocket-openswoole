<?php

declare(strict_types=1);

namespace App\Event;

use OpenSwoole\Http\Request;

class OpenHandler implements Handler
{

    public function __construct(
        private Request $request
    )
    {
    }

    public function resolve(): void
    {
//        $server->tick(1000, function() use ($server, $request) {
//            $server->push($request->fd, json_encode(["hello", time()]));
//        });
    }
}