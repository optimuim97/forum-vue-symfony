<?php

namespace App\Controller;

use App\Entity\Like;
use App\Repository\ArticleRepository;
use App\Repository\LikeRepository;
use App\Repository\UserRepository;
use App\Services\article\ArticleService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    
    private $em;
    private $articlesRepository;
    private $likeRepository;
    private $articleService;
    public function __construct(
        ArticleRepository $articlesRepository,
        LikeRepository $likeRepository,
        UserRepository $authorRepo,
        EntityManagerInterface $em,
        ArticleService $articleService
    ){
        $this->articlesRepository = $articlesRepository;
        $this->authorRepo = $authorRepo;
        $this->likeRepository = $likeRepository;
        $this->em = $em;
        $this->articleService = $articleService;
        $this->articleService = $articleService;
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
        $article = $this->articlesRepository->find($id);
        $user = $this->getUser();

        if(!$article){

            return $this->json([
                "message" => "Article with id = $id doesn't exist!",
                "status" => "401",
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
                    "message" => "Disliked !",
                    "status" => Response::HTTP_NO_CONTENT
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
