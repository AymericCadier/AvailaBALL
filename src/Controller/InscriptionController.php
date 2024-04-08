<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\InscriptionType;
use App\Repository\UserRepository;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class InscriptionController extends AbstractController
{
    #[Route('/index/inscription', name: 'app_inscription')]
    public function inscription(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    plainPassword: $user->getPassword()
                )
            );
            $user->setRoles(['ROLE_USER']);
            $userRepository->createUser(
                $user->getLname(),
                $user->getFname(),
                $user->getNickname(),
                $user->getEmail(),
                $user->getPassword()
            );
            return $this->render('home/index.html.twig');
        }
        return $this->render('security/inscriptionB.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}