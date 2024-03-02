<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/index/inscription', name: 'app_inscription')]
    public function inscription(Request $request, UserRepository $userRepository): Response
    {
        // Créer une nouvelle instance de l'entité User
        $user = new User();

        // Récupérer le formulaire depuis le modèle de formulaire que vous devez créer
        $form = $this->createForm(InscriptionType::class, $user);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Utiliser la méthode createUser du UserRepository pour créer l'utilisateur
            $userRepository->createUser(
                $user->getLname(),
                $user->getFname(),
                $user->getUsername(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getCurrentDate()
            );

            // Rediriger vers la page de connexion
            return $this->render('home/login.html.twig');
        }

        // Si le formulaire n'est pas encore soumis ou n'est pas valide, afficher le formulaire
        return $this->render('home/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
