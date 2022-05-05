<?php

namespace App\Controller;

use App\Utils\Telegram;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login')]
    public function index(#[CurrentUser] ?User $user): Response
    {
        #On regarde si les informations son correct, sinon on renvoie une erreur.
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = 123; // somehow create an API token for $user.

        #Si les informations sont bonnes, on envoie en format json.
        return $this->json([
            'user' => $user->getUserIdentifier(),
            'token' => $token,
        ]);
    }
}
