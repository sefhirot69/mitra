<?php

declare(strict_types=1);


namespace Mitra\Client\Domain;

use Mitra\Shared\Domain\Bus\Event\DomainEvent;

final class ClientCreatedDomainEvent extends DomainEvent
{

    private function __construct(
        string $id,
        private string $name,
        private string $surname,
        ?string $eventId = null,
        ?string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function create(
        string $id,
        string $name,
        string $surname,
        ?string $eventId = null,
        ?string $occurredOn = null
    ): self {
        return new self(
            $id,
            $name,
            $surname,
            $eventId,
            $occurredOn
        );
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self($aggregateId, $body['name'], $body['surname'], $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'client.created';
    }

    public function toPrimitives(): array
    {
        return [
            'name' => $this->name,
            'duration' => $this->surname
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

}