<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Fournisseur;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom :',
                'required' => true
            ])
            ->add('cost', NumberType::class,[
                'label' => 'Coût HT :',
                'required' => true
            ])
            ->add('sellingPrice', NumberType::class,[
                'label' => 'Prix de vente HT :',
                'required' => true
            ])
            ->add('sellingPriceTtc', NumberType::class,[
                'label' => 'Prix de vente TTC :',
                'required' => true
            ])
            ->add('margin', NumberType::class,[
                'label' => 'Taux de marge (en %) :',
                'required' => true
            ])
            ->add('tva', NumberType::class,[
                'label' => 'TVA (en %) :',
                'required' => true
            ])
            ->add('bio', CheckboxType::class,[
                'label' => 'Bio ',
                'required' => false
            ])
            ->add('commerceEquitable', CheckboxType::class,[
                'label' => 'Commerce équitable  ',
                'required' => false
            ])
            ->add('solidaire', CheckboxType::class,[
                'label' => 'Solidaire ',
                'required' => false
            ])
            ->add('fournisseur', EntityType::class,[
                'class' => Fournisseur::class,
                'choice_label' => 'name',
            ])
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'label' => 'Catégorie',
                'choice_label' => 'name',
            ])

            ->add('publish', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' =>
                    [
                        'type' => 'submit',
                        'class' => 'btn btn-success',
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
