<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\CreateProductType;
use App\Repository\CategoryRepository;
use App\Repository\FournisseurRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/nos-produits', name: 'product')]
    public function displayAllProduct(ProductRepository $productRepository): Response
    {
        $product = $productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product
        ]);
    }

    #[Route('/ajouter-un-produit', name: 'create_product')]
    public function createProduct(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(CreateProductType::class, $product);

        $form->handleRequest($request);

        if ($form->get('publish')->isClicked()) {
            $productRepository->add($product, true);
            return $this->redirectToRoute('product');
        }
        return $this->render('product/create.html.twig', [
            'controller_name' => 'ProductController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/produit/{id}', name: 'product_details')]
    public function productDetail($id, ProductRepository $productRepository): Response
    {
        $product=$productRepository->find($id);

        if(!$product){
            throw $this->createNotFoundException();
        }

        return $this->render('product/product_details.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product,
            'id' => $id
        ]);
    }
}
