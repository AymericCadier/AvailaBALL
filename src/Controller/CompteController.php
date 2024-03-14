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
}
