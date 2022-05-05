<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {


        #Template avec les variables à passer.
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/mentions-legales', name: 'mentions-legales')]
    public function mentionsLegales(): Response
    {
        #Template avec les variables à passer.
        return $this->render('home/mentions_legales.html.twig', [
        ]);
    }
}
