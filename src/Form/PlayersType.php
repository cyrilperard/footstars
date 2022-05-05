<?php

namespace App\Form;

use App\Entity\Players;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_player')
            ->add('name')
            ->add('first_name')
            ->add('last_name')
            ->add('age')
            ->add('birth_date')
            ->add('birth_place')
            ->add('birth_country')
            ->add('nationality')
            ->add('height')
            ->add('weight')
            ->add('injured')
            ->add('photo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Players::class,
        ]);
    }
}
