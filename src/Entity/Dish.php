<?php
namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\DishController;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Dish
 *
 */
#[Vich\Uploadable]
#[ORM\Table(name: 'dish')]
#[ORM\Entity]
#[ApiResource(
    normalizationContext: ['groups' => ['dish:read']], 
    denormalizationContext: ['groups' => ['dish:write']], 
    paginationEnabled: false,
    operations: [
        new Get(normalizationContext: ['groups' => 'dish:item']),
        new GetCollection(normalizationContext: ['groups' => 'dish:list']),
        new Post(inputFormats: ['multipart' => ['multipart/form-data']]),
        new Put(),
        new Delete(),
    ],
    
)]
class Dish
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['dish:list', 'dish:item', 'van:list', 'van:item', 'orderMenu:list', 'orderMenu:item'])]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'name', type: 'string', length: 45, nullable: false)]
    #[Groups(['dish:list', 'dish:item', 'van:list', 'van:item', 'dish:write'])]
    private $name;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'description', type: 'text', length: 65535, nullable: false)]
    #[Groups(['dish:list', 'dish:item', 'van:list', 'van:item', 'dish:write'])]
    private $description;

    #[ApiProperty(types: ['https://schema.org/contentUrl'])]
    #[Groups(['dish:read'])]
    public ?string $contentUrl = null;

    #[Vich\UploadableField(mapping: 'dish', fileNameProperty: 'img')]
    #[Groups(['dish:write'])]
    public ?File $file = null;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'img', type: 'string', length: 255, nullable: true)]
    #[Groups(['dish:list', 'dish:item', 'van:list', 'van:item'])]
    private $img;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'ingredients', type: 'string', length: 255, nullable: false)]
    #[Groups(['dish:list', 'dish:item', 'van:list', 'van:item', 'dish:write'])]
    private $ingredients;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'price', type: 'decimal', precision: 10, scale: 2, nullable: false)]
    #[Groups(['dish:list', 'dish:item', 'van:list', 'van:item', 'dish:write'])]
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
