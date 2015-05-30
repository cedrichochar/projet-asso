<?php

namespace MC\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdministrateurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomAdministrateur', 'text')
            ->add('prenomAdministrateur', 'text')
            ->add('adresseMailAdministrateur', 'text')
            ->add('motDePasseAdministrateur', 'text')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MC\EventBundle\Entity\Administrateur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mc_eventbundle_administrateur';
    }
}
