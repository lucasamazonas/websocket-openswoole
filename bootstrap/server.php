<?php

declare(strict_types=1);

require_once 'app_configuration.php';

use App\Infra\App;
use OpenSwoole\WebSocket\{Server, Frame};
use OpenSwoole\Http\{Request, Response};
use App\Event\{StartEvent, CloseEvent, DisconnectEvent, MessageEvent, OpenEvent, RequestEvent};
use App\Provider\EventServiceProvider;

$app = new App();
$server = new Server('0.0.0.0', (int) $_ENV['APP_PORT']);
$app->setServer($server);

$server->on('Start', function() use ($app) {
    $event = new StartEvent($app);
    EventServiceProvider::dispatcher($event);
});

$server->on('Open', function(Server $server, Request $request) {
    $event = new OpenEvent($request);
    EventServiceProvider::dispatcher($event);
});

$server->on('Message', function(Server $server, Frame $frame) use ($app) {
    $event = new MessageEvent($frame);
    EventServiceProvider::dispatcher($event);
});

$server->on('Request', function(Request $request, Response $response) {
    $event = new RequestEvent($request, $response);
    EventServiceProvider::dispatcher($event);
});

$server->on('Close', function(Server $server, int $fd) {
    $event = new CloseEvent();
    EventServiceProvider::dispatcher($event);
});

$server->on('Disconnect', function(Server $server, int $fd) {
    $event = new DisconnectEvent();
    EventServiceProvider::dispatcher($event);
});

$server->start();
