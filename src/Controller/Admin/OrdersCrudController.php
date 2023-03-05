<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use App\Entity\Customers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class OrdersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Orders::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id') ->hideOnForm();
        yield AssociationField::new('customers','Customer Email');
        yield AssociationField::new('Products','Product Name');
        yield IntegerField::new('qty','So Luong');
        yield MoneyField::new('price') ->setCurrency('VND');
        yield DateTimeField::new('date')->renderAsChoice();
        yield TextField::new('address');
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
