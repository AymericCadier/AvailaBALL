<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\InscriptionType;
use App\Repository\UserRepository;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class InscriptionController extends AbstractController
{
    #[Route('/index/inscription', name: 'app_inscription')]
    public function inscription(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator): Response
    {
        // Créer une nouvelle instance de l'entité User
        $user = new User();
        // Récupérer le formulaire depuis le modèle de formulaire que vous devez créer
        $form = $this->createForm(InscriptionType::class, $user);
        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    plainPassword: $user->getPassword()
                )
            );
            $userRepository->createUser(
                $user->getLname(),
                $user->getFname(),
                $user->getNickname(),
                $user->getEmail(),
                $user->getPassword()
            );
            /* return $userAuthenticator->authenticateUser(   // méthode qui connecte l'utilisateur après son inscription, laissez en commentaire
                $user,
                $authenticator,
                $request
            ); */
            // Rediriger vers la page de connexion
            return $this->render('home/index.html.twig');
        }
        // Si le formulaire n'est pas encore soumis ou n'est pas valide, afficher le formulaire
        return $this->render('security/inscriptionA.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}