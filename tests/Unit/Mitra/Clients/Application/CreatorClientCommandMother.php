<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Clients\Application;

use App\Tests\Unit\Mitra\Clients\Domain\Dto\CreatorClientDtoMother;
use Mitra\Clients\Application\CreatorClientCommand;
use Mitra\Clients\Domain\Dto\CreatorClientDto;

final class CreatorClientCommandMother
{
    public static function create(
        CreatorClientDto $creatorClientDto,
    ): CreatorClientCommand {
        return new CreatorClientCommand($creatorClientDto);
    }

    public static function random(): CreatorClientCommand
    {
        return self::create(
            CreatorClientDtoMother::random(),
        );
    }
}