<?php

namespace App\Controller;


use App\Entity\Fournisseur;
use App\Form\CreateFournisseurType;
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
/**
        $fournisseur= new Fournisseur();
        $fournisseur-> setName('Biscuiterie des Vénètes');
        $fournisseur-> setDescription('Fait de très bon biscuit salé et sucré');
        $fournisseur-> setAddress('33 boulevard Léon Bourgeois');
        $fournisseur-> setCity('Rennes');
        $fournisseur-> setPostalCode('35310');
        $fournisseur-> setCategory('Biscuit');

        #envoi dans la BDD en utilisant l'entity manager
        $em-> persist($fournisseur);
        $em-> flush();
**/
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
            $fournisseurRepository->add($fournisseur, true);
            return $this->redirectToRoute('fournisseur');
        }

        return $this->render('fournisseur/create.html.twig', [
            'controller_name' => 'FournisseurController',
            'form' => $form->createView()
        ]);
    }

}
