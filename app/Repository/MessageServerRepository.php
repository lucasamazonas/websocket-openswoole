<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\MessageServer;
use Doctrine\ORM\EntityRepository;

class MessageServerRepository extends EntityRepository
{

    public function save(MessageServer $messageServer): void
    {
        $this->_em->persist($messageServer);
        $this->_em->flush();
    }

}