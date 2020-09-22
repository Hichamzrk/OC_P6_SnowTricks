<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Tricks;
use App\Entity\Comment;
use App\Form\ImageType;
use App\Form\TrickType;
use App\Form\CommentType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

class TrickController extends AbstractController
{
    /**
     * @Route("/trick/{id}", name="trick")
     */
    public function index(Tricks $id, Request $request, PaginatorInterface $paginator)
    {

        $trick = $this->getDoctrine()
        ->getRepository(Tricks::class)
        ->find($id);

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Je lie le commentaire à l'utilisateur connecté 
            $comment->setUserId($this->getUser())
                //Je lie le commentaire à la figure 
                ->setTrickId($id);
            
            $comment->setCreatedAt(new \DateTime('now'));
               
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        $images = $this->getDoctrine()
        ->getRepository(Image::class)
        ->findBy([
            'trickId' => $id
        ]);

        $videos = $this->getDoctrine()
        ->getRepository(Video::class)
        ->findBy([
            'trickId' => $id
        ]);

        $comment = $this->getDoctrine()
        ->getRepository(Comment::class)
        ->findBy([
            'trickId' => $id
        ],
        [
            'id' => 'DESC'
        ]
    );

        $comments = $paginator->paginate(
            $comment, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );

        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController',
            'trick' => $trick,
            'comments' => $comments,
            'form' => $form->createView(),
            'images' => $images,
            'videos' => $videos,
        ]);
    }
    /**
    * @Route("/add_trick", name="add_trick")
    */
    public function add(Request $request, SluggerInterface $slugger){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $trick = new Tricks();

        $form = $this->createForm(TrickType::class, $trick);

        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $image = $form->get('image')->getData();

            if ($form->get('image')->getData() === null) {
                $image = 'default-trick.jpg';
                $trick->setImage($image);
            }
            else {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($image);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
    
                $trick->setImage($newFilename);
 
                $image->move(
                    $this->getParameter('image_directory'),
                    $newFilename
                );
    
            }

            

            // On récupère les images transmises
            $images = $form->get('images')->getData();            

            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                
                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('image_directory'),
                    $fichier
                );
                
                // On crée l'image dans la base de données
                $img = new Image();
                $img->setName($fichier);
                $trick->addImage($img);
            }

            $videos = $form->get('video')->getData();
            
            if ($videos !== null) {
                $video = new Video;
                $video->setUrl($videos);
                $video->setTrickId($trick);
                $trick->addVideo($video);
            }
           
            $trick->setCreatedAt(new \DateTime('now'));
            $trick->setUserId($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trick);
            $entityManager->flush();
            $this->addFlash('success', 'Le Trick a bien était ajouté : félicitation');
            return $this->redirectToRoute('index');
        }
        
        return $this->render('trick/add-trick.html.twig', [
            'controller_name' => 'TrickController',
            'form' => $form->createView(),
            'trick' => $trick
        ]);
    }
    /**
    * @Route("/update_trick/{trick}", name="update_trick")
    */
    public function update(Request $request, SluggerInterface $slugger, Tricks $trick): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(TrickType::class, $trick);
        $trickId = $trick->getId();

        $imageView = $this->getDoctrine()
        ->getRepository(Image::class)
        ->findBy([
            'trickId' => $trickId
        ]);

        $videoView = $this->getDoctrine()
        ->getRepository(Video::class)
        ->findBy([
            'trickId' => $trickId
        ]);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $image = $form->get('image')->getData();

            if ($form->get('image')->getData() !== null) {
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($image);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                $trick->setImage($newFilename);
                $trick->setUpdatedAt(new \DateTime('now'));
                $trick->setUserId($this->getUser());

                $image->move(
                    $this->getParameter('image_directory'),
                    $newFilename
                );
            }
            else {
                $image = 'default-trick.jpg';
                $trick->setImage($image);
            }

            // On récupère les images transmises
            $images = $form->get('images')->getData();           

            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                
                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('image_directory'),
                    $fichier
                );
                
                // On crée l'image dans la base de données
                $img = new Image();
                $img->setName($fichier);
                $img->setTrickId($trick);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($img);
                $entityManager->flush();

            }

            $videos = $form->get('video')->getData();

            if ($videos !== null) {
                $video = new Video;
                $video->setUrl($videos);
                $video->setTrickId($trick);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($video);
                $entityManager->flush();
         
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trick);
            $entityManager->flush();

        }

        return $this->render('trick/update-trick.html.twig', [
            'form' => $form->createView(),
            'trick' => $trick,
            'imageView' => $imageView,
            'videos' => $videoView,
        ]);
    }

    
    /**
    * @Route("/delete_trick/{id}", name="delete_trick")
    */
    public function deleteTrick($id){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();
        $trick = $em->getRepository(Tricks::class)->find($id);

        $em->remove($trick);
        $em->flush();
        
        return $this->redirectToRoute('index');
    }

    /**
    * @Route("/delete_image/{id}", name="delete_image")
    */
    public function deleteImage($id){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository(Image::class)->find($id);

        $em->remove($image);
        $em->flush();
        
        // return $this->render('trick/delete-trick.html.twig', [
        //     'image' => $image,
        //     'id' => $id
        // ]);
        
        $trick = $image->getTrickId();
        $trickId = $trick->getId();

        return $this->redirectToRoute('update_trick', array(
            'trick' => $trickId
        ));
    }
    
    /**
    * @Route("/delete_video/{id}", name="delete_video")
    */
    public function deleteVideo($id){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository(video::class)->find($id);

        $em->remove($video);
        $em->flush();
        
        // return $this->render('trick/delete-trick.html.twig', [
        //     'image' => $image,
        //     'id' => $id
        // ]);
        
        $trick = $video->getTrickId();
        $trickId = $trick->getId();

        return $this->redirectToRoute('update_trick', array(
            'trick' => $trickId
        ));
    }
}

