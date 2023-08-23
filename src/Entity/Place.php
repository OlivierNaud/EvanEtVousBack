<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;

/**
 * Place
 *
 */
#[ORM\Table(name: 'place')]
#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'place:item']),
        new GetCollection(normalizationContext: ['groups' => 'place:list']),
        new Post(),
        new Put(),
        new Delete(),

    ],
    paginationEnabled: false,)]
class Place
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['place:list', 'place:item'])]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'adresse', type: 'string', length: 255, nullable: false)]
    #[Groups(['place:list', 'place:item'])]
    private $adresse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     */
    #[ORM\ManyToMany(targetEntity: 'Van', mappedBy: 'place')]
    #[Groups(['place:list', 'place:item'])]
    private $van;// = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->van = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    //TODO erreur à ce niveau quand je vais sur create place 
    /**
     * @return Collection<int, Van>
     */
    public function getVan(): Collection
    {
        return $this->van;
    }

    public function addVan(Van $van): self
    {
        if (!$this->van->contains($van)) {
            $this->van->add($van);
            $van->addPlace($this);
        }

        return $this;
    }

    public function removeVan(Van $van): self
    {
        if ($this->van->removeElement($van)) {
            $van->removePlace($this);
        }

        return $this;
    }

}
