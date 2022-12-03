<?php

namespace App\Controller;

use App\Entity\Thumbnail;
use App\Services\article\ArticleService;
use App\Services\like\LikeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Entity\File;

class ArticleController extends AbstractController
{
    
    private $articleService;
    private $likeService;
    private $em;

    protected $parameterBag;

    public function __construct(
        ArticleService $articleService,
        LikeService $likeService,
        ParameterBagInterface $parameterBag,
        EntityManagerInterface $em
     ){
        $this->articleService = $articleService;
        $this->likeService = $likeService;
        $this->parameterBag = $parameterBag;
        $this->em = $em;

    }   

    #[Route('/api/v1/articles', name: 'app_articles', methods : ['GET'])]
    public function getArticles(): Response
    {
        return $this->articleService->read();
    }
    
    #[Route('/api/v1/article', name: 'app_create_article', methods : ['POST'])]
    public function createArticle(Request $request)
    {   
        $data = $request->request->all();
        $user = $this->getUser();
        $file = $request->files->get('thumbnails');

        $upload_dir =$this->parameterBag->get('kernel.project_dir')."/article/images";

        $file_name = $file->getClientOriginalName();
        $file_name_ = $file->getClientOriginalName();
        $file_prepare = file_get_contents($file);

        $thum = new Thumbnail();

        $fileVich = new File();
        $fileVich->setName($file_name_);
        $fileVich->setOriginalName($file_name);
        
        // $fileVich->setMimeType();
        // $fileVich->setSize();
        // $fileVich->setDimensions();
        
        $thum->setImageFile($file_prepare);
        $thum->setImageName($file_name);
        $thum->getFile();

        $this->em->persist($thum);

        $file->move($upload_dir, $file_name);
        
        return $this->articleService->create($data, $user, $thum);
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


    #[Route('/api/v1/user_data', name: 'app_user_data', methods:['GET'])]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->json([
            "message" => "Utilisateur",
            "status" => Response::HTTP_FOUND,
            "data" => $user
        ]);
    }
 

}
