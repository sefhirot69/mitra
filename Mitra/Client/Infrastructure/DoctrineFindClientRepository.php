<?php

declare(strict_types=1);


namespace Mitra\Client\Infrastructure;

use App\Entity\ClientDoctrine;
use Mitra\Client\Domain\ClientNotFoundException;
use Mitra\Client\Domain\Dto\ClientDto;
use Mitra\Client\Domain\Interfaces\FindClientRepository;
use Mitra\Shared\Domain\ValueObject\Uuid;
use Mitra\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineFindClientRepository extends DoctrineRepository implements FindClientRepository
{

    /**
     * @inheritDoc
     */
    public function find(Uuid $uuid): ?ClientDto
    {
        $clientDoctrine = $this->repository(ClientDoctrine::class)->findOneBy(['id' => $uuid]);

        if (null === $clientDoctrine) {
            throw new ClientNotFoundException($uuid->value());
        }
        return ClientDto::fromDomain($clientDoctrine->mapToDomain());
    }
}