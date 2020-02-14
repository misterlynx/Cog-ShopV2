<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsersRepository;
use App\Repository\CommandesRepository;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function administration(UsersRepository $usersRepository)
    {

        $inscrit = $usersRepository->findAll();

        return $this->render('administration/administration.html.twig', [
            'controller_name' => 'AdministrationController',
            'inscrit' => $inscrit,
        ]);
    }
}
