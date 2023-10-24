<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository
{

    public function save(Message $message): void
    {
        $this->_em->persist($message);
        $this->_em->flush();
    }

}