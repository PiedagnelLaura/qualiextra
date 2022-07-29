<?php

namespace App\Form;

use App\Entity\Establishment;
use App\Entity\Gallery;
use App\Entity\Package;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPackageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du package',
                'disabled' => true,
                
            ])

            ->add('price', NumberType::class, [
                'label' => 'Prix du package',
            ])

            ->add('description', TextType::class, [
                'label' => 'Description du package',
                'disabled' => true,
            ])

            //TODO : si on a le temps revoir regarder pour récup les images et les modifier
            // ->add('galleries', FileType::class, [
            //     'label' => 'Ajoutez vos images pour le caroussel',
            //     'multiple' => true,
            //     'mapped' => false,
            //     'required' => false,
            //     'help' => 'Ajoutez minimum deux images'
            // ])

            // ->add('galleries', EntityType::class, [
            //     'label' => 'Le package est rattaché à quel établissement ?',
            //     'choice_label' => 'images',
            //     'class' => Gallery::class,
            //     'multiple' => false,
            //     'disabled' => true,
            // ])

            ->add('expireOn', DateType::class,[
                'label' => 'Date de validité du package',
            ])

            ->add('types', EntityType::class, [
                'label' => 'Veuillez choisir un type',
                'choice_label' => 'name',
                'class' => Type::class,
                'multiple' => true,
                'expanded' => true,
                'disabled' => true,
            ])

            ->add('establishment', EntityType::class, [
                'label' => 'Le package est rattaché à quel établissement ?',
                'choice_label' => 'name',
                'class' => Establishment::class,
                'multiple' => false,
                'disabled' => true,
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
