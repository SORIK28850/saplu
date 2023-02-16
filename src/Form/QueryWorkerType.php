<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QueryWorkerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('usuario', ChoiceType::class, [
            'label' => 'Seleccione trabajador',
            'choices'  => [
                'Seleccione el usuario' => $options['empty_data']['workers']
            ],
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('submit', SubmitType::class, [
            'label' => $options['empty_data']['submitContent'] ?? 'Consultar datos',
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
