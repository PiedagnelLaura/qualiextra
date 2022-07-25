<?php

namespace App\Form;

use App\Entity\Establishment;
use App\Entity\Package;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('picture')
            ->add('price')
            ->add('description')
            ->add('date')
            ->add('types',EntityType::class, [
                'label' => 'Choisir votre catégorie',
                'choice_label' => 'name',
                'class' => Type::class,
                'multiple' => true
            ])
            ->add('establishment', EntityType::class, [
                'label' => 'Choisir votre établissement',
                'choice_label' => 'name',
                'class' => Establishment::class,
                'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Package::class,
        ]);
    }
}
