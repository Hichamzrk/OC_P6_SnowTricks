<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Tricks;
use App\Entity\Comment;
use App\Form\ImageType;
use App\Form\TrickType;
use App\Form\CommentType;
use App\Service\FileUploader;
use App\Repository\ImageRepository;
use App\Repository\VideoRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{
    /**
    * @Route("/add_trick", name="add_trick")
    */
    public function addTrick(Request $request, FileUploader $fileUploader, EntityManagerInterface $entityManager){

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
                $newFilename = $fileUploader->upload($image);
    
                $trick->setImage($newFilename);
            }

            // On récupère les images transmises
            $images = $form->get('images')->getData();            

            // On boucle sur les images
            foreach($images as $image){
                
                $newFilename = $fileUploader->upload($image);
                // On crée l'image dans la base de données
                $img = new Image();
                $img->setName($newFilename);
                $trick->addImage($img);
            }

            $videos = $form->get('video')->getData();
            
            //On vérifie si la vidéo éxiste avant de l'ajouter
            if ($videos !== null) {
                $video = new Video;
                $video->setUrl($videos)->setTrickId($trick);
                $trick->addVideo($video);
            }
           
            $trick->setCreatedAt(new \DateTime('now'));
            $trick->setUserId($this->getUser());

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
    public function updateTrick(EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger, Tricks $trick, ImageRepository $repo_image, VideoRepository $repo_video): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(TrickType::class, $trick);
        $trickId = $trick->getId();

        $imageView = $repo_image->findBy(['trickId' => $trickId]);
        $videoView = $repo_video->findBy(['trickId' => $trickId]);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $image = $form->get('image')->getData();

            if ($form->get('image')->getData() !== null) {
                // this is needed to safely include the file name as part of the URL
                $newFilename = $fileUploader->upload($image);

                $trick->setImage($newFilename);
                $trick->setUpdatedAt(new \DateTime('now'));
                $trick->setUserId($this->getUser());
            }
            else {
                $image = 'default-trick.jpg';
                $trick->setImage($image);
            }

            // On récupère les images transmises
            $images = $form->get('images')->getData();           

            // On boucle sur les images
            foreach($images as $image){
                $newFilename = $fileUploader->upload($image);   

                // On crée l'image dans la base de données
                $img = new Image();
                $img->setName($fichier);
                $img->setTrickId($trick);

                $entityManager->persist($img);
                $entityManager->flush();
            }

            $videos = $form->get('video')->getData();

            if ($videos !== null) {
                $video = new Video;
                $video->setUrl($videos);
                $video->setTrickId($trick);

                $entityManager->persist($video);
                $entityManager->flush();
            }
            
            $entityManager->persist($trick);
            $entityManager->flush();
            $this->addFlash('success', 'Le Trick a bien était modifié : félicitation');
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
    public function deleteTrick(Tricks $id, EntityManagerInterface $entityManager){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $entityManager->remove($id);
        $entityManager->flush();
        
        return $this->redirectToRoute('index');
    }
}
