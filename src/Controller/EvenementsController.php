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
    #[Route('/index/evenements', name: 'app_create')]

    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Crée une nouvelle instance de l'entité Event
        $event = new Event();

        // Crée le formulaire d'inscription en utilisant l'entité Event
        $form = $this->createForm(EventType::class, $event);

        // Traite la soumission du formulaire
        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistre les données de l'événement en base de données
            $event->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($event);
            $entityManager->flush();

            // Affiche un message de succès à l'utilisateur
            $this->addFlash('success', 'Votre événement a été créé avec succès.');

            // Redirige vers une autre page, par exemple la page d'accueil
            return $this->redirectToRoute('app_create');
        }

        // Si le formulaire n'a pas été soumis ou n'est pas valide, affiche le formulaire à nouveau
        return $this->render('evenements/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/index/evenements/liste', name: 'app_event_list')]
    public function eventList(EntityManagerInterface $entityManager): Response
    {
        // Récupère le repository des événements
        $eventRepository = $entityManager->getRepository(Event::class);

        // Appelle la méthode listValidEvents() pour récupérer les événements valides
        $events = $eventRepository->listValidEvents();

        // Rend la page Twig avec la liste des événements valides
        return $this->render('evenements/event_list.html.twig', [
            'events' => $events,
        ]);
    }


}
