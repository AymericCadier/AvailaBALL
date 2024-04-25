<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;

class MailerService
{
    public function __construct(
        #[Autowire('%admin_email%')] private readonly string $adminEmail,
        private readonly MailerInterface $mailer,
    ) {
    }
    public function sendContactFormEmail(Request $request): void
    {
        $name = $request->request->get('name');
        $message = $request->request->get('message');

        $email = (new NotificationEmail())
            ->from($this->adminEmail)
            ->to($this->adminEmail)
            ->subject("Message de contact")
            ->htmlTemplate('contact/contact.html.twig')
            ->context([
                'name' => $name,
                'message' => $message,
            ]);

        $this->mailer->send($email);
    }


}
