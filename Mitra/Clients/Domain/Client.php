<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain;

use DateTimeImmutable;
use Mitra\Clients\Domain\ValueObject\ClientName;
use Mitra\Clients\Domain\ValueObject\ClientSurname;
use Mitra\Shared\Domain\Clients\ClientId;

class Client
{

    /**
     * @param ClientId $id
     * @param ClientName $name
     * @param ClientSurname $surname
     * @param DateTimeImmutable $createdAt
     * @param null|Address[] $address
     */
    public function __construct(
        private ClientId $id,
        private ClientName $name,
        private ClientSurname $surname,
        private DateTimeImmutable $createdAt,
        private ?array $address = null,
    ) {
    }

    public static function create(
        ClientId $id,
        ClientName $name,
        ClientSurname $surname,
        DateTimeImmutable $createdAt,
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
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
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