<?php

namespace App\Controller\Admin;

use App\Entity\Statistics;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StatisticsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Statistics::class;
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
