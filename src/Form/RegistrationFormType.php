<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('phone', NumberType::class, [
                'label' => 'Teléfono',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('role', ChoiceType::class, [
                'label' => 'Tipo de usuario',
                'choices'  => [
                    'Tipo de usuario' => ['Administrador' => 'Administrador', 'Trabajador' => 'Trabajador']
                ],
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Password',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Registrar nuevo trabajador',
                'attr' => [
                    'style' => 'margin-top: 5px;',
                    'class' => 'btn btn-primary',
                    'id' => 'submitButton'
                ],
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
