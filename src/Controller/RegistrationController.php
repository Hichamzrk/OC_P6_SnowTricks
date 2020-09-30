<?php

namespace App\Controller;

use App\Entity\User;
use App\Security\EmailVerifier;
use App\Form\RegistrationFormType;
use App\Handlers\RegistrationHandler;
use App\Responders\RegistrationResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegistrationController extends AbstractController
{
    private $registrationHandler;
    private $responder;
    private $emailVerifie;
    

    public function __construct(RegistrationHandler $registrationHandler, RegistrationResponder $responder, EmailVerifier $emailVerifier)
    {
        $this->registrationHandler = $registrationHandler;
        $this->responder = $responder;
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(): Response
    {
        //On créer le formulaire via le form type
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        
        $submit = $this->registrationHandler->handle($user, $form);
        
        if ($submit === true) {
            
            $this->redirectToRoute('app_register');
        
        }
        
        return $this->responder->response($form);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
         $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        // On valide l'email
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('index');
    }
}
