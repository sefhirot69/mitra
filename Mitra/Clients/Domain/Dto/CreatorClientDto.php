<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain\Dto;

use Mitra\Shared\Domain\ValueObject\Uuid;

final class CreatorClientDto
{
    private Uuid $uuid;
    public function __construct(
        string $uuid,
        private string $name,
        private string $surname,
        private ?AddressDto $address = null
    ) {
        $this->uuid = new Uuid($uuid);
    }

    /**
     * @return Uuid
     */
    public function getUuid(): Uuid
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