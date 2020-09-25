<?php

namespace App\Responders;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class HomeResponder
{
    /** @var Twig */
    private $twig;

    public function __construct(Environment $twig) {

        $this->twig = $twig;
    }

    public function response(array $tricks = []){

        return new Response(
            $this->twig->render('home/index.html.twig', [
                
                'tricks' => $tricks
                
        ]));

    }
}
