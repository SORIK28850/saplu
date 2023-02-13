<?php

namespace App\Form;

use App\Entity\Work;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('client', ChoiceType::class, [
                'label' => 'Seleccione usuario',
                'choices'  => [
                    'Seleccione el usuario' => $options['empty_data']['usuarios']
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('user', ChoiceType::class, [
                'label' => 'Seleccione trabajador',
                'choices'  => [
                    'Seleccione el trabajador' => $options['empty_data']['workers']
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Seleccione comienzo o final',
                'choices'  => [
                    'Seleccione el tipo' => ['Comienzo' => 'Comienzo', 'Final' => 'Final']
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            
            ->add('observations', TextareaType::class, [
                'label' => 'Observaciones',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Registrar',
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
            'data_class' => Work::class,
        ]);
    }
}
