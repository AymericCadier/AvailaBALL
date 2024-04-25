<?php
// src/Controller/ContactController.php
namespace App\Controller;

use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MailerController extends AbstractController
{

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerService $mailerService): Response
    {
        if ($request->isMethod('POST')) {
            $mailerService->sendContactFormEmail($request);

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/index.html.twig');
    }
}
