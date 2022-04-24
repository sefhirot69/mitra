<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Client\Domain\Dto;

use App\Tests\Unit\Mitra\Shared\Domain\MotherCreator;
use Mitra\Client\Domain\AddressId;
use Mitra\Client\Domain\Dto\AddressDto;
use Mitra\Shared\Domain\ValueObject\ClientId;

final class AddressDtoMother
{
    public static function create(
        AddressId $id,
        ClientId $idClient,
        int $postalCode,
        string $address,
        string $city,
        string $province,
        bool $isActive
    ): AddressDto {
        return new AddressDto($id, $idClient, $postalCode, $address, $city, $province, $isActive);
    }

    /**
     * @param ClientId $idClient
     * @return AddressDto
     */
    public static function random(ClientId $idClient): AddressDto
    {
        return self::create(
            new AddressId(MotherCreator::random()->uuid()),
            $idClient,
            (int)MotherCreator::random()->postcode(),
            MotherCreator::random()->address(),
            MotherCreator::random()->city(),
            MotherCreator::random()->city(),
            MotherCreator::random()->boolean(),
        );
    }

    /**
     * @param ClientId $idClient
     * @return AddressDto[]
     */
    public static function randomArray(ClientId $idClient): array
    {
        return [
            self::create(
                new AddressId(MotherCreator::random()->uuid()),
                $idClient,
                (int)MotherCreator::random()->postcode(),
                MotherCreator::random()->address(),
                MotherCreator::random()->city(),
                MotherCreator::random()->city(),
                true,
            ),
            self::create(
                new AddressId(MotherCreator::random()->uuid()),
                $idClient,
                (int)MotherCreator::random()->postcode(),
                MotherCreator::random()->address(),
                MotherCreator::random()->city(),
                MotherCreator::random()->city(),
                false,
            ),
        ];
    }
}