<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    
    private $em;
    private $articleRepository;
    public function __construct(ArticleRepository $articleRepository, EntityManagerInterface $em){
        $this->articleRepository = $articleRepository;
        $this->em = $em;
    }   

    #[Route('/api/v1/articles', name: 'app_articles', methods : ['GET'])]
    public function getArticles(): Response
    {
        $articles = $this->articleRepository->findAll();
        $length = count($articles);
        // serialize($articles);
       
        return $this->json([
            "message" => "All articles in database",
            "status" => "200",
            "length" => $length,
            "data" => $articles
        ]);
    }

    #[Route('/api/v1/article', name: 'app_create_article', methods : ['POST'])]
    public function createArticle(Request $request)
    {   
        $article = new Article();
        $article->setTitle($request->request->get('title'))  
                ->setContent($request->request->get('content'))
                // ->setAuthor($this->user)
                ;
        
        $this->em->persist($article);
        $this->em->flush();

        return $this->json([
            "message" => "New article created!",
            "status" => "201",
            "data" => $article
        ]);
    }

    #[Route('/api/v1/article/{id}', name: 'app_show_article', methods : ['GET'])]
    public function showArticle($id): Response
    {
        $article = $this->articlesRepository->find($id);
        if(!$article){
            return $this->json([
                "message" => "Article with id = $id doesn't exist!",
                "status" => "401",
                "data" => []
            ]);
            exit;
        }

        serialize($article);
       
        return $this->json([
            "message" => "Article exist!",
            "status" => "200",
            "data" => $article
        ]);
    }

    #[Route('/api/v1/article/{id}', name: 'app_update_article', methods : ['POST'])]
    public function update($id, Request $request): Response
    {   
        $article = $this->articlesRepository->find($id);
        if(!$article){
            return $this->json([
                "message" => "Article with id = $id doesn't exist!",
                "status" => "401",
                "data" => []
            ]);
            exit;
        }

        serialize($article);

        $this->em->flush();

        return $this->json([
            "message" => "Article updated!",
            "status" => "201",
            "data" => $article
        ]);
    }

    #[Route('/api/v1/article/{id}', name: 'app_delete_article', methods : ['DELETE'])]
    public function delete($id): Response
    {
        $article = $this->articlesRepository->find($id);

        if(!$article){
            return $this->json([
                "message" => "Article with id = $id doesn't exist!",
                "status" => "401",
                "data" => []
            ]);
            exit;
        }

        $this->em->remove($article);
        $this->em->flush();
       
        return $this->json([
            "message" => "Article delete!",
            "status" => "200",
            "data" => $article
        ]);
    }

}
