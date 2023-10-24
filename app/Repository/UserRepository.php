<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    public function save(User $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

}