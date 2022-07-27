<?php

namespace App\Form;

use App\Entity\User;
use DateTime;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',  EmailType::class)
            ->add('password', TextType::class, [
                'label' => 'Mot de passe'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])

            // ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            //     // je récupère le formulaire pour le modifier
            //     $formulaire = $event->getForm();
            //     /** @var User $userEntity */
            //     $userEntity = $event->getData();
            //     $log = $userEntity->getNewLogin();
            //     if ($log !== null) {
            //         $userEntity->setLastLogin($log);
            //     }
            //     $userEntity->setNewLogin(new DateTime('now'));
            // })
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
