<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Request;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop/{type}", name="shop")
     */
    public function shop($type, Request $request, ProduitRepository $produitRepo )
    {
        $limit = 4; 
        $page = $request->query->get('page') ?? 1;
        $page = $page <1 ? 1 : $page;
        $offset = ($page - 1) * $limit;

        $produit = $produitRepo->findBy(
            array('active' => 1),
            array('date' => 'DESC'),
            $limit,
            $offset
        ); 
        
        return $this->render('shop/shop.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/shop/produit/{id}-{slug}", name="produit")
     */
    public function produit($id, $slug, ProduitRepository $produitRepo, EntityManagerInterface $em)
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
