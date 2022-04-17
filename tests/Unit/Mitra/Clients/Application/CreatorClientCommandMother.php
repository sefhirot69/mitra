<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Clients\Application;

use App\Tests\Unit\Mitra\Shared\Domain\MotherCreator;
use Mitra\Clients\Application\CreatorClientCommand;

final class CreatorClientCommandMother
{
    public static function create(
        string $idClient,
        string $name,
        string $surname,
    ): CreatorClientCommand {
        return new CreatorClientCommand($idClient, $name, $surname);
    }

    public static function random(): CreatorClientCommand
    {
        return self::create(
            MotherCreator::random()->uuid(),
            MotherCreator::random()->firstName(),
            MotherCreator::random()->lastName(),
        );
    }
}