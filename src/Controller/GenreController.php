<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/back/genre", name="back_genre_")
     */
class GenreController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function list(): Response
    {
        return $this->render('genre/index.html.twig');
    }
}
