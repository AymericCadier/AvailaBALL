<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EvenementsController extends AbstractController
{
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    #[Route('/index/create_evenements', name: 'app_create_evenements')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $errors = $this->validator->validate($event);

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }

                return $this->render('evenements/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            } else {
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

    #[Route('/index/evenements_delete/{id}', name: 'app_event_delete')]
    public function delete(Event $event, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($event);
        $entityManager->flush();

        $this->addFlash('success', 'Votre événement a été supprimé avec succès.');

        return $this->redirectToRoute('app_event_list');
    }


}
