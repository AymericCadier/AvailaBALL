<?php

namespace App\Controller;

use App\Form\UpdateAccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;

class AdminController extends AbstractController
{
    #[Route("/index/admin", name: "app_admin")]
    public function profile(): Response
    {
        // Vérifie si l'utilisateur est connecté
        if (!$this->getUser()) {
            // Redirige vers la page de connexion
            return $this->redirectToRoute('app_login');
        }

        // Code pour afficher la page de profil
        return $this->render('admin/index.html.twig', [
            // Passer éventuellement des données à votre template Twig
        ]);
    }



}
