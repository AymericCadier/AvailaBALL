<?php

namespace App\Controller;

use App\Entity\User;
use Cassandra\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class InscriptionController extends AbstractController
{
    #[Route('index/inscription', name: 'app_inscription')]
    public function inscription():Response
    {
        return $this->render('home/inscription.html.twig', [
            $this->render('home/inscription.html.twig')
        ]);
    }

}
