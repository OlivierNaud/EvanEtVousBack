<?php

namespace App\Controller\Admin;

use App\Entity\OrderMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderMenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderMenu::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
