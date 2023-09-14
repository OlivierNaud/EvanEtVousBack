<?php
namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;

/**
 * User
 *
 */
#[ORM\Table(name: 'user')]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'user:item']),
        new GetCollection(normalizationContext: ['groups' => 'user:list']),
        new Post(),
        new Put(),
        new Delete(),
    ],
    paginationEnabled: false,)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User  implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['user:list', 'user:item', 'order:list', 'order:item'])]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'first_name', type: 'string', length: 45, nullable: false)]
    #[Groups(['user:list', 'user:item'])]
    private $firstName;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'last_name', type: 'string', length: 45, nullable: false)]
    #[Groups(['user:list', 'user:item'])]
    private $lastName;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'email', type: 'string', length: 255, nullable: false)]
    #[Groups(['user:list', 'user:item'])]
    private $email;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'phone', type: 'string', length: 10, nullable: false, options: ['fixed' => true])]
    #[Groups(['user:list', 'user:item'])]
    private $phone;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'password', type: 'string', length: 60, nullable: false)]
    #[Groups(['user:list', 'user:item'])]
    private $password;

    /**
     * @var array
     *
     */
    #[ORM\Column(name: 'roles', type: 'json', length: 1000, nullable: false)]
    #[Groups(['user:list', 'user:item'])]
    private $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
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

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function __toString()
    {
        return $this->lastName . ' ' . $this->firstName;
    }


}
