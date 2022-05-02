<?php

declare(strict_types=1);

namespace Mitra\Client\Application;

use Mitra\Client\Domain\ClientCreatedDomainEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

//TODO refactorizar, estoy enviando evento de dominio con implementacion de Symfony
final class NotificationWelcomeOnClientCreatedHandler
{

    public function __construct(private MailerInterface $mailer)
    {
    }

    public function __invoke(ClientCreatedDomainEvent $event): void
    {
        $email = (new Email())
            ->from('josalillo@gmail.com')
            ->to('josalillo@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text($event->getName())
            ->html('<p>See Twig integration for better HTML integration!</p>');
        $this->mailer->send($email);
    }
}