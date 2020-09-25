<?php

namespace App\Handlers;

use App\Entity\Tricks;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class CommentHandler
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var Request */
    private $request;
    /** @var TokenStorageInterface */
    private $tokenStorage;
    
    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager, RequestStack $request){

        $this->entityManager = $entityManager;
        $this->request = $request;
        $this->tokenStorage = $tokenStorage;

    }
    /**
     * 
     */
    public function handle(Tricks $id, FormInterface $form, Comment $comment){

        $form->handleRequest($this->request->getCurrentRequest());

        if ($form->isSubmitted() && $form->isValid()) {

            $comment->setUserId($this->tokenStorage->getToken()->getUser())
                    ->setTrickId($id);
            
            $comment->setCreatedAt(new \DateTime('now'));
            
            $this->entityManager->persist($comment);
            $this->entityManager->flush();
        }
    }
}
