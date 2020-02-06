<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CogShopController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('cog_shop/index.html.twig', [
            
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
}
