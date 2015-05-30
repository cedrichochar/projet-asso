<?php

namespace MC\EventBundle\Form\Type;

use MC\EventBundle\Model\CASearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvenementSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCA',null,array(
                'required' => false,
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
            'data_class' => 'MC\EvenetBundle\Model\CASearch'
        ));
    }

    public function getName()
    {
        return 'mc_ca_search_type';
    }
}