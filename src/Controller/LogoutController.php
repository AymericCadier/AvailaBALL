<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;

class LogoutController extends AbstractController
{
    #[Route('index/logout', name: 'app_logout')]
    public function logout(LogoutHandlerInterface $logoutHandler): Response
    {
        // Utilisez le LogoutHandlerInterface pour gérer la déconnexion
        $logoutHandler->logout($this->getUser());

        // Redirigez l'utilisateur vers la page d'accueil ou une autre page
        return $this->redirectToRoute('app_login');
    }
}

