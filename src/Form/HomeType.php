<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('motsClef', SearchType::class,[
                'label' => 'Le nom du produit contient :',
                'required' => false,
                'attr' => [
                    'placeholder' => 'recherche'
                ]
            ])
            ->add('bio', CheckboxType::class, [
                'label' => 'Sorties auxquelles je suis inscrit/e ',
                'required' => false,
            ])
            ->add('commerceEquitable', CheckboxType::class, [
                'label' => 'Sorties auxquelles je ne suis pas inscrit/e ',
                'required' => false,
            ])
            ->add('solidaire', CheckboxType::class, [
                'label' => 'Sorties passées ',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Recherche',
                'attr' =>
                    [
                        'class' => 'btn btn-dark',
                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
