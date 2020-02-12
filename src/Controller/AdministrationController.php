<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UsersRepository;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function administration(UsersRepository $usersRepository, EntityManagerInterface $em)
    {
        $inscrit = $usersRepository->findAll();

        return $this->render('administration/index.html.twig', [
            'controller_name' => 'AdministrationController',
            'inscrit' => $inscrit,
        ]);
    }
}