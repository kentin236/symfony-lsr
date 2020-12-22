<?php


namespace App\Service;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class MailerService
{
    private $mailer;

    private $environment;

    public function __construct(MailerInterface $mailer, Environment $environment)
    {
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    public function sendMail1(): bool
    {
        try {
            $email = (new Email())
                ->from('')
                ->to('')
                ->cc('')
                ->bcc('')
                ->replyTo('')
                ->priority('')
                ->subject('')
                ->text('')
                ->html($this->environment->render('emails/index.html.twig', []))
                ->attachFromPath('')
                ->attach('');
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            return false;
        }

        try {
            $this->mailer->send($email);
            return true;
        } catch (TransportExceptionInterface $e) {
            return false;
        }
    }

    public function sendMail2()
    {
        $email2 = (new TemplatedEmail())
            ->from('')
            ->to(new Address(''))
            ->subject('')
            ->htmlTemplate('emails/index.html.twig')
            ->context([
                'name' => "Toto"
            ]);

        try {
            $this->mailer->send($email2);
            return true;
        } catch (TransportExceptionInterface $e) {
            return $e;
        }
    }
}