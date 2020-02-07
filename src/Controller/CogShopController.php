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
   

}
