<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

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

    public function getTypeArray($type_str) {
        if ($type_str == 'homme') {
            $type = array(0);
        }elseif($type_str == 'femme'){
            $type = array(1);
        }elseif ($type_str == 'accessoires') {
            $type = array(2);
        }else {
            $type = array(0,1,2);
        }
        return $type;
    }

    public function findProducts($params)
    {
        // dump($params); die;
        
        $type = $this->getTypeArray($params['type_str']);
      

        $query = $this->createQueryBuilder("p")
            ->andWhere('p.type IN (:type)')
            ->setParameter('type' , $type);


        $userlessWords = [ 'au', 'de', 'le', 'à' ];

        if($params['s']) {
            $mots = explode( ' ', $params['s']);
            // dump($mots);die;

            foreach ($mots as $key => $mot) {
                if (!in_array($mot, $userlessWords)) {
                     $query->andWhere('p.nom LIKE :mot'.$key)
                    ->setParameter('mot'.$key, "%". $mot ."%");
                    // echo 'key : ' . $key . '  --- mot : ' . $mot . ' <br>';
                } 
            }
            
        }
        
        if($params['p_min']){
            $query->andWhere('p.prix >= :p_min')
            ->setParameter('p_min', $params['p_min']);
        }

        if($params['p_max']){
            $query->andWhere('p.prix <= :p_max')
            ->setParameter('p_max', $params['p_max']);
        }


        $champ = 'p.id'; $ordre = 'DESC';
        if ($params['ordre']) {
            if ($params['ordre'] == 'croissant') {
                $champ = 'p.prix'; $ordre = 'ASC';
            }
            if ($params['ordre'] == 'decroissant') {
                $champ = 'p.prix'; $ordre = 'DESC';
            }
        }
        $query->orderBy($champ, $ordre);

        //Compteur des pages
        $nbProduits = $query->select('COUNT(p.id)')->getQuery()->getSingleScalarResult();
        $per_page = 8;
        $nbPages = floor($nbProduits / $per_page);
        if ($nbProduits % $per_page > 0) {
            $nbPages ++;
        } 
        // dump($nbPages);die;
        
        // Pagination
        $page = $params['page'];
        $offset = ($page - 1) * $per_page;

         $produits = $query
            ->select('p')
            ->setFirstResult($offset)
            ->setMaxResults($per_page)
            ->getQuery()
            ->getResult();

            // dump($produits);die;
        return [
            'nbProduits' => $nbProduits,
            'produits' => $produits,
            'nbPages' => $nbPages
        ];
        
    }

    // public function findProductsByType($type_str)
    // {
    //     $type = $this->getType($type_str);
    //     return $this->findBy([
    //         'type' => $type,
    //         'active' => '1',
    //     ]);
    // }

    public function produitsTrierPrix()
    {
        $tri = $this->createQueryBuilder("p")
        ->orderBy('p.prix', '0')
        ->getQuery()
        ->getResult();

        return $tri;
        
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
