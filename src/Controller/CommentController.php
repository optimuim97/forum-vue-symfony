<?php

namespace App\Controller;


use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\comment\CommentService;

class CommentController extends AbstractController
{
    private $commentService;
    private $articleRepository;
    public function __construct(
        ArticleRepository $articleRepository, 
        CommentService $commentService,
    ){  
        $this->articleRepository = $articleRepository;
        $this->commentService = $commentService;
    }   

    #[Route('/api/v1/comments', name: 'app_comments', methods : ['GET'])]
    public function getComments(): Response
    {
        return $this->commentService->getAll();
    }

    #[Route('/api/v1/comment', name: 'app_create_comment', methods : ['POST'])]
    public function createComment(Request $request)
    {   
        $data = json_decode($request->getContent());
        $article = $this->articleRepository->find($data->id);
        
        return $this->commentService->create($data, $article);
      
    }
}
