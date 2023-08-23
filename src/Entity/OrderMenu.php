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
 * OrderMenu
 *
 */
#[ORM\Table(name: 'order_menu')]
#[ORM\Index(name: 'fk_order_menu_dessert1_idx', columns: ['dessert_id'])]
#[ORM\Index(name: 'fk_order_has_menu_menu1_idx', columns: ['menu_id'])]
#[ORM\Index(name: 'fk_order_menu_dish1_idx', columns: ['dish_id'])]
#[ORM\Index(name: 'fk_order_has_menu_order1_idx', columns: ['order_id'])]
#[ORM\Index(name: 'fk_order_menu_drink1_idx', columns: ['drink_id'])]
#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'orderMenu:item']),
        new GetCollection(normalizationContext: ['groups' => 'orderMenu:list']),
        new Post(),
        new Put(),
        new Delete(),
        
    ],
    paginationEnabled: false,)]
class OrderMenu
{

    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['orderMenu:list', 'orderMenu:item'])]
    private $id;

    /**
     * @var \Dessert
     *
     */
    #[ORM\JoinColumn(name: 'dessert_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'Dessert')]
    #[Groups(['orderMenu:list', 'orderMenu:item'])]
    private $dessert;

    /**
     * @var \Menu
     *
     */
    #[ORM\JoinColumn(name: 'menu_id', referencedColumnName: 'id')]
    #[ORM\OneToOne(targetEntity: 'Menu')]
    #[Groups(['orderMenu:list', 'orderMenu:item'])]
    private $menu;

    /**
     * @var \Dish
     *
     */
    #[ORM\JoinColumn(name: 'dish_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'Dish')]
    #[Groups(['orderMenu:list', 'orderMenu:item'])]
    private $dish;

    /**
     * @var \Order
     *
     */
    #[ORM\JoinColumn(name: 'order_id', referencedColumnName: 'id')]
    #[ORM\OneToOne(targetEntity: 'Order')]
    #[Groups(['orderMenu:list', 'orderMenu:item'])]
    private $order;

    /**
     * @var \Drink
     *
     */
    #[ORM\JoinColumn(name: 'drink_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'Drink')]
    #[Groups(['orderMenu:list', 'orderMenu:item'])]
    private $drink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDessert(): ?Dessert
    {
        return $this->dessert;
    }

    public function setDessert(?Dessert $dessert): self
    {
        $this->dessert = $dessert;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getDish(): ?Dish
    {
        return $this->dish;
    }

    public function setDish(?Dish $dish): self
    {
        $this->dish = $dish;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getDrink(): ?Drink
    {
        return $this->drink;
    }

    public function setDrink(?Drink $drink): self
    {
        $this->drink = $drink;

        return $this;
    }


}
