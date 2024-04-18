<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Playground;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/index', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $playgroundRepository = $entityManager->getRepository(Playground::class);

        $playgrounds = $playgroundRepository->listPlaygrounds();
        return $this->render('home/index.html.twig', [
            'playgrounds' => $playgrounds,
        ]);
    }


}
