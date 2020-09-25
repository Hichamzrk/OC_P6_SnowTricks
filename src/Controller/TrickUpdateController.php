<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Tricks;
use App\Form\TrickType;
use App\Handlers\TrickUpdateHandler;
use App\Responders\TrickUpdateResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickUpdateController extends AbstractController
{
    /** @var TrickUpdateHandler */
    private $handler;
    /** @var Responder */
    private $responder;
    /** @var EntityManagerInterface */
    private $entityManager;

    
    public function __construct(
        TrickUpdateHandler $handler,
        EntityManagerInterface $entityManager,
        TrickUpdateResponder $responder
    ) {

        $this->handler = $handler;
        $this->entityManager = $entityManager;
        $this->responder = $responder;
    }


    /**
    * @Route("/update_trick/{trick}", name="update_trick")
    */
    public function trickUpdate(Tricks $trick, Request $request)
    {        
        $imageView = $this->entityManager->getRepository(Image::class)->findBy(['trickId' => $trick]);
        $videoView = $this->entityManager->getRepository(Video::class)->findBy(['trickId' => $trick]);

        $form = $this->createForm(TrickType::class, $trick);
        
        if ($submit = $this->handler->handle($trick, $form) === true) {
            return $this->redirectToRoute('home');
        }
        
        return $this->responder->response($form, $trick, $imageView, $videoView);
    }
}