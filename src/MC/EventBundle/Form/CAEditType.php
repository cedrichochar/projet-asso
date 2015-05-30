<?php

namespace MC\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CAEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('contact', 'collection', array('type' => new ContactType(), 'allow_add' => true, 'allow_delete' => true, 'required' => false))
        ->add('theme', 'collection', array('type' => new ThemeType(), 'allow_add' => true, 'allow_delete' => true, 'required' =>false)) 

    ;      
    }
    
    public function getName()
    {
        return 'mc_eventbundle_ca_edit';
    }

    public function getParent()
    {
        return new CAType();
    }
}