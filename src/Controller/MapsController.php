<?php

namespace App\Controller;

use App\Entity\Playground;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapsController extends AbstractController
{
    #[Route('index/maps', name: 'app_maps')]
    public function index(): Response
    {
        return $this->render('maps/index.html.twig', [
            'controller_name' => 'MapsController',
        ]);
    }

    #[Route('index/maps_basket', name: 'app_maps_basket')]
    public function indexBasket(EntityManagerInterface $entityManager): Response
    {
        $terrains = $entityManager->getRepository(Playground::class)->findPlaygroundsByType('basket');

        return $this->render('maps/basket.html.twig', [
            'terrains' => $terrains,
        ]);
    }

    #[Route('index/maps_foot', name: 'app_maps_foot')]
    public function indexFoot(EntityManagerInterface $entityManager): Response
    {
        $terrains = $entityManager->getRepository(Playground::class)->findPlaygroundsByType('foot');

        return $this->render('maps/foot.html.twig', [
            'terrains' => $terrains,
        ]);
    }
}
