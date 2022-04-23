<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Client\Infrastructure;

use App\Tests\Factory\ClientDoctrineFactory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Mitra\Client\Domain\ClientNotFoundException;
use Mitra\Client\Domain\ValueObject\ClientId;
use Mitra\Client\Infrastructure\DoctrineFindClientRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

final class DoctrineFindClientRepositoryTest extends TestCase
{
    private EntityManagerInterface|MockObject $entityManager;
    private ObjectRepository|MockObject $objectRepository;

    use Factories;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->objectRepository = $this->createMock(ObjectRepository::class);
    }

    /**
     * @test
     */
    public function shouldFindClient() : void
    {
        //GIVEN
        $clientId = ClientId::random();
        $clientDoctrine = ClientDoctrineFactory::new()->withoutPersisting()->create(['uuid' => $clientId->uuidInterface()]);

        $this->objectRepository
            ->expects(self::once())
            ->method('find')
            ->with($clientId)
            ->willReturn($clientDoctrine->object());
        $this->entityManager
            ->expects(self::once())
            ->method('getRepository')
            ->willReturn($this->objectRepository);

        $repository = new DoctrineFindClientRepository($this->entityManager);

        //WHEN
        $result = $repository->find($clientId);

        //THEN
        self::assertEquals($result->getUuid(), $clientId->value());
        self::assertEquals($result->getName(), $clientDoctrine->getName());
        self::assertEquals($result->getSurname(), $clientDoctrine->getSurname());

    }

    /**
     * @test
     */
    public function shouldExpectedExceptionClientNotFound() : void
    {
        //GIVEN
        $clientId = ClientId::random();
        $clientDoctrine = null;

        $this->objectRepository
            ->expects(self::once())
            ->method('find')
            ->with($clientId)
            ->willReturn($clientDoctrine);
        $this->entityManager
            ->expects(self::once())
            ->method('getRepository')
            ->willReturn($this->objectRepository);

        $repository = new DoctrineFindClientRepository($this->entityManager);

        //THEN
        $this->expectExceptionCode(ClientNotFoundException::class);
        $this->expectExceptionMessage(sprintf('Client <%s> not found.',$clientId->value()));
        $this->expectExceptionCode(404);

        //WHEN
        $repository->find($clientId);
    }

}