<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SecurityController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/index/login", name: "app_login")]
    public function login(Request $request): Response
    {
        // Récupérer les informations de connexion depuis la requête
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        // Obtenir l'Entity Manager à partir du ManagerRegistry
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        // Vérifiez si un utilisateur a été trouvé et si le mot de passe correspond
        if (!$user || !password_verify($password, $user->getPassword())) {
            // Si les informations de connexion sont incorrectes, redirigez vers la page de connexion avec un message d'erreur
            $this->addFlash('error', 'Invalid email or password.');
            return $this->redirectToRoute('app_login');
        }

        // Authentification réussie, connectez l'utilisateur (voir la documentation Symfony sur l'authentification)
        // Redirigez l'utilisateur vers une page après la connexion
        return $this->redirectToRoute('app_home');
    }
}
