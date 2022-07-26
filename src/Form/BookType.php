<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Package;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class)
            ->add('status', IntegerType::class)
            ->add('price', NumberType::class )
            ->add('packages',EntityType::class, [
                'label' => 'Package_id *',
                'choice_label' => 'id',
                'class' => Package::class,
                'multiple' => false,
                'expanded' => true,
                'required' => true
            ] )
            ->add('user',EntityType::class, [
                'label' => 'Nom de l\'utilisateur *',
                'choice_label' => 'lastname',
                'class' => User::class,
                'multiple' => false,
                'expanded' => false,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
