<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use App\Entity\Commandes;
use App\Repository\CommandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

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
    public function remove( $id, CartService $cartService)
    {
        $cartService->remove($id);

        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/panier/livraisons" , name="livraisons")
     */
    public function commandsPayement(Request $request, CartService $cartService, EntityManagerInterface $em, CommandesRepository $commandesRepository)
    {
        $params = $request->query->all();
        $commandes = new Commandes();
        $commandes->setNomProduit($cartService->getFullCart('nom'))
                    ->setNomUser($params['nom'])
                    ->setAdresseuser($params['adresse'])
                    ->setPrix($cartService->getFullCart('prix'))
                    ->setStatus('0');

        $em->persist($commandes);
        $em->flush();
    }
}
