<?php

namespace App\Responders;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class TrickUpdateResponder
{
    /** @var Twig */
    private $twig;

    public function __construct(Environment $twig) {

        $this->twig = $twig;
    }

    public function response($form, $trick, $imageView, $videoView){

        return new Response(
            $this->twig->render('trick/update-trick.html.twig', [

                'form' => $form->createView(),
                'trick' => $trick,
                'imageView' => $imageView,
                'videos' => $videoView,

        ]));

    }
}