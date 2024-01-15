<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\CraftRepository;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use App\State\CraftProcessor;
use App\State\UtilisateurProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CraftRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Patch(),
        new Post(security: "is_granted('ROLE_USER')", processor: CraftProcessor::class),
        new Delete(security: "is_granted('ROLE_USER') and object.getOwner() == user")
    ]
)]
class Craft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'crafts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $idResult = null;

    #[ORM\ManyToOne(fetch: "EAGER", inversedBy: 'crafts')]
    #[ApiProperty(writable: false)]
    private ?User $idCreator = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[ApiProperty(writable: false)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\OneToMany(mappedBy: 'idCraft', targetEntity: ItemGroup::class, orphanRemoval: true)]
    private Collection $itemGroups;

    public function __construct()
    {
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

    public function setIdResult(?Item $idResult): static
    {
        $this->idResult = $idResult;

        return $this;
    }

    public function getIdCreator(): ?User
    {
        return $this->idCreator;
    }

    public function setIdCreator(?User $idCreator): static
    {
        $this->idCreator = $idCreator;

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

    #[ORM\PrePersist]
    public function prePersistDateCreation() : void {
        $this->dateCreation = new \DateTime();
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
