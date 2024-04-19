<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;

class MailerService
{
    public function __construct(
        #[Autowire('%admin_email%')] private string $adminEmail,
        private readonly MailerInterface $mailer,
        private readonly Environment $twig,
    ) {
    }

    public function sendWelcomeEmail(): void
    {
        $email = (new NotificationEmail())
            ->from($this->adminEmail)
            ->to($this->adminEmail);

        $this->mailer->send($email);
    }

    public function sendContactFormEmail(string $name, string $email, string $message): void
    {
        $email = (new NotificationEmail())
            ->from($email)
            ->to($this->adminEmail)
            ->subject('Nouveau message du formulaire de contact')
            ->html($this->twig->render(
                'contact/email.html.twig',
                ['name' => $name, 'message' => $message]
            ));

        $this->mailer->send($email);
    }


}
