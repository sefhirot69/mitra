<?php

declare(strict_types=1);


namespace Mitra\Client\Infrastructure;

use App\Entity\ClientDoctrine;
use Mitra\Client\Domain\Dto\CreatorClientDto;
use Mitra\Client\Domain\Interfaces\CreatorClientRepository;
use Mitra\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineClientCreatorRepository extends DoctrineRepository implements CreatorClientRepository
{

    public function save(CreatorClientDto $creatorClientDto): bool
    {
        $clientDomain = $creatorClientDto->mapToDomain();

        $clientDoctrine = ClientDoctrine::create(
            $clientDomain->getId(),
            $clientDomain->getName(),
            $clientDomain->getSurname()
        );

        //Hay que convertir a dominio
        $this->persist($clientDoctrine);

        return true;
    }
}