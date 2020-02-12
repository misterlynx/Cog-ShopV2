<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(SessionInterface $session, ProduitRepository $produitRepository)
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'produit' => $produitRepository->find($id) ,
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach ($panierWithData as $item) {
            $totalItem = $item['produit']->getprix()* $item['quantity'];
            $total += $totalItem;
        }
        return $this->render('cart/index.html.twig', [
            'items' =>$panierWithData,
            'total' => $total
        ] );
    }
    /**
     * @Route("/panier/add/{id}", name="cart_add")
     * 
     */
    public function add($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        }else{
             $panier[$id] = 1;
        }

        $session->set('panier', $panier);
    }
}
