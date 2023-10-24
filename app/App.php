<?php

declare(strict_types=1);

namespace App;

use App\Entity\User;
use App\Exception\MultipleWebSocketSwooleServersException;
use OpenSwoole\WebSocket\Server;

class App
{

    private static Server $server;

    /** @var integer[] */
    private static array $mapConnections = [];

    public static function getServer(): Server
    {
        return self::$server;
    }

    /**
     * @throws MultipleWebSocketSwooleServersException
     */
    public function setServer(Server $server): void
    {
        if (isset(self::$server)) {
            throw new MultipleWebSocketSwooleServersException(
                "Esse método só deve ser chamado uma vez na inicialização do servidor");
        }

        self::$server = $server;
    }

    public static function setConnection(int $fd, User $user): void
    {
        self::$mapConnections[$user->getId()] = $fd;
    }

    public static function removeConnection(int $userId): void
    {
        unset(self::$mapConnections[$userId]);
    }

    public static function getUserIdConnectionsFromFd(int $fd): ?int
    {
        $userId = array_search($fd, self::$mapConnections);
        return is_int($userId) ? $userId : null;
    }

    public static function getConnection(User|int $user): int
    {
        $userId = $user instanceof User ? $user->getId() : $user;
        return self::$mapConnections[$userId];
    }

}