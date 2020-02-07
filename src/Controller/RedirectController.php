<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;

class RedirectController extends AbstractController
{
    /**
     * @Route("/redirect", name="redirect")
     */
    public function admin_dispatch() {
    	if ($this->getUser()->hasRole('ROLE_ADMIN')) {
    		return $this->redirectToRoute('administration');
    	}else if($this->getUser()->hasRole('ROLE_USER')){
    		return $this->redirectToRoute('member');
    	}else{
            return $this->redirectToRoute('acceuil');
        }
    }
}