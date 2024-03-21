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
use App\Form\EditAccountType;

class CompteController extends AbstractController
{
     #[Route("/index/profile", name: "app_profile")]
     public function profile(): Response
     {
         // Vérifie si l'utilisateur est connecté
         if (!$this->getUser()) {
             // Redirige vers la page de connexion
             return $this->redirectToRoute('app_login');
         }

         // Code pour afficher la page de profil
         return $this->render('compte/index.html.twig', [
             // Passer éventuellement des données à votre template Twig
         ]);
     }

    #[Route("/account/update", name: "app_account_update")]
    public function update(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupère l'utilisateur connecté
        $user = $this->getUser();

        // Crée le formulaire d'édition de compte
        $form = $this->createForm(UpdateAccountType::class, $user);

        // Traite la soumission du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistre les modifications en base de données
            $entityManager->flush();

            // Affiche un message de succès à l'utilisateur
            $this->addFlash('success', 'Vos informations ont été mises à jour avec succès.');

            // Redirige vers la page de profil
            return $this->redirectToRoute('app_profile');
        }

        // Affiche le formulaire d'édition de compte
        return $this->render('compte/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/account/delete", name: "app_account_delete")]
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupère l'utilisateur connecté
        $user = $this->getUser();

        // Met à jour l'attribut "deleted_at" avec la date et l'heure actuelles
        $user->setDeletedAt(new \DateTimeImmutable());

        // Enregistre les modifications en base de données
        $entityManager->flush();

        // Affiche un message de succès à l'utilisateur
        $this->addFlash('success', 'Votre compte a été supprimé avec succès.');

        // Redirige vers la page d'accueil
        return $this->redirectToRoute('app_logout');
    }


}
