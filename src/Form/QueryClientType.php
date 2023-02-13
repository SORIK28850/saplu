<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QueryClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('usuario', ChoiceType::class, [
            'label' => 'Seleccione usuario',
            'choices'  => [
                'Seleccione el usuario' => $options['empty_data']['usuarios']
            ],
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Consultar datos',
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
            // Configure your form options here
        ]);
    }
}
