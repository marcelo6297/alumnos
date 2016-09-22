<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace AlumnosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class DMFDateType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
//        $resolver->setDefined(array('md_options'));
        $resolver->setDefaults(array('md_options' => ''));
        parent::configureOptions($resolver);
        
    }

    public function getParent()
    {
        return DateType::class;
    }
    
    public function getBlockPrefix() {
        return "dmf_date";
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options) {
        
        if (isset($options['md_options'])) {
            $view->vars['md_options'] =  $options['md_options'];
        }
        
    }

    
    
}