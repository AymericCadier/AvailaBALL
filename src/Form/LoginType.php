<?php

// src/Form/LoginType.php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_email', TextType::class, [
                'label' => 'Email', // Changer le label selon votre préférence
            ])
            ->add('_password', PasswordType::class, [
                'label' => 'Password', // Changer le label selon votre préférence
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Se connecter', // Changer le label selon votre préférence
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
