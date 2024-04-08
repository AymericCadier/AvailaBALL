<?php

namespace App\Controller;

use App\Form\UpdateAccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Repository\SessionRepository;

class CompteController extends AbstractController
{
     #[Route("/index/profile", name: "app_profile")]
     public function profile(SessionRepository $sessionRepository): Response
     {

         if (!$this->getUser()) {
             return $this->redirectToRoute('app_login');
         }
         $userSessions = $sessionRepository->findSessionsByUserId($this->getUser()->getId());

         return $this->render('compte/index.html.twig', [
             'userSessions' => $userSessions,
         ]);
     }

    #[Route("/account/update", name: "app_account_update")]
    public function update(Request $request, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();

        $form = $this->createForm(UpdateAccountType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Vos informations ont été mises à jour avec succès.');
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('compte/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/account/delete", name: "app_account_delete")]
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $user->setDeletedAt(new \DateTimeImmutable());
        $entityManager->flush();
        $this->addFlash('success', 'Votre compte a été supprimé avec succès.');
        return $this->redirectToRoute('app_logout');
    }


}
