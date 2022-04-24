<?php

declare(strict_types=1);


namespace Mitra\Shared\Domain\Bus\Event;

use DateTimeInterface;

abstract class DomainEvent
{

    private ?string $eventId;
    private ?string $occurredOn;

    public function __construct(
        private string $aggregateId,
        string $eventId = null,
        string $occurredOn = null
    ) {
        $now = new \DateTimeImmutable();
        $this->eventId = $eventId;
        $this->occurredOn = $occurredOn ?: $now->format(DateTimeInterface::ATOM);
    }

    abstract public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): self;

    abstract public static function eventName(): string;

    abstract public function toPrimitives(): array;

    /**
     * @return string|null
     */
    public function getEventId(): ?string
    {
        return $this->eventId;
    }

    /**
     * @return string|null
     */
    public function getOccurredOn(): ?string
    {
        return $this->occurredOn;
    }

    /**
     * @return string
     */
    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }


}