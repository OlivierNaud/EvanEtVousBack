<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Answer;
use App\Entity\Company;
use App\Entity\User;
use App\Entity\Drink;
use App\Entity\Dish;
use App\Entity\Dessert;
use App\Entity\Question;
use App\Entity\Place;
use App\Entity\Van;
use App\Entity\Order;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Back Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        //TODO ajoutez class pour easy admin - dans le use et ici 
        yield MenuItem::linkToCrud('Answer', 'fas fa-list', Answer::class);
        yield MenuItem::linkToCrud('Company', 'fas fa-list', Company::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Drink', 'fas fa-list', Drink::class);
        yield MenuItem::linkToCrud('Dish', 'fas fa-list', Dish::class);
        yield MenuItem::linkToCrud('Dessert', 'fas fa-list', Dessert::class);
        yield MenuItem::linkToCrud('Question', 'fas fa-list', Question::class);
        yield MenuItem::linkToCrud('Place', 'fas fa-list', Place::class);
        yield MenuItem::linkToCrud('Van', 'fas fa-list', Van::class);
        yield MenuItem::linkToCrud('Order', 'fas fa-list', Order::class);
        yield MenuItem::linkToCrud('Order_Menu', 'fas fa-list', OrderMenu::class);
        yield MenuItem::linkToCrud('Menu', 'fas fa-list', Menu::class);
        }
}
