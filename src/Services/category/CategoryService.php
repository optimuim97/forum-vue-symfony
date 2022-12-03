<?php

namespace App\Services\category;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryService extends AbstractController{

    private $categoryRepository;
    private $em;

    public function __construct(EntityManagerInterface $em, CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->em = $em;
    }


    public function add($datas, $file){

        $category = new Category();
        $errors = [];

        $require_params = ["name", "description"];

        //TODO function for check errors
        if ($datas) {
            foreach ($require_params as $value) {
                if (!array_key_exists($value, $datas)) {
                    $errors[] = "$value must be set.";
                    $message = "Required field missing";
                } elseif (empty($datas[$value])) {
                    $errors[] = "$value must not be empty.";
                    $message = "Empty field found.";
                }
            }
        } else {
            $message = "Request body not found.";
        }

        if(!empty($errors)){
            return $this->json([
                "message" =>$message,
                "errors" => $errors,
                "status_code" => Response::HTTP_UNPROCESSABLE_ENTITY
            ]);
        }

        $category->setName($datas['name']);

        //Generate Slug with name
        // $slug = $this->slugGenerator->slug($datas['name']);
        // $category->setSlug($slug);

        // $category->setDescription($datas('description'));

        // if(!empty($file)){
        //     $image_prepare = file_get_contents($file);
        //     //Convert Image To Base 64
        //     $image = base64_encode($image_prepare);
        //     $category->setLogoUrl($image);
        // }

        $this->em->persist($category);
        $this->em->flush();

        return $this->json([
            "message"=>"Saved",
            "status_code"=> Response::HTTP_CREATED,
            "data"=> $category
        ]);
    }

    public function getCategory(){
        $categories= $this->categoryRepository->findAllCategory();

        return $this->json([
            "message"=>"Categories List",
            "status_code"=> Response::HTTP_FOUND,
            "data"=> $categories
        ]);
    }

}