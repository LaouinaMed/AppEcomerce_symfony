<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'app_category_')]
class CategoryController extends AbstractController
{
    
    #[Route('/{slug}', name: 'list')]
    public function list(Categories $category): Response
    {
        //on va chercher la list  des produits de la categorie

        $products = $category->getProducts();

        return $this->render('category/list.html.twig', compact('category',
        'products'));
    }
}
