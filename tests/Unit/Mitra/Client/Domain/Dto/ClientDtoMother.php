<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Client\Domain\Dto;

use App\Tests\Unit\Mitra\Shared\Domain\MotherCreator;
use DateTimeImmutable;
use Mitra\Client\Domain\Dto\ClientDto;

final class ClientDtoMother
{
    public static function create(
        string $id,
        string $name,
        string $surname,
        DateTimeImmutable $createdAt,
        ?array $address = null
    ): ClientDto {
        return ClientDto::create($id, $name, $surname, $createdAt, $address);
    }

    public static function random(): ClientDto
    {
        return self::create(
            MotherCreator::random()->uuid(),
            MotherCreator::random()->firstName(),
            MotherCreator::random()->lastName(),
            DateTimeImmutable::createFromMutable(MotherCreator::random()->dateTime())
        );
    }
}