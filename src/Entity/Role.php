<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nameRole = null;

    #[ORM\OneToMany(mappedBy: 'idRole', targetEntity: HasRole::class)]
    private Collection $hasRoles;

    public function __construct()
    {
        $this->hasRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameRole(): ?string
    {
        return $this->nameRole;
    }

    public function setNameRole(string $nameRole): static
    {
        $this->nameRole = $nameRole;

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
            $hasRole->setIdRole($this);
        }

        return $this;
    }

    public function removeHasRole(HasRole $hasRole): static
    {
        if ($this->hasRoles->removeElement($hasRole)) {
            // set the owning side to null (unless already changed)
            if ($hasRole->getIdRole() === $this) {
                $hasRole->setIdRole(null);
            }
        }

        return $this;
    }
}
