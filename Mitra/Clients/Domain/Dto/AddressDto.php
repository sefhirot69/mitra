<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain\Dto;

use Mitra\Clients\Domain\Address;
use Mitra\Clients\Domain\ValueObject\AddressId;
use Mitra\Clients\Domain\ValueObject\ClientId;

final class AddressDto
{

    public function __construct(
        private AddressId $id,
        private ClientId $idClient,
        private int $postalCode,
        private string $address,
        private string $city,
        private string $province,
        private bool $isActive,
    ) {
    }

    public static function create(
        string $uuid,
        string $uuidClient,
        int $postalCode,
        string $address,
        string $city,
        string $province,
        bool $isActive,
    ): self {
        return new self(
            $uuid,
            $uuidClient,
            $postalCode,
            $address,
            $city,
            $province,
            $isActive,
        );
    }

    /**
     * @return AddressId
     */
    public function getId(): AddressId
    {
        return $this->id;
    }

    /**
     * @return ClientId
     */
    public function getIdClient(): ClientId
    {
        return $this->idClient;
    }

    /**
     * @return int
     */
    public function getPostalCode(): int
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function mapToDomain() : Address {
        return new Address(
            $this->getId(),
            $this->getIdClient(),
            $this->getPostalCode(),
            $this->getAddress(),
            $this->getCity(),
            $this->getProvince(),
            $this->isActive(),
        );
    }

}