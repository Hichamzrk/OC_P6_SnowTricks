<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Responders\HomeResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var responder */
    private $responder;


    public function __construct(EntityManagerInterface $entityManager, HomeResponder $responder) {
        
        $this->entityManager = $entityManager;
        $this->responder = $responder;
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $tricks = $this->entityManager
        ->getRepository(Tricks::class)
        ->findAll();

        return $this->responder->response($tricks);
    }
}
