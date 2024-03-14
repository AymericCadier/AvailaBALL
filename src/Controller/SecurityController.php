<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{

    #[Route("index/login", name: "app_login")]

    public function login(): Response
    {
        return $this->render('home/login.html.twig');
    }
}

