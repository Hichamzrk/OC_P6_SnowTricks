<?php

namespace App\Responders;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class TrickAddResponder
{
    /** @var Twig */
    private $twig;

    public function __construct(Environment $twig) {

        $this->twig = $twig;
    }

    public function response($form){

        return new Response(
            $this->twig->render('trick/add-trick.html.twig', [

                'form' => $form->createView(),

        ]));

    }
}