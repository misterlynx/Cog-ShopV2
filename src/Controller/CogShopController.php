<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;

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
     * @Route("/a-propos", name="apropos")
     */
    public function apropos()
    {
        return $this->render('cog_shop/apropos.html.twig', [
            
        ]);
    }

    /**
     * @Route("/histoire", name="histoire")
     */
    public function histoire()
    {
        return $this->render('cog_shop/histoire.html.twig', [
            
        ]);
    }

    /**
     * @Route("/mentionsLegales", name="mentions")
     */
    public function mentionsLegales()
    {
        return $this->render('cog_shop/mentions.html.twig', [

        ]);
    }

    
    

    public function header($header_s){
        return $this->render('cog_shop/header.html.twig' , [
            'header_s' => $header_s
        ]);
        }

    public function sidebar(){
        return $this->render('cog_shop/sidebar.html.twig' , [
            
        ]);
        }
    public function sidebarP(){
        return $this->render('cog_shop/sidebarP.html.twig' , [
                
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