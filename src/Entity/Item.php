<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Delete(security: "is_granted('ROLE_USER') and object.getOwner()"),
        new Post(security: "is_granted('ROLE_USER')"),
        new GetCollection(),
        new GetCollection(
            uriTemplate: '/items/parents/{idItem}',
            uriVariables: [
                'idItem' => new Link(
                    fromProperty: 'idResult',
                    fromClass: Craft::class
                )
            ]
        )
    ]
)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameItem = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?Category $idCategory = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $lastEdited = null;

    #[ORM\OneToMany(mappedBy: 'idResult', targetEntity: Craft::class, orphanRemoval: true)]
    private Collection $crafts;

    public function __construct()
    {
        $this->crafts = new ArrayCollection();
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

    public function setLastEdited(\DateTimeInterface $lastEdited): static
    {
        $this->lastEdited = $lastEdited;

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
            $craft->setIdResult($this);
        }

        return $this;
    }

    public function removeCraft(Craft $craft): static
    {
        if ($this->crafts->removeElement($craft)) {
            // set the owning side to null (unless already changed)
            if ($craft->getIdResult() === $this) {
                $craft->setIdResult(null);
            }
        }

        return $this;
    }
}
