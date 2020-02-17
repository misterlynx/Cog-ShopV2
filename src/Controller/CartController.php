<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use App\Entity\Commandes;
use App\Repository\CommandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Dompdf\Dompdf;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\SentMessage;

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

        $panier = $cartService->getFullCart();
        $produits = [];
        $total = 0;
        foreach ($panier as $p) {
            $produits[] = $p['produit'];
            $total = $total + $p['produit']->getPrix() * $p['quantity'];
        }

        $commande = (new Commandes())
            ->setUser($this->getUser())
            ->setVilleuser($this->getUser()->getVille())
            ->setCodepostal($this->getUser()->getCodepostal())
            ->setAdresseuser($this->getUser()->getAdresse())
            ->setPrix($total)
            ->setStatus(0);

        foreach ($produits as $produit) {
            $commande->addProduit($produit);
        }

        $em->persist($commande);
        $em->flush();

        $this->addFlash('success', "Votre payement à bien était pris en compte" );
        return $this->redirectToRoute('pdf', [ 'id' =>  $commande->getId() ]);
    }
    
    /**
     * @Route("/panier/decrement/{id}", name="cart_decrement")
     */
    public function decrement( $id, CartService $cartService )
    {
        $cartService->quantityMinus($id);

        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/pdf/{id}", name="pdf")
     */
    public function pdfCreator($id, CommandesRepository $commandesRepository)
    {

        $command = $commandesRepository->find($id);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->renderView('pdf.html.twig', [
            'command' => $command,
        ]));
        
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // $dompdf->stream("document.pdf", array("Attachment" => false));
        $output = $dompdf->output();
        file_put_contents('../private/facture/facture.pdf', $output);

        $this->addFlash('success', "Votre payement à bien était pris en compte" );
        return $this->redirectToRoute('redirect');
        
        // return $this->render('pdf.html.twig', [
        //     'produits' => $produits,
        // ]);
    }
<<<<<<< HEAD

    public function sendEmail(MailerInterface $mailer, SentMessage $sentEmail)
    {
        $email = (new Email())
            ->from('alexandrehainy12@gmail.com')
            ->to($this->getUser()->getEmail())
            ->subject('Validation de votre commande!')
            ->text($this->renderView('emails/validcommande.html.twig', [
            ]));

        $sentEmail = $mailer->send($email);
        // $messageId = $sentEmail->getMessageId();

        // ...
    }

=======
    /**
     * @Route("/success", name="success")
     */
    public function Pigeon()
    {
        return $this->render('cart/Success.html.twig', [
        ] );
    }
>>>>>>> e47eed4804208a130465751d8c68d20f8de60a37
}
