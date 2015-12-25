<?php

namespace Back\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaypalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('account')
            ->add('testMode','checkbox',array(
                'required'=>false,
                'label'=>" Test Mode"
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\UserBundle\Entity\Paypal'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_userbundle_paypal';
    }
}
