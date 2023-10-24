<?php

namespace App\Listener;

use App\Entity\Message;
use App\Entity\User;
use App\Event\MessageEvent;
use App\Infra\EntityManagerCreator;
use App\Repository\MessageRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\NotSupported;

class MessageLogListener implements Listener
{
    private EntityManager $entityManager;

    /**
     * @throws MissingMappingDriverImplementation
     * @throws Exception
     */
    public function __construct(private readonly MessageEvent $messageEvent)
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
    }

    /**
     * @throws NotSupported
     */
    public function resolve(): void
    {
        $userRepository = $this->entityManager->getRepository(User::class);

        $message = new Message();
        $message->setFrom($userRepository->find(1));
        $message->addTo($userRepository->find(2));
        $message->setData($this->messageEvent->frame->data);

        /** @var MessageRepository $messageRepository */
        $messageRepository = $this->entityManager->getRepository(Message::class);
        $messageRepository->save($message);
    }
}