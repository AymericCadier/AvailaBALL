<?php
namespace App\Service;

use App\Entity\Event;
use App\Entity\User;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class AdminService
{
    private UserRepository $userRepository;
    private EventRepository $eventRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(
        UserRepository $userRepository,
        EventRepository $eventRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
        $this->entityManager = $entityManager;
    }

    public function getActiveUsers(): array
    {
        return $this->userRepository->listActiveUsers();
    }

    public function getUnseenEvents(): array
    {
        return $this->eventRepository->listUnseenEvents();
    }

    public function validateEvent(int $id): void
    {
        $event = $this->entityManager->getRepository(Event::class)->find($id);

        if (!$event || $event->getValid() !== null) {
            throw $this->createNotFoundException("Cet événement n'existe pas ou a déjà été traité.");
        }

        $event->setValid(true);
        $this->entityManager->flush();
    }

    public function refuseEvent(int $id): void
    {
        $event = $this->entityManager->getRepository(Event::class)->find($id);

        if (!$event || $event->getValid() !== null) {
            throw $this->createNotFoundException("Cet événement n'existe pas ou a déjà été traité.");
        }

        $event->setValid(false);
        $this->entityManager->flush();
    }

    public function deleteUser(int $id): void
    {
        $this->entityManager->getRepository(User::class)->deleteUserId($id);
    }
}