<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ItemGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemGroupRepository::class)]
#[ApiResource]
class ItemGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'itemGroups')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Craft $idCraft = null;

    #[ORM\Column]
    private ?bool $isTool = null;

    #[ORM\OneToMany(mappedBy: 'idGroup', targetEntity: GroupFragment::class, orphanRemoval: true)]
    private Collection $groupFragments;

    public function __construct()
    {
        $this->groupFragments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCraft(): ?Craft
    {
        return $this->idCraft;
    }

    public function setIdCraft(?Craft $idCraft): static
    {
        $this->idCraft = $idCraft;

        return $this;
    }

    public function isIsTool(): ?bool
    {
        return $this->isTool;
    }

    public function setIsTool(bool $isTool): static
    {
        $this->isTool = $isTool;

        return $this;
    }

    /**
     * @return Collection<int, GroupFragment>
     */
    public function getGroupFragments(): Collection
    {
        return $this->groupFragments;
    }

    public function addGroupFragment(GroupFragment $groupFragment): static
    {
        if (!$this->groupFragments->contains($groupFragment)) {
            $this->groupFragments->add($groupFragment);
            $groupFragment->setIdGroup($this);
        }

        return $this;
    }

    public function removeGroupFragment(GroupFragment $groupFragment): static
    {
        if ($this->groupFragments->removeElement($groupFragment)) {
            // set the owning side to null (unless already changed)
            if ($groupFragment->getIdGroup() === $this) {
                $groupFragment->setIdGroup(null);
            }
        }

        return $this;
    }
}
