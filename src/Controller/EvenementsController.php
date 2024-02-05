<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementsController extends AbstractController
{
    #[Route('/index/evenements', name: 'app_evenements')]
    public function index(): Response
    {
        return $this->render('home/evenements.html.twig', [
            'controller_name' => 'EvenementsController',
        ]);
    }
}
