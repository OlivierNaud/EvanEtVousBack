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
 * Drink
 *
 */
#[ORM\Table(name: 'drink')]
#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'drink:item']),
        new GetCollection(normalizationContext: ['groups' => 'drink:list']),
        new Post(),
        new Put(),
        new Delete(),
    ],
    paginationEnabled: false,)]
class Drink
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['drink:list', 'drink:item', 'orderMenu:list', 'orderMenu:item'])]
    private $id;

    /**
     * @var string
     *  
     */
    #[ORM\Column(name: 'name', type: 'string', length: 45, nullable: false)]
    #[Groups(['drink:list', 'drink:item'])]
    private $name;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'price', type: 'decimal', precision: 10, scale: 2, nullable: false)]
    #[Groups(['drink:list', 'drink:item'])]
    private $price;

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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }


}
