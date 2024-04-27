<?php

namespace App\Entity;

use App\Repository\PlaygroundRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaygroundRepository::class)]
class Playground
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $note = null;

    #[ORM\OneToMany(mappedBy: 'id_playground', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\OneToMany(mappedBy: 'id_playground', targetEntity: Session::class)]
    private Collection $sessions;
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?string $countUser = null;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }


    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }


    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCountUser(): ?string
    {
        return $this->countUser;
    }

    public function setCountUser(?string $countUser): static
    {
        $this->countUser = $countUser;

        return $this;
    }

    public function adduser(): static
    {
        $this->countUser += 1;
        return $this;
    }

    public function removeuser(): static
    {
        $this->countUser -= 1;
        return $this;
    }
}
