<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Tricks;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Handlers\CommentHandler;
use Doctrine\ORM\EntityManagerInterface;
use App\Responders\TrickDetailsResponder;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickDetailsController extends AbstractController
{
    /** @var CommentHandler */
    private $handler;
    /** @var PaginatorInterface */
    private $paginator;
    /** @var responder */
    private $responder;
    /** @var EntityManagerInterface */
    private $entityManager;

    
    public function __construct(
        CommentHandler $handler, 
        PaginatorInterface $paginator,
        TrickDetailsResponder $responder,
        EntityManagerInterface $entityManager
    ) {

        $this->handler = $handler;
        $this->paginator = $paginator;
        $this->responder = $responder;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/trick/{slug}", name="trick")
     */
    public function trickDetails(Tricks $id, Request $request)
    {
        $comment = new Comment();
        
        $form = $this->createForm(CommentType::class, $comment);
        
        $this->handler->handle($id, $form, $comment);
        
        $images = $this->entityManager->getRepository(Image::class)->findBy(['trickId' => $id]);
        $videos = $this->entityManager->getRepository(Video::class)->findBy(['trickId' => $id]);
        $comment = $this->entityManager->getRepository(Comment::class)->findBy(['trickId' => $id], ['id' => 'DESC']);

        $comments = $this->paginator->paginate(
            $comment, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );
        
        return $this->responder->response($id, $videos, $images, $comments, $form);
    }

}