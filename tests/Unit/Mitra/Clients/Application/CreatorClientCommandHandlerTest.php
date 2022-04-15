<?php

namespace App\Tests\Unit\Mitra\Clients\Application;

use Mitra\Clients\Application\CreatorClientCommandHandler;
use Mitra\Clients\Domain\Interfaces\CreatorClientRepository;
use Mitra\Clients\Domain\Interfaces\FindClientRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreatorClientCommandHandlerTest extends TestCase
{
    private MockObject|CreatorClientRepository $creatorClientMock;
    private MockObject|FindClientRepository $findClientMock;

    protected function setUp(): void
    {
        $this->creatorClientMock = $this->createMock(CreatorClientRepository::class);
        $this->findClientMock = $this->createMock(FindClientRepository::class);
    }

    /**
     * @test
     */
    public function shouldCreatedClientAndReturnBooleanTrue(): void
    {
        //GIVEN
        $commandClientCreator = CreatorClientCommandMother::random();

        $this->findClientMock
            ->expects(self::once())
            ->method('find')
            ->with($commandClientCreator->getCreatorClientDto()->getUuid())
            ->willReturn(null);

        $this->creatorClientMock
            ->expects(self::once())
            ->method('save')
            ->with($commandClientCreator->getCreatorClientDto())
            ->willReturn(true);

        $creatorClient = new CreatorClientCommandHandler($this->creatorClientMock, $this->findClientMock);

        self::assertTrue($creatorClient($commandClientCreator));
    }

    /**
     * @test
     */
//    public function shouldThrowClientExistException() : void
//    {
//
//        $this->creatorClientMock
//            ->expects(self::never());
//    }


}
