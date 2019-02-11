<?php

namespace App\Repository;

use App\Entity\Gateau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Gateau|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gateau|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gateau[]    findAll()
 * @method Gateau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GateauRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gateau::class);
    }

    // /**
    //  * @return Gateau[] Returns an array of Gateau objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gateau
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
