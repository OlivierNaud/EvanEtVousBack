<?php

namespace App\Controller\Admin;

use App\Entity\Van;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Van::class;
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
