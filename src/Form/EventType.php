<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Playground;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('date')
            ->add('duration')
            ->add('type')
            ->add('id_playground', EntityType::class, [
                'class' => Playground::class,
                'choice_label' => function (Playground $playground) {
                    return $playground->getName();
                },
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}