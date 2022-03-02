<?php

namespace App\Form;

use App\Entity\Auxiliar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuxiliarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('apellidoPaterno')
            ->add('apellidoMaterno')
            ->add('nombre')
            ->add('email')
            ->add('celular')
            ->add('direccion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auxiliar::class,
        ]);
    }
}
