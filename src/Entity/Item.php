<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ApiResource]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameItem = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $idCategory = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastEdited = null;

    #[ORM\OneToMany(mappedBy: 'idItem', targetEntity: GroupFragment::class)]
    private Collection $groupFragments;

    public function __construct()
    {
        $this->groupFragments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameItem(): ?string
    {
        return $this->nameItem;
    }

    public function setNameItem(string $nameItem): static
    {
        $this->nameItem = $nameItem;

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->idCategory;
    }

    public function setIdCategory(?Category $idCategory): static
    {
        $this->idCategory = $idCategory;

        return $this;
    }

    public function getLastEdited(): ?\DateTimeInterface
    {
        return $this->lastEdited;
    }

    public function setLastEdited(?\DateTimeInterface $lastEdited): static
    {
        $this->lastEdited = $lastEdited;

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
            $groupFragment->setIdItem($this);
        }

        return $this;
    }

    public function removeGroupFragment(GroupFragment $groupFragment): static
    {
        if ($this->groupFragments->removeElement($groupFragment)) {
            // set the owning side to null (unless already changed)
            if ($groupFragment->getIdItem() === $this) {
                $groupFragment->setIdItem(null);
            }
        }

        return $this;
    }
}
