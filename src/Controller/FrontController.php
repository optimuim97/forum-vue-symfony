<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/{route}/{route2}/{route3}")
     * @Route("/{route}", name="vue_pages", requirements={"route"="^(?!.*_wdt|_profiler).+"})
     */
    public function index(): Response
    {
        return $this->render('app.html.twig');
    }
  

}
