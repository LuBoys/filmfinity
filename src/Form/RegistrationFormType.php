<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;





class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Entrez votre prénom.',
                ]),
                new Length([
                    'min' => 2,
                    'max' => 255,
                    'minMessage' => 'Your name should be at least {{ limit }} characters',
                    'maxMessage' => 'Your name should not be longer than {{ limit }} characters',
                ]),
            ],
        ])
        ->add('nickname', TextType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Entrez votre nom.',
                ]),
                new Length([
                    'min' => 2,
                    'max' => 255,
                    'minMessage' => 'Your nickname should be at least {{ limit }} characters',
                    'maxMessage' => 'Your nickname should not be longer than {{ limit }} characters',
                ]),
            ],
        ])
        ->add('username', TextType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Entré votre pseudo.',
                ]),
                new Length([
                    'min' => 2,
                    'max' => 255,
                    'minMessage' => 'Your nickname should be at least {{ limit }} characters',
                    'maxMessage' => 'Your nickname should not be longer than {{ limit }} characters',
                ]),
            ],
        ])
        ->add('email')
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'You should agree to our terms.',
                ]),
            ],
        ])
        ->add('plainPassword', PasswordType::class, [
            'mapped' => false,
            'attr' => ['autocomplete' => 'new-password'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    'max' => 4096,
                ]),
            ],
        ]);
    
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
