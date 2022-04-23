<?php

declare(strict_types=1);


namespace Mitra\Client\Domain\Dto;

use DateTimeImmutable;
use Mitra\Client\Domain\Address;
use Mitra\Client\Domain\Client;

final class ClientDto
{

    /**
     * @param string $uuid
     * @param string $name
     * @param string $surname
     * @param DateTimeImmutable $createdAt
     * @param AddressDto[]|null $address
     */
    private function __construct(
        private string $uuid,
        private string $name,
        private string $surname,
        private DateTimeImmutable $createdAt,
        private ?array $address = null
    ) {
    }

    public static function create(
        string $uuid,
        string $name,
        string $surname,
        DateTimeImmutable $createdAt,
        ?array $address = null
    ): self {
        return new self(
            $uuid,
            $name,
            $surname,
            $createdAt,
            $address
        );
    }

    public static function fromDomain(Client $client): self
    {
        return new self(
            $client->getId()->value(),
            $client->getName(),
            $client->getSurname(),
            $client->getCreatedAt(),
            array_map(static function (AddressDto $addressDto) {
                return Address::create(
                    $addressDto->getId(),
                    $addressDto->getIdClient(),
                    $addressDto->getPostalCode(),
                    $addressDto->getAddress(),
                    $addressDto->getCity(),
                    $addressDto->getProvince(),
                    $addressDto->isActive(),
                );
            }, $client->getAddress() ?? [])
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
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
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
     * @return AddressDto[]|null
     */
    public function getAddress(): ?array
    {
        return $this->address;
    }
}