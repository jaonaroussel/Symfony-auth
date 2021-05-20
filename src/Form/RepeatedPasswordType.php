<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RepeatedPasswordType extends AbstractType
{
    public  function getParent(): string
    {
        return RepeatedType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
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
                    'placeholder' => 'Confirm password',
                    'class' => 'form-control',
                    // 'pattern'   => "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$",
                    // 'title'     => "Confirmez le mot de passe.",
                    'maxlength' => 255
                ]
            ]
        ]);
    }
}
