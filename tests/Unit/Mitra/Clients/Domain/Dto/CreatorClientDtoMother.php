<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Clients\Domain\Dto;

use App\Tests\Unit\Mitra\Shared\Domain\MotherCreator;
use Mitra\Clients\Domain\Dto\AddressDto;
use Mitra\Clients\Domain\Dto\CreatorClientDto;

final class CreatorClientDtoMother
{
    public static function create(
        string $uuid,
        string $name,
        string $surname,
        ?AddressDto $address = null
    ): CreatorClientDto {
        return new CreatorClientDto($uuid, $name, $surname, $address);
    }

    public static function random(): CreatorClientDto
    {
        return self::create(
            MotherCreator::random()->uuid(),
            MotherCreator::random()->firstName(),
            MotherCreator::random()->lastName(),
        );
    }

    public static function randomWithAddress(): CreatorClientDto
    {
        $idClient = MotherCreator::random()->uuid();
        return self::create(
            $idClient,
            MotherCreator::random()->firstName(),
            MotherCreator::random()->lastName(),
            AddressDtoMother::random($idClient)
        );
    }

    public static function randomWithIdInvalid(): CreatorClientDto
    {
        $idClient = MotherCreator::random()->word();
        return self::create(
            $idClient,
            MotherCreator::random()->firstName(),
            MotherCreator::random()->lastName(),
        );
    }

    public static function randomWithNameInvalid(): CreatorClientDto
    {
        $idClient = MotherCreator::random()->uuid();
        return self::create(
            $idClient,
            MotherCreator::random()->realTextBetween(81),
            MotherCreator::random()->lastName(),
        );
    }

    public static function randomWithSurnameInvalid(): CreatorClientDto
    {
        $idClient = MotherCreator::random()->uuid();
        return self::create(
            $idClient,
            MotherCreator::random()->firstName(),
            MotherCreator::random()->realTextBetween(101),
        );
    }
}