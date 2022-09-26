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

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom de la catégorie :',
                'required' => true,
            ])
            /**->add('fournisseur', EntityType::class,[
                'class' => Fournisseur::class,
                'choice_label' => 'name',
                'mapped' => false
            ])**/

            ->add('publish', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' =>
                    [
                        'type' => 'submit',
                        'class' => 'btn btn-success',
                    ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
