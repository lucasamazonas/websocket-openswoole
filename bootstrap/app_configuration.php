<?php

declare(strict_types=1);

use App\App;
use App\EntityManagerFactory;
use OpenSwoole\WebSocket\Server;
use Doctrine\DBAL\Types\Type;

require_once __DIR__ . '/../vendor/autoload.php';

Co::set(['hook_flags' => SWOOLE_HOOK_TCP]);

$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . "/..");
$dotenv->load();
$dotenv->required(['APP_PORT', 'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'DB_PORT']);

Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');

$app = new App();
$app->setServer(new Server('0.0.0.0', (int)$_ENV['APP_PORT']));
$app->setEntityManager(EntityManagerFactory::createEntityManager());

return $app;