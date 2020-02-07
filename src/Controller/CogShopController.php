<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CogShopController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {
        return $this->render('cog_shop/accueil.html.twig', [
            
        ]);
    }

    /**
     * @Route("/CogShop-a-propos", name="apropos")
     */
    public function apropos()
    {
        return $this->render('cog_shop/apropos.html.twig', [
            
        ]);
    }

    /**
     * @Route("/CogShop-histoire", name="histoire")
     */
    public function histoire()
    {
        return $this->render('cog_shop/histoire.html.twig', [
            
        ]);
    }

    /**
     * @Route("/CogShop-contact", name="contact")
     */
    public function contact()
    {
        return $this->render('cog_shop/contact.html.twig', [
            
        ]);
    }
    /**
     * @Route("/CogShop-shop", name="shop")
     */
    public function shop()
    {
        return $this->render('cog_shop/shop/shop.html.twig', [
            
        ]);
    }

    /**
     * @Route("/CogShop-vetements-homme", name="homme")
     */
    public function homme()
    {
        return $this->render('shop/homme.html.twig', [
            
        ]);
    }

    /**
     * @Route("/CogShop-vetements-femme", name="femme")
     */
    public function femme()
    {
        return $this->render('shop/femme.html.twig', [
            
        ]);
    }

    /**
     * @Route("/CogShop-accessoires", name="accessoires")
     */
    public function accessoires()
    {
        return $this->render('shop/accessoires.html.twig', [
            
        ]);
    }

    public function header(){
        return $this->render('cog_shop/header.html.twig' , [
            
        ]);
        }

    public function sidebar(){
        return $this->render('cog_shop/sidebar.html.twig' , [
            
        ]);
        }
    public function footer(){
        return $this->render('cog_shop/footer.html.twig' , [
            
        ]);
        }

    public function header2(){
        return $this->render('cog_shop/header2.html.twig' , [
                
        ]);
        }

    public function headerP(){
        return $this->render('cog_shop/headerP.html.twig' , [
                    
        ]);
        }
       
   

}
