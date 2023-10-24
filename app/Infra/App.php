<?php

declare(strict_types=1);

namespace App\Infra;

use OpenSwoole\WebSocket\Server;
use App\Exception\MultipleWebSocketSwooleServersException;

class App
{

    private static Server $server;

    public function getServer(): Server
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

}