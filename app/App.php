<?php

declare(strict_types=1);

namespace App;

use App\Entity\User;
use App\Exception\MultipleSingletonException;
use OpenSwoole\WebSocket\Server;
use Doctrine\ORM\EntityManager;

class App
{

    private static Server $server;

    private static EntityManager $entityManager;

    /** @var integer[] */
    private static array $connectionsClient = [];

    public static function getServer(): Server
    {
        return self::$server;
    }

    /**
     * @throws MultipleSingletonException
     */
    public function setServer(Server $server): void
    {
        if (isset(self::$server)) {
            throw new MultipleSingletonException("Esse método só deve ser chamado uma vez na inicialização do servidor.");
        }

        self::$server = $server;
    }

    public static function getEntityManager(): EntityManager
    {
        return self::$entityManager;
    }

    /**
     * @throws MultipleSingletonException
     */
    public function setEntityManager(EntityManager $entityManager): void
    {
        if (isset(self::$entityManager)) {
            throw new MultipleSingletonException("Esse método só deve ser chamado uma vez na inicialização do servidor.");
        }

        self::$entityManager = $entityManager;
    }

    public static function setConnection(int $fd, User $user): void
    {
        self::$connectionsClient[$user->getId()] = $fd;
    }

    public static function removeConnection(int $userId): void
    {
        unset(self::$connectionsClient[$userId]);
    }

    public static function getUserIdConnectionsFromFd(int $fd): ?int
    {
        $userId = array_search($fd, self::$connectionsClient);
        return is_int($userId) ? $userId : null;
    }

    public static function getConnection(User|int $user): ?int
    {
        $userId = $user instanceof User ? $user->getId() : $user;
        return self::$connectionsClient[$userId] ?? null;
    }

}