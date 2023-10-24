<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\{Collection, ArrayCollection};
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ORM\Table('messages')]
class Message
{

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'users')]
    #[ORM\JoinColumn(name: 'usersId', referencedColumnName: 'id')]
    private User $from;

    #[ORM\JoinTable(name: 'messagesToUsers')]
    #[ORM\JoinColumn(name: 'messageId', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'userId', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: User::class)]
    private Collection $to;

    #[ORM\Column(type: 'json')]
    private string $data;

    public function __construct()
    {
        $this->to = new ArrayCollection([]);
    }

    public function setFrom(User $from): Message
    {
        $this->from = $from;
        return $this;
    }

    public function addTo(User $to): Message
    {
        $this->to->add($to);
        return $this;
    }

    public function setData(string $data): Message
    {
        $this->data = $data;
        return $this;
    }

}