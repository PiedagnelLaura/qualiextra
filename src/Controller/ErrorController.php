<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    /**
     * Show 404 page
     * 
     * @Route("/404", name="app_error_404")
     */
    public function error404(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
    }

    /**
     * Show 403 page 
     * 
     * @Route("/403", name="app_error_403")
     */
    public function error403(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error403.html.twig');
    }


}
