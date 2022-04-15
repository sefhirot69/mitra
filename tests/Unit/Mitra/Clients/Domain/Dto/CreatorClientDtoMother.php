<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Clients\Domain\Dto;

use App\Tests\Unit\Mitra\Shared\Domain\MotherCreator;

final class CreatorClientDtoMother
{
    public static function create(string $uuid, string $name, string $surname): CreatorClientDto
    {
        return new CreatorClientDto($uuid, $name, $surname);
    }
    
    public static function random(): CreatorClientDto
    {
        return self::create(
            MotherCreator::random()->uuid(),
            MotherCreator::random()->firstName(),
            MotherCreator::random()->lastName(),
        );
    }
}