<?php

declare(strict_types=1);


namespace Mitra\Client\Domain;

use DateTimeImmutable;
use Mitra\Shared\Domain\Aggregate\AggregateRoot;
use Mitra\Shared\Domain\ValueObject\ClientId;

class Client extends AggregateRoot
{

    /**
     * @param ClientId $id
     * @param ClientName $name
     * @param ClientSurname $surname
     * @param DateTimeImmutable|null $createdAt
     * @param null|Address[] $address
     */
    private function __construct(
        private ClientId $id,
        private ClientName $name,
        private ClientSurname $surname,
        private ?DateTimeImmutable $createdAt = null,
        private ?array $address = null,
    ) {
        $this->record(
            ClientCreatedDomainEvent::create(
                $id->value(),
                $name->value(),
                $surname->value()
            ),
        );
    }

    public static function create(
        ClientId $id,
        ClientName $name,
        ClientSurname $surname,
        ?DateTimeImmutable $createdAt = null,
        $address = null,
    ): self {
        return new self(
            $id,
            $name,
            $surname,
            $createdAt,
            $address,
        );
    }

    /**
     * @return ClientId
     */
    public function getId(): ClientId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name->value();
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname->value();
    }

    /**
     * @return null|DateTimeImmutable
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return Address[]|null
     */
    public function getAddress(): ?array
    {
        return $this->address;
    }

}