<?php

namespace App\Controller\Admin;

use App\Entity\PronosticsFootball;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PronosticsFootballCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PronosticsFootball::class;
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
