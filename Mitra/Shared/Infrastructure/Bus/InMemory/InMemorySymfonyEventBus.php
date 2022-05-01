<?php

declare(strict_types=1);

namespace Mitra\Shared\Infrastructure\Bus\InMemory;

use Mitra\Shared\Domain\Bus\Event\DomainEvent;
use Mitra\Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\Messenger\MessageBusInterface;

use function Lambdish\Phunctional\each;

final class InMemorySymfonyEventBus implements EventBus
{


    public function __construct(private MessageBusInterface $bus)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        each($this->publisher(), $events);
    }

    private function publisher(): callable
    {
        return function (DomainEvent $event) {
            $this->bus->dispatch($event);
        };
    }
}