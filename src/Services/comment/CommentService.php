<?php 

namespace App\Services\comment;

use App\Entity\Comment;
use App\Helpers\UtilsClass;
use App\Repository\CommentRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class CommentService extends UtilsClass{

    private $em;
    private $commentRepository;

    public function __construct(
        CommentRepository $commentRepository,
        EntityManagerInterface $em
    ){
        $this->commentRepository = $commentRepository;
        $this->em = $em;
    }   

    public function getAll(){

        $comments = $this->commentRepository->findAll();
        $length = count($comments);
       
        return $this->json([
            "message" => "All comments in database",
            "status" => Response::HTTP_OK,
            "length" => $length,
            "data" => $comments
        ]);

    }

    public function create($data, $article){

        $comment = new Comment();
        $comment->setComment($data->comment)  
                ->setUser($this->getUser())
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime())
                ->setArticle($article);
        
        $this->em->persist($comment);
        $this->em->flush();

        return $this->json([
            "message" => "New comment created!",
            "status" => Response::HTTP_CREATED,
            "data" => $comment
        ]);
        
    }
}