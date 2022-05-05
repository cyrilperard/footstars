<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
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
                    ]),
                    new Length([
                        "min" => 2,
                        "max" => 20
                    ]),
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
                    ]),
                    new Length([
                        "min" => 2,
                        "max" => 20
                    ]),
                ],
                ])
            ->add('pseudo', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre pseudo'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le pseudo ne peut pas être vide'
                    ]),
                    new Length([
                        "min" => 4,
                        "max" => 50
                    ]),
                ],
                ])
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
            ->add('phone', TelType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre téléphone'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ]),
                    new Length([
                        "min" => 10,
                        "max" => 10
                    ]),
                    new Regex('/[0-9]/')
                ],])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'required' => true,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter les condtions pour continuer.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
