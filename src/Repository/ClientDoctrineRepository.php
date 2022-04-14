<?php

namespace App\Repository;

use App\Entity\ClientDoctrine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientDoctrine|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientDoctrine|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientDoctrine[]    findAll()
 * @method ClientDoctrine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientDoctrineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientDoctrine::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ClientDoctrine $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ClientDoctrine $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ClientDoctrine[] Returns an array of ClientDoctrine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClientDoctrine
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
