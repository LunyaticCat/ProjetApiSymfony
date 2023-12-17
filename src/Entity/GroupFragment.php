<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Repository\GroupFragmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupFragmentRepository::class)]
#[ApiResource(
    operations: [
        new Get()
    ]
)]
class GroupFragment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'groupFragments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ItemGroup $idGroup = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $idItem = null;

    #[ORM\Column]
    private ?int $stack = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGroup(): ?ItemGroup
    {
        return $this->idGroup;
    }

    public function setIdGroup(?ItemGroup $idGroup): static
    {
        $this->idGroup = $idGroup;

        return $this;
    }

    public function getIdItem(): ?Item
    {
        return $this->idItem;
    }

    public function setIdItem(?Item $idItem): static
    {
        $this->idItem = $idItem;

        return $this;
    }

    public function getStack(): ?int
    {
        return $this->stack;
    }

    public function setStack(int $stack): static
    {
        $this->stack = $stack;

        return $this;
    }
}
