<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain\Dto;

final class CreatorClientDto
{
    public function __construct(
        private string $uuid,
        private string $name,
        private string $surname,
        private ?AddressDto $address = null
    ) {
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