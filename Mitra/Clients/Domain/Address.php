<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain;

use DateTime;
use Mitra\Shared\Domain\Clients\AddressId;

final class Address
{

    public function __construct(
        private AddressId $id,
        private Client $client,
        private string $postalCode,
        private string $address,
        private string $city,
        private string $province,
        private bool $isActive,
        private DateTime $createdAt
    ) {
    }

    /**
     * @return AddressId
     */
    public function getId(): AddressId
    {
        return $this->id;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
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
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

}