<?php

namespace App\Services\like;

use App\Entity\Like;
use App\Helpers\UtilsClass;
use App\Repository\ArticleRepository;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class LikeService extends UtilsClass{

    private $em;
    private $articlesRepository;
    private $likeRepository;
    public function __construct(
        ArticleRepository $articlesRepository,
        LikeRepository $likeRepository,
        EntityManagerInterface $em
    ){
        $this->articlesRepository = $articlesRepository;
        $this->likeRepository = $likeRepository;
        $this->em = $em;
    }   

    public function likeOrDislike($id, $user){
        $article = $this->articlesRepository->find($id);
      
        if(!$article){

            return $this->json([
                "message" => "Article with id = $id doesn't exist!",
                "status" => Response::HTTP_NOT_FOUND,
                "data" => []
            ]);

            exit;
        }

        $article_likes = $article->getLikes();

        foreach ($article_likes as $like) {
    
            if($like->getLiker() == $this->getUser()){

                $this->likeRepository->remove($like, true);
                
                $article->removeLike($like);
                $this->em->flush();

                return $this->json([
                    "message"=> "Disliked !",
                    "status" => Response::HTTP_NO_CONTENT,
                    "article"=> $article
                ]);

            }
        }

        $like = new Like();
        $like->setLiker($user)
             ->setArticle($article);

        $article->addLike($like);

        $this->em->persist($like);
        $this->em->flush();
       
        return $this->json([
            "message" => "like!",
            "status" => Response::HTTP_OK,
            "article" => $article,
            "like" => $like
        ]);
    }
}