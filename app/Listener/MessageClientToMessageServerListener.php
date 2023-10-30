<?php

declare(strict_types=1);

namespace App\Listener;

use App\App;
use App\Entity\MessageServer;
use App\Entity\MessageClient;
use App\Entity\User;
use App\Event\MessageClientEvent;
use App\Event\MessageServerEvent;
use App\EventServiceProvider;
use App\Exception\EventHasNoListenersException;
use DateTime;
use Doctrine\ORM\Exception\NotSupported;

class MessageClientToMessageServerListener implements Listener
{

    public function __construct(
        private readonly MessageClientEvent $messageEvent,
    )
    {
    }

    /**
     * @throws EventHasNoListenersException
     * @throws NotSupported
     */
    public function resolve(): void
    {
        $message = $this->messageClientToMessageServer();
        $messageServerEvent = new MessageServerEvent($message);
        EventServiceProvider::dispatcher($messageServerEvent);
    }

    /**
     * @throws NotSupported
     */
    public function messageClientToMessageServer(): MessageServer
    {
        $messageClient = new MessageClient($this->messageEvent->frame);

        $message = new MessageServer();
        $userRepository = App::getEntityManager()->getRepository(User::class);
        $message->setFrom($userRepository->find($messageClient->from));
        $toList = $userRepository->findBy(['id' => $messageClient->to]);

        foreach ($toList as $to) {
            $message->addTo($to);
        }

        $message->setContent($messageClient->content);
        $message->setCreated(new DateTime());
        return $message;
    }
}