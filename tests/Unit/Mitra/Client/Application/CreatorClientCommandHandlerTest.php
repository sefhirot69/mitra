<?php

namespace App\Tests\Unit\Mitra\Client\Application;

use App\Tests\Unit\Mitra\Client\Domain\Dto\ClientDtoMother;
use Mitra\Client\Application\CreatorClientCommandHandler;
use Mitra\Client\Domain\ClientExistException;
use Mitra\Client\Domain\ClientNotFoundException;
use Mitra\Client\Domain\CreatorClientRepository;
use Mitra\Client\Domain\ClientFinder;
use Mitra\Shared\Domain\Bus\Event\EventBus;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreatorClientCommandHandlerTest extends TestCase
{
    private MockObject|CreatorClientRepository $creatorClientMock;
    private MockObject|ClientFinder $findClientMock;
    private MockObject|EventBus $eventBusMock;

    protected function setUp(): void
    {
        $this->creatorClientMock = $this->createMock(CreatorClientRepository::class);
        $this->findClientMock = $this->createMock(ClientFinder::class);
        $this->eventBusMock = $this->createMock(EventBus::class);
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
            ->method('__invoke')
            ->with($commandClientCreator->mapToDto()->getUuid())
            ->willThrowException(new ClientNotFoundException($commandClientCreator->mapToDto()->getUuid()));

        $this->creatorClientMock
            ->expects(self::once())
            ->method('save')
            ->with($commandClientCreator->mapToDto())
            ->willReturn($commandClientCreator->mapToDto()->mapToDomain());

        //WHEN
        $creatorClient = new CreatorClientCommandHandler(
            $this->creatorClientMock,
            $this->findClientMock,
            $this->eventBusMock
        );

        self::assertTrue($creatorClient($commandClientCreator));
    }

    /**
     * @test
     * @throws ClientExistException
     */
    public function shouldThrowClientExistException(): void
    {
        //GIVEN
        $commandClientCreator = CreatorClientCommandMother::random();
        $idClient = $commandClientCreator->mapToDto()->getUuid();

        $this->findClientMock
            ->expects(self::once())
            ->method('__invoke')
            ->with($idClient)
            ->willReturn(ClientDtoMother::random());

        $this->creatorClientMock
            ->expects(self::never())
            ->method('save');

        $creatorClient = new CreatorClientCommandHandler(
            $this->creatorClientMock,
            $this->findClientMock,
            $this->eventBusMock
        );

        //THEN
        $this->expectException(ClientExistException::class);
        $this->expectErrorMessage(sprintf('Client with id %s already exists', $idClient));
        $this->expectExceptionCode(409);

        //WHEN
        $creatorClient($commandClientCreator);
    }


}
