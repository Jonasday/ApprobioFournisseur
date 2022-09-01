<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Repository\FournisseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FournisseurController extends AbstractController
{
    #[Route('/fournisseur', name: 'fournisseur')]
    public function do_fournisseur(FournisseurRepository $fournisseurRepository): Response
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
        $fournisseurs = $fournisseurRepository->findAll();

        return $this->render('fournisseur/index.html.twig', [
            'controller_name' => 'FournisseurController',
            'fournisseur' => $fournisseurs
        ]);
    }

    #[Route('/fournisseur/{id}', name : 'fournisseur_details')]
    public function FounisseurDetails($id, FournisseurRepository $fournisseurRepository): Response
    {
        $fournisseur=$fournisseurRepository->find($id);

        if(!$fournisseur){
            throw $this->createNotFoundException();
        }

        return $this->render('fournisseur/fournisseur_details.html.twig', [
            'fournisseur' => $fournisseur,
            'id' => $id
        ]);
    }

}
