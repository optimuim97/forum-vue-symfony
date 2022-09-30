<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    private $em;
    private $commentRepository;
    private $articleRepository;
    public function __construct(CommentRepository $commentRepository,ArticleRepository $articleRepository, EntityManagerInterface $em){
        $this->commentRepository = $commentRepository;
        $this->articleRepository = $articleRepository;
        $this->em = $em;
    }   

    #[Route('/api/v1/comments', name: 'app_comments', methods : ['GET'])]
    public function getComments(): Response
    {
        $comments = $this->commentRepository->findAll();
        $length = count($comments);
        // serialize($comments);
       
        return $this->json([
            "message" => "All comments in database",
            "status" => "200",
            "length" => $length,
            "data" => $comments
        ]);
    }

    #[Route('/api/v1/comment', name: 'app_create_article', methods : ['POST'])]
    public function createComment(Request $request)
    {   
        $id = $request->request->get('article_id');
        
        $article = $this->articleRepository->find($id);
        
        $comment = new Comment();
        $comment->setComment($request->request->get('comment'))  
                // ->setUser($request->request->get($this->user))
                ->setArticle($article)
                // ->set($request->request->get($this->user))
                // ->setAuthor($this->user)
                ;
        
        $this->em->persist($comment);
        $this->em->flush();

        return $this->json([
            "message" => "New comment created!",
            "status" => "201",
            "data" => $comment
        ]);
    }
}
