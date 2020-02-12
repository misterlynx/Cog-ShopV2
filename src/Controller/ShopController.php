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
    public function shop($type_str, ProduitRepository $produitRepo, Request $request)
    {
        $s = $request->query->get('s');
        if ($s) {
            $produits = $produitRepo->findProducts($s);
        }else {
            $produits = $produitRepo->findProductsByType($type_str);
        }
        return $this->render('shop/shop.html.twig', [
            'produits' => $produits,
            'type_str' => $type_str,
        ]);
    }

    /**
     * @Route("/shop/{type_str}/{id}-{slug}", name="produit")
     */
    public function produit($type_str, $id, $slug, ProduitRepository $produitRepo, EntityManagerInterface $em)
    {
        $produit = $produitRepo->findOneBy(array(
            'id' => $id
        ) );
       

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

        // dump($produit);die;
        
        return $this->render('shop/produit.html.twig', [
            'produit' => $produit
        ]);
    }

   
}
