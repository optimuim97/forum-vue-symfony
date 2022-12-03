<?php

namespace App\Services\article;

use App\Entity\Article;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\UtilsClass;
use App\Repository\ArticleRepository;
use App\Repository\LikeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class ArticleService extends UtilsClass{

    public function __construct(
        ArticleRepository $articlesRepository,
        LikeRepository $likeRepository,
        UserRepository $authorRepo,
        EntityManagerInterface $em
    ){
        $this->articlesRepository = $articlesRepository;
        $this->authorRepo = $authorRepo;
        $this->likeRepository = $likeRepository;
        $this->em = $em;
    }   


    public function read(){

        $articles = $this->articlesRepository->orderByCreatedAt();
        
        $length = count($articles);

        try {
            return $this->json([
                "message" => "All articles in database",
                "status" => Response::HTTP_OK,
                "length" => $length,
                "data" => $articles
            ]);
        } catch (\Throwable $th) {
            return $this->json([
                "message" => $th
            ]);
        }

    }

    public function show($id){

        $article = $this->articlesRepository->find($id);

        if(!$article){
            return $this->json([
                "message" => "Article with id = $id doesn't exist!",
                "status" => Response::HTTP_NOT_FOUND,
                "data" => []
            ]);
            exit;
        }

        // serialize($article);
        return $this->json([
            "message" => "Article exist!",
            "status" => Response::HTTP_OK,
            "data" => $article
        ]);

    }

    public function create($data,$user, $file){
        $author = $user;
       
        $article = new Article();
        $article->setTitle($data['title'])  
                ->setContent($data['content'])
                ->setAuthor($author)
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime());


        $article->addThumbnail($file);


        $this->em->persist($article);
        $this->em->flush();

        return $this->json([
            "message" => "New article created!",
            "status" => Response::HTTP_CREATED,
            "data" => $article
        ]);

    }

    public function edit($data, $id){

        $article = $this->articlesRepository->find($id);

        if(!$article){
            return $this->json([
                "message" => "Article with id = $id doesn't exist!",
                "status" => Response::HTTP_UNAUTHORIZED,
                "data" => []
            ]);
            exit;
        }

        $article->setTitle($data['title'])  
                ->setContent($data['content'])
                ->setUpdatedAt(new DateTime());

        $this->em->persist($article);
        $this->em->flush();

        return $this->json([
            "message" => "Article updated!",
            "status" => Response::HTTP_UNAUTHORIZED,
            "data" => $article
        ]);
    }

    public function delete($id){
        $article = $this->articlesRepository->find($id);

        if(!$article){
            return $this->json([
                "message" => "Article with id = $id doesn't exist!",
                "status" => Response::HTTP_UNAUTHORIZED,
                "data" => []
            ]);
            exit;
        }

        $this->em->remove($article);
        $this->em->flush();
       
        return $this->json([
            "message" => "Article delete!",
            "status" => Response::HTTP_OK,
            "data" => $article
        ]);
    }
    
}