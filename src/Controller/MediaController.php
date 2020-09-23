<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MediaController extends AbstractController
{
    /**
    * @Route("/delete_image/{id}", name="delete_image")
    */
    public function deleteImage($id, EntityManagerInterface $entityManager, ImageRepository $repo_image){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $image = $repo_image->find($id);

        $entityManager->remove($image);
        $entityManager->flush();

        $trick = $image->getTrickId();
        $trickId = $trick->getId();
       
        $this->addFlash('success', 'Image bien supprimé !');
        return $this->redirectToRoute('update_trick', array(
            'trick' => $trickId
        ));
    }
    
    /**
    * @Route("/delete_video/{id}", name="delete_video")
    */
    public function deleteVideo($id, EntityManagerInterface $entityManager, VideoRepository $repo_video){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $video = $repo_video->find($id);

        $entityManager->remove($video)->flush();
        $entityManager->flush();

        $trick = $video->getTrickId();
        $trickId = $trick->getId();

        $this->addFlash('success', 'Video bien supprimé !');
        return $this->redirectToRoute('update_trick', array(
            'trick' => $trickId
        ));
    }
}
