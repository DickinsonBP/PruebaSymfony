<?php

namespace App\Form\Type;

use App\Entity\Provider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, ['label'=>'Nombre','attr' => ['class' => 'form-control']]);
        $builder->add('email', TextType::class, ['label'=>'Email', 'attr' => ['class' => 'form-control']]);
        $builder->add('phone', TextType::class, ['label'=>'Telefono', 'attr' => ['class' => 'form-control']]);
        $builder->add('provider_type', ChoiceType::class, [
            'label' =>'Tipo de proveedor',
            'attr' => ['class' => 'form-control'],
            'choices' => [
                'Hotel' => 'hotel',
                'Pista' => 'track',
                'Complemento' => 'complement'
                ]
            ]);
        $builder->add('active', ChoiceType::class, [
            'label' => 'Activo?',
            'attr' => ['class' => 'form-control'],
            'choices' => [
                'Si' => true,
                'No' => false
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Provider::class,
            ]
        );
    }
}