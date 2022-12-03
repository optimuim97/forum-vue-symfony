<?php

namespace App\Controller;

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
    public function addCategory(Request $request): Response
    {   
        $data = $request->request->all(); 
        $file = $request->files->get('url');
        return $this->categoryService->add($data, $file);
    }

    #[Route('/api/v1/categories', name: 'get_category', methods:['GET'])]
    public function getCategory(){
        return $this->categoryService->getCategory();
    }
}
