<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name')
        ->add('Categories', EntityType::class, [
            'class' => Categories::class,
            'choice_label' => 'name' ])
        ->add('details')
        ->add('price')
        ->add('qty')
        ->add('img');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
