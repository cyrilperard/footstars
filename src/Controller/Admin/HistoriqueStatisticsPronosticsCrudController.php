<?php

namespace App\Controller\Admin;

use App\Entity\HistoriqueStatisticsPronostics;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HistoriqueStatisticsPronosticsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HistoriqueStatisticsPronostics::class;
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
