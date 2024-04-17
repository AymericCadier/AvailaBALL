<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MessagesController extends AbstractController
{
    #[Route('/messages', name: 'app_messages')]
    public function index(): Response
    {
        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }

    #[Route('/send', name: 'app_send_message')]
    public function send(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Messages;
        $form = $this->createForm(MessagesType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setSender($this->getUser());
            $message->setCreatedAt(new \DateTimeImmutable());
            $message->setIsRead(false);

            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('success', 'Message envoyé avec succès');
            return $this->redirectToRoute('app_messages');
        }

        return $this->render('messages/send.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/received', name: 'app_received_messages')]
    public function received(): Response
    {
        return $this->render('messages/received.html.twig');
    }

    #[Route('/sent', name: 'app_sent_messages')]
    public function sent(): Response
    {
        return $this->render('messages/sent.html.twig');
    }

    #[Route('/read/{id}', name: 'app_read_message')]
    public function read(Messages $message, EntityManagerInterface $entityManager): Response
    {
        $message->setIsRead(true);
        $entityManager->flush();

        return $this->render('messages/read.html.twig', compact("message"));
    }

    #[Route('/delete/{id}', name: 'app_delete_message')]
    public function delete(Messages $message, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($message);
        $entityManager->flush();

        $this->addFlash('success', 'Message supprimé avec succès');
        return $this->redirectToRoute('app_received_messages');
    }

}
