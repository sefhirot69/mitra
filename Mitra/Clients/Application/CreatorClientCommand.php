<?php

declare(strict_types=1);


namespace Mitra\Clients\Application;

use Mitra\Clients\Domain\Dto\CreatorClientDto;
use Mitra\Clients\Domain\ValueObject\ClientId;
use Mitra\Clients\Domain\ValueObject\ClientName;
use Mitra\Clients\Domain\ValueObject\ClientSurname;


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