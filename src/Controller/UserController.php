<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profil')]
class UserController extends AbstractController
{
    #[Route('/', name: 'profil', methods: ['GET', 'POST'])]
    public function show(Request $request,UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($this->getUser());

            return $this->redirectToRoute('profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/show.html.twig', [
            'user' => $this->getUser(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit', name: 'profil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $this->getUser());
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($this->getUser());

            return $this->redirectToRoute('profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $this->getUser(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

}
