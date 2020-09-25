<?php

namespace App\Responders;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class TrickDetailsResponder
{
    /** @var Twig */
    private $twig;

    public function __construct(Environment $twig) {

        $this->twig = $twig;
    }

    public function response($id, $videos, $images, $comments, $form){

        return new Response(
            $this->twig->render('trick/index.html.twig', [
                'trick' => $id,
                'comments' => $comments,
                'form' => $form->createView(),
                'images' => $images,
                'videos' => $videos,
        ]));

    }
}