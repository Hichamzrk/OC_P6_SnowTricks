<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ImageRepository;
use App\Repository\VideoRepository;
use App\Repository\TricksRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/trick/{id}", name="trick")
     */
    public function show(Tricks $id, Request $request, PaginatorInterface $paginator, ImageRepository $repo_image, VideoRepository $repo_video, CommentRepository $repo_comment, EntityManagerInterface $entityManager)
    {
        //On créer le formulaire de commentaire via le form type
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Je lie le commentaire à l'utilisateur connecté 
            $comment->setUserId($this->getUser())
                //Je lie le commentaire à la figure 
                ->setTrickId($id);
            
            $comment->setCreatedAt(new \DateTime('now'));
            
            $entityManager->persist($comment);
            $entityManager->flush();
        }
        
        $images = $repo_image->findBy(['trickId' => $id]);
        $videos = $repo_video->findBy(['trickId' => $id]);
        $comment = $repo_comment->findBy(['trickId' => $id]);

        $comments = $paginator->paginate(
            $comment, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );

        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController',
            'trick' => $id,
            'comments' => $comments,
            'form' => $form->createView(),
            'images' => $images,
            'videos' => $videos,
        ]);
    }
}
