<?php

declare(strict_types=1);

require_once 'app_configuration.php';

use App\App;
use App\EntityManagerFactory;
use App\Event\{StartEvent, OpenEvent, MessageClientEvent, RequestEvent, DisconnectEvent};
use App\EventServiceProvider;
use OpenSwoole\Http\{Request, Response};
use OpenSwoole\WebSocket\{Server, Frame};

$app = new App();
$app->setServer(new Server('0.0.0.0', (int) $_ENV['APP_PORT']));
$app->setEntityManager(EntityManagerFactory::createEntityManager());

$server = $app::getServer();

$server->on('Start', function() use ($app) {
    $event = new StartEvent($app);
    EventServiceProvider::dispatcher($event);
});

$server->on('Open', function(Server $server, Request $request) {
    $event = new OpenEvent($request);
    EventServiceProvider::dispatcher($event);
});

$server->on('Message', function(Server $server, Frame $frame) {
    $event = new MessageClientEvent($frame);
    EventServiceProvider::dispatcher($event);
});

$server->on('Request', function(Request $request, Response $response) {
    $event = new RequestEvent($request, $response);
    EventServiceProvider::dispatcher($event);
});

$server->on('Disconnect', function(Server $server, int $fd) {
    $event = new DisconnectEvent($fd);
    EventServiceProvider::dispatcher($event);
});

$server->start();
