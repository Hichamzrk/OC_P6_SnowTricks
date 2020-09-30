<?php

namespace App\Responders;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class RegistrationResponder
{
    /** @var Twig */
    private $twig;

    public function __construct(Environment $twig) {

        $this->twig = $twig;
    }

    public function response($form){

        return new Response(
            $this->twig->render('registration/register.html.twig', [

                'registrationForm' => $form->createView(),

        ]));

    }
}