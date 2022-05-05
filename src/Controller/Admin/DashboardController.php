<?php

namespace App\Controller\Admin;

use App\Entity\Countrys;
use App\Entity\Fixture;
use App\Entity\HistoriqueStatisticsPronostics;
use App\Entity\Leagues;
use App\Entity\Players;
use App\Entity\PlayersStatistics;
use App\Entity\PronosticsFootball;
use App\Entity\Quotes;
use App\Entity\Standings;
use App\Entity\Statistics;
use App\Entity\Teams;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();
        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         //$adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         //return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('footstars');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linktoRoute('Retour sur le site', 'fas fa-home', 'home');
        yield MenuItem::linkToCrud('Pays', 'fas fa-map-marker-alt', Countrys::class);
        yield MenuItem::linkToCrud('Rencontres', 'fas fa-comments', Fixture::class);
        yield MenuItem::linkToCrud('Ligues', 'fas fa-trophy mr-1', Leagues::class);
        yield MenuItem::linkToCrud('Joueurs', 'fa fa-user', Players::class);
        yield MenuItem::linkToCrud('Statistiques joueurs', 'fa fa-user', PlayersStatistics::class);
        yield MenuItem::linkToCrud('Equipes', 'fa fa-users', Teams::class);
        yield MenuItem::linkToCrud('Statistiques Equipe', 'fa fa-users', Statistics::class);
        yield MenuItem::linkToCrud('Classements', 'fas fa-map-marker-alt', Standings::class);
        yield MenuItem::linkToCrud('Citations', 'fas fa-comments', Quotes::class);
        yield MenuItem::linkToCrud('Prédictions', 'fas fa-comments', PronosticsFootball::class);
        yield MenuItem::linkToCrud('Historique prédiction', 'fas fa-comments', HistoriqueStatisticsPronostics::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
    }
}
