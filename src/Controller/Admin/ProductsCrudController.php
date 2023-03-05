<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ProductsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Products::class;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id') ->hideOnForm();
        yield TextField::new('name');
        yield AssociationField::new('Categories');
        yield TextareaField::new('details');
        yield MoneyField::new('price') ->setCurrency('VND');
        yield IntegerField::new('qty','So luong');
        yield ImageField::new('img') 
        ->setUploadDir('public/img/products')
        ->setBasePath('img/products')
        ->setUploadedFileNamePattern('[randomhash].[extension]')
        ->setRequired(false);
    }
}
