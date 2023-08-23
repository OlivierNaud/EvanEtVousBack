<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;

/**
 * Order
 *
 */
#[ORM\Table(name: '`order`')]
#[ORM\Index(name: 'fk_order_van1_idx', columns: ['van_id'])]
#[ORM\Index(name: 'fk_order_user1_idx', columns: ['user_id'])]
#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'order:item']),
        new GetCollection(normalizationContext: ['groups' => 'order:list']),
        new Post(),
        new Put(),
        new Delete(),
        
    ],
    paginationEnabled: false,)]
class Order
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['order:list', 'order:item'])]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'price', type: 'decimal', precision: 10, scale: 2, nullable: false)]
    #[Groups(['order:list', 'order:item'])]
    private $price;

    /**
     * @var \DateTime
     *
     */
    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    #[Groups(['order:list', 'order:item'])]
    private $createdAt;

    /**
     * @var \Van
     *
     */
    #[ORM\JoinColumn(name: 'van_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'Van')]
    #[Groups(['order:list', 'order:item'])]
    private $van;

    /**
     * @var \User
     *
     */
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'User')]
    #[Groups(['order:list', 'order:item'])]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface 
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getVan(): ?Van
    {
        return $this->van;
    }

    public function setVan(?Van $van): self
    {
        $this->van = $van;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }


}
