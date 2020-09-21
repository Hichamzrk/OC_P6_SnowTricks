<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Repository\TricksRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $tricks = $this->getDoctrine()
        ->getRepository(Tricks::class)
        ->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'tricks' => $tricks
        ]);
    }
}
