<?php

namespace App\Tests\Unit\Mitra\Client\Application;

use App\Tests\Unit\Mitra\Client\Domain\Dto\ClientDtoMother;
use App\Tests\Unit\Mitra\Client\Domain\Dto\CreatorClientDtoMother;
use Mitra\Client\Application\CreatorClientCommandHandler;
use Mitra\Client\Domain\Exception\ClientExistException;
use Mitra\Client\Domain\Interfaces\CreatorClientRepository;
use Mitra\Client\Domain\Interfaces\FindClientRepository;
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
            ->with($commandClientCreator->mapToDto()->getUuid())
            ->willReturn(null);

        $this->creatorClientMock
            ->expects(self::once())
            ->method('save')
            ->with($commandClientCreator->mapToDto())
            ->willReturn(true);

        //WHEN
        $creatorClient = new CreatorClientCommandHandler($this->creatorClientMock, $this->findClientMock);

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
            ->method('find')
            ->with($idClient)
            ->willReturn(ClientDtoMother::random());

        $this->creatorClientMock
            ->expects(self::never())
            ->method('save');

        $creatorClient = new CreatorClientCommandHandler($this->creatorClientMock, $this->findClientMock);

        //THEN
        $this->expectException(ClientExistException::class);
        $this->expectErrorMessage(sprintf('Client with id %s already exists', $idClient));
        $this->expectExceptionCode(409);

        //WHEN
        $creatorClient($commandClientCreator);

    }


}
