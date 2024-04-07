<?php

namespace App\Controller;

use App\Repository\PlaygroundRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Playground;
use Symfony\Component\HttpFoundation\RedirectResponse;
use DateTime;
use DateTimeZone;



class SessionController extends AbstractController
{
    #[Route('/create-session', name: 'app_session_create', methods: ['POST'])]
    public function createSession(Request $request, PlaygroundRepository $playgroundRepository, EntityManagerInterface $entityManager): RedirectResponse
    {
        $terrainId = $request->request->get('terrain_id');

        $playground = $playgroundRepository->find($terrainId);

        if (!$playground) {
            return $this->redirectToRoute('app_home');
        }

        $session = new Session();
        $session->setIdUser($this->getUser());
        $session->setIdPlayground($playground);


        $currentDate = new DateTime('now', new DateTimeZone('UTC'));
        $currentDate->setTime(0, 0, 0);
        $session->setDate($currentDate);

        $currentTime = new DateTime('now', new DateTimeZone('UTC'));
        $currentTime->setTimezone(new DateTimeZone('Europe/Paris'));
        $beginHour = DateTime::createFromFormat('H:i:s', $currentTime->format('H:i:s'));
        $session->setBeginHour($beginHour);


        $entityManager->persist($session);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}
