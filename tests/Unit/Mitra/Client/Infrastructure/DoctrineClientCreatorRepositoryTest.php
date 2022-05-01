<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Client\Infrastructure;

use App\Tests\Unit\Mitra\Client\Domain\Dto\CreatorClientDtoMother;
use Doctrine\ORM\EntityManagerInterface;
use Mitra\Client\Infrastructure\DoctrineClientCreatorRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class DoctrineClientCreatorRepositoryTest extends TestCase
{
    private EntityManagerInterface|MockObject $entityManagerMock;

    protected function setUp(): void
    {
        $this->entityManagerMock = $this->createMock(EntityManagerInterface::class);
    }

    /**
     * @test
     */
    public function shouldPersistClientWithoudAddressInDatabaseAndReturnTrue(): void
    {
        //GIVEN
        $creatorClientDto = CreatorClientDtoMother::random();

        $this->entityManagerMock
            ->expects(self::once())
            ->method('persist');

        $repository = new DoctrineClientCreatorRepository($this->entityManagerMock);

        //WHEN
        $result = $repository->save($creatorClientDto);

        //THEN
        self::assertNotEmpty($result);
    }

    /**
     * @test
     */
    public function shouldPersistClientWithAddressInDatabaseAndReturnTrue(): void
    {
        //GIVEN
        $creatorClientDto = CreatorClientDtoMother::randomWithAddress();

        $this->entityManagerMock
            ->expects(self::once())
            ->method('persist');

        $repository = new DoctrineClientCreatorRepository($this->entityManagerMock);

        //WHEN
        $result = $repository->save($creatorClientDto);

        //THEN
        self::assertObjectHasAttribute('address',$result);
    }

}