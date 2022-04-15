<?php

namespace App\Tests\Unit\Mitra\Clients\Application;

use Mitra\Clients\Application\CreatorClientCommandHandler;
use PHPUnit\Framework\TestCase;

final class CreatorClientCommandHandlerTest extends TestCase
{
    private MockObject|CreatorClientRepostiory $creatorClientMock;

    protected function setUp(): void
    {
        $this->creatorClientMock = $this->createMock(CreatorClientRepository::class);
    }

    /**
     * @test
     */
    public function shouldCreatedClientAndReturnBooleanTrue() : void
    {
        //GIVEN
        $commandCreator =  CreatorClientCommandMother::random();
    }

    /**
     * @test
     */
    public function shouldThrowClientExistException() : void
    {

    }


}
