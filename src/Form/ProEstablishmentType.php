<?php

namespace App\Form;

use App\Entity\Establishment;
use App\Entity\Style;
use App\Entity\Tag;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProEstablishmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,  [
                'label' => 'Nom de l\'établissement *'])
            ->add('address', TextType::class,  [
                'label' => 'Adresse *'])
            ->add('phone', TextType::class,  [
                'label' => 'Téléphone',
                'required' => false,
                ])
            ->add('email', TextType::class, [
                'required' => false,
                ])
            ->add('website', TextType::class,  [
                'label' => 'Site web',
                'required' => false,
                ])
            ->add('openingHour', TextType::class,  [
                'label' => 'Horaires d\'ouverture',
                'required' => false,
                ])
            ->add('openingDay', TextType::class,  [
                'label' => 'Jours d\'ouverture',
                'required' => false,
                ])
            ->add('description', TextareaType::class,  [
                'label' => 'Description *'])
                
            ->add('picture', UrlType::class, [
                'help' => 'Url de l\'image',
                'label' => 'Photo de l\'établissement', 
                'required' => false
            ])
            ->add('price',  NumberType::class,  [
                'label' => 'Prix moyen proposé', 
                'required' => false,
                ])
            ->add('tags', EntityType::class, [
                'label' => 'Equipement(s)',
                'choice_label' => 'name',
                'class' => Tag::class,
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])
            
            ->add('style', EntityType::class, [
                'label' => 'Style *',
                'choice_label' => 'name',
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
