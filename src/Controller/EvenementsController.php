<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class EvenementsController extends AbstractController
{
    #[Route('/index/create_evenements', name: 'app_create_evenements')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->setCreatedAt(new \DateTimeImmutable());
            if ($this->isGranted('ROLE_ADMIN')) {
                $event->setValid(true);
            } else {
                $event->setValid(null);
            }
            $entityManager->persist($event);
            $entityManager->flush();

            $this->addFlash('success', 'Votre événement a été créé avec succès.');

            return $this->redirectToRoute('app_event_list');
        }

        return $this->render('evenements/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/index/evenements/liste', name: 'app_event_list')]
    public function eventList(EntityManagerInterface $entityManager): Response
    {
        $eventRepository = $entityManager->getRepository(Event::class);

        $events = $eventRepository->listValidEvents();

        return $this->render('evenements/index.html.twig', [
            'events' => $events,
        ]);
    }


}
