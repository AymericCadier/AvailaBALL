<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TerrController extends AbstractController
{
    #[Route('index/terr', name: 'app_terr')]
    public function index(): Response
    {
        return $this->render('home/terre.html.twig', [
            'controller_name' => 'TerrController',
        ]);
    }
}
