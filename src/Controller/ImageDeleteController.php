<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Image;

class ImageDeleteController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(

        EntityManagerInterface $entityManager

    ){

        $this->entityManager = $entityManager;

    }

    /**
    * @Route("/delete_image/{id}", name="delete_image")
    */
    public function deleteImage($id){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $image = $this->entityManager->getRepository(Image::class)->find($id);

        $this->entityManager->remove($image);
        $this->entityManager->flush();

        $trick = $image->getTrickId();
        $slug = $trick->getSlug();
       
        $this->addFlash('success', 'Image bien supprimé !');
        
        return $this->redirectToRoute('update_trick', array(
            'slug' => $slug
        ));
    }
}