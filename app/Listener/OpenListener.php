<?php

declare(strict_types=1);

namespace App\Listener;

use App\App;
use App\Entity\User;
use App\EntityManagerCreator;
use App\Event\OpenEvent;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\NotSupported;

class OpenListener implements Listener
{

    private EntityManager $entityManager;

    /**
     * @throws MissingMappingDriverImplementation
     * @throws Exception
     */
    public function __construct(
        private readonly OpenEvent $openEvent,
    )
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
    }

    /**
     * @throws NotSupported
     */
    public function resolve(): void
    {
        $id = (int) $this->openEvent->request->get['id'];
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['id' => $id]);

        if (empty($user)) {
            App::getServer()->disconnect($this->openEvent->request->fd);
            return;
        }

        App::setConnection($this->openEvent->request->fd, $user);
    }
}