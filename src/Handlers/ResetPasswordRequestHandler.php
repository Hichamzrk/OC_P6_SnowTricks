<?php

namespace App\Handlers;

use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Tricks;
use App\Helper\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class ResetPasswordRequestHandler
{
    /** @var Request */
    private $request;
    private $resetPasswordHelper;
    
    public function __construct(

        RequestStack $request,
        ResetPasswordHelperInterface $resetPasswordHelper
    
    ){

        $this->request = $request;
        $this->resetPasswordHelper = $resetPasswordHelper;

    }
    
    /**
     * 
     */
    public function handle(MailerInterface $mailer, FormInterface $form){

        $form->handleRequest($this->request->getCurrentRequest());
        
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->processSendingPasswordResetEmail(
                $form->get('email')->getData(),
                $mailer
            );
        }

        return false;
    }
}