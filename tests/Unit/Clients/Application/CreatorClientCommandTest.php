<?php

namespace App\Tests\Unit\Clients\Application;

use App\Tests\Unit\Mitra\Shared\Domain\MotherCreator;
use InvalidArgumentException;
use Mitra\Clients\Application\CreatorClientCommand;
use Mitra\Clients\Domain\ValueObject\ClientId;
use Mitra\Clients\Domain\ValueObject\ClientName;
use Mitra\Clients\Domain\ValueObject\ClientSurname;
use PHPUnit\Framework\TestCase;

class CreatorClientCommandTest extends TestCase
{

    /**
     * @dataProvider providersExpectValidationError
     * @test
     */
    public function shouldExpectExceptionToCreatorClientDto(
        array $data,
        string $exception,
        string $errorMessage,
        int $errorCode
    ): void {

        //GIVEN
        [$idClient, $name, $surname] = $data;

        //THEN
        $this->expectException($exception);
        $this->expectErrorMessage($errorMessage);
        $this->expectExceptionCode($errorCode);


        $command = new CreatorClientCommand($idClient, $name, $surname);

        $command->mapToDto();
    }

    public function providersExpectValidationError(): array
    {
        $nameInvalid = MotherCreator::random()->realTextBetween(81);
        $surnameInvalid = MotherCreator::random()->realTextBetween(101);
        $idInvalid = 'asd-qwerty-123';

        return [
            [
                [
                    $idInvalid,
                    MotherCreator::random()->firstName(),
                    MotherCreator::random()->lastName(),
                ],
                InvalidArgumentException::class,
                sprintf(
                    '<%s> does not allow the value <%s>.',
                    ClientId::class,
                    $idInvalid
                ),
                400
            ],
            [
                [
                    MotherCreator::random()->uuid(),
                    $nameInvalid,
                    MotherCreator::random()->lastName()
                ],
                InvalidArgumentException::class,
                sprintf(
                    '<%s> must have a length between <3> and <50>.',
                    ClientName::class,
                ),
                400
            ],
            [
                [
                    MotherCreator::random()->uuid(),
                    MotherCreator::random()->lastName(),
                    $surnameInvalid
                ],
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
