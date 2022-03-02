<?php

namespace App\Form;

use App\Entity\PadreFamilia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PadreFamiliaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('apellidoPaterno')
            ->add('apellidoMaterno')
            ->add('nombre')
            ->add('dni')
            ->add('celular')
            ->add('email')
            ->add('direccion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PadreFamilia::class,
        ]);
    }
}
