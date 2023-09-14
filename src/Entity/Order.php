<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    paginationEnabled: false,
    normalizationContext: ['groups' => ['order:get']],
    denormalizationContext: ['groups' => ['order:post']],
    )]
class Order
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['order:list', 'order:item', 'van:list', 'van:item', 'orderMenu:list', 'orderMenu:item', 'order:post'])]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'price', type: 'decimal', precision: 10, scale: 2, nullable: false)]
    #[Groups(['order:list', 'order:item', 'van:list', 'van:item', 'order:post'])]
    private $price;

    /**
     * @var \DateTime
     *
     */
    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: true)]
    #[Groups(['order:list', 'order:item', 'order:post'])]
    private $createdAt;

    /**
     * @var \Van
     *
     */
    #[ORM\JoinColumn(name: 'van_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'Van')]
    #[Groups(['order:list', 'order:item', 'order:post'])]
    private $van;

    /**
     * @var \User
     *
     */
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'User')]
    #[Groups(['order:list', 'order:item', 'order:post'])]
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     */
    #[ORM\JoinColumn( name: 'orderMenu_id', referencedColumnName: 'id')]
    #[ORM\OneToMany(cascade: ['persist'], mappedBy: 'order', targetEntity: OrderMenu::class)]
    #[Groups(['order:item', 'order:post'])]
    private Collection $orderMenu;

    public function __construct()
    {
        $this->orderMenu = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

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


    /**
     * @return Collection<int, OrderMenu>
     */
    public function getOrderMenu(): Collection
    {
        return $this->orderMenu;
    }

    public function addOrderMenu(OrderMenu $orderMenu): self
    {
        if (!$this->orderMenu->contains($orderMenu)) {
            $this->orderMenu->add($orderMenu);
            $orderMenu->setOrder($this);
        }

        return $this;
    }

    public function removeOrderMenu(OrderMenu $orderMenu): self
    {
        if ($this->orderMenu->removeElement($orderMenu)) {
            // set the owning side to null (unless already changed)
            if ($orderMenu->getOrder() === $this) {
                $orderMenu->setOrder(null);
            }
        }

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
