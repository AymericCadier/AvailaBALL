<?php

namespace App\Controller;

use App\Form\NoteType;
use App\Repository\PlaygroundRepository;
use App\Repository\SessionRepository;
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
        $currentDate->setTimezone(new DateTimeZone('Europe/Paris'));
        $session->setDate($currentDate);

        $currentTime = new DateTime('now', new DateTimeZone('UTC'));
        $currentTime->setTimezone(new DateTimeZone('Europe/Paris'));
        $beginHour = DateTime::createFromFormat('H:i:s', $currentTime->format('H:i:s'));
        $session->setBeginHour($beginHour);

        $playground->adduser();

        $entityManager->persist($session);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }

    #[Route('/end-session', name: 'app_session_end', methods: ['POST'])]
    public function endSession(Request $request, SessionRepository $sessionRepository, EntityManagerInterface $entityManager, PlaygroundRepository $playgroundRepository): RedirectResponse
    {
        $user = $this->getUser();

        $sessions = $sessionRepository->findSessionsByActiveUser($user->getId());
        $playground = $sessions[0]->getIdPlayground();

        if (!empty($sessions)) {
            $session = end($sessions);

            $currentTime = new DateTime('now', new DateTimeZone('UTC'));
            $currentTime->setTimezone(new DateTimeZone('Europe/Paris'));
            $endHour = DateTime::createFromFormat('H:i:s', $currentTime->format('H:i:s'));
            $session->setEndHour($endHour);

            $note = $request->request->get('note');
            if ($note !== null) {
                $session->setNote($note);
                $entityManager->flush();
            }

            $playground->removeuser();

            $entityManager->persist($session);
            $entityManager->flush();

            $playgroundRepository->updateAverageNote($session->getIdPlayground());

        }

        return $this->redirectToRoute('app_maps');
    }






}
