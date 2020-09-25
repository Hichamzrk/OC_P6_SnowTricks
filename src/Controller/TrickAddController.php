<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Form\TrickType;
use App\Handlers\TrickAddHandler;
use App\Responders\TrickAddResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickAddController extends AbstractController
{
    /** @var TrickAddHandler */
    private $handler;
    /** @var Responder */
    private $responder;
    /** @var EntityManagerInterface */
    private $entityManager;

    
    public function __construct(
        TrickAddHandler $handler, 
        TrickAddResponder $responder,
        EntityManagerInterface $entityManager
    ) {

        $this->handler = $handler;
        $this->responder = $responder;
        $this->entityManager = $entityManager;
    }


    /**
    * @Route("/add_trick", name="add_trick")
    */
    public function trickAdd(Request $request)
    {
        $trick = new Tricks();
        $form = $this->createForm(TrickType::class, $trick);
        
        if ($this->handler->handle($trick, $form) === true) {
            
            return $this->redirectToRoute('home');
        }
        
        return $this->responder->response($form);
    }
}