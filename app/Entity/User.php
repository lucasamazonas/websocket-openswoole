<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\{Collection, ArrayCollection};

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table('users')]
class User
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(length: 150)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'from', targetEntity: MessageServer::class)]
    private Collection $sendMessages;

    #[ORM\ManyToMany(targetEntity: MessageServer::class, mappedBy: 'to')]
    private Collection $receivedMessages;

    public function __construct()
    {
        $this->sendMessages = new ArrayCollection();
        $this->receivedMessages = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

}