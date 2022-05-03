<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="back_home")
     */
    public function index(): Response
    {
        /**
         * Retrieving user in session
         * @var \App\Entity\User $user
         */
        $user = $this->getUser();
        if (!in_array('ROLE_USER', $user->getRoles())) 
        {
            return $this->render('main/index.html.twig');
        }
        else 
        {
            return $this->redirectToRoute('app_logout', [], Response::HTTP_SEE_OTHER);
        }
    }
}
