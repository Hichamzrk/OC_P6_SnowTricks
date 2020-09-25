<?php

namespace App\Controller;

use App\Entity\Tricks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickDeleteController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;

    
    public function __construct(

        EntityManagerInterface $entityManager
    ) {

        $this->entityManager = $entityManager;
    }


    /**
    * @Route("/delete_trick/{id}", name="delete_trick")
    */
    public function deleteTrick(Tricks $id, EntityManagerInterface $entityManager){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $this->entityManager->remove($id);
        $this->entityManager->flush();
        
        $this->addFlash('success', 'Le Trick a bien était supprimé');
        return $this->redirectToRoute('home');
    }
}