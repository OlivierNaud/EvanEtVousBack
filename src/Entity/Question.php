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
 * Question
 *
 */
#[ORM\Table(name: 'question')]
#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'question:item']),
        new GetCollection(normalizationContext: ['groups' => 'question:list']),
        new Post(),
        new Put(),
        new Delete(),

    ],
    paginationEnabled: false,)]
class Question
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['question:list', 'question:item'])]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'content', type: 'text', length: 65535, nullable: false)]
    #[Groups(['question:list', 'question:item', 'answer:list', 'answer:item'])]
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function __toString() //TODO méthode magique
    {
        return $this->content;
    }


}
