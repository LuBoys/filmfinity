<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RegistrationFormType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('email', EmailType::class)
        // Changez 'password' en 'plainPassword' et utilisez RepeatedType::class pour la confirmation du mot de passe.
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Répétez le mot de passe'],
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'S\'il vous plaît, entrez un mot de passe.',
                ]),
                new Assert\Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères.',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
            'mapped' => false, // Le mot de passe ne sera pas persisté directement, il sera géré dans le contrôleur.
        ])
        // Ajout des champs name et nickname
        ->add('name', TextType::class)
        ->add('nickname', TextType::class)
        ->add('username', TextType::class)
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => new Assert\IsTrue([
                'message' => 'Vous devez accepter les conditions d\'utilisation.',
            ]),
            'label' => 'J\'accepte les conditions',
        ])
        ;
}

        
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
    
}