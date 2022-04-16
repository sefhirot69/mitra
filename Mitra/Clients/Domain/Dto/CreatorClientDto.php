<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain\Dto;

use Mitra\Clients\Domain\Address;
use Mitra\Clients\Domain\Client;
use Mitra\Clients\Domain\ValueObject\ClientId;
use Mitra\Clients\Domain\ValueObject\ClientName;
use Mitra\Clients\Domain\ValueObject\ClientSurname;

final class CreatorClientDto
{
    /**
     * @param ClientId $uuid
     * @param ClientName $name
     * @param ClientSurname $surname
     * @param AddressDto[]|null $address
     */
    public function __construct(
        private ClientId $uuid,
        private ClientName $name,
        private ClientSurname $surname,
        private ?array $address = null
    ) {
    }

    public static function create(
        ClientId $uuid,
        ClientName $name,
        ClientSurname $surname,
        ?array $address = null
    ): self {
        return new self(
            $uuid,
            $name,
            $surname,
            $address
        );
    }

    public function mapToDomain(): Client
    {
        return Client::create(
            $this->getUuid(),
            $this->getName(),
            $this->getSurname(),
            null,
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
            }, $this->getAddress() ?? []),
        );
    }

    /**
     * @return ClientId
     */
    public function getUuid(): ClientId
    {
        return $this->uuid;
    }

    /**
     * @return ClientName
     */
    public function getName(): ClientName
    {
        return $this->name;
    }

    /**
     * @return ClientSurname
     */
    public function getSurname(): ClientSurname
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