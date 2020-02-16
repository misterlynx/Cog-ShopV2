<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\ContactRepository;
use App\Service\EmailService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, ContactRepository $contactRepo, EmailService $emailService)
    {
        $contact = new Contact();
        
        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();
      
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();


            $emailService->contact($contact);
            
            $this->addFlash('success', "Le formulaire ete bien envoyé!");
            return $this->redirectToRoute('contact');
        }


        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }


    // public function contact(Request $request)
    // {

    //     $contact = new Contact();
    //     $form = $this->createForm(ContactFormType::class, $contact);
    //     $form->handleRequest($request);


    //     if($form->isSubmitted() && $form->isValid()){
    //         // dump($contact);die;
    //         $em = $this->getDoctrine()->getManager();
    //         $em->persist($contact);
    //         $em->flush();

    //         $this->addFlash('success', 'Votre message était bien envoyé.' );
    //     }
    //     // dump($form);die;
        


    //     return $this->render('contact/contact.html.twig', [
    //         'contactForm' => $form->createView(),
    //     ]);
    // }
}
