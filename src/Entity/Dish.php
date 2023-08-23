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
 * Dish
 *
 */
#[ORM\Table(name: 'dish')]
#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'dish:item']),
        new GetCollection(normalizationContext: ['groups' => 'dish:list']),
        new Post(),
        new Put(),
        new Delete(),
        
    ],
    paginationEnabled: false,)]
class Dish
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['dish:list', 'dish:item', 'van:list', 'van:item'])]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'name', type: 'string', length: 45, nullable: false)]
    #[Groups(['dish:list', 'dish:item', 'van:list', 'van:item'])]
    private $name;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'description', type: 'text', length: 65535, nullable: false)]
    #[Groups(['dish:list', 'dish:item'])]
    private $description;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'img', type: 'string', length: 255, nullable: false)]
    #[Groups(['dish:list', 'dish:item'])]
    private $img;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'ingredients', type: 'string', length: 255, nullable: false)]
    #[Groups(['dish:list', 'dish:item'])]
    private $ingredients;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'price', type: 'decimal', precision: 10, scale: 2, nullable: false)]
    #[Groups(['dish:list', 'dish:item'])]
    private $price;

    
    #[ORM\ManyToOne(inversedBy: 'dish')]
    #[Groups(['dish:list', 'dish:item'])]
    private ?Van $van = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
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

    public function getVan(): ?Van
    {
        return $this->van;
    }

    public function setVan(?Van $van): self
    {
        $this->van = $van;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }


}
