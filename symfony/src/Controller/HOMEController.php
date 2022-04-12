<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HOMEController extends AbstractController
{
    /**
     * @Route("/", name="app_h_o_m_e")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');

    }

    /**
     * @Route ("/About", name="about")
     */
    public function rootToAbout(): Response
    {
        return $this->render("home/about.html.twig");
    }


}
