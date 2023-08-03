<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    /**
     * @Route("/inc/aboutus", name="app_aboutus")
     */
    public function index(): Response
    {
        return $this->render('inc/about_us/aboutus.html.twig', [
            'controller_name' => 'AboutUsController',
        ]);
    }

    /**
     * @Route("/inc/contactus", name="app_contactus")
     */
    public function dexin(): Response
    {
        return $this->render('inc/about_us/contactus.html.twig', [
            'controller_name' => 'AboutUsController',
        ]);
    }
}
