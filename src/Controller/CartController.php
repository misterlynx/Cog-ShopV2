<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use App\Entity\Commandes;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Dompdf\Dompdf;

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
     * @Route("/panier/payement" , name="payement")
     */
    public function commandsPayement(CartService $cartService, EntityManagerInterface $em)
    {

        $user = new Users();

        $user->getId();

        $panier = $cartService->getFullCart();
        $produits = [];
        $total = 0;
        foreach ($panier as $p) {
            $produits[] = $p['produit'];
            $total = $total + $p['produit']->getPrix() * $p['quantity'];
        }

        $commande = new Commandes();
        $commande->getProduits();
        $commande->getUser();
        $commande->setAdresseuser('blabla');
        $commande->setPrix($total);
        $commande->setStatus('0');
        $commande->getId($user);

        foreach ($produits as $produit) {
            $commande->addProduit($produit);
        }

        $em->persist($commande);
        $em->flush();

        $this->addFlash('success', "Votre payement à bien était pris en compte" );
        return $this->redirectToRoute('accueil');
    }
    
    /**
     * @Route("/panier/decrement/{id}", name="cart_decrement")
     */
    public function decrement( $id, CartService $cartService )
    {
        $cartService->quantityMinus($id);

        return $this->redirectToRoute("cart");
    }

    public function pdfCreator(UsersRepository $usersRepository)
    {
        $user = $usersRepository->findAll();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->renderView('pdf.html.twig'));
        $dompdf->render();
        $dompdf->stream("test.pdf");
        
        return $this->render('pdf.html.twig', [
            'user' =>$user,
        ] );
    }
}
