<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Clients\Infrastructure;

use App\Tests\Unit\Mitra\Clients\Domain\Dto\CreatorClientDtoMother;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Mitra\Clients\Domain\Dto\CreatorClientDto;
use Mitra\Clients\Domain\ValueObject\ClientName;
use Mitra\Clients\Domain\ValueObject\ClientSurname;
use Mitra\Clients\Infrastructure\DoctrineClientCreatorRepository;
use Mitra\Shared\Domain\Clients\ClientId;
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
        int $errorCode
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

    //TODO esto son validaciones de entrada, deberia de ir en el command, porque no es lógica de negocio
    public function providersExpectValidationError(): array
    {
        $clientWithIdInvalid = CreatorClientDtoMother::randomWithIdInvalid();
        $clientWithNameInvalid = CreatorClientDtoMother::randomWithNameInvalid();
        $clientWithSurnameInvalid = CreatorClientDtoMother::randomWithSurnameInvalid();

        return [
            [
                $clientWithIdInvalid,
                InvalidArgumentException::class,
                sprintf(
                    '<%s> does not allow the value <%s>.',
                    ClientId::class,
                    $clientWithIdInvalid->getUuid()
                ),
                400
            ],
            [
                $clientWithNameInvalid,
                InvalidArgumentException::class,
                sprintf(
                    '<%s> must have a length between <3> and <50>.',
                    ClientName::class,
                ),
                400
            ],
            [
                $clientWithSurnameInvalid,
                InvalidArgumentException::class,
                sprintf(
                    '<%s> must have a length between <3> and <100>.',
                    ClientSurname::class,
                ),
                400
            ]
        ];
    }


}