<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pictureUrl = null;

    #[ORM\OneToMany(mappedBy: 'idCreator', targetEntity: Craft::class)]
    private Collection $crafts;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: HasRole::class)]
    private Collection $hasRoles;

    public function __construct()
    {
        $this->crafts = new ArrayCollection();
        $this->hasRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl(?string $pictureUrl): static
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    /**
     * @return Collection<int, Craft>
     */
    public function getCrafts(): Collection
    {
        return $this->crafts;
    }

    public function addCraft(Craft $craft): static
    {
        if (!$this->crafts->contains($craft)) {
            $this->crafts->add($craft);
            $craft->setIdCreator($this);
        }

        return $this;
    }

    public function removeCraft(Craft $craft): static
    {
        if ($this->crafts->removeElement($craft)) {
            // set the owning side to null (unless already changed)
            if ($craft->getIdCreator() === $this) {
                $craft->setIdCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HasRole>
     */
    public function getHasRoles(): Collection
    {
        return $this->hasRoles;
    }

    public function addHasRole(HasRole $hasRole): static
    {
        if (!$this->hasRoles->contains($hasRole)) {
            $this->hasRoles->add($hasRole);
            $hasRole->setIdUser($this);
        }

        return $this;
    }

    public function removeHasRole(HasRole $hasRole): static
    {
        if ($this->hasRoles->removeElement($hasRole)) {
            // set the owning side to null (unless already changed)
            if ($hasRole->getIdUser() === $this) {
                $hasRole->setIdUser(null);
            }
        }

        return $this;
    }
}
