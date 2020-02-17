<?php


namespace App\Controller;

use App\Form\ProduitFormType;
use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommandesRepository;
use Symfony\Component\HttpFoundation\Request;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function administration(CommandesRepository $commandesRepository, Request $request)
    {

        $produits = new Produit();
        
        $form = $this->createForm(ProduitFormType::class, $produits);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $form->getData();
      
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            $this->addFlash('success', "Le formulaire ete bien envoyé!");
            return $this->redirectToRoute('administration');
        }


        $historique = $commandesRepository->findAll();

        return $this->render('administration/administration.html.twig', [
            'ProduitForm' => $form->createView(),
            'historiques' => $historique,
        ]);
    }
}
