<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use App\Form\LoginType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;

class SecurityController extends AbstractController
{
    #[\Symfony\Component\Routing\Attribute\Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $user = $this->getUser();
        if ($user instanceof User) {
            return $this->redirectToRoute('app_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }


    #[Route('index/logout', name: 'app_logout')]
    public function logout(LogoutHandlerInterface $logoutHandler): Response
    {
        // Utilisez le LogoutHandlerInterface pour gérer la déconnexion
        $logoutHandler->logout($this->getUser());

        // Redirigez l'utilisateur vers la page d'accueil ou une autre page
        return $this->redirectToRoute('app_home');
    }

    #[Route('/index/test_login', name: 'app_test_login')]
    public function isUserLoggedIn(AuthenticationUtils $authenticationUtils)
    {
        $user = $this->getUser();

        if ($user) {
            // L'utilisateur est connecté
            return true;
        } else {
            // L'utilisateur n'est pas connecté
            return false;
        }
    }



}