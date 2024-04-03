<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;



#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: 'json', nullable: false)]
    private array $roles = [];

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $lname = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $fname = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $nickname = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deleted_at = null;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: Session::class)]
    private Collection $sessions;


    // Ajout du champ confirmPassword avec validation
    #[Assert\EqualTo(propertyPath: 'password', message: "Le mot de passe et sa confirmation doivent correspondre.")]
    #[Assert\NotBlank]
    private ?string $confirmPassword = null;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(?string $confirmPassword): static
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /* public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    } */

    public function getLname(): ?string
    {
        return $this->lname;
    }

    public function setLname(?string $lname): static
    {
        $this->lname = $lname;

        return $this;
    }

    public function getFname(): ?string
    {
        return $this->fname;
    }

    public function setFname(?string $fname): static
    {
        $this->fname = $fname;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->email;
    }

    public function setUsername(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }
    public function getCurrentDate(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
    public function setCreatedAt(?\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeImmutable $deleted_at): static
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): static
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->setIdUser($this);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getIdUser() === $this) {
                $session->setIdUser(null);
            }
        }

        return $this;
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }


    public function getSalt(): ?string
    {
        // Si vous ne stockez pas de sel, retournez null
        return null;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
