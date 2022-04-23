<?php

declare(strict_types=1);


namespace Mitra\Client\Domain;

use DateTimeImmutable;
use Mitra\Client\Domain\ValueObject\AddressId;
use Mitra\Client\Domain\ValueObject\ClientId;

final class Address
{

    /**
     * @param AddressId $id
     * @param ClientId $client
     * @param int $postalCode
     * @param string $address
     * @param string $city
     * @param string $province
     * @param bool $isActive
     * @param DateTimeImmutable|null $createdAt
     */
    public function __construct(
        private AddressId $id,
        private ClientId $client,
        private int $postalCode,
        private string $address,
        private string $city,
        private string $province,
        private bool $isActive,
        private ?DateTimeImmutable $createdAt = null
    ) {
    }

    public static function create(
        AddressId $id,
        ClientId $client,
        int $postalCode,
        string $address,
        string $city,
        string $province,
        bool $isActive,
        ?DateTimeImmutable $createdAt = null
    ): self {
        return new self(
            $id,
            $client,
            $postalCode,
            $address,
            $city,
            $province,
            $isActive,
            $createdAt
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
    public function getClient(): ClientId
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
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

    /**
     * @return DateTimeImmutable|null
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

}