<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Client\Domain\Dto;

use App\Tests\Unit\Mitra\Shared\Domain\MotherCreator;
use Mitra\Client\Domain\ClientName;
use Mitra\Client\Domain\ClientSurname;
use Mitra\Client\Domain\Dto\CreatorClientDto;
use Mitra\Shared\Domain\ValueObject\ClientId;

final class CreatorClientDtoMother
{
    public static function create(
        ClientId $id,
        ClientName $name,
        ClientSurname $surname,
        ?array $address = null
    ): CreatorClientDto {
        return new CreatorClientDto($id, $name, $surname, $address);
    }

    public static function random(): CreatorClientDto
    {
        return self::create(
            new ClientId(MotherCreator::random()->uuid()),
            new ClientName(MotherCreator::random()->firstName()),
            new ClientSurname(MotherCreator::random()->lastName()),
        );
    }

    public static function randomWithAddress(): CreatorClientDto
    {
        $idClient = new ClientId(MotherCreator::random()->uuid());
        return self::create(
            $idClient,
            new ClientName(MotherCreator::random()->firstName()),
            new ClientSurname(MotherCreator::random()->lastName()),
            AddressDtoMother::randomArray($idClient)
        );
    }

    public static function randomWithIdInvalid(): CreatorClientDto
    {
        $idClient = new ClientId(MotherCreator::random()->word());
        return self::create(
            $idClient,
            new ClientName(MotherCreator::random()->firstName()),
            new ClientSurname(MotherCreator::random()->lastName()),
        );
    }

    public static function randomWithNameInvalid(): CreatorClientDto
    {
        $idClient = new ClientId(MotherCreator::random()->uuid());
        return self::create(
            $idClient,
            new ClientName(MotherCreator::random()->realTextBetween(81)),
            new ClientSurname(MotherCreator::random()->lastName()),
        );
    }

    public static function randomWithSurnameInvalid(): CreatorClientDto
    {
        $idClient = new ClientId(MotherCreator::random()->uuid());
        return self::create(
            $idClient,
            new ClientName(MotherCreator::random()->firstName()),
            new ClientSurname(MotherCreator::random()->realTextBetween(101)),
        );
    }
}