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

        return $this->json([
            "message" => "All articles in database",
            "status" => "200",
            "length" => $length,
            "data" => $articles
        ]);

    }

    public function show($id){

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

    public function create($data,$user){
        
        if (empty($data->title)) {
            return $this->json([
                "message"=> "Le Champ titre ne doit pas rester vide",
                "field"=>'title',
                "status_code"=> Response::HTTP_UNPROCESSABLE_ENTITY
            ]);
        }

        if (empty($data->content)) {
            return $this->json([
                "message"=> "Le Champ contenu ne doit pas rester vide",
                "field"=>'content',
                "status_code"=> Response::HTTP_UNPROCESSABLE_ENTITY
            ]);
        }

        $author = $user;
       
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

    public function edit($data, $id){

        $article = $this->articlesRepository->find($id);

        if(!$article){
            return $this->json([
                "message" => "Article with id = $id doesn't exist!",
                "status" => "401",
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
            "status" => "201",
            "data" => $article
        ]);
    }

    public function delete($id){
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