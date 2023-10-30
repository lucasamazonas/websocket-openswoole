<?php

declare(strict_types=1);

namespace App\Listener;

use App\App;
use App\Entity\MessageServer;
use App\EntityManagerFactory;
use App\Event\MessageServerEvent;
use App\Repository\MessageServerRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\NotSupported;

class MessageLogListener implements Listener
{

    public function __construct(
        public readonly MessageServerEvent $messageServerEvent,
    )
    {
    }

    /**
     * @throws NotSupported
     */
    public function resolve(): void
    {
        /** @var MessageServerRepository $messageServerRepository */
        $messageServerRepository = App::getEntityManager()->getRepository(MessageServer::class);
        $messageServerRepository->save($this->messageServerEvent->messageServer);
    }
}