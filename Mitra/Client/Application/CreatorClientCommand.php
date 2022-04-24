<?php

declare(strict_types=1);


namespace Mitra\Client\Application;

use Mitra\Client\Domain\ClientName;
use Mitra\Client\Domain\ClientSurname;
use Mitra\Client\Domain\Dto\CreatorClientDto;
use Mitra\Shared\Domain\ValueObject\ClientId;


final class CreatorClientCommand
{
    public function __construct(
        private string $idClient,
        private string $name,
        private string $surname,
    ) {
    }

    public function mapToDto(): CreatorClientDto
    {
        return CreatorClientDto::create(
            new ClientId($this->idClient),
            new ClientName($this->name),
            new ClientSurname($this->surname),
        );
    }
}