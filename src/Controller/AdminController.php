<?php

namespace App\Controller;

use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    #[Route("/index/admin", name: "app_admin")]
    public function index(): Response
    {
        $users = $this->adminService->getActiveUsers();

        return $this->render('admin/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/index/unseen_events', name: 'app_unseen_events')]
    public function unseenEvents(): Response
    {
        $events = $this->adminService->getUnseenEvents();

        return $this->render('admin/unseen_events.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/index/validate_event/{id}', name: 'app_validate_event')]
    public function validateEvent(int $id): Response
    {
        $this->adminService->validateEvent($id);

        return $this->redirectToRoute('app_unseen_events');
    }

    #[Route('/index/refuse_event/{id}', name: 'app_refuse_event')]
    public function refuseEvent(int $id): Response
    {
        $this->adminService->refuseEvent($id);

        return $this->redirectToRoute('app_unseen_events');
    }

    #[Route("/index/delete_admin/{id}", name: "app_admin_delete")]
    public function deleteUser(int $id): Response
    {
        $this->adminService->deleteUser($id);

        $this->addFlash('success', 'Le compte de l\'utilisateur a été supprimé avec succès.');

        return $this->redirectToRoute('app_admin');
    }
}