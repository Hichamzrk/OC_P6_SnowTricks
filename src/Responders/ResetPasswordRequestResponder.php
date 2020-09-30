<?php

namespace App\Responders;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordRequestResponder
{
    /** @var Twig */
    private $twig;

    public function __construct(Environment $twig) {

        $this->twig = $twig;
    }

    public function response($form){

        return new Response(
            
            $this->twig->render('reset_password/request.html.twig', [

                'requestForm' => $form->createView(),
        ]));

    }
}