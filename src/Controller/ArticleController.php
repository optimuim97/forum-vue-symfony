<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    
    private $em;
    private $articlesRepository;
    public function __construct(ArticleRepository $articlesRepository,UserRepository $authorRepo,EntityManagerInterface $em){
        $this->articlesRepository = $articlesRepository;
        $this->authorRepo = $authorRepo;
        $this->em = $em;
    }   

    #[Route('/api/v1/articles', name: 'app_articles', methods : ['GET'])]
    public function getArticles(): Response
    {
        $articles = $this->articlesRepository->orderByCreatedAt();
        $length = count($articles);
       
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
        $data = json_decode($request->getContent());

        $author = $this->getUser();
       
        $article = new Article();
        $article->setTitle($data->title)  
                ->setContent($data->content)
                ->setAuthor($author)
                ->setCreatedAt(new DateTime())
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

        // serialize($article);
       
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
