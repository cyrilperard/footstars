<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Utils\GeneratePassword;
use App\Utils\SendMail;
use App\Utils\Telegram;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, MailerInterface $mailer, UserPasswordHasherInterface $encoder, EntityManagerInterface $entityManager): Response
    {
        $singup = false;

        #Si il y a déjà un utilisateur de connecter, on le redirige vers le dashboard.
        if ($this->getUser() !== null) {
            return $this->redirectToRoute('home');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        #Si le formulair eest soumis et valide.
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $password = GeneratePassword::create(8);
            $rolesArr = array('ROLE_USER');

            $user->setPassword($encoder->hashPassword($user, $password));
            $user->setRoles($rolesArr);
            $user->setDateAdd(new \DateTime(date("Y-m-d")));

            $entityManager->persist($user);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from('contact@footstars.com')
                ->to($user->getEmail())
                ->subject('Bienvenu sur footstars !')
                ->htmlTemplate('emails/welcome.html.twig')
                ->context([
                    'mail' => $user->getEmail(),
                    'password' => $password,
                ]);

            $mailer->send($email);

            Telegram::sendMessage("Un utilisateur nous a rejoint : *".$user->getPseudo()."*.");

            $singup = true;


            #On redirige vers la page de login une fois l'inscription faite.
            //return $this->redirectToRoute('app_login');
        }

        #Template avec les variables à passer
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'signup' => $singup,
        ]);
    }
}
