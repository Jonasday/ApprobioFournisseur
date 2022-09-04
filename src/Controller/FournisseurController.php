<?php

namespace App\Controller;


use App\Entity\Fournisseur;
use App\Form\CreateFournisseurType;
use App\Form\DeleteFournisseurType;
use App\Repository\FournisseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FournisseurController extends AbstractController
{
    #[Route('/fournisseur', name: 'fournisseur')]
    public function displayAllFournisseur(FournisseurRepository $fournisseurRepository): Response
    {
        $fournisseur = $fournisseurRepository->findAll();

        return $this->render('fournisseur/index.html.twig', [
            'controller_name' => 'FournisseurController',
            'fournisseur' => $fournisseur
        ]);
    }

    #[Route('/fournisseur/{id}', name : 'fournisseur_details')]
    public function fournisseurDetails($id, FournisseurRepository $fournisseurRepository): Response
    {
        $fournisseur=$fournisseurRepository->find($id);

        if(!$fournisseur){
            throw $this->createNotFoundException();
        }

        return $this->render('fournisseur/fournisseur_details.html.twig', [
            'controller_name' => 'FournisseurController',
            'fournisseur' => $fournisseur,
            'id' => $id
        ]);
    }

    #[Route('/creer-un-fournisseur', name: 'create_fournisseur')]
    public function createFournisseur(Request $request, FournisseurRepository $fournisseurRepository): Response
    {
        $fournisseur = new Fournisseur();
        $form = $this->createForm(CreateFournisseurType::class, $fournisseur);

        $form->handleRequest($request);

        if ($form->get('publish')->isClicked()) {
            if($form->isSubmitted() && $form->isValid()) {
                $fournisseurRepository->add($fournisseur, true);
                return $this->redirectToRoute('fournisseur');
            }
        }

        return $this->render('fournisseur/create.html.twig', [
            'controller_name' => 'FournisseurController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/modify_fournisseur/{id}', name : 'modify_fournisseur')]
    public function modifyFournisseur($id,Request $request, FournisseurRepository $fournisseurRepository): Response
    {
        $fournisseur=$fournisseurRepository->find($id);

        if ($fournisseur == null){
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(CreateFournisseurType::class, $fournisseur);

        $form->handleRequest($request);

        if ($form->get('publish')->isClicked()) {
            if($form->isSubmitted() && $form->isValid()){
                $fournisseurRepository->add($fournisseur, true);
                return $this->redirectToRoute('fournisseur');
            }
        }

        return $this->render('fournisseur/modify.html.twig', [
            'controller_name' => 'FournisseurController',
            'form' => $form->createView(),
            'fournisseur' => $fournisseur,
            'id' => $id
        ]);
    }

    #[Route('/supprimer-le-fournisseur/{id}', name : 'delete_fournisseur')]
    public function deleteFournisseur($id,Request $request, FournisseurRepository $fournisseurRepository): Response
    {
        $fournisseur=$fournisseurRepository->find($id);

        if ($fournisseur == null){
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(DeleteFournisseurType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->get('delete')->isClicked()) {
            if($form->isSubmitted() && $form->isValid()){
                $fournisseurRepository->remove($fournisseur, true);
                return $this->redirectToRoute('fournisseur');
            }
        }

        return $this->render('fournisseur/delete.html.twig', [
            'controller_name' => 'FournisseurController',
            'form' => $form->createView(),
            'fournisseur' => $fournisseur,
            'id' => $id
        ]);
    }

}
