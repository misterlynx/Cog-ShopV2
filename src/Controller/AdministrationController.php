<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use src\Repository\UsersRepository;
use src\Repository\VetementsRepository;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function index()
    {
        return $this->render('administration/index.html.twig', [
            'controller_name' => 'AdministrationController',
        ]);
    }

    public function tableauAdmin()
    {
        $nom = …;
        $prenom = …;
        $email = …;
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $entities = $em->getRepository(MyClass::class)->findBy([
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
    ]);
    }
}
