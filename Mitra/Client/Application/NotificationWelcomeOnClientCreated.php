<?php

declare(strict_types=1);

namespace Mitra\Client\Application;

use Mitra\Client\Domain\ClientCreatedDomainEvent;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

//TODO refactorizar, estoy enviando evento de dominio con implementacion de Symfony
final class NotificationWelcomeOnClientCreated implements MessageHandlerInterface
{
    public function __invoke(ClientCreatedDomainEvent $event): void
    {
        $test = 'as';
    }
}