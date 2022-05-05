<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre prénom'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le prenom ne peut pas être vide'
                    ]),
                    new Regex([
                        'pattern' => '/^[a-z-]+$/i',
                        'htmlPattern' => '[a-zA-Z-]+',
                        'message' => 'Le prénom ne peut contenir que des caractères alphabétiqueset (-)'
                    ])
                ],],)
            ->add('last_name', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre nom'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom ne peut pas être vide'
                    ]),
                    new Regex([
                        'pattern' => '/^[a-z-]+$/i',
                        'htmlPattern' => '[a-zA-Z-]+',
                        'message' => 'Le nom ne peut contenir que des caractères alphabétiqueset (-)'
                    ])
                ],])
            ->add('pseudo', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre pseudo'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le pseudo ne peut pas être vide'
                    ])
                ],])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre adresse mail'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'L\'email ne peut pas être vide'
                    ]),
                    new Email([
                        'message' => 'L\'email n\'est pas valide'
                    ])
                ],])
            ->add('phone', null, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre téléphone'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ]),
                ],])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
