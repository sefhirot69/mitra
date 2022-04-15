<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Clients\Application;

use App\Tests\Unit\Mitra\Clients\Domain\Dto\CreatorClientAddressDtoMother;
use App\Tests\Unit\Mitra\Clients\Domain\Dto\CreatorClientDtoMother;
use App\Tests\Unit\Mitra\Shared\Domain\MotherCreator;

final class CreatorClientCommandMother
{
    public static function create(string $value): CreatorClientCommand
    {
        return new CreatorClientCommand($value);
    }

    public static function random(): CreatorClientCommand
    {
        return self::create(
            CreatorClientDtoMother::random(),
            CreatorClientAddressDtoMother::random(),
        );
    }
}