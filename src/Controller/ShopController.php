<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop/{type_str}", name="shop", requirements={"type_str"="homme|femme|accessoires|all"})
     */
    public function shop($type_str, Request $request, ProduitRepository $produitRepo, Produit $produit )
    {
        $limit = 4; 
        $page = $request->query->get('page') ?? 1;
        $page = $page <1 ? 1 : $page;
        $offset = ($page - 1) * $limit;

        $produit = $produitRepo->findBy(
            array('active' => 1),
            array('nom' => 'DESC'),
            $limit,
            $offset
        ); 
        
        return $this->render('shop/shop.html.twig', [
            'produit' => $produit,
            'produits' => $produitRepo->findProductsByType($type_str),
        ]);
    }

    /**
     * @Route("/shop/{type_str}/{id}-{slug}", name="produit")
     */
    public function produit($type_str, $id, $slug, ProduitRepository $produitRepo, EntityManagerInterface $em)
    {
        $produit = $produitRepo->find($id);
       

        // Si pas de produits, rediriger vers une autre page avec un msg : Produit non existant
            // if (!$produit) {
            //     throw $this->createNotFoundException(
            //         'No products found for id '.$id
            //     );
            // }
        
            if (!$produit) {
                $this->addFlash('danger', "Le produit demandé ne existe pas!");
                return $this->redirectToRoute('shop');  
            }

            
          
        // Le slug du produit est il le meme que dan l'URL ?? Si non, rediriger sur la page actuelle, mais avec le bon slug
            
            if ($slug != $produit->getSlug()) {
                return $this->redirectToRoute('produit', array(
                    'id' => $id,
                    'slug' => $produit->getSlug()
                ));               
            }
        
        
        return $this->render('shop/produit.html.twig', [
            'produit' => $produit
        ]);
    }

   
}