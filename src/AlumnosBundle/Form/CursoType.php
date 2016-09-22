<?php

namespace AlumnosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AlumnosBundle\Form\DMFDateType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class CursoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaInicio', DMFDateType::class, array( 'widget' => 'single_text'))
            ->add('fechaFin'   , DMFDateType::class, array( 'widget' => 'single_text'))
            ->add('periodo'    , DateType::class, array('input' => 'array', ))
            ->add('fechaCierre', DMFDateType::class, array( 'widget' => 'single_text'))
            ->add('materia')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AlumnosBundle\Entity\Curso'
        ));
    }
}
