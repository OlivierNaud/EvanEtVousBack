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
 * Van
 *
 */
#[ORM\Table(name: 'van')]
#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'van:item']),
        new GetCollection(normalizationContext: ['groups' => 'van:list']),
        new Post(),
        new Put(),
        new Delete(),
    ],
    paginationEnabled: false,)]
class Van
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['van:list', 'van:item', 'dish:list', 'dish:item', 'answer:list', 'answer:item'])]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'name', type: 'string', length: 45, nullable: false)]
    #[Groups(['van:list', 'van:item', 'dish:list', 'dish:item', 'answer:list', 'answer:item'])] #TODO ajouter le Groups parent (dish) :list et :item sur l'enfant (van), pour afficher l'objet. Donc van dans dish.
    private $name;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'description', type: 'text', length: 65535, nullable: false)]
    #[Groups(['van:list', 'van:item'])]
    private $description;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'img', type: 'string', length: 255, nullable: false)]
    #[Groups(['van:list', 'van:item'])]
    private $img;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'phone', type: 'string', length: 10, nullable: false, options: ['fixed' => true])]
    #[Groups(['van:list', 'van:item'])]
    private $phone;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     */
    #[ORM\JoinTable(name: 'van_place')]
    #[ORM\JoinColumn(name: 'van_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'place_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: 'Place', inversedBy: 'van')]
    #[Groups(['van:list', 'van:item'])]
    private $place = array();

    #[ORM\OneToMany(mappedBy: 'van', targetEntity: Dish::class)]
    #[Groups(['van:list', 'van:item'])]
    private Collection $dish;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->place = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dish = new ArrayCollection();
    }

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    //TODO erreur à ce niveau quand je vais sur create place 
    /**
     * @return Collection<int, Place>
     */
    public function getPlace(): Collection
    {
        return $this->place;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->place->contains($place)) {
            $this->place->add($place);
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        $this->place->removeElement($place);

        return $this;
    }

    /**
     * @return Collection<int, Dish>
     */
    public function getDish(): Collection
    {
        return $this->dish;
    }

    public function addDish(Dish $dish): self
    {
        if (!$this->dish->contains($dish)) {
            $this->dish->add($dish);
            $dish->setVan($this);
        }

        return $this;
    }

    public function removeDish(Dish $dish): self
    {
        if ($this->dish->removeElement($dish)) {
            // set the owning side to null (unless already changed)
            if ($dish->getVan() === $this) {
                $dish->setVan(null);
            }
        }

        return $this;
    }

    public function __toString() //TODO méthode magique
    {
        return $this->id . ' - ' . $this->name;
    }

}
