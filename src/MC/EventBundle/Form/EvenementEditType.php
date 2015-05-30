<?php

namespace MC\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvenementEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         ->add('Debut', 'datetime')
         ->add('Fin', 'datetime', array('required' => false))
         ->add('NomEvenement', 'text')
         //->add('ca', 'entity', array('class' => 'MCEventBundle:CA','property' => 'nomCA', 'multiple' => false, 'expanded' =>false))
         ->add('NomOrganisateur', 'text')
         ->add('Descriptif', 'textarea', array('required' => false))
         //->add('image', new ImageType(), array('required' => false))
         ->add('theme', 'collection', array( 'type' => new ThemeType(), 'allow_add' => true, 'allow_delete' => true, 'required' => false))
         ->add('enregistrer', 'submit');
    }
    
    public function getName()
    {
        return 'mc_eventbundle_evenement_edit';
    }
}
