<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


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
     * @Route("/article/ajouter", name="article_add")
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

            return $this->redirectToRoute( "article_index" ) ;
        }

        return $this->render('article/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
      /**
     * @Route("/article/{id}/editer", name="article_edit", methods={"GET", "POST"}, requirements = {"id" : "\d+"})
     */
    public function editer($id, ManagerRegistry $doctrine , Request $request): Response {
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Article::class);
        $article=$repository->find($id);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('article_index', ['id' => $id]);
        }

        return $this->render('article/edit.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"} )
     */
    public function show($id, ManagerRegistry $doctrine): Response {
        $repository = $doctrine->getRepository(Article::class);
        $article = $repository->find($id);

        return $this->render('article/show.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/{id}/supprimer", name="article_delete", methods={"GET", "POST"}, requirements = {"id" : "\d+"})
     */
    public function delete($id, ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Article::class);
        $article= $repository->find($id);
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('article_index');
    }

}

