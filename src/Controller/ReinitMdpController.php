<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ReinitMdpController extends AbstractController
{
    #[Route('/reinit-mdp', name: 'app_reinitMdp')]
    public function reinitMdp(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHashed): Response
    {
        $email = $request->request->get('email');

        // Vérifier si l'utilisateur existe avec cet e-mail
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            $this->addFlash('error', 'Adresse e-mail non trouvée.');
            return $this->redirectToRoute('app_reinitMdp');
        }

        // Générer un nouveau mot de passe aléatoire
        $newPassword = $this->generateRandomPassword();

        // Encoder le mot de passe
        $HashPassword = $passwordHashed->hashPassword($user, $newPassword);

        // Mettre à jour le mot de passe de l'utilisateur dans la base de données
        $user->setPassword($HashPassword);
        $entityManager->flush();

        // Envoyer le nouveau mot de passe à l'utilisateur (vous pouvez implémenter cette fonctionnalité)

        // Rediriger l'utilisateur vers une page de confirmation
        return $this->redirectToRoute('app_login');
    }

    /**
     * Générer un mot de passe aléatoire
     */
    private function generateRandomPassword($length = 10): string
    {
        $characters = '0123456789#abcdefghilkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $password;
    }

    #[Route('/confirmation-reinit-mdp', name: 'confirmation_reinit_mdp')]
    public function confirmationReinitMdp(): Response
    {
        // Vous pouvez personnaliser cette méthode pour afficher un message de confirmation à l'utilisateur
        return $this->render('reinit_mdp/confirmation.html.twig');
    }

    #[Route('/reinit-mdp-form', name: 'reinit_mdp_form')]
    public function reinitMdpForm(): Response
    {
        return $this->render('reinit_mdp/reinit_mdp_form.html.twig');
    }
}
