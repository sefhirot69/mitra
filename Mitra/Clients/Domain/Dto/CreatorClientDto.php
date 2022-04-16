<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain\Dto;

use Mitra\Clients\Domain\Client;
use Mitra\Clients\Domain\ValueObject\ClientName;
use Mitra\Clients\Domain\ValueObject\ClientSurname;
use Mitra\Shared\Domain\Clients\ClientId;

final class CreatorClientDto
{
    public function __construct(
        private string $uuid,
        private string $name,
        private string $surname,
        private ?AddressDto $address = null
    ) {
    }

    public static function create(
        string $uuid,
        string $name,
        string $surname,
        ?AddressDto $address = null
    ): self {
        return new self(
            $uuid,
            $name,
            $surname,
            $address
        );
    }

    public static function mapToDomain(
        string $uuid,
        string $name,
        string $surname,
        ?AddressDto $address = null
    ): Client {
        return Client::create(
            new ClientId($uuid),
            new ClientName($name),
            new CLientSurname($surname),
            $address->mapToDomain()
        );
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
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

    /**
     * @return AddressDto|null
     */
    public function getAddress(): ?AddressDto
    {
        return $this->address;
    }

}