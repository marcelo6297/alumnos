<?php

namespace AlumnosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AlumnosBundle\Form\DMFDateType;

class InscriptosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaRegistro', DMFDateType::class, 
                    array( 'widget' => 'single_text',
                    'md_options' => array()
                    ) 
            )
            ->add('tipoCursante' ,'choice', array (
                'choices' => array ('CURSANTE', 'RECURSANTE')
                 ))
            ->add('puntaje')
            ->add('calificacion', 'choice', array(
                'choices' => array('EXCELENTE' => 'EXCELENTE', 'MUY BUENO' => 'MUY BUENO','BUENO' => 'BUENO','ACEPTABLE' => 'ACEPTABLE', 'REPROBADO' =>'REPROBADO')
                ))
            ->add('curso')
            ->add('user')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AlumnosBundle\Entity\Inscriptos'
        ));
    }
}
