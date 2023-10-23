<?php

declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use App\Infra\App;
use OpenSwoole\WebSocket\{Server, Frame};
use OpenSwoole\Http\{Request, Response};
use App\Event\{
    StartHandler,
    CloseHandler,
    DisconnectHandler,
    MessageHandler,
    OpenHandler,
    RequestHandler
};

$app = new App();
$server = new Server("0.0.0.0", 9502);
$app->setServer($server);

$server->on("Start", function() use ($app) {
    $startHandler = new StartHandler($app);
    $startHandler->resolve();
});

$server->on('Open', function(Server $server, Request $request) {
    $openHandler = new OpenHandler($request);
    $openHandler->resolve();
});

$server->on('Message', function(Server $server, Frame $frame) {
    $messageHandler = new MessageHandler($frame);
    $messageHandler->resolve();
});

$server->on('Request', function(Request $request, Response $response) {
    $requestHandler = new RequestHandler($request, $response);
    $requestHandler->resolve();
});

$server->on('Close', function(Server $server, int $fd) {
    $closeHandler = new CloseHandler();
    $closeHandler->resolve();
});

$server->on('Disconnect', function(Server $server, int $fd) {
    $disconnectHandler = new DisconnectHandler();
    $disconnectHandler->resolve();
});

$server->start();
