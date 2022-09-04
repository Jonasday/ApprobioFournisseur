<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Form\DeleteCategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'category')]
    public function displayAllCategory(CategoryRepository $categoryRepository): Response
    {

        $category = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'category' => $category
        ]);
    }

    #[Route('/créer-une-categorie', name: 'create_category')]
    public function createCategory(Request $request, CategoryRepository $category_repository): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);


        if ($form->get('publish')->isClicked()) {
            if($form->isSubmitted() && $form->isValid()){
                $category_repository->add($category, true);
                return $this->redirectToRoute('category');
            }
        }

        return $this->render('category/create.html.twig', [
            'controller_name' => 'CategoryController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/supprimer-la-categorie/{id}', name: 'delete_category')]
    public function deleteCategory($id, Request $request, CategoryRepository $category_repository): Response
    {
        $category = $category_repository->find($id);
        $form = $this->createForm(DeleteCategoryType::class, $category);

        $form->handleRequest($request);


        if ($form->get('delete')->isClicked()) {
            if($form->isSubmitted() && $form->isValid()){
                $category_repository->remove($category, true);
                return $this->redirectToRoute('category');
            }
        }

        return $this->render('category/delete.html.twig', [
            'controller_name' => 'CategoryController',
            'category' => $category,
            'form' => $form->createView(),
            'id' => $id
        ]);
    }

    #[Route('/categorie/{id}', name: 'category_details')]
    public function categoryDetail($id, Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->find($id);

        if(!$category){
            throw $this->createNotFoundException();
        }

        return $this->render('category/category_detail.html.twig', [
            'controller_name' => 'CategoryController',
            'category' => $category,
            'id' => $id
        ]);
    }
}
