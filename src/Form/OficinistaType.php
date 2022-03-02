<?php

namespace App\Form;

use App\Entity\Oficinista;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OficinistaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('apellidoPaterno')
            ->add('apellidoMaterno')
            ->add('nombre')
            ->add('celular')
            ->add('email')
            ->add('direccion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Oficinista::class,
        ]);
    }
}
