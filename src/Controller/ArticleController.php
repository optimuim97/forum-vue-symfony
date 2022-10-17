<?php

namespace App\Controller;

use App\Services\article\ArticleService;
use App\Services\like\LikeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    
    private $articleService;
    private $likeService;

    public function __construct(
        ArticleService $articleService,
        LikeService $likeService,
    ){
        $this->articleService = $articleService;
        $this->likeService = $likeService;
    }   

    #[Route('/api/v1/articles', name: 'app_articles', methods : ['GET'])]
    public function getArticles(): Response
    {
        return $this->articleService->read();
    }
    
    #[Route('/api/v1/article', name: 'app_create_article', methods : ['POST'])]
    public function createArticle(Request $request)
    {   
        $data = json_decode($request->getContent());
        $user = $this->getUser();
        
        return $this->articleService->create($data, $user);
    }

    #[Route('/api/v1/article/{id}', name: 'app_show_article', methods : ['GET'])]
    public function showArticle($id): Response
    {
        return $this->articleService->show($id);
    }

    #[Route('/api/v1/article/{id}', name: 'app_update_article', methods : ['POST'])]
    public function update($id, Request $request): Response
    {   
        $data = json_decode($request->getContent(),true);
        return $this->articleService->edit($data, $id);
    }

    #[Route('/api/v1/article/{id}', name: 'app_delete_article', methods : ['DELETE'])]
    public function delete($id): Response
    {
       return $this->articleService->delete($id);
    }

    #[Route('/api/v1/like/{id}', name: 'article_like', methods : ['POST'])]
    public function likeOrDislike($id): Response
    {   
        $user = $this->getUser();
        return $this->likeService->likeOrDislike($id, $user);
    }

}
