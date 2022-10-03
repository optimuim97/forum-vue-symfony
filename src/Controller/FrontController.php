<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("/{route}", name="vue_pages", requirements={"route"="^(?!.*_wdt|_profiler).+"})
     */
    public function index(): Response
    {
        return $this->render('app.html.twig');
    }

    /**
     * @Route("/", name="home_front")
     * @Route("/{route}/{route1}/{route2}/{route3}", name="details_pages", requirements={"route"="^(?!.*_wdt|_profiler).+"})
     */
    public function details(): Response
    {
        return $this->render('app.html.twig');
    }

  

}
