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
public function login(Request $request, UserRepository $userRepository): Response
{
    if ($this->getUser()) {
        return $this->redirectToRoute('app_home');
    }

    $user = new User();
    $form = $this->createForm(LoginType::class, $user);
    $form->handleRequest($request);
    if ($form->isSubmitted() && !$form->isValid()) {
        $errors = $form->getErrors(true, false);
        dd($errors);
    }

    if ($form->isSubmitted()) {
            $this->addFlash('info', 'Formulaire soumis et valide');

            $email = $form->get('_email')->getData();
            $password = $form->get('_password')->getData();
            dd($email, $password);
            $user = $userRepository->findOneBy(['email' => $email]);

            if (!$user || !password_verify($password, $user->getPassword())) {
                $this->addFlash('error', 'Invalid email or password.');
            } else {
                // Connexion réussie
            }
        } else {
            $this->addFlash('error', 'Formulaire soumis mais invalide');
        }


    return $this->render('home/login.html.twig', [
        'form' => $form->createView(),
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
