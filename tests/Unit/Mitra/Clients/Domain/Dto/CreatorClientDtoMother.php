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
        AddressDto $address): CreatorClientDto
    {
        return new CreatorClientDto($uuid, $name, $surname, $address);
    }

    public static function random(): CreatorClientDto
    {
        $idClient = MotherCreator::random()->uuid();
        return self::create(
            $idClient,
            MotherCreator::random()->firstName(),
            MotherCreator::random()->lastName(),
            AddressDtoMother::random($idClient)
        );
    }
}