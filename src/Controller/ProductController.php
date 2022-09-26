<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductSearch;
use App\Form\CreateProductType;
use App\Form\DeleteProductType;
use App\Form\ProductSearchType;
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
    public function displayAllProduct(ProductRepository $productRepository, Request $request): Response
    {
        $search = new ProductSearch();

        $form = $this->createForm(ProductSearchType::class, $search);
        $product = $productRepository->findAll();
        $form->handleRequest($request);

        //$product = $productRepository->findAll();

        if($form->isSubmitted() && $form->isValid()){
            $product = $productRepository->filterFormCustomQuery($search);
        }
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product,
            'search' => $search,
            'form' => $form->createView()
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

    #[Route('/modify_product/{id}', name : 'modify_product')]
    public function modifyProduct($id,Request $request, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);

        if ($product == null) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(CreateProductType::class, $product);


        $form->handleRequest($request);

        if ($form->get('publish')->isClicked()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $productRepository->add($product, true);
                return $this->redirectToRoute('product');
            }
        }

        return $this->render('product/modify.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product,
            'form' => $form->createView(),
            'id' => $id
        ]);
    }

    #[Route('/delete_product/{id}', name : 'delete_product')]
    public function deleteProduct($id,Request $request, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);

        if ($product == null) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(DeleteProductType::class, $product);
        $form->handleRequest($request);

        if ($form->get('delete')->isClicked()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $productRepository->remove($product, true);
                return $this->redirectToRoute('product');
            }
        }

        return $this->render('product/delete.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product,
            'form' => $form->createView(),
            'id' => $id
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
