<?php

namespace Back\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreListType extends AbstractType
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', 'choice', array(
                'choices'  => array(
                    1 => "Not Paid",
                    2 => "Paid",
                    3 => "Validated",
                ),
                'data'     => $this->status,
                'expanded' => true,
                'required' => true,
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_userbundle_booking';
    }
}
