<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\UserRepository;
use App\State\UtilisateurProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity('login', message : "Cette valeur est déjà prise!")]
#[UniqueEntity('email', message : "Cette email est déjà prise!")]
#[ApiResource(operations: [
    new GetCollection(),
    new Get(),
    new Post(processor: UtilisateurProcessor::class, ),
    new Delete(),
    new Patch(processor: UtilisateurProcessor::class),
],
    normalizationContext: ["groups" => ["utilisateur:read"]],

)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['utilisateur:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[Assert\Length(min: 4, max: 20, minMessage: 'Il faut au moins 4 caractères', maxMessage: 'Il faut moins de 20 caractères')]
    #[Groups(['utilisateur:read'])]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    #[ApiProperty(readable: false, writable: false)]
    private ?string $password = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[Assert\Length(min: 4, max: 30, minMessage: 'Il faut au moins 4 caractères', maxMessage: 'Il faut moins de 30 caractères')]
    #[Assert\Regex(
        pattern: "#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,30}$#",
        message: 'Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre')]
    private ?string $plainPassword;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[Assert\Email(message:'Addresse email non valide')]
    #[Groups(['utilisateur:read'])]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pictureUrl = null;

    #[ORM\OneToMany(mappedBy: 'idCreator', targetEntity: Craft::class)]
    private Collection $crafts;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: HasRole::class)]
    private Collection $hasRoles;

    #[ORM\Column]
    private ?bool $premium = null;

    public function __construct()
    {
        $this->crafts = new ArrayCollection();
        $this->hasRoles = new ArrayCollection();
    }

    /**
     * @return ?string $plainPassword
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param String $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
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

    public function isPremium(): ?bool
    {
        return $this->premium;
    }

    public function setPremium(bool $premium): static
    {
        $this->premium = $premium;

        return $this;
    }

    public function getRoles(): array
    {
        //à partir de getHasRoles() on récupère les roles
        $roles = $this->getHasRoles()->map(function (HasRole $hasRole) {
            return $hasRole->getIdRole()->getNameRole();
        })->toArray();
        return $roles;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }
}
