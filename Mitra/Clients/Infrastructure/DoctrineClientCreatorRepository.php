<?php

declare(strict_types=1);


namespace Mitra\Clients\Infrastructure;

use App\Entity\ClientDoctrine;
use Mitra\Clients\Domain\Dto\CreatorClientDto;
use Mitra\Clients\Domain\Interfaces\CreatorClientRepository;
use Mitra\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineClientCreatorRepository extends DoctrineRepository implements CreatorClientRepository
{

    public function save(CreatorClientDto $creatorClientDto): bool
    {
        $clientDoctrine = ClientDoctrine::create(
            $creatorClientDto->getUuid()->uuidInterface(),
            $creatorClientDto->getName(),
            $creatorClientDto->getSurname()
        );

        //Hay que convertir a dominio
        $this->persist($clientDoctrine);

        return true;
    }
}