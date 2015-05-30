<?php

namespace MC\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CAType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         ->add('NomCA', 'text')  
         ->add('DescriptifCA', 'textarea')
         //->add('image', new ImageType(), array('required' => false))
         ->add('contact', 'collection', array('type' => new ContactType(), 'allow_add' => true, 'allow_delete' => true, 'required' => false))
         ->add('theme', 'collection', array('type' => new ThemeType(), 'allow_add' => true, 'allow_delete' => true, 'required' =>false))
         ->add('enregistrer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MC\EventBundle\Entity\CA'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mc_eventbundle_ca';
    }
}