<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop/{type_str}", name="shop", requirements={"type_str"="homme|femme|accessoires|produits"})
     */
    public function shop($type_str, ProduitRepository $produitRepo, Request $request)
    {
        $params=[
            's' => false,
            'p_min' => false,
            'p_max' => false,
            'ordre' => false,
        ];

        // ré&cupérer les 4 params dans l'URL
        $p_min = $request->query->get('p_min');
        $p_max= $request->query->get('p_max');
        $ordre= $request->query->get('ordre');
        $s = $request->query->get('s');

        if ( $s || $ordre || $p_min || $p_max) {

            $params=[
                's' => $s,
                'p_min' => $p_min,
                'p_max' => $p_max,
                'ordre' => $ordre
            ];

            $produits = $produitRepo->findProducts($params);
        }else {
            $produits = $produitRepo->findProductsByType($type_str);
        }

        return $this->render('shop/shop.html.twig', [
            'produits' => $produits,
            'type_str' => $type_str,
            'params' => $params,
        ]);
        
    }

    /**
     * @Route("/shop/{type_str}/{id}-{slug}", name="produit_single")
     */
    public function produit_single($type_str, $id, $slug, ProduitRepository $produitRepo, EntityManagerInterface $em)
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
                return $this->redirectToRoute('shop',array (
                    'type_str' => 'produits'
                ));  
            }

            
          
        // Le slug du produit est il le meme que dan l'URL ?? Si non, rediriger sur la page actuelle, mais avec le bon slug
            
            if ($slug != $produit->getSlug()) {
                return $this->redirectToRoute('produit_single', array(
                    'id' => $id,
                    'slug' => $produit->getSlug(),
                    'type_str' => $produit->getTypeStr()
                ));               
            }
        
        return $this->render('shop/produit_single.html.twig', [
            'produit' => $produit
        ]);
       
    }
}
