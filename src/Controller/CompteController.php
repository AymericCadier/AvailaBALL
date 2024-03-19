<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
     #[Route("index/profile", name: "app_profile")]
     public function profile(): Response
     {
         // Vérifie si l'utilisateur est connecté
         if (!$this->getUser()) {
             // Redirige vers la page de connexion
             return $this->redirectToRoute('app_login');
         }

         // Code pour afficher la page de profil
         return $this->render('home/profile.html.twig', [
             // Passer éventuellement des données à votre template Twig
         ]);
     }
}
