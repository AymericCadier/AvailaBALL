<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use App\Form\LoginType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route("/index/login", name: "app_login")]
    public function login(Request $request, AuthenticationUtils $authenticationUtils, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $userRepository->getUser($user->getEmail(), $user->getPassword());

            if (!$user) {
                // Si les informations de connexion sont incorrectes, redirigez vers la page de connexion avec un message d'erreur
                $this->addFlash('error', 'Invalid email or password.');
                return $this->redirectToRoute('app_home');
            }

            // Si la connexion est réussie, Symfony gérera automatiquement la création et la persistance du token d'authentification
            // Vous pouvez donc simplement rediriger l'utilisateur vers la page d'accueil
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));

            return $this->redirectToRoute('app_home');
        }

        // Si l'utilisateur est déjà connecté, redirigez-le vers la page d'accueil
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // Récupérer les informations d'erreur de connexion et le dernier nom d'utilisateur saisi
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('home/login.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }


    /*public function login(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $userRepository->getUserByEmailAndPassword($user->getEmail(), $user->getPassword());

            if (!$user) {
                // Si les informations de connexion sont incorrectes, redirigez vers la page de connexion avec un message d'erreur
                $this->addFlash('error', 'Invalid email or password.');
                return $this->redirectToRoute('app_login');
            }

            $this->addFlash('success', 'Connexion réussie !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }*/



}