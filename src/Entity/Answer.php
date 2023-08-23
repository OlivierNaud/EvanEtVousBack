<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
//TODO ajouter les use pour l'affichage api 
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;


/**
 * Answer
 *
 */
#[ORM\Table(name: 'answer')]
//TODO ajouter #[ApiRessource] pour ajouter la classe dans l'api
#[ORM\Index(name: 'fk_reponse_van1_idx', columns: ['van_id'])]
#[ORM\Index(name: 'fk_reponse_question1_idx', columns: ['question_id'])]
#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'answer:item']),
        new GetCollection(normalizationContext: ['groups' => 'answer:list']),
        new Post(),
        new Put(),
        new Delete(),
    ],
    paginationEnabled: false,)]
class Answer
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    //TODO ajouter #[Groups] pour ajouter les champs dans l'api, présent sur tous les champs
    #[Groups(['answer:list', 'answer:item'])]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'content', type: 'text', length: 65535, nullable: false)]
    #[Groups(['answer:list', 'answer:item'])]
    private $content;

    /**
     * @var \Question
     *
     */
    #[ORM\JoinColumn(name: 'question_id', referencedColumnName: 'id')]
    #[Groups(['answer:list', 'answer:item'])]
    #[ORM\ManyToOne(targetEntity: 'Question')]
    private $question;

    /**
     * @var \Van
     *
     */
    #[ORM\JoinColumn(name: 'van_id', referencedColumnName: 'id')]
    #[Groups(['answer:list', 'answer:item'])]
    #[ORM\ManyToOne(targetEntity: 'Van')]
    private $van;

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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

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
        return $this->question;
    }


}
