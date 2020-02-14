<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use App\Entity\Commandes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart")
     */
    public function index(CartService $cartService)
    {
        return $this->render('cart/cart.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal()
        ] );
    }
    /**
     * @Route("/panier/add/{id}", name="cart_add")
     * 
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);

        return $this->redirectToRoute("cart");
    }
    /**
     * @Route("/panier/remove/{id}" , name="cart_remove")
     */
    public function remove( $id, CartService $cartService )
    {
        $cartService->remove($id);

        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/panier/livraisons" , name="livraisons")
     */
    public function livraison(Request $request, CartService $cartService)
    {
       $params = $request->request->all();
       $info = [];

       foreach ($params as $pa) {
           $info[] = $pa['user'];
       }
       foreach ($params as $param) {
           $info->getUser($param);
       }
       dump($info); die;
    }

    /**
     * @Route("/panier/livraisons/payement" , name="payement")
     */
    public function commandsPayement(CartService $cartService, EntityManagerInterface $em)
    {
        $panier = $cartService->getFullCart();
        $produits = [];
        $total = 0;
        foreach ($panier as $p) {
            $produits[] = $p['produit'];
            $total = $total + $p['produit']->getPrix() * $p['quantity'];
        }

        $commande = new Commandes();
        $commande
                    ->setUser($this->getUser())
                    ->setAdresseuser('blabla')
                    ->setPrix($total)
                    ->setStatus('0');

        foreach ($produits as $produit) {
            $commande->addProduit($produit);
        }

        $em->persist($commande);
        $em->flush();

        return $this->redirectToRoute('accueil');
        $this->addFlash('success', "Votre payement à bien était pris en compte" );
    }
    /**
     * @Route("/panier/decrement/{id}", name="cart_decrement")
     */
    public function decrement( $id, CartService $cartService )
    {
        $cartService->quantityMinus($id);

        return $this->redirectToRoute("cart");
    }
}
