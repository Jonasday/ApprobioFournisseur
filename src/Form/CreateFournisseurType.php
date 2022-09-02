<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Fournisseur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateFournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom du fournisseur :',
                'required' => true,
            ])
            ->add('description', TextType::class,[
                'label' => 'Description :',
                'required' => false
            ])
            ->add('address', TextType::class,[
                'label' => 'Adresse :',
                'required' => true,
            ])
            ->add('city', TextType::class,[
                'label' => 'Ville :',
                'required' => true,
            ])
            ->add('postal_code', TextType::class,[
                'label' => 'Code Postal :',
                'required' => true,
            ])
            ->add('categories', EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'name',
                'mapped' => false
            ])

            ->add('publish', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' =>
                    [
                        'type' => 'submit',
                        'class' => 'btn btn-dark',
                    ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fournisseur::class,
        ]);
    }
}
