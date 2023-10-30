<?php

declare(strict_types=1);

namespace App\Listener;

use App\App;
use App\Entity\User;
use App\Event\OpenEvent;
use Doctrine\ORM\Exception\NotSupported;

class OpenListener implements Listener
{

    public function __construct(
        private readonly OpenEvent $openEvent,
    )
    {
    }

    /**
     * @throws NotSupported
     */
    public function resolve(): void
    {
        $id = (int) $this->openEvent->request->get['id'];
        $userRepository = App::getEntityManager()->getRepository(User::class);
        $user = $userRepository->findOneBy(['id' => $id]);

        if (empty($user)) {
            App::getServer()->disconnect($this->openEvent->request->fd);
            return;
        }

        App::setConnection($this->openEvent->request->fd, $user);
    }

}