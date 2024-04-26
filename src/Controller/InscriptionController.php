<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\InscriptionType;
use App\Service\InscriptionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/index/inscription', name: 'app_inscription')]
    public function inscription(Request $request, InscriptionService $userRegistrationService): Response
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRegistrationService->register($user);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('security/inscriptionB.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}