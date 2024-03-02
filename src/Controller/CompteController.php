<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    #[Route('index/compte', name: 'app_compte')]
    public function index(): Response
    {
        return $this->render('home/compte.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }

    #[Route('index/compte/inscription', name: 'app_inscription')]
    public function inscription(): Response
    {
        return $this->render('home/inscription.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }

    #[Route('index/compte/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        return $this->render('home/login.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }

    #[Route('/index/update/{id}', name: 'app_update')]
    public function upadate(Request $request, $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lname = $form->get('lname')->getData();
            $fname = $form->get('fname')->getData();
            $username = $form->get('username')->getData();
            $password = $form->get('password')->getData();
            $email = $form->get('email')->getData();

            $userRepository->updateUser(
                $id,
                $lname,
                $fname,
                $username,
                $password,
                $email
            );

            return $this->redirectToRoute('homepage');
        }

        return $this->render('home/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
