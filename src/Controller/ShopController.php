<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop/{type}", name="shop")
     */
    public function shop($type)
    {
        
        return $this->render('shop/shop.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }

    /**
     * @Route("/shop/produit/{id}-{slug}", name="produit")
     */
    public function produit($id, $slug, ProduitRepository $produitRepo, EntityManagerInterface $em)
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


        // dump($produit);die;
        
        return $this->render('shop/produit.html.twig', [
            'produit' => $produit
        ]);
    }

   
}
