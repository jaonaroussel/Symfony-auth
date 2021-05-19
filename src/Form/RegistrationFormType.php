<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use function PHPSTORM_META\type;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label'         => false,
                'attr' => [
                    'placeholder' => 'Adresse mail ',

                    'class' => 'form-control',
                    'autofocus' => true
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message'   => "les mot de passe saisie ne sont pas correcte ! ",
                'required'          => true,
                'first_options'      => [
                    'label'         => false,
                    'label_attr'    => [
                        'class'     => 'form-control',
                        'title'     => 'pour des raison de securité, votre mot de passe oit contenir 8 caractères',

                    ],
                    'attr' => [
                        'placeholder' => 'Password',
                        'class' => 'form-control',
                        // 'pattern'   => '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$',
                        // 'title'     => "pour des raison de securité votre",
                        'maxlength' => 255
                    ]

                ],
                'second_options'    => [
                    'label'         => false,
                    'label_attr'    => [
                        'title'     => "Confirmer le mot de passe."
                    ],
                    'attr' => [
                        'placeholder' => 'Confirmez password',
                        'class' => 'form-control',
                        // 'pattern'   => "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$",
                        // 'title'     => "Confirmez le mot de passe.",
                        'maxlength' => 255
                    ]

                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [

                'mapped' => false,
                'attr' => [
                    'id' => 'checkbox-signup',
                ],
                'constraints' => [
                    new IsTrue([
                        'message'   => "Vous devez accepter les termes et les conditon d'utilisatons de ce site",
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
