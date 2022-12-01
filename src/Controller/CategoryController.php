<?php

namespace App\Controller;


use App\Entity\Category;
use App\Services\category\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

class CategoryController extends AbstractController
{
    private $em;
    private $slugGenerator;
    private $categoryService;

    public function __construct(EntityManagerInterface $em,CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->em = $em;
        $this->slugGenerator = new AsciiSlugger();
    }

    #[Route('/api/v1/add-category', name: 'app_category', methods:['POST'])]
    public function index(Request $request): Response
    {         
        $category = new Category();
        $errors = [];

        $datas = $request->request->all();
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
            $errors[] = "Request body can't be empty";
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
        $slug = $this->slugGenerator->slug($datas['name']);
        $category->setSlug($slug);

        $category->setDescription($request->get('description'));
        $image_prepare = file_get_contents($request->files->get('url')->getRealPath());
        //Convert Image To Base 64
        $image = base64_encode($image_prepare);

        $category->setLogoUrl($image);

        $this->em->persist($category);
        $this->em->flush();

        return $this->json([
            "message"=>"Saved",
            "status_code"=> Response::HTTP_CREATED,
            "data"=> $category
        ]);
    }
}
