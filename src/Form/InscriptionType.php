<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lname', TextType::class, [
                'constraints' => [new NotBlank(['message' => 'Please enter your last name'])],
            ])
            ->add('fname', TextType::class, [
                'constraints' => [new NotBlank(['message' => 'Please enter your first name'])],
            ])
            ->add('username', TextType::class, [
                'constraints' => [new NotBlank(['message' => 'Please enter your username'])],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Please enter your email']),
                    new \Symfony\Component\Validator\Constraints\Email(['message' => 'The email "{{ value }}" is not a valid email.']),
                ],
            ])
            ->add('password', TextType::class, [
                'constraints' => [new NotBlank(['message' => 'Please enter your password'])],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

