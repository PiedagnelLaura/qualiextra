<?php

namespace App\Form;

use App\Entity\Establishment;
use App\Entity\Style;
use App\Entity\Tag;
use App\Entity\User;
use PharIo\Manifest\Email;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstablishmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('address', TextType::class)
            ->add('phone', TextType::class)
            ->add('email', EmailType::class)
            ->add('website', UrlType::class)
            ->add('openingHour', TextType::class)
            ->add('openingDay', TextType::class)
            ->add('description', TextareaType::class)
            ->add('picture', UrlType::class, [
                'help' => 'Url de l\'image'
            ])
            ->add('price', IntegerType::class)
            ->add('tags', EntityType::class, [
                'label' => 'Choisir le ou les tag',
                'choice_label' => 'name', // valeur de la prop à afficher dans les balises options
                'class' => Tag::class,
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])
            ->add('user', EntityType::class, [
                'label' => 'Sélectionner le gérant de l\'établissement *',
                'choice_label' => 'lastname',
                'class' => User::class,
                'multiple' => false,
                'expanded' => true,
                'required' => true
            ])
            ->add('style', EntityType::class, [
                'label' => 'Choisir le style',
                'choice_label' => 'name', // valeur de la prop à afficher dans les balises options
                'class' => Style::class,
                'multiple' => false,
                'expanded' => true,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Establishment::class,
        ]);
    }
}
