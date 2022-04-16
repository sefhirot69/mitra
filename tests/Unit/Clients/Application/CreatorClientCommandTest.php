<?php

namespace App\Tests\Unit\Clients\Application;

use App\Tests\Unit\Mitra\Clients\Domain\Dto\CreatorClientDtoMother;
use Mitra\Clients\Application\CreatorClientCommand;
use PHPUnit\Framework\TestCase;

class CreatorClientCommandTest extends TestCase
{

    /**
     * @test
     */
    public function shouldCreatorClientCommandWithoutAddress(): void {

        //THEN
        $clientDto = CreatorClientDtoMother::random();

        $command = new CreatorClientCommand($clientDto);

        self::assertEquals($command->getCreatorClientDto(), $clientDto);

    }

    /**
     * @test
     */
    public function shouldCreatorClientCommandWithAddress(): void {

        //THEN
        $clientDto = CreatorClientDtoMother::randomWithAddress();

        $command = new CreatorClientCommand($clientDto);

        self::assertEquals($command->getCreatorClientDto(), $clientDto);

    }
}
