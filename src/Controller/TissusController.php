<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TissusController extends AbstractController
{
    /**
     * @Route("/tissus", name="app_tissus")
     */
    public function index(): Response
    {
        return $this->render('tissus/index.html.twig', [
            'controller_name' => 'TissusController',
        ]);
    }
}
