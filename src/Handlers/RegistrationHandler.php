<?php

namespace App\Handlers;

use App\Entity\User;
use App\Entity\Tricks;
use App\Entity\Comment;
use App\Helper\FileUploader;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class RegistrationHandler
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var Request */
    private $request;
    /** FileUploader */
    private $fileUploader;
    /** @var SessionInterface */
    private $session;
    /** @var EmailVerifier */
    private $emailVerifier;
        
    public function __construct(
        
        EntityManagerInterface $entityManager, 
        RequestStack $request, 
        FileUploader $fileUploader,
        SessionInterface $session,
        EmailVerifier $emailVerifier,
        UserPasswordEncoderInterface $passwordEncoder
    
    ){

        $this->entityManager = $entityManager;
        $this->request = $request;
        $this->fileUploader = $fileUploader;
        $this->session = $session;
        $this->emailVerifier = $emailVerifier;
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * 
     */
    public function handle(User $user, FormInterface $form){

        $form->handleRequest($this->request->getCurrentRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupere l'avatar
            $avatar = $form->get('avatar')->getData();
            
            $newFilename = $this->fileUploader->upload($avatar);

            $user->setAvatar($newFilename);

            //On encode le password
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            //On enregistre en base de donnée
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            // On génére un email de confirmation
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('snowtricks@hichamzrk.fr', ''))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            
            $this->session->getFlashBag()->add("success", "Votre compte a bien été crée, un email vous a été envoyé pour le confirmer.");
            return true;
        }

        return false;
    }
}
