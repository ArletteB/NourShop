<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article_index")
     */
    public function index(ManagerRegistry $doctrine): Response {
           
        $repository = $doctrine->getRepository(Article::class);
        $articles = $repository->findBy([], ['nom'=> 'DESC']);
        return $this->render('article/index.html.twig', ['articles'=> $articles]);
    }

     /**
     * @Route("/admin/article/ajouter", name="article-admin_add")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function add(ManagerRegistry $doctrine, Request $request): Response {
        
        $em = $doctrine->getManager();
        $article= new Article();
        $form= $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute( "article_admin" ) ;
        }

        return $this->render('dashboard/article-add.html.twig', [
            'form' => $form->createView()
        ]);
    }
      /**
     * @Route("/admin/{id}/editer", name="article-admin_edit", methods={"GET", "POST"}, requirements = {"id" : "\d+"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function editer($id, ManagerRegistry $doctrine , Request $request): Response {
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Article::class);
        $article=$repository->find($id);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('article_admin');
        }

        return $this->render('dashboard/article-edit.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"}, requirements={ "id" = "\d+" })
     */
    public function show($id, ManagerRegistry $doctrine): Response {
        $repository = $doctrine->getRepository(Article::class);
        $article = $repository->find($id);

        return $this->render('article/show.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/admin/{id}/supprimer", name="article-admin_delete", methods={"GET", "POST"}, requirements = {"id" : "\d+"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete($id, ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Article::class);
        $article= $repository->find($id);
        $em->remove($article);
        $em->flush();

        $this->addFlash('message', 'Article supprimée avec succès');

        return $this->redirectToRoute('article_admin');
    }

    /**
     * @Route("/admin/article", name="article_admin")
     */
    public function article(ArticleRepository $articles) {

        return $this->render('dashboard/article-admin.html.twig', [
            'articles'=> $articles->findAll()
        ]);
    }
















    /**
     * @Route("/article/wax", name="article_wax_index")
     */
    // public function show_wax(ManagerRegistry $doctrine): Response {
    //     $repository = $doctrine->getRepository(Article::class);
    //     $articles = $repository->findBy(['tissus'=> "wax"], ['nom'=> 'DESC']);
      
    //     return $this->render('article/index.html.twig', ['articles'=> $articles]);
    // }

}

