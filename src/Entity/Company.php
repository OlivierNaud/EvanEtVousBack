<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

/**
 * Company
 *
 */
#[ORM\Table(name: 'company')]
#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'company:item']),
        new GetCollection(normalizationContext: ['groups' => 'company:list'])
    ],
    paginationEnabled: false,)]
class Company
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['company:list', 'company:item'])]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'name', type: 'string', length: 45, nullable: false)]
    #[Groups(['company:list', 'company:item'])]
    private $name;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'description', type: 'text', length: 65535, nullable: false)]
    #[Groups(['company:list', 'company:item'])]
    private $description;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'img', type: 'string', length: 255, nullable: false)]
    #[Groups(['company:list', 'company:item'])]
    private $img;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'mail', type: 'string', length: 255, nullable: false)]
    #[Groups(['company:list', 'company:item'])]
    private $mail;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'phone', type: 'string', length: 10, nullable: false, options: ['fixed' => true])]
    #[Groups(['company:list', 'company:item'])]
    private $phone;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

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


}
