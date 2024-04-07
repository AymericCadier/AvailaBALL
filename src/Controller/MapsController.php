<?php

namespace App\Controller;

use App\Entity\Playground;
use App\Repository\SessionRepository;
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

    #[Route('/session_active', name: 'app_session_active', methods: ['GET'])]
    public function hasActiveSession(SessionRepository $sessionRepository): bool
    {
        $user = $this->getUser();
        $sessions = $sessionRepository->findSessionsByActiveUser($user->getId());

        return !empty($sessions);
    }

    #[Route('index/maps_basket', name: 'app_maps_basket')]
    public function indexBasket(EntityManagerInterface $entityManager, SessionRepository $sessionRepository): Response
    {
        $terrains = $entityManager->getRepository(Playground::class)->findPlaygroundsByType('basket');
        $hasActiveSession = $this->hasActiveSession($sessionRepository);

        return $this->render('maps/basket.html.twig', [
            'terrains' => $terrains,
            'hasActiveSession' => $hasActiveSession
        ]);
    }

    #[Route('index/maps_foot', name: 'app_maps_foot')]
    public function indexFoot(EntityManagerInterface $entityManager, SessionRepository $sessionRepository): Response
    {
        $terrains = $entityManager->getRepository(Playground::class)->findPlaygroundsByType('foot');
        $hasActiveSession = $this->hasActiveSession($sessionRepository);

        return $this->render('maps/foot.html.twig', [
            'terrains' => $terrains,
            'hasActiveSession' => $hasActiveSession
        ]);
    }
}
