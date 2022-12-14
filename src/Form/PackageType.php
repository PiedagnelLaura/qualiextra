<?php

namespace App\Form;

use App\Entity\Establishment;
use App\Entity\Gallery;
use App\Entity\Package;
use App\Entity\Type;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotNull;

class PackageType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $user = $options['user'];


        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du package *',
            ])

            ->add('galleries', FileType::class, [
                'label' => 'Ajoutez vos images pour le caroussel *',
                'multiple' => true,
                'mapped' => false,
                'required' => true,
                'help' => 'Si vous avez plusieurs images, vous devez les ajouter en même temps',
                'constraints' => [new NotBlank()]
            ])
            


            ->add('price', NumberType::class, [
                'label' => 'Prix du package *',
            ])

            ->add('description', TextType::class, [
                'label' => 'Description du package *'
            ])

            ->add('expireOn', DateType::class,[
                'label' => 'Date de validité du package',
                'required' => false,
                'widget'   => 'single_text',
              
            ])

            ->add('types', EntityType::class, [
                'label' => 'Veuillez choisir un type *',
                'choice_label' => 'name',
                'class' => Type::class,
                'multiple' => true,
                'expanded' => true,
                
            ])

            ->add('establishment', EntityType::class, [
                'label' => 'Le package est rattaché à quel établissement ? *',
                'choice_label' => 'name',
                'class' => Establishment::class,
                'multiple' => false,
                'query_builder' => function(EntityRepository $er) use($user) {
                                return $er->createQueryBuilder('e')
                                -> where('e.user =:user')
                                ->setParameter('user', $user);
                    }
            ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Package::class,
            'user' => null,
        ]);


    }
}
