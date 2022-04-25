<?php

declare(strict_types=1);


namespace Mitra\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use Mitra\Client\Infrastructure\Persistence\Doctrine\EntityRoot;

abstract class DoctrineRepository
{


    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    protected function entityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function persist(EntityRoot $entity): void
    {
        $this->entityManager()->persist($entity);
        $this->entityManager()->flush($entity);
    }

    protected function remove(EntityRoot $entity): void
    {
        $this->entityManager()->remove($entity);
        $this->entityManager()->flush($entity);
    }

    protected function repository(string $entityClass): EntityRepository|ObjectRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}