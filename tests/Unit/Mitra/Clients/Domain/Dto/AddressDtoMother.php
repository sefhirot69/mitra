<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Clients\Domain\Dto;

use App\Tests\Unit\Mitra\Shared\Domain\MotherCreator;
use Mitra\Clients\Domain\Dto\AddressDto;

final class AddressDtoMother
{
    public static function create(
        string $uuid,
        string $uuidClient,
        int $postalCode,
        string $address,
        string $city,
        string $province,
        bool $isActive
    ): AddressDto {
        return new AddressDto($uuid, $uuidClient, $postalCode, $address, $city, $province, $isActive);
    }

    public static function random(string $uuidClient): AddressDto
    {
        return self::create(
            MotherCreator::random()->uuid(),
            $uuidClient,
            (int)MotherCreator::random()->postcode(),
            MotherCreator::random()->address(),
            MotherCreator::random()->city(),
            MotherCreator::random()->city(),
            MotherCreator::random()->boolean(),
        );
    }
}