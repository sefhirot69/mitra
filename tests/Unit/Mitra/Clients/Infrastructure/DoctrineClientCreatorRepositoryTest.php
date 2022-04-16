<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Clients\Infrastructure;

use App\Tests\Unit\Mitra\Clients\Domain\Dto\CreatorClientDtoMother;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Mitra\Clients\Domain\Dto\CreatorClientDto;
use Mitra\Clients\Infrastructure\DoctrineClientCreatorRepository;
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
        self::assertTrue($result);
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
        self::assertTrue($result);
    }

    /**
     * @dataProvider providersExpectValidationError
     * @test
     */
    public function shouldReturnExceptionExpectedToCreatorClient(
        CreatorClientDto $clientDto,
        string $exceptionClass,
        string $errorMessage,
        string $errorCode
    ): void {


        //THEN
        $this->expectException($exceptionClass);
        $this->expectErrorMessage($errorMessage);
        $this->expectExceptionCode($errorCode);

        $this->entityManagerMock
            ->expects(self::never())
            ->method('persist');

        $repository = new DoctrineClientCreatorRepository($this->entityManagerMock);

        //WHEN
        $repository->save($clientDto);


    }


    public function providersExpectValidationError(): array
    {
        $clientWithIdInvalid = CreatorClientDtoMother::randomWithIdInvalid();
        return [
            [
                $clientWithIdInvalid,
                InvalidArgumentException::class,
                sprintf(
                    '<%s/> does not allow the value <%s>.',
                    InvalidArgumentException::class,
                    $clientWithIdInvalid->getUuid()->value()
                ),
                400
            ]
        ];
    }


}