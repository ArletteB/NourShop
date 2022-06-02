<?php

namespace App\Controller;

use App\Entity\Tissus;
use App\Form\TissusType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


 /**
     * @Route("/")
     */

class TissusController extends AbstractController
{
    /**
     * @Route("/tissus", name="tissus_index")
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
     * @Route("/{id}/show", name="tissus_show", methods={"GET"}, requirements={ "id" = "\d+" })
     */

     public function show($id, ManagerRegistry $doctrine): Response {
         $repository = $doctrine->getRepository(Tissus::class);
         $tissus = $repository->find($id);
         return $this->render('tissus/show.html.twig', [
             'tissus' =>$tissus
         ]);
     }
    
     /**
     * @Route("/tissus/ajouter", name="tissus_add", methods={"GET", "POST"})
     */
    public function add(ManagerRegistry $doctrine, Request $request): Response {
        $tissus = new Tissus();
        $form = $this->createForm(TissusType::class, $tissus);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($tissus);
            $em->flush();
            return $this->redirectToRoute('tissus_index');
        }

        return $this->render('tissus/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
    * @Route("/{id}/wax", name="tissus_wax")
     */
    public function wax(): Response {
        return $this->render('tissus/wax.html.twig');
    }
    /**
      * @Route("//{id}/bazin", name="tissus_bazin")
    */
    public function bazin(): Response {
        return $this->render('tissus/bazin.html.twig');
    }
}
