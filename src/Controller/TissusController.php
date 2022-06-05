<?php

namespace App\Controller;

use App\Entity\Tissus;
use App\Form\TissusType;
use App\Repository\ArticleRepository;
use App\Repository\TissusRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



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
     * @Route("/admin/tissus/ajouter", name="tissus-admin_add", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function add(ManagerRegistry $doctrine, Request $request): Response {
        $tissus = new Tissus();
        $form = $this->createForm(TissusType::class, $tissus);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($tissus);
            $em->flush();
            return $this->redirectToRoute('tissus_admin');
        }

        return $this->render('dashboard/tissus-add.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/admin/tissus/{id}/editer", name="tissus-admin_edit", methods={"GET", "POST"}, requirements = {"id" : "\d+"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function editer($id, ManagerRegistry $doctrine, Request $request): Response {
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Tissus::class);
        $tissus=$repository->find($id);
        $form = $this->createForm(TissusType::class, $tissus);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
            $em->persist($tissus);
            $em->flush();
            return $this->redirectToRoute('tissus_admin');
        }

        return $this->render('dashboard/tissus-edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

      /**
     * @Route("/admin/{id}/supprimer", name="article-admin_delete", methods={"GET", "POST"}, requirements = {"id" : "\d+"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function supprimer($id, ManagerRegistry $doctrine): Response {

            $em = $doctrine->getManager();
            $repository = $doctrine->getRepository(Tissus::class);
            $tissus= $repository->find($id);
            $em->remove($tissus);
            $em->flush();

            $this->addFlash('message', 'Tissus supprimé avec succès');
            return $this->redirectToRoute('tissus_admin');
        }
    

     /**
     * @Route("/admin/tissus", name="tissus_admin")
     */
    public function tissus(TissusRepository $tissus) {

        return $this->render('dashboard/tissus-admin.html.twig', [
            'tissus'=> $tissus->findAll()
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
