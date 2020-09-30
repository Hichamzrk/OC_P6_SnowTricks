<?php

namespace App\Handlers;

use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Tricks;
use App\Helper\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TrickUpdateHandler
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var Request */
    private $request;
    /** @var TokenStorageInterface */
    private $tokenStorage;
    /** FileUploader */
    private $fileUploader;
    /** @var SessionInterface */
    private $session;
    
    public function __construct(
    
        TokenStorageInterface $tokenStorage, 
        EntityManagerInterface $entityManager, 
        RequestStack $request, 
        FileUploader $fileUploader,
        SessionInterface $session
    
    ){

        $this->entityManager = $entityManager;
        $this->request = $request;
        $this->tokenStorage = $tokenStorage;
        $this->fileUploader = $fileUploader;
        $this->session = $session;
    }
    
    /**
     * 
     */
    public function handle(Tricks $trick, FormInterface $form){

        $form->handleRequest($this->request->getCurrentRequest());
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            // encode the plain password
            $image = $form->get('image')->getData();

            if ($form->get('image')->getData() !== null) {
                // this is needed to safely include the file name as part of the URL
                $newFilename = $this->fileUploader->upload($image);

                $trick->setImage($newFilename);
            }
            else {
                $image = 'default-trick.jpg';
                $trick->setImage($image);
            }

            // On récupère les images transmises
            $images = $form->get('images')->getData();           

            // On boucle sur les images
            foreach($images as $image){
                $newFilename = $this->fileUploader->upload($image);   

                // On crée l'image dans la base de données
                $img = new Image();
                $img->setName($newFilename);
                $img->setTrickId($trick);

                $this->entityManager->persist($img);
            }

            $videos = $form->get('video')->getData();

            if ($videos !== null) {
                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videos, $match)) {
                    $video = new Video();
                    $video_id = $match[1];
                    $video->setUrl('https://www.youtube.com/embed/' . $video_id);
                    $video->setTrickId($trick);

                    $this->entityManager->persist($video);
                }
            }
           
            $trick->setUpdatedAt(new \DateTime('now'));
            $trick->setUserId($this->tokenStorage->getToken()->getUser());
            
            $this->entityManager->persist($trick);
            $this->entityManager->flush();
            
            $this->session->getFlashBag()->add("success", "Trick bien modifié!");
            
            return true;
        }

        return false;
    }
}