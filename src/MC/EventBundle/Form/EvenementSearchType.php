<?php

namespace MC\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvenementSearchType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEvenement',null, array(
                'required' => false,
            ))
            ->add('nomOrganisateur',null, array(
                'required' => false,
            ))
            ->add('dateFrom', 'date', array(
                'required' => false,
                'widget' => 'choice',
            ))
            ->add('dateTo', 'date', array(
                'required' => false,
                'widget' => 'choice',
            ))
            ->add('Rechercher','submit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            // avoid to pass the csrf token in the url (but it's not protected anymore)
            'csrf_protection' => false,
            'data_class' => 'MC\EventBundle\Entity\EvenementSearch'
        ));
    }

    public function getName()
    {
        return 'evenement_search_type';
    }
}