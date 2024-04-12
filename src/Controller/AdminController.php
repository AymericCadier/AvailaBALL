<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\UpdateAccountType;
use App\Form\ValidateEventType;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;

class AdminController extends AbstractController
{
    #[Route("/index/admin", name: "app_admin")]
    public function profile(UserRepository $userRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $users = $userRepository->listActiveUsers();

        return $this->render('admin/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/index/unseen_events', name: 'app_unseen_events')]
    public function unseenEvents(EventRepository $eventRepository, Request $request): Response
    {
        $events = $eventRepository->listUnseenEvents();

        return $this->render('admin/unseen_events.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/index/validate_event/{id}', name: 'app_validate_event')]
    public function validateEvent(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $event = $entityManager->getRepository(Event::class)->find($id);

        if (!$event || $event->getValid() !== null) {
            throw $this->createNotFoundException("Cet événement n'existe pas ou a déjà été traité.");
        }

        $event->setValid(true);
        $entityManager->flush();

        return $this->redirectToRoute('app_unseen_events');
    }

    #[Route('/index/refuse_event/{id}', name: 'app_refuse_event')]
    public function refuseEvent(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $event = $entityManager->getRepository(Event::class)->find($id);

        if (!$event || $event->getValid() !== null) {
            throw $this->createNotFoundException("Cet événement n'existe pas ou a déjà été traité.");
        }

        $event->setValid(false);
        $entityManager->flush();

        return $this->redirectToRoute('app_unseen_events');
    }

    #[Route("/index/delete_admin/{id}", name: "app_admin_delete")]
    public function deleteUser(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $repository = $entityManager->getRepository(User::class);
        $repository->deleteUserId($id);
        $this->addFlash('success', 'Le compte de l\'utilisateur a été supprimé avec succès.');
        return $this->redirectToRoute('app_admin');
    }









}