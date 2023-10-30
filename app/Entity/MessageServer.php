<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MessageServerRepository;
use Doctrine\Common\Collections\{Collection, ArrayCollection};
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MessageServerRepository::class)]
#[ORM\Table('messages')]
class MessageServer
{

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'sendMessages')]
    #[ORM\JoinColumn(name: 'usersId', referencedColumnName: 'id')]
    #[Assert\NotNull]
    private User $from;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'receivedMessages')]
    private Collection $to;

    #[ORM\Column(type: 'json')]
    private string|null $content;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank, Assert\Length(19)]
    private DateTime $created;

    public function __construct()
    {
        $this->to = new ArrayCollection();
    }

    public function getFrom(): User
    {
        return $this->from;
    }

    public function setFrom(User $from): MessageServer
    {
        $this->from = $from;
        return $this;
    }

    public function getTo(): Collection
    {
        return $this->to;
    }

    public function addTo(User $to): MessageServer
    {
        $this->to->add($to);
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): MessageServer
    {
        $this->content = $content;
        return $this;
    }

    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

}