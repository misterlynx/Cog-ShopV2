<?php

namespace App\Service\Cart;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService {

    protected $session;
    protected $produitRepository;

    public function __construct(SessionInterface $session, ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
        $this->session = $session;
    }

    public function add(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        }else{
             $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);

    }
    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $this->session->set('panier', $panier);
    }

     public function getFullCart() : array
    {
        $panier = $this->session->get('panier', []);

        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'produit' => $this->produitRepository->find($id) ,
                'quantity' => $quantity
            ];
        }
        return $panierWithData;
    }

    public function getTotal() : float
    {
        $total = 0;

       
        foreach ($this->getFullCart() as $item) {
            $total += $item['produit']->getprix()* $item['quantity'];
        }

        return $total;
    }

    public function quantityMinus(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]-- ;
        }else{
            $panier[$id] = 0;
        }

        return $this->session->set('panier', $panier);
    }

    /**
    * toString
    * @return string
    */
   public function __toString()
   {
           return $this->getTotal();
   }
}