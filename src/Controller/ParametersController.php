<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParametersController extends AbstractController
{
    #[Route("index/parameters", name: "app_parameters")]
    public function parameters(): Response
    {
        // Vérifie si l'utilisateur est connecté
        if (!$this->getUser()) {
            // Redirige vers la page de connexion
            return $this->redirectToRoute('app_login');
        }

        // Code pour afficher la page de paramètres
        return $this->render('home/parameters.html.twig', [
            // Passer éventuellement des données à votre template Twig
        ]);
    }
}
