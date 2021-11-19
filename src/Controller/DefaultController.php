<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(): Response
    {
        return $this->json(['value' => rand(0, 1000)]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('default/home.html.twig', []);
    }
}
