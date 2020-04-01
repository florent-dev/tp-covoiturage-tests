<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class DefaultController extends AbstractController
{
    /**
     * @param Environment $twig
     * @return Response
     */
    public function index(Environment $twig)
    {
        $content = $twig->render('index.html.twig');
        return new Response($content);
    }
}