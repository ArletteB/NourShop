<?php

namespace App\Controller;

use App\Entity\Tissus;
use App\Form\TissusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TissusController extends AbstractController
{
    /**
     * @Route("/", name="tissus")
     */
    public function index(Request $request): Response
    {
        
        $tissus = new Tissus();
        $form = $this->createForm( TissusType::class, $tissus);
        $form->handleRequest($request);

        return $this->render('tissus/index.html.twig', [
            'controller_name' => 'TissusController',
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/{id}/wax", name="tissus_wax")
     */
    public function wax(): Response {
        return $this->render('tissus/wax.html.twig');
    }
}
