<?php

namespace App\Repository;

use App\Entity\Vetements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Vetements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vetements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vetements[]    findAll()
 * @method Vetements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VetementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vetements::class);
    }

    // /**
    //  * @return Vetements[] Returns an array of Vetements objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vetements
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
