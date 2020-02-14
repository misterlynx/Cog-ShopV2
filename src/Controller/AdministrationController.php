<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UsersRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function administration(UsersRepository $usersRepository, Request $request, EntityManagerInterface $em)
    {
        $s = $request->query->get('s');

        $inscrit = $usersRepository->findAll();

        return $this->render('administration/administration.html.twig', [
            'controller_name' => 'AdministrationController',
            'inscrit' => $inscrit,
        ]);
    }
}
