<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CraftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CraftRepository::class)]
#[ApiResource]
class Craft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $idResult = null;

    #[ORM\OneToMany(mappedBy: 'craft', targetEntity: User::class)]
    private Collection $idCreator;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\OneToMany(mappedBy: 'idCraft', targetEntity: ItemGroup::class)]
    private Collection $itemGroups;

    public function __construct()
    {
        $this->idCreator = new ArrayCollection();
        $this->itemGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdResult(): ?Item
    {
        return $this->idResult;
    }

    public function setIdResult(Item $idResult): static
    {
        $this->idResult = $idResult;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIdCreator(): Collection
    {
        return $this->idCreator;
    }

    public function addIdCreator(User $idCreator): static
    {
        if (!$this->idCreator->contains($idCreator)) {
            $this->idCreator->add($idCreator);
            $idCreator->setCraft($this);
        }

        return $this;
    }

    public function removeIdCreator(User $idCreator): static
    {
        if ($this->idCreator->removeElement($idCreator)) {
            // set the owning side to null (unless already changed)
            if ($idCreator->getCraft() === $this) {
                $idCreator->setCraft(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, ItemGroup>
     */
    public function getItemGroups(): Collection
    {
        return $this->itemGroups;
    }

    public function addItemGroup(ItemGroup $itemGroup): static
    {
        if (!$this->itemGroups->contains($itemGroup)) {
            $this->itemGroups->add($itemGroup);
            $itemGroup->setIdCraft($this);
        }

        return $this;
    }

    public function removeItemGroup(ItemGroup $itemGroup): static
    {
        if ($this->itemGroups->removeElement($itemGroup)) {
            // set the owning side to null (unless already changed)
            if ($itemGroup->getIdCraft() === $this) {
                $itemGroup->setIdCraft(null);
            }
        }

        return $this;
    }
}
