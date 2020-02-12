<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function getType($type_str) {
        if ($type_str == 'homme') {
            $type = 0;
        }elseif($type_str == 'femme'){
            $type = 1;
        }elseif ($type_str == 'Produits') {
            $type = array(0,1,2);
        }else {
            $type = 2;
        }
        return $type;
    }

    public function findProducts($s)
    {
        $produits = $this->createQueryBuilder("p")
        ->where('p.nom LIKE :search')
        ->setParameter('search', "%$s%")
        ->getQuery()
        ->getResult();

        return $produits;
        
    }

    public function findProductsByType($type_str)
    {
        $type = $this->getType($type_str);
        return $this->findBy([
            'type' => $type,
            'active' => '1',
        ]);
    }

    // /**
    //  * @return Produit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
