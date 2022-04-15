<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain\Dto;

final class AddressDto
{

    public function __construct(
        private string $uuid,
        private string $uuidClient,
        private int $postalCode,
        private string $address,
        private string $city,
        private string $province,
        private bool $isActive,
    )
    {
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
    public function getUuidClient(): string
    {
        return $this->uuidClient;
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

}