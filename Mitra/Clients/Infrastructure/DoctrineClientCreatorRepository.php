<?php

declare(strict_types=1);


namespace Mitra\Clients\Infrastructure;

use App\Entity\ClientDoctrine;
use DateTimeImmutable;
use Mitra\Clients\Domain\Client;
use Mitra\Clients\Domain\Dto\CreatorClientDto;
use Mitra\Clients\Domain\Interfaces\CreatorClientRepository;
use Mitra\Clients\Domain\ValueObject\ClientName;
use Mitra\Clients\Domain\ValueObject\ClientSurname;
use Mitra\Shared\Domain\Clients\ClientId;
use Mitra\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineClientCreatorRepository extends DoctrineRepository implements CreatorClientRepository
{

    public function save(CreatorClientDto $creatorClientDto): bool
    {
        $clientDomain = Client::create(
            new ClientId(
                $creatorClientDto->getUuid()
            ),
            new ClientName($creatorClientDto->getName()),
            new ClientSurname($creatorClientDto->getSurname()),
            new DateTimeImmutable(),
        );

        $clientDoctrine = ClientDoctrine::create(
            $clientDomain->getId()->uuidInterface(),
            $clientDomain->getName(),
            $clientDomain->getSurname()
        );

        //Hay que convertir a dominio
        $this->persist($clientDoctrine);

        return true;
    }
}